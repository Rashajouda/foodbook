<?php
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Foodbook
	* @Version     : 1.0
	* @Author 	   : ThemeLooks
	* @Author URI  : https://www.themelooks.com/
	*
	*/

    // Blog Post Thumbnail Function
    if( !function_exists( 'foodbook_blog_posts_thumb_cb' ) ){
        function foodbook_blog_posts_thumb_cb(){
        // post image
            if( has_post_thumbnail() ){

                if( !is_single() ){
                    $wraperStart = '<div class="blog-image">';
                }else{
                    $wraperStart = '<div class="blog-details-image">';
                }

                if( !is_single() ){
                    $wraperEnd = '</div>';
                }else{
                    $wraperEnd = '</div>';
                }

                $html = '';
                $html .= $wraperStart;
                $html .= foodbook_img_tag(
                    array(
                        'url' => esc_url( get_the_post_thumbnail_url() ),
                    )
                );
                $html .= $wraperEnd;

                echo wp_kses_post( $html );

            }

            //End of post image

            //Thumbnail check and video and audio thumb show
            if( !is_single() && !has_post_thumbnail() ){
                $html = '';
                if( has_post_format( array( 'video' ) ) ){

                    $html .= '<div class="blog-video">';
                    $html .= foodbook_embedded_media( array( 'video', 'iframe' ) );
                    $html .= '</div>';

                }else{

                    if( has_post_format( array( 'audio' ) ) ){

                        $html .= '<div class="blog-audio">';
                        $html .= foodbook_embedded_media( array( 'audio', 'iframe' ) );
                        $html .= '</div>';
                    }
                }

                echo apply_filters( 'foodbook_post_embedded_media' ,$html );

            }
        }
    }

	// Foodbook Preloader
	if( !function_exists( 'foodbook_preloader_cb' ) ){
		function foodbook_preloader_cb(){
			if( class_exists( 'ReduxFramework' )  ){
				if( foodbook_opt( 'foodbook_display_preloader' ) ){
					$foodbook_proloader = true;
				}else{
					$foodbook_proloader = false;
				}
			}else{
				$foodbook_proloader = true;
			}
			if( $foodbook_proloader ){
				echo "<!-- Preloader -->";
				echo "<div class='preloader w-100 h-100 position-fixed'>";
					echo "<span class='loader'>";
						echo esc_html__( 'Loading…','foodbook' );
					echo "</span>";
				echo "</div>";
				echo "<!-- End Preloader -->";
		    }
		}
	}

	// Foodbook Header Function
	if( !function_exists( 'foodbook_header_cb' ) ){
		function foodbook_header_cb(){
			get_template_part( 'template-part/header-navbar' );

			if( !is_page_template( 'coming-soon.php' ) ){

	            $foodbook_page_header_enable = foodbook_meta( 'page_header' );

	            if ( is_page_template( 'template-builder.php' )   ) {

	                if( $foodbook_page_header_enable == 1 ){
	                    get_template_part( 'template-part/page-banner' );
	                }

	            }else{
	                get_template_part( 'template-part/page-banner' );
	            }
	        }
		}
	}

	// Blog, Single Post, Archive Wrapper Start Function
	if( !function_exists( 'foodbook_blog_section_wrapper_start_cb' ) ){
		function foodbook_blog_section_wrapper_start_cb(){
			echo '<section class="pb-140 pt-140">';
			    echo '<div class="container">';
			        echo '<div class="row">';
		}
	}
	// Page Wrapper Start Function
	if( !function_exists( 'foodbook_page_wrapper_start_cb' ) ){
		function foodbook_page_wrapper_start_cb(){
			echo '<section class="pb-140 pt-140">';
			    echo '<div class="container">';
			        echo '<div class="row">';
		}
	}

	// Blog, Single Post, Archive, Page Wrapper End Function
	if( !function_exists( 'foodbook_blog_section_wrapper_end_cb' ) ){
		function foodbook_blog_section_wrapper_end_cb(){
				    echo '</div>';
				echo '</div>';
			echo '</section>';
		}
	}

	// Blog, Single Post, Archive, Page Wrapper End Function
	if( !function_exists( 'foodbook_page_wrapper_end_cb' ) ){
		function foodbook_page_wrapper_end_cb(){
				    echo '</div>';
				echo '</div>';
			echo '</section>';
		}
	}

	// Blog Column Divider Start Function
	if( !function_exists( 'foodbook_blog_column_divider_start_wrapper_cb' ) ){
		function foodbook_blog_column_divider_start_wrapper_cb(){
			if( class_exists( 'ReduxFramework' ) && is_active_sidebar( 'foodbook_blog_sidebar' ) ){
				$foodbook_blog_layout = foodbook_opt( 'foodbook_blog_layout' );
				if( $foodbook_blog_layout == '1' ){
					$foodbook_blog_column = 'col-lg-12';
				}elseif( $foodbook_blog_layout == '2' ){
					$foodbook_blog_column = 'col-lg-8 order-last';
				}elseif( $foodbook_blog_layout == '3' ){
					$foodbook_blog_column = 'col-lg-8';
				}else{
					$foodbook_blog_column = 'col-lg-8';
				}
			}elseif( is_active_sidebar( 'foodbook_blog_sidebar' ) ){
				$foodbook_blog_column = 'col-lg-8';
			}else{
				$foodbook_blog_column = 'col-lg-12';
			}

			echo '<div class="'.esc_attr( $foodbook_blog_column ).'">';

		        echo '<div class="row blog-masonary">';
		}
	}


	// Blog Column Divider Start Function
	if( !function_exists( 'foodbook_blog_details_column_divider_start_wrapper_cb' ) ){
		function foodbook_blog_details_column_divider_start_wrapper_cb(){
			if( class_exists( 'ReduxFramework' ) && is_active_sidebar( 'foodbook_blog_sidebar' ) ){
				$foodbook_blog_layout = foodbook_opt( 'foodbook_blog_single_layout' );
				if( $foodbook_blog_layout == '1' ){
					$foodbook_blog_column = 'col-lg-12';
				}elseif( $foodbook_blog_layout == '2' ){
					$foodbook_blog_column = 'col-lg-8 order-last';
				}elseif( $foodbook_blog_layout == '3' ){
					$foodbook_blog_column = 'col-lg-8';
				}else{
					$foodbook_blog_column = 'col-lg-8';
				}
			}elseif( is_active_sidebar( 'foodbook_blog_sidebar' ) ){
				$foodbook_blog_column = 'col-lg-8';
			}else{
				$foodbook_blog_column = 'col-lg-12';
			}
			echo '<div class="'.esc_attr( $foodbook_blog_column ).'">';
		}
	}

	// Page Column Divider Start Function
	if( !function_exists( 'foodbook_page_column_divider_start_wrapper_cb' ) ){
		function foodbook_page_column_divider_start_wrapper_cb(){
			if( class_exists( 'ReduxFramework' ) && is_active_sidebar( 'foodbook_page_sidebar' ) ){
				$foodbook_page_layout = foodbook_opt( 'foodbook_page_layout' );
				if( $foodbook_page_layout == '1' ){
					$foodbook_page_column = 'col-lg-12';
				}elseif( $foodbook_page_layout == '2' ){
					$foodbook_page_column = 'col-lg-8 order-last';
				}elseif( $foodbook_page_layout == '3' ){
					$foodbook_page_column = 'col-lg-8';
				}else{
					$foodbook_page_column = 'col-lg-8';
				}
			}elseif( is_active_sidebar( 'foodbook_page_sidebar' ) ){
				$foodbook_page_column = 'col-lg-8';
			}else{
				$foodbook_page_column = 'col-lg-12';
			}
			echo '<div class="'.esc_attr( $foodbook_page_column ).'">';
		}
	}

	// Blog Sidebar Wrapper
	if( !function_exists( 'foodbook_blog_sidebar_wrapper_cb' ) ){
		function foodbook_blog_sidebar_wrapper_cb(){
			$foodbook_blog_layout = foodbook_opt( 'foodbook_blog_layout' );
			if( $foodbook_blog_layout != '1' ){
				get_sidebar();
			}
		}
	}

	// Blog Single Page Sidebar Wrapper
	if( !function_exists( 'foodbook_blog_single_sidebar_wrapper_cb' ) ){
		function foodbook_blog_single_sidebar_wrapper_cb(){
			$foodbook_blog_single_layout = foodbook_opt( 'foodbook_blog_single_layout' );
			if( $foodbook_blog_single_layout != '1' ){
				get_sidebar();
			}
		}
	}

	// Blog Single Page Sidebar Wrapper
	if( !function_exists( 'foodbook_page_sidebar_wrapper_cb' ) ){
		function foodbook_page_sidebar_wrapper_cb(){
			$foodbook_page_sidebar_layout = foodbook_opt( 'foodbook_page_layout' );
			if( $foodbook_page_sidebar_layout != '1' ){
				get_sidebar( 'page' );
			}
		}
	}

	// Blog Post Column
	if( !function_exists( 'foodbook_blog_post_column_cb' ) ){
		function foodbook_blog_post_column_cb(){
		$foodbook_post_column = foodbook_opt( 'foodbook_post_column' );
		if( class_exists( 'ReduxFramework' ) ){
			if( $foodbook_post_column == '1' ){
				$foodbook_blog_post_column = 'col-sm-12';
			}elseif(  $foodbook_post_column == '2' ){
				$foodbook_blog_post_column = 'col-sm-6';
			}elseif(  $foodbook_post_column == '3' ){
				$foodbook_blog_post_column = 'col-sm-4';
			}elseif(  $foodbook_post_column == '4' ){
				$foodbook_blog_post_column = 'col-sm-3';
			}else{
				$foodbook_blog_post_column = 'col-sm-6';
			}
		}else{
			$foodbook_blog_post_column = 'col-sm-6';
		}

		echo '<div class="'.esc_attr( $foodbook_blog_post_column . ' grid-item' ).'">';
		}
	}

	// Global Double Div End
	if( !function_exists( 'foodbook_double_div_end_wrapper_cb' ) ){
		function foodbook_double_div_end_wrapper_cb(){
				echo '</div>';
			echo '</div>';
		}
	}
	// Global Single Div End
	if( !function_exists( 'foodbook_single_div_end_wrapper_cb' ) ){
		function foodbook_single_div_end_wrapper_cb(){
			echo '</div>';
		}
	}

	// Blog Style Two Author Enable Disable
	if( !function_exists( 'foodbook_blog_author_enable_disable_cb' ) ){
		function foodbook_blog_author_enable_disable_cb(){
			if( class_exists( 'ReduxFramework' ) ){
				$foodbook_author_enable = foodbook_opt( 'foodbook_author_enable' );
				if( $foodbook_author_enable ){
					$foodbook_author_enable = true;
				}else{
					$foodbook_author_enable = false;
				}
			}else{
				$foodbook_author_enable = true;
			}
			if( $foodbook_author_enable ){
				echo '<li>'.esc_html__( 'Posted By:','foodbook' ).' <a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">'.esc_html( ucwords( get_the_author() ) ).'</a></li>';
			}
		}
	}


	// Blog Style Two Comment Enable Disable
	if( !function_exists( 'foodbook_blog_comment_enable_disable_cb' ) ){
		function foodbook_blog_comment_enable_disable_cb(){
			if( class_exists( 'ReduxFramework' ) ){
				$foodbook_comment_enable = foodbook_opt( 'foodbook_comment_enable' );
				if( $foodbook_comment_enable ){
					$foodbook_comment_enable = true;
				}else{
					$foodbook_comment_enable = false;
				}
			}else{
				$foodbook_comment_enable = true;
			}

			if( $foodbook_comment_enable ){
				echo '<li>';
				esc_html( comments_number( 'Comment: ','Comment: ','Comments: ' ) );
				echo '<span>'.esc_html( get_comments_number() ).'</span></li>';
			}
		}
	}

	// Blog Post Excerpt
	if( !function_exists( 'foodbook_blog_post_excerpt_cb' ) ){
		function foodbook_blog_post_excerpt_cb(){
			// Bizdidea Excerpt
			echo foodbook_paragraph_tag( array(
				'text'  => esc_html( get_the_excerpt() ),
				'class'	=> esc_attr( 'blog-excerpt' )
			) );
		}
	}

	// Blog Read More Button Text
	if( !function_exists( 'foodbook_blog_read_more_button_cb' ) ){
		function foodbook_blog_read_more_button_cb(){
			// Read More Button Text
			if( class_exists( 'ReduxFramework' ) ){
				if( foodbook_opt( 'foodbook_button_text' ) ){
					$foodbook_read_more_button_text = foodbook_opt( 'foodbook_button_text' );
				}
			}else{
				$foodbook_read_more_button_text = 'Read More';
			}
			if( !empty( $foodbook_read_more_button_text ) ){
				echo '<a href="'.esc_url( get_the_permalink() ).'" class="btn-inline">'.esc_html( $foodbook_read_more_button_text ).'</a>';
			}
		}
	}

	// Post Pagination
	if( !function_exists( 'foodbook_blog_post_pagination_cb' ) ){
		function foodbook_blog_post_pagination_cb(){
			if( class_exists( 'ReduxFramework' ) ){
				$foodbook_pagination_position = foodbook_opt( 'foodbook_pagination_position' );
				if( $foodbook_pagination_position == 'center' ){
					$pagination_position = 'justify-content-center';
				}else{
					$pagination_position = '';
				}
			}else{
				$pagination_position = 'justify-content-center';
			}
			if( get_previous_posts_link() || get_next_posts_link() ):
				echo '<div class="row">';
					echo '<div class="col-12">';
		                echo '<div class="pagination '.esc_attr( $pagination_position ).'">';
							echo '<ul class="nav align-items-center">';
								if( get_previous_posts_link() ) {
									echo '<li class="nav-btn prev">';
										previous_posts_link( '<i class="fa fa-angle-left"></i>' );
				                    echo '</li>';
								}
								$blog_paginate_links = paginate_links( array(
									'prev_next'          => false,
									'type'               => 'array',
								) );
								echo '<li>';
									echo join( '</li><li>', $blog_paginate_links );
								echo '</li>';
								if( get_next_posts_link() ) {
									echo '<li class="nav-btn next">';
										next_posts_link('<i class="fa fa-angle-right"></i>');
				                    echo '</li>';
								}
			                echo '</ul>';
		                echo '</div>';
		            echo '</div>';
	            echo '</div>';
			endif;
		}
	}

	// Single Post Navigation
	if( !function_exists( 'foodbook_single_post_navigation_cb' ) ){
		function foodbook_single_post_navigation_cb(){
			if( class_exists( 'ReduxFramework' ) ){
				$navigation_on_off = foodbook_opt( 'foodbook_enable_disable_navigation' );
			}else{
				$navigation_on_off = true;
			}
			if( $navigation_on_off ):
				$foodbook_prev_post = get_previous_post();
				$foodbook_next_post = get_next_post();
				if( !empty( $foodbook_prev_post ) && !empty( $foodbook_next_post ) ){
					$foodbook_div_pagination = ' d-flex';
				}else{
					$foodbook_div_pagination = '';
				}
				if( empty( $foodbook_prev_post ) || empty( $foodbook_next_post ) ){
					$foodbook_pagination_single_class = ' mw-100';
				}else{
					$foodbook_pagination_single_class = '';
				}
				if( $foodbook_prev_post || $foodbook_next_post ):

		?>
	<!-- Post Pagination Begin -->
	<div class="post-pagination<?php echo esc_attr( $foodbook_div_pagination );?> align-items-center justify-content-between flex-column flex-md-row">
		<!-- Single Post Pagination Begin -->
		<?php
			if( $foodbook_prev_post ) :
		?>
		<div class="single-post-pagination mb-50 mb-md-0 prev<?php echo esc_attr( $foodbook_pagination_single_class );?>">
			<a class="media align-items-center" href="<?php echo esc_url( get_permalink( $foodbook_prev_post->ID ) ); ?>">
				<?php if( get_the_post_thumbnail( $foodbook_prev_post->ID ) ):?>
				<div class="pagination-image">
					<?php echo wp_kses_post( get_the_post_thumbnail( $foodbook_prev_post->ID,array( 70, 70) ) ); ?>
					<i class="fa fa-angle-left"></i>
				</div>
				<?php endif;?>
				<div class="media-body">
					<span class="posted-on"><?php echo esc_html( get_the_time( 'd M Y',$foodbook_prev_post->ID ) );?></span>
					<h5><?php echo wp_kses_post( $foodbook_prev_post->post_title );?></h5>
				</div>
			</a>
		</div>
		<?php
			endif;
			if( $foodbook_next_post ):
		?>
		<div class="single-post-pagination mb-50 mb-md-0 next<?php echo esc_attr( $foodbook_pagination_single_class );?>">
			<a class="media flex-row-reverse" href="<?php echo esc_url( get_permalink( $foodbook_next_post->ID ) ); ?>">
				<?php if( get_the_post_thumbnail( $foodbook_next_post->ID ) ):?>
				<div class="pagination-image">
					<?php echo wp_kses_post( get_the_post_thumbnail( $foodbook_next_post->ID,array( 70, 70) ) ); ?>
					<i class="fa fa-angle-right"></i>
				</div>
				<?php endif;?>
				<div class="media-body text-right">
					<span class="posted-on"><?php echo esc_html( get_the_time( 'd M Y',$foodbook_next_post->ID ) );?></span>
					<h5><?php echo wp_kses_post( $foodbook_next_post->post_title );?></h5>
				</div>
			</a>
		</div>
		<?php endif;?>
		<!-- Single Post Pagination End -->
	</div>
	<!-- Post Pagination End -->
	<?php
		endif;
		endif;
		}
	}

	// Blog Post Comments Show Function
	if( !function_exists( 'foodbook_single_post_comments_show_wrap_cb' ) ){
		function foodbook_single_post_comments_show_wrap_cb(){
			// Comment Template
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
	}

	// Back To Top

	if( !function_exists( 'foodbook_back_to_top_cb' ) ){
		function foodbook_back_to_top_cb(){
			if( foodbook_opt( "foodbook_display_backtotop" ) ):
				echo '<!-- Back to Top Begin -->';
					echo '<a href="#" class="back-to-top">';
				        echo '<i class="fa fa-angle-up"></i>';
				    echo '</a>';
				echo '<!-- Back to Top End -->';
			endif;
		}
	}

	// footer Widget

	if( !function_exists( 'foodbook_footer_widget_cb' ) ){
		function foodbook_footer_widget_cb(){

				if( class_exists( 'ReduxFramework' ) && ( is_active_sidebar( 'footer_sidebar_one' ) || is_active_sidebar( 'footer_sidebar_two' ) || is_active_sidebar( 'footer_sidebar_three' ) || is_active_sidebar( 'footer_sidebar_four' ) ) ){
					$foodbook_footer_widget_enable = foodbook_opt( 'foodbook_footerwidget_enable' );
				}else{
					$foodbook_footer_widget_enable = '';
				}

				$foodbook_footer_widget_col = foodbook_opt( 'foodbook_footercol_switch' );


		        $foodbook_footer_widget_col_val = "";

				if( $foodbook_footer_widget_col == '1' ) {
	                $foodbook_footer_widget_col_val = '6';
	            }elseif( $foodbook_footer_widget_col == '2' ) {
	                $foodbook_footer_widget_col_val = '4';
	            }else{
	                $foodbook_footer_widget_col_val = '3';
	            }

				if( $foodbook_footer_widget_enable == '1' ){
					$foodbook_footer_padding_div = 'pt-60';
				}else{
					$foodbook_footer_padding_div = '';
				}

				if( class_exists( 'ReduxFramework' ) ){
					$foodbook_footer_bottom_active = foodbook_opt( 'foodbook_disable_footer_bottom' );
				}else{
					$foodbook_footer_bottom_active = '1';
				}

				if( $foodbook_footer_widget_enable == '1' || $foodbook_footer_bottom_active == '1' ):

		    ?>
		    <!-- Footer Begin -->
		    <footer class="footer c1-bg <?php echo esc_attr( $foodbook_footer_padding_div );?>">
				<?php
					if( foodbook_opt( 'foodbook_footer_style' ) == '1' ):
				?>
				<!-- Footer Top Begin -->
				<?php if( $foodbook_footer_widget_enable == '1' ):?>
				<div class="footer-top">
		        	<div class="container">
			            <div class="row">
			                <?php
			                    if( $foodbook_footer_widget_col == '1' || $foodbook_footer_widget_col == '2' || $foodbook_footer_widget_col == '3' ) :
			                        if( is_active_sidebar( 'footer_sidebar_one' ) ) :
			                ?>
			                <div class="col-lg-<?php echo esc_attr( $foodbook_footer_widget_col_val ); ?> col-sm-6">
			                    <?php
			                        dynamic_sidebar( 'footer_sidebar_one' );
			                    ?>
			                </div>
			                <?php
			                        endif;
			                    endif;

			                    if( $foodbook_footer_widget_col == '1' || $foodbook_footer_widget_col == '2' || $foodbook_footer_widget_col == '3' ) :
			                        if( is_active_sidebar( 'footer_sidebar_two' ) ) :
			                ?>
			                <div class="col-lg-<?php echo esc_attr( $foodbook_footer_widget_col_val ); ?> col-sm-6">
			                    <?php
			                        dynamic_sidebar( 'footer_sidebar_two' );
			                    ?>
			                </div>
			                <?php
			                        endif;
			                    endif;

			                    if( $foodbook_footer_widget_col != '1' ) :
			                        if( is_active_sidebar( 'footer_sidebar_three' ) ) :
			                ?>
			                <div class="col-lg-<?php echo esc_attr( $foodbook_footer_widget_col_val ); ?> col-sm-6">
			                    <?php
			                        dynamic_sidebar( 'footer_sidebar_three' );
			                    ?>
			                </div>
			                <?php
			                        endif;
			                    endif;

			                    if( $foodbook_footer_widget_col == '3' ) :
			                        if( is_active_sidebar( 'footer_sidebar_four' ) ):
			                ?>
			                <div class="col-lg-<?php echo esc_attr( $foodbook_footer_widget_col_val ); ?> col-sm-6">
			                    <?php
			                        dynamic_sidebar( 'footer_sidebar_four' );
			                    ?>
			                </div>
			                <?php
			                    endif;
			                endif;
			                ?>
			            </div>
		        	</div>
				</div>
				<?php endif;?>
				<!-- Footer Top End -->
				<?php
			 		else:
						echo '<div class="footer-top-style-two">';
				        	echo '<div class="container">';
						        echo '<div class="row">';
						        	echo '<div class="col-lg-12">';
										echo '<div class="foodbook-footer-top-content">';
											if( ! empty( foodbook_opt( 'foodbook_footer_logo','url' ) ) ){
							        			echo '<div class="footer-logo">';
													echo foodbook_img_tag( array(
														'url'	=> esc_url( foodbook_opt( 'foodbook_footer_logo','url' ) ),
													) );
						            			echo '</div>';
											}
											if( ! empty( foodbook_opt( 'foodbook_footer_description_text' ) ) ){
												echo '<span class="description">'.wp_kses_post( foodbook_opt( 'foodbook_footer_description_text' ) ).'</span>';
											}
											if( ! empty( foodbook_opt( 'foodbook_restaurant_opening_hour_text' ) ) ){
												echo '<p class="opening-hour">'.esc_html( foodbook_opt( 'foodbook_restaurant_opening_hour_text' ) ).'</p>';
											}
											if( class_exists( 'ReduxFramework' ) ){
												$placeholder = foodbook_opt( 'foodbook_newsletter_placeholder_text' );
											}else{
												$placeholder = esc_html__( 'Enter Your Email', 'foodbook' );
											}

											if( foodbook_opt( 'foodbook_disable_newletter' ) ){
												echo '<div class="newsletter-content newsletter-form">';
													echo '<form method="post" name="mc-embedded-subscribe-form" target="_blank" class="newsletter-form" id="subscribe_submit">';
														echo '<div class="theme-input-group">';
															echo '<input id="sectsubscribe_email" name="sectsubscribe_email" type="email" placeholder="'.esc_attr( $placeholder ).'" required>';
															echo '<button name="sectsubscribe" type="submit">';
																echo esc_html__( 'SUBSCRIBE','foodbook' );
															echo '</button>';
														echo '</div>';
													echo '</form>';
												echo '</div>';
											}
											if( has_nav_menu( 'footer-menu' ) && foodbook_opt( 'foodbook_disable_footer_menu' ) ){
												echo '<div class="footer-menu">';
													wp_nav_menu( array(
			                                            'theme_location'    => 'footer-menu',
			                                            'container'         => '',
			                                            'menu_class'        => 'nav align-items-center',
			                                        ) );
												echo '</div>';
											}
					            		echo '</div>';
					            	echo '</div>';
					            echo '</div>';
				        	echo '</div>';
						echo '</div>';
					endif;
				?>
				<!-- Footer Bottom Begin -->
				<?php if( $foodbook_footer_bottom_active == '1' ):?>
			    <div class="footer-bottom">
			        <div class="container">
			            <div class="row">
			                <div class="col-lg-12">
								<?php if( !class_exists( 'ReduxFramework' ) ):?>
				                	<p class="text-center"><?php echo sprintf( '&copy; Developed by <a href="%s">%s</a>, %s',esc_url('#'),esc_html__('Themelooks','foodbook'),date('Y') ); ?></p>
								<?php else:?>
									<p class="text-center">
										<?php echo wp_kses_post( foodbook_opt( 'foodbook_footer_text' ) );?>
									</p>
								<?php endif;?>
			                </div>
			            </div>
			        </div>
			    </div>
				<?php endif;?>
			    <!-- Footer Bottom End -->
		    </footer>
			<!-- Footer End -->
			<?php
			endif;
		}
	}