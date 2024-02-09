<script type="text/html" id="tmpl-fb_billing_summary">
  <!-- Title -->
  <div class="fb_card_title">
    <h5><?php esc_html_e( 'Billing Summary', 'foodbooklite' ) ?></h5>
  </div>
  <!-- End Title -->

  <!-- Promo Code -->
  <div class="fb_input_group fb_d_flex fb_align_items_center">
    <input
      type="text"
      placeholder="<?php esc_attr_e( 'Promo code', 'foodbooklite' ); ?>"
      name="coupon_code"
      class="fb_input_style"
    />
    <span class="fb_btn_fill fb_add_coupon">
      <?php esc_html_e( 'Apply', 'foodbooklite' ) ?>
    </span>
  </div>

  <ul class="fb_list_unstyled fb_billing_summary_list">
    <li
      class="fb_summary_item fb_d_flex fb_align_items_center fb_justify_content_between"
    >
      <span><?php esc_html_e( 'Product Cost', 'foodbooklite' ) ?></span> <span>{{foodbookliteobj.currency}}{{data.cart_subtotal}}</span>
    </li>
    <li class="fb_summary_item fb_d_flex fb_align_items_center fb_justify_content_between">
      
      <span><?php esc_html_e( 'Shipping fee', 'foodbooklite' ) ?></span>
      <span>{{{data.shipping_total}}}</span>
      
    </li>
    <div id="temp_discount_cart"></div>
    <# _.each( data.discount_cart, function( item ) {  #>
    <li class="fb_summary_item fb_d_flex fb_align_items_center fb_justify_content_between">
      <span>{{item.coupon_label}}</span>
      <span>-{{foodbookliteobj.currency}}{{item.discount_amount}}</span>
      <a href="#" class="fb_remove_coupon" data-url="<?php echo esc_url( wc_get_cart_url() );?>" data-coupon={{item.coupon_code}} ><?php esc_html_e( 'Remove', 'foodbooklite' ) ?></a>
    </li>
    <# }) #>
    <li class="fb_summary_total fb_d_flex fb_align_items_center fb_justify_content_between">
      <span><?php esc_html_e( 'Total Cost :', 'foodbooklite' ) ?></span> <span id="checkout_order_total">{{foodbookliteobj.currency}}{{data.cart_total}}</span>
    </li>
  </ul>
</script>