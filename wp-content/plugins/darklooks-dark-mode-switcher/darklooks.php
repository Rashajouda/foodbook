<?php
/**
 * Plugin Name:       DarkLooks - Dark Mode Switcher For WordPress
 * Plugin URI:        https://themelooks.org/demo/staraddons
 * Description:       A dark mode switching WordPress plugin with various settings.
 * Version:           1.0.6
 * Author:            ThemeLooks
 * Author URI:        https://themelooks.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       darklooks
 * Domain Path:       /languages
 *
 */


// Constant for version 
if( !defined( 'DARKLOOKS_VERSION' ) ) {
	define( 'DARKLOOKS_VERSION', '1.0.6' );
}

// Set option name constant
if( !defined( 'DARKLOOKS_OPTION_NAME' ) ) {
	define( 'DARKLOOKS_OPTION_NAME', 'darklooks_options' );
}
// Constant for plugin dir path
if( !defined( 'DARKLOOKS_DIR_PATH' ) ) {
	define( 'DARKLOOKS_DIR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}
// Constant for plugin dir url
if( !defined( 'DARKLOOKS_DIR_URL' ) ) {
	define( 'DARKLOOKS_DIR_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}
// Constant for assets dir url
if( !defined( 'DARKLOOKS_DIR_ASSETS_URL' ) ) {
	define( 'DARKLOOKS_DIR_ASSETS_URL', trailingslashit( DARKLOOKS_DIR_URL.'assets' ) );
}
// Constant for admin dir path
if( !defined( 'DARKLOOKS_DIR_ADMIN' ) ) {
	define( 'DARKLOOKS_DIR_ADMIN', trailingslashit( DARKLOOKS_DIR_PATH.'admin' ) );
}

// Constant admin assets dir url
if( !defined( 'DARKLOOKS_DIR_ADMIN_ASSETS' ) ) {
	define( 'DARKLOOKS_DIR_ADMIN_ASSETS', trailingslashit( DARKLOOKS_DIR_URL.'admin/assets' ) );
}

// Include autoloader
require_once( DARKLOOKS_DIR_PATH.'vendor/autoload.php' );

final class Darklooks {

	private static $instance;

	function __construct() {

		// Plugin uninstall hook
		register_uninstall_hook( __FILE__, [ __CLASS__, 'uninstallationFlag' ] );
		// Plugin activation hook
		register_activation_hook( __FILE__, [ __CLASS__, 'flagOnPluginActivation' ] );
		// Call setup method
		self::setup();
	}

	public static function getInstance() {

		if( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;

	}
	public static function setup() {
		self::createClassesInstance();
		self::objectInitialize();
		
	}
	private static function objectInitialize() {
		// Class Enqueue
		new Darklooks\Inc\Enqueue();
		// Class Hooks
		Darklooks\Inc\Hooks::getHooked();
	}
	private static function createClassesInstance() {
		// Admin class instance
		new Darklooks\Admin\Admin();
	}

	public static function flagOnPluginActivation() {

		if( !empty( get_option(DARKLOOKS_OPTION_NAME) ) ) {
			return;
		}

		$setOption = [
			'frontend_darkopt'			=> 'yes',
			'darkmode_floating_switch' 	=> 'yes',
			'mode_switch_style' 		=> 'switcher1',
			'switcher_position' 		=> 'bottom-right',
			'dark_method_type' 			=> 'color_set',
			'dark_mode_color_type' 		=> 'preset',
			'frontend_color_preset' 	=> 'color1',
		];

		update_option( DARKLOOKS_OPTION_NAME, $setOption );

	}

	public static function uninstallationFlag() {
		delete_option(DARKLOOKS_OPTION_NAME);
	}

}

/**
 *  Init DarkLooks
 */
Darklooks::getInstance();
