

<?php 
// will echo all saturdays found between date range. 
function getAllSaturdays($from_date, $to_date){ 
    // getting number of days between two date range. 
    $number_of_days = count_days(strtotime($from_date),strtotime($to_date)); 
    
    for($i = 1; $i<=$number_of_days; $i++){ 
        $day = Date('l',mktime(0,0,0,date('m'),date('d')+$i,date('y'))); 
        if($day == 'Saturday'){ 
            echo Date('d-m-Y',mktime(0,0,0,date('m'),date('d')+$i,date('y'))),'<br/>'; 
        } 
    } 
} 
// Will return the number of days between the two dates passed in 
function count_days( $a, $b ) 
{ 
    // First we need to break these dates into their constituent parts: 
    $gd_a = getdate( $a ); 
    $gd_b = getdate( $b ); 
    // Now recreate these timestamps, based upon noon on each day 
    // The specific time doesn't matter but it must be the same each day 
    $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] ); 
    $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] ); 
    // Subtract these two numbers and divide by the number of seconds in a 
    // day. Round the result since crossing over a daylight savings time 
    // barrier will cause this time to be off by an hour or two. 
    return round( abs( $a_new - $b_new ) / 86400 ); 
} 
$from_date = Date('d-m-Y'); // todays date 
$to_date = Date('d-m-Y',mktime(0,0,0,date('m'),date('d'),date('y')+1)); // date with one year difference i.e. same date of next year 

getAllSaturdays($from_date,$to_date); 
?>