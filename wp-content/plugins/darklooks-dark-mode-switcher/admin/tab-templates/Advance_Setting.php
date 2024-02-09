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

class Advance_Setting extends \Darklooks\Admin\Inc\Controller_Base {

    public function getTitle() {
        return esc_html__( 'Advance Setting', 'darklooks' );
    }

    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-4.svg';
    }

    public function registerControls() {
        // Section Header
        $this->header();
        $this->getNumberController([
            'title'     => esc_html__( 'Dark Mode Body Font Size', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode body text font size.', 'darklooks' ),
            'name'      => 'dark_body_text_font_size'
        ]);
        $this->getSwitcherController([
            'title'     => esc_html__( 'Mode Changing Switch in Menu', 'darklooks' ),
            'sub_title' => esc_html__( 'Mode changing switch show in the menu.', 'darklooks' ),
            'name'      => 'mode_switch_menu',
        ]);
        $this->getMultipleSelectController([
            'title'     => esc_html__( 'Select Menu', 'darklooks' ),
            'sub_title' => esc_html__( 'Set the menu location to show mode changing switch.', 'darklooks' ),
            'name'      => 'switch_menu_location',
            'options'   => \Darklooks\Inc\Helper::getNavMenuLocations()
        ]);
        $this->getTextController([
            'title'     => esc_html__( 'Switch Lite Text', 'darklooks' ),
            'sub_title' => esc_html__( 'Set switch lite text alternative.', 'darklooks' ),
            'name'      => 'switch_lite_text',
        ]);
        $this->getTextController([
            'title'     => esc_html__( 'Switch Dark Text', 'darklooks' ),
            'sub_title' => esc_html__( 'Set switch dark text alternative.', 'darklooks' ),
            'name'      => 'switch_dark_text',
        ]);
        $this->getTextController([
            'title'     => esc_html__( 'Include Elements', 'darklooks' ),
            'sub_title' => esc_html__( 'This will applied when darkmode to the included elements. Add selectors with comma separated (ids,classes,tags) to apply on darkmode.', 'darklooks' ),
            'name'      => 'dark_include_element',
            'placeholder' => 'e.g: .className,div,#id'
        ]);
        $this->getTextController([
            'title'     => esc_html__( 'Exclude Elements', 'darklooks' ),
            'sub_title' => esc_html__( 'This will applied when darkmode to the exclude elements. Add selectors with comma separated (ids,classes,tags) to apply on darkmode.', 'darklooks' ),
            'name'      => 'dark_exclude_element',
            'placeholder' => 'e.g: .className,div,#id'
        ]);
        // Section Footer
        $this->footer();
    }
	

}

$obj = new Advance_Setting();