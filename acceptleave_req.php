<?php
ob_start();
include_once("config.php");
doCSS();
global $link;
$app_id = $_GET['app_id'];
$query = "UPDATE leave_application_table SET approval_status='approved' WHERE appln_id='$app_id'";
$result=mysql_query($query, $link) or die("Error in accepting leave request. Error returned if any: ".mysql_error());

$query1 = "SELECT * FROM leave_application_table WHERE appln_id='$app_id'";
$result1 = mysql_query($query1, $link) or die("Error in selectin leave application info into db.  Error returned if any: ".mysql_error());
$nt1=mysql_fetch_array($result1);
$leavetype = $nt1[leave_type];
$emp_id = $nt1[employee_id];
$date_from = $nt1[date_from];
$date_to = $nt1[date_to];

$d1 = strtotime($date_from);
$d2 = strtotime($date_to);
$delta = $d2 - $d1;
if($d1 == $d2)
	$tot_days = (($delta/86400)+1);
else
	$tot_days = (($delta/86400));
$sun_sat = getAllSatSun($date_from,$date_to);
$num_days = $tot_days - $sun_sat;

//echo "$app_id <br>$leavetype <br>$emp_id <br>$date_from <br>$date_to<br> $num_days";

updateLeaveSummary($emp_id, $leavetype, $num_days);
		
header("Location: leave_sanction.php");
ob_end_flush();
?>