<?php
	/**
	 * Plugin Name: Foodbook Core
	 * Description: This is a helper plugin of foodbook theme
	 * Version:     1.0.1
	 * Author:      Themelooks
	 * Author URI:  https://themelooks.com
	 * License:     GPL2
	 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
	 * Domain Path: /languages
	 * Text Domain: foodbook
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	// Define Constant
	define( 'FOODBOOK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

	define( 'FOODBOOK_PLUGINURL', plugin_dir_url( __FILE__) );

	define( 'FOODBOOK_PLUGIN_TEMP', dirname( __FILE__ ).'/foodbook-template/' );

	define('FOODBOOK_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );
	// load textdomain
	load_plugin_textdomain( 'foodbook', false, basename( dirname( __FILE__ ) ) . '/languages' );

	// include file.
	require_once dirname( __FILE__ ) . '/inc/about-us.php';
	require_once dirname( __FILE__ ) . '/inc/contact-widgets.php';
	require_once dirname( __FILE__ ) . '/inc/newsletter-widget.php';
	require_once dirname( __FILE__ ) . '/inc/recent-post-widget.php';
	require_once dirname( __FILE__ ) . '/inc/MailChimp.php';
	require_once dirname( __FILE__ ) . '/inc/foodbook-functions.php';
	require_once dirname( __FILE__ ) . '/inc/cmb2-tabs.php';
	require_once dirname( __FILE__ ) . '/addons/addons.php';

	define('CMB2_EXT', dirname( __FILE__ ).'/cmb2-ext/' );

	require_once( CMB2_EXT . 'cmb2-icon-picker.php' );
	require_once( CMB2_EXT . 'slider-meta-field.php' );
	require_once( CMB2_EXT . 'switch_metafield.php' );

	/** ADDITIONAL JS */
	function foodbook_additional_script(){
		wp_enqueue_script( 'custom', FOODBOOK_PLUGINURL . 'assets/js/foodbook-core.js', array( 'jquery' ), '', true );
	}
	add_action( 'admin_enqueue_scripts','foodbook_additional_script' );

	function foodbook_additional_frontend_script(){
		$apiKey = foodbook_opt( 'foodbook_map_apikey' );

		if( $apiKey ){
			wp_enqueue_script( 'maps-googleapis', 'https://maps.googleapis.com/maps/api/js?key='.$apiKey );
		}

	}
	add_action( 'wp_enqueue_scripts','foodbook_additional_frontend_script');