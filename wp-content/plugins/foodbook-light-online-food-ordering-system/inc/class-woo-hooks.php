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

class Woo_Hooks {

  function __construct() {

    // Add custom field to order object action hook
    add_action( 'woocommerce_checkout_create_order_line_item', [ __CLASS__ ,'foodbooklite_add_custom_data_to_order' ], 10, 4 );

    // Woocommerce Order meta data after shipping address action hook
    add_action( 'woocommerce_admin_order_data_after_shipping_address', [ __CLASS__, 'foodbooklite_edit_woocommerce_checkout_page' ], 10, 1 );

    //Woocommerce Order meta data after shipping address action
    add_action( 'woocommerce_checkout_update_order_meta', [ __CLASS__, 'checkout_update_order_meta' ], 10, 2 );

    // Override WooCommerce Templates from plugin filter hook
    add_filter( 'woocommerce_locate_template', [ __CLASS__, 'foodbooklite_woo_template' ], 1, 3 );

    // WooCommerce order meta query filter hook
    add_filter( 'woocommerce_order_data_store_cpt_get_orders_query', [ __CLASS__, 'foodbooklite_order_meta_query_var' ], 10, 2 );

    // WooCommerce product meta query filter hook
    add_filter( 'woocommerce_product_data_store_cpt_get_products_query', [ __CLASS__, 'foodbooklite_product_meta_query_var'], 10, 2 );

    // Add product extra items price action hook
    add_action( 'woocommerce_before_calculate_totals', [ __CLASS__, 'add_product_extra_items_price' ], 10, 1);

    // order Tracking Status
    add_action('woocommerce_checkout_order_processed', [ __CLASS__, 'order_tracking_status'], 10, 1);

    // 
    add_action( 'woocommerce_cart_calculate_fees', [ $this, 'checkout_radio_choice_fee' ], 20, 1 );

    // 
    add_action( 'woocommerce_checkout_update_order_review', [ $this, 'checkout_radio_choice_set_session' ] );

    //
    add_filter( 'wc_order_statuses', [ __CLASS__, 'add_pre_order_statuses' ] );
      
    //
    add_action( 'init', [ __CLASS__, 'register_pre_order_status' ] );

  }


