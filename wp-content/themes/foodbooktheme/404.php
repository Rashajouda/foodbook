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

    get_header();

?>
<!-- 404 Begin -->
<section class="d-flex align-items-center justify-content-center min-vh-100 pt-5 pb-5 pb-lg-0 pt-lg-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- 404 Image -->
                <div class="mb-50 mb-lg-0">
                    <?php
                        if( class_exists( 'ReduxFramework' ) ){
                            if( !empty( foodbook_opt( 'foodbook_404_image','url' ) ) ){
                                echo foodbook_img_tag( array(
                                    'url'	=> esc_url( foodbook_opt( 'foodbook_404_image','url' ) ),
                                ) );
                            }
                        }else{
                            echo foodbook_img_tag( array(
                                'url'	=> esc_url( FOODBOOK_IMG_DIR_URI. 'feature/404.png' ),
                            ) );
                        }
                    ?>
                </div>
                <!-- End 404 Image -->
            </div>

            <div class="col-lg-6">
                <!-- 404 Content -->
                <div class="content404">
                    <?php
                        if( class_exists( 'ReduxFramework' ) ){
                            if( !empty( foodbook_opt( 'foodbook_404_title' ) ) ){
                                echo foodbook_heading_tag( array(
                                    'tag'	=>	'h1',
                                    'text'	=> esc_html( foodbook_opt( 'foodbook_404_title' ) )
                                ) );
                            }
                        }else{
                            echo foodbook_heading_tag( array(
                                'tag'	=>	'h1',
                                'text'	=> esc_html__( '404 Error!','foodbook' )
                            ) );
                        }

                        $foodbook_404_text_default = sprintf(
                            __( '<p>%s<a href="%s">%s</a></p>','foodbook' ),
                            esc_html__( 'You\'ve been tricked into click on link that can\'t be found. Please check the url or go to ','foodbook' ),
                            esc_url( home_url('/') ),
                            esc_html__( 'main page.','foodbook' )
                        );
                        $foodbook_404_text = foodbook_opt( "foodbook_404_simple_title" );
                        if( !empty( $foodbook_404_text ) ){
                            echo '<p>'.wp_kses_post( $foodbook_404_text ).'</p>';
                        }else{
                            echo wp_kses_post( $foodbook_404_text_default );
                        }
                    ?>
                    <div class="search-form">
                        <?php
                            if( class_exists( 'ReduxFramework' ) ){
                                if( !empty( foodbook_opt( 'foodbook_404_form_title' ) ) ){
                                    echo foodbook_paragraph_tag( array(
                                        'text'	=>	esc_html(  foodbook_opt( 'foodbook_404_form_title' ) ),
                                    ) );
                                }
                            }else{
                                echo foodbook_paragraph_tag( array(
                                    'text'	=>	esc_html__( 'What Are You Looking For Search Here','foodbook' ),
                                ) );
                            }
                            get_search_form();
                        ?>
                    </div>
                </div>
                <!-- End 404 Content -->
            </div>
        </div>
    </div>
</section>
<!-- 404 End -->
<?php wp_footer();?>
</body>

</html>