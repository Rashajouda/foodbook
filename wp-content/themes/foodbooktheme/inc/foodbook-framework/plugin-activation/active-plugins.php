<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme foodbook for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
require_once get_template_directory() . '/inc/foodbook-framework/plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'foodbook_register_required_plugins' );


function foodbook_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
            'name'                  => esc_html__( 'Foodbook Core', 'foodbook' ), // The plugin name
            'slug'                  => 'foodbook-core', // The plugin slug (typically the folder name)
            'version'               => '',
            'source'                => FOODBOOK_FRAMEWORK_DIR_PATH . 'plugins/foodbook-core.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
        ),
		array(
            'name'                  => esc_html__( 'Elementor Page Builder', 'foodbook' ), // The plugin name
            'slug'                  => 'elementor', // The plugin slug (typically the folder name)
            'version'               => '',
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
        ),
		array(
            'name'                  => esc_html__( 'Contact Form 7', 'foodbook' ), // The plugin name
            'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
            'version'               => '',
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
		array(
			'name'               	=> 'Redux Framework', // The plugin name.
			'slug'               	=> 'redux-framework', // The plugin slug (typically the folder name).
			'required'           	=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'            	=> '',
		),
		array(
			'name'               	=> 'EnterAddons', // The plugin name.
			'slug'               	=> 'enteraddons', // The plugin slug (typically the folder name).
			'required'           	=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'            	=> '',
		),
		array(
			'name'           		=> 'CMB2', // The plugin name.
			'slug'           		=> 'cmb2', // The plugin slug (typically the folder name).
			'version'   	 		=> '',
			'required'       		=> true,
		),
		array(
			'name'           		=> 'Classic Editor', // The plugin name.
			'slug'           		=> 'classic-editor', // The plugin slug (typically the folder name).
			'version'   	 		=> '',
			'required'       		=> false,
		),
        array(
            'name'      			=> esc_html__( 'One Click Demo Import', 'foodbook'),
            'slug'      			=> 'one-click-demo-import',
            'version'   			=> '',
            'required'  			=> false
		),
		array(
            'name'      			=> esc_html__( 'WooCommerce', 'foodbook'),
            'slug'      			=> 'woocommerce',
            'version'   			=> '',
            'required'  			=> false
        ),
		array(
            'name'      			=> esc_html__( 'DarkLooks', 'foodbook'),
            'slug'      			=> 'darklooks-dark-mode-switcher',
            'version'   			=> '',
            'required'  			=> false
        ),
	);

	$config = array(
		'id'           => 'foodbook',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}