<?php
	if ( ! defined( 'ABSPATH' ) ) {
	    exit( );
	}

	/**
	* @Packge 	   : Foodbook
	* @Version     : 1.0
	* @Author 	   : ThemeLooks
	* @Author URI  : https://www.themelooks.com/
	*
	*/

?>
	<!-- Widget Search Begin -->
	<?php
	 	if( is_404() ):
		if( class_exists( 'ReduxFramework' ) ){
			$foodbook_form_placeholder = foodbook_opt( 'foodbook_404_form_placeholder' );
		}else{
			$foodbook_form_placeholder = "Search here";
		}

		if( class_exists( 'ReduxFramework' ) ){
			$foodbook_404_button = foodbook_opt( 'foodbook_404_button' );
		}else{
			$foodbook_404_button = "Search";
		}
	?>
	<form action="<?php echo esc_url( home_url('/') );?>" method="GET">
		<div class="theme-input-group">
			<input name='s' type="text" placeholder="<?php echo esc_attr( $foodbook_form_placeholder );?>">
			<button type="submit"><?php echo esc_attr( $foodbook_404_button );?></button>
		</div>
	</form>
	<?php else:?>
	<form action="<?php echo esc_url( home_url('/') );?>" method="GET">
		<div class="theme-input-group">
			<input name='s' value="<?php echo wp_kses_post( get_search_query() );?>" placeholder="<?php echo esc_attr__( 'Search here....','foodbook' );?>" class="theme-input-style" required>
			<button type="submit" class="submit-btn">
				<?php
					echo esc_html__( 'Search','foodbook' );
				?>
			</button>
		</div>
	</form>
	<!-- Widget Search End -->
	<?php endif;