<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
if(isset($_POST["submit"])){
	// Check login, password and password2 are not empty:
	# field_validator($field_descr, $field_data, $field_type, $min_length="", $max_length="", $field_required=1) {
	field_validator("password", $_POST["password"], "string", 4, 15);
	field_validator("confirmation password", $_POST["password2"], "string", 4, 15);
	// Check that password and password2 match:
	if(strcmp($_POST["password"], $_POST["password2"])) {
		$messages[]="New password and conformation password did not match";
	}

	if(empty($messages)) {
			$empid=$_SESSION["employeeid"];
			$password=$_POST['password'];
			$query2="UPDATE users SET password='$password' WHERE id='$empid'";
			$result2=mysql_query($query2, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
			header("Location: myinfo.php");		
	}
}
ob_end_flush();
?>
<html>
<head>
<title>Password change</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php doCSS(); ?>
<style type="text/css">
<!--
.style1 {font-size: 15px; font-style: italic; color: 'purple'; }
.style2 {font-size: 24px; font-weight: bold; color: #FF3333; }
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
.style4 {
	font-style: italic;
	font-family: "Monotype Corsiva";
}
-->
</style>
</head>
<body background="Diagrams/bg.gif">
<table width="1000" border="0" align="center">
  <tr>
    <td><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="100"><a href="home.php"><strong>Home</strong></a></td>
    <td width="200"><a href="myinfo.php"><strong>My information</strong></a></td>
	<td width="382"><div align="center"><strong><span class="style3">Change password</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr><th scope="row"><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center><p></th></tr>
	<tr><td><center><span class="style4">Minimun 4 charactors Maximum 15 charactors</span></center></td></tr>
    <tr><td><form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	<table border="0" align="center">
	<tr><td>Enter new password</td><td>: <input type="password" name="password" value="" maxlength="15"></td></tr>
	<tr><td>Confirm password</td><td>: <input type="password" name="password2" value="" maxlength="15"></td></tr>
	<tr><td></td><td><div align="left"><input name="submit" type="submit" value="Submit"></div></td></tr>
	</table>
	</form>
       <div class="style1">
        <center><?php
//Check if $message is set, and output it if it is:
if(!empty($messages)){
	displayErrors($messages);
}
?></center></div><p></td>
  </tr> 
</table>
</body>
</html>