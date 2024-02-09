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

class Color_Preset extends \Darklooks\Admin\Inc\Controller_Base {

    public function getTitle() {
        return esc_html__( 'Color Preset', 'darklooks' );
    }

    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-5.svg';
    }

    public function registerControls() {
        // Section Header
        $this->header();
        $this->getRadioSwitchController([
            'title'     => esc_html__( 'Color Method Type', 'darklooks' ),
            'sub_title' => esc_html__( 'Set color method Type.', 'darklooks' ),
            'name'      => 'dark_method_type',
            'options'   => [
                'filter' => esc_html__( 'Invert Method', 'darklooks' ),
                'color_set' => esc_html__( 'Color Set Method', 'darklooks' ),
            ]
        ]);
        $this->getRadioSwitchController([
            'title'     => esc_html__( 'Select Front End Color Type', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode color type.', 'darklooks' ),
            'name'      => 'dark_mode_color_type',
            'options'   => [
                'preset' => esc_html__( 'Preset Color', 'darklooks' ),
                'custom' => esc_html__( 'Custom Color', 'darklooks' ),
            ],
            'condition' => ['dark_method_type', 'equal', 'color_set']
        ]);
        $this->getImageSwitcherController([
            'title'     => esc_html__( 'Front End Color Preset', 'darklooks' ),
            'sub_title' => esc_html__( 'Select the front end darkmode color preset.', 'darklooks' ),
            'name'      => 'frontend_color_preset',
            'options' => [
                [
                    'value' => 'color1',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color1.png'
                ],
                [
                    'value' => 'color2',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color2.png'
                ],
                [
                    'value' => 'color3',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color3.png'
                ],
                [
                    'value' => 'color4',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color4.png'
                ],
                [
                    'value' => 'color5',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color5.png'
                ],
                [
                    'value' => 'color6',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color6.png'
                ],
                [
                    'value' => 'color7',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color7.png'
                ],
                [
                    'value' => 'color8',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color8.png'
                ],
                [
                    'value' => 'color9',
                    'image_url' => DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/color9.png'
                ]
            ],
            'condition' => ['dark_mode_color_type', 'equal', 'preset']
        ]);
        $this->getColorPickerController([
            'title'     => esc_html__( 'Background Color', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode background color.', 'darklooks' ),
            'name'      => 'dark_bg_color',
            'condition' => ['dark_mode_color_type', 'equal', 'custom']
        ]);
        $this->getColorPickerController([
            'title'     => esc_html__( 'Text Color', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode text color.', 'darklooks' ),
            'name'      => 'dark_text_color',
            'condition' => ['dark_mode_color_type', 'equal', 'custom']
        ]);
        $this->getColorPickerController([
            'title'     => esc_html__( 'Link Color', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode link color.', 'darklooks' ),
            'name'      => 'dark_link_color',
            'condition' => ['dark_mode_color_type', 'equal', 'custom']
        ]);
        $this->getColorPickerController([
            'title'     => esc_html__( 'Link Hover Color', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode link hover color.', 'darklooks' ),
            'name'      => 'dark_link_hover_color',
            'condition' => ['dark_mode_color_type', 'equal', 'custom']
        ]);
        $this->getColorPickerController([
            'title'     => esc_html__( 'Border Color', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode border color.', 'darklooks' ),
            'name'      => 'dark_border_color',
            'condition' => ['dark_mode_color_type', 'equal', 'custom']
        ]);


        // Section Footer
        $this->footer();
    }
	

}

$obj = new Color_Preset();