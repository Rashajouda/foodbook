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
 


trait CSS_Editor {
  
  public static $args;

  public function getCssEditorController(array $args) {
    self::$args = $args;
    self::cssEditorControllerTemplate();
  }
  
  public static function cssEditorControlMaping() {

    $default = [
      'title'     => esc_html__( 'Title goes here', 'darklooks' ),
      'sub_title' => esc_html__( 'sub title goes here', 'darklooks' ),
      'placeholder' => '',
      'name'          => '',
      'condition'     => [],
      'class'         => ''
    ];

    return wp_parse_args( self::$args, $default );

  }

  public static function cssEditorControllerTemplate() {
    $args = self::cssEditorControlMaping();
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
          <input type="text" hidden id="dlcsseditorinput" name="<?php echo esc_attr( $optName ).'['.esc_attr( $args['name'] ).']'; ?>">
          <pre id="dlcsseditor" class="dl-ace-editor"><?php echo esc_html( trim( $getValue ) );  ?></pre>
        </div>
    </div>
    <?php
  }

}  
