<?php 
namespace FoodBookLite\Inc;
/**
 *
 * @package     Foodbooklite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Text {

  public static function getText() {
    return self::definedText();
  }

  public static function definedText() {

    return [
      
      'view_cart'           => esc_html__( 'View Cart', 'foodbooklite' ),
      'buy_more'            => esc_html__( 'Buy More', 'foodbooklite' ),
      'cart_added_error'    => esc_html__( 'Product don\'t added in the cart. please try again.', 'foodbooklite' ),
      'review_success_msg'  => esc_html__( 'Review has been submitted successfully.', 'foodbooklite' ),
      'review_error_msg'    => esc_html__( 'Review submission Failed. Please try again.', 'foodbooklite' ),
      'show_more'           => esc_html__( 'Show More', 'foodbooklite' ),
      'show_less'           => esc_html__( 'Less', 'foodbooklite' ),
      'loading'             => esc_html__( 'Loading', 'foodbooklite' ),
      'new_order_placed'    => esc_html__( 'New Order Placed', 'foodbooklite' ),
      'start_order'         => esc_html__( 'Start Order', 'foodbooklite' ),
      'delivery_available_success' => esc_html__( 'Delivery is available', 'foodbooklite' ),
      'delivery_available_error'   => esc_html__( 'Sorry, We are not available to delivery in your area', 'foodbooklite' ),
      'dp_date_text'       => esc_html__( 'Deliver/Pickup Date', 'foodbooklite' ),
      'dp_time_text'       => esc_html__( 'Deliver/Pickup Time', 'foodbooklite' ),
      'dp_today_text'      => esc_html__( 'Today Delivery/Pickup', 'foodbooklite' ),
      'dp_schedule_text'   => esc_html__( 'Schedule Delivery/Pickup', 'foodbooklite' )
    ];

  }


}