  /**
   * Add custom field to order object
   */
  public static function foodbooklite_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {


    foreach( $item as $cart_item_key => $values ) {

      // Item Instructions
      if( isset( $values['item_instructions'] ) ) {

        $item->add_meta_data( esc_html__( 'Item Instructions', 'foodbooklite' ), sanitize_text_field( $values['item_instructions'] ), true );

      }

      // Item extra features
      if( isset( $values['extra_options'] ) ) {

        $item->add_meta_data( esc_html__( 'Item Extra:-', 'foodbooklite' ), sanitize_text_field( $values['extra_options'] ), true );
       
      }

    }
  }
  
/**
 * Woocommerce Order meta data after shipping address
 *
 * 
 */

public static function foodbooklite_edit_woocommerce_checkout_page( $order ){

  global $post_id;
  $order = new \WC_Order( $post_id );

  $orderID = $order->get_id();

  $time = get_post_meta ( absint( $orderID ) , '_pickup_time', true );

  $deliveryType = get_post_meta ( absint( $orderID ) , '_delivery_type', true );

  $branch = get_post_meta ( absint( $orderID ), '_fb_pickup_branch', true );

  //
  if( !empty( $deliveryType ) ) {
    echo '<p><strong>'.esc_html__('Delivery Type', 'foodbooklite' ).':</strong> ' . esc_html( $deliveryType ) . '</p>';
  }
  //
  if( !empty( $time ) ) {
    echo '<p><strong>'.esc_html__('Time to Deliver/Pickup', 'foodbooklite' ).':</strong> ' . esc_html( $time ) . '</p>';
  }
  //
  if( !empty( $branch ) ) {
    echo '<p><strong>'.esc_html__('Pickup Branch Name', 'foodbooklite' ).':</strong> ' . esc_html( get_the_title( $branch ) ) . '</p>';
  }
  

}


/**
 * Woocommerce Add Order meta data 
 *
 * 
 */
public static function checkout_update_order_meta( $order_id, $posted ) {

    $order = wc_get_order( $order_id );

    //
    if( isset( $_POST['fb_delivery_time'] ) ) {
      $order->update_meta_data( '_pickup_time', sanitize_text_field( $_POST['fb_delivery_time'] ) );
    }
    //
    if( isset( $_POST['fb_delivery_options'] ) ) {
      $order->update_meta_data( '_delivery_type', sanitize_text_field( $_POST['fb_delivery_options'] ) );
    }
    //
    if( isset( $_POST['fb_pickup_branch'] ) ) {
      $order->update_meta_data( '_fb_pickup_branch', sanitize_text_field( $_POST['fb_pickup_branch'] ) );
    }
    //
    if( isset( $_POST['fb_delivery_date'] ) ) {
      $order->update_meta_data( '_delivery_date', sanitize_text_field( $_POST['fb_delivery_date'] ) );
    }
    
    $order->save();

} 

/**
 *
 * Override WooCommerce Templates
 * 
 * 
 */

public static function foodbooklite_woo_template( $template, $template_name, $template_path ) {

     global $woocommerce;
     $_template = $template;
     if ( ! $template_path ) 
        $template_path = $woocommerce->template_url;
 
     $plugin_path  = untrailingslashit( FOODBOOKLITE_DIR_PATH )  . '/template/woocommerce/';
 
    // Look within passed path within the theme - this is priority
    $template = locate_template(
    array(
      $template_path . $template_name,
      $template_name
    )
   );
 
   if( file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;
 
   if ( ! $template )
    $template = $_template;

   return $template;

}

/**
 *
 * WooCommerce order meta query 
 * 
 * 
 */
public static function foodbooklite_order_meta_query_var( $query, $query_vars ) {

  if ( ! empty( $query_vars['tracking_status'] ) ) {
    $query['meta_query'][] = array(
      'key' => '_order_tracking_status',
      'value' => esc_attr( $query_vars['tracking_status'] ),
    );
  }

  //
  if ( ! empty( $query_vars['branch'] ) ) {
    $query['meta_query'][] = array(
      'key' => '_fb_pickup_branch',
      'value' => esc_attr( $query_vars['branch'] ),
    );
  }
  
  //
  if ( ! empty( $query_vars['delivery_boy'] ) ) {
    $query['meta_query'][] = array(
      'key' => '_order_delivery_boy',
      'value' => esc_attr( $query_vars['delivery_boy'] ),
    );
  }
  //
  if ( ! empty( $query_vars['delivery_date'] ) ) {
    $query['meta_query'][] = array(
      'key' => '_delivery_date',
      'value' => esc_attr( $query_vars['delivery_date'] ),
    );
  }
  //
  if ( ! empty( $query_vars['pre_order_status'] ) ) {
    $query['meta_query'][] = array(
      'key' => '_pre_order_status',
      'value' => esc_attr( $query_vars['pre_order_status'] ),
    );
  }

  return $query;
}

/**
 *
 * WooCommerce product meta query 
 * 
 * 
 */

public static function foodbooklite_product_meta_query_var( $query, $query_vars ) {

  // low to high price

  if ( ! empty( $query_vars['low_to_high_price'] ) ) {
    $query['meta_query'][] = array(
      'relation' => 'OR',
      array(
          'key' => '_price',
          'value' => esc_attr( $query_vars['low_to_high_price'] ),
          'compare' => '>',
          'type' => 'NUMERIC'
      ),         
      array(
          'key' => '_sale_price',
          'value' => esc_attr( $query_vars['low_to_high_price'] ),
          'compare' => '>',
          'type' => 'NUMERIC'
      )
    );
  }

  // Average rating
  
  if ( ! empty( $query_vars['average_rating_product'] ) ) {
    $query['meta_query'][] = array(
      array(
          'key' => '_wc_average_rating',
          'value' => esc_attr( $query_vars['average_rating_product'] ),
          'compare' => '>',
          'type' => 'NUMERIC'
      )
    );
  } 

  // Average rating
  
  if ( ! empty( $query_vars['total_sales_product'] ) ) {
    $query['meta_query'][] = array(
      array(
          'key' => 'total_sales'
      )
    );
  }
  

  return $query;

}

/**
 *
 * Before calculate totals
 * Add product extra items price
 * 
 */

public static function add_product_extra_items_price( $cart_object ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    
    foreach ( $cart_object->get_cart() as $cart_item ) {

      if( !empty( $cart_item['extra_options_price'] ) ) {

        $cart_item['data']->set_price( $cart_item['data']->get_price() + $cart_item['extra_options_price'] );
        
      }

    }

}

public static function order_tracking_status( $order_id ) {

  $time = current_time( "Y-m-d H:i:s" );
  $CurrentDate = current_time( "d-m-Y" );

  $dDate = get_post_meta( absint($order_id), '_delivery_date', true );

  if( strtotime( $dDate ) >  strtotime( $CurrentDate ) ) {
    update_post_meta( absint( $order_id ), '_pre_order_status', sanitize_text_field( 'PO' ) );
  }
  update_post_meta( absint( $order_id ), '_order_tracking_status', sanitize_text_field( 'OP' ) );
  update_post_meta( absint( $order_id ), '_order_tracking_status_time', sanitize_text_field( $time ) );

}


/**
 *
 * Add Fee and Calculate Total
 * 
 * 
 */

function checkout_radio_choice_fee( $cart ) {
   
   if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

  $options = get_option('foodbooklite_options');

  $delivery = isset( $options['delivery-fee'] ) ? $options['delivery-fee'] : '';

    
   $radio = WC()->session->get( 'radio_chosen' );
     
   if ( $radio == 'Delivery' ) {
      $fee = $delivery;
   } else {
      $fee = 0;
   }

   //
   if ( $fee ) {
      $cart->add_fee( esc_html__( 'Delivery Fee', 'foodbooklite' ), esc_html( $fee ) );
   }
   
}

/**
 *
 * Add Radio Choice to Session
 * 
 */
function checkout_radio_choice_set_session( $posted_data ) {
    parse_str( $posted_data, $output );
    if ( isset( $output['fb_delivery_options'] ) ){
        WC()->session->set( 'radio_chosen', $output['fb_delivery_options'] );
    }
}



/**
 * [register_pre_order_status description]
 * @return [type] [description]
 */
public static  function register_pre_order_status() {
 
  register_post_status( 'wc-pre-order', array(

  'label' => esc_html__( 'Pre Order', 'foodbooklite' ),

  'public' => true,

  'show_in_admin_status_list' => true,

  'show_in_admin_all_list' => true,

  'exclude_from_search' => false,

  'label_count' => _n_noop( 'Pre Order <span class="count">(%s)</span>', 'Pre Order <span

  class="count">(%s)</span>' )

  ) );

}

/**
 * [add_pre_order_statuses description]
 * @param [type] $order_statuses [description]
 */
public static function add_pre_order_statuses( $order_statuses ) {

  $new_order_statuses = array();

  foreach ( $order_statuses as $key => $status ) {

    $new_order_statuses[ $key ] = $status;
    if ( 'wc-processing' === $key ) {

      $new_order_statuses['wc-pre-order'] = esc_html__( 'Pre Order', 'foodbooklite' );

    }

  }

  return $new_order_statuses;

}







}

// Woo_Hooks class init

new Woo_Hooks();
