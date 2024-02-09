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
 


trait Number {

  public static $args;

  public function getNumberController(array $args) {
    self::$args = $args;
    self::numberControllerTemplate();
  }
  
  public static function numberControlMaping() {

    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'placeholder' => '',
      'name'      => '',
      'condition' => [],
      'class'     => ''
    ];

    return wp_parse_args( self::$args, $default );

  }

  public static function numberControllerTemplate() {
    $args = self::numberControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '';

    echo '<div class="dl-content-row">
        <div class="dl-setting-info">';
        if( !empty( $args['title'] ) ) {
          echo '<h6>'.esc_html( $args['title'] ).'</h6>';
        }
        if( !empty( $args['sub_title'] ) ) {
          echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
        }
        echo '</div>
        <div class="flex-grow">
            <input type="number" class="dl-input-style" value="'.esc_html( $getValue ).'" placeholder="'.esc_attr( $args['placeholder'] ).'" name="'.esc_attr($optName).'['.esc_attr( $args['name'] ).']">
        </div>
    </div>';

  }


}  
