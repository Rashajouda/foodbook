<?php
   // Block direct access
   if( !defined( 'ABSPATH' ) ){
       exit( );
   }
   /**
    * @Packge     : Foodbook
    * @Version    : 1.0
    * @Author     : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */
    echo '<div class="blog-details">';


    // Post Title
    if( foodbook_opt( 'foodbook_single_title_position' ) == '2' || foodbook_opt( 'foodbook_single_title_position' ) == '3' ){
        echo '<div class="post-title">';
            echo '<h2>'.wp_kses_post( get_the_title() ).'</h2>';
        echo '</div>';
    }

    /**
    * @Blog Post Thumbnail
    *
    * @Hook foodbook_blog_posts_thumb
    *
    * @Hooked foodbook_blog_posts_thumb_cb
    */
    do_action( 'foodbook_blog_posts_thumb' );

    echo '<div class="post-meta">';
        echo '<ul class="list-inline">';
            // Category
            if( class_exists( 'ReduxFramework' ) ){
                $foodbook_single_post_category_enable = foodbook_opt( 'foodbook_single_enable_category' );
            }else{
                $foodbook_single_post_category_enable = true;
            }
            if( $foodbook_single_post_category_enable ){
                $foodbook_single_page_category = get_the_category();
                if( is_array( $foodbook_single_page_category ) && !empty( $foodbook_single_page_category ) ){
                    if( count( $foodbook_single_page_category ) < 2 ){
                        $foodbook_category_text = 'Category: ';
                    }else{
                        $foodbook_category_text = 'Categories: ';
                    }
                    echo '<li>'.esc_html( $foodbook_category_text );
                    foreach ( $foodbook_single_page_category as $key => $single_category ) {
                        echo ' <a href="'.esc_url( get_category_link( $single_category->term_id ) ).'">'.esc_html( $single_category->name ) .'</a>';
                    }
                    echo '</li>';
                }
            }
            /**
            * @Blog Author
            *
            * @Hook foodbook_blog_author_enable_disable
            *
            * @Hooked foodbook_blog_author_enable_disable_cb
            */
            do_action( 'foodbook_blog_author_enable_disable' );

            // Post Date
            if( class_exists( 'ReduxFramework' ) ){
                $foodbook_single_post_date_enable = foodbook_opt( 'foodbook_single_post_time_enable' );
            }else{
                $foodbook_single_post_date_enable = true;
            }
            if( $foodbook_single_post_date_enable ){
                echo '<li>'.esc_html__( 'Posted On:','foodbook' ).' <a class="date-color" href="'.esc_url( foodbook_blog_date_permalink() ).'">'.esc_html( get_the_time( 'd F, Y' ) ).'</a></li>';
            }


        echo '</ul>';
    echo '</div>';

        echo '<div class="blog-details-content">';
            the_content() ;
            // Link Pages
            foodbook_link_pages();

        echo '</div>';
        if( class_exists( 'ReduxFramework' ) && get_the_tags() ){
            $foodbook_tag_enable = foodbook_opt( 'foodbook_single_tag_enable_disable' );
        }elseif( get_the_tags() ){
            $foodbook_tag_enable = true;
        }else{
            $foodbook_tag_enable = '';
        }

        if( $foodbook_tag_enable ):
            echo '<div class="row">';
                echo '<div class="col-12">';
                    echo '<div class="post-tags">';
                        echo '<ul class="list-inline">';
                            if( get_the_tags() ){
                                $foodbook_tag_count = get_the_tags();
                                if( count( $foodbook_tag_count ) < 2 ){
                                    $foodbook_tag_count_text = 'Tag: ';
                                }else{
                                    $foodbook_tag_count_text = 'Tags: ';
                                }
                                echo '<li class="mr-1">'.esc_html( $foodbook_tag_count_text ).'</li>';
                                echo '<li>';
                                foreach ( $foodbook_tag_count as $tag_value ) {
                                    echo ' <a href="'.esc_url( get_tag_link( $tag_value->term_id ) ).'">' . esc_html( '#'.$tag_value->name ) . '</a>' ;
                                }
                                echo ' </li>';
                            }
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        endif;

        /**
        * @Blog Single Post Navigation
        *
        * @Hook foodbook_single_post_navigation
        *
        * @Hooked foodbook_single_post_navigation_cb
        */
        do_action( 'foodbook_single_post_navigation' );

        /**
        * @Blog Single Post Comment
        *
        * @Hook foodbook_single_post_comments_show_wrap
        *
        * @Hooked foodbook_single_post_comments_show_wrap_cb
        */
        do_action( 'foodbook_single_post_comments_show_wrap' );

    echo '</div>';