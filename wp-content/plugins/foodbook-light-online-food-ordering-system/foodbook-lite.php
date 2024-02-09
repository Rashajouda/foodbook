<?php
/**
 * Plugin Name:       Foodbook Lite - Online Food Ordering System
 * Plugin URI:        https://www.themelooks.com/blog/
 * Description:       FoodBookLite is a Online Food Ordering system for WordPress. It is developed based on woocommerce. It is a standalone WordPress plugin which allows you to easily add Food Ordering System to your WordPress Website. Using FoodBookLite you can easily receive both PickUp and Delivery orders.
 * Version:           1.4.4
 * Author:            ThemeLooks
 * Author URI:        https://themelooks.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       foodbooklite
 * Domain Path:       /languages
 */

/**
 * Define all constant
 *
 */

// Version constant
if( !defined( 'FOODBOOKLITE_VERSION' ) ) {
	define( 'FOODBOOKLITE_VERSION', '1.4.4' );
}

// Plugin dir path constant
if( !defined( 'FOODBOOKLITE_DIR_PATH' ) ) {
	define( 'FOODBOOKLITE_DIR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}
// Plugin dir url constant
if( !defined( 'FOODBOOKLITE_DIR_URL' ) ) {
	define( 'FOODBOOKLITE_DIR_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}
// Plugin dir admin assets url constant
if( !defined( 'FOODBOOKLITE_DIR_ADMIN_ASSETS_URL' ) ) {
	define( 'FOODBOOKLITE_DIR_ADMIN_ASSETS_URL', trailingslashit( FOODBOOKLITE_DIR_URL . 'admin/assets' ) );
}
// Admin dir path
if( !defined( 'FOODBOOKLITE_DIR_ADMIN' ) ) {
	define( 'FOODBOOKLITE_DIR_ADMIN', trailingslashit( FOODBOOKLITE_DIR_PATH.'admin' ) );
}
// Inc dir path
if( !defined( 'FOODBOOKLITE_DIR_INC' ) ) {
	define( 'FOODBOOKLITE_DIR_INC', trailingslashit( FOODBOOKLITE_DIR_PATH.'inc' ) );
}
// Inc dir path
if( !defined( 'FOODBOOK_PRO_URL' ) ) {
	define( 'FOODBOOK_PRO_URL', 'https://codecanyon.net/item/foodbook-online-food-ordering-system-for-wordpress/27669182' );
}


final class FoodBookLite {

	private static $instance = null;
		
	function __construct() {
		add_action( 'init', [ $this, 'foodbooklite_load_textdomain' ] );
		register_deactivation_hook( __FILE__, [ $this, 'foodbooklite_plugin_deactivate' ] );
		register_activation_hook( __FILE__, [ $this, 'foodbooklite_plugin_activate' ] );
		add_action( 'plugins_loaded', [ $this, 'foodbooklite_is_woocommerce_activated'] );
	}
	
	public static function getInstance() {
		
		if( is_null( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load plugin textdomain.
	 */
	public function foodbooklite_load_textdomain() {
	    load_plugin_textdomain( 'foodbooklite', false, FOODBOOKLITE_DIR_PATH . 'languages' ); 
	}

	/**
	 * Check WooCommerce is activated or not
	 * 
	 */
	public function foodbooklite_is_woocommerce_activated() {

		if ( class_exists( 'woocommerce' ) ) {
			require_once( FOODBOOKLITE_DIR_PATH.'foodbooklite-init.php' );
		} else {
			add_action( 'admin_notices', [ $this, 'foodbooklite_activation_admin_notice' ] );
		}

	}
	
	/**
	 * foodbooklite_activation_admin_notice description
	 * 
	 * If wooocommerce plugin not active 
	 * show the admin notification to active woocommerce plugin 
	 * 
	 * @return 
	 */
	public function foodbooklite_activation_admin_notice() {
	    $url = "https://wordpress.org/plugins/woocommerce/";
	    ?>
	    <div class="notice notice-error is-dismissible">
	        <h4><?php echo sprintf( esc_html__( 'FoodBookLite requires the WooCommerce plugin to be installed and active. You can download %s woocommerce %s here. Thanks.', 'foodbooklite' ), '<a href="'.esc_url( $url ).'" target="_blank">','</a>' ); ?></h4>
	    </div>
	    <?php
	}


	/**
	 * foodbooklite_default_pages_list 
	 * @return array
	 */
	public function foodbooklite_default_pages_list() {

	  return [
	    "foodbooklite"    => "FoodBookLite"
	  ];

	}

	/**
	 * foodbooklite_insert_page 
	 * Add plugin default page
	 * @return 
	 * 
	 */
	public function foodbooklite_insert_page() {

	  $getPages = $this->foodbooklite_default_pages_list();

	  foreach( $getPages as $page_title ) {

		  // Create page object
		  $page = array(
		    'post_type'     => 'page',
		    'post_title'    => wp_strip_all_tags( $page_title ),
		    'post_status'   => 'publish'
		  );
		   
		  // Insert the post into the database
		  wp_insert_post( $page );
	  
	  }

	}

	/**
	 * foodbooklite_delete_page description
	 * @return 
	 */
	public function foodbooklite_delete_page() {

	    // Pages
	   $getPages = $this->foodbooklite_default_pages_list();
	    
	    //
	    foreach( $getPages as $key => $page ){
	      $page_data  = get_page_by_path( $key );
	      
	      wp_delete_post( $page_data->ID );
	    }

	}

	/**
	 * foodbooklite_plugin_activate
	 * @return 
	 */
	public function foodbooklite_plugin_activate() {

		// Insert default pages
		$this->foodbooklite_insert_page();

		// Default options set
		$defaultOption = array(

			"product-limit" 	=> 6,
			"search-section" 	=> 'yes',
			"show-cart-button" 	=> 'yes',
			"checkout-delivery-option" 	=> 'yes',
			"pickup-time-switch" 		=> 'yes',
			"delivery-options" 	=> 'all',
			"shop-page" 		=> 'foodbooklite'
		);

		update_option( 'foodbooklite_options', $defaultOption );


	}
	
	/**
	 * foodbooklite_plugin_deactivate 
	 * @return 
	 */
	public function foodbooklite_plugin_deactivate() {

		// Delete default pages
		$this->foodbooklite_delete_page();

		//
		delete_option('foodbooklite_options');

	}
	

	
}

// Init FoodBookLite class
FoodBookLite::getInstance();
