<?php
/**
 * @version  1.0
 * @package  foodbook
 * @author   Themelooks <support@themelooks.com>
 *
 * Websites: http://www.themelooks.com
 *
 */

/**************************************
*   Creating Newsletter Widget
***************************************/

class foodbook_newsletter_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
    		// Base ID of your widget
    		'foodbook_newsletter_widget',
    		// Widget name will appear in UI
    		esc_html__( 'Foodbook :: Newsletter', 'foodbook' ),
    		// Widget description
    		array(
				'description' 	=> esc_html__( 'Add Newsletter', 'foodbook' ),
				'classname'		=> 'widget_newsletter'
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$content 		= apply_filters( 'widget_content', $instance['content'] );
	$placeholder 	= apply_filters( 'widget_placeholder', $instance['placeholder'] );
	$widget_style	= apply_filters( 'widget_style', $instance['widget_style'] );


	$widget_style  		= empty( $instance['widget_style'] ) ? 'style_two' : $instance['widget_style'];

	//before and after widget arguments are defined by themes
	echo $args['before_widget'];
?>
	<?php
        if ( ! empty( $title ) ){
            echo $args['before_title'] . $title . $args['after_title'];
        }
		if( $widget_style == 'style_two' ){
			$newsletter_style = 'style--two';
		}else{
			$newsletter_style = '';
		}
    ?>

	<div class="newsletter-content <?php echo esc_attr( $newsletter_style );?>">
		<?php
			if( !empty( $content ) ){
				echo foodbook_paragraph_tag(array(
					'text'		=> esc_html( $content ),
				));
			}
		?>
		<form method="post" name="mc-embedded-subscribe-form" target="_blank" class="newsletter-form" id="subscribe_submit">
			<div class="theme-input-group">
				<input id="sectsubscribe_email" name="sectsubscribe_email" type="email" placeholder="<?php if( !empty( $placeholder ) ){echo esc_attr( $placeholder );}?>" required>
				<button name="sectsubscribe" type="submit">
					<?php echo esc_html__( 'Submit','foodbook' );?>
				</button>
			</div>
		</form>
	</div>
	<?php
		echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
	//Title
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Subscribe Us', 'foodbook' );
	}
	// Description
	if ( isset( $instance[ 'content' ] ) ) {
		$content = $instance[ 'content' ];
	}else{
		$content = '';
	}
	// Placeholder Text
	if ( isset( $instance[ 'placeholder' ] ) ) {
		$placeholder = $instance[ 'placeholder' ];
	}else{
		$placeholder = 'Your Email';
	}

	$instance = wp_parse_args(
		(array) $instance,
		array(
			'widget_style'  => 'style_one',
			'title'   => '',
		)
	);

// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
			<?php
				_e( 'Title:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'content' ); ?>">
			<?php
				_e( 'Description:' ,'foodbook' );
			?>
		</label>
		<textarea rows="5" cols="40" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo esc_attr( $content ); ?>"><?php echo stripslashes( $content ); ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>">
			<?php
				_e( 'Placeholder:' ,'foodbook' );
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="text" value="<?php echo esc_attr( $placeholder ); ?>" />
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'widget_style' ) ); ?>"><?php _e( 'Choose Style:' ); ?></label>
		<select name="<?php echo esc_attr( $this->get_field_name( 'widget_style' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'widget_style' ) ); ?>" class="widefat">
			<option value="style_one"<?php selected( $instance['widget_style'], 'style_one' ); ?>><?php _e( 'Style One' ); ?></option>
			<option value="style_two"<?php selected( $instance['widget_style'], 'style_two' ); ?>><?php _e( 'Style Two' ); ?></option>
		</select>
	</p>
<?php
	}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    	$instance 					= array();
    	$instance['title'] 			= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    	$instance['content'] 			= ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
    	$instance['placeholder']  		= ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( $new_instance['placeholder'] ) : '';
		if ( in_array( $new_instance['widget_style'], array( 'style_one', 'style_two', 'ID' ) ) ) {
			$instance['widget_style'] = $new_instance['widget_style'];
		} else {
			$instance['widget_style'] = 'style_two';
		}
    	return $instance;
	}
} // Class foodbook_subscribe_widget ends here


// Register and load the widget
function foodbook_newsletter_load_widget() {
	register_widget( 'foodbook_newsletter_widget' );
}
add_action( 'widgets_init', 'foodbook_newsletter_load_widget' );