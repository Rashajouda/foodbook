<?php
    // Block direct access

    if( !defined( 'ABSPATH' ) ){
        exit( );
    }
    /**
    * @Packge     : foodbook
    * @Version    : 1.0
    * @Author     : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */

    // shop page / product page wrapper start
    if( ! function_exists('foodbook_woocommerce_output_content_wrapper') ) {
        function foodbook_woocommerce_output_content_wrapper( ) {
            echo '<section class="pt-110 pb-110">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( class_exists('ReduxFramework') ) {
                            if( class_exists('woocommerce') && is_shop() ) {
                                $foodbook_woo_shoppage_sidebar = foodbook_opt('foodbook_woo_shoppage_sidebar');
                                if( $foodbook_woo_shoppage_sidebar == '2' && is_active_sidebar('foodbook_woo_sidebar') ) {
                                    echo '<div class="col-lg-8">';
                                } elseif ( $foodbook_woo_shoppage_sidebar == '3' && is_active_sidebar('foodbook_woo_sidebar') ) {
                                    echo '<div class="col-lg-8 order-last">';
                                } else {
                                    if( !is_active_sidebar('foodbook_woo_sidebar')  ) {
                                        echo '<div class="col-lg-12">';
                                    } else {
                                        echo '<div class="col-lg-8">';
                                    }
                                }
                            }
                            if( class_exists('woocommerce') && is_product() ) {
                                $foodbook_woo_singlepage_sidebar = foodbook_opt('foodbook_woo_singlepage_sidebar');
                                if( $foodbook_woo_singlepage_sidebar == '2' && is_active_sidebar('foodbook_woo_sidebar') ) {
                                    echo '<div class="col-lg-8">';
                                } elseif ( $foodbook_woo_singlepage_sidebar == '3' && is_active_sidebar('foodbook_woo_sidebar') ) {
                                    echo '<div class="col-lg-8 order-last">';
                                } else {
                                    if( ! is_active_sidebar( 'foodbook_woo_sidebar' ) ) {
                                        echo '<div class="col-lg-12">';
                                    } else {
                                        echo '<div class="col-lg-8">';
                                    }
                                }
                            }
                        } else {
                            if( is_active_sidebar('foodbook_woo_sidebar') ) {
                                echo '<div class="col-lg-8">';
                            } else {
                                echo '<div class="col-lg-12">';
                            }
                        }
        }
    }


    if( ! function_exists('foodbook_woocommerce_output_content_wrapper_end') ) {
        function foodbook_woocommerce_shop_page_product_column_end( ) {
            echo '</div>';
        }
    }    

    // shop page / product page wrapper start
    if( ! function_exists('foodbook_woocommerce_output_content_wrapper_end') ) {
        function foodbook_woocommerce_output_content_wrapper_end( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // result count before wrapper
    if( !function_exists('foodbook_woocommerce_result_count_catelog_wrapper') ) {
        function foodbook_woocommerce_result_count_catelog_wrapper( ) {
            echo '<div class="row align-items-center">';
                echo '<div class="col-lg-6">';
                    woocommerce_result_count();
                echo '</div>';
                echo '<div class="col-lg-6">';
                    woocommerce_catalog_ordering();
                echo '</div>';
            echo '</div>';    
        }
    }

// Woocommerce Product Per Page
add_filter( 'loop_shop_per_page', 'foodbook_new_loop_shop_per_page', 20 );
function foodbook_new_loop_shop_per_page( $product_count ) {
  $product_count = foodbook_opt( 'foodbook_woo_product_perpage' );
  return $product_count;
}

// woocommerce related product number
add_filter('woocommerce_output_related_products_args','foodbook_woocommerce_output_related_products_args',10,1);
function foodbook_woocommerce_output_related_products_args( $args ) {
    if( class_exists('ReduxFramework') ) {
        $args['posts_per_page'] = foodbook_opt('foodbook_woo_relproduct_num');
        $args['columns'] = foodbook_opt('foodbook_woo_related_product_col');
    } else {
        $args['posts_per_page'] = '3';
        $args['columns'] = '3';
    }

    return $args;
}

// woocommerce upsell product number
add_filter('woocommerce_upsell_display_args','foodbook_woocommerce_upsell_display_args',10,1);
function foodbook_woocommerce_upsell_display_args( $args ) {
    if( class_exists('ReduxFramework') ) {
        $args['posts_per_page'] = foodbook_opt('foodbook_woo_upsellproduct_num');
        $args['columns'] = foodbook_opt('foodbook_woo_upsell_product_col');
    } else {
        $args['posts_per_page'] = '3';
        $args['columns'] = '3';
    }
    return $args;
}

// woocommerce cross sell product number
add_filter('woocommerce_cross_sells_total','foodbook_woocommerce_cross_sells_total',10,1);
function foodbook_woocommerce_cross_sells_total( $limit ) {
    if( class_exists('ReduxFramework') ) {
        $limit = foodbook_opt('foodbook_woo_crosssellproduct_num');
    } else {
        $limit = '3';
    }

    return $limit;
}

// woocommerce cross sell product number
add_filter('woocommerce_cross_sells_total','foodbook_woocommerce_cross_sells_columns',10,1);
function foodbook_woocommerce_cross_sells_columns( $col ) {
    if( class_exists('ReduxFramework') ) {
        $col = foodbook_opt('foodbook_woo_upsell_product_col');
    } else {
        $col = '3';
    }

    return $col;
}

// woocommerce product column number
add_filter('loop_shop_columns','foodbook_loop_shop_columns');
function foodbook_loop_shop_columns( $col ) {
    if( class_exists('ReduxFramework') ) {
        $col = foodbook_opt('foodbook_woo_product_col');
    } else {
        $col = '4';
    }

    return $col;
}

// woocommerce search form
add_filter('get_product_search_form','foodbook_woocommerce_search_form');

function foodbook_woocommerce_search_form( ) {
    echo '<form action="' . esc_url( home_url( '/' ) ) .'" method="get">';
    echo '<div class="theme-input-group">';
    echo '<input required class="theme-input-style" name="s" placeholder="'.esc_attr__( 'Product Search','foodbook' ).'" type="text" value="'.wp_kses_post( get_search_query() ).'" />';
    echo '<button type="submit" class="submit-btn">';
        esc_html_e('Search','foodbook');
    echo '</button><input type="hidden" name="post_type" value="product" /></div></form>';
}

// woocommerce single product title position
if( !function_exists('foodbook_woocommerce_template_single_title') ) {
    function foodbook_woocommerce_template_single_title() {
        if( class_exists('ReduxFramework') ) {
            $foodbook_product_details_title_position = foodbook_opt('foodbook_product_details_title_position');
        } else {
            $foodbook_product_details_title_position = 'header';
        }

        if( $foodbook_product_details_title_position != 'header' ) {
            echo '<h2>'.wp_kses_post( get_the_title() ).'</h2>';
        }
    }
}