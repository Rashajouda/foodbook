<?php
/**
 * Enqueue scripts
 * @return 
 * 
 */

add_action( 'wp_enqueue_scripts', 'foodbooklite_enqueue_scripts' );
function foodbooklite_enqueue_scripts() {

    $getText = \FoodBookLite\Inc\Text::getText();
    $options = get_option('foodbooklite_options');

    $branch_manager_page  = !empty( $options['branch-manager'] ) ? $options['branch-manager'] : 'branch-manager';
    $kitchen_manager_page = !empty( $options['kitchen-manager'] ) ? $options['kitchen-manager'] : 'kitchen-manager';
    $delivery_page        = !empty( $options['delivery'] ) ? $options['delivery'] : 'delivery';
    $availabilityCheckerModal = !empty( $options['availability-checker-modal'] ) ? $options['availability-checker-modal'] : 'no';
    $autoreload           = !empty( $options['page-autoreload'] ) ? $options['page-autoreload'] : '6';
    $audioLoop            = !empty( $options['audio-loop'] ) ? $options['audio-loop'] : 'no';
    $notificationAudio    = !empty( $options['notification-audio'] ) ? $options['notification-audio'] : FOODBOOKLITE_DIR_URL.'assets/the-little-dwarf-498.mp3';


    // Is custom admin pages
    $is_page = false;
    if( is_page( array( $branch_manager_page, $kitchen_manager_page, $delivery_page ) ) ) {
        $is_page = true;
    }

    // Is manager pages
    $is_manager_page = false;
    if( is_page( array( $branch_manager_page, $kitchen_manager_page ) ) ) {
        $is_manager_page = true;
    }

    // Check manager template
    $managerType = '';
    if( is_page( $kitchen_manager_page ) ) {
        $managerType = 'kitchen-manager';
    } elseif ( is_page( $branch_manager_page ) ) {
        $managerType = 'branch-manager';
    }

    //  Style enqueue
    wp_enqueue_style( 'fb-font-awesome', FOODBOOKLITE_DIR_URL.'assets/css/font-awesome.min.css', array(), '4.7.0', 'all' );
    wp_enqueue_style( 'datatables', FOODBOOKLITE_DIR_URL.'assets/css/datatables.css', array(), '1.10.18', 'all' );
    wp_enqueue_style( 'fbMyAccount', FOODBOOKLITE_DIR_URL.'assets/css/fbMyAccount.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'foodbooklite', FOODBOOKLITE_DIR_URL.'assets/css/app.css', array(), '1.0.0', 'all' );

    wp_enqueue_script( 'datatables', FOODBOOKLITE_DIR_URL.'assets/js/datatables.js', array('jquery' ), '1.10.18', true );
    wp_enqueue_script( 'foodbooklite-print', FOODBOOKLITE_DIR_URL.'assets/js/jQuery.print.js', array('jquery' ), '1.0.0', true );
    wp_enqueue_script( 'foodbooklite', FOODBOOKLITE_DIR_URL.'assets/js/foodbooklite.js', array('jquery', 'wp-util','underscore', 'jquery-ui-datepicker','jquery-effects-core' ), '1.0.0', true );

    wp_localize_script(
        'foodbooklite', 
        'foodbookliteobj', 
        array(

            "ajaxurl"               => admin_url('admin-ajax.php'), 
            'currency'              => get_woocommerce_currency_symbol(), 
            'currency_pos'          => get_option( 'woocommerce_currency_pos' ), 
            'is_page_custom_admin'  => $is_page, 
            'is_manager_page'       => $is_manager_page,
            'managerType'           => $managerType,
            'page_auto_reload_time' => $autoreload, 
            'is_login'              => is_user_logged_in(),
            'woo_guest_user_allow'  => get_option('woocommerce_enable_guest_checkout'), 
            'cart_url'              => wc_get_checkout_url(), 
            'view_cart_btn_text'    => esc_html( $getText['view_cart'] ), 
            'buy_more_btn_text'     => esc_html( $getText['buy_more'] ),
            'dont_cart_msg'         => esc_html( $getText['cart_added_error'] ), 
            'review_failed_alert'   => esc_html( $getText['review_error_msg'] ),
            'review_success_alert'  => esc_html( $getText['review_success_msg'] ),
            'show_more'             => esc_html( $getText['show_more'] ),
            'less'                  => esc_html( $getText['show_less'] ),
            'loading'               => esc_html( $getText['loading'] ),
            'start_order'           => esc_html( $getText['start_order'] ),
            'is_checkout'           => is_checkout(),
            'is_multi_branch'       => foodbooklite_is_multi_branch(),
            'characters'            => !empty( $options['desc-characters'] ) ? $options['desc-characters'] : '100',
            'order_notification_text'   => esc_html( $getText['new_order_placed'] ),
            'wc_decimal_separator'      => wc_get_price_decimal_separator(),
            'wc_thousand_separator'     => wc_get_price_thousand_separator(),
            'price_decimals'            => wc_get_price_decimals(),
            'noti_audio_loop'           => $audioLoop,
            'is_location_type_address'  => foodbooklite_is_location_type_address(),
            'notification_audio'        => $notificationAudio
            
                
        ) 
    );


    /**
     * Inline css for custom style
     *  
     */

  
    $mainColor = !empty( $options['main-color'] ) ? esc_html( $options['main-color'] ) : '';

    // Order Button
    $btnBgColor = !empty( $options['btn-bg-color'] ) ? esc_html( $options['btn-bg-color'] ) : '';
    $btnColor = !empty( $options['btn-color'] ) ? esc_html( $options['btn-color'] ) : '';
    $btnHoverBgColor = !empty( $options['btn-hover-bg-color'] ) ? esc_html( $options['btn-hover-bg-color'] ) : '';
    $btnHoverColor = !empty( $options['btn-hover-color'] ) ? esc_html( $options['btn-hover-color'] ) : '';

    // Global Button
    $gobBtnBgColor        = !empty( $options['gob-btn-bg-color'] ) ? esc_html( $options['gob-btn-bg-color'] ) : '';
    $gobBtnColor          = !empty( $options['gob-btn-color'] ) ? esc_html( $options['gob-btn-color'] ) : '';
    $gobBtnHoverBgColor   = !empty( $options['gob-btn-hover-bg-color'] ) ? esc_html( $options['gob-btn-hover-bg-color'] ) : '';
    $gobBtnHoverColor     = !empty( $options['gob-btn-hover-color'] ) ? esc_html( $options['gob-btn-hover-color'] ) : '';

    $cartBtnBg         = !empty( $options['cart-btn-bg'] ) ? esc_html( $options['cart-btn-bg'] ) : '';
    $cartBtnCountBg    = !empty( $options['cart-btn-count-bg'] ) ? esc_html( $options['cart-btn-count-bg'] ) : '';
    $cartBtnCountColor = !empty( $options['cart-btn-count-color'] ) ? esc_html( $options['cart-btn-count-color'] ) : '';

    $categoryItemOddBg    = !empty( $options['category-item-odd-bg'] ) ? esc_html( $options['category-item-odd-bg'] ) : '';
    $categoryItemColor = !empty( $options['category-item-color'] ) ? esc_html( $options['category-item-color'] ) : '';

    $matBg              = !empty( $options['mat-bg'] ) ? esc_html( $options['mat-bg'] ) : '';
    $matTextColor       = !empty( $options['mat-text-color'] ) ? esc_html( $options['mat-text-color'] ) : '';
    $matHoverBg         = !empty( $options['mat-hover-bg'] ) ? esc_html( $options['mat-hover-bg'] ) : '';
    $matHoverTextColor  = !empty( $options['mat-hover-text-color'] ) ? esc_html( $options['mat-hover-text-color'] ) : '';

    $custom_css = "
            .fb_category_list .fb_category_item .fb_category_quantity:before,
            .fb_custom_checkbox label .fb_custom_checkmark:after,
            .fb_pagination_list .fb_pagination_list_item.active, 
            .fb_pagination_list .fb_pagination_list_item:hover,
            .fb_single_product_item .fb_product_top .fb_badge {
                background-color: {$mainColor};
            }
            .fb_category_list .fb_category_item .fb_category_quantity,
            .fb_pagination_list .fb_pagination_list_item,
            .fb_custom_checkbox label input:checked~.fb_input_text, 
            .fb_custom_checkbox label input:checked~.fb_label_title .fb_input_text {
                color: {$mainColor};
            }
            .fb_custom_checkbox label input:checked~.fb_custom_checkmark,
            .fb_pagination_list .fb_pagination_list_item {
                border-color: {$mainColor};
            }
            .fb_order_button {
                background-color: {$btnBgColor};
                color: {$btnColor};
            }
            .fb_order_button:hover {
                background-color: {$btnHoverBgColor};
                color: {$btnHoverColor};
            }
            .fb_btn_fill:not(.toggle) {
                background-color: {$gobBtnBgColor};
                color: {$gobBtnColor};
            }
            .fb_btn_fill:not(.toggle):active, 
            .fb_btn_fill:not(.toggle):focus, 
            .fb_btn_fill:not(.toggle):hover {
                background-color: {$gobBtnHoverBgColor};
                color: {$gobBtnHoverColor};
            }
            .fb_cart_count_btn {
                background-color: {$cartBtnBg}
            }
            .fb_cart_count {
                background-color: {$cartBtnCountBg};
                color: {$cartBtnCountColor}
            }
            .fb_category_list .fb_category_item:nth-of-type(odd) {
                background-color: {$categoryItemOddBg}
            }
            .fb_category_list .fb_category_item {
                color: {$categoryItemColor}
            }
            .foodbooklite-checkout .woocommerce-MyAccount-navigation {
                background-color: {$matBg};
            }
            .foodbooklite-checkout .woocommerce-MyAccount-navigation ul li a {
                color: {$matTextColor}
            }
            .foodbooklite-checkout .woocommerce-MyAccount-navigation ul li.is-active > a, 
            .foodbooklite-checkout .woocommerce-MyAccount-navigation ul li:hover > a {
                background-color: {$matHoverBg};
                color: {$matHoverTextColor}
            }
            ";




    //
    wp_enqueue_style(
        'custom-style',
        FOODBOOKLITE_DIR_URL.'assets/css/custom.css'
    );
    wp_add_inline_style( 'custom-style', $custom_css );


}