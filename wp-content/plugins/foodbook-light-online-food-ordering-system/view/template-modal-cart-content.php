<script type="text/html" id="tmpl-fb_cart_items">
  <div class="fb_steps_content step-cart">
      <!-- Cart Form -->
      <form action="#" class="fb_cart_form">
        <div class="fb_row">
          <div class="fb_col_12">
            <!-- Card -->
            <div class="fb_card">
              <!-- Card Title -->
              <div class="fb_card_title fb_d_md_flex fb_align_items_center fb_justify_content_between">
                <h3><?php esc_html_e( 'Shopping Cart :', 'foodbooklite' ); ?></h3>
                <small> <?php echo sprintf( esc_html__( 'In your bag %s items', 'foodbooklite' ), "{{data.cart_count}}" ); ?></small>
              </div>
              <!-- End Card Title -->

              	<!-- Cart Table -->
              	<# if( !data.cart_count  ){ #>
					<p><?php esc_html_e( 'Your cart is currently empty.', 'foodbooklite' ); ?></p>
				<# } else { #>
              	<table class="fb_cart_table">
					<thead>
						<tr>
							<th><?php esc_html_e( 'Image', 'foodbooklite' ); ?></th>
							<th><?php esc_html_e( 'Name', 'foodbooklite' ); ?></th>
							<th><?php esc_html_e( 'Qty', 'foodbooklite' ); ?></th>
							<th><?php esc_html_e( 'Extra Items Price', 'foodbooklite' ); ?></th>
							<th><?php esc_html_e( 'Price', 'foodbooklite' ); ?></th>
							<th><?php esc_html_e( 'Subtotal', 'foodbooklite' ); ?></th>
							<th><?php esc_html_e( 'Remove', 'foodbooklite' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<# _.each( data.items, function(item) { #>
							<tr>
								<td>
									<!-- Cart Item Image -->
									<div class="fb_cart_item_image">
										{{{item.image}}}
									</div>
									<!-- End Cart Item Image -->
								</td>

								<td>
									<!-- Cart Item Title -->
									<div class="fb_cart_item_title">
										{{item.title}}
										<br>
										<# if( item.instructions ) { #>
										<ul class="fb_list_unstyled">
											<li><?php esc_html_e( 'Instructions:', 'foodbooklite' ); ?> {{item.instructions}}</li>
										</ul>
										<# } #>

										<# if( item.extra_options ) { #>
										<ul class="fb_list_unstyled">
											<li><?php esc_html_e( 'Extra Item:- ', 'foodbooklite' ); ?> {{item.extra_options}} </li>
										</ul>
										<# } #>
										
										<# if( item.variation_data ){ #>
										<ul class="fb_list_unstyled">
										<# _.each( item.variation_data, function( item, key ) { #>
											
											<li><span>{{key.replace( "attribute_pa_", "" ).replace( /-/g, " " )}} : </span><span>{{item}}</span></li>

										<# } ) #>
										</ul>
										<# } #>
									</div>
									<!-- End Cart Item Title -->
								</td>

								<td>
									<!-- Cart Item Quantity -->
									<div class="fb_quantity" >
										{{item.quantity}}
									</div>
									<!-- Cart Item Quantity -->
								</td>

								<td>
									<!-- Addons Price -->
									<# if( item.extra_options_total_price ) { #>
										<div class="fb_cart_item_price">
											{{{item.extra_options_total_price}}}
										</div>
									<# } #>
									<!-- End Addons Price -->
								</td>

								<td>
									<!-- Item Price -->
									<div class="fb_cart_item_price">
										{{{item.price}}}
									</div>
									<!-- End Item Price -->
								</td>
							
								<td>
									<!-- Sub Total -->
									<# if( item.item_sub_total ) { #>
										<div class="fb_cart_item_price">
											{{{item.item_sub_total}}}
										</div>
									<# } #>
									<!-- End Sub Total -->
								</td>

								<td>
									<!-- Cart Item Remove -->
									<a href="#" class="remove_cart_item fb_remove_btn fb_d_inline_flex fb_align_items_center fb_justify_content_center" data-quantity={{item.quantity}} data-cart_item_key={{item.cart_item_key}} data-product_id={{item.id}} data-product_sku={{item.sku}} class="fb_remove_btn fb_d_flex fb_align_items_center remove fb_justify_content_center">
									<img
										src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/remove.svg'; ?>"
										class="fb_svg"/>
									</a>
									<!-- End Cart Item Remove -->
								</td>
							</tr>
						<# } ) #>
					</tbody>
				</table>
				<# } #>
			  <!-- End Cart Table -->
			  
			  	<div class="fb_text_right">
					<# if( data.cart_count > 0 ) { #>
						<p class="fb_total_cart fb_label_title">
						<span><?php esc_html_e( 'Total Cost :', 'foodbooklite' ); ?></span>
						<span class="fb_total_price">{{{data.cart_total}}}</span>
						</p>
						<div class="fb_order_btn_group">
						<a href="#" class="fb_close_modal_btn fb_btn_fill fb_buy_more"><?php esc_html_e( 'Buy More', 'foodbooklite' ); ?></a>
						<!-- fb_checkout_order -->
						<# var isLogin ="";  if( !foodbookliteobj.is_login && foodbookliteobj.woo_guest_user_allow != 'yes' ) { isLogin = "fb_checkout_order" } #>
						<a href="<?php echo wc_get_checkout_url(); ?>" class="fb_btn_fill {{isLogin}}"><?php esc_html_e( 'Checkout', 'foodbooklite' ); ?></a>
						</div>
						<# } 
					#>
				</div>
            </div>
            <!-- End Card -->
          </div>
        </div>
      </form>
      <!-- End Cart Form -->
  </div>
</script>