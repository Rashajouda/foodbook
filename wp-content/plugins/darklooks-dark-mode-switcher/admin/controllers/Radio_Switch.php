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
 


trait Radio_Switch {

  public static $args;

  public function getRadioSwitchController(array $args) {
    self::$args = $args;
    self::radioSwitchControllerTemplate();
  }
  
  public static function radioSwitchControlMaping() {

    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'placeholder' => '',
      'name'      => '',
      'class'     => '',
      'condition' => [],
      'options'   => []
    ];

    return wp_parse_args( self::$args, $default );

  }

  public static function radioSwitchControllerTemplate() {
    $args = self::selectControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '';

    $requiredAttr = '';
    if( !empty( $args['condition'] ) ) {
      $requiredAttr = 'data-required="'.esc_attr( json_encode( $args['condition'] ) ).'" data-dependency="'.esc_attr( $args['condition'][0] ).'" data-name="'.esc_attr( $args['name'] ).'"';
    }
    ?>
    <div class="dl-content-row" <?php echo apply_filters( 'darklooks_radioswitch_attr', $requiredAttr ); ?>>
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
          <div class="dl-custom-radio">
            <?php
            if( !empty( $args['options'] ) ) {
              foreach( $args['options'] as $key => $option ) {
                echo '<label for="'.esc_attr($key).'" class="radio">
              <input type="radio" class="dl-radio-switch" name="'.esc_attr($optName).'['.esc_attr( $args['name'] ).']" id="'.esc_attr($key).'" value="'.esc_attr($key).'" class="hidden" '.checked( $key, $getValue, false ).' />'.esc_html( $option ).'
              </label>';
              }
            }
            ?>
            
          </div>
        </div>
    </div>
    <?php
  }

}  
