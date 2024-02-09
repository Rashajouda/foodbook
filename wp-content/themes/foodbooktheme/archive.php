<?php
    // Do not allow directly accessing this file.
     if ( ! defined( 'ABSPATH' ) ) {
        exit( );
    }
    /**
    * @Packge     : foodbook
    * @Version    : 1.0
    * @Author     : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */

    // Call Header
    get_header();

    /**
    * @Wrapper start With Section, Container, Row
    *
    * @Hook foodbook_blog_section_wrapper_start
    *
    * @Hooked foodbook_blog_section_wrapper_start_cb
    */
    do_action( 'foodbook_blog_section_wrapper_start' );

    /**
    * @Blog Column Wrapper
    *
    * @Hook foodbook_blog_column_divider_start_wrapper
    *
    * @Hooked foodbook_blog_column_divider_start_wrapper_cb
    */
    do_action( 'foodbook_blog_column_divider_start_wrapper' );

    if( have_posts() ) {
        while( have_posts() ) :
            the_post();
            get_template_part( 'template-part/content', get_post_format() );
        endwhile;
        wp_reset_postdata();
    }
    else{
        get_template_part( 'template-part/content','none' );
    }

    /**
    * @Single Div
    *
    * @Hook foodbook_single_div_end_wrapper
    *
    * @Hooked foodbook_single_div_end_wrapper_cb
    */
    do_action( 'foodbook_single_div_end_wrapper' );

    /**
    * @Post Pagination
    *
    * @Hook foodbook_blog_post_pagination
    *
    * @Hooked foodbook_blog_post_pagination_cb
    */
    do_action( 'foodbook_blog_post_pagination' );

    /**
    * @Single Div
    *
    * @Hook foodbook_single_div_end_wrapper
    *
    * @Hooked foodbook_single_div_end_wrapper_cb
    */
    do_action( 'foodbook_single_div_end_wrapper' );

    /**
    * @Blog Sidebar
    *
    * @Hook foodbook_blog_sidebar_wrapper
    *
    * @Hooked foodbook_blog_sidebar_wrapper_cb
    */
    do_action( 'foodbook_blog_sidebar_wrapper' );

    /**
    * @Wrapper End With Section, Container, Row
    *
    * @Hook foodbook_blog_section_wrapper_end
    *
    * @Hooked foodbook_blog_section_wrapper_end_cb
    */
    do_action( 'foodbook_blog_section_wrapper_end' );

    // Call Footer
    get_footer();