<?php 
namespace App\Helpers;
use DateTime;
class Helper
{

public static function getDay($date,$type){

    if($type=='name'){
    $timestamp = strtotime($date);
    $day = date('D', $timestamp);
    return $day;
    }
    elseif($type=='date'){
        $string = $date;
        $date = new DateTime($string);
        return date_format($date, 'd');
    }
    elseif($type=='month'){
        $timestamp = strtotime($date);
    $day = date('M', $timestamp);
    return $day;
    }
    elseif($type=='year'){
        $timestamp = strtotime($date);
    $day = date('y', $timestamp);

    $OldDate = $date;
       $OldYear = date('Y',strtotime($OldDate));
    
    return $OldYear;
    }
}

public static function dateDifference($start,$end){
	
$start = strtotime($start);
$end = strtotime($end);
$datediff = $end - $start;

return round($datediff / (60 * 60 * 24));

}
}
?>