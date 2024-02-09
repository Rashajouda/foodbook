<?php
namespace FoodBookLite;
/**
 *
 * @package     Foodbooklite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Woo_Product_Tab{

	function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'foodbooklite_admin_scripts' ] );
		add_filter( 'woocommerce_product_data_tabs', [ $this, 'foodbooklite_custom_product_data_tab' ] );
		add_action( 'admin_head', [ $this, 'foodbooklite_woo_product_tab_custom_style' ] );
		add_action('woocommerce_product_data_panels', [ $this, 'foodbooklite_custom_product_data_fields' ] );
		add_action( 'woocommerce_process_product_meta', [ $this, 'foodbooklite_save_proddata_custom_fields' ]  );
	}


	public function foodbooklite_admin_scripts() {

		wp_enqueue_style( 'foodbooklite-woo-admin', plugin_dir_url( __FILE__ ).'css/woo-admin.css' , array(), '1.0.0', 'all' );
		wp_enqueue_script( 'foodbooklite-woo-admin', plugin_dir_url( __FILE__ ) .'js/woo-admin.js', array('jquery'), '1.0.0', true );
		
	}


	// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter

	public function foodbooklite_custom_product_data_tab( $product_data_tabs ) {
	    $product_data_tabs['foodbooklite-custom-tab'] = array(
	        'label' 	=> esc_html__( 'Add Features', 'foodbooklite' ),
	        'target' 	=> 'foodbooklite_custom_product_data',
	        'class'     => array( 'show_if_simple', 'show_if_variable' ),
	    );
	    return $product_data_tabs;
	}

	/** CSS To Add Custom tab Icon */
	public function foodbooklite_woo_product_tab_custom_style() {?>
	<style>
	#woocommerce-product-data ul.wc-tabs li.foodbooklite-custom-tab_options a:before { font-family: WooCommerce; content: '\e006'; }
	</style>
	<?php 
	}



	// functions you can call to output text boxes, select boxes, etc.


	public function foodbooklite_custom_product_data_fields() {
	    global $thepostid, $post;

	    $data = get_post_meta( $thepostid, '_extra_featured', true );

	    $decodedData = json_decode( $data, true );
	  
	    // Note the 'id' attribute needs to match the 'target' parameter set above
	    ?> 
	    <div id = 'foodbooklite_custom_product_data' class = 'panel woocommerce_options_panel' > 
		    <div class = 'options_group' >
		       
				<div class="foodbooklite-extra-featured">
					<div class="foodbooklite-extra-featured-inner">
						<?php
						if( !empty( $decodedData ) ):
							foreach ( $decodedData as $key => $value ):

							$checkValue = !empty( $value['list_type'] ) ? $value['list_type'] : '';

						?>
						<div class="foodbooklite-fields-group" data-count="0">
							<div class="group-title-wrapper group-title-wrapper-list-type form-field">
								<label><?php esc_html_e( 'List Type', 'foodbooklite' ); ?></label>
								<div class="group-title-wrapper-list-type-inner">
									<div>
										<span><?php esc_html_e( 'Checkbox', 'foodbooklite' ); ?></span>
										<input type="radio" name="extra_featured[<?php echo esc_attr( $key ); ?>][list_type]" value="checkbox" class="group-title" <?php echo checked( $checkValue, 'checkbox' ); echo !empty( $checkValue ) ? '' : 'checked'; ?>  />
									</div>
									<div>
										<span><?php esc_html_e( 'Radio', 'foodbooklite' ); ?></span>
										<input type="radio" name="extra_featured[<?php echo esc_attr( $key ); ?>][list_type]" value="radio" class="group-title" <?php echo checked( $checkValue, 'radio' ); ?> />
									</div>
								</div>
								
							</div>
							<p class="group-title-wrapper form-field">
								<label><?php esc_html_e( 'Feature Section Title', 'foodbooklite' ); ?></label>
								<input type="text" name="extra_featured[<?php echo esc_attr( $key ); ?>][group_title]" value="<?php echo esc_html( $value['group_title'] ); ?>" class="group-title" />
							</p>
							<div class="field-repeater-wrapper">
								<div class="field-repeater-inner">
								<?php
								if( !empty( $value['group_feature'] ) ):
									foreach ( $value['group_feature'] as $ckey => $value ):
								?>
									<div class="field-repeater">
										<input type="text" name="extra_featured[<?php echo esc_attr( $key ); ?>][group_feature][<?php echo esc_attr( $ckey ); ?>][title]" placeholder="Frature Title" value="<?php echo esc_html( $value['title'] ); ?>" class="group-title" />
										<input type="text" name="extra_featured[<?php echo esc_attr( $key ); ?>][group_feature][<?php echo esc_attr( $ckey ); ?>][price]" placeholder="Price" value="<?php echo esc_html( $value['price'] ); ?>" class="group-title wc_input_price" />
										<span class="remove-repeater-field fb-btn"><?php esc_html_e( 'Remove', 'foodbooklite' ); ?></span>
									</div>
								<?php 
									endforeach;
								endif;
								?>
								</div>
								<button class="add-repeater-field fb-btn fb-btn-margin-top fb-btn-margin-top fb-btn-margin-bottom"><?php esc_html_e( 'Add Features', 'foodbooklite' ); ?></button>
							</div>
							<span class="remove-group fb-btn fb-btn-margin-top fb-btn-margin-top"><?php esc_html_e( 'Remove Group', 'foodbooklite' ); ?></span>
						</div>	
						<?php 
							endforeach;
						endif;
						?>
					</div>
					<span class="add-group fb-btn"><?php esc_html_e( 'Add Group', 'foodbooklite' ); ?></span>
				</div>
		    </div>
	    </div>
	    <?php
	}

	/** Hook callback function to save custom fields information */
	public function foodbooklite_save_proddata_custom_fields( $post_id ) {
	    
	    // Save Text Field
	    if (!empty( $_POST['extra_featured'] )) {
	    	$featured = json_encode( $_POST['extra_featured'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
	    }
	    update_post_meta ( $post_id, '_extra_featured', sanitize_text_field( $featured ) );

	}



}

new Woo_Product_Tab();