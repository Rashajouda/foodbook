<?php
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
      exit( );
    }
    /**
    * @Packge      : foodbook
    * @Version     : 1.0
    * @Author      : ThemeLooks
    * @Author URI  : https://www.themelooks.com/
    *
    */

    /**
    * @Post Column
    *
    * @Hook foodbook_blog_post_column
    *
    * @Hooked foodbook_blog_post_column_cb
    */
    do_action( 'foodbook_blog_post_column' );


    // Blog Template
    get_template_part( 'template-part/blog-style','one' );


    /**
    * @Single Div
    *
    * @Hook foodbook_single_div_end_wrapper
    *
    * @Hooked foodbook_single_div_end_wrapper_cb
    */
    do_action( 'foodbook_single_div_end_wrapper' );