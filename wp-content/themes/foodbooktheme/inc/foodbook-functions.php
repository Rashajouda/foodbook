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

    // Theme option callback
    function foodbook_opt( $id = null, $url = null ){
        global $foodbook_opt;

        if( $id && $url ){

            if( isset( $foodbook_opt[$id][$url] ) && $foodbook_opt[$id][$url] ){
                return $foodbook_opt[$id][$url];
            }

        }else{

            if( isset( $foodbook_opt[$id] )  && $foodbook_opt[$id] ){
                return $foodbook_opt[$id];
            }
        }
    }

    // theme logo
    function foodbook_theme_logo() {
        // escaping allow html
        $allowhtml = array(
            'a'    => array(
                'href' => array()
            ),
            'span' => array(),
            'i'    => array(
                'class' => array()
            )
        );
        $siteUrl = home_url('/');
        // site logo
        if( foodbook_opt('foodbook_site_logo', 'url' )  ){

            $stickyLogo = '';
            if( foodbook_opt( 'foodbook_sticky_site_logo', 'url' ) ){

            $siteLogo = '
            <img src="'.esc_url( foodbook_opt('foodbook_site_logo', 'url' ) ).'" class="default-logo" alt="'.esc_attr__( 'logo', 'foodbook' ).'" />
            <img src="'.esc_url( foodbook_opt('foodbook_sticky_site_logo', 'url' ) ).'" class="sticky-logo" alt="'.esc_attr__( 'logo', 'foodbook' ).'" />
            ';

            }else{
                $siteLogo = '<img src="'.esc_url( foodbook_opt('foodbook_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'foodbook' ).'" />';
            }

            return '<a href="'.esc_url( $siteUrl ).'">'.wp_kses_post( $siteLogo ).'</a>';


        }elseif( foodbook_opt('foodbook_site_title') ){
            return '<h2><a class="text-logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( foodbook_opt('foodbook_site_title'), $allowhtml ).'</a></h2>';
        }else{
            return '<h2><a class="text-logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
        }
    }

    // WP post link pages
    function foodbook_link_pages(){

        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'foodbook' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'foodbook' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ) );
    }

    // Blog Date Permalink
    function foodbook_blog_date_permalink(){

        $year  = get_the_time('Y');
        $month_link = get_the_time('m');
        $day   = get_the_time('d');

        $link = get_day_link( $year, $month_link, $day);

        return $link;
    }

    // audio format iframe match
    function foodbook_iframe_match(){
        $audio_content = foodbook_embedded_media( array( 'audio', 'iframe' ) );
        $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
        return $iframe_match;
    }

    // Post embedded media
    function foodbook_embedded_media( $type = array() ){

        $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
        $embed   = get_media_embedded_in_content( $content, $type );

        if( in_array( 'audio' , $type) ){

            if( count( $embed ) > 0 ){
                $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
            }else{
               $output = '';
            }

        }else{

            if( count( $embed ) > 0 ){

                $output = $embed[0];
            }else{
               $output = '';
            }

        }

        return $output;

    }

    // custom meta id callback
    function foodbook_meta( $id = '' ){

        $value = get_post_meta( get_the_ID(),'_foodbook_'.$id, true );

        return $value;
    }

    /**
    * Add a pingback url auto-discovery header for single posts, pages, or attachments.
    */
    function foodbook_pingback_header() {
        if ( is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
        }
    }
    add_action( 'wp_head', 'foodbook_pingback_header' );

    // move comment up
    function foodbook_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        // cookies
        $cookies_field = $fields['cookies'];
        unset( $fields['cookies'] );
        $fields['cookies'] = $cookies_field;
        return $fields;
    }

    add_filter( 'comment_form_fields', 'foodbook_move_comment_field_to_bottom' );

    // foodbook comment template callback
    function foodbook_comment_callback( $comment, $args, $depth ) {
        if( $depth == '1' ) {
            $commentcls = 'single-post-comment media flex-column flex-sm-row';
        } else {
            $commentcls = 'post-comment-reply single-post-comment media flex-column flex-sm-row';
        }
        ?>
        <div <?php comment_class( array('single-comment-wrapper') ); ?> >
        <?php
            echo '<div id="comment-'.esc_attr( get_comment_ID() ).'" class="'.esc_attr($commentcls).'">';
                if( get_avatar( $comment ) ) {
                    echo '<div class="comment-author-image mb-30 mb-sm-0">';
                        echo get_avatar( $comment, 100 );
                    echo '</div>';
                }

                echo '<div class="comment-content media-body">';
                    echo '<div class="d-flex align-items-center">';
                        echo '<h5 class="author-name">'.esc_html( ucwords( get_comment_author() ) ).'</h5>';
                        echo '<span>'.esc_html( get_comment_date( 'd M Y' ) ).'</span>';
                    echo '</div>';
                    comment_text();
                    echo '<div class="comment-btns">';
                        comment_reply_link( array_merge( $args, array(
                            'add_below'     => 'comment',
                            'depth'         => 1,
                            'max_depth'     => 5,
                            'reply_text'    => 'Reply'
                        ) ) );
                        edit_comment_link( esc_html__( '(Edit)', 'foodbook' ), '  ', '' );
                    echo '</div>';
                echo '</div>';
            if ( $comment->comment_approved == '0' ){
                echo '<em class="comment-awaiting-moderation">'.esc_html__( 'Your comment is awaiting moderation.', 'foodbook' ).'</em>';
                echo '<br />';
             }
        echo '</div>';
    }

    // Data Background image attr
    function foodbook_data_bg_attr( $imgUrl = '' ){

        return 'data-bg-img="'.esc_url( $imgUrl ).'"';

    }

    // Page Banner Header
    if( !function_exists( 'foodbook_page_banner_header' ) ){
        function foodbook_page_banner_header(){
            if( class_exists('woocommerce') && is_shop() ) {
                echo '<h2>'.esc_html__( 'Shop', 'foodbook' ).'</h2>';
            } elseif ( is_archive() ){
                the_archive_title('<h2>', '</h2>');
            }elseif ( is_home() ){
                echo '<h2>'.esc_html__( 'Blog', 'foodbook' ).'</h2>';
            }elseif( is_search() ){
                echo '<h2>'.esc_html__( 'Search Result', 'foodbook' ).'</h2>';
            }elseif( is_404() ){
                echo '<h2>'.esc_html__( "404","foodbook" ).'</h2>';
            }elseif( is_single() && foodbook_opt( 'foodbook_single_title_position' ) == '1' || foodbook_opt( 'foodbook_single_title_position' ) == '3' ){
                echo '<h2>'.wp_kses_post( get_the_title() ).'</h2>';
            }elseif( !class_exists( 'ReduxFramework' ) && is_single() ){
                echo '<h2>'.wp_kses_post( get_the_title() ).'</h2>';
            }else{
                if( !is_single() ){
                    the_title( '<h2>', '</h2>' );
                }
            }
        }
    }

    // Excerpt Length
    function foodbook_excerpt_length( $excerpt_length ) {
    	if( foodbook_opt( 'foodbook_post_excerpt' )  ){
            $excerpt_length = foodbook_opt( 'foodbook_post_excerpt' );
        }else{
            $excerpt_length = '26';
        }

        return $excerpt_length;
    }
    add_filter( 'excerpt_length', 'foodbook_excerpt_length', 999 );

    // Excerpt More
    function foodbook_excerpt_more( $more ) {
    	return '';
    }
    add_filter( 'excerpt_more', 'foodbook_excerpt_more' );

    // Foodbook Social Media
    if( !function_exists( 'foodbook_social_icon' ) ){
        function foodbook_social_icon(){
            $social_icons = foodbook_opt( 'social_icon_slide' );
            if( !empty( $social_icons ) && isset( $social_icons ) ){
                foreach( $social_icons as $icon ){
                    echo '<li>';
                        echo '<a href="'.esc_url( $icon['url'] ).'"><i class="fa '.esc_attr( $icon['icon'] ).'" aria-hidden="true"></i></a>';
                    echo '</li>';
                }
            }
        }
    }

    // Body Class When No Sidebar
    add_filter('body_class', 'foodbook_add_sidebar_classes_to_body');
    function foodbook_add_sidebar_classes_to_body($classes = ''){
        if ( !is_active_sidebar( 'foodbook_blog_sidebar' ) ) {
            $classes[] = 'no-sidebar';
        }
        return $classes;
    }

    // Post Password Form
    add_filter( 'the_password_form','foodbook_post_password' );
    function foodbook_post_password(){
        echo '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">';
        echo '<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:','foodbook' ) . '</p>';
        echo '<div class="theme-input-group">';
        echo '<input class="theme-input-style" name="post_password" placeholder="'.esc_attr__( 'Password','foodbook' ).'" type="password" size="20" />';
        echo '<button type="submit" name="Submit">';
            echo '<span>'.esc_html__( 'Enter','foodbook' ).'</span>';
        echo '</button></div></form>';
    }

    //Remove Tag-Clouds inline style
    add_filter( 'wp_generate_tag_cloud', 'foodbook_remove_tagcloud_inline_style',10,1 );
    function foodbook_remove_tagcloud_inline_style( $input ){
       return preg_replace('/ style=("|\')(.*?)("|\')/','',$input);
    }

    // Add Class On Comment Reply
    add_filter( 'comment_reply_link', 'foodbook_replace_reply_link_class' );
    function foodbook_replace_reply_link_class($class){
        $class = str_replace("class='comment-reply-link", "class='comment-reply-link reply-btn", $class);
        return $class;
    }

    // Menu With Description
    class Foodbook_Menu_With_Description extends Walker_Nav_Menu {
        function start_el( &$output, $item, $depth=0, $args = NULL, $id = 0 ) {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';
            // var_dump( $item );
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="' . esc_attr( $class_names ) . '"';

            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

            $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            if( ! empty( $item->description ) ){
                $item_output .= '<span class="menu-mark">'.wp_kses_post( $item->description ).'</span>';
            }
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }