<?php
namespace Darklooks\Admin\Templates;
/**
 *
 * @package     Darklooks
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Switch_Setting extends \Darklooks\Admin\Inc\Controller_Base {

    public function getTitle() {
        return esc_html__( 'Switch Setting', 'darklooks' );
    }

    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-3.svg';
    }

    public function registerControls() {
        // Section Header
        $this->header();
        $this->getImageSwitcherController([
            'title'     => esc_html__( 'Mode Changing Switch', 'darklooks' ),
            'sub_title' => esc_html__( 'Select the switche style for the frontend mode changing.', 'darklooks' ),
            'placeholder' => '',
            'name'      => 'mode_switch_style',
            'class'     => '',
            'options' => [
                [
                    'value' => 'switcher1',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/switcher1.png'
                ],
                [
                    'value' => 'switcher2',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/switcher2.png'
                ],
                [
                    'value' => 'switcher3',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/switcher3.png'
                ],
                [
                    'value' => 'switcher4',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/switcher4.png'
                ],
                [
                    'value' => 'switcher5',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/switcher5.png'
                ]
            ]
        ]);
        $this->getSelectController([
            'title'     => esc_html__( 'Switcher Position', 'darklooks' ),
            'sub_title' => esc_html__( 'Select the mode changing switch frontend position.', 'darklooks' ),
            'name'      => 'switcher_position',
            'options'   => [
                'bottom-right' => esc_html__( 'Bottom Right', 'darklooks' ),
                'bottom-left'  => esc_html__( 'Bottom Left', 'darklooks' ),
                'top-right'    => esc_html__( 'Top Right', 'darklooks' ),
                'top-left'     => esc_html__( 'Top Left', 'darklooks' )
            ]
        ]);
        // Section Footer
        $this->footer();
    }
	

}

$obj = new Switch_Setting();