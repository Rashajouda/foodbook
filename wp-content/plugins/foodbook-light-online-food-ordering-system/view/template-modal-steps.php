<script type="text/html" id="tmpl-fb_modal_steps" >

<ul class="fb_steps_list">
    <li class="fb_steps_item fb_product_tab active">
      <img
        src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/checked.svg'; ?>"
        class="fb_svg"
        alt="" />
      <?php esc_html_e( 'Product', 'foodbooklite' ); ?>
    </li>
    <li class="fb_steps_item">
      <img
        src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/right.svg'; ?>"
        class="fb_svg"
        alt="" />
    </li>
    <li class="fb_steps_item fb_viewcart_tab">
      <img
        src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/checked.svg'; ?>"
        class="fb_svg"
        alt="" />
      <?php esc_html_e( 'View Cart', 'foodbooklite' ); ?>
    </li>
    <# if( !foodbookliteobj.is_login && foodbookliteobj.woo_guest_user_allow == 'no' ) { #>
    <li class="fb_steps_item">
      <img
        src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/right2.svg'; ?>"
        class="fb_svg"
        alt="" />
    </li>
    <li class="fb_steps_item fb_logreg_tab">
      <img
        src="<?php echo FOODBOOKLITE_DIR_URL.'assets/img/icon/checked.svg'; ?>"
        class="fb_svg"
        alt="" />
      <?php esc_html_e( 'Login/Register', 'foodbooklite' ); ?>
    </li>
 <# } #>

  </ul>

</script>
