<?php
	// Do not allow directly accessing this file.
	if ( ! defined( 'ABSPATH' ) ) {
		exit( );
	}
	/**
	* @Packge    : foodbook
	* @version   : 1.0
	* @Author    : ThemeLooks
	* @Author URI: https://www.themelooks.com/
	*/

	// Date Enable Disable
	if( class_exists( 'ReduxFramework' ) ){
		$foodbook_date_enable = foodbook_opt( 'foodbook_date_enable' );
		if( $foodbook_date_enable ){
			$foodbook_date_enable = true;
		}else{
			$foodbook_date_enable = false;
		}
	}else{
		$foodbook_date_enable = true;
	}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'single-blog-item' ); ?>>
	<!-- Blog Image -->
	<?php
		echo '<!-- Blog Image -->';
			/**
			* @Blog Post Thumbnail
			*
			* @Hook foodbook_blog_posts_thumb
			*
			* @Hooked foodbook_blog_posts_thumb_cb
			*/
			do_action( 'foodbook_blog_posts_thumb' );
		echo '<!-- End Blog Image -->';

		echo '<div class="blog-content">';
			if( $foodbook_date_enable ){
				echo foodbook_anchor_tag(array(
					'url'	=> esc_url( foodbook_blog_date_permalink() ),
					'text'	=> esc_html( get_the_time( 'd M Y' ) ),
					'class' => esc_attr( 'posted' ),
				));
			}
			if( get_the_title() ){
				echo '<h3><a href="'.esc_url( get_the_permalink() ).'">'.wp_kses_post( get_the_title() ).'</a></h3>';
			}
			if( foodbook_opt( 'foodbook_show_post_excerpt' ) && !empty( foodbook_opt( 'foodbook_post_excerpt' ) ) ){
				echo '<p class="blog-excerpt">'.wp_kses_post( get_the_excerpt() ).'</p>';
			}
			/**
			* @Blog Read More Button
			*
			* @Hook foodbook_blog_read_more_button
			*
			* @Hooked foodbook_blog_read_more_button_cb
			*/
			do_action( 'foodbook_blog_read_more_button' );
		echo '</div>';
echo '</div>';