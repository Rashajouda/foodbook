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

class Color_Preset_Manager {

    public static function getFrontEndColor() {

        if( Helper::getOptionValue('dark_mode_color_type') != 'preset' ) {
            return self::getCustomColor();
        } else {
            return self::getPresetColor();
        }

    }
    
    public static function getPresetColor() {
        $colorPresetStyle = Helper::getOptionValue('frontend_color_preset');
        return Color_Preset::colorPresetMaping($colorPresetStyle);
    }

    /**
     * Get custom color
     * 
     * @since 1.0.0
     * @return array
     */
    public static function getCustomColor() {

        $bgColor    = Helper::getOptionValue('dark_bg_color');
        $textColor  = Helper::getOptionValue('dark_text_color');
        $linkColor  = Helper::getOptionValue('dark_link_color');
        $linkHoverColor = Helper::getOptionValue('dark_link_hover_color');
        $borderColor    = Helper::getOptionValue('dark_border_color');
        $inputBg        = '#3a3a3a';
        $btnBg          = '#181717';
        return [

            'background_color'  => esc_html( $bgColor ),
            'color'             => esc_html( $textColor ),
            'anchor_color'      => esc_html( $linkColor ),
            'anchor_hover_color' => esc_html( $linkHoverColor ),
            'input_bg_color'    => esc_html( $inputBg ),
            'border_color'      => esc_html( $borderColor ),
            'btn_bg_color'      => esc_html( $btnBg ),
            'btn_color'         => esc_html( $textColor )

        ];

    }
    
}