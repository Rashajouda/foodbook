<?php
	function foodbook_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Blog Page Sidebar', 'foodbook' ),
				'id'            => 'foodbook_blog_sidebar',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'foodbook' ),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Page Sidebar', 'foodbook' ),
				'id'            => 'foodbook_page_sidebar',
				'description'   => esc_html__( 'Add Widgets Here To Appear In Your Page Sidebar.', 'foodbook' ),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3></div>',
			)
		);
		if( class_exists( 'ReduxFramework' ) ):
			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Sidebar One', 'foodbook' ),
					'id'            => 'footer_sidebar_one',
					'description'   => esc_html__( 'Add widgets here to appear in your footer sidebar.', 'foodbook' ),
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Sidebar Two', 'foodbook' ),
					'id'            => 'footer_sidebar_two',
					'description'   => esc_html__( 'Add widgets here to appear in your footer sidebar.', 'foodbook' ),
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Sidebar Three', 'foodbook' ),
					'id'            => 'footer_sidebar_three',
					'description'   => esc_html__( 'Add widgets here to appear in your footer sidebar.', 'foodbook' ),
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Sidebar Four', 'foodbook' ),
					'id'            => 'footer_sidebar_four',
					'description'   => esc_html__( 'Add widgets here to appear in your footer sidebar.', 'foodbook' ),
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				)
			);
		endif;

		if( class_exists('woocommerce') ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'WooCommerce Sidebar', 'foodbook' ),
					'id'            => 'foodbook_woo_sidebar',
					'description'   => esc_html__( 'Add widgets here to appear in your woocommerce page sidebar.', 'foodbook' ),
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				)
			);
		}
	}
	add_action( 'widgets_init', 'foodbook_widgets_init' );