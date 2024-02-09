<!-- End Overlay -->
<div class="fb__wrapper">
  <!-- Search -->
  <?php 
  global $foodbookliteAttr;

  $options = get_option('foodbooklite_options');

  $column = '4';
  $shortCodeCat = '';
  $layout  = 'grid';
  $sidebar = 'yes';
  $search  = 'yes';


  if( !empty( $foodbookliteAttr ) ) {

    $column = foodbooklite_bootstrap_column_map( $foodbookliteAttr['col'] );
    $shortCodeCat    = !empty(  $foodbookliteAttr['cat'] ) ? $foodbookliteAttr['cat'] : '';
    $layout = !empty(  $foodbookliteAttr['layout'] ) ? $foodbookliteAttr['layout'] : '';
    $sidebar = !empty(  $foodbookliteAttr['sidebar'] ) ? $foodbookliteAttr['sidebar'] : '';
    $search  = !empty(  $foodbookliteAttr['search'] ) ? $foodbookliteAttr['search'] : '';

  } else {

    $column = !empty(  $options['product-column'] ) ? $options['product-column'] : '';
    $layout = !empty(  $options['product-layout'] ) ? $options['product-layout'] : 'grid';
    $search = !empty( $options['search-section'] ) && $options['search-section'] == 'yes' ? 'yes' : 'no';

  }

  if( $search == 'yes' ):
  ?>
  <section>
    <div class="fb_container">
      <div class="fb_row">
        <div class="fb_col_12">
          <!-- Search -->
          <div class="fb_search fb_top_50">
            <!-- Search Form -->
            <form action="#" class="fb_search_form">
              <div class="fb_search_input_group">
                <label for="fb_search">
                  <img
                    src="<?php echo esc_url( FOODBOOKLITE_DIR_URL.'assets/img/icon/search.svg' ); ?>"
                    class="fb_svg"
                    alt="<?php esc_attr_e( 'Search svg', 'foodbooklite' ); ?>"
                  />
                </label>
                <input
                  id="fb_search"
                  class="fb_input_style"
                  type="text"
                  placeholder="<?php esc_html_e( 'Search your favorite food...', 'foodbooklite' ); ?>"
                />
              </div>
              <div class="fb-search-result" data-col="<?php echo esc_attr( $column ); ?>" data-layout="<?php echo esc_attr( $layout ); ?>"></div>
            </form>
            <!-- End Search Form -->
          </div>
          <!-- End Search -->
        </div>
      </div>
    </div>
  </section>
  <?php 
  endif;
  ?>
  <!-- End Search -->
  <!-- Product -->
  <section class="fb-pt-80 pb-pb-80">
    <div class="fb_container">
      <div class="fb_row">
        <?php
        $wrapCol = '12';
        if( $sidebar == 'yes' ):
        $wrapCol = '9';
        ?>
        <div class="fb_col_lg_3">
          <!-- Sidebar -->
          <div class="fb_sidebar">
            <!-- Filter Wrapper -->
            <?php
            $cats = foodbooklite_getCategories();
            if( !empty( $cats ) ):
            ?>
            <div class="fb_filter_wrapper">
              <!-- Section Title -->
              <div class="fb_section_title">
                <h3><?php esc_html_e( 'Categories', 'foodbooklite' ); ?></h3>
              </div>
              <!-- Section Title -->
              <!-- Category Menu -->
              <div class="fb_category_menu">
                <ul class="fb_category_list">
                  <li class="fb_category_item all_items">
                        <div class="fb_category_link">
                            <span class="fb_custom_checkbox">
                              <label>
                                <span class="fb_category_name"><?php esc_html_e( 'All', 'foodbooklite' ); ?></span>
                                <span class="fb_custom_checkmark"></span>
                              </label>
                            </span>
                        </div>
                    </li>
        						<?php 
        						foreach( $cats as $cat ):

        						?>
                    	<li class="fb_category_item">
                        <div class="fb_category_link">
                          	<span class="fb_custom_checkbox">
	                            <label>
	                            	<input type="radio" value="<?php echo esc_attr( $cat->slug ); ?>" name="fb_product_category"/>
	                            	<span class="fb_category_name"><?php echo esc_html( $cat->name ) ?></span>
	                            	<span class="fb_custom_checkmark"></span>
	                            </label>
                          	</span>
                        </div>
                        <?php 
                        if( !empty( $cat->count ) ) {
                        	echo '<div class="fb_category_quantity"><span>'.esc_html( $cat->count ).'</span></div>';
                        }
                        ?>
                    	</li>
                  <?php 
              		endforeach;
                  ?>
                </ul>
              </div>
              <!-- End Category Menu -->
            </div>
            <?php 
            endif;
            ?>
            <!-- End Filter Wrapper -->

            <!-- Filter Wrapper -->
            <?php 
            $cats = foodbooklite_getSpecialOffer();

            if( !empty( $cats ) ):
            ?>
            <div class="fb_filter_wrapper">
              <!-- Section Title -->
              <div class="fb_section_title">
                <h3><?php esc_html_e( 'Special Offer', 'foodbooklite' ); ?></h3>
              </div>
              <!-- Section Title -->
              <!-- Category Menu -->
              <div class="fb_category_menu">
                <ul class="fb_category_list">
                  <li class="fb_category_item all_items">
                        <div class="fb_category_link">
                            <span class="fb_custom_checkbox">
                              <label>
                                <span class="fb_category_name"><?php esc_html_e( 'All', 'foodbooklite' ); ?></span>
                                <span class="fb_custom_checkmark"></span>
                              </label>
                            </span>
                        </div>
                    </li>
        						<?php
                    //
                    if( !empty( $cats ) ):
        						foreach( $cats as $cat ):
        						?>
                    	<li class="fb_category_item">
                        <div class="fb_category_link">
                          	<span class="fb_custom_checkbox">
	                            <label>
	                            	<input type="radio" value="<?php echo esc_attr( $cat->slug ); ?>" name="fb_product_specialoffer"/>
	                            	<span class="fb_category_name"><?php echo esc_html( $cat->name ) ?></span>
	                            	<span class="fb_custom_checkmark"></span>
	                            </label>
                          	</span>
                        </div>
                        <?php 
                        if( !empty( $cat->count ) ) {
                        	echo '<div class="fb_category_quantity"><span>'.esc_html( $cat->count ).'</span></div>';
                        }
                        ?>
                    	</li>
                  <?php 
              		endforeach;
                  endif;
                  ?>
                </ul>
              </div>
              <!-- End Category Menu -->
            </div>
            <?php 
            endif;
            ?>
            <!-- End Filter Wrapper -->
          </div>
          <!-- End Sidebar -->
        </div>
        <?php 
        endif;
        ?>
        <div class="fb_col_lg_<?php echo esc_attr( $wrapCol ); ?>">
          <!-- Section Title -->
          <div class="fb_section_title">
            <h3><?php esc_html_e( 'All items', 'foodbooklite' ); ?></h3>
            <select name="orderby" class="orderby-filter" aria-label="Shop order">
                <option value="menu_order" selected="selected"><?php esc_html_e( 'Default sorting', 'foodbooklite' ); ?></option>
                <option value="popularity"><?php esc_html_e( 'Sort by popularity', 'foodbooklite' ); ?></option>
                <option value="rating"><?php esc_html_e( 'Sort by average rating', 'foodbooklite' ); ?></option>
                <option value="date"><?php esc_html_e( 'Sort by latest', 'foodbooklite' ); ?></option>
                <option value="price"><?php esc_html_e( 'Sort by price: low to high', 'foodbooklite' ); ?></option>
                <option value="price-desc"><?php esc_html_e( 'Sort by price: high to low', 'foodbooklite' ); ?></option>
            </select>
          </div>
          <!-- Section Title -->
          <!-- Product List -->
          <div class="fb_row foodbooklite-products" data-cat="<?php echo esc_attr( $shortCodeCat ); ?>" data-col="<?php echo esc_attr( $column ); ?>" data-layout="<?php echo esc_attr( $layout ); ?>"></div>
          <!-- End Product List -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Product -->

  <!-- Cart Button -->
  <span class="fb_cart_count_btn">
    <?php
    if( !is_admin() ):
    ?>
    <span class="fb_cart_count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
    <?php
    endif;
    ?>
    <span class="fb_cart_icon">
      <?php 
      if( !empty( $options['cart-btn-icon'] ) ) {
        echo '<img src="'.esc_url( $options['cart-btn-icon'] ).'" class="fb_svg" alt="'.esc_attr( 'cart count', 'foodbooklite' ).'" />';
      } else {
        $icon = FOODBOOKLITE_DIR_URL.'assets/img/icon/cart-btn-icon.svg';
        echo '<img src="'.esc_url( $icon ).'" class="fb_svg" alt="'.esc_attr( 'cart count', 'foodbooklite' ).'" />';
      }
      ?>
    </span>
  </span>
  <!-- End Cart Button -->
</div>
