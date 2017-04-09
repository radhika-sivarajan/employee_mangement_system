<?php
ob_start();
include_once("config.php");
doCSS();
global $link;
checkLoggedIn("yes");
$empid = $_GET['emp_id'];
$query="DELETE FROM ext_employee_details WHERE employee_id='$empid'";
$result=mysql_query($query, $link) or die("Died deleting from extended employee details info into db.  Error returned if any: ".mysql_error());

$query1="DELETE FROM users WHERE id='$empid'";
$result1=mysql_query($query1, $link) or die("Died deleting from users info into db.  Error returned if any: ".mysql_error());

header("Location: editemp.php");
ob_end_flush(); 
?>