<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : foodbook
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 */

// demo import file
function foodbook_import_files() {

    return array(
        array(
            'import_file_name'             => esc_html__('Single Branch Demo','foodbook'),
            'local_import_file'            =>  FOODBOOK_DEMO_DIR_PATH  . 'single-branch/foodbook-demo.xml',
            'local_import_widget_file'     =>  FOODBOOK_DEMO_DIR_PATH  . 'single-branch/foodbook-widgets-demo.json',
            'local_import_redux'           => array(
                array(
                    'file_path'   =>  FOODBOOK_DEMO_DIR_PATH . 'single-branch/redux_options_demo.json',
                    'option_name' => 'foodbook_opt',
                ),
            ),
            'import_preview_image_url' => get_theme_file_uri('/inc/demo-data/single-branch/screen-image.png'),
        ),
        array(
            'import_file_name'             => esc_html__( 'Multi Branch Demo', 'foodbook' ),
            'local_import_file'            => trailingslashit( FOODBOOK_DEMO_DIR_PATH ) . 'multi-branch/foodbook-demo.xml',
            'local_import_widget_file'     => trailingslashit( FOODBOOK_DEMO_DIR_PATH ) . 'multi-branch/foodbook-widgets-demo.json',
            'local_import_redux'           => array(
                array(
                  'file_path'   => trailingslashit( FOODBOOK_DEMO_DIR_PATH ) . 'multi-branch/redux_options_demo.json',
                  'option_name' => 'foodbook_opt',
                ),
           ),
           'import_preview_image_url'     => get_theme_file_uri('/inc/demo-data/multi-branch/screen-image.png'),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'foodbook_import_files' );

// demo import setup
function foodbook_after_import_setup( $selected_import ) {
    if ( 'Single Branch Demo' === $selected_import['import_file_name'] ) {
        $main_menu     = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    	$mobile_menu   = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
    	$footer_menu   = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    	set_theme_mod( 'nav_menu_locations', array(
    			'primary-menu'   => $main_menu->term_id,
    			'mobile-menu'    => $mobile_menu->term_id,
    			'footer-menu'    => $footer_menu->term_id,
    		)
    	);
        // Assign front page and posts page (blog page).
    	$front_page_id 	       = get_page_by_title( 'Home' );
    	$blog_page_id  	       = get_page_by_title( 'Blog' );
    	$shop_page_id  		   = get_page_by_title( 'Shop' );
    	$cart_page_id  		   = get_page_by_title( 'Cart' );
    	$checkout_page_id      = get_page_by_title( 'Checkout' );
    	$myaccount_page_id     = get_page_by_title( 'My account' );

    	update_option( 'show_on_front', 'page' );
    	update_option( 'page_on_front', $front_page_id->ID );
    	update_option( 'page_for_posts', $blog_page_id->ID );
    	update_option( 'woocommerce_shop_page_id' ,$shop_page_id->ID );
    	update_option( 'woocommerce_cart_page_id' ,$cart_page_id->ID );
    	update_option( 'woocommerce_checkout_page_id' ,$checkout_page_id->ID );
    	update_option( 'woocommerce_myaccount_page_id' ,$myaccount_page_id->ID );

	}elseif ( 'Multi Branch Demo' === $selected_import['import_file_name'] ) {
        $main_menu     = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    	$mobile_menu   = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
    	$footer_menu   = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    	set_theme_mod( 'nav_menu_locations', array(
    			'primary-menu'   => $main_menu->term_id,
    			'mobile-menu'    => $mobile_menu->term_id,
    			'footer-menu'    => $footer_menu->term_id,
    		)
    	);

        // Assign front page and posts page (blog page).
    	$front_page_id 	       = get_page_by_title( 'Home' );
    	$blog_page_id  	       = get_page_by_title( 'Blog' );
    	$shop_page_id  		   = get_page_by_title( 'Shop' );
    	$cart_page_id  		   = get_page_by_title( 'Cart' );
    	$checkout_page_id      = get_page_by_title( 'Checkout' );
    	$myaccount_page_id     = get_page_by_title( 'My account' );

    	update_option( 'show_on_front', 'page' );
    	update_option( 'page_on_front', $front_page_id->ID );
    	update_option( 'page_for_posts', $blog_page_id->ID );
    	update_option( 'woocommerce_shop_page_id' ,$shop_page_id->ID );
    	update_option( 'woocommerce_cart_page_id' ,$cart_page_id->ID );
    	update_option( 'woocommerce_checkout_page_id' ,$checkout_page_id->ID );
    	update_option( 'woocommerce_myaccount_page_id' ,$myaccount_page_id->ID );

	}

}
add_action( 'pt-ocdi/after_import', 'foodbook_after_import_setup' );


//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function foodbook_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Foodbook Demo Import' , 'foodbook' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'foodbook' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'foodbook-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'foodbook_import_plugin_page_setup' );

// Enqueue scripts
function foodbook_demo_import_custom_scripts(){
	if( isset( $_GET['page'] ) && $_GET['page'] == 'foodbook-demo-import' ){
		// style
		wp_enqueue_style( 'foodbook-demo-import', FOODBOOK_DEMO_DIR_URI.'css/foodbook.demo.import.css', array(), '1.0', false );
	}
}
add_action( 'admin_enqueue_scripts', 'foodbook_demo_import_custom_scripts' );