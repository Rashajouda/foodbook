<?php
namespace FoodBookLite;

/**
 * Foodbooklite admin
 *
 * @package     Foodbooklite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

if( !class_exists( 'Admin_Templates_Map' ) ) {

	class Admin_Templates_Map {


		function __construct() {}

		public function admin_page_init() {
			$this->admin_page_maping();
		}

		public function admin_page_maping() {

			echo '<div class="foodbooklite-wrapper"><form id="foodbooklite_settings_from" action="options.php" method="post">';

	            // check if the user have submitted the settings
                if ( isset( $_GET['settings-updated'] ) ) {
                // add settings saved message with the class of "updated"
                add_settings_error( 'foodbooklite_messages', 'foodbooklite_message', esc_html__( 'Settings Saved', 'foodbooklite' ), 'updated' );
                }
                //
                settings_fields( 'foodbooklite_settings_option_group' ); 
                //
                do_settings_sections( 'foodbooklite_settings_option_group' ); 

                // show error/update messages
                settings_errors( 'foodbooklite_messages' );
				
				echo '<div class="settings-wrapper">';

				$this->tab();
				echo '<div class="content-wrapper">';
				$this->content();
				// Save Buton
				echo '<div class="container">';
					submit_button( 'Save Settings' );
				echo '</div>';

				echo '</div></div>';

			echo '</form></div>';

		}

		public function tab() {
			?>
			<div class="tab-btn">
			    <div class="container">
			        <ul class="list-unstyled">
			        	<li data-tab-select="general" class="active"><i class="fa fa-home"></i> <?php esc_html_e( 'General', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="delivertimebranch"><i class="fa fa-truck"></i> <?php esc_html_e( 'Delivery Settings', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="kitchenopt"><i class="fa fa-tools"></i> <?php esc_html_e( 'Kitchen Options', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="orderReceived"><i class="fa fa-pager"></i><?php esc_html_e( 'Order Received Pgae', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="pagesettings"><i class="fa fa-cog"></i><?php esc_html_e( 'Page Settings', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="colorsettings"><i class="fa fa-fill"></i><?php esc_html_e( 'Color Settings', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="locationSettings"><i class="fa fa-map"></i><?php esc_html_e( 'Location Settings', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="emailsettings"><i class="fa fa-envelope"></i><?php esc_html_e( 'Email Settings', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="statustext"><i class="fa fa-envelope"></i><?php esc_html_e( 'Status Text', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="shortcodelist"><i class="fa fa-code"></i><?php esc_html_e( 'Shortcode List', 'foodbooklite' ); ?></li>
			        	<li data-tab-select="gopro"><i class="fa fa-crown"></i><?php esc_html_e( 'Go Pro', 'foodbook-lite' ); ?></li>
			        </ul>
			    </div>
			</div>
			<?php
		}

		public function content() {
			
			echo '<div class="tab-content">';
				$this->general();
				$this->delivertimebranch_tab();
				$this->kitchen_options_tab();
				$this->order_received_tab();
				$this->page_settings();
				$this->color_settings();
				$this->location_settings();
				$this->email_settings();
				$this->statustext();
				$this->shortcode_list();
				$this->go_pro();

	        echo '</div>';
			
		}

		public function general() {

			?>
			<div data-tab="general" class="active" style="display: block;">
                <div class="container">
                	<?php 
					$options = get_option('foodbooklite_options');
                	?>
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">

						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Search Section Show', 'foodbooklite' ); ?></h4>
							<?php $checkedVal = isset( $options['search-section'] ) ? $options['search-section'] : '' ?>
							<input type="checkbox" name="foodbooklite_options[search-section]" value="yes" <?php checked( esc_html( $checkedVal ), 'yes'  ); ?>  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Add To Cart Button Show', 'foodbooklite' ); ?></h4>
							<?php $checkedVal = isset( $options['show-cart-button'] ) ? $options['show-cart-button'] : '' ?>
							<input type="checkbox" name="foodbooklite_options[show-cart-button]" value="yes" <?php checked( esc_html( $checkedVal ), 'yes'  ); ?>  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Product Per Page', 'foodbooklite' ); ?></h4>
							<?php $limit = isset( $options['product-limit'] ) ? $options['product-limit'] : '6' ?>
							<input type="number" name="foodbooklite_options[product-limit]" value="<?php echo esc_attr( $limit ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Product Layout', 'foodbooklite' ); ?></h4>
							<select name="foodbooklite_options[product-layout]">
								<?php $layout = !empty( $options['product-layout'] ) ? $options['product-layout'] : ''; ?>
								<option value="grid" <?php selected( $layout, 'grid' ); ?>><?php esc_html_e( 'Grid Column', 'foodbooklite' ); ?></option>
								<option value="list" <?php selected( $layout, 'list' ); ?>><?php esc_html_e( 'List Column', 'foodbooklite' ); ?></option>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Product Column', 'foodbooklite' ); ?></h4>
							<select name="foodbooklite_options[product-column]">
								<?php $column = !empty( $options['product-column'] ) ? $options['product-column'] : ''; ?>
								<option value="6" <?php selected( $column, '6' ); ?>><?php esc_html_e( '2 Column', 'foodbooklite' ); ?></option>
								<option value="4" <?php selected( $column, '4' ); ?>><?php esc_html_e( '3 Column', 'foodbooklite' ); ?></option>
								<option value="3" <?php selected( $column, '3' ); ?>><?php esc_html_e( '4 Column', 'foodbooklite' ); ?></option>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Manager Page Order Notification Delay Time ( default 6 second )', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
							<input type="number" disabled placeholder="<?php esc_attr_e( '6', 'foodbooklite' );  ?>" value="" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Set List View Product Description Characters', 'foodbooklite' ); ?></h4>
							<?php $characters = isset( $options['desc-characters'] ) ? $options['desc-characters'] : '100' ?>
							<input type="number" name="foodbooklite_options[desc-characters]" value="<?php echo esc_attr( $characters ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Order Button Text', 'foodbooklite' ); ?></h4>
							<?php $btnText = isset( $options['order-btn-text'] ) ? $options['order-btn-text'] : '' ?>
							<input type="text" name="foodbooklite_options[order-btn-text]" value="<?php echo esc_attr( $btnText ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
					        <h4><?php esc_html_e( 'Order Button Icon', 'foodbooklite' ); ?></h4>
					        <?php $val = isset( $options['order-btn-icon'] ) ? $options['order-btn-icon'] : '' ?>
					        <input class="foodbooklite_background_image" type="text" name="foodbooklite_options[order-btn-icon]" value="<?php echo esc_attr( $val ); ?>" />
					        <input type="button" class="foodbooklite_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload', 'vpns' ) ?>" />
				        </div>
				        <div class="foodbooklite-admin-field">
					        <h4><?php esc_html_e( 'Order Button Hover Icon', 'foodbooklite' ); ?></h4>
					        <?php $val = isset( $options['order-btn-hover-icon'] ) ? $options['order-btn-hover-icon'] : '' ?>
					        <input class="foodbooklite_background_image" type="text" name="foodbooklite_options[order-btn-hover-icon]" value="<?php echo esc_attr( $val ); ?>" />
					        <input type="button" class="foodbooklite_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload', 'vpns' ) ?>" />
				        </div>
						<div class="foodbooklite-admin-field">
					        <h4><?php esc_html_e( 'Cart Button Icon', 'foodbooklite' ); ?></h4>
					        <?php $val = isset( $options['cart-btn-icon'] ) ? $options['cart-btn-icon'] : '' ?>
					        <input class="foodbooklite_background_image" type="text" name="foodbooklite_options[cart-btn-icon]" value="<?php echo esc_attr( $val ); ?>" />
					        <input type="button" class="foodbooklite_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload', 'vpns' ) ?>" />
				        </div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Branch Type', 'foodbooklite' ); ?><span class="pro-label">Pro</span></h4>
							<select disabled>
								<option value="single"><?php esc_html_e( 'Single Branch', '' ); ?></option>
								<option value="multi"><?php esc_html_e( 'Multi Branch', '' ); ?></option>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Notification Audio Loop', 'foodbooklite' ); ?><span class="pro-label">Pro</span></h4>
							<input type="checkbox" disabled value="yes" />
						</div>
						<div class="foodbooklite-admin-field">
					        <h4><?php esc_html_e( 'Upload Notification Audio MP3', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
					        <input class="foodbooklite_background_image" type="text" value="" readonly />
					        <input type="button" class="foodbooklite_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload MP3', 'vpns' ) ?>" disabled />
				        </div>

                    </div>
                </div>
	        </div>
			<?php
		}

		public function delivertimebranch_tab() {
			
			$options = get_option('foodbooklite_options');
                	
			?>
			<div data-tab="delivertimebranch" style="display: none;">
				
                <div class="container">
                    <!-- Dashboard Content Wrapper -->

                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">
                    	<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Checkout Page Delivery Option Show/Hide', 'foodbooklite' ); ?></h4>
							<?php $checkedVal = isset( $options['checkout-delivery-option'] ) ? $options['checkout-delivery-option'] : '' ?>
							<input type="checkbox" name="foodbooklite_options[checkout-delivery-option]" value="yes" <?php checked( esc_html( $checkedVal ), 'yes'  ); ?>  />
						</div>
                    	<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Set Delivery Options', 'foodbooklite' ); ?></h4>
							<?php $savedVal = !empty( $options['delivery-options'] ) ? $options['delivery-options'] : ''; ?>
							<select name="foodbooklite_options[delivery-options]">
								<option value="none" <?php selected( esc_html( $savedVal ), 'none' ); ?>><?php esc_html_e( 'None', 'foodbooklite' ); ?></option>
								<option value="all" <?php selected( esc_html( $savedVal ), 'all' ); ?>><?php esc_html_e( 'Delivery/Pickup Both', 'foodbooklite' ); ?></option>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Set Delivery Fee', 'foodbooklite' ); ?></h4>
							<?php $delivery = isset( $options['delivery-fee'] ) ? $options['delivery-fee'] : '' ?>
							<input type="number" name="foodbooklite_options[delivery-fee]" value="<?php echo esc_attr( $delivery ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Deliver/Pickup Time and Date Show/Hide', 'foodbooklite' ); ?></h4>
							<?php $checkedVal = isset( $options['pickup-time-switch'] ) ? $options['pickup-time-switch'] : '' ?>
							<input type="checkbox" name="foodbooklite_options[pickup-time-switch]" value="yes" <?php checked( esc_html( $checkedVal ), 'yes'  ); ?>  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Pre order active', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
							<input type="checkbox" value="yes" disabled />
						</div>
			            <div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Order Delivery Start Time', 'foodbooklite' ); ?></h4>
							<div class="pickup-time-clock">
								<?php $deliveryStartTime = isset( $options['delivery-start-time'] ) ? $options['delivery-start-time'] : '' ?>
								<input type="text" class="time-picker" name="foodbooklite_options[delivery-start-time]" value="<?php echo esc_attr( $deliveryStartTime ); ?>" />
				            </div>
			            </div>
			            <div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Order Delivery End Time', 'foodbooklite' ); ?></h4>
							<div class="pickup-time-clock">
								<?php $deliveryEndTime = isset( $options['delivery-end-time'] ) ? $options['delivery-end-time'] : '' ?>
								<input type="text" class="time-picker" name="foodbooklite_options[delivery-end-time]" value="<?php echo esc_attr( $deliveryEndTime ); ?>" />
				            </div>
			            </div>
			            <div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Delivery Time Format', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
							<select disabled>
								<option value="12"><?php esc_html_e( '12 Hour', 'foodbooklite' ); ?></option>
								<option value="24"><?php esc_html_e( '24 Hour', 'foodbooklite' ); ?></option>
							</select>
						</div>
			            <div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Delivery Time Slot', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
							<select disabled>
								<option value="2,30"><?php esc_html_e( '30min', 'foodbooklite' ); ?></option>
								<option value="1,60"><?php esc_html_e( '60min', 'foodbooklite' ); ?></option>
								<option value="2,120"><?php esc_html_e( '120min', 'foodbooklite' ); ?></option>
								<option value="3,180"><?php esc_html_e( '180min', 'foodbooklite' ); ?></option>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Pre Order Days Limit', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
							<input type="number" value="" disabled />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Set Time Zone', 'foodbooklite' ); ?></h4>
							<div class="i-group">
								<?php $timeZone = isset( $options['time-zone'] ) ? $options['time-zone'] : ''; ?>
								<input type="text" name="foodbooklite_options[time-zone]" placeholder="<?php esc_html_e( 'Asia/Dhaka', 'foodbook' ); ?>" value="<?php echo esc_attr( $timeZone ); ?>" />
								<p style="margin:3px 0px"><?php esc_html_e( 'Set time zone like ( Asia/Dhaka )', 'foodbooklite' ); ?></p>
							</div>
						</div>
                    </div>

                </div>
	        </div>
			<?php
		}

		public function kitchen_options_tab() {
			?>
			<div data-tab="kitchenopt" class="fbl-position-relative" style="display: none;">
				<?php 
				// Promo
                $this->promo();
				?>
                <div class="container">
                    <!-- Dashboard Content Wrapper -->
                    
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Branch Transfer Option', 'foodbooklite' ); ?></h4>
							<input type="checkbox" value="yes"  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Deliver Boy Assign Option', 'foodbooklite' ); ?></h4>
							<input type="checkbox" value="yes" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'All Order Show In Kitchen', 'foodbooklite' ); ?></h4>
							<input type="checkbox" value="yes"/>
						</div>
                    </div>

                </div>
	        </div>
			<?php
		}

		public function order_received_tab() {
			?>
			<div data-tab="orderReceived" class="" style="display: none;">
                <div class="container">
                    <!-- Dashboard Content Wrapper -->
                    <?php 
					$options = get_option('foodbooklite_options');
                	?>
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">								
						<div class="foodbooklite-admin-field">
					        <h4><?php esc_html_e( 'Page Top Image', 'foodbooklite' ); ?></h4>
					        <?php $val = isset( $options['received-page-img'] ) ? $options['received-page-img'] : '' ?>
					        <input class="foodbooklite_background_image" type="text" name="foodbooklite_options[received-page-img]" value="<?php echo esc_attr( $val ); ?>" />
					        <input type="button" class="foodbooklite_image_upload_btn button-primary" value="<?php esc_html_e( 'Upload', 'vpns' ) ?>" />
				        </div>

						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Page Title', 'foodbooklite' ); ?></h4>
							<?php $val = isset( $options['received-page-title'] ) ? $options['received-page-title'] : '' ?>
							<input type="text" name="foodbooklite_options[received-page-title]" value="<?php echo esc_html( $val ); ?>"  />
						</div>
						<div class="foodbooklite-admin-field admin-field-textarea">
							<h4><?php esc_html_e( 'Page Description ', 'foodbooklite' ); ?></h4>
							<?php $val = isset( $options['received-description'] ) ? $options['received-description'] : '' ?>
							<textarea name="foodbooklite_options[received-description]" ><?php echo esc_html( $val ); ?></textarea>

						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Active Invitation Option', 'foodbooklite' ); ?></h4>
							<?php $checkedVal = isset( $options['active-invitation'] ) ? $options['active-invitation'] : '' ?>
							<input type="checkbox" name="foodbooklite_options[active-invitation]" value="yes" <?php checked( esc_html( $checkedVal ), 'yes'  ); ?>  />
						</div>
						<div class="foodbooklite-admin-field admin-field-textarea">
							<h4><?php esc_html_e( 'Invitation Message Subject', 'foodbooklite' ); ?></h4>
							<?php $val = isset( $options['invitation-subject'] ) ? $options['invitation-subject'] : '' ?>
							<textarea name="foodbooklite_options[invitation-subject]" ><?php echo esc_html( $val ); ?></textarea>

						</div>
						<div class="foodbooklite-admin-field admin-field-textarea">
							<h4><?php esc_html_e( 'Invitation Message', 'foodbooklite' ); ?></h4>
							<?php $val = isset( $options['invitation-message'] ) ? $options['invitation-message'] : '' ?>
							<textarea name="foodbooklite_options[invitation-message]" ><?php echo esc_html( $val ); ?></textarea>

						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Twitter Share Link', 'foodbooklite' ); ?></h4>
							<?php $val = isset( $options['twitter-share-link'] ) ? $options['twitter-share-link'] : '' ?>
							<input type="text" name="foodbooklite_options[twitter-share-link]" value="<?php echo esc_html( $val ); ?>"  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Facebook Share Link', 'foodbooklite' ); ?></h4>
							<?php $val = isset( $options['facebook-share-link'] ) ? $options['facebook-share-link'] : '' ?>
							<input type="text" name="foodbooklite_options[facebook-share-link]" value="<?php echo esc_html( $val ); ?>"  />
						</div>

                    </div>

                </div>
	        </div>
			<?php
		}

		//
		public function page_settings() {

			?>
			<div data-tab="pagesettings" style="display: none;">
                <div class="container">
                	<?php
					$options = get_option('foodbooklite_options');
                	?>
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Select Foodbooklite Shop Page', 'foodbooklite' ); ?></h4>
							<select name="foodbooklite_options[shop-page]">
								<?php
								$pages = get_pages();

								foreach( $pages as $page ) {

									echo '<option value="'.esc_attr( $page->post_name ).'" '.selected( esc_html( $options['shop-page'] ),  $page->post_name, false ).'>'.esc_html( $page->post_title ).'</option>';

								}
								?>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Select Branch Manager Page', 'foodbooklite' ); ?> <span class="pro-label">Pro</span></h4>
							<select disabled>
								<?php
								$pages = get_pages();

								foreach( $pages as $page ) {

									echo '<option value="'.esc_attr( $page->post_name ).'" '.selected( esc_html( $options['branch-manager'] ),  $page->post_name, false ).'>'.esc_html( $page->post_title ).'</option>';

								}
								?>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Select Kitchen Manager Page', 'foodbooklite' ); ?><span class="pro-label">Pro</span></h4>
							<select disabled>
								<?php
								$pages = get_pages();

								foreach( $pages as $page ) {

									echo '<option value="'.esc_attr( $page->post_name ).'" '.selected( esc_html( $options['kitchen-manager'] ),  $page->post_name, false ).'>'.esc_html( $page->post_title ).'</option>';

								}
								?>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Select Delivery Page', 'foodbooklite' ); ?><span class="pro-label">Pro</span></h4>
							<select disabled>
								<?php
								$pages = get_pages();

								foreach( $pages as $page ) {

									echo '<option value="'.esc_attr( $page->post_name ).'" '.selected( esc_html( $options['delivery'] ),  $page->post_name, false ).'>'.esc_html( $page->post_title ).'</option>';

								}
								?>
							</select>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Select Admin Page', 'foodbooklite' ); ?><span class="pro-label">Pro</span></h4>
							<select disabled>
								<?php
								$pages = get_pages();

								foreach( $pages as $page ) {

									echo '<option value="'.esc_attr( $page->post_name ).'" '.selected( esc_html( $options['admin'] ),  $page->post_name, false ).'>'.esc_html( $page->post_title ).'</option>';

								}
								?>
							</select>
						</div>

                    </div>

                </div>
	        </div>
			<?php
		}
		//
		public function color_settings() {

			?>
			<div data-tab="colorsettings" style="display: none;">
                <div class="container">
                	<?php
					$options = get_option('foodbooklite_options');
                	?>
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">
						<div class="foodbooklite-admin-field">
							<?php $mainColor = isset( $options['main-color'] ) ? $options['main-color'] : '' ?>
							<h4><?php esc_html_e( 'Main Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[main-color]" value="<?php echo esc_html( $mainColor ); ?>" />
						</div>

						<div class="foodbooklite-admin-field">
							<?php $btnBgColor = isset( $options['btn-bg-color'] ) ? $options['btn-bg-color'] : '' ?>
							<h4><?php esc_html_e( 'Order Button Background Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[btn-bg-color]" value="<?php echo esc_html( $btnBgColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $btnColor = isset( $options['btn-color'] ) ? $options['btn-color'] : '' ?>
							<h4><?php esc_html_e( 'Order Button Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[btn-color]" value="<?php echo esc_html( $btnColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $btnHoverBgColor = isset( $options['btn-hover-bg-color'] ) ? $options['btn-hover-bg-color'] : '' ?>
							<h4><?php esc_html_e( 'Order Button Hover Background Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[btn-hover-bg-color]" value="<?php echo esc_html( $btnHoverBgColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $btnHoverColor = isset( $options['btn-hover-color'] ) ? $options['btn-hover-color'] : '' ?>
							<h4><?php esc_html_e( 'Order Button Hover Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[btn-hover-color]" value="<?php echo esc_html( $btnHoverColor ); ?>" />
						</div>
						
						<!--  -->

						<div class="foodbooklite-admin-field">
							<?php $gobBtnBgColor = isset( $options['gob-btn-bg-color'] ) ? $options['gob-btn-bg-color'] : '' ?>
							<h4><?php esc_html_e( 'Global Button Background Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[gob-btn-bg-color]" value="<?php echo esc_html( $gobBtnBgColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $gobBtnColor = isset( $options['gob-btn-color'] ) ? $options['gob-btn-color'] : '' ?>
							<h4><?php esc_html_e( 'Global Button Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[gob-btn-color]" value="<?php echo esc_html( $gobBtnColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $gobBtnHoverBgColor = isset( $options['gob-btn-hover-bg-color'] ) ? $options['gob-btn-hover-bg-color'] : '' ?>
							<h4><?php esc_html_e( 'Global Button Hover Background Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[gob-btn-hover-bg-color]" value="<?php echo esc_html( $gobBtnHoverBgColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $gobBtnHoverColor = isset( $options['gob-btn-hover-color'] ) ? $options['gob-btn-hover-color'] : '' ?>
							<h4><?php esc_html_e( 'Global Button Hover Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[gob-btn-hover-color]" value="<?php echo esc_html( $gobBtnHoverColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $cartBtnBg = isset( $options['cart-btn-bg'] ) ? $options['cart-btn-bg'] : '' ?>
							<h4><?php esc_html_e( 'Cart Button background', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[cart-btn-bg]" value="<?php echo esc_html( $cartBtnBg ); ?>" />
						</div>

						<div class="foodbooklite-admin-field">
							<?php $cartBtnCountBackground = isset( $options['cart-btn-count-bg'] ) ? $options['cart-btn-count-bg'] : '' ?>
							<h4><?php esc_html_e( 'Cart Button Count background', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[cart-btn-count-bg]" value="<?php echo esc_html( $cartBtnCountBackground ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $cartBtnCountColor = isset( $options['cart-btn-count-color'] ) ? $options['cart-btn-count-color'] : '' ?>
							<h4><?php esc_html_e( 'Cart Button Count Text Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[cart-btn-count-color]" value="<?php echo esc_html( $cartBtnCountColor ); ?>" />
						</div>

						<div class="foodbooklite-admin-field">
							<?php $categoryItemOddBg = isset( $options['category-item-odd-bg'] ) ? $options['category-item-odd-bg'] : '' ?>
							<h4><?php esc_html_e( 'Category Item Odd Background', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[category-item-odd-bg]" value="<?php echo esc_html( $categoryItemOddBg ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $categoryItemColor = isset( $options['category-item-color'] ) ? $options['category-item-color'] : '' ?>
							<h4><?php esc_html_e( 'Category Item Text Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[category-item-color]" value="<?php echo esc_html( $categoryItemColor ); ?>" />
						</div>

						<div class="foodbooklite-admin-field">
							<?php $matBg = isset( $options['mat-bg'] ) ? $options['mat-bg'] : '' ?>
							<h4><?php esc_html_e( 'My Account Tab Background', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[mat-bg]" value="<?php echo esc_html( $matBg ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $matTextColor = isset( $options['mat-text-color'] ) ? $options['mat-text-color'] : '' ?>
							<h4><?php esc_html_e( 'My Account Tab Text Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[mat-text-color]" value="<?php echo esc_html( $matTextColor ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $matHoverBg = isset( $options['mat-hover-bg'] ) ? $options['mat-hover-bg'] : '' ?>
							<h4><?php esc_html_e( 'My Account Tab Hover Background', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[mat-hover-bg]" value="<?php echo esc_html( $matHoverBg ); ?>" />
						</div>
						<div class="foodbooklite-admin-field">
							<?php $matHoverTextColor = isset( $options['mat-hover-text-color'] ) ? $options['mat-hover-text-color'] : '' ?>
							<h4><?php esc_html_e( 'My Account Tab Hover Text Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" name="foodbooklite_options[mat-hover-text-color]" value="<?php echo esc_html( $matHoverTextColor ); ?>" />
						</div>

                    </div>

                </div>
	        </div>
			<?php
		}

		//
		public function location_settings() {
			
			?>
			<div data-tab="locationSettings" class="fbl-position-relative" style="display: none;">
				<?php
				// Promo
                $this->promo();
				?>
			    <div class="container">

                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Location Type', 'foodbooklite' ); ?></h4>
							<select>
								<option value="address"><?php esc_html_e( 'Address', 'foodbooklite' ); ?></option>
								<option value="zip"><?php esc_html_e( 'Zip Code', 'foodbooklite' ); ?></option>
							</select>
						</div>
                    	<div class="foodbooklite-admin-field fb-zip-conditional-field">
							<h4><?php esc_html_e( 'Add Single Branch Shop Zip Code', 'foodbooklite' ); ?></h4>
							<div class="pickup-time-repeater">
				                <div class="field-wrapper">
				                <?php
				                if( !empty( $options['delivery_zip'] ) ):
				                  foreach ( $options['delivery_zip'] as $value ) :
				                ?>
				                  <div class="single-field">
				                  <input type="text" value="<?php echo esc_attr( $value ); ?>" />
				                  </div>
				                <?php 
				                endforeach;
				            	else:
				            	?>
				            	<div class="single-field">
				                  <input type="text" />
				                </div>
				            	<?php
				                endif
				                ?>
				                </div>
				            </div>
			            </div>

						<div class="foodbooklite-admin-field fb-address-conditional-field">
							<h4><?php esc_html_e( 'Set Google API Key', 'foodbooklite' ); ?></h4>
							<div class="group-field">
								
								<input type="text" style="width:340px" value="" />
								<p><a href="http://console.cloud.google.com/" target="_blank"><?php esc_html_e( 'Create google API ', 'foodbooklite' ); ?></a></p>
							</div>
						</div>
						<div class="foodbooklite-admin-field fb-address-conditional-field">
							<h4><?php esc_html_e( 'Set Single Branch Shop Location', 'foodbooklite' ); ?></h4>
							<div class="field-group">
								<div class="pac-card" id="pac-card">
					                <div>
					                  <div id="title"> <?php esc_html_e( 'Search Shop Location', 'foodbooklite' ); ?> </div>
					                </div>
					                <div id="pac-container">
					                  <input id="pac-input" style="width:340px" type="text" placeholder="<?php esc_html_e( 'Enter a location', 'foodbooklite' ); ?>" value="" />
					                </div>
				              	</div>
								<div id="infowindow-content">
									<img src="" width="16" height="16" id="place-icon" />
									<span id="place-name" class="title"></span><br />
									<span id="place-address"></span>
								</div>
							</div>
						</div>
						<div class="foodbooklite-admin-field fb-address-conditional-field">
							<h4><?php esc_html_e( 'Set Distance Restrict (KM)', 'foodbooklite' ); ?></h4>
							<input type="number" value="" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Location Modal Popup Active', 'foodbooklite' ); ?></h4>
							<input type="checkbox" value="yes" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Checkout Page Delivery Location Checker Active', 'foodbooklite' ); ?></h4>
							<input type="checkbox" value="yes" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Set Delivery Availability Checker Modal Show Page', 'foodbooklite' ); ?></h4>
							
							<select multiple>
								<?php
								$pages = get_pages();

								foreach( $pages as $key => $page ) {

									echo '<option value="'.esc_attr( $page->post_name ).'">'.esc_html( $page->post_title ).'</option>';
								}
								?>
							</select>
						</div>

                    </div>
                </div>
			</div>
			<?php
		}

		//
		public function email_settings() {
			
			?>
			<div data-tab="emailsettings" class="fbl-position-relative" style="display: none;">
				<?php
				// Promo
                    $this->promo();
				?>
                <div class="container">
                    <!-- Dashboard Content Wrapper -->
                    
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">

                    	<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Active Email Notification', 'foodbooklite' ); ?></h4>
							
							<input type="checkbox" value="yes" />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Subject Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Order Cancel Notification Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Send To Cooking Notification Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Accept Cooking Notification Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Cooking Complete Notification Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'On The Way Notification Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Delivery Complete Notification Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Email Template Header Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Email Template Footer Text', 'foodbooklite' ); ?></h4>
							<input type="text" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Email Template Header Background Color', 'foodbooklite' ); ?></h4>
							<input type="text" class="fb-color-field" value="" />
						</div>
                    </div>

                </div>
	        </div>
			<?php
		}

		//
		public function statustext() {
			// 
			?>
			<div data-tab="statustext" class="fbl-position-relative" style="display: none;">
				<?php 
				// Promo
                    $this->promo();
				?>
                <div class="container">
                    <!-- Dashboard Content Wrapper -->
                    
                    <!-- Dashboard Content Wrapper -->
                    <div class="dashboard-content-wrap">
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Order Cancel Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Order Cancel', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'New Order Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'New Order', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Send To Cooking Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Send To Cooking', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Cooking Processing Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Cooking Processing', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Cooking Completed Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Cooking Completed', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Waiting For Kitchen Accept Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Waiting For Kitchen Accept', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'On The Way Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'On The Way', 'foodbooklite' ); ?>" value=""/>
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Ready To Delivery Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Ready To Delivery', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Delivery Completed Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Delivery Completed', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Order Placed Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Order Placed', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Accepted Cooking Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Accepted Cooking', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'Processing Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'Processing', 'foodbooklite' ); ?>" value=""  />
						</div>
						<div class="foodbooklite-admin-field">
							<h4><?php esc_html_e( 'On The Way To Delivery Text', 'foodbooklite' ); ?></h4>
							<input type="text" placeholder="<?php esc_attr_e( 'On The Way To Delivery', 'foodbooklite' ); ?>" value=""  />
						</div>
                    </div>
                </div>
	        </div>
			<?php

		}
		//
		public function shortcode_list() {
			
			?>
			<div data-tab="shortcodelist" style="display: none;">
			    <div class="container">
			    	<div class="dashboard-content-wrap">
			    		<h3><?php esc_html_e( 'Shortcode List', 'foodbooklite' ); ?></h3>

			    		<div class="shortcode-item-list">
			    			<h4><?php esc_html_e( 'Product Page Shortcode', 'foodbooklite' ); ?></h4>
			    			<code>[foodbooklite_products]</code>
			    		</div>
			    		
			    	</div>
				</div>
			</div>
			<?php
		}
		//
		public function go_pro() {
			?>
			<div data-tab="gopro" style="display: none;">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-6 col-sm-6 col-12">
							<div class="fb-single-Statistics">
								<h3><?php esc_html_e( 'Foodbook Pro Version Available', 'foodbook-lite' ); ?></h3>
								<br>
								<br>
								<a href="https://codecanyon.net/item/foodbook-online-food-ordering-system-for-wordpress/27669182?s_rank=1" target="_blank" class="button button-primary"><?php esc_html_e( 'Buy Now', 'foodbook-lite' ); ?></a>
							</div>
							<div class="fb-single-Statistics">
								<h3><?php esc_html_e( 'FoodBook Multibranch Add-on', 'foodbook-lite' ); ?></h3>
								<br>
								<br>
								<a href="https://codecanyon.net/item/foodbook-multibranch-addon/27973503?s_rank=1" target="_blank" class="button button-primary"><?php esc_html_e( 'Buy Now', 'foodbook-lite' ); ?></a>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<div class="fb-single-Statistics" style="text-align: left">
								<h3><?php esc_html_e( 'Some features list of pro version', 'foodbook-lite' ); ?></h3>
								<ol>
									<li><?php esc_html_e( 'Easy WooCommerce Food Order System', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Ajax Quick search', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Single Page Cart System', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Ajax Category Filter', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Ajax Pagination', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Delivery type select option ( Delivery/pickup )', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Delivery/pickup time select option', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Extra Item feature add option', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Item instructions option', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Build with Order management system', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Branch manager order control admin', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Kitchen manager order control admin', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Order delivery manage admin for delivery man', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Order status Change Option', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Order statistics show in manager admin', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Easy Order Filter option', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Order Filter By Date option', 'foodbook-lite' ); ?></li>
									<li><?php esc_html_e( 'Custom Sign in/ Sign up Page', 'foodbook-lite' ); ?></li>
								</ol>
							</div>
						</div>
					</div>
            	</div>
            </div>
			<?php
		}
		// 
		public function promo() {
			?>
			<div class="fbl-overlay"><div class="fbl-promo-inner"><h3>Order management system is a pro version features </h3><a href="<?php echo esc_url( FOODBOOK_PRO_URL ); ?>" class="button button-primary fbl-buy" target="_blank">Buy Now</a></div></div>
			<?php
		}



	}

}
