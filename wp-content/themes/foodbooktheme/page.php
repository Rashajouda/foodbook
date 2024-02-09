<?php
    // Do not allow directly accessing this file.
    if ( ! defined( 'ABSPATH' ) ) {
        exit( );
    }
    /**
    * @Packge     : Foodbook
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
    * @Hook foodbook_page_wrapper_start
    *
    * @Hooked foodbook_page_wrapper_start_cb
    */
    do_action( 'foodbook_page_wrapper_start' );

    /**
    * @Page Column Wrapper
    *
    * @Hook foodbook_page_column_divider_start_wrapper
    *
    * @Hooked foodbook_page_column_divider_start_wrapper_cb
    */
    do_action( 'foodbook_page_column_divider_start_wrapper' );

    if( have_posts() ){
        while( have_posts() ){
            the_post();
            // Post Contant
            get_template_part( 'template-part/content', 'page' );
        }
        // Reset Data
        wp_reset_postdata();
    }else{
        get_template_part( 'template-part/content', 'none' );
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
    * @Page Column Wrapper
    *
    * @Hook foodbook_page_sidebar_wrapper
    *
    * @Hooked foodbook_page_sidebar_wrapper_cb
    */
    do_action( 'foodbook_page_sidebar_wrapper' );

    /**
    * @Page End Wrapper
    *
    * @Hook foodbook_page_wrapper_end
    *
    * @Hooked foodbook_page_wrapper_end_cb
    */
    do_action( 'foodbook_page_wrapper_end' );

    // Call Footer
    get_footer();