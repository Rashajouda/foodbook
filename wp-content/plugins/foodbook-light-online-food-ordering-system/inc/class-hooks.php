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

class Hooks {

  function __construct() {

    // Foodbooklite shop page shortcode register hook
    add_shortcode( 'foodbooklite_products', [ __CLASS__, 'foodbooklite_shortcode' ] );

    // Foodbooklite shop page Template include filter hook
    add_filter( 'template_include', [ __CLASS__, 'foodbooklite_page_template'], 99 );

    // register_taxonomy for specialoffer post types.
    add_action( 'init', [ __CLASS__, 'foodbooklite_specialoffer_taxonomy'], 0 );

    // Add Body class on foodbooklite woocommerce page action hook
    add_filter( 'body_class', [ __CLASS__, 'add_body_class'] );

    // Js template hook in footer action hook
    add_action( 'wp_footer', [ __CLASS__, 'fb_js_template'] );

    // Login redirect filter hook
    add_filter( 'login_redirect', [ __CLASS__, 'foodbooklite_login_redirect' ], 10, 3 );

    // Login failed redirect
    add_action( 'wp_login_failed', [ __CLASS__, 'foodbooklite_login_failed_redirect' ] );

    // Add custom userr roles
    add_filter( 'init', [ __CLASS__, 'foodbooklite_add_roles' ] );

    //
    add_action( 'admin_init', [$this, 'foodbooklite_no_admin_access'], 100 );

    // Location modal
    add_action( 'wp_footer', [ __CLASS__, 'location_modal'] );


   
  }

  /**
   * Foodbooklite shop page shortcode register
   *
   * 
   */
  
  public static function foodbooklite_shortcode( $atts ) {

    $attr = shortcode_atts( array(
      'col'     => '3',
      'layout'  => 'grid',
      'sidebar' => 'yes',
      'search'  => 'yes',
      'cat'     => ''
    ), $atts );


    global $foodbookliteAttr;

    $foodbookliteAttr = $attr;

    ob_start();
   
    include FOODBOOKLITE_DIR_PATH.'view/template-part-woo-items.php';
    
    return ob_get_clean();
   
  }


  /**
   * Foodbooklite shop page Template include
   *
   * 
   * 
   */
  
   
  public static function foodbooklite_page_template( $template ) {
   
    $options = get_option('foodbooklite_options');

    $shop_page            = !empty( $options['shop-page'] ) ? $options['shop-page'] : 'foodbooklite';
    $branch_manager_page  = !empty( $options['branch-manager'] ) ? $options['branch-manager'] : 'branch-manager';
    $kitchen_manager_page = !empty( $options['kitchen-manager'] ) ? $options['kitchen-manager'] : 'kitchen-manager';
    $delivery_page        = !empty( $options['delivery'] ) ? $options['delivery'] : 'delivery';
    $admin_page           = !empty( $options['admin'] ) ? $options['admin'] : 'admin';


    // Woo Items
    if ( is_page( $shop_page )  ) {

        $new_template = FOODBOOKLITE_DIR_PATH.'view/template-woo-items.php';

        if ( '' != $new_template ) {
            return $new_template ;
        }
    }
    

    return $template;

  }

  /**
   * Register.
   *
   * @see register_taxonomy for specialoffer post types.
   * 
   */

  
  public static function foodbooklite_specialoffer_taxonomy() {

      $args = array(
          'label'        => esc_html__( 'Special Offer', 'foodbooklite' ),
          'public'       => true,
          'rewrite'      => array( 'slug' => 'special-offer' ),
          'hierarchical' => true
      );

      register_taxonomy( 'specialoffer', 'product', $args );

  }


  /**
   *
   * Add Body class on foodbooklite woocommerce page
   * 
   * 
   */

  public static function add_body_class( $classes ) {

    // add checkout page body class
    if( is_checkout() ) {

      $classes = array_merge( $classes, array( 'foodbooklite-checkout' ) );

    }
    // add account page body class
    if( is_account_page() ) {
      $classes = array_merge( $classes, array( 'foodbooklite-checkout foodbooklite-account' ) );
    }

    return $classes;
  }


