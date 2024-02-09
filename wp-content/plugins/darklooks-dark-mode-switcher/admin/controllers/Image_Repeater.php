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
 
trait Image_Repeater {

  public static $args;

  public function getImageRepeaterController(array $args) {
    self::$args = $args;
    self::imageRepeaterControllerTemplate();
  }
  
  public static function imageRepeaterControlMaping() {
    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'placeholder' => '',
      'field_name_one'  => '',
      'field_name_two'  => '',
      'condition'       => [],
      'class'           => ''
    ];

    return wp_parse_args( self::$args, $default );
  }

  public static function imageRepeaterControllerTemplate() {
    $args = self::imageRepeaterControlMaping();
    $optName = self::OPTION_NAME;
    $fieldNameOne = !empty( $args['field_name_one'] ) ? $args['field_name_one'] : '';
    $fieldNameTwo = !empty( $args['field_name_two'] ) ? $args['field_name_two'] : '';
    $getValue = self::getOptions();
    $getValueOne = !empty( $getValue[$fieldNameOne] ) ? $getValue[$fieldNameOne] : '';
    $getValueTwo = !empty( $getValue[$fieldNameTwo] ) ? $getValue[$fieldNameTwo] : '';

    // Value Maping
    $getValues = '';
    if( is_array( $getValueOne ) && is_array( $getValueTwo ) ) {
      $getValues = array_combine( $getValueOne, $getValueTwo);
    }

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
          
          <div class="multiple-text-repeater-wrapper">
            <div class="multiple-text-repeater-inner">
            <?php
            if( is_array( $getValues ) && !empty( $getValues ) ):
              foreach ( $getValues as $key => $value ) :
            ?>
              <div class="field-group">
              <input type="text" name="<?php echo esc_attr( $optName ).'['.esc_attr( $args['field_name_one'] ).'][]'; ?>" placeholder="<?php esc_html_e( 'Light Image Url', 'darklooks' ); ?>" class="dl-input-style" value="<?php echo esc_url( $key ); ?>" />
              <input type="text" name="<?php echo esc_attr($optName).'['.esc_attr( $args['field_name_two'] ).'][]'; ?>" placeholder="<?php esc_html_e( 'Dark Image Url', 'darklooks' ); ?>" class="dl-input-style" value="<?php echo esc_url( $value ); ?>" />
              <span class="removefield dl-btn"><?php esc_html_e( 'Remove', 'darklooks' ); ?></span>
              </div>
            <?php
            endforeach;
            else:
            ?>
            <div class="field-group">
              <input type="text" class="dl-input-style" name="<?php echo esc_attr( $optName ).'['.esc_attr( $args['field_name_one'] ).'][]'; ?>" placeholder="<?php esc_html_e( 'Light Image Url', 'darklooks' ); ?>" value="" />
              <input type="text" class="dl-input-style" name="<?php echo esc_attr( $optName ).'['.esc_attr( $args['field_name_two'] ).'][]'; ?>" placeholder="<?php esc_html_e( 'Dark Image Url', 'darklooks' ); ?>" value="" />
              <span class="removefield dl-btn"><?php esc_html_e( 'Remove', 'darklooks' ); ?></span>
            </div>
            <?php
            endif;
            ?>
            </div>
            <a href="#" class="addfield dl-btn"><?php esc_html_e( 'Add Group', 'darklooks' ); ?></a>
          </div>
        </div>
    </div>
    <?php
  }

}  
