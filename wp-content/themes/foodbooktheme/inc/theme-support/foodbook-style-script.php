<?php
	/**
	* foodbook functions and definitions
	*
	* @link https://developer.wordpress.org/themes/basics/theme-functions/
	*
	* @package foodbook
	*/

	if ( ! function_exists( 'foodbook_setup' ) ) :

		function foodbook_setup() {
			// text domain for translation.
			load_theme_textdomain( 'foodbook', FOODBOOK_THEME_DIR_PATH . '/languages' );

			// support title tage
			add_theme_support( 'title-tag' );

			// support logo
			add_theme_support( 'custom-logo' );

			//  support post format
			add_theme_support( 'post-formats', array( 'video', 'audio' ) );

			// support post-thumbnails
			add_theme_support( 'post-thumbnails' );

			// support automatic feed links
			add_theme_support( 'automatic-feed-links' );

			// support widget refersh
			add_theme_support( 'customize-selective-refresh-widgets' );

			// support html5
			add_theme_support( 'html5',
				array(
					'comment-list',
					'comment-form',
					'search-form',
					'caption'
				)
			);

			// Align Wide
			add_theme_support( 'align-wide' );

			// support woocommerce
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// register nav menu
			register_nav_menus( array(
				'primary-menu'   => esc_html__( 'Primary Menu', 'foodbook' ),
				'mobile-menu'    => esc_html__( 'Mobile Menu', 'foodbook' ),
				'footer-menu'    => esc_html__( 'Footer Menu', 'foodbook' ),
			) );

			// editor style
			add_editor_style( 'css/editor-style.css' );
		}
		/**
		* Register Google fonts for foodbook.
		*
		* Create your own foodbook_fonts_url() function to override in a child theme.
		*
		* @since foodbook 1.0
		*
		* @return string Google fonts URL for the theme.
		*/
		function foodbook_fonts_url() {
			$fonts_url = '';
			$fonts     = array();
			$subsets   = 'latin,latin-ext';

			if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'foodbook' ) ) {
				$fonts[] = 'Open Sans:400,500,700';
			}

			if ( $fonts ) {
				$fonts_url = add_query_arg( array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				), 'https://fonts.googleapis.com/css' );
			}

			return $fonts_url;
		}
	endif;
	add_action( 'after_setup_theme', 'foodbook_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function foodbook_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'foodbook_content_width', 751 );
}
add_action( 'after_setup_theme', 'foodbook_content_width', 0 );

function foodbook_alert_message(){
	add_action( 'admin_notices', 'foodbook_print_plugin_lacking_message' );
	set_transient( 'default-transient', 'yes', 0 );

	if( class_exists( 'FoodBook' ) ){
		delete_transient( 'default-transient' );
	}
}

function foodbook_print_plugin_lacking_message(){
	if( get_transient( 'default-transient' ) ){
		printf('<div class="notice notice-warning is-dismissible" style="color:#000000;background:#fbff004d;border-left-color: #ff0319;"><h3>Warning!</h3><p><strong>'.esc_html__('Please install and active foodbook plugin before demo import. Demo import will not work if you dont install foodbook plugin and active it.','foodbook').'</strong></p><p><a target="_blank" class="button button-primary" href="https://codecanyon.net/item/foodbook-online-food-ordering-system-for-wordpress/27669182">'.esc_html__('Download foodbook plugin from here.','foodbook').'</a></p></div>');
	}
}

foodbook_alert_message();



/**
* Enqueue scripts and styles.
*/
function foodbook_scripts() {

	$cssPath = FOODBOOK_THEME_CSS_DIR_URI;
	$jsPath  = FOODBOOK_JS_DIR_URI;
	$pluginPath  = FOODBOOK_PLUGINS_DIR_URI;

	wp_enqueue_style( 'foodbook-fonts', foodbook_fonts_url(), array(), null );

	wp_enqueue_style( 'bootstrap', $cssPath.'bootstrap.min.css',array(), '3.3.7' );

	wp_enqueue_style( 'font-awesome-all', $cssPath.'font-awesome.all.min.css',array(), '5.9.0' );

	wp_enqueue_style( 'font-awesome', $cssPath.'font-awesome.min.css',array(), '4.7' );

	wp_enqueue_style( 'owl-carousel', $pluginPath.'owlcarousel/owl.carousel.min.css',array(), '2.3.4' );

	wp_enqueue_style( 'foodbook-style', get_stylesheet_uri() );

    wp_enqueue_style( 'foodbook-main-style', $cssPath.'style.css' );

	// foodbook Script

	wp_enqueue_script( 'bootstrap-bundle', $jsPath.'bootstrap.bundle.min.js', array( 'jquery' ), '4.3.1', true );

	wp_enqueue_script( 'jquery-menu', $jsPath.'jquery.menu.min.js', array('jquery'),'', true );

	wp_enqueue_script( 'owl-carousel', $pluginPath.'owlcarousel/owl.carousel.min.js', array( 'jquery' ),'2.3.4', true );

	wp_enqueue_script( 'isotope-pkgd', $pluginPath.'isotope/isotope.pkgd.min.js', array( 'jquery' ),'3.0.5', true );

	wp_enqueue_script( 'foodbook-main-script', $jsPath.'main.js', array('jquery'), '1.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'foodbook_scripts' );