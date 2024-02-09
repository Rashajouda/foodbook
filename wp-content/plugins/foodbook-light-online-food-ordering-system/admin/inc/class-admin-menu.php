<?php
namespace FoodBookLite;

/**
 * foodbooklite admin class
 *
 * @package     Foodbooklite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

if( !class_exists('Admin_Menu') ) {
	class Admin_Menu {

		private static $instance = null;

		function __construct() {
			
			add_action( 'admin_menu', array( __CLASS__, 'admin_menu_page' ) );
			add_action( 'admin_init', array( __CLASS__, 'page_settings_init' ) );

		}

		public static function getInstance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public static function admin_menu_page() {

			// add top level menu page
			add_menu_page(
				esc_html__( 'Foodbooklite Settings', 'foodbooklite' ),
				esc_html__( 'Foodbooklite', 'foodbooklite' ),
				'manage_options',
				'foodbooklite',
				array( __CLASS__, 'admin_view' )
			);
			add_submenu_page( 'foodbooklite', esc_html__( 'Foodbooklite Settings', 'foodbooklite' ), esc_html__( 'Settings', 'foodbooklite' ),'manage_options', 'foodbooklite');
			do_action('foodbooklite_admin_menu');
			add_submenu_page(
		        'foodbooklite',
		        esc_html__( 'Order Manage', 'foodbooklite' ), //page title
		        esc_html__( 'Orders', 'foodbooklite' ), //menu title
		        'manage_options', //capability,
		        'foodbooklite-branch-order',//menu slug
		        array( __CLASS__, 'branch_order_submenu_page' ) //callback function
		    );
	        add_submenu_page(
	            'foodbooklite',
	            esc_html__( 'Recommended Plugins', 'foodbooklite' ), //page title
	            esc_html__( 'Recommended Plugins', 'foodbooklite' ), //menu title
	            'manage_options', //capability,
	            'foodbooklite-recommended-plugin',//menu slug
	            array( __CLASS__, 'recommended_plugin_submenu_page' ) //callback function
	            
	        );


		}

		public static function recommended_plugin_submenu_page() {
	        echo '<div class="dl-main-wrapper" style="margin-top: 50px;">';
	            \FoodBookLite\Orgaddons\Org_Addons::getOrgItems();
	        echo '</div>';
    	}

		public static function admin_view() {

			$Admin_Templates = new Admin_Templates_Map();	

			$Admin_Templates->admin_page_init();		

		}
		public static function page_settings_init() {
			register_setting(
	            'foodbooklite_settings_option_group', // Option group
	            'foodbooklite_options' // Option name
	        );  
		}

		public static function branch_order_submenu_page() {
			// 
			echo '<div class="admin-promo-wrapper"><div class="fbl-overlay"><div class="fbl-promo-inner"><h3>Order management system is a pro version features </h3><a href="'.esc_url( FOODBOOK_PRO_URL ).'" class="button button-primary fbl-buy" target="_blank">Buy Now</a></div></div><img src="'.FOODBOOKLITE_DIR_ADMIN_ASSETS_URL.'admin-manager.png" /></div>';
		}

	}

	Admin_Menu::getInstance();
}