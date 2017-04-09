<?php
//ob_start();
include_once("config.php");
doCSS();
global $link;
$app_id = $_GET['app_id'];
$query = "UPDATE leave_application_table SET approval_status='cancelled' WHERE appln_id='$app_id'";
$result=mysql_query($query, $link) or die("Error in accepting leave request. Error returned if any: ".mysql_error());
echo 'cancelled';		
//header("Location: leavecancel.php");
//ob_end_flush();
?>