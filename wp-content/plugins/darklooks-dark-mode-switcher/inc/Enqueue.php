<?php
namespace Darklooks\Inc;
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

class Enqueue {

   /**
    * class constructor
    *
    * @since  1.0.0
    * @return void
    */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontendScripts' ) );
    }
   /**
    * Enqueue scripts 
    * 
    * @since  1.0.0
    * @return void
    */
    public static function frontendScripts() {
        // Check is Enable Frontend Darkmode
        if( ! Helper::getOptionValue('frontend_darkopt') ) {
            return;
        }

        wp_enqueue_style( 'darklooks', DARKLOOKS_DIR_ASSETS_URL.'css/darklooks.css', array(), '1.0.0', false );
        wp_enqueue_script( 'darklooks', DARKLOOKS_DIR_ASSETS_URL.'js/darklooks.js', array('jquery'), '1.0', true );
        self::addFrontEndDarkCss();
        
        wp_localize_script( 'darklooks', 'darklooksFrontendObject',
            array(
                'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
                'site_logo'  => Helper::getSiteLogo(),
                'images'     => Helper::getImages(),
                'modetime'   => Helper::modeTimeMaping(),
                'is_os'      => Helper::getOptionValue('os_darkopt')
            )
        );      
        
    }

    public static function addFrontEndDarkCss() {
        $getCSS  = Inline_CSS::getDarkCss();
        wp_add_inline_style( 'darklooks', $getCSS );
    } 

}