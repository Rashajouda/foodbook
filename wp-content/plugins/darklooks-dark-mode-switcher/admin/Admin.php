<?php
namespace Darklooks\Admin;
/**
 * Darklooks admin class
 *
 * @package     Darklooks
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Admin {

    function __construct() {

      add_action( 'admin_menu', [$this, 'addMenuPage'] );
      add_action( 'admin_init', [ $this, 'registerSetting'] );
      add_action( 'admin_enqueue_scripts', [$this, 'enqueueScripts'] ); 
    }

    public function enqueueScripts( $hooks ) {

        if( $hooks != 'toplevel_page_darklooks-setting-admin' ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_media();

        wp_enqueue_style( 'darklooks-style', DARKLOOKS_DIR_ADMIN_ASSETS.'css/style.css', array(), '1.0.0', false );
        wp_enqueue_script( 'ace-editor-js', '//' . 'cdnjs' . '.cloudflare' . '.com/ajax/libs/ace/1.4.12/ace.js', array('jquery'), '1.0', true );
        wp_enqueue_script( 'darklooks-script', DARKLOOKS_DIR_ADMIN_ASSETS.'js/script.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
    }

    public function addMenuPage() {
        // This page will be under "Settings"
        add_menu_page(
            esc_html__( 'DarkLooks', 'darklooks' ),
            esc_html__( 'DarkLooks', 'darklooks' ),
            'manage_options',
            'darklooks-setting-admin',
            array( $this, 'settingPageContent' ),
            esc_url( DARKLOOKS_DIR_ADMIN_ASSETS.'img/logo-icon.png' ),
            6
        );
        add_submenu_page( 'darklooks-setting-admin', esc_html__( 'DarkLooks Settings', 'darklooks' ), esc_html__( 'Settings', 'darklooks' ),'manage_options', 'darklooks-setting-admin');
        add_submenu_page(
            'darklooks-setting-admin',
            esc_html__( 'Recommended Plugins', 'darklooks' ), //page title
            esc_html__( 'Recommended Plugins', 'darklooks' ), //menu title
            'manage_options', //capability,
            'darklooks-recommended-plugin',//menu slug
            array( __CLASS__, 'recommended_plugin_submenu_page' ) //callback function
            
        );
        
    }
    public function registerSetting() {
        //register our settings
        register_setting( 'darklooks-settings-group', DARKLOOKS_OPTION_NAME );
    }
    public function settingPageContent() {

        // check if the user have submitted the settings
        if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'darklooks_messages', 'darklooks_message', esc_html__( 'Settings Saved', 'darklooks' ), 'updated' );
        }
        // show error/update messages
        settings_errors( 'darklooks_messages' );

        // Admin page form
        Admin_Template::getForm();

    }
    
    public static function recommended_plugin_submenu_page() {
        echo '<div class="dl-main-wrapper" style="margin-top: 50px;">';
            \Darklooks\Orgaddons\Org_Addons::getOrgItems();
        echo '</div>';
    }
}