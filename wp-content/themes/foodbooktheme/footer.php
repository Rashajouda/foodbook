<?php
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( );
    }
    /**
    * @Packge     : foodbook
    * @Version    : 1.0
    * @Author     : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */

    /**
    * @Foodbook Footer
    *
    * @Hook foodbook_footer_widget
    *
    * @Hooked foodbook_footer_widget_cb
    */
    do_action( 'foodbook_footer_widget' );


    /**
    * @Foodbook Back To Top
    *
    * @Hook foodbook_back_to_top
    *
    * @Hooked foodbook_back_to_top_cb
    */
    do_action( 'foodbook_back_to_top' );

    wp_footer();
?>
</body>
</html>