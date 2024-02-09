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
 


trait Media_Upload {

  public static $args;

  public function getMediaUploadController(array $args) {
    self::$args = $args;
    self::mediaUploadControllerTemplate();
  }
  
  public static function mediaUploadControlMaping() {

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

  public static function mediaUploadControllerTemplate() {
    $args = self::mediaUploadControlMaping();
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
        <div class="dl-upload-photo-wrap">
            <div class="dl-input-group">
                <label class="dl-upload-btn" for="'.esc_attr( $controllerName ).'">'.esc_html__( 'Upload Image', 'darklooks' ).'</label>
                <input type="hidden" class="dl-upload-input" name="'.esc_attr( $optName ).'['.esc_attr( $args['name'] ).']" value="'.esc_html( $getValue ).'" id="'.esc_html( $controllerName ).'" />
            </div>
            <div>
            <img src="'.esc_url( $getValue ).'" class="dl-upload-img">
            </div>
        </div>
    </div>';
  
  }
  
}  
