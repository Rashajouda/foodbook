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

class Inline_CSS {

    private static $bodyFontSize;
    private static $imageOpacity;
    private static $getColor;
    private static $mainSelector = 'html.darklooks-mode-changer-enabled';
    
    /**
     * Inline css Front End dark mode
     * @since  1.0.0
     * @return void
     */
    public static function getDarkCss() {

        if( 'filter' != Helper::getOptionValue('dark_method_type') ) {
            self::$bodyFontSize = Helper::getOptionValue('dark_body_text_font_size');
            self::$imageOpacity = Helper::getOptionValue('img_dark_opacity');

            // Color Preset
            self::$getColor =  \Darklooks\Inc\Color_Preset_Manager::getFrontEndColor();

            return self::getFrontEndCss().self::getOsCss();
        } else {
            return self::getFilterCss();
        }
    }
    private static function getFrontEndCss() {

        // Font size on dark mode
        $darkBodyFontSize = !empty( self::$bodyFontSize ) ? 'html.darklooks-mode-changer-enabled body {font-size:'.esc_html( self::$bodyFontSize ).'px;}' : '';
        // Image brightness on dark mode
        $darkImageOpacity = !empty( self::$imageOpacity ) ? 'html.darklooks-mode-changer-enabled img {filter: brightness('.esc_html(self::$imageOpacity).') contrast(1.2);}' : '';

        // Color Preset
        $getColor =  self::$getColor;

        $bgColor     = !empty( $getColor['background_color'] ) ? esc_html( $getColor['background_color'] ) : '';
        $color       = !empty( $getColor['color'] ) ? esc_html( $getColor['color'] ) : '';
        $btnColor     = $color;
        $borderColor  = !empty( $getColor['border_color'] ) ? esc_html( $getColor['border_color'] ) : '';
        $btnBgColor   = !empty( $getColor['btn_bg_color'] ) ? esc_html( $getColor['btn_bg_color'] ) : '';
        $anchorColor  = !empty( $getColor['anchor_color'] ) ? esc_html( $getColor['anchor_color'] ) : '';
        $anchorHoverColor = !empty( $getColor['anchor_hover_color'] ) ? esc_html( $getColor['anchor_hover_color'] ) : '';
        $inputBgColor = !empty( $getColor['input_bg_color'] ) ? esc_html( $getColor['input_bg_color'] ) :'';

        $excludeElements = self::excludeElements();
        $includeElements = self::includeElements();
        $mainSelector = self::$mainSelector;

        $inlinecss = "
        :root {
            --dldark-bg-color: {$bgColor};
            --dldark-text-color: {$color};
            --dldark-border-color: {$borderColor};
            --dldark-anchor-color: {$anchorColor};
            --dldark-anchorhover-color: {$anchorHoverColor};
            --dldark-btn-color: {$btnColor};
            --dldark-btnbg-color: {$btnBgColor};
            --dldark-inputbg-color: {$inputBgColor};
        }
        {$includeElements}
        {$mainSelector} :not(.dl-dark-neglect):not(.floating-mode-switcher-wrap):not(.dl-switch):not(textarea):not(input):not(select):not(option):not(button):not(pre):not(.dl-switch span):not(rect):not(ins):not(mark):not(code):not(img):not(progress):not(iframe):not(.mejs-iframe-overlay):not(.woosc-area):not(.woosc-inner):not(svg):not(canvas):not(video):not(a):not(path):not(.elementor-element-overlay):not(.elementor-background-overlay):not(i):not(button *):not(a *){$excludeElements} {
            background-color: var(--dldark-bg-color) !important;
            color: var(--dldark-text-color) !important;
            border-color: var(--dldark-border-color)!important;
        }
        html.darklooks-mode-changer-enabled a {
          color: var(--dldark-anchor-color) !important;
        }
        html.darklooks-mode-changer-enabled a:hover {
            color: var(--dldark-anchorhover-color) !important;
        }
        html.darklooks-mode-changer-enabled textarea,
        html.darklooks-mode-changer-enabled input {
          background-color: var(--dldark-inputbg-color) !important;
          color: var(--dldark-text-color) !important;
          border-color: var(--dldark-border-color)!important;
        }
        html.darklooks-mode-changer-enabled button {
            background-color: var(--dldark-btnbg-color) !important;
            color: var(--dldark-btn-color) !important;
        }
        {$darkBodyFontSize}
        {$darkImageOpacity}
        ";

        return $inlinecss;
    }
    private static function getOsCss() {

        // Check is Enable OS Dark Mode
        if( ! Helper::getOptionValue('os_darkopt') ) {
            return;
        }

        $osCss = "
        @media (prefers-color-scheme: dark) {".self::getFrontEndCss()."}
        ";
        return $osCss;
    }

    public static function includeElements() {
        //
        if( !empty( Helper::getOptionValue('dark_include_element') ) ) {
            $ele = Helper::getOptionValue('dark_include_element');

            $stringToArray = explode(',', $ele);
            $getIncludeElement = '';

            if( !empty( $stringToArray ) && is_array( $stringToArray ) ) {
                foreach( $stringToArray as $el ) {
                    $getIncludeElement .= self::$mainSelector.' '.esc_attr( trim($el) ).',';
                }
            }
            return $getIncludeElement;
        }
    }
    public static function excludeElements() {
        //
        if( !empty( Helper::getOptionValue('dark_exclude_element') ) ) {

            $ele = Helper::getOptionValue('dark_exclude_element');

            $stringToArray = explode(',', $ele);
            $getExcludeElement = '';

            if( !empty( $stringToArray ) && is_array( $stringToArray ) ) {

                foreach( $stringToArray as $el ) {
                    $getExcludeElement .= ':not('.esc_attr(trim($el)).')';
                }

            }
            return $getExcludeElement;
        }
    }

    /**
     * Add filter css
     * @since  1.0.0
     * @return void
     */
    public static function getFilterCss() {

        $inlinecss = "
        html.darklooks-mode-changer-enabled {
                filter: invert(1) grayscale(0.8);
        }
        html.darklooks-mode-changer-enabled img {
            filter: invert(1);
        }
        @-moz-document url-prefix() {
            html.darklooks-mode-changer-enabled {
                filter: none;
            }
            
            html.darklooks-mode-changer-enabled header,
            html.darklooks-mode-changer-enabled section,
            html.darklooks-mode-changer-enabled main,
            html.darklooks-mode-changer-enabled aside,
            html.darklooks-mode-changer-enabled footer,
            html.darklooks-mode-changer-enabled div {
                filter: invert(1) grayscale(0.8);
            }
            html.darklooks-mode-changer-enabled body {
                background: #111 !important;
                color: #8a8888 !important;
            }
            html.darklooks-mode-changer-enabled h1,
            html.darklooks-mode-changer-enabled h2,
            html.darklooks-mode-changer-enabled h3,
            html.darklooks-mode-changer-enabled h4,
            html.darklooks-mode-changer-enabled h5,
            html.darklooks-mode-changer-enabled h6{
                color: #eeebeb !important;
            }
            html.darklooks-mode-changer-enabled img {
            filter: none;
            }
        }  
        
        ";
        return $inlinecss;
    }

}