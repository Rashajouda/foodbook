<script type="text/html" id="tmpl-fb_checkout">
  <div class="fb_steps_content step-checkout">

        <form class="fb_checkout_form" id="fb_place_order" name="checkout" action="#" method="post">
            <div class="fb_row">
              <div class="fb_col_lg_8">
                <div class="fb_card">
                  <div class="fb_card_title">
                    <h5><?php esc_html_e( 'Shipping address', 'foodbooklite' ); ?></h5>
                  </div>

                  <div class="fb_row">
                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input type="text" id="fb_shipping_contact_name" class="fb_input_style" name="shipping_first_name" required/>
                        <label for="fb_shipping_contact_name" class="fb_input_label"><?php esc_html_e( 'Contact Name', 'foodbooklite' ); ?> <span>*</span></label
                        >
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_mobile_number"
                          class="fb_input_style"
                          name="shipping_mobile_number"
                          required
                        />
                        <label
                          for="fb_shpping_mobile_number"
                          class="fb_input_label"
                          ><?php esc_html_e( 'Mobile Number', 'foodbooklite' ); ?> <span>*</span></label
                        >
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_address_one"
                          class="fb_input_style"
                          name="shipping_address_1"
                          required
                        />
                        <label
                          for="fb_shpping_address_one"
                          class="fb_input_label"
                          ><?php esc_html_e( 'Address 1', 'foodbooklite' ); ?> <span>*</span></label>
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_address_two"
                          class="fb_input_style"
                          name="shipping_address_2"
                          
                        />
                        <label for="fb_shpping_address_two" class="fb_input_label"><?php esc_html_e( 'Address 2', 'foodbooklite' ); ?></label>
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_region"
                          class="fb_input_style"
                          name="shipping_country"
                          required
                        />
                        <label
                          for="fb_shpping_region"
                          class="fb_input_label"
                          ><?php esc_html_e( 'Country / Region', 'foodbooklite' ); ?> <span>*</span></label
                        >
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_city"
                          class="fb_input_style"
                          name="shipping_city"
                          required
                        />
                        <label
                          for="fb_shpping_city"
                          class="fb_input_label"
                          ><?php esc_html_e( 'city', 'foodbooklite' ); ?> <span>*</span></label
                        >
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_state"
                          class="fb_input_style"
                          name="shipping_state"
                          required
                        />
                        <label
                          for="fb_shpping_state"
                          class="fb_input_label"                          
                          ><?php esc_html_e( 'State', 'foodbooklite' ); ?> <span>*</span></label
                        >
                      </div>
                    </div>

                    <div class="fb_col_sm_6">
                      <div class="fb_input_group">
                        <input
                          type="text"
                          id="fb_shpping_zip"
                          class="fb_input_style"
                          name="shipping_postcode"
                          
                        />
                        <label
                          for="fb_shpping_zip"
                          class="fb_input_label"
                          ><?php esc_html_e( 'zip', 'foodbooklite' ); ?></label
                        >
                      </div>
                    </div>

                  </div>
                </div>

                <div class="fb_card">
                  <div class="fb_card_title">
                    <h5><?php esc_html_e( 'Additional Information', 'foodbooklite' ); ?></h5>
                  </div>

                  <textarea
                    class="fb_input_style fb_additional_info"
                    placeholder="<?php esc_html_e( 'Additional information...', 'foodbooklite' ); ?>"
                    name="order_comments"
                  ></textarea>
                </div>

                <div class="fb_card">
                  <div class="fb_card_title">
                    <h5><?php esc_html_e( 'Choose your pickup method', 'foodbooklite' ); ?></h5>
                  </div>   
                  <!-- End Form Selector Group -->
                  <ul class="fb_list_unstyled fb_delivery_method_list">
                    <# _.each( data.shipping_methods, function( item ) {  #>
                    <# var active = '';  if( item.rate_id == data.chosen_methods ) { active = 'checked' } #>
                    <li class="fb_single_delivery_item">
                      <div class="fb_d_flex fb_align_items_center fb_justify_content_between">
                        <span class="fb_custom_checkbox">
                          <label for={{item.method_id+item.instance_id}}>
                            <input
                              type="radio"
                              value={{item.rate_id}}
                              id={{item.method_id+item.instance_id}}
                              name="shipping_method"
                              {{active}}
                            />   
                            <span class="fb_input_text">{{item.label_name}} {{foodbookliteobj.currency}}{{item.cost}}</span>
                            <span class="fb_custom_checkmark"></span>
                          </label>
                        </span>
                      </div>
                    </li>
                    <# } ) #>
                  </ul>

                  <!-- Single Form -->
                  <div class="fb_single_form fb_delivery fb_self_pickup_info">
                    <?php 
                      $deliveryTime = get_option('foodbooklite_options');
                      if( !empty( $deliveryTime['pickup_time'] ) ):
                    ?>
                    <div class="fb_input_group">

                      <select
                        name="fb_delivery_time"
                        id="fb_delivery_time"
                        class="fb_input_style"
                      >
                      <?php 
                      foreach ( $deliveryTime['pickup_time'] as $value ) {
                        echo '<option value="'.esc_html( $value ).'">'.esc_html( $value ).'</option>';
                      }
                      ?>
                      </select>
                      <label
                        for="fb_delivery_time"
                        class="fb_input_label"
                        ><?php esc_html_e( 'Deliver/Pickup Time', 'foodbooklite' ) ?></label
                      >
                    </div>
                    <?php 
                    endif;
                    //
                    if( !empty( $deliveryTime['branch_name'] ) ):
                    ?>
                    <div class="fb_input_group">
                      <select
                        name="fb_pickup_branch"
                        id="fb_pickup_branch"
                        class="fb_input_style"
                      >
                      <?php
                      foreach ( $deliveryTime['branch_name'] as $value ) {
                        echo '<option value="'.esc_html( $value ).'">'.esc_html( $value ).'</option>';
                      }
                      ?>
                      </select>
                      <label
                        for="fb_pickup_branch"
                        class="fb_input_label"
                        ><?php esc_html_e( 'Pickup Branch Name', 'foodbooklite' ) ?></label
                      >
                    </div>
                    <?php 
                    endif;
                    ?>
                  </div>
                  <!-- End Single Form -->


                </div>
              </div>

              <div class="fb_col_lg_4">
                <!-- Card -->
                <div class="fb_card fb-billing-summary">
                </div>

                <!-- End Card -->
                <!-- Card -->
                <?php 
                
                  $available_payment_methods = WC()->payment_gateways->get_available_payment_gateways();
                  if( !empty( $available_payment_methods ) ):
                ?>
                <div class="fb_card">
                  <!-- Title -->
                  <div class="fb_card_title">

                    <h5><?php esc_html_e( 'Payment Method', 'foodbooklite' ); ?></h5>
                  </div>
                  <!-- End Title -->

                  <!-- Palyment Methods List -->
                  <ul class="fb_list_unstyled fb_payment_methods_list">
                    <?php 
                      $i = 0;
                      foreach( $available_payment_methods as $key => $method ):
                        $i++;

                        $checked = $i == 1 ? 'checked' : '';
                        
                    ?>

                    <li class="fb_method_item payment_method_<?php echo esc_attr( $method->id ); ?>">
                      <div class="fb_input_group style_two">
                        <span class="fb_input_style">
                          <span class="fb_custom_checkbox">
                            <label for="payment_method_<?php echo esc_attr( $method->id ); ?>"> 
                              <input id="payment_method_<?php echo esc_attr( $method->id ); ?>" type="radio" value="<?php echo esc_attr( $method->id ); ?>" name="payment_method" <?php echo esc_attr( $checked ); ?>  />
                              <?php echo $method->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
                              <span class="fb_custom_checkmark"></span>
                              
                            </label>
                            <p><?php echo wp_kses_post( $method->get_description() ); ?></p>
                          </span>
                        </span>
                        <label for="fb_delivery_time" class="fb_input_label"><?php echo esc_html( $method->method_title ); ?></label>
                      </div>
                    </li>
                    <?php 
                    endforeach;
                    ?>
                  </ul>
                  <!-- End Palyment Methods List -->
                </div>
                <?php
                endif;
                ?>

                <button type="submit" class="fb_btn_fill fb_w_100 fb_place_order">
                  <?php esc_html_e( 'Place order', 'foodbooklite' ); ?>
                </button>
              </div>
            </div>
          </form>
                 

  </div>
</script>