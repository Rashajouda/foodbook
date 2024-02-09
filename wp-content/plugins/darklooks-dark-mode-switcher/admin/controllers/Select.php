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
 


trait Select {

  public static $args;

  public function getSelectController(array $args) {
    self::$args = $args;
    self::selectControllerTemplate();
  }
  
  public static function selectControlMaping() {

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

  public static function selectControllerTemplate() {
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
    <div class="dl-content-row" <?php echo apply_filters( 'darklooks_select_attr', $requiredAttr ); ?>>
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
                echo '<select name="'.esc_attr( $optName ).'['.esc_attr( $args['name'] ).']" class="dl-select-style">';
                if( !empty( $args['options'] ) ) {
                    foreach( $args['options'] as $key => $option ) {
                        echo '<option '.selected( $getValue, $key, false ).' value="'.esc_attr($key).'">'.esc_html( $option ).'</option>';
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
