<?php
namespace FoodBookLite;
/**
 *
 * @package     Foodbooklite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Components_Ajax {

	function __construct() {

    add_action( 'wp_ajax_login_action', [$this, 'login'] );
    add_action( 'wp_ajax_nopriv_login_action', [$this, 'login'] );
    //
    add_action( 'wp_ajax_registration_action', [$this, 'registration'] );
    add_action( 'wp_ajax_nopriv_registration_action', [$this, 'registration'] );
    //
    add_action( 'wp_ajax_woo_search_product', [$this, 'search_product'] );
    add_action( 'wp_ajax_nopriv_woo_search_product', [$this, 'search_product'] );
    //
    add_action( 'wp_ajax_invitation_mail_action', [$this, 'invitation_mail'] );
    add_action( 'wp_ajax_nopriv_invitation_mail_action', [$this, 'invitation_mail'] );
    //
    add_action( 'wp_ajax_update_order_review_action', [$this, 'update_order_review'] );
    add_action( 'wp_ajax_nopriv_update_order_review_action', [$this, 'update_order_review'] );

	}


  public function login() {

    // First check the nonce, if it fails the function will break
    
    $formData = isset( $_POST['data'] ) ? $_POST['data'] : '';

    $parms = [];

    parse_str( $formData, $parms );


    // Nonce is checked, get the POST data and sign user on
    $info = [];
    $info['user_login'] = $parms['uname'];
    $info['user_password'] = $parms['paw'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );

    if ( is_wp_error($user_signon) ){
        $s = array( 'loggedin' => false, 'message' => esc_html__('Wrong username or password.', 'foodbooklite' ) );
    } else {
        $s = array( 'loggedin' => true,  'message' => esc_html__('Login successful, redirecting...', 'foodbooklite' ) );
    }

    wp_send_json_success( $s );

  exit();

  }

  public function registration() {

    $formData = isset( $_POST['data'] ) ? $_POST['data'] : '';

    $parms = [];

    parse_str( $formData, $parms );


    $new_user_login = stripcslashes( $parms['username'] );
    $new_user_email = stripcslashes( $parms['useremail'] );
    $new_user_password = $parms['password'];

    $user_data = array(
        'user_login' => $new_user_login,
        'user_email' => $new_user_email,
        'user_pass' => $new_user_password,
        'role' => 'customer'
      );

      $user_id = wp_insert_user($user_data);

      //
      $status = [];


      if ( !is_wp_error( $user_id ) ) {

        wp_set_current_user( $user_id );
        wp_set_auth_cookie( $user_id );

        $status = [ 'loggedin' => true, 'user_id' => $user_id, 'message' => esc_html__('Wrong username or password.', 'foodbooklite' ) ];

      } else {

        if ( isset( $user_id->errors['empty_user_login'] ) ) {
            
            $status = [ 'loggedin' => false, 'message' => esc_html__('User Name and Email are mandatory', 'foodbooklite' ) ];

          } elseif (isset( $user_id->errors['existing_user_login'] ) ) {

            $status = [ 'loggedin' => false, 'message' => esc_html__('User name already exixts.', 'foodbooklite' ) ];

          } else {

            $status = [ 'loggedin' => false, 'message' => esc_html__('Error Occured please fill up the sign up form carefully.', 'foodbooklite' ) ];
           

          }

      }

      wp_send_json_success( $status );

    exit;

  }

  public function search_product() {
 
    global $wpdb, $woocommerce;
 
    if ( isset( $_POST['keyword'] ) && !empty( $_POST['keyword'] ) ) {


        $keyword = $_POST['keyword'];
        $getLayout = $_POST['layout'];
 
        
        $querystr = "SELECT DISTINCT $wpdb->posts.*
        FROM $wpdb->posts, $wpdb->postmeta
        WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
        AND (
            ($wpdb->postmeta.meta_key = '_sku' AND $wpdb->postmeta.meta_value LIKE '%{$keyword}%')
            OR
            ($wpdb->posts.post_content LIKE '%{$keyword}%')
            OR
            ($wpdb->posts.post_title LIKE '%{$keyword}%')
        )
        AND $wpdb->posts.post_status = 'publish'
        AND $wpdb->posts.post_type = 'product'
        ORDER BY $wpdb->posts.post_date DESC";

   
 
        $query_results = $wpdb->get_results( $querystr );
 
        if ( !empty( $query_results ) ) {
 
            ob_start();
 
            $layout = new Product_Layout();

            foreach ( $query_results as $result ) {


                $display_price = get_post_meta( $result->ID, '_price' );
                $price      = get_post_meta( $result->ID, '_regular_price' );
                $price_sale = get_post_meta( $result->ID, '_sale_price' );
                $currency   = get_woocommerce_currency_symbol();
 
                $sku   = get_post_meta( $result->ID, '_sku' );
                $stock = get_post_meta( $result->ID, '_stock_status' );

                $product = get_product( $result->ID );
 
                $categories = wp_get_post_terms( $result->ID, 'product_cat' );

                if( $getLayout != 'grid' ) {
                  $layout->product_search_list_layout( $result, $product, $price, $price_sale, $display_price  );
                } else {
                  $layout->product_search_grid_layout( $result, $product, $price, $price_sale, $display_price  );
                }
        
        }

    } else {
        esc_html_e( 'Product not found.', 'foodbooklite' );
    }
    
     echo ob_get_clean();

    }
    die();
  }


	
  /**
   * 
   * @return [string] [description]
   */
  public function invitation_mail() {

    $getData = get_option( 'foodbooklite_options' );

    $subject = !empty( $getData['invitation-subject'] ) ? $getData['invitation-subject'] : "";
    $message = !empty( $getData['invitation-message'] ) ? $getData['invitation-message'] : "";

    if( isset( $_POST['mail'] ) ) {

      $res = mail( sanitize_email( $_POST['mail'] ) , esc_html( $subject ), esc_html( $message ) );

      if( $res ) {
        esc_html_e( 'Thanks for sending invitation', 'foodbooklite' );
      }else {
        esc_html_e( 'Invite failed, please try again.', 'foodbooklite' );
      }
      

    } else {
      esc_html_e( 'E-mail id not found.', 'foodbooklite' );
    }

    exit;

  }



/**
 * update_order_review
 * @return
 * 
 */
public function update_order_review() {

  $values = array();
  parse_str( $_POST['post_data'], $values );
  $cart = $values['cart'];

  WC()->cart->calculate_shipping();
  WC()->cart->calculate_totals();

  wp_die();
}



}

// Components_Ajax Class init
new Components_Ajax();