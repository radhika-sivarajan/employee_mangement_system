<?php
ob_start();
include_once("config.php");

// Check user logged in already:
checkLoggedIn("yes");

// Log user out:
flushMemberSession();

// Redirect:
header("Location: login.php");
ob_end_flush();
?>