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
	* Template Name: Template Builder
	*/

	// Call Header
	get_header();

	// Container or wrapper div
	$foodbook_custom_page_layout = foodbook_meta( 'custom_page_layout' );

	$foodbook_page_custom_padding = foodbook_meta( 'custom_page_padding' );

	if( $foodbook_page_custom_padding ){
		$foodbook_page_custom_padding = 'style="padding-top:'.esc_attr( $foodbook_page_custom_padding ).'px;padding-bottom:'.esc_attr( $foodbook_page_custom_padding ).'px;"';
	}else{
		$foodbook_page_custom_padding = '';
	}

	if( $foodbook_custom_page_layout == '1' ){
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
	}elseif( $foodbook_custom_page_layout == '2' ){
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
	}else{
		echo '<div class="foodbook-fluid">';
	}
		echo '<div class="builder-page-wrapper" '.wp_kses_post( $foodbook_page_custom_padding ).'>';

		// Query
		if( have_posts() ){
			while( have_posts() ){
				the_post();
				the_content();
			}
		}

		echo '</div>';

	if( $foodbook_custom_page_layout == '1' ){
		echo '</div></div></div>';
	}elseif( $foodbook_custom_page_layout == '2' ){
		echo '</div></div></div>';
	}else{
		echo '</div>';
	}
	// Container or wrapper div end

	// Call Footer
	get_footer();