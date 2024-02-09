<?php 
/**
 *
 * @package     Foodbooklite
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

/**
 * [foodbooklite_getCategories description]
 * @return array
 */
function foodbooklite_getCategories() {

    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ) );

    return $terms;

}

/**
 * [foodbooklite_getOptionData description]
 * @return [type] [description]
 */
function foodbooklite_getOptionData( $key, $defaultValue = '' ) {

  $data = get_option( 'foodbooklite_options' );
  return !empty( $data[$key] ) ? $data[$key] : $defaultValue;
}
/**
 * [foodbooklite_getSpecialOffer description]
 * @return array
 */
function foodbooklite_getSpecialOffer() {

    $terms = get_terms( array(
        'taxonomy' => 'specialoffer',
        'hide_empty' => true,
    ) );

    return $terms;

}

/**
 * [foodbooklite_rating_reviews description]
 * @param  string  $rating [description]
 * @param  boolean $echo   [description]
 * @return html          [description]
 */
function foodbooklite_rating_reviews( $rating, $echo = true ) {

  $starRating = '';

	$j = 0;

    for( $i = 0; $i <= 4; $i++ ) {
      $j++;

      if( $rating  >= $j   || $rating  == '5'   ) {

        $starRating .= '<i class="fas fa-star"></i>';

      }elseif( $rating < $j && $rating  > $i )
      {
        $starRating .= '<i class="fas fa-star-half-alt"></i>';

      } else {

        $starRating .= '<i class="far fa-star"></i>';

      }

    }


    if( $echo == true ) {
      echo $starRating;
    } else {
      return $starRating;
    }


}

/**
 * [foodbooklite_getStatusText description]
 * @return [type] [description]
 */
function foodbooklite_getStatusText() {

  return [

    'no'    => foodbooklite_getOptionData( 'new-order-text', esc_html__( 'New Order', 'foodbooklite' ) ),
    'op'    => foodbooklite_getOptionData( 'order-placed-text', esc_html__( 'Order Placed', 'foodbooklite' ) ),
    'po'    => foodbooklite_getOptionData( 'pre-order-text', esc_html__( 'Pre Order', 'foodbooklite' ) ),
    'oc'    => foodbooklite_getOptionData( 'order-cancel-text', esc_html__( 'Order Cancel', 'foodbooklite' ) ),
    'p'     => foodbooklite_getOptionData( 'processing-text', esc_html__( 'Processing', 'foodbooklite' ) ),
    'ac'    => foodbooklite_getOptionData( 'accepted-cooking-text', esc_html__( 'Accepted Cooking', 'foodbooklite' ) ),
    'stc'   => foodbooklite_getOptionData( 'send-to-cooking-text', esc_html__( 'Send To Cooking', 'foodbooklite' ) ),
    'wfka'  => foodbooklite_getOptionData( 'waiting-for-kitchen-accept-text', esc_html__( 'Waiting For Kitchen Accept', 'foodbooklite' ) ),
    'cc'    => foodbooklite_getOptionData( 'cooking-completed-text', esc_html__( 'Cooking Completed', 'foodbooklite' ) ),
    'rtd'   => foodbooklite_getOptionData( 'ready-to-delivery-text', esc_html__( 'Ready To Delivery', 'foodbooklite' ) ),
    'otw'   => foodbooklite_getOptionData( 'on-the-way-text', esc_html__( 'On The Way', 'foodbooklite' ) ),
    'owd'   => foodbooklite_getOptionData( 'way-to-delivery-text', esc_html__( 'On The Way To Delivery', 'foodbooklite' ) ),
    'dc'    => foodbooklite_getOptionData( 'delivery-completed-text', esc_html__( 'Delivery Completed', 'foodbooklite' ) ),
    'cp'    => foodbooklite_getOptionData( 'cooking-processing-text', esc_html__( 'Cooking Processing', 'foodbooklite' ) )

  ];

}

/**
 * [foodbooklite_tracking_status description]
 * Order Tracking Status list
 * @return array
 */
function foodbooklite_tracking_status() {

  $statusText = foodbooklite_getStatusText();


  $stc = $statusText['stc'];

  if( foodbooklite_is_user_role('kitchen_manager') ) {
    $stc = $statusText['wfka'];
  } 

  return [

    'OP'    => $statusText['op'],
    'PO'    => $statusText['po'],
    'OC'    => $statusText['oc'],
    'PROC'  => $statusText['p'],
    'AC'    => $statusText['ac'],
    'STC'   => $stc,
    'CC'    => $statusText['cc'],
    'RD'    => $statusText['rtd'],
    'OWD'   => $statusText['owd'],
    'DC'    => $statusText['dc']

  ];

}

