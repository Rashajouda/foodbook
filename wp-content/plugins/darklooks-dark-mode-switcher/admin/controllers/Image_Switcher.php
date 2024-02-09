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
 


trait Image_Switcher {

  public static $args;

  public function getImageSwitcherController(array $args) {
    self::$args = $args;
    self::imageSwitcherControllerTemplate();
  }
  
  public static function imageSwitcherControlMaping() {

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

  public static function imageSwitcherControllerTemplate() {
    $args = self::imageSwitcherControlMaping();
    $optName = self::OPTION_NAME;
    $controllerName = !empty( $args['name'] ) ? $args['name'] : '';
    $getValue = self::getOptions();
    $getValue = !empty( $getValue[$controllerName] ) ? $getValue[$controllerName] : '';

    $requiredAttr = '';
    if( !empty( $args['condition'] ) ) {
      $requiredAttr = 'data-required="'.esc_attr( json_encode( $args['condition'] ) ).'" data-dependency="'.esc_attr( $args['condition'][0] ).'" data-name="'.esc_attr( $args['name'] ).'"';
    }
    ?>
    <div class="dl-content-row" <?php echo apply_filters( 'darklooks_image_switcher_attr', $requiredAttr ); ?>>
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
        <div class="dl-switch-styles">
            <?php 
            if( !empty( $args['options'] ) ) {
                foreach( $args['options'] as $option ) {
                    $value = $option['value'];
                    
                    echo '<div class="dl-input-group">
                        <input type="radio" '.checked( $getValue, $value, false ).' value="'.esc_html( $value ).'" name="'.esc_attr( $optName ).'['.esc_attr( $args['name'] ).']" id="'.esc_attr( $value ).'">
                        <label for="'.esc_attr( $value ).'" class="dl-switch-style">
                        <img src="'.esc_url( $option['image_url'] ).'">
                        </label>
                        </div>
                  ';
                }
            }
            ?>
        </div>
    </div>
    <?php
  }

}  
