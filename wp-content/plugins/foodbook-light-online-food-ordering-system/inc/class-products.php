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


class Products{

	function __construct() {

		add_action( 'wp_ajax_woo_products_view', [ $this, 'productQuery' ] );
		add_action( 'wp_ajax_nopriv_woo_products_view', [ $this, 'productQuery' ] );

    add_action( 'wp_ajax_woo_product_byid', [ $this, 'getProductById' ] );
    add_action( 'wp_ajax_nopriv_woo_product_byid', [ $this, 'getProductById' ] );

    add_action( 'wp_ajax_woo_product_reviews_byid', [ $this, 'getProductReviewsByid' ] );
    add_action( 'wp_ajax_nopriv_woo_product_reviews_byid', [ $this, 'getProductReviewsByid' ] );

    add_action('wp_ajax_woo_fb_ajax_add_to_cart', [ $this, 'wooAjaxAddToCart' ] );
    add_action('wp_ajax_nopriv_woo_fb_ajax_add_to_cart', [ $this, 'wooAjaxAddToCart' ] );

    add_action( 'wp_ajax_woo_cart_items', [ $this, 'getCartItems' ] );
    add_action( 'wp_ajax_nopriv_woo_cart_items', [ $this, 'getCartItems' ] );

    add_action( 'wp_ajax_woo_get_checkout_data', [ $this, 'get_checkout_data' ] );
    add_action( 'wp_ajax_nopriv_woo_get_checkout_data', [ $this, 'get_checkout_data' ] );

    add_action( 'wp_ajax_woo_order_place', [ $this, 'order_place' ] );
    add_action( 'wp_ajax_nopriv_woo_order_place', [ $this, 'order_place' ] );

    add_action( 'wp_ajax_woo_cart_item_remove', [ $this, 'cart_item_remove' ] );
    add_action( 'wp_ajax_nopriv_woo_cart_item_remove', [ $this, 'cart_item_remove' ] );

    add_action( 'wp_ajax_woo_add_discount', [ $this, 'add_discount' ] );
    add_action( 'wp_ajax_nopriv_woo_add_discount', [ $this, 'add_discount' ] );

    add_action( 'wp_ajax_woo_set_shipping_methods', [ $this, 'set_shipping_methods' ] );
    add_action( 'wp_ajax_nopriv_woo_set_shipping_methods', [ $this, 'set_shipping_methods' ] );

    add_action( 'wp_ajax_woo_get_variation_data', [ $this, 'get_variation_data' ] );
    add_action( 'wp_ajax_nopriv_woo_get_variation_data', [ $this, 'get_variation_data' ] );

    add_action( 'wp_ajax_woo_get_cart_count', [ $this, 'getCartCount' ] );
    add_action( 'wp_ajax_nopriv_woo_get_cart_count', [ $this, 'getCartCount' ] );


	}

  public function getCartCount() {
    echo WC()->cart->get_cart_contents_count();
    exit;
  }


