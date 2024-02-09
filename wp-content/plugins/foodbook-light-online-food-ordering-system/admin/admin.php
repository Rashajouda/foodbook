<?php
namespace FoodBookLite;
/**
 * FoodBookLite admin class
 *
 * @package     FoodBookLite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

if( !class_exists('Admin') ) {
	class Admin {

		private static $instance = null;

		function __construct() {
			add_action( 'admin_enqueue_scripts', [ __CLASS__, 'admin_scripts' ] );
			self::include_file();
		}
		public static function getInstance() {

			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
		public static function admin_scripts( $hooks ) {


			if( 'toplevel_page_foodbooklite' !== $hooks && 'foodbooklite_page_foodbooklite-branch-order' !== $hooks ) {
				return;
			}
			
			$getText = \FoodBookLite\Inc\Text::getText();

			// WP Admin branch order page
			$isBranchOrder = false;

			$getAdminSlug = strstr( $hooks, 'foodbooklite-branch-order' );

			if( $getAdminSlug == 'foodbooklite-branch-order' ) {
				$isBranchOrder = true;
			}

			$options = get_option('foodbooklite_options');

			$delay_time = !empty( $options['page-autoreload'] ) ? $options['page-autoreload'] : '6';
			$audioLoop            = !empty( $options['audio-loop'] ) ? $options['audio-loop'] : 'no';
    		$notificationAudio    = !empty( $options['notification-audio'] ) ? $options['notification-audio'] : FOODBOOKLITE_DIR_URL.'assets/the-little-dwarf-498.mp3';
    		$locationType = !empty( $options['location_type'] ) ? $options['location_type'] : '';

			// 
			wp_enqueue_media();
			// Add the color picker css file       
        	wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_style( 'datatables-admin', plugin_dir_url( __FILE__ ). 'assets/datatables.css', array(), '1.0.0', false );
			wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ). 'assets/font-awesome.min.css', array(), '5.13.0', false );
			wp_enqueue_style( 'mdtimepicker', plugin_dir_url( __FILE__ ). 'assets/mdtimepicker.css', array(), '1.0.0', false );
			wp_enqueue_style( 'foodbooklite-admin', plugin_dir_url( __FILE__ ). 'assets/admin.css', array(), '1.0.0', false );
			wp_enqueue_script( 'foodbooklite-print', plugin_dir_url( __FILE__ ). 'assets/jQuery.print.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'mdtimepicker', plugin_dir_url( __FILE__ ). 'assets/mdtimepicker.min.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'datatables-admin', plugin_dir_url( __FILE__ ). 'assets/datatables.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'foodbooklite-admin', plugin_dir_url( __FILE__ ). 'assets/admin.js', array('jquery', 'jquery-ui-datepicker', 'wp-color-picker'), '1.0.0', true );
			
			wp_localize_script(
				'foodbooklite-admin', 
				'adminFoodbookliteobj', 
				array(
					"ajaxurl" 		=> admin_url('admin-ajax.php'),
					"currency" 		=> get_woocommerce_currency_symbol(),
					"currency_pos" 	=> get_option( 'woocommerce_currency_pos' ),
					"is_branch_order" 	=> $isBranchOrder,
					"order_notification_delay_time" => $delay_time,
					'noti_audio_loop'       => $audioLoop,
            		'notification_audio'    => $notificationAudio,
					'order_notification_text'   => esc_html( $getText['new_order_placed'] ),
					'location_type'   => esc_html( $locationType )
				) 
			);

		}
		public static function include_file() {

			/**
			 * Include files
			 *
			 */ 

			require_once( FOODBOOKLITE_DIR_ADMIN.'inc/class-admin-menu.php' );
			require_once( FOODBOOKLITE_DIR_ADMIN.'inc/admin-template.php' );


		}

	}

	Admin::getInstance();
}
