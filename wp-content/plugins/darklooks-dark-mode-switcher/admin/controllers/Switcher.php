<?php
namespace Darklooks\Admin\Controllers;
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
 


trait Switcher {

    public static $args;

    public function getSwitcherController(array $args) {
        self::$args = $args;
        self::switcherControllerTemplate();
    }
  
	public static function switcherControlMaping() {

        $default = [
          'title'     => esc_html__( 'Title goes here', 'darklooks' ),
          'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
          'placeholder' => '',
          'name'      => '',
          'class'     => '',
          'condition' => []
        ];

        return wp_parse_args( self::$args, $default );

	}

  public static function switcherControllerTemplate() {
    $args = self::switcherControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '';

    echo ' <div class="dl-content-row">
        <div class="dl-setting-info">';
            if( !empty( $args['title'] ) ) {
                echo '<h6>'.esc_html( $args['title'] ).'</h6>';
            }
            if( !empty( $args['sub_title'] ) ) {
                echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
            }
        echo ' </div>
        <div>
            <label for="'.esc_attr( $args['name'] ).'" class="dl-switch">
                <input id="'.esc_attr( $args['name'] ).'" value ="yes" name="'.esc_attr($optName).'['.esc_attr( $args['name'] ).']" '.checked( $getValue, 'yes', false ).' type="checkbox">
                <span class="dl-slider"></span>
            </label>
        </div>
    </div>';

  }

}  

