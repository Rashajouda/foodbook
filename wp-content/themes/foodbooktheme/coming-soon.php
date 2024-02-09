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
	*
	* template name: Coming Soon
	*
	*/
	get_header();

	?>
	<!-- Coming Soon Begin -->
	<section class="d-flex align-items-center justify-content-center min-vh-100 pt-5 pb-5 pb-lg-0 pt-lg-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Coming Sooon Image -->
                    <div class="mb-50 mb-lg-0">
						<?php
							if( !empty( foodbook_opt( 'foodbook_coming_image','url' ) ) ){
								echo foodbook_img_tag( array(
									'url'	=> esc_url( foodbook_opt( 'foodbook_coming_image','url' ) ),
								) );
							}
						?>
                    </div>
                    <!-- End Coming Soon Image -->
                </div>

                <div class="col-lg-6">
                    <!-- 404 Content -->
                    <div class="content-coming-soon">
						<?php
							if( !empty( foodbook_opt( 'foodbook_coming_soon_title' ) ) ){
								echo foodbook_heading_tag( array(
									'tag'	=>	'h1',
									'text'	=> esc_html( foodbook_opt( 'foodbook_coming_soon_title' ) )
								) );
							}
							if( !empty( foodbook_opt( 'foodbook_coming_soon_simple_title' ) ) ){
								echo foodbook_paragraph_tag( array(
									'text'	=> esc_html( foodbook_opt( 'foodbook_coming_soon_simple_title' ) )
								) );
							}

						?>
                        <div class="search-form">
							<?php
								if( !empty( foodbook_opt( 'foodbook_subscribe_form_title' ) ) ){
									echo foodbook_paragraph_tag( array(
										'text'	=>	esc_html(  foodbook_opt( 'foodbook_subscribe_form_title' ) ),
									) );
								}
								if( class_exists( 'ReduxFramework' ) ){
									$foodbook_subscribe_placeholder = foodbook_opt( 'foodbook_coming_soon_form_placeholder' );
								}else{
									$foodbook_subscribe_placeholder = 'Enter your email';
								}
								if( class_exists( 'ReduxFramework' ) ){
									$foodbook_subscribe_button = foodbook_opt( 'foodbook_coming_soon_button' );
								}else{
									$foodbook_subscribe_button = 'Subscribe';
								}
							?>
							<div class="newsletter-content">
	                            <form method="post" name="mc-embedded-subscribe-form" id="subscribe_submit">
	                                <div class="theme-input-group">
	                                    <input id="sectsubscribe_email" name="sectsubscribe_email" type="email" placeholder="<?php echo esc_attr( $foodbook_subscribe_placeholder );?>">
	                                    <button name="sectsubscribe" type="submit"><?php echo esc_html( $foodbook_subscribe_button )?></button>
	                                </div>
	                            </form>
							</div>
                        </div>
                    </div>
                    <!-- End Coming Content -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Coming Soon -->
	<?php wp_footer();?>
</body>
</html>