/**
 * [foodbooklite_converted_tracking_status description]
 * Order Tracking Status convert
 * @param  string $val [description]
 * @return string      
 */
function foodbooklite_converted_tracking_status( $val ) {

  $status = foodbooklite_tracking_status();

  switch( $val ) {
    case  "OP" :
      return $status['OP'];
      break;
      case  "PO" :
      return $status['PO'];
      break;
      case  "OC" :
      return $status['OC'];
      break;
      case  "PROC" :
      return $status['PROC'];
      break;
      case  "AC" :
      return $status['AC'];
      break;
      case  "STC" :
      return $status['STC'];
      break;
      case  "CC" :
      return $status['CC'];
      break;
      case  "RD" :
      return $status['RD'];
      break;
      case  "OWD" :
      return $status['OWD'];
      break;
      case  "DC" :
      return $status['DC'];
      break;
  }

}

/**
 * [foodbooklite_branch_list description]
 * @return [type] [description]
 */
function foodbooklite_branch_list() {

  $args = array(

    'posts_per_page' => '-1',
    'post_type' => 'branches',

  );

  $getBranch = get_posts( $args );

  $options = [];

  foreach( $getBranch as $branch ) {
      $options[$branch->ID] = $branch->post_title;
  }

  return $options;
}


/**
 * [foodbooklite_get_current_branch_id_by_manager description]
 * Get current branch ID
 * @return array
 */
function foodbooklite_get_current_branch_id_by_manager() {


   $currentUser = get_current_user_id();

    // User data
    $user_meta = get_userdata( $currentUser );

    $user_roles = $user_meta->roles;

    //
    $meta_key = '';

    // is branch manager
    if( $user_roles[0] == 'branch_manager' ) {

      $meta_key = 'foodbooklitebranch_manager';
     
    }
    // is kitchen manager
    if( $user_roles[0] == 'kitchen_manager' ) {

      $meta_key = 'foodbooklitekitchen_manager';
     
    }
    // is delivery boy
    if( $user_roles[0] == 'delivery_boy' ) {

      $meta_key = 'foodbooklitedelivery_boy';
     
    }


    // Get branch
    $args = array (
        'post_type'        => 'branches',
        'post_status'      => 'publish',
        'meta_key'         => $meta_key,
        'meta_value'       => esc_html( $currentUser ),

    );

  $getBranchesId = get_posts( $args );


  $getBranchesId = array_column( $getBranchesId, 'ID' );

  $getBranchesId = !empty( $getBranchesId[0] ) ? $getBranchesId[0] : '';

  
  return $getBranchesId;


}

/**
 * [foodbooklite_get_users_role_delivery_manager description]
 * Get delivery users
 * @return array
 */
function foodbooklite_get_users_role_delivery_manager() {

  $users = get_users( [ 'role__in' => [ 'delivery_boy' ] ] );

  $getUser = [ '0' => 'Select Delivery Boy' ];

  foreach( $users as $user ) {

    $getUser[$user->ID] = $user->display_name;

  }

  return $getUser;

}

/**
 * [foodbooklite_get_branch_delivery_boy description]
 * Get branch delivery boy
 * @param  string $branch_id [description]
 * @return array
 */
function foodbooklite_get_branch_delivery_boy( $branch_id = '' ) {

  //

  if( foodbooklite_is_multi_branch() )  {

    if( empty( $branch_id ) ) {
      $branch_id = foodbooklite_get_current_branch_id_by_manager();
    }  

    $dIDs = get_post_meta( absint( $branch_id ), 'foodbooklitedelivery_boy', true );

    // User data
    $boy = [];

    if( !empty( $dIDs ) ) {

      foreach( $dIDs as $id ) {

        $user_meta = get_userdata( $id );

        $boy[$user_meta->ID] =  $user_meta->user_login;

      }

    }

  } else {
    $boy = foodbooklite_get_users_role_delivery_manager();
  }

  return $boy;

}


/**
 * [foodbooklite_current_date ]
 * @return string date
 */
function foodbooklite_current_date() {

  $dateFormat = "M d, Y";

  return date( $dateFormat );

}

/**
 * [foodbooklite_time_elapsed_string description]
 * time elapsed string
 * @param  [type]  $datetime [description]
 * @param  boolean $full     [description]
 * @return string            [description]
 */
