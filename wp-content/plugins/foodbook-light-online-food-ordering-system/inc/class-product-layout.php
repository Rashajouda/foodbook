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

class Product_Layout {

  /**
   * [product_layout_grid description]
   * @return [type] [description]
   */
  public function product_layout_grid( $product, $options, $column, $imgUrl ) {
    ?>

    <div class="fb_col_lg_<?php echo esc_attr( $column ); ?> fb_col_sm_6 fb_text_center">
        <!-- Single Product -->
        <div class="fb_single_product_item">
          <!-- Product Thumb -->
          <div class="fb_product_top">
            <!-- Product Thumb -->
            <div class="fb_product_thumb">
              <img src="<?php echo esc_url( $imgUrl ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" />
            </div>
            <!-- End Product Thumb -->
            <!-- Overlay -->
            <div class="fb_overlay_content">
              <a class="fb_order_button fb_order_cart_button" href="#" data-pid="<?php echo esc_attr( $product->get_id() ); ?>" data-toggle="fbPopupModal" data-target="fb_popup_modal">
                <?php
                $btnIcon      = isset( $options['order-btn-icon'] ) ? $options['order-btn-icon'] : '';
                $btnHoverIcon = isset( $options['order-btn-hover-icon'] ) ? $options['order-btn-hover-icon'] : '';
                
                // Button Icon
                if( !empty( $btnIcon ) ) {
                  echo '<img src="'.esc_url( $btnIcon ).'" class="fb_svg" alt="'.esc_attr__( 'cart icon', 'foodbooklite' ).'" />';
                } else {
                  $icon = FOODBOOKLITE_DIR_URL.'assets/img/icon/cart-btn.svg';
                  echo '<img src="'.esc_url( $icon ).'" class="fb_svg" alt="'.esc_attr__( 'cart icon', 'foodbooklite' ).'" />';
                }
                //
                if( !empty( $btnHoverIcon ) ) {
                  echo '<img src="'.esc_url( $btnHoverIcon ).'" class="fb_svg order-hover-icon" alt="'.esc_attr__( 'cart hover icon', 'foodbooklite' ).'" />';
                }
                
                // Order Button text 
                if( !empty( $options['order-btn-text'] ) ) {
                  echo esc_html( $options['order-btn-text'] );
                } else {
                  esc_html_e( 'Order Now', 'foodbooklite' );
                }
                ?>
              </a>
            </div>
            <!-- End Overlay -->
            <!-- OnSale -->
            <?php 
            if( !empty( $product->get_regular_price() ) && !empty( $product->get_sale_price() )  ) {
              echo '<span class="fb_badge">'.esc_html__( 'On sale', 'foodbooklite' ).'</span>';
            }
            ?>
            <!-- End OnSale -->
          </div>
          <!-- End Product Thumb -->
          <!-- Product Content -->
          <div class="fb_product_content">
            <!-- Title -->
            <h4 class="fb_product_title fb_order_cart_button" data-pid="<?php echo esc_attr( $product->get_id() ); ?>" data-toggle="fbPopupModal" data-target="fb_popup_modal"><?php echo esc_html( $product->get_name() ); ?></h4>
            <!-- End Title -->
            <!-- Star Rating -->
            <div class="fb_star_rating">
              <?php
              foodbooklite_rating_reviews( esc_html( $product->get_average_rating() ) );
              ?>                    
            </div>
            <!-- End Star Rating -->
            <!-- Price -->
            <p class="fb_product_price">
              <?php
              
              //
              if( !empty( $product->get_sale_price() ) && !empty( $product->get_regular_price() ) ) {

                $regular_price = foodbooklite_woo_custom_number_format( $product->get_regular_price() );
                $sale_price    = foodbooklite_woo_custom_number_format( $product->get_sale_price() );

                echo '<span class="fb_old_price">'.esc_html( foodbooklite_currency_symbol_position( $regular_price ) ).'</span>';
                echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $sale_price ) ).'</span>';
              }else {
               
                if( $product->is_type( 'variable' ) ) {

                  $variation_sale_price    = foodbooklite_woo_custom_number_format( $product->get_variation_sale_price( 'min', true ) );
                  $variation_regular_price = foodbooklite_woo_custom_number_format( $product->get_variation_regular_price( 'max', true ) );

                    echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $variation_sale_price ).' - '.foodbooklite_currency_symbol_position( $variation_regular_price ) ).'</span>';
                } else {

                  $price = foodbooklite_woo_custom_number_format( $product->get_price() );

                    echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $price ) ).'</span>';
                }

              }
              ?>
            </p>
            <!-- End Price -->
          </div>
          <!-- End Product Content -->
        </div>
        <!-- Single Product -->
    </div>

    <?php

  }
  /**
   * [product_layout_grid description]
   * @return [type] [description]
   */
  public function product_layout_list( $product, $options, $column, $imgUrl ) {
    ?>

    <div class="fb_col_lg">
        <!-- Single Product -->
        <div class="fb_product_list fb_single_product_item">
          <div class="fb_row">
            <!-- Product Thumb -->
            <div class="fb_col_lg_4">
              <div class="fb_product_top">
                <!-- Product Thumb -->
                <div class="fb_product_thumb">
                  <img src="<?php echo esc_url( $imgUrl ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" />
                </div>
                <!-- End Product Thumb -->
                <!-- OnSale -->
                <?php 
                if( !empty( $product->get_regular_price() ) && !empty( $product->get_sale_price() )  ) {
                  echo '<span class="fb_badge">'.esc_html__( 'On sale', 'foodbooklite' ).'</span>';
                }
                ?>
                <!-- End OnSale -->
              </div>
            </div>
            <!-- End Product Thumb -->
            <!-- Product Content -->
            <div class="fb_col_lg_8">
              <div class="fb_product_content">
                <!-- Title -->
                <h4 class="fb_product_title fb_order_cart_button" data-pid="<?php echo esc_attr( $product->get_id() ); ?>" data-toggle="fbPopupModal" data-target="fb_popup_modal"><?php echo esc_html( $product->get_name() ); ?></h4>
                <!-- End Title -->
                <div class="fb_product_desc">
                  <p class="fb-read-more"><?php echo wp_kses_post( $product->get_description() ); ?></p>
                </div>
                <!-- Star Rating -->
                <div class="fb_star_rating">
                  <?php
                  foodbooklite_rating_reviews( esc_html( $product->get_average_rating() ) );
                  ?>                    
                </div>
                <!-- End Star Rating -->
                <!-- Price -->
                <p class="fb_product_price">
                  <?php
                    //
                    if( !empty( $product->get_sale_price() ) && !empty( $product->get_regular_price() ) ) {

                      $regular_price = foodbooklite_woo_custom_number_format( $product->get_regular_price() );
                      $sale_price    = foodbooklite_woo_custom_number_format( $product->get_sale_price() );

                      echo '<span class="fb_old_price">'.esc_html( foodbooklite_currency_symbol_position( $regular_price ) ).'</span>';
                      echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $sale_price ) ).'</span>';
                    }else {
                     
                      if( $product->is_type( 'variable' ) ) {

                        $variation_sale_price    = foodbooklite_woo_custom_number_format( $product->get_variation_sale_price( 'min', true ) );
                        $variation_regular_price = foodbooklite_woo_custom_number_format( $product->get_variation_regular_price( 'max', true ) );

                          echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $variation_sale_price ).' - '.foodbooklite_currency_symbol_position( $variation_regular_price ) ).'</span>';
                      } else {

                        $price = foodbooklite_woo_custom_number_format( $product->get_price() );

                          echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $price, false ) ).'</span>';
                      }

                    }
                  ?>
                </p>
                <!-- End Price -->
                <a class="fb_order_button fb_order_cart_button" href="#" data-pid="<?php echo esc_attr( $product->get_id() ); ?>" data-toggle="fbPopupModal" data-target="fb_popup_modal">
                    <?php
                    $btnIcon      = isset( $options['order-btn-icon'] ) ? $options['order-btn-icon'] : '';
                    $btnHoverIcon = isset( $options['order-btn-hover-icon'] ) ? $options['order-btn-hover-icon'] : '';
                    
                    // Button Icon
                    if( !empty( $btnIcon ) ) {
                      echo '<img src="'.esc_url( $btnIcon ).'" class="fb_svg" alt="'.esc_attr__( 'cart icon', 'foodbooklite' ).'" />';
                    } else {
                      $icon = FOODBOOKLITE_DIR_URL.'assets/img/icon/cart-btn.svg';
                      echo '<img src="'.esc_url( $icon ).'" class="fb_svg" alt="'.esc_attr__( 'cart icon', 'foodbooklite' ).'" />';
                    }
                    //
                    if( !empty( $btnHoverIcon ) ) {
                      echo '<img src="'.esc_url( $btnHoverIcon ).'" class="fb_svg order-hover-icon" alt="'.esc_attr__( 'cart hover icon', 'foodbooklite' ).'" />';
                    }
                    
                    // Order Button text 
                    if( !empty( $options['order-btn-text'] ) ) {
                      echo esc_html( $options['order-btn-text'] );
                    } else {
                      esc_html_e( 'Order Now', 'foodbooklite' );
                    }
                    ?>
                  </a>
              </div>
            </div>
            <!-- End Product Content -->
          </div>
        </div>
        <!-- Single Product -->
    </div>

    <?php
  }

  /**
   * [product_search_grid_layout description]
   * @return [type] [description]
   */
  public function product_search_grid_layout( $result, $product, $price, $price_sale, $display_price ) {
    ?>
    <div class="fb_col_lg_4 fb_col_sm_6 fb_text_center">
      <!-- Single Product -->
      <div class="fb_single_product_item">
        <!-- Product Thumb -->
        <div class="fb_product_top">
          <!-- Product Thumb -->
          <div class="fb_product_thumb">
            <img src="<?php echo esc_url( get_the_post_thumbnail_url( $result->ID, 'full' ) ); ?>" alt="<?php echo esc_attr( $result->post_title ); ?>" />
          </div>
          <!-- End Product Thumb -->
          <!-- Overlay -->
          <div class="fb_overlay_content">
            <a class="fb_order_button fb_order_cart_button" href="#" data-pid="<?php echo esc_attr( $result->ID ); ?>" data-toggle="fbPopupModal" data-target="fb_popup_modal">
              <img src="<?php echo esc_url( FOODBOOKLITE_DIR_URL.'assets/img/icon/cart-btn.svg' ); ?>" class="fb_svg" />
              <?php esc_html_e( 'order now', 'foodbooklite' ); ?>
            </a>
          </div>
          <!-- End Overlay -->
          <!-- OnSale -->
          <?php 
          if( !empty( $price[0] ) && !empty( $price_sale[0] )  ) {
            echo '<span class="fb_badge">'.esc_html__( 'On sale', 'foodbooklite' ).'</span>';
          }
          ?>
          <!-- End OnSale -->
        </div>
        <!-- End Product Thumb -->
        <!-- Product Content -->
        <div class="fb_product_content">
          <!-- Title -->
          <h4 class="fb_product_title"><?php echo esc_html( $result->post_title ); ?></h4>
          <!-- End Title -->
          <!-- Star Rating -->
          <div class="fb_star_rating">
            <?php
            foodbooklite_rating_reviews( esc_html( $result->average_rating ) );
            ?>                    
          </div>
          <!-- End Star Rating -->
          <!-- Price -->
          <p class="fb_product_price">
            <?php
            //
            if( !empty( $price[0] ) && !empty( $price_sale[0] ) ) {

              $price = foodbooklite_woo_custom_number_format( $price[0] );
              $price_sale = foodbooklite_woo_custom_number_format( $price_sale[0] );

                echo '<span class="fb_old_price">'.esc_html( foodbooklite_currency_symbol_position( $price ) ).'</span>';
              echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $price_sale ) ).'</span>';
            }else {

                $display_price_0 = foodbooklite_woo_custom_number_format( $display_price[0] );

                if( $product->is_type( 'variable' ) ) {
                  $display_price_1 = foodbooklite_woo_custom_number_format( $display_price[1] );

                    echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $display_price_0 ) .' - '.foodbooklite_currency_symbol_position( $display_price_1 ) ).'</span>';
                } else {
                    echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $display_price_0 ) ).'</span>';
                }
              
            }
            ?>
          </p>
          <!-- End Price -->
        </div>
        <!-- End Product Content -->
      </div>
      <!-- Single Product -->
    </div>
    <?php
  }

  /**
   * [product_search_list_layout description]
   * @return [type] [description]
   */
  public function product_search_list_layout( $result, $product, $price, $price_sale, $display_price ) {
  ?>
    <div class="fb_col_lg product-search-result-list">
      <!-- Single Product -->
      <div class="fb_single_product_item">
        <div class="fb_row">
          <!-- Product Thumb -->
          <div class="fb_col_lg_4">
            <div class="fb_product_top">
              <!-- Product Thumb -->
              <div class="fb_product_thumb">
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( $result->ID, 'full' ) ); ?>" alt="<?php echo esc_attr( $result->post_title ); ?>" />
              </div>
              <!-- End Product Thumb -->
              <!-- OnSale -->
              <?php 
              if( !empty( $price[0] ) && !empty( $price_sale[0] )  ) {
                echo '<span class="fb_badge">'.esc_html__( 'On sale', 'foodbooklite' ).'</span>';
              }
              ?>
              <!-- End OnSale -->
            </div>
          </div>
          <!-- End Product Thumb -->
          <!-- Product Content -->
          <div class="fb_col_lg_8">
            <div class="fb_product_content">
              <!-- Title -->
              <h4 class="fb_product_title"><?php echo esc_html( $result->post_title ); ?></h4>
              <!-- End Title -->
              <div class="fb_product_desc">
                  <p class="fb-read-more"><?php echo wp_kses_post( $product->get_description() ); ?></p>
              </div>
              <!-- Star Rating -->
              <div class="fb_star_rating">
                    <?php
                    foodbooklite_rating_reviews( esc_html( $result->average_rating ) );
                    ?>                    
              </div>
              <!-- End Star Rating -->
              <!-- Price -->
              <p class="fb_product_price">
                <?php
                //
                if( !empty( $price[0] ) && !empty( $price_sale[0] ) ) {
                    echo '<span class="fb_old_price">'.esc_html( foodbooklite_currency_symbol_position( $price[0] ) ).'</span>';
                  echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $price_sale[0] ) ).'</span>';
                }else {

                    if( $product->is_type( 'variable' ) ) {
                        echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $display_price[0] ) .' - '.foodbooklite_currency_symbol_position( $display_price[1] ) ).'</span>';
                    } else {
                        echo '<span class="fb_new_price">'.esc_html( foodbooklite_currency_symbol_position( $display_price[0] ) ).'</span>';
                    }
                  
                }
                ?>
              </p>
              <a class="fb_order_button fb_order_cart_button" href="#" data-pid="<?php echo esc_attr( $result->ID ); ?>" data-toggle="fbPopupModal" data-target="fb_popup_modal">
                  <img src="<?php echo esc_url( FOODBOOKLITE_DIR_URL.'assets/img/icon/cart-btn.svg' ); ?>" class="fb_svg" />
                  <?php esc_html_e( 'order now', 'foodbooklite' ); ?>
              </a>
              <!-- End Price -->
            </div>
          </div>
          <!-- End Product Content -->
        </div>
      </div>
      <!-- Single Product -->
    </div>
  <?php
  }


}
