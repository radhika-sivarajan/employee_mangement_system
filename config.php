<?php

error_reporting(0);

include_once("functions.php");

session_register("login");
session_register("password");
session_register("loggedIn");
session_register("administrator");
session_register("employeeid");
$messages=array();

$dbhost="localhost";
$dbuser="emsuser";
$dbpass="emspassword";
$dbname="ems";

connectToDB();
?>