  /**
   *
   * Js template hook in footer
   * 
   * 
   */  
  public static function fb_js_template() {
    
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-wrapper.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-steps.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-product-content.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-cart-content.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-checkout.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-loginreg.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-reviews.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-billing-summary.php';
    include FOODBOOKLITE_DIR_PATH.'view/template-modal-alert.php';

  }

/**
 * foodbooklite_login_redirect 
 * @param  [type] $redirect_to 
 * @param  [type] $request     
 * @param  [type] $user        
 * @return [type]              
 */
public static function foodbooklite_login_redirect( $redirect_to, $request, $user ) {

    $options = get_option('foodbooklite_options');

    $branch_manager_page  = !empty( $options['branch-manager'] ) ? $options['branch-manager'] : 'branch-manager';
    $kitchen_manager_page = !empty( $options['kitchen-manager'] ) ? $options['kitchen-manager'] : 'kitchen-manager';
    $delivery_page        = !empty( $options['delivery'] ) ? $options['delivery'] : 'delivery';


    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } elseif( in_array( 'branch_manager', $user->roles ) ) {
          return home_url( esc_html( $branch_manager_page ) );
        }elseif( in_array( 'kitchen_manager', $user->roles ) ){
          return home_url( esc_html( $kitchen_manager_page ) );
        }elseif( in_array( 'delivery_boy', $user->roles ) ) {
          return home_url( esc_html( $delivery_page ) );
        } else {
            return $redirect_to;
        }
    } else {
        return $redirect_to;
    }

}

/**
 * foodbooklite_login_failed_redirect
 * login failed redirect
 * @return 
 */
public static function foodbooklite_login_failed_redirect() {

  $options = get_option('foodbooklite_options');

  $admin_page  = !empty( $options['admin'] ) ? $options['admin'] : 'admin';

  wp_redirect( site_url( esc_html( $admin_page ) ) ); 

}

/**
 * foodbooklite_add_roles
 * add custom role
 * @return 
 */
public static function foodbooklite_add_roles() {

  add_role( 'kitchen_manager', esc_html__( 'Kitchen Manager', 'foodbooklite' ), get_role( 'subscriber' )->capabilities );
  add_role( 'branch_manager', esc_html__( 'Branch Manager', 'foodbooklite' ), get_role( 'subscriber' )->capabilities );
  add_role( 'delivery_boy', esc_html__( 'Delivery Boy', 'foodbooklite' ), get_role( 'subscriber' )->capabilities );

}



/**
 * foodbooklite_no_admin_access
 * prevent wp admin access
 * @return 
 * 
 */

public function foodbooklite_no_admin_access() {

  $options = get_option('foodbooklite_options');

  $admin_page  = !empty( $options['admin'] ) ? $options['admin'] : 'admin';


  if ( is_admin() && ! current_user_can( 'administrator' ) &&
  ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

    wp_redirect( site_url( esc_html( $admin_page ) ) );
    exit;

  }

}
/**
 * [location_modal description]
 * @return [type] [description]
 */
public static function location_modal() {

  $modalShow = get_option('foodbooklite_options');
  $popupActive = isset( $modalShow['location-popup-active'] ) ? $modalShow['location-popup-active'] : '';

  if( !$popupActive ) {
    return;
  }

  
  $getPages = !empty( $modalShow['availability-checker-modal'] ) ? $modalShow['availability-checker-modal'] : 'foodbooklite';

  if( !is_page( $getPages ) ) {
    return;
  }

  ?>
  <div class="fb__wrapper orderadmin_popup_modal fb_delivery_availability_checker" id="orderadmin_popup_modal">
    <div class="fb_popup_modal open" style="display: block">
      <div class="fb_modal_wrap fb_modal_location">
        <div class="fb_modal">
          <div class="fb_modal_inner">
            <!-- Close Modal -->
            <span class="fb_close_modal">
              <img src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/close.svg'; ?>" alt="<?php esc_attr_e( 'close', 'foodbooklite' ); ?>" />
            </span>
            <?php 
            // Form
            \FoodBookLite\Inc\Ability_Checker_Form::form();
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
}


}

// Hooks class init
new Hooks();