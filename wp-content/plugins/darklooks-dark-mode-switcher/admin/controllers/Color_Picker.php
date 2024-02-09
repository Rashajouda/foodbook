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
 


trait Color_Picker {

  public static $args;

  public function getColorPickerController(array $args) {
    self::$args = $args;
    self::colorPickerControllerTemplate();
  }
  
  public static function colorPickerControlMaping() {

    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'placeholder'   => '',
      'name'          => '',
      'condition'     => [],
      'class'         => ''
    ];

    return wp_parse_args( self::$args, $default );

  }

  public static function colorPickerControllerTemplate() {
    $args = self::colorPickerControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '';

    $requiredAttr = '';
    if( !empty( $args['condition'] ) ) {
      $requiredAttr = 'data-required="'.esc_attr( json_encode( $args['condition'] ) ).'" data-dependency="'.esc_attr( $args['condition'][0] ).'" data-name="'.esc_attr( $args['name'] ).'"';
    }

    echo '<div class="dl-content-row" '.apply_filters( 'darklooks_colorpicker_attr', $requiredAttr ).'>
        <div class="dl-setting-info">';
        if( !empty( $args['title'] ) ) {
          echo '<h6>'.esc_html( $args['title'] ).'</h6>';
        }
        if( !empty( $args['sub_title'] ) ) {
          echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
        }
        echo '</div>
        <div class="flex-grow">
            <input type="text" class="color-picker" value="'.esc_html( $getValue ).'" name="'.esc_attr( $optName ).'['.esc_attr( $args['name'] ).']" class="dl-input-style">
        </div>
    </div>';

  }

}