	public function args() {

    $options = get_option('foodbooklite_options');

		$catSlug  = !empty( $_POST['catSlug'] ) ? $_POST['catSlug'] : '';
		$taxonomy = !empty( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : '';
		$limit    = !empty( $options['product-limit'] ) ? $options['product-limit'] : '6';
		$page     = !empty( $_POST['page'] ) ? $_POST['page'] : 1;
    $filter_key = !empty( $_POST['filter_key'] ) ? $_POST['filter_key'] : '';

    // Default Init
		$args = array(
		    'limit' => esc_html( $limit ),
		    'page'	=> esc_html( $page ),
        'status' => 'publish',
		    'order' => 'DESC',
		    'paginate' => true
		);

    // add category slug
		if( $catSlug && $taxonomy != 'specialoffer' ) {

      $args['category'] = array( $catSlug );

		}

    // Add taxonomy term slug for tax query
		if( $catSlug && $taxonomy == 'specialoffer' ) {

      $args['tax_query'] = array(
                array(
                    'taxonomy' => 'specialoffer',
                    'field'    => 'slug',
                    'terms'    => array( $catSlug )
                ),
            );

		}

    // Meta Query
    
    if( $filter_key  && $filter_key  != 'menu_order' ) {

      $filterKeys = [ 'price'];

      if( in_array( $filter_key , $filterKeys ) ) {

        $args['order'] = 'ASC';

      }

      //
      $args['orderby'] = 'meta_value';

      switch( $filter_key ) {

        case 'rating':
          $args['average_rating_product'] = 0.1;
        break;
        case 'price':
        case 'price-desc':
          $args['low_to_high_price'] = 0.1;
        break;
        case 'popularity':
          $args['total_sales_product'] = 1;
        break;

      }

    }


		return $args;


	}

	public function productQuery() {

    $productMarkup = new Product_Layout();

    $options = get_option( 'foodbooklite_options' );

    $column = !empty( $_POST['col'] ) ? $_POST['col'] : '3';
    $layout = !empty( $_POST['layout'] ) ? $_POST['layout'] : 'grid';


		$args = $this->args();
		
    $currentPage = $args['page'];

		$query = wc_get_products( $args );

		$products = $query->products;


		ob_start();

		if( !empty( $products ) ):
			foreach( $products as $product ):

				$imgId = $product->get_image_id();

				$imgUrl = wp_get_attachment_url( absint( $imgId ) );

        if( $layout != 'grid' ) {
          $productMarkup->product_layout_list( $product, $options, $column, $imgUrl );
        } else {
          $productMarkup->product_layout_grid( $product, $options, $column, $imgUrl );
        }
		   
			endforeach;
		endif;
		
    $max_num_pages = $query->max_num_pages;

    if( $max_num_pages > 1 ):

		?>
    <div class="fb-pagination fb_w_100">
      <div class="fb_col_lg_12 fb_col_sm_12">
    		<div class="fb_pagination">
            <ul class="fb_pagination_list">
            <?php
            for(  $i = 1; $i <= $max_num_pages; $i++  ) {
            	
            	$active = "";

            	if( $i == $currentPage ) {
            		$active = "active";
            	}

            	echo '<li data-page-number="'.esc_attr( $i ).'" class="fb_pagination_list_item '.esc_attr( $active ).'">'.esc_html( $i ).'</li>';

            }
            ?>
            </ul>
          </div>
      </div>
    </div>
		<?php
    endif;

		echo ob_get_clean();

		exit;

	}

  public function getProductById() {

    $product_id = !empty( $_POST['product_id'] ) ? $_POST['product_id'] : ''; 

    if( empty( $product_id ) ) {
      return $product_id;
    }

    $product = wc_get_product( $product_id );

    $featured = get_post_meta( $product_id, '_extra_featured', true );

    $decodedFeaturedData = json_decode( $featured, true );


  // Product Attributes

  $defaultAttributes = $product->get_default_attributes();

  $defaultAttributes = array_values( $defaultAttributes );
  $defaultAttributes = implode('', $defaultAttributes);

  $attributes = [];

  if( $product->is_type('variable') ) {
  
    if( !empty( $product->get_attributes() ) ) {

      foreach( $product->get_attributes() as $attribute ) {

        $name = str_replace( ['pa_', '-'], ['',' '], $attribute->get_name() );

        $attributes[$name] = [
            'name'      => sanitize_title( $attribute->get_name() ),
            'attribute' => 'attribute_'.sanitize_title( $attribute->get_name() ),
            'options'   => $attribute->get_terms()

        ];

      }

    }

  }

  $thumbnail = wp_get_attachment_image_url( $product->get_image_id(), 'full' );


  if ( $product->is_type( 'simple' ) ) {
    $sale_price     =  $product->get_sale_price();
    $regular_price  =  $product->get_regular_price();
  }
  elseif( $product->is_type('variable') ) {
    $sale_price     =  $product->get_variation_sale_price( 'min', true );
    $regular_price  =  $product->get_variation_regular_price( 'max', true );
  }


  // Rating 
  
  $avRating    = $product->get_average_rating();
  $reviewCount = $product->get_review_count();

  $starRating = foodbooklite_rating_reviews( esc_html( $avRating ), false );

  // check verified owner
  $verified_owner = wc_customer_bought_product( '', get_current_user_id(), absint( $product->get_id() ) ); 

    $product = array(

      'id'      => $product->get_id(),
      'title'   => $product->get_name(),
      'slug'    => $product->get_slug(),
      'sku'     => $product->get_sku(),
      'description'   => $product->get_description(),
      'type'          => $product->get_type(),
      'price'         => $product->get_price(),
      'display_price' => foodbooklite_woo_custom_number_format( $product->get_price() ),
      'regular_price' => $regular_price,
      'display_regular_price' => foodbooklite_woo_custom_number_format( $regular_price ),
      'sale_price'            => $sale_price,
      'display_sale_price'    => foodbooklite_woo_custom_number_format( $sale_price ),
      'thumbnail'     => $thumbnail,
      'attributes'    => $attributes,
      'defaultAttributes' => $defaultAttributes,
      'star_rating'       => wp_kses_post( $starRating ),
      'reviewcount'       => esc_html( $reviewCount ),
      'verified_owner'    => esc_html( $verified_owner ),
      'extraFeatured'     => $decodedFeaturedData

    );

    echo wp_json_encode( $product );

    exit;
  }

  public function getProductReviewsByid() {

    if( isset( $_POST['product_id'] ) && !empty( $_POST['product_id'] ) ) {

        $args = array ('post_type' => 'product', 'post_id' => absint( $_POST['product_id'] ) );
        $comments = get_comments( $args );
        wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments );

    }

    exit;

  }

