<?php
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Foodbook
	* @Version     : 1.0
	* @Author 	   : ThemeLooks
	* @Author URI  : https://www.themelooks.com/
	*
	*/

	/**
	*
	* Define constant
	*
	*/
	// Base URI
	if( !defined( 'FOODBOOK_THEME_DIR_URI' ) ){
		define( 'FOODBOOK_THEME_DIR_URI',get_template_directory_uri().'/' );
	}

	// Css Assist URI
	if( !defined( 'FOODBOOK_THEME_CSS_DIR_URI' ) ){
		define( 'FOODBOOK_THEME_CSS_DIR_URI',FOODBOOK_THEME_DIR_URI.'assets/css/' );
	}

	// Img Assist URI
	if( !defined('FOODBOOK_IMG_DIR_URI' ) ){
		define( 'FOODBOOK_IMG_DIR_URI',FOODBOOK_THEME_DIR_URI.'assets/img/' );
	}

	// Js Assist URI
	if( !defined( 'FOODBOOK_JS_DIR_URI' ) ){
		define( 'FOODBOOK_JS_DIR_URI',FOODBOOK_THEME_DIR_URI.'assets/js/' );
	}

	// Plugin Assist URI
	if( !defined( 'FOODBOOK_PLUGINS_DIR_URI' ) ){
		define( 'FOODBOOK_PLUGINS_DIR_URI',FOODBOOK_THEME_DIR_URI.'assets/plugins/' );
	}


	// Base Directory
	if( !defined( 'FOODBOOK_THEME_DIR_PATH' ) ){
		define( 'FOODBOOK_THEME_DIR_PATH', get_parent_theme_file_path().'/' );
	}

	// Inc Folder Directory
	if( !defined( 'FOODBOOK_INC_DIR_PATH' ) ){
		define( 'FOODBOOK_INC_DIR_PATH',FOODBOOK_THEME_DIR_PATH.'inc/' );
	}

	// Demo Data Folder Directory Path
	if( !defined( 'FOODBOOK_DEMO_DIR_PATH' ) ){
		define( 'FOODBOOK_DEMO_DIR_PATH', FOODBOOK_INC_DIR_PATH.'demo-data/' );
	}

	// Demo Data Folder Directory URI
	if( !defined( 'FOODBOOK_DEMO_DIR_URI' ) ){
		define( 'FOODBOOK_DEMO_DIR_URI', FOODBOOK_THEME_DIR_URI.'inc/demo-data/' );
	}

	// Hooks Folder Directory
	if( !defined( 'FOODBOOK_HOOKS_DIR_PATH' ) ){
		define( 'FOODBOOK_HOOKS_DIR_PATH',FOODBOOK_INC_DIR_PATH.'hooks/' );
	}

	// Foodbook Framework Folder Directory
	if( !defined( 'FOODBOOK_FRAMEWORK_DIR_PATH' ) ){
		define( 'FOODBOOK_FRAMEWORK_DIR_PATH',FOODBOOK_INC_DIR_PATH.'foodbook-framework/' );
	}

	// Foodbook Theme Support
	if( !defined( 'FOODBOOK_THEME_SUPPORT_DIR_PATH' ) ){
		define( 'FOODBOOK_THEME_SUPPORT_DIR_PATH',FOODBOOK_INC_DIR_PATH.'theme-support/' );
	}

	/**
	* Include File
	*
	*/
	require_once( FOODBOOK_INC_DIR_PATH.'foodbook-breadcrumb.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'foodbook-commoncss.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'foodbook-functions.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'wp-html-helper.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'foodbook-widget/foodbook-widgets.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'redux-custom-field/fa-icons.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'redux-custom-field/foodbook-option-slide-add-field.php' );

	/**
	* Style And Script Add File
	*/
	require_once( FOODBOOK_THEME_SUPPORT_DIR_PATH.'foodbook-style-script.php' );

	/**
	* Hook File
	*/
	require_once( FOODBOOK_HOOKS_DIR_PATH.'hooks.php' );
	require_once( FOODBOOK_HOOKS_DIR_PATH.'hooks-functions.php' );

	/**
	* WooCommerce File
	*/
	require_once( FOODBOOK_INC_DIR_PATH.'foodbook-woo-hooks.php' );
	require_once( FOODBOOK_INC_DIR_PATH.'foodbook-woo-hooks-functions.php' );

	/**
	* Plugin File
	*/
	require_once( FOODBOOK_FRAMEWORK_DIR_PATH.'plugin-activation/active-plugins.php' );
	require_once( FOODBOOK_FRAMEWORK_DIR_PATH.'foodbook-options/foodbook-options.php' );
	require_once( FOODBOOK_FRAMEWORK_DIR_PATH.'foodbook-meta/foodbook-meta.php' );


	/**
	* Demo Data
	*/
	if( class_exists( 'FoodBook' ) ){
		$foodbook_plugin_license = get_option( 'foodbook_plugin_lic_Key' );
		if( ! empty( $foodbook_plugin_license ) ){
			require_once( FOODBOOK_DEMO_DIR_PATH.'demo-import.php' );
		}
	}