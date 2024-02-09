<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'foodbooklite' ) ) );
	return;
}

//
$getText = \FoodBookLite\Inc\Text::getText();
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

	<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

	<div class="fb-checkout-form-inner">

	<div class="col2-set" id="customer_details">
		<div class="col-1">
			<?php do_action( 'woocommerce_checkout_billing' ); ?>
		</div>

		<div class="col-2">
			<?php do_action( 'woocommerce_checkout_shipping' ); ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<!-- Single Form -->
		<?php
		$deliveryTime = get_option('foodbooklite_options');

		if( foodbooklite_is_multi_branch() || !empty( $deliveryTime['checkout-delivery-option'] ) ) :
		?>
		<div class="fb_single_form fb_delivery fb_self_pickup_info fb_card">

		<?php 
		if( $deliveryTime['delivery-options'] != 'none' ):
		?>

		<div class="fb_multiform">
          <!-- Form Selector Group -->  
          	<label for="fb_delivery_type" class="fb_input_label fb_mb_0">
				<?php esc_html_e( 'Delivery Type', 'foodbooklite' ) ?>
			</label>        
         	<ul class="fb_list_unstyled fb_form_selector_list fb_mt_5">
			<?php 
			if( $deliveryTime['delivery-options'] == 'delivery' || $deliveryTime['delivery-options'] == 'all'  ):
			?>
            <li class="fb_single_form_selector">
              	<span class="fb_custom_checkbox">
	                <label>
	                  <input type="radio" value="Delivery" class="shipping_method" name="fb_delivery_options" checked>
	                  <span class="fb_label_title"><?php esc_html_e( 'Delivery', 'foodbooklite' ); ?></span>
	                  <span class="fb_custom_checkmark"></span>
	                </label>
              	</span>
            </li>
			<?php 
			endif;
			//
			if( $deliveryTime['delivery-options'] == 'pickup' || $deliveryTime['delivery-options'] == 'all'  ):
				$checked = $deliveryTime['delivery-options'] == 'pickup' ? 'checked' : '';
			?>
            <li class="fb_single_form_selector">
              	<span class="fb_custom_checkbox">
	                <label>
	                  <input type="radio" value="Pickup" class="shipping_method" name="fb_delivery_options" <?php echo esc_attr( $checked ); ?>>
	                  <span class="fb_label_title"><?php esc_html_e( 'Pickup by me', 'foodbooklite' ); ?></span>
	                  <span class="fb_custom_checkmark"></span>
	                </label>
              	</span>
            </li>
            <?php 
            endif;
            ?>
         	</ul>
          <!-- End Form Selector Group -->
        </div>

        <?php 
    	endif;
    	//
		if( !empty( $deliveryTime['pickup-time-switch'] ) && $deliveryTime['pickup-time-switch'] == 'yes' ):
        ?>
        <div class="fb_multiform">
          <!-- Form Selector Group -->  
          	<label for="fb_delivery_type" class="fb_input_label fb_mb_0">
				<?php esc_html_e( 'Delivery Schedule Type', 'foodbooklite' ) ?>
			</label>        
         	<ul class="fb_list_unstyled fb_form_selector_list fb_mt_5">
            <li class="fb_single_form_selector">
              	<span class="fb_custom_checkbox">
	                <label>
	                  <input type="radio" value="todayDelivery" class="shipping_method" name="fb_delivery_schedule_options" checked>
	                  <span class="fb_label_title"><?php echo esc_html( $getText ['dp_today_text'] ); ?></span>
	                  <span class="fb_custom_checkmark"></span>
	                </label>
              	</span>
            </li>
            <?php 
        	if( !empty( $deliveryTime['pre-order-active'] ) && 'yes' == $deliveryTime['pre-order-active'] ):
        	?>
            <li class="fb_single_form_selector">
              	<span class="fb_custom_checkbox">
	                <label>
	                  <input type="radio" value="scheduleDelivery" class="shipping_method" name="fb_delivery_schedule_options">
	                  <span class="fb_label_title"><?php echo esc_html( $getText ['dp_schedule_text'] ); ?></span>
	                  <span class="fb_custom_checkmark"></span>
	                </label>
              	</span>
            </li>
            <?php 
	    	endif;
	    	?>
         	</ul>
          <!-- End Form Selector Group -->
        </div>
        				
			<p class="form-row">
				<label
				for="fb_delivery_time"
				class="fb_input_label">
				<?php echo esc_html( $getText ['dp_time_text'] ); ?>
				</label>
				<select
				name="fb_delivery_time"
				id="fb_delivery_time"
				class="fb_input_style">
				<?php
				$timeList = \FoodBookLite\Date_Time_Map::getTimes();
				foreach ( $timeList as $time ) {
					echo '<option value="'.esc_html( $time ).'">'.esc_html( $time ).'</option>';
				}
				?>
				</select>
			</p>
			<?php 
			endif;
			?>
		</div>
		<?php 
		endif;
		?>
		<!-- End Single Form -->
	  	<div class="fb_card fb-checkout-order-place-area">
			  <div class="fb_card_title">
				  <h3><?php esc_html_e( 'Your order', 'foodbooklite' ); ?></h3>
			  </div>
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
