<?php
    // Blocking direct access
    if( ! defined( 'ABSPATH' ) ) {
      exit ( );
    }
   /**
    * @version    1.0
    * @package    Foodbook Theme Core Plugin
    * @author     Themelooks <support@themelooks.com>
    *
    * Websites: http://www.themelooks.com
    *
    */

    // share button code
    function foodbook_social_sharing_buttons( $ulClass = 'list-inline social_icon_list' ,$tagLine = '' ) {

        // Get page URL
        $URL = get_permalink();
        $Sitetitle = get_bloginfo('name');
        // Get page title
        $Title = str_replace( ' ', '%20', get_the_title());

        // Construct sharing URL without using any script
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
        $twitterURL = 'https://twitter.com/intent/tweet?text='.esc_html( $Title ).'&amp;url='.esc_url( $URL ).'&amp;via='.esc_html( $Sitetitle );
        $linkedin = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );

        // Add sharing button at the end of page/page content
    	$content = '';
        $content .= '<ul class="'.esc_attr( $ulClass ).'">';
        $content .= $tagLine;
        $content .= '<li>'.esc_html__( 'Share on: ','foodbook' ).'</li>';
        $content .= '<li><a href="'.esc_url( $facebookURL ).'" target="_blank"><i class="fab fa-facebook"></i></a></li>';
        $content .= '<li><a href="'. esc_url( $twitterURL ) .'" target="_blank"><i class="fab fa-twitter"></i></a></li>';
        $content .= '<li><a href="'.esc_url( $linkedin ).'" target="_blank"><i class="fab fa-linkedin"></i></a></li>';
        $content .= '</ul>';

        echo wp_kses_post( $content ) ;

    };

    // Subscribe JS File Enqueue
    add_action( 'wp_enqueue_scripts', 'foodbook_subscribe_core_enqueue' );

    // foodbook Section subscribe ajax callback function
    add_action( 'wp_ajax_foodbook_subscribe_ajax', 'foodbook_subscribe_ajax' );
    add_action( 'wp_ajax_nopriv_foodbook_subscribe_ajax', 'foodbook_subscribe_ajax' );


    // Subscribe JS File Enqueue
    function foodbook_subscribe_core_enqueue(){
        wp_enqueue_script( 'subscribe-main', FOODBOOK_PLUGINURL. 'assets/js/subscribe.js', array( 'jquery' ), '1.0', true );

        wp_localize_script(
            'subscribe-main',
            'subscribeajax',
            array(
                'action_url' => admin_url( 'admin-ajax.php' ),
                'security'   => wp_create_nonce('foodbook')
            )
        );
    }
    function foodbook_subscribe_ajax( ){

        $apiKey     = foodbook_opt( 'mailchimp_api_key' );
        $listid     = foodbook_opt( 'mailchimp_list_id' );

        if( !empty($apiKey) && !empty($listid) ) {
            if( wp_verify_nonce( $_POST['security'], 'foodbook' ) ) {
                if( empty( $_POST['sectsubscribe_email'] ) ){
                    echo '<div class="alert alert-danger" role="alert">'.esc_html__('Enter Your Email.', 'foodbook').'</div>';
                }elseif( !empty( $_POST['sectsubscribe_email'] ) && filter_var( $_POST['sectsubscribe_email'], FILTER_VALIDATE_EMAIL)){
                    $MailChimp  = new DrewM\MailChimp\MailChimp( $apiKey );

                    $result = $MailChimp->post("lists/{$listid}/members",[
                        'email_address'    => $_POST['sectsubscribe_email'],
                        'status'           => 'subscribed',
                    ]);
                    if ( $MailChimp->success() ) {
                        if( $result['status'] == 'subscribed' ){
                            echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'foodbook').'</div>';
                        }
                    }elseif( $result['status'] == '400' ) {
                        echo '<div class="alert alert-danger" role="alert">'.esc_html__('This Email address is already exists.', 'foodbook').'</div>';
                    }else{
                        echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry something went wrong.', 'foodbook').'</div>';
                    }
                }
            } else{
                echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry you are now allowed.', 'foodbook').'</div>';
            }
        } else{
            echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry Api key or list id missing', 'foodbook').'</div>';
        }

        wp_die();
    }



    //add SVG to allowed file uploads
    function foodbook_mime_types( $mimes ) {
      $mimes['svg'] = 'image/svg+xml';
      $mimes['svgz'] = 'image/svgz+xml';
      $mimes['exe'] = 'program/exe';
      $mimes['dwg'] = 'image/vnd.dwg';
      return $mimes;
    }
    add_filter('upload_mimes', 'foodbook_mime_types');

    function foodbook_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {
        $wp_filetype = wp_check_filetype( $filename, $mimes );
        $ext         = $wp_filetype['ext'];
        $type        = $wp_filetype['type'];
        $proper_filename = $data['proper_filename'];

        return compact( 'ext', 'type', 'proper_filename' );
    }
    add_filter('wp_check_filetype_and_ext','foodbook_wp_check_filetype_and_ext',10,4);

    // Select BLog Category
    function foodbook_blogs_category(){
       $cat_array = array();
       $terms = get_terms( array(
           'taxonomy'      => 'category',
           'hide_empty'    => true
       ) );
       if( is_array( $terms ) && $terms ){
           foreach( $terms as $term ){
               $cat_array[$term->slug] = $term->name;
           }
       }
       return $cat_array;
   }