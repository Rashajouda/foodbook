<?php
namespace Darklooks\Admin\Templates;
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

class General_Setting extends \Darklooks\Admin\Inc\Controller_Base {

	public function getTitle() {
		return esc_html__( 'General Setting', 'darklooks' );
	}
    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-1.svg';
    }

	public function registerControls() {
        // Section Header
        $this->header();
        
        $this->getSwitcherController([
            'title'     => esc_html__( 'Enable Frontend Darkmode', 'darklooks' ),
            'sub_title' => esc_html__( 'Enable the frontend darkmode.', 'darklooks' ),
            'name'      => 'frontend_darkopt',
        ]);
        $this->getSwitcherController([
            'title'     => esc_html__( 'Enable OS Dark Mode', 'darklooks' ),
            'sub_title' => esc_html__( 'Enable OS dark mode to support dark mode in OS device.', 'darklooks' ),
            'name'      => 'os_darkopt',
        ]);
        $this->getSwitcherController([
            'title'     => esc_html__( 'Enable Mode Changing Floating Switch', 'darklooks' ),
            'sub_title' => esc_html__( 'Show the mode changing floating switcher button on the frontend for the users.', 'darklooks' ),
            'name'      => 'darkmode_floating_switch',
        ]);

        // Section Footer
        $this->footer();
	}
}

$obj = new General_Setting();