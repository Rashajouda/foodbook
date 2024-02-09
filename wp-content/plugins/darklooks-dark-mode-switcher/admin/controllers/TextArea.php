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
 


trait TextArea {

  public static $args;

  public function getTextareaController(array $args) {
    self::$args = $args;
    self::textareaControllerTemplate();
  }

  public static function textareaControlMaping() {

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

  public static function textareaControllerTemplate() {
    $args = self::textareaControlMaping();
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
          <textarea class="dl-input-style" name="'.esc_attr($optName).'['.esc_attr( $args['name'] ).']">'.esc_html( $getValue ).'</textarea>
        </div>
    </div>';

  }

}  
