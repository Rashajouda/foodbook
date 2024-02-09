<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Foodbook Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Foodbook_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}


	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        // Register widget scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);

        // category register
        add_action( 'elementor/elements/categories_registered',[ $this, 'foodbook_elementor_widget_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'foodbook' ),
			'<strong>' . esc_html__( 'Foodbook Core', 'foodbook' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'foodbook' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'foodbook' ),
			'<strong>' . esc_html__( 'Foodbook Core', 'foodbook' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'foodbook' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'foodbook' ),
			'<strong>' . esc_html__( 'Foodbook Core', 'foodbook' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'foodbook' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( FOODBOOK_ADDONS . '/widgets/contact-form-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/google-map-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/section-title-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/contact-info-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/slider-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/blog-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/category-slider-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/service-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/pricing-table-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/button-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/list-item-widget.php' );
		require_once( FOODBOOK_ADDONS . '/widgets/testimonial-widget.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Contact_Form_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Google_Map_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Section_Title_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Contact_Info_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \BLog_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Category_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Service_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Pricing_Table_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Button_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \List_Item_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Testimonial_Widget() );
    }

    public function widget_scripts() {
        wp_enqueue_script(
            'foodbook-frontend-script',
            FOODBOOK_PLUGINURL . 'assets/js/foodbook-frontend.js',
            array('jquery'),
            false,
            true
		);
    }

    function foodbook_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'foodbook',
            [
                'title' => __( 'Foodbook', 'foodbook' ),
                'icon' => 'fa fa-plug',
            ]
        );
	}

}

Foodbook_Extension::instance();