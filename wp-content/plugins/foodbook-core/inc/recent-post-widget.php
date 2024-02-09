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
*Creating Recent Post Widget
***************************************/

class foodbook_recent_post_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'foodbook_recent_post_widget',
			// Widget name will appear in UI
			esc_html__( 'Foodbook :: Recent post', 'foodbook' ),
			// Widget description
			array(
				'description' 	=> esc_html__( 'Add recent post/Recent News/Latest Blog Content', 'foodbook' ),
				'classname'		=> 'widget_recent_entries',
			)
		);
	}


// This is where the action happens
public function widget( $args, $instance ) {
	$title 		= apply_filters( 'widget_title', $instance['title'] );
	$post_number= apply_filters( 'widget_post_number', $instance['post_number'] );
	$show_date 	= apply_filters( 'widget_show_date', $instance['show_date'] );

	// before and after widget arguments are defined by themes
	echo $args['before_widget'];


    if ( ! empty( $title ) ){
		echo $args['before_title'] . $title . $args['after_title'];
    }
	$argss = array(
		'post_type'		=> 'post',
		'posts_per_page'=> esc_attr( $post_number ),
	);

	$loop = new WP_Query( $argss );

	if( $loop->have_posts() ){
		while( $loop->have_posts() ) {
			$loop->the_post();
	?>
	<div class="single-post media align-items-center">
        <?php
            if( has_post_thumbnail() ){
				echo '<div class="post-image">';
                	the_post_thumbnail( array( 70,70 ) );
				echo '</div>';
            }
        ?>
        <div class="post-content media-body">
            <?php
                if( $show_date ){
                	echo foodbook_span_tag(array(
						'class'		=> 	esc_attr( 'posted-on' ),
						'text'		=>  esc_html( get_the_date( 'd M, Y' ) )
					));
            	}
                echo '<h5>';
					echo foodbook_anchor_tag(array(
						'url'		=>	esc_url( get_the_permalink() ),
						'text'		=>  esc_html( get_the_title() ),
					));
                echo '</h5>';
			?>
        </div>
    </div>
	<?php
        }
			wp_reset_postdata();
		}

	echo $args['after_widget'];
}

//Widget Backend
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Recent Posts', 'foodbook' );
	}
	//Post Limit
	if ( isset( $instance[ 'post_number' ] ) ) {
		$post_number = $instance[ 'post_number' ];
	}else {
		$post_number = esc_html( '2');
	}
	//	Show Date
	if ( isset( $instance[ 'show_date' ] ) ) {
		$show_date = $instance[ 'show_date' ];
	}else {
		$show_date = '';
	}

// Widget admin form
?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
			<?php
				echo esc_html__( 'Title:' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'post_number' ); ?>">
			<?php
				_e( 'Number of posts to show: ' ,'foodbook');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo esc_attr( $post_number ); ?>" />
	</p>
	<p>
		<input class="widefat" id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" <?php checked( $show_date, 'on' );  ?> />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
			<?php
				_e( 'Display post date?' ,'foodbook');
			?>
		</label>
	</p>
<?php
	}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance 					= array();
	$instance['title'] 	  		= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	$instance['post_number'] 	= ( ! empty( $new_instance['post_number'] ) ) ? strip_tags( $new_instance['post_number'] ) : '';
	$instance['show_date'] 		= ( ! empty( $new_instance['show_date'] ) ) ?  $new_instance['show_date']  : '';

	return $instance;
}
} // Class foodbook_subscribe_widget ends here
// Register and load the widget
function foodbook_recent_post_load_widget() {
	register_widget( 'foodbook_recent_post_widget' );
}
add_action( 'widgets_init', 'foodbook_recent_post_load_widget' );