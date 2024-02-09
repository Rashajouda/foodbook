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
*Creating Contact Information Widget
***************************************/

class foodbook_contact_info_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'foodbook_contact_info_widget',
			// Widget name will appear in UI
			esc_html__( 'Foodbook :: Contact Us', 'foodbook' ),
			// Widget description
			array(
				'description'	 => esc_html__( 'Add footer Contact Information content', 'foodbook' ),
				'classname'		 => 'widget_contact',
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$content 		= apply_filters( 'widget_content', $instance['content'] );
	$address 		= apply_filters( 'widget_address', $instance['address'] );
	$mobile01 		= apply_filters( 'widget_mobile01', $instance['mobile01'] );
	$mobile02 		= apply_filters( 'widget_mobile02', $instance['mobile02'] );
	$email 			= apply_filters( 'widget_email', $instance['email'] );
	$email01 		= apply_filters( 'widget_email01', $instance['email01'] );


	//Remove ' ' , '-', ' - ' from phone link
	$replace 		= array(' ','-',' - ');
	$with 	 		= array('','','');
	$mobile01url 	= str_replace( $replace, $with, $mobile01 );

	//Remove ' ' , '-', ' - ' from phone link
	$replace 		= array(' ','-',' - ');
	$with 			= array('','','');
	$mobile02url 	= str_replace( $replace, $with, $mobile02 );

	//Remove ' ' , '-', ' - ' from email
	$email 			= is_email( $email );
	$replace 		= array(' ','-',' - ');
	$with 			= array('','','');
	$emailurl 		= str_replace( $replace, $with, $email );
	//Remove ' ' , '-', ' - ' from email
	$email01 		= is_email( $email01 );
	$replace 		= array(' ','-',' - ');
	$with 			= array('','','');
	$emailurl01 	= str_replace( $replace, $with, $email01 );
	//before and after widget arguments are defined by themes
	echo $args['before_widget'];
    echo '<!-- About Widget Start -->';
    	if( !empty( $title ) || !empty( $content ) || !empty( $address ) || !empty( $email ) || !empty( $email01 ) || !empty( $mobile01 ) || !empty( $mobile02 ) ):

			if ( ! empty( $title ) ){
				echo $args['before_title'] . $title . $args['after_title'];
			}

			echo '<!-- Widget Content Begin -->';

				echo '<div class="contact-content">';
					if( !empty( $content ) ):
				 		echo foodbook_paragraph_tag(array(
							'text'		=> esc_html( $content ),
						));
			 		endif;
					if( !empty( $address ) || !empty( $email ) || !empty( $email01 ) || !empty( $mobile01 ) || !empty( $mobile02 )  ):
						echo '<ul class="list-unstyled">';
							if( !empty( $address ) ){
								echo '<li><i class="fa fa-map-marker"></i>'.esc_html( $address ).'</li>';
							}
							if( !empty( $mobile01 ) || !empty( $mobile02 ) ){
								echo '<li><i class="fa fa-phone"></i>';
									if( !empty( $mobile01 ) ){
										echo '<a href="'.esc_attr( 'callto:'.$mobile01url ).'">'.esc_html( $mobile01 ).'</a>';
									}
									if( !empty( $mobile02 ) ){
										echo '<a href="'.esc_attr( 'callto:'.$mobile02url ).'">'.esc_html( $mobile02 ).'</a>';
									}
								echo '</li>';
							}
							if( !empty( $email ) || !empty( $email01 ) ){
								echo '<li><i class="fa fa-envelope"></i>';
									if( !empty( $email ) ){
										echo '<a href="'.esc_attr( 'mailto:'.$email ).'">'.esc_html( $email ).'</a>';
									}
									if( !empty( $email01 ) ){
										echo '<a href="'.esc_attr( 'mailto:'.$email01 ).'">'.esc_html( $email01 ).'</a>';
									}
								echo '</li>';
							}
						echo '</ul>';
					endif;
				echo '</div>';
			echo '<!-- Widget Content End -->';
    	endif;
	echo $args['after_widget'];
    echo '<!-- About Widget End -->';
}

// Widget Backend
public function form( $instance ) {
	//Title
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Get In Touch', 'foodbook' );
	}

	// Content
	if ( isset( $instance[ 'content' ] ) ) {
		$content = $instance[ 'content' ];
	}else {
		$content = esc_html__( 'Our support available to help you 24 hours a day & 7 days a week.', 'foodbook' );
	}

	// Address
	if ( isset( $instance[ 'address' ] ) ) {
		$address = $instance[ 'address' ];
	}else {
		$address = '';
	}

	// Mobile 01
	if ( isset( $instance[ 'mobile01' ] ) ) {
		$mobile01 = $instance[ 'mobile01' ];
	}else {
		$mobile01 = '';
	}

	// Mobile 02
	if ( isset( $instance[ 'mobile02' ] ) ) {
		$mobile02 = $instance[ 'mobile02' ];
	}else {
		$mobile02 = '';
	}

	// E-mail one
	if ( isset( $instance[ 'email' ] ) ) {
		$email = $instance[ 'email' ];
	}else {
		$email = '';
	}

	// E-mail two
	if ( isset( $instance[ 'email01' ] ) ) {
		$email01 = $instance[ 'email01' ];
	}else {
		$email01 = '';
	}

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
		<label for="<?php echo $this->get_field_id( 'address' ); ?>">
			<?php
				_e( 'Address:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'mobile01' ); ?>">
			<?php
				_e( 'Mobile One:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'mobile01' ); ?>" name="<?php echo $this->get_field_name( 'mobile01' ); ?>" type="text" value="<?php echo esc_attr( $mobile01 ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'mobile02' ); ?>">
			<?php
				_e( 'Mobile Two:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'mobile02' ); ?>" name="<?php echo $this->get_field_name( 'mobile02' ); ?>" type="text" value="<?php echo esc_attr( $mobile02 ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'email' ); ?>">
			<?php
				_e( 'Email One:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( '$email01' ); ?>">
			<?php
				_e( 'Email Two:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( '$email01' ); ?>" name="<?php echo $this->get_field_name( 'email01' ); ?>" type="text" value="<?php echo esc_attr( $email01 ); ?>" />
	</p>


<?php
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();

	$instance['title'] 	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

	$instance['content'] 	= ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';

	$instance['address'] 	= ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';

	$instance['mobile01']  = ( ! empty( $new_instance['mobile01'] ) ) ? strip_tags( $new_instance['mobile01'] ) : '';

	$instance['mobile02']  = ( ! empty( $new_instance['mobile02'] ) ) ? strip_tags( $new_instance['mobile02'] ) : '';

	$instance['email'] 	= ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';

	$instance['email01'] 	= ( ! empty( $new_instance['email01'] ) ) ? strip_tags( $new_instance['email01'] ) : '';


	return $instance;
}
}
// Class foodbook_subscribe_widget ends here

// Register and load the widget
function foodbook_contact_info_load_widget() {
	register_widget( 'foodbook_contact_info_widget' );
}
add_action( 'widgets_init', 'foodbook_contact_info_load_widget' );