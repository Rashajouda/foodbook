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

class Color_Preset {

    public static function colorPresetMaping( $preset ) {
        switch( $preset ) {

            case 'color1' :
                return self::color_set_1();
                break;
            case 'color2' :
                return self::color_set_2();
                break;
            case 'color3' :
                return self::color_set_3();
                break;
            case 'color4' :
                return self::color_set_4();
                break;
            case 'color5' :
                return self::color_set_5();
                break;
            case 'color6' :
                return self::color_set_6();
                break;
            case 'color7' :
                return self::color_set_7();
                break;
            case 'color8' :
                return self::color_set_8();
                break;
            case 'color9' :
                return self::color_set_9();
                break;
            default :
                return self::color_set_1();
                
        }
    }

    /**
     * Color Preset Style 1
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_1() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#FF3B3B',
            'anchor_color'      => '#FF3B3B',
            'anchor_hover_color' => '#FF3B3B',
            'btn_bg_color'      => '#FF3B3B',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#3a3a3a'

        ];

    }
    /**
     * Color Preset Style 2
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_2() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#06C270',
            'anchor_color'      => '#06C270',
            'anchor_hover_color' => '#06C270',
            'btn_bg_color'      => '#06C270',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#3a3a3a'

        ];

    }
    /**
     * Color Preset Style 3
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_3() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#0063F7',
            'anchor_color'      => '#0063F7',
            'anchor_hover_color' => '#0063F7',
            'btn_bg_color'      => '#0063F7',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#3a3a3a'

        ];

    }
    /**
     * Color Preset Style 4
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_4() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#FB9426',
            'anchor_color'      => '#FB9426',
            'anchor_hover_color' => '#FB9426',
            'btn_bg_color'      => '#FB9426',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#3a3a3a'

        ];

    }
    /**
     * Color Preset Style 5
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_5() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#FFCC2F',
            'anchor_color'      => '#FFCC2F',
            'anchor_hover_color' => '#FFCC2F',
            'btn_bg_color'      => '#FFCC2F',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#3a3a3a'

        ];

    }
    /**
     * Color Preset Style 6
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_6() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#73DFE7',
            'anchor_color'      => '#73DFE7',
            'anchor_hover_color' => '#73DFE7',
            'btn_bg_color'      => '#73DFE7',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#353535'

        ];

    }
    /**
     * Color Preset Style 7
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_7() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#AC5DD9',
            'anchor_color'      => '#AC5DD9',
            'anchor_hover_color' => '#AC5DD9',
            'btn_bg_color'      => '#AC5DD9',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#353535'

        ];

    }
    /**
     * Color Preset Style 8
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_8() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#F1ECE1',
            'anchor_color'      => '#F1ECE1',
            'anchor_hover_color' => '#F1ECE1',
            'btn_bg_color'      => '#F1ECE1',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#353535'

        ];

    }
    /**
     * Color Preset Style 9
     * 
     * @since 1.0.0
     * @return array
     */
    private static function color_set_9() {

        return [
            'background_color'  => '#212121',
            'color'             => '#fff',
            'border_color'      => '#00FF31',
            'anchor_color'      => '#00FF31',
            'anchor_hover_color' => '#00FF31',
            'btn_bg_color'      => '#00FF31',
            'btn_color'         => '#fff',
            'input_bg_color'    => '#353535'

        ];

    }

}