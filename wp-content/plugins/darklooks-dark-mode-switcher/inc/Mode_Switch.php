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

class Mode_Switch {

    private static $switchStyle;

    /**
     * 
     * @since 1.0.0
     * @param number $style 
     * @return void
     */
    public static function getSwitch() {
        self::$switchStyle = Helper::getOptionValue('mode_switch_style');
        return self::switchMaping();
    }

    /**
     * Switch maping
     * 
     * @since 1.0.0
     * @return void
     */
    private static function switchMaping() {

        switch( self::$switchStyle ) {

            case 'switcher1' :
                return self::switch_1();
                break;
            case 'switcher2' :
                return self::switch_2();
                break;
            case 'switcher3' :
                return self::switch_3();
                break;
            case 'switcher4' :
                return self::switch_4();
                break;
            case 'switcher5' :
                return self::switch_5();
                break;
            default :
                return self::switch_1();
                break;
        }
    }
    private static function switchText() {

        return [
            'switch_lite_text' => !empty( Helper::getOptionValue('switch_lite_text') ) ? Helper::getOptionValue('switch_lite_text') : esc_html__( 'Light', 'darklooks' ),
            'switch_dark_text' => !empty( Helper::getOptionValue('switch_dark_text') ) ? Helper::getOptionValue('switch_dark_text') : esc_html__( 'Dark', 'darklooks' )
        ];
    }
    /**
     * Switch style 1
     * 
     * @since 1.0.0
     * @return void
     */
    public static function switch_1() {
        ob_start();
        $text = self::switchText();
        ?>
        <label class="dl-switch">
            <input class="darklooks-mode-changer" type="checkbox">
            <span class="dl-slider"></span>
            <span class="dl-light"><?php echo esc_html( $text['switch_lite_text'] ); ?></span>
            <span class="dl-dark"><?php echo esc_html( $text['switch_dark_text'] ); ?></span>
        </label>
        <?php
        return ob_get_clean();
    }
    /**
     * Switch style 2
     * 
     * @since 1.0.0
     * @return void
     */
    public static function switch_2() {
        ob_start();
        ?>
        <label class="dl-switch style2">
            <input class="darklooks-mode-changer" type="checkbox">
            <span class="dl-slider"></span>
            <span class="dl-light"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/dark2.svg'; ?>" class="svg"></span>
            <span class="dl-dark"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/light2.svg'; ?>" class="svg" ></span>
        </label>
        <?php
        return ob_get_clean();
    }
    /**
     * Switch style 3
     * 
     * @since 1.0.0
     * @return void
     */
    public static function switch_3() {
        ob_start();
        ?>
        <label class="dl-switch style3">
            <input class="darklooks-mode-changer" type="checkbox">
            <span class="dl-slider"></span>
            <span class="dl-light"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/light33.svg'; ?>" class="svg" ></span>
            <span class="dl-dark"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/dark33.svg'; ?>" class="svg"></span>
        </label>
        <?php
        return ob_get_clean();
    }
    /**
     * Switch style 4
     * 
     * @since 1.0.0
     * @return void
     */
    public static function switch_4() {
        ob_start();
        $text = self::switchText();
        ?>
        <label class="dl-switch style4">
            <input class="darklooks-mode-changer" type="checkbox">
            <span class="dl-slider"></span>
            <span class="dl-dark"><?php echo esc_html( $text['switch_dark_text'] ); ?> <img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/dark4.svg'; ?>" class="svg" ></span>
            <span class="dl-light"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/light-white.svg'; ?>" class="svg" > <?php echo esc_html( $text['switch_lite_text'] ); ?></span>
        </label>
        <?php
        return ob_get_clean();
    }
    /**
     * Switch style 5
     * 
     * @since 1.0.0
     * @return void
     */
    public static function switch_5() {
        ob_start();
        ?>
        <label class="dl-switch style5">
            <input class="darklooks-mode-changer" type="checkbox">
            <span class="dl-active-border"></span>
            <span class="dl-light"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/light.svg'; ?>" class="svg"></span>
            <span class="dl-dark"><img src="<?php echo DARKLOOKS_DIR_ASSETS_URL.'img/icons/dark.svg'; ?>" class="svg"></span>
        </label>
        <?php
        return ob_get_clean();
    }

}