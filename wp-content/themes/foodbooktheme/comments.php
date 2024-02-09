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

    if ( post_password_required() ) {
        return;
    }

    if( have_comments() ):
?>
    <div class="post-comments-wrap mt-60">
        <h4 class="comment-count">
            <?php
                printf( _nx( 'Comment', 'Comments', get_comments_number(), 'comments title', 'foodbook' ), number_format_i18n( get_comments_number() ) );
                echo ' ('.esc_html( get_comments_number() ).')';
            ?>
        </h4>
            <?php
                the_comments_navigation();
                wp_list_comments( array(
                    'style'       => 'div',
                    'short_ping'  => true,
                    'callback'    => 'foodbook_comment_callback'
                ) );
                the_comments_navigation();
            ?>
        <!-- .comment-list -->
    </div>
    <?php
        endif;
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments">
            <?php
                esc_html_e( 'Comments are closed.', 'foodbook' );
            ?>
        </p>
    <?php
        endif;

    $commenter  = wp_get_current_commenter();
    $req        = get_option( 'require_name_email' );
    $aria_req   = ( $req ? "required='required'" : '' );
    $consent 	= empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields     =  array(
        'author' =>'<div class="row"><div class="col-lg-6"><input class="theme-input-style" type="text" name="author" placeholder="'. esc_attr__( 'Enter your name', 'foodbook' ) .'" value="'. esc_attr( $commenter['comment_author'] ).'"  '.wp_kses_post( $aria_req ).'></div>',
        'email'  =>'<div class="col-lg-6"><input class="theme-input-style" type="email" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" placeholder="'. esc_attr__( 'Enter your email', 'foodbook' ) .'"  '.wp_kses_post( $aria_req ).'></div></div>',
        'cookies' =>'<div class="row"><div class="col-lg-12 custom-checkbox position-relative mb-4"><label for="wp-comment-cookies-consent" class="check-level">'.esc_html__( 'Save my name, email, and website in this browser for the next time I comment.','foodbook').'<input value="yes"' . wp_kses_post( $consent ) . ' name="wp-comment-cookies-consent" id="wp-comment-cookies-consent" type="checkbox"><span class="checkmark"></span></label></div></div>'
         );
    $args = array(
        'comment_field'         =>'<div class="row"><div class="col-12"><textarea class="theme-input-style" name="comment" placeholder="'. esc_attr__( 'Write your comments', 'foodbook' ) .'" required ></textarea> </div></div>',
        'title_reply'           => esc_html__( 'Leave Your Comment Here', 'foodbook' ),
        'title_reply_before'    => '<h4>',
        'comment_notes_before'  => '',
        'comment_notes_after'   => '',
        'title_reply_after'     =>'</h4>',
        'label_submit'          => esc_html__( 'Post Comment', 'foodbook' ),
        'class_submit'          => '',
        'submit_button'         => '<button type="submit" class="btn-fill">%4$s</button>',
        'fields'                => $fields,
        'class_form'            => '',
        'submit_field'          => '<div class="row"><div class="col-12">%1$s %2$s</div></div>'
    );
    if( comments_open() ){
        comment_form( $args );
    }