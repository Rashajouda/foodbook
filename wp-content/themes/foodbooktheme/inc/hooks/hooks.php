<?php
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : foodbook
	* @Version     : 1.0
	* @Author 	   : ThemeLooks
	* @Author URI  : https://www.themelooks.com/
	*
	*/
	/**
	*
	* @ Foodbook Preloader
	*
	*/
	add_action( 'foodbook_preloader','foodbook_preloader_cb' );

	/**
	*
	* @ Foodbook Header
	*
	*/
	add_action( 'foodbook_header','foodbook_header_cb' );

	/**
	*
	* @ Foodbook Blog Post Thumb
	*
	*/
	add_action( 'foodbook_blog_posts_thumb','foodbook_blog_posts_thumb_cb' );

	/**
	*
	* @ Blog, Single Post, Archive, Page Wrapper Start Hook
	*
	*/
	add_action( 'foodbook_blog_section_wrapper_start','foodbook_blog_section_wrapper_start_cb' );

	/**
	*
	* @ Blog, Single Post, Archive, Page Wrapper End Hook
	*
	*/
	add_action( 'foodbook_blog_section_wrapper_end','foodbook_blog_section_wrapper_end_cb' );

	/**
	*
	* @ Blog Column Divider Start Wrapper
	*
	*/
	add_action( 'foodbook_blog_column_divider_start_wrapper','foodbook_blog_column_divider_start_wrapper_cb' );


	/**
	*
	* @ Blog Details Column Divider Start Wrapper
	*
	*/
	add_action( 'foodbook_blog_details_column_divider_start_wrapper','foodbook_blog_details_column_divider_start_wrapper_cb' );

	/**
	*
	* @ Page Column Divider Start Wrapper
	*
	*/
	add_action( 'foodbook_page_column_divider_start_wrapper','foodbook_page_column_divider_start_wrapper_cb' );

	/**
	*
	* @ Service Details Column Divider Start Wrapper
	*
	*/
	add_action( 'foodbook_service_details_column_divider_start_wrapper','foodbook_service_details_column_divider_start_wrapper_cb' );

	/**
	*
	* @ Blog Sidebar
	*
	*/
	add_action( 'foodbook_blog_sidebar_wrapper','foodbook_blog_sidebar_wrapper_cb' );

	/**
	*
	* @ Blog Sidebar For Single Page
	*
	*/
	add_action( 'foodbook_blog_single_sidebar_wrapper','foodbook_blog_single_sidebar_wrapper_cb' );

	/**
	*
	* @ Page Sidebar
	*
	*/
	add_action( 'foodbook_page_sidebar_wrapper','foodbook_page_sidebar_wrapper_cb' );

	/**
	*
	* @ Service Details Sidebar
	*
	*/
	add_action( 'foodbook_service_details_sidebar_wrapper','foodbook_service_details_sidebar_wrapper_cb' );


	/**
	*
	* @ Blog Post Column
	*
	*/
	add_action( 'foodbook_blog_post_column','foodbook_blog_post_column_cb' );

	/**
	*
	* @ Double Div End Wrapper
	*
	*/
	add_action( 'foodbook_double_div_end_wrapper','foodbook_double_div_end_wrapper_cb' );

	/**
	*
	* @ Single Div End Wrapper
	*
	*/
	add_action( 'foodbook_single_div_end_wrapper','foodbook_single_div_end_wrapper_cb' );

	/**
	*
	* @ Foodbook Blog Author Enable And Disable
	*
	*/
	add_action( 'foodbook_blog_author_enable_disable','foodbook_blog_author_enable_disable_cb' );


	/**
	*
	* @ Foodbook Blog Comment Enable And Disable
	*
	*/
	add_action( 'foodbook_blog_comment_enable_disable','foodbook_blog_comment_enable_disable_cb' );

	/**
	*
	* @ Foodbook Blog Post Excerpt Cb
	*
	*/
	add_action( 'foodbook_blog_post_excerpt','foodbook_blog_post_excerpt_cb' );


	/**
	*
	* @ Foodbook Blog Read More Button
	*
	*/
	add_action( 'foodbook_blog_read_more_button','foodbook_blog_read_more_button_cb' );

	/**
	*
	* @ Foodbook Blog Post Pagination
	*
	*/
	add_action( 'foodbook_blog_post_pagination','foodbook_blog_post_pagination_cb' );


	/**
	*
	* @ Foodbook Singe Post Navigation
	*
	*/
	add_action( 'foodbook_single_post_navigation','foodbook_single_post_navigation_cb' );

	/**
	*
	* @ Foodbook Blog Post Comment
	*
	*/
	add_action( 'foodbook_single_post_comments_show_wrap','foodbook_single_post_comments_show_wrap_cb' );

	/**
	*
	* @ Foodbook Back To Top
	*
	*/
	add_action( 'foodbook_back_to_top','foodbook_back_to_top_cb' );

	/**
	*
	* @ Foodbook Footer Widget
	*
	*/
	add_action( 'foodbook_footer_widget','foodbook_footer_widget_cb' );

	/**
	*
	* @ Foodbook Page Wrapper Start
	*
	*/
	add_action( 'foodbook_page_wrapper_start','foodbook_page_wrapper_start_cb' );
	/**
	*
	* @ Foodbook Page Wrapper End
	*
	*/
	add_action( 'foodbook_page_wrapper_end','foodbook_page_wrapper_end_cb' );