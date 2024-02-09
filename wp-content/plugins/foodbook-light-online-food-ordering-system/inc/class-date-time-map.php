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
class Date_Time_Map {

  /**
   * [$timeZone description]
   * @var string
   */
  private static $timeZone;

  
  private static function setTimeZone() {
    
    $zone = get_option('foodbooklite_options');
    self::$timeZone = !empty( $zone['time-zone'] ) ? $zone['time-zone'] : '';

    return self::$timeZone;
  }

  /**
   * [SetDateTime description]
   * @param string $timeZone 
   * @return  object
   */
  private static function SetDateTime() {

    return new \DateTime(self::setTimeZone());

  }

  public static function getDateTime() {
    return self::SetDateTime();
  }

  /**
   * [getDate description]
   * @return [type] [description]
   */
  public static function getDate() {

  }

  /**
   * [getTime description]
   * @return [type] [description]
   */
  public static function getTimes( $selectedDate = '' ) {

    return self::timeListMaping( $selectedDate  );

  }

  /**
   * [dataMaping description]
   * @return [type] [description]
   */
  public static function dataMaping() {

  }

  /**
   * [timeMaping description]
   * @return [type] [description]
   */
  public static function timeListMaping( $selectedDate = '' ) {

    $options = get_option('foodbooklite_options');

    // Time format 
    $timeFormat = 'h:ia';
    if( !empty( $options['delivery-time-format'] ) && $options['delivery-time-format'] == '24' ) {
      $timeFormat = 'H:i';
    }

    //
   
    $times = [];

    // get Current time
    $currentTime    = self::getDateTime();

    // Round formatted time
    $getCurrentHout = $currentTime->format('h');
    $getCurrentMeridiem = $currentTime->format('a');
    $getMinute = $currentTime->format('i') < 30 ? '30' : '00';
    $getCurrentTime = "$getCurrentHout:$getMinute$getCurrentMeridiem";

    // Check date
    $setStartTime = $getCurrentTime;

    if( !empty( $selectedDate ) ) {

      $currentDate  = strtotime( date('d-m-Y') );
      $selectedDate = strtotime( $selectedDate );

      if( $selectedDate > $currentDate ) {
        $setStartTime = $options['delivery-start-time'];
      }

    }

    // value init 
    $startTime   = $setStartTime;
    $endTime     = !empty( $options['delivery-end-time'] ) ? $options['delivery-end-time'] : '07:00pm';
    $MinutesDeff = '30';

    // Get start time to end time different
    $startTimeStr = strtotime( $startTime );
    $endTimeStr   = strtotime( $endTime );
    $deff         = $endTimeStr - $startTimeStr;
    $totalHour    = date( 'h', $deff );


    $loopTime = $totalHour * 2;
 
    //
    $addMinutes  = 0;
    $newTime     = '';

    //
    for( $i = 0; $i <= $loopTime; $i++  ) {

      if( !empty( $newTime ) ) {
        $addMinutes = $MinutesDeff;
        $startTime = $newTime;
      }

      $t = strtotime( '+'.$addMinutes.' minutes',strtotime( $startTime ) );

      $newTime = date( $timeFormat, $t );

      $times[] = $newTime;

      /*if( $endTimeStr == $t || $t > $endTimeStr) {
        break;
      }*/
  
    }

    return $times;

  }


  /**
   * todayDate 
   * @return string
   */
  public static function todayDate() {
    $date = self::getDateTime();
    return $date->format('d-m-Y');
  }

  /**
   * nowTime
   * @return string
   */
  public static function nowTime() {
    $date = self::getDateTime();
    return $date->format('h:i:sa');
  }

  /**
   * [getTodayDateWithDay description]
   * @return array
   */
  public static function getTodayDateWithDay() {

    $date = self::todayDate();
    $day = self::getDay($date);

    return [ ['day' => $day, 'date' => $date] ];
  }

  /**
   * getDay 
   * @return string
   */
  public static function getDay( $date ) {

    // date format should be 04-11-2020
    $sepparator = '-';
    $parts = explode( $sepparator, $date);

    return date("l", mktime(0, 0, 0, $parts[1], $parts[0], $parts[2]));

  }

  /**
   * [getNaxtDaysDateList description]
   * @return array
   */
  public static function getNaxtDaysDateList() {

    $options = get_option('foodbooklite_options');

    $days = !empty( $options['date-days-limit'] ) ? $options['date-days-limit'] : '' ;
    $i = 1;
    $date = self::getTodayDateWithDay();

    for( $i; $i <= $days; $i++  ) {

      $getDate = self::naxtDaysDateListMaping( $i );

      $day = self::getDay( $getDate );

      $date [] = [
        'day'   => $day, 
        'date' => $getDate
      ];

    }

    return $date;

  }

  /**
   * [naxtDaysDateListMaping description]
   * @param  integer $nextDays [description]
   * @return array
   */
  public static function naxtDaysDateListMaping( $nextDays = 6 ) {

    $date = self::getDateTime();
    $date->add(new \DateInterval('P'.$nextDays.'D'));
    return $date->format('d-m-Y');

  }


}