function foodbooklite_time_elapsed_string( $datetime, $full = false ) {
  
    $now = new \DateTime;
    $ago = new \DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

/**
 * [foodbooklite_page_permission description]
 * @param  [type] $role [description]
 * @return url       [description]
 */
function foodbooklite_page_permission( $role ) {

  $url = home_url('/');

  if( is_user_logged_in() ) {

    $user = wp_get_current_user();

    $roles = $user->roles;

    if( $roles[0] != $role ) {
      wp_safe_redirect( $url );
    }

  } else {
    wp_safe_redirect( $url );
    exit;

  }

}

/**
 * foodbooklite_is_user_role
 * @return bool
 */
function foodbooklite_is_user_role( $role ) {

  if( is_user_logged_in() ) {

    $user = wp_get_current_user();

    $roles = $user->roles;

    if( $roles[0] == $role ) {
      return true;
    } else {
      return false;
    }

  }

}

/**
 * foodbooklite_is_multi_branch 
 * check is set multi branch
 * @return bool
 */

function foodbooklite_is_multi_branch() {

  if( ! foodbooklite_is_active_multi_branch() ) {
    return false;
  }

  $options = get_option('foodbooklite_options');

  if( !empty( $options['brunch-type'] ) && $options['brunch-type'] == 'multi' ) {
    return true;
  } else {
    return false;
  }

}


/**
 * foodbooklite_is_active_multi_branch 
 * check is set active multi branch
 * @return bool
 */

function foodbooklite_is_active_multi_branch() {

  if( ! class_exists('FoodbookliteMultibranch') ) {
    return false;
  } else {
    return true;
  }

}

/**
 * foodbooklite_currency_symbol_position
 * currency symbol position
 * @return 
 */

function foodbooklite_currency_symbol_position( $price , $format = true ) {

  $currencyPos = get_option( 'woocommerce_currency_pos' );

  $currency   = get_woocommerce_currency_symbol();

  if( !$price ) {
    return;
  }

/*  if( $format ) {

    $price = foodbooklite_woo_custom_number_format( $price );
  }*/

  
  $getPrice = $currency.$price;

  if( $currencyPos != 'left' ) {

    switch( $currencyPos ) {

      case 'right':
        $getPrice =  $price.$currency;
      break;
      case 'left_space':
        $getPrice =  $currency.' '.$price;
      break;
      case 'right_space':
        $getPrice =  $price.' '.$currency;
      break;
      default :
        $getPrice = $currency.$price;
      break;

    }

  }

  return $getPrice;
  
}

/**
 * foodbooklite_bootstrap_column_map
 * bootstrap grid column maping
 * @return 
 */

function foodbooklite_bootstrap_column_map( $col ) {

  
  switch( $col ) {

    case '2' :
      $setCol = '6';
      break;
    case '3' :
      $setCol = '4';
      break;
    case '4' :
      $setCol = '3';
      break;
      default: 
        $setCol = '4';
      break;
  }

  return $setCol;


}

/**
 * foodbooklite_woo_custom_number_format
 * custom number format decimal, thousand separator  and Number of decimals set 
 * @return 
 */

function foodbooklite_woo_custom_number_format( $number ) {

  if( empty( $number ) ) {
    return;
  }

  $decimal_separator  = wc_get_price_decimal_separator();
  $thousand_separator = wc_get_price_thousand_separator();
  $decimals           = wc_get_price_decimals();

  return number_format( $number, $decimals, $decimal_separator, $thousand_separator);

}

/**
 * foodbooklite_extra_option_price_filter
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function foodbooklite_extra_option_price_filter( $data ) {

  $explodeData = explode(':', $data);
  $arrayEnd = end($explodeData);
  return preg_replace('/[^0-9-.]+/', '', $arrayEnd );
}

/**
 * [foodbooklite_date_format description]
 * @param  string $format [description]
 * @param  [type] $date   [description]
 * @return string         [description]
 */
function foodbooklite_date_format( $date, $format = '' ) {

  $format = !empty( $format ) ? $format : 'M-d-Y';
  return date( $format, strtotime( $date ) );
}

function getBranchWithLocation() {
  
  $args = array(
    'posts_per_page' => '-1',
    'post_type' => 'branches',

  );

  $getBranch = get_posts( $args );
  $options = [];
  foreach( $getBranch as $branch ) {

    /*$location = get_post_meta( $branch->ID, 'foodbooklitebranch_location', true );
    $options[$location] = $branch->post_title;*/

    $options[$branch->ID] = $branch->post_title;
  }
  return $options;
}

function foodbooklite_is_location_type_address() {

  $options = get_option('foodbooklite_options');

  return !empty( $options['location_type'] ) && $options['location_type'] == 'address' ? true : false;

}