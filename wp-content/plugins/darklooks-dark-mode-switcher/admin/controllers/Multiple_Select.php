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
 
trait Multiple_Select {

  public static $args;

  public function getMultipleSelectController(array $args) {
    self::$args = $args;
    self::multipleSelectControllerTemplate();
  }
  
  public static function multipleSelectControlMaping() {
    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'name'      => '',
      'class'     => '',
      'condition' => [],
      'options'   => []
    ];
    return wp_parse_args( self::$args, $default );
  }

  public static function multipleSelectControllerTemplate() {
    $args = self::multipleSelectControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '';
    ?>
    <div class="dl-content-row">
        <div class="dl-setting-info">
          <?php
          if( !empty( $args['title'] ) ) {
            echo '<h6>'.esc_html( $args['title'] ).'</h6>';
          }
          if( !empty( $args['sub_title'] ) ) {
            echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
          }
          ?>
        </div>
        <div class="flex-grow">
          <div class="dl-custom-select">
            <?php 
            echo '<select name="'.esc_attr( $optName ).'['.esc_attr( $args['name'] ).'][]" multiple="multiple" class="dl-select-style">';
            if( !empty( $args['options'] ) ) {
              foreach( $args['options'] as $key => $option ) {
                $getVal = '';
                if( is_array( $getValue ) && in_array( $key , $getValue ) ) {
                  $getVal = $key;
                }
                echo '<option '.selected( $getVal, $key, false ).' value="'.esc_attr($key).'">'.esc_html( $option ).'</option>';
              }
            }
            echo '</select>';
            ?>
          </div>
        </div>
    </div>
    <?php
  }

}  
