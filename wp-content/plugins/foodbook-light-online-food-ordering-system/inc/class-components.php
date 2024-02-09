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

class Components {

	/**
	 * delivery_boy_assign_component 
	 * @param  [obj] $order 
	 * @return html        
	 */
	
	public function delivery_boy_assign_component( $order, $branch_id = '' ) {

		?>
	  <div class="delivery-boy fb_input_wrapper">
        <?php
        $boies = foodbooklite_get_branch_delivery_boy( $branch_id );
        $asigned_boy = get_post_meta( $order->get_id(), '_order_delivery_boy', true );
        ?>
        <select class="fb_input_style" id="delivery_boy" name="delivery_boy">
          <?php
          foreach( $boies as $key => $boy ) {
            echo '<option value="'.esc_html( $key ).'" '.selected( $key, $asigned_boy, false ).' >'.esc_html( $boy ).'</option>';
          }
          ?>
        </select>
        <button class="fb_btn_fill" id="delivery_assign" data-orderid="<?php echo esc_attr( $order->get_id() ); ?>" > <?php esc_html_e( 'Assign', 'foodbooklite' ); ?> </button>
    </div>
		<?php

	}

  /**
   * order_transfer_component 
   * 
   * @return html        
   */
  
  public function order_transfer_component( $order ) {
    ?>
    <div class="order-transfer fb_input_wrapper">
        <?php
        $branch = foodbooklite_branch_list();
        ?>
        <select class="fb_input_style" id="branch_list" name="branch_id">
          <option value=""><?php esc_html_e( 'Select Branch', 'foodbooklite' ); ?></option>
          <?php
          foreach( $branch as $key => $value ) {
            echo '<option value="'.esc_html( $key ).'">'.esc_html( $value ).'</option>';
          }
          ?>
        </select>
        <button class="fb_btn_fill" id="order_transfer" data-orderid="<?php echo esc_attr( $order->get_id() ); ?>" > <?php esc_html_e( 'Transfer', 'foodbooklite' ); ?> </button>
    </div>
    <?php

  }


/**
 * logout_url_html 
 * @return 
 */
public function logout_url_html() {

  $options = get_option('foodbooklite_options');
  $admin_page = !empty( $options['admin'] ) ? $options['admin'] : 'admin';

  $redirectUrl = home_url( $admin_page );
  echo '<a class="fb_btn_fill" href="'.esc_url( wp_logout_url( $redirectUrl ) ).'">'.esc_html__('Log Out', 'foodbooklite' ).'</a>';
}

/**
 * filter_form_html  
 * Order Date filter html form 
 * @return
 */

public function filter_form_html() {

  ?>
  <div class="order-filter fb_mb_30 fb_mb_md_0">
    <label> <?php esc_html_e( 'Filter By Order Date:', 'foodbooklite' ); ?> </label>
   
      <div class="filter-form-inner">
        <div class="fb_input_wrapper">
          <input type="text" class="fb_input_style datepicker order-date" name="date" required />
          <button class="fb_btn_fill order-date-filter" type="submit"><?php esc_html_e( 'Filter', 'foodbooklite' ); ?></button>
        </div>
      </div>
  </div>
 
  <?php

}

/**
 * [preorder_filter_form_html description]
 * @return [type] [description]
 */
public function preorder_filter_form_html() {
  ?>
  <div class="order-filter fb_mb_30 fb_mb_md_0">
    <label> <?php esc_html_e( 'Filter By Delivery Date:', 'foodbooklite' ); ?> </label>
      <div class="filter-form-inner">
        <div class="fb_input_wrapper">
          <input type="text" class="fb_input_style datepicker preorder-date" name="date" required />
          <?php
          if( foodbooklite_is_multi_branch() && current_user_can('administrator') ):
          ?>
            <?php 
            $branch = foodbooklite_branch_list();
            ?>
            <select class="w-100" id="order-branch" name="branch" required>
              <option value="0"><?php esc_html_e( 'All Branches', 'foodbooklite' ); ?></option>
              <?php 
              foreach( $branch as $key => $value )
                echo '<option value="'.esc_attr( $key ).'">'.esc_html( $value ).'</option>';
              ?>
            </select>
          <?php 
          endif;
          ?>
          <button class="fb_btn_fill preorder-date-filter" type="submit"><?php esc_html_e( 'Filter', 'foodbooklite' ); ?></button>
          <a class="fb_btn_fill preorder-date-filter" data-all-preorder="PO"><?php esc_html_e( 'All Pre Order', 'foodbooklite' ); ?></a>
        </div>
      </div>
  </div>
  <?php
}

/**
 * [filter_area description]
 * @return [type] [description]
 */
public function filter_area() {
  ?>
  <div class="fb_row fb_align_items_end fb_mb_50">
    <div class="fb_col_md_5">
      <?php
      $this->filter_form_html();
      ?>
    </div>
    <div class="fb_col_md_5">
      <?php $this->preorder_filter_form_html(); ?>
    </div>
    <div class="fb_col_md_2 fb_text_md_right">
      <?php
      $this->logout_url_html();
      ?>
    </div>
  </div>
  <?php
}


/**
 * admin_filter_form_html  
 * Date admin filter html form 
 * @return
 */

public function admin_filter_form_html() {

  $currentDate = foodbooklite_current_date();

  $date = isset( $_GET['date'] ) ? $_GET['date'] : $currentDate;

  ?>
  <label> <?php esc_html_e( 'Filter By Order Date:', 'foodbooklite' ); ?> </label>
  <form action="#" id="foodbooklite_filter" method="post" >
    <div class="filter-form-inner row">
      <div class="input-group col-md-6 col-12">
        <input type="text" class="w-100 datepicker order-date" value="<?php echo esc_html( $date ); ?>" name="date" required />
      </div>
      <?php 
      if( foodbooklite_is_multi_branch() ):
      ?>
      <div class="input-group col-md-3 col-6">
        <?php 
        $branch = foodbooklite_branch_list();
        ?>
        <select class="w-100" id="order-branch" name="branch" required>
          <option value="0"><?php esc_html_e( 'All Branches', 'foodbooklite' ); ?></option>
          <?php 
          foreach( $branch as $key => $value )
            echo '<option value="'.esc_attr( $key ).'">'.esc_html( $value ).'</option>';
          ?>
        </select>
      </div>
      <?php 
      endif;
      ?>
      <div class="input-group col-md-3 col-6">
        <button class="w-100 fb-admin-btn" type="submit"><?php esc_html_e( 'Filter', 'foodbooklite' ); ?></button>
      </div>
    </div>
  </form>
  <?php

}

/**
 * status_button_html
 * @return html
 */
public function status_button_html( $order_id, $status ) {

  $statusText = foodbooklite_getStatusText();

  $oc = $stc = $ac = $cc = $OWD = $DC = '';

  //
  if( $status == 'OC' ) {
    $oc = 'status-active';
    $stc = $ac = $cc = $OWD = $DC = 'fb-d-none';
  }


  // 
  if( $status == 'STC' ) {
    $oc = 'fb-d-none';
    $stc = 'status-active';
  }
  // 
  if( $status == 'AC' ) {
    $oc = $stc = 'fb-d-none';
    $ac = 'status-active';
  }
  // 
  if( $status == 'CC' ) {
    $oc = $stc = $ac = 'fb-d-none';
    $cc = 'status-active';
  }
  // 
  if( $status == 'OWD' ) {
    $oc = $stc = $ac = $cc = 'fb-d-none';
    $OWD = 'status-active';
  }
  // 
  if( $status == 'DC' ) {
    $oc = $stc = $ac = $cc = $OWD = 'fb-d-none';
    $DC = 'status-active';
  }


  // // Don't show if user  delivery boy
  if( ! foodbooklite_is_user_role('delivery_boy') ):
  ?>

  <span data-orderid="<?php echo esc_html( $order_id ); ?>" data-tracking-status="OC" class="order-cancel <?php echo esc_attr( $oc ); ?>"><?php echo esc_html( $statusText['oc'] ); ?></span>

  <?php
  // Don't show if user not branch manager

  if( foodbooklite_is_user_role('branch_manager') || is_admin() ):
  ?>
  <span data-orderid="<?php echo esc_html( $order_id ); ?>" data-tracking-status="STC"  class="status-btn send-to-cooking <?php echo esc_attr( $stc ); ?>"><?php echo esc_html( $statusText['stc'] ); ?></span>
  <?php
  endif;
  // Don't show if user not kitchen manager
  if( foodbooklite_is_user_role('kitchen_manager') || is_admin() ):
  ?>
  <span data-orderid="<?php echo esc_html( $order_id ); ?>" data-tracking-status="AC" class="cooking-accept status-btn <?php echo esc_attr( $ac ); ?>"><?php echo esc_html( $statusText['ac'] ); ?></span>
  <?php
  endif;
  ?>

  <span data-orderid="<?php echo esc_html( $order_id ); ?>" data-tracking-status="CC" class="cooking-complete status-btn <?php echo esc_attr( $cc ); ?>"><?php echo esc_html( $statusText['cc'] ); ?></span>

  <?php
  endif // end check Delivery boy user
  ?>

  <span data-orderid="<?php echo esc_html( $order_id ); ?>" data-tracking-status="OWD" class="status-btn <?php echo esc_attr( $OWD ); ?>"><?php echo esc_html( $statusText['otw'] ); ?></span>

  <span data-orderid="<?php echo esc_html( $order_id ); ?>" data-tracking-status="DC" class="cooking-accept status-btn <?php echo esc_attr( $DC ); ?>"><?php echo esc_html_e( $statusText['dc'] ); ?></span>


<?php

}

/**
 * status_button_html
 * @return html
 */

function order_billing_shipping_details( $order ) {

  $billingName = $order->get_billing_first_name().' '.$order->get_billing_last_name();
  $shippingName = $order->get_shipping_first_name().' '.$order->get_shipping_last_name();

  $billingAddress = [
    $order->get_billing_address_1(),
    $order->get_billing_address_2(),
    $order->get_billing_city(),
    $order->get_billing_postcode()
  ];

  $shippingAddress = [
    $order->get_shipping_address_1(),
    $order->get_shipping_address_2(),
    $order->get_shipping_city(),
    $order->get_shipping_postcode()
  ];

  ?>
  <div class="fb-address-wrapper">
    <div class="row">
		<div class="col-md-6">
			<div class="fb-billing-address">
				<h4><?php esc_html_e( 'Billing Information', 'foodbooklite' ); ?></h4>
				<?php
				if( !empty( trim( $billingName ) ) ) {
				echo '<p>'.sprintf( esc_html__( 'Name: %s', 'foodbooklite' ), $billingName ).'</p>';
				}
				echo '<p>'.sprintf(  esc_html__( 'Phone: ', 'foodbooklite' ).'<a href="tel:%1$s">%1$s</a>', $order->get_billing_phone() ).'</p>';

				echo '<p>'.esc_html__( 'Address: ', 'foodbooklite' ).esc_html( implode( ', ' , $billingAddress ) ).'</p>';

				?>
			</div>
		</div>

    <?php 
    $checkAddress = array_filter( $shippingAddress );
    if( !empty( $checkAddress ) ):
    ?>
		<div class="col-md-6">
			<div class="fb-shipping-address">
				<h4><?php esc_html_e( 'Shipping Information', 'foodbooklite' ); ?></h4>
				<?php
				if( !empty( trim($shippingName) ) ) {
					echo '<p>'.sprintf( esc_html__( 'Name: %s', 'foodbooklite' ), $shippingName ).'</p>';
				}
        //
        if( !empty( $checkAddress ) ) {
          //
          echo '<p>'.esc_html__( 'Address: ', 'foodbooklite' ).esc_html( implode( ', ' , $shippingAddress ) ).'</p>';
        }
				
				?>
			</div>
		</div>
    <?php 
    endif;
    ?>

    </div>
  </div>
  <?php
}

/**
 * [invoice_js_template description]
 * @return HTML
 */
public function invoice_js_template() {

  ?>
  <div class="fb-invoice-template fb_modal_content_inner" style="display: none;">
  
    <div class="inv-header-info">
      <div class="inv-order-info" style="float: left">
        <p class="order-id"><?php esc_html_e( 'Order ID: #', 'foodbooklite' ); ?> {{data.order_id}}</p>
        <p class="order-id"><?php esc_html_e( 'Order Date:', 'foodbooklite' ); ?> {{data.created_date}}</p>
        <p class="order-id"><?php echo sprintf( esc_html__( 'Delivery Type: %s', 'foodbooklite' ), "{{data.delivery_type}}"  ); ?></p>
        <p class="order-id"><?php echo sprintf( esc_html__( 'Order Delivery/Pickup Time: %s', 'foodbooklite' ), "{{data.delivery_date+' / '+data.pickup_time}}"  ); ?></p>
        <p class="order-id"><?php echo sprintf( esc_html__( 'Payment Method: %s', 'foodbooklite' ), "{{data.payment_method}}"  ); ?></p>
      </div>
      <div class="inv-address" style="float: right">
        <div class="fb-billing-address">
          <h4><?php esc_html_e( 'Billing Information', 'foodbooklite' ); ?></h4>
          <# if( data.order_address.billing_name ){ #>
          <?php echo '<p>'.sprintf( esc_html__( 'Name: %s', 'foodbooklite' ), "{{data.order_address.billing_name}}" ).'</p>'; ?>
          <# } if( data.order_address.billing_name ){ #>
          <?php echo '<p>'.sprintf(  esc_html__( 'Phone: ', 'foodbooklite' ).'<a href="tel:%1$s">%1$s</a>', "{{data.order_address.billing_phone}}" ).'</p>'; ?>
          <# } #>
          <?php echo '<p>'.esc_html__( 'Address: ', 'foodbooklite' ).'{{data.order_address.billing_address}}</p>'; ?>
        </div>

        <# if( data.order_address.shipping_address ) { #>
          <div class="col-md-6">
            <div class="fb-shipping-address">
              <h4><?php esc_html_e( 'Shipping Information', 'foodbooklite' ); ?></h4>
              <?php
              echo '<p>'.sprintf( esc_html__( 'Name: %s', 'foodbooklite' ), "{{data.order_address.shipping_name}}" ).'</p>';
                    echo '<p>'.esc_html__( 'Address: ', 'foodbooklite' ).'{{data.order_address.shipping_address}}</p>';
              
              ?>
            </div>
          </div>
        <#}#>

      </div>
    </div>
    
    <div class="fb_order_table">
      <table>
        <thead>
          <tr>
          <th><?php esc_html_e( 'Item Name', 'foodbooklite' ); ?></th>
          <th><?php esc_html_e( 'Extra Item', 'foodbooklite' ); ?></th>
          <th><?php esc_html_e( 'Item Total Price', 'foodbooklite' ); ?></th>
          </tr>
        </thead>
        <tbody>
        <# _.each( data.order_items, function( item ) { #>
          <tr>
            <td>{{item.item_name}}</td>
            <td>
              
              <ul>
              <#
              _.each( item.item_meta_data, function( metaItem ) {

              if( metaItem.meta_value ) {
              #>
                <li>
                <span class="meta-title">{{metaItem.meta_key}} : </span><span class="">{{metaItem.meta_value}}</span>
                </li>
              <#
              }
              } )
              #>
              </ul>
               
            </td>
            <td>{{{item.item_total_price}}}</td>
          </tr>
          <# } ) #>
        </tbody>
        <tfoot>
          <# if( data.order_total_fees ) { #>
          <tr>
            <th rowspan="1" colspan="1"></th>
            <th rowspan="1" colspan="1"><?php esc_html_e( 'Delivery Fee', 'foodbooklite' ); ?></th>
            <th rowspan="1" colspan="1">{{{data.order_total_fees}}}</th>
          </tr>
          <# } #>
          <tr>
            <th rowspan="1" colspan="1"></th>
            <th rowspan="1" colspan="1"><?php esc_html_e( 'Total', 'foodbooklite' ); ?></th>
            <th rowspan="1" colspan="1">{{{data.order_total}}}</th>
          </tr>
        </tfoot>
      </table>

    </div>
  </div>
  <?php

}


/**
 * invoice_template
 * @return html
 */
public function invoice_template( $order ) {

  $order_id = $order->get_id();
  $paymentMethod = $order->get_payment_method_title();
  $pickup_time  = get_post_meta( absint( $order_id ) , '_pickup_time', true );
  $delivery_type  = get_post_meta( absint( $order_id ) , '_delivery_type', true );


  // address

  $billingName = $order->get_billing_first_name().' '.$order->get_billing_last_name();
  $shippingName = $order->get_shipping_first_name().' '.$order->get_shipping_last_name();

  $billingAddress = [
    $order->get_billing_address_1(),
    $order->get_billing_address_2(),
    $order->get_billing_city(),
    $order->get_billing_postcode()
  ];

  $shippingAddress = [
    $order->get_shipping_address_1(),
    $order->get_shipping_address_2(),
    $order->get_shipping_city(),
    $order->get_shipping_postcode()
  ];


  ?>

  <div class="fb-invoice-template fb_modal_content_inner" style="display: none;">
  
    <div class="inv-header-info">
      <div class="inv-order-info" style="float: left">
        <p class="order-id"><?php esc_html_e( 'Order ID:', 'foodbooklite' ); ?> <?php echo esc_html( '#'.absint( $order_id ) ); ?></p>
        <p class="order-id"><?php esc_html_e( 'Order Date:', 'foodbooklite' ); ?> <?php echo esc_html( $order->get_date_created()->format ('M-d-Y') ); ?></p>
        <p class="order-id"><?php echo sprintf( esc_html__( 'Delivery Type: %s', 'foodbooklite' ), esc_html( $delivery_type )  ); ?></p>
        <p class="order-id"><?php echo sprintf( esc_html__( 'Order Delivery/Pickup Time: %s', 'foodbooklite' ), esc_html( $pickup_time )  ); ?></p>
        <p class="order-id"><?php echo sprintf( esc_html__( 'Payment Method: %s', 'foodbooklite' ), esc_html( $paymentMethod )  ); ?></p>
      </div>
      <div class="inv-address" style="float: right">
        
        <div class="fb-billing-address">
          <p><strong><?php esc_html_e( 'Billing Information', 'foodbooklite' ); ?></strong></p>
          <?php
          if( !empty( trim( $billingName ) ) ) {
          echo '<p>'.sprintf( esc_html__( 'Name: %s', 'foodbooklite' ), $billingName ).'</p>';
          }
          echo '<p>'.sprintf(  esc_html__( 'Phone: ', 'foodbooklite' ).'<a href="tel:%1$s">%1$s</a>', $order->get_billing_phone() ).'</p>';

          echo '<p>'.esc_html__( 'Address: ', 'foodbooklite' ).esc_html( implode( ', ' , $billingAddress ) ).'</p>';

          ?>
        </div>

        <?php 
        // Shipping address
        $checkAddress = array_filter( $shippingAddress );
        if( !empty( $checkAddress ) ):
        ?>
        <div class="col-md-6">
          <div class="fb-shipping-address">
            <h4><?php esc_html_e( 'Shipping Information', 'foodbooklite' ); ?></h4>
            <?php
            if( !empty( trim($shippingName) ) ) {
              echo '<p>'.sprintf( esc_html__( 'Name: %s', 'foodbooklite' ), $shippingName ).'</p>';
            }
            //
            if( !empty( $checkAddress ) ) {
              //
              echo '<p>'.esc_html__( 'Address: ', 'foodbooklite' ).esc_html( implode( ', ' , $shippingAddress ) ).'</p>';
            }
            
            ?>
          </div>
        </div>
        <?php 
        endif;
        ?>

      </div>
    </div>
    
    <div class="fb_order_table">           
      <table>
        <thead>
          <tr>
          <th><?php esc_html_e( 'Item Name', 'foodbooklite' ); ?></th>
          <th><?php esc_html_e( 'Extra Item', 'foodbooklite' ); ?></th>
          <th><?php esc_html_e( 'Item Total Price', 'foodbooklite' ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ( $order->get_items() as $item_id => $item ) {
          ?>
          <tr>
            <td><?php echo esc_html( $item->get_name() ); ?></td>
            <td>
            <?php
            echo '<ul>';
            foreach( $item->get_meta_data() as $val ) {
            $data = $val->get_data();

              if( !empty( $data['value'] ) ) {
              echo '<li>';
                echo '<span class="meta-title">'.str_replace(['pa_','-', ':'], ['',' ', ''], $data['key'] ).': </span><span class="">'.$data['value'].'</span>';
              echo '</li>';
              }

            }
            echo '</ul>';
            ?>  
            </td>
            <td><?php echo esc_html( foodbooklite_currency_symbol_position( $item->get_total() ) ); ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
        <tfoot>
          <?php
          if( !empty( $order->get_total_fees() ) ):
          ?>
          <tr>
            <th rowspan="1" colspan="1"></th>
            <th rowspan="1" colspan="1"><?php esc_html_e( 'Delivery Fee', 'foodbooklite' ); ?></th>
            <th rowspan="1" colspan="1"><?php echo esc_html( foodbooklite_currency_symbol_position( $order->get_total_fees() ) ); ?></th>
          </tr>
          <?php 
          endif;
          ?>
          <tr>
            <th rowspan="1" colspan="1"></th>
            <th rowspan="1" colspan="1"><?php esc_html_e( 'Total', 'foodbooklite' ); ?></th>
            <th rowspan="1" colspan="1"><?php echo esc_html( foodbooklite_currency_symbol_position( $order->get_total() ) ); ?></th>
          </tr>
        </tfoot>
      </table>
    </div>


  </div>
  <?php
}


}