  public function get_variation_data() {

        if( ! isset( $_POST['pid'] ) ) {
          return;
        }

        /* Get variation attribute based on product ID */
        $product = new \WC_Product_Variable( $_POST['pid'] );
        $product_variations = $product->get_available_variations();

        $variations = [];

        foreach( $product_variations as $val ) {
          
          $variations[] = [
            'attributes'              => $val['attributes'],
            'variation_id'            => $val['variation_id'],
            'price_html'              => $val['price_html'],
            'display_price'           => $val['display_price'],
            'display_regular_price'   => $val['display_regular_price']
          ];

        }

      //
      foreach ( $variations as $v ) {

        if( $v['attributes'][$_POST['attribute']] == sanitize_title( $_POST['name'] ) ) {

            $attr = [
              'variation_id'    => $v['variation_id'],
              'price_html'      => $v['price_html'],
              'display_price'   => $v['display_price'],
              'display_regular_price' => $v['display_regular_price']

            ];

          wp_send_json_success( $attr );

        }
        
      }

      exit;

  }
        
  public function wooAjaxAddToCart() {

      $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
      $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
      $variation_id = absint( $_POST['variation_id'] );
      $passed_validation = true;
      $product_status = get_post_status($product_id);
      $variation = !empty( $_POST['attributes'] ) ? $_POST['attributes'] :'';

      $extra_optionsTotalPrice = !empty( $_POST['extra_options'] ) ? $_POST['extra_options'] : [];
      $extra_formatted_options = !empty( $_POST['extra_formatted_options'] ) ? implode( ' | ', $_POST['extra_formatted_options'] ) : '';

      // Process Extra options price

      $totalExtraOPtionsPrice = array_sum( $extra_optionsTotalPrice );
      
      $instructions = !empty( $_POST['instructions'] ) ? $_POST['instructions'] : '';

      // Extra features
      $cart_item_data = [
        'item_instructions' => sanitize_text_field( $instructions ),
        'extra_options'     => $extra_formatted_options,
        'extra_options_price' => esc_html( $totalExtraOPtionsPrice )
      ];


      if ($passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data ) && 'publish' === $product_status) {

          do_action('woocommerce_ajax_added_to_cart', $product_id);

          if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
              wc_add_to_cart_message( array( $product_id => $quantity ), true);
          }

          //WC_AJAX :: get_refreshed_fragments();

          $data = array(
              'status' => true,
              'product_id' => $product_id
            );
          
      } else {

          $data = array(
              'status' => false,
              'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
            );

      }

      echo wp_send_json_success($data);
      
      wp_die();
  }

  public function getCartItems() {

    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    $cartTotal = $woocommerce->cart->get_cart_total();
    $cartCount = $woocommerce->cart->get_cart_contents_count();

    $currency_symbol = get_woocommerce_currency_symbol();

    $getItems = [];

    foreach( $items as $item => $values ) {
 
      $_product =  wc_get_product( $values['data']->get_id() ); 

      $values['data']->set_price( $values['data']->get_price() + $values['extra_options_price'] );

      $get_price =  $values['data']->get_price() ; 

      $getItems[] = [
        'cart_remove_url' =>  wc_get_cart_remove_url( $item ),
        'cart_item_key'   => $item,
        'id'  => $values['data']->get_id(),
        'sku' => $values['data']->get_sku(),
        'title' => $_product->get_title(),
        'image' => $values['data']->get_image(),
        'quantity' => $values['quantity'],
        'price' => foodbooklite_currency_symbol_position( foodbooklite_woo_custom_number_format( $get_price ) ),
        'instructions'  => $values['item_instructions'],
        'extra_options' => $values['extra_options'],
        'extra_options_total_price' =>   foodbooklite_currency_symbol_position( foodbooklite_woo_custom_number_format( $values['extra_options_price'] ) ),
        'item_sub_total' => WC()->cart->get_product_subtotal( $values['data'],  $values['quantity'] ),
        'variation_data' => $values['variation']

      ];


    }

  echo wp_send_json_success( [ 'cart_total' => $cartTotal, 'cart_count' => $cartCount, 'items' => $getItems  ] );

  exit;


  }
 
  public function cart_item_remove() {

    $cart_item_key = $_POST['cart_item_key'];

    $t = WC()->cart->remove_cart_item( $cart_item_key );

  }
  public function set_shipping_methods() {

      if( isset( $_POST['method'] ) ) {
        
        WC()->session->set('chosen_shipping_methods', array( $_POST['method'] ) );

        // Update shipping and cart total
        WC()->cart->calculate_shipping();
        WC()->cart->calculate_totals();


      }

    exit;      

  }
  public function add_discount() {

    $code = '';

    if( isset( $_POST['coupon_code'] ) ) {
      $code = $_POST['coupon_code'];
    }


    $ret = WC()->cart->add_discount( $code );


    exit;

  }



  

}

// Products Class init
 new Products();