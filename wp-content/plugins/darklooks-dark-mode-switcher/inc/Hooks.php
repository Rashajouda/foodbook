<?php
namespace Darklooks\Inc;
/**
 *
 * @package     Darklooks
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Hooks {

	/**
	 * [getHooked description]
	 * @return [type] [description]
	 */
	public static function getHooked() {
		add_action( 'wp_footer', [ __CLASS__, 'modeSwitcherMarkup' ] );
		add_action( 'wp_head', [ __CLASS__, 'getCustomCSS' ] );
		add_filter( 'wp_nav_menu_items', [ __CLASS__, 'add_mode_switch_in_menu' ], 10, 2 );
	}

	/**
	 * Mode changer switch hooked in footer to show in frontend
	 * @since  1.0.0
	 * @return void
	 */
	public static function modeSwitcherMarkup() {
		
		if( !Helper::getOptionValue('darkmode_floating_switch') ) {
			return;
		}

	    $position = Helper::getOptionValue('switcher_position');
		echo '<div class="floating-mode-switcher-wrap floating-'.esc_attr( $position ).'">'.Mode_Switch::getSwitch().'</div>';
	}
	/**
     * showMode change switch in menu
     *
     * @since  1.0.0
     * @param html $items, array $args
     * @return void
     * 
     */
	public static function add_mode_switch_in_menu( $items, $args ) {

		if( !Helper::getOptionValue('mode_switch_menu') ) {
			return $items;
		}

		$location    = Helper::getOptionValue('switch_menu_location');
		if( !empty( $location ) && in_array( $args->theme_location, $location ) ){
		  $items .= '<li class="menu-mode-switch">'.Mode_Switch::getSwitch().'</li>';
		}
		return $items;
	}
	/**
	 * Custom css
	 * getCustomCSS method hooked in wp_head
	 * 
	 * @since  1.0.0
	 * @return void
	 * 
	 */
	public static function getCustomCSS() {
		if( !empty( Helper::getOptionValue('darklooks_custom_css') ) ) {
			echo '<style type="text/css">';
				echo apply_filters( 'darklooks_custom_css', Helper::getOptionValue('darklooks_custom_css') );
			echo '</style>';
		}
		
	}

}