<script type="text/html" id="tmpl-fb_product_content">
<!-- Step Content -->
<div class="fb_steps_content step-product-info">
  <form action="#" id="fbs_single_add_to_cart_button" method="post" class="fb_product_details_form">
    <div class="fb_row">
      <div class="fb_col_lg_6">
        <div class="fb_row">
          <div class="fb_col_md_6">
            <!-- Product Details Image -->
            <div class="fb_product_details_img">
              <img src={{data.thumbnail}} alt="" />
            </div>
            <!-- End Product Details Image -->
          </div>
          <div class="fb_col_md_6">
            <!-- Product Details Content -->
            <div class="fb_product_details_content">
              <h3 class="fb_product_title">
                {{data.title}}
              </h3>
              <div class="fb-product-reviews">
                <div class="fb_star_rating">
                  {{{data.star_rating}}}
                </div>
                <span class="woocommerce-review-link fb-product-review">(<span class="count">{{data.reviewcount}}</span> <?php esc_html_e( 'customer reviews', 'foodbooklite'); ?>)</span>
              </div>             
              <h6>
              <?php esc_html_e( 'Price:', 'foodbooklite' ); ?>
              <# 
              var price = '';
              if( data.type == 'variable' ){
                if( data.regular_price && data.sale_price ) {
              #>
                  {{{ data.display_sale_price+' - '+data.display_regular_price }}}
              <#
                }
              } else {
  
                if( data.regular_price && data.sale_price ) {
                #>
                <p class="fb_product_price">      
                <span class="fb_old_price">{{{ data.display_regular_price }}}</span><span class="fb_new_price">{{{ data.display_sale_price }}}</span>                  
                </p>
                <#
                }else {
                #>
                <?php
                echo foodbooklite_currency_symbol_position( "{{data.display_price}}", false );
                ?>
                <#
                }

              }
              #>
              </h6>
              <p class="fb_product_summary">
                {{{data.description}}}
              </p>

              <!-- Extra Options -->
              <div class="fb_extra_options">
                <ul class="fb_list_unstyled">
                <# _.each( data.attributes, function( items, key ) {  #>
                  <li class="fb_label_title" data-product-attribute={{items.attribute}}>
                    {{key}}
                  </li>
                  <# _.each( items.options, function( item ) { #>
                  <li>
                    <# var t = items.name; var checked = ''; if( data.defaultAttributes == item.slug ) {  checked = 'checked' } #>
                    <span class="fb_custom_checkbox">
                      <label>
                        <input
                          type="radio"
                          value="{{item.name}}"
                          name="{{items.attribute}}"
                          data-name-attr="{{items.attribute}}"
                          data-name="{{item.name}}"
                          class="fb-product-attribute"
                          {{checked}}
                        />
                        <span class="fb_input_text"
                          >{{item.name}}</span>
                        <span
                          class="fb_custom_checkmark"
                        ></span>
                      </label>
                    </span>
                    <span class="fb-variable-price"></span>
                  </li>
                  <# } ) } ) #>
                </ul>
              </div>
              <!-- End Extra Options -->
              <!-- Quantity -->
              <div
                class="fb_d_flex fb_align_items_center fb_justify_content_between"
              >
                <span class="fb_label_title"><?php esc_html_e( 'Quantity', 'foodbooklite' ); ?></span>

                <div
                  class="fb_quantity fb_d_flex fb_align_items_center"
                >
                  <span
                    class="fb_minus fb_d_flex fb_align_items_center fb_justify_content_center"
                  >
                    <img
                      src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/minus.svg'; ?>"
                      class="fb_svg"
                      alt=""
                    />
                  </span>
                  <input
                    type="number"
                    class="fb_quantity_input"
                    name="fb_quantity"
                    value="1"
                    min="1"
                    disabled
                  />
                  <span
                    class="fb_plus fb_d_flex fb_align_items_center fb_justify_content_center"
                  >
                    <img
                      src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/plus.svg'; ?>"
                      class="fb_svg"
                      alt=""
                    />
                  </span>
                </div>
              </div>
              <!-- End Quantity -->
            </div>
            <!-- End Product Details Content -->
          </div>
        </div>
      </div>
      <div class="fb_col_lg_6">
        <div class="fb_row">
          <div class="fb_col_12">
            <!-- Card -->
            <div class="fb_card fb_mt_50 fb_mt_lg_0">
              <!-- Input List -->
              <# _.each( data.extraFeatured, function( item, i ) { #>
              <#
              var getListType = item.list_type,
                  listType = 'checkbox',
                  inputName = 'fb_product_extra_options';

              if( getListType != 'checkbox' ) {

                listType =  'radio';
                inputName =  'fb_product_extra_options_'+i;

              }

              #>

              <div class="fb_form_input_list">
                <h5 class="input_list_title">{{item.group_title}}</h5>
                <ul class="fb_list_unstyled">
                  <# _.each( item.group_feature, function( item, i ) { 
                  var p = item.price,
                      dataPrice = p.replace(',', '.'),
                      formatType = 'en-IN';

                      if( foodbookliteobj.wc_decimal_separator == ',' ) {
                        formatType = 'de-DE';
                      }
                  var y = new Intl.NumberFormat(formatType).format(dataPrice);
                  #>
                  <li>
                    <span class="fb_custom_checkbox extra_item_checkbox fb_w_100">
                      <label>
                        <input
                          class="product-extra-options"
                          type="{{listType}}"
                          data-price="{{dataPrice}}"
                          data-formatted-price ="{{item.title}} : <?php echo foodbooklite_currency_symbol_position( "{{y}}", false ); ?>";
                          value="{{dataPrice}}"
                          name="{{inputName}}[]"
                        />
                        <span
                          class="fb_input_text fb_d_flex fb_align_items_center fb_justify_content_between fb_w_100"
                          >{{item.title}}
                          <span>+ <?php echo foodbooklite_currency_symbol_position( "{{y}}" , false ); ?></span></span
                        >
                        <span
                          class="fb_custom_checkmark"
                        ></span>
                      </label>
                    </span>
                  </li>
                  <# } ) #>
                  
                </ul>
              </div>
              <# }  ) #>
              <!-- End Input List -->

              <!-- Input List -->
              <div class="fb_form_input_list">
                <h5 class="input_list_title">
                  <?php esc_html_e( 'Special Instructions?', 'foodbooklite' ); ?>
                </h5>
                <textarea
                  class="fb_input_style"
                  placeholder="<?php esc_attr_e( 'Add instructions...', 'foodbooklite' ); ?>"
                  name="item_instructions"
                ></textarea>
              </div>
              <!-- End Input List -->

              <!-- Total Price -->
              <div class="fb_label_title fb_total_price fb_d_flex fb_align_items_center fb_justify_content_between">
                <span><?php esc_html_e( 'Total Price', 'foodbooklite' ); ?></span>
                <span class="fb_total_Price" data-item-price={{data.price}}><?php echo foodbooklite_currency_symbol_position( "{{data.display_price}}" , false ); ?></span>
              </div>
              <!-- End Tolal Price -->
              <input type="hidden" name="product_id" value={{data.id}} />
              <input type="hidden" name="variation_id" class="variation_id" value="" />
              <input type="hidden" name="product_sku" value={{data.sku}} />

              <!-- Add To Cart -->
              <?php 
              $options = get_option('foodbooklite_options');
              if( !empty( $options['show-cart-button'] ) && $options['show-cart-button'] == 'yes'  ):
              ?>
              <button type="submit" class="fb_btn_fill fb_w_100 fb_add_to_cart_ajax ajax_add_to_cart" ><?php esc_html_e( 'Add to cart', 'foodbooklite' ); ?></button>
              <?php
              endif;
              ?>

              <div class="fb-after-cart-button" style="display:none"></div>
              <!-- End Add To Cart -->
              
            </div>
            <!-- End Card -->
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- End Step Content -->

</script>