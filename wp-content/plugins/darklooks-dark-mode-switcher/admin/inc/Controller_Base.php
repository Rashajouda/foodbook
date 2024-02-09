<?php
namespace Darklooks\Admin\Inc;
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

abstract class Controller_Base {

    use \Darklooks\Admin\Controllers\Color_Picker;
    use \Darklooks\Admin\Controllers\CSS_Editor;
    use \Darklooks\Admin\Controllers\Image_Switcher;
    use \Darklooks\Admin\Controllers\Image_Repeater;
    use \Darklooks\Admin\Controllers\Multiple_Select;
    use \Darklooks\Admin\Controllers\Media_Upload;
    use \Darklooks\Admin\Controllers\Number;
    use \Darklooks\Admin\Controllers\Select;
    use \Darklooks\Admin\Controllers\Switcher;
    use \Darklooks\Admin\Controllers\Radio_Switch;
    use \Darklooks\Admin\Controllers\Slider;
    use \Darklooks\Admin\Controllers\Text;
    use \Darklooks\Admin\Controllers\TextArea;

    const OPTION_NAME = DARKLOOKS_OPTION_NAME;

	public function __construct() {
        $this->registerControls();
    }

    public function getTitle() {}
    public function getIcon() {}
    public function registerControls() {}
    private static function getOptions() {
        return get_option( self::OPTION_NAME );
    }
    protected function header() {
        ?>
        <div class="dl-title-area">
            <h3 class="dl-tab-tilte">
                <img src="<?php echo esc_url( $this->getIcon() ); ?>"><?php echo esc_html( $this->getTitle() ); ?>
            </h3>
            <?php 
            self::saveButton();
            ?>
        </div>
        <div class="dl-content-area">
        <?php
    }
    protected function footer() {
        echo '</div>';
    }
    protected static function saveButton() {
        echo '<div class="dl-top-save-btn">';
            submit_button( esc_html( 'Save Setting', 'darklooks' ), 'dl-btn' );
        echo '</div>';

    }

}