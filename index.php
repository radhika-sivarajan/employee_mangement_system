<?php
ob_start();
include_once("config.php");

// page title:
$title="Employee Management System";
?>
<html>
<head>
<title><?php print $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php doCSS(); ?>
</head>
<body>
<h1><?php print $title; ?></h1>
<?php
   header( 'Location: login.php' ) ;
?>
</body>
</html>
<?php>
ob_end_flush();
?>