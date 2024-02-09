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
 


trait Slider {

  public static $args;

  public function getSliderController(array $args) {
    self::$args = $args;
    self::sliderControllerTemplate();
  }

  public static function sliderControlMaping() {

    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'placeholder' => '',
      'name'      => '',
      'class'     => '',
      'step'       => '1',
      'min'       => '0',
      'max'       => '100',
      'condition' => []
    ];

    return wp_parse_args( self::$args, $default );

  }

  public static function sliderControllerTemplate() {
    $args = self::sliderControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '0';

    echo '<div class="dl-content-row">
        <div class="dl-setting-info">';
           
          if( !empty( $args['title'] ) ) {
            echo '<h6>'.esc_html( $args['title'] ).'</h6>';
          }
          if( !empty( $args['sub_title'] ) ) {
            echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
          }
         
      echo  '</div>
        <div class="flex-grow">
            <div class="dl-range-slider">
                <input class="rs-range" name="'.esc_attr( $optName ).'['.esc_attr( $args['name'] ).']" type="range" value="'.esc_html($getValue).'" step="'.esc_attr($args['step']).'" min="'.esc_attr($args['min']).'" max="'.esc_attr($args['max']).'">
                <span class="rs-label">'.esc_html($getValue).'</span>
            </div>
        </div>
    </div>';

  }

}  
