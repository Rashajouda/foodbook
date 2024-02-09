<?php
namespace Darklooks\Inc;
/**
 *
 * @package     Darklooks
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Helper {

	/**
	 * get settings option value
	 * @param  string $optionKey
	 * 
	 */
	public static function getOptionValue( $Key ) {
		$options = get_option( DARKLOOKS_OPTION_NAME );
		$value = '';
		if( !empty( $options[$Key] ) ) {
			$value = $options[$Key];
		}
		return $value;
	}
	/**
	 * 
	 * Time list in array
	 * @return array
	 * 
	 */
	public static function getTimeList() {
	    return [
	        '00:00' => '12:00 AM',
	        '01:00' => '01:00 AM',
	        '02:00' => '02:00 AM',
	        '03:00' => '03:00 AM',
	        '04:00' => '04:00 AM',
	        '05:00' => '05:00 AM',
	        '06:00' => '06:00 AM',
	        '07:00' => '07:00 AM',
	        '08:00' => '08:00 AM',
	        '09:00' => '09:00 AM',
	        '10:00' => '10:00 AM',
	        '11:00' => '11:00 AM',
	        '12:00' => '12:00 PM',
	        '13:00' => '01:00 PM',
	        '14:00' => '02:00 PM',
	        '15:00' => '03:00 PM',
	        '16:00' => '04:00 PM',
	        '17:00' => '05:00 PM',
	        '18:00' => '06:00 PM',
	        '19:00' => '07:00 PM',
	        '20:00' => '08:00 PM',
	        '21:00' => '09:00 PM',
	        '22:00' => '10:00 PM',
	        '23:00' => '11:00 PM'
	    ];
	}

	/**
	 * Nav menu location 
	 * @return array
	 * 
	 */
	public static function getNavMenuLocations() {
		$locations = [];
		foreach( get_nav_menu_locations() as $key => $menu ) {
		  $locations[$key] = str_replace('-', ' ', $key);
		}
		return $locations;
	}
	/**
	 *  Logo maping
	 * @return array
	 * 
	 */
	public static function getSiteLogo() {
    	$lightLogo = self::getOptionValue('light_site_logo');
    	$darkLogo  = self::getOptionValue('dark_site_logo');
    	return [ 'light_logo' => $lightLogo, 'dark_logo' => $darkLogo ];
  	}
  	/**
	 *  Dark image maping
	 * @return array
	 * 
	 */
  	public static function getImages() {

		$lightImg  = self::getOptionValue('light_img_url');
	    $darkImg   = self::getOptionValue('dark_img_url');
	    $images = '';
	    // array check
	    if( is_array( $lightImg ) && is_array( $darkImg ) ) {
	      $images = array_combine( $lightImg, $darkImg);
	    }

	    $getImages = [];
	    if( !empty( $images ) ) {
	      foreach( $images as $key => $val ) {
	        $getImages[] = [ $key, $val ];
	      }
	    }
	    return $getImages;
	}
	/**
	 *  Time maping
	 * @return bool
	 * 
	 */
	public static function modeTimeMaping() {
		
		$is_active_time_mode  = self::getOptionValue('enable_time_dark_mode');
	    if( !$is_active_time_mode ) {
	      return;
	    }
	    // 
	    $getStartTime  = self::getOptionValue('dark_start_time');
	    $getEndTime    = self::getOptionValue('dark_end_time');
	    //
	    $currentTime = current_time( 'timestamp' );
	    //
	    $startTime   = strtotime( $getStartTime  );
	    $endTime     = strtotime( $getEndTime );

	    return $currentTime >= $startTime && $currentTime <= $endTime ? true : false;

	}

}
