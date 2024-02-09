<?php
    echo '<!-- Single Blog -->';
    echo '<div class="single-blog-item">';
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
            echo foodbook_anchor_tag(array(
                'url'	=> esc_url( foodbook_blog_date_permalink() ),
                'text'	=> esc_html( get_the_time( 'd M Y' ) ),
                'class' => esc_attr( 'posted' ),
            ));

            if( get_the_title() ){
				echo '<h3><a href="'.esc_url( get_the_permalink() ).'">'.wp_kses_post( get_the_title() ).'</a></h3>';
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
    echo '<!-- End Single Blog -->';