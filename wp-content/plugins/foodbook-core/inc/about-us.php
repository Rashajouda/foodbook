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
*	Creating About Us Widget
***************************************/

class foodbook_about_us extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'foodbook_about_us',
			// Widget name will appear in UI
			esc_html__( 'Foodbook :: About Us', 'foodbook' ),
			// Widget description
			array(
				'description' 	=> esc_html__( 'Add About Us Widget', 'foodbook' ),
				'classname'		=> 'widget_about',
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$image 			= apply_filters( 'widget_image', $instance['image'] );
	$description 	= apply_filters( 'widget_desc', $instance['description'] );
	$social_icon 	= apply_filters( 'widget_social_icon', $instance['social_icon'] );

	//before and after widget arguments are defined by themes
	echo $args['before_widget'];

 	if( !empty( $image ) ){
		echo '<div class="widget-logo">';
		 	echo foodbook_img_tag(array(
				'url'		=> esc_url( $instance['image'] ),
			));
		echo '</div>';
	}
	if( !empty( $description ) ){
		echo '<div class="about-text">';
			echo foodbook_paragraph_tag(array(
				'text'		=> esc_html( $description ),
			));
		echo '</div>';
	}

	echo $args['after_widget'];

	if( $social_icon ){
		echo '<div class="widget widget_social_icon">';
	        echo '<ul class="social_icon_list">';
	            if( function_exists( 'foodbook_social_icon' ) ){
					echo foodbook_social_icon();
				}
	        echo '</ul>';
	    echo '</div>';
	}
}

// Widget Backend
public function form( $instance ) {
	// About US Description
	if ( isset( $instance[ 'description' ] ) ) {
		$description = $instance[ 'description' ];
	}else{
		$description = '';
	}

	// Image
	if ( isset( $instance[ 'image' ] ) ) {
		$image = $instance[ 'image' ];
	}else {
		$image = '';
	}

	// Social Icon
	if ( isset( $instance[ 'social_icon' ] ) ) {
		$social_icon = $instance[ 'social_icon' ];
	}else{
		$social_icon = '';
	}

// Widget admin form
?>
	<p>
		<label for="logo_image">
			<?php
				_e( 'Logo:' ,'foodbook' );
			?>
		</label>
		<div class="moderna-admin">
			<button class="button button-secondary" id="logo_image"><?php esc_html_e( 'Upload Image','foodbook' );?></button>
			<input type="text" class="img_link widefat hidden" name="<?php echo $this->get_field_name('image'); ?>"
			  value="<?php if( !empty( $instance['image'] ) ){ echo esc_attr( $instance['image'] );} ?>" >
			<div class="logo-image">
				<img src="<?php if( !empty( $instance['image'] ) ){ echo esc_url( $instance['image'] );} ?>">
			</div>
		</div>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'description' ); ?>">
			<?php
				_e( 'Description:' ,'foodbook' );
			?>
		</label>
		<textarea rows="5" cols="40" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" value="<?php echo esc_attr( $description ); ?>"><?php echo stripslashes( $description ); ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'social_icon' ); ?>">
			<?php
				_e( 'Enable Social Icon' ,'foodbook' );
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'social_icon' ); ?>" name="<?php echo $this->get_field_name( 'social_icon' ); ?>" type="checkbox"  <?php checked( $social_icon, 'on' );?> />
	</p>

<?php
}
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['description'] 	= ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['image']  		= ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['social_icon']    = ( ! empty( $new_instance['social_icon'] ) ) ? strip_tags( $new_instance['social_icon'] ) : '';
		return $instance;
	}
}

// Register and load the widget
function foodbook_about_us_widget() {
	register_widget( 'foodbook_about_us' );
}
add_action( 'widgets_init', 'foodbook_about_us_widget' );