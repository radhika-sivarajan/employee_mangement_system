<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
$empid=$_SESSION["employeeid"];
$query1="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
$result1=mysql_query($query1, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
$nt=mysql_fetch_array($result1);
if(isset($_POST["submit"])){
	field_validator("E-mail", $_POST["email"], "email", 5, 60);
	field_validator("Phone number", $_POST["phone"], "number", 5, 60);
	field_validator("Permanent address", $_POST["pAdd"], "alphanumeric", 5, 60);
	if(empty($messages)) {
		$empid=$_SESSION["employeeid"];
		$mName=$_POST['mName'];
		$lName=$_POST['lName'];
		$mStat=$_POST['mStat'];
		$cAdd=$_POST['cAdd'];
		$pAdd=$_POST['pAdd'];
		$phone=$_POST['phone'];
		$pf=$_POST['pf'];
		$special=$_POST['special'];
		$past=$_POST['past'];
		$email=$_POST['email'];
		$query="UPDATE ext_employee_details SET middleName='$mName', lastName='$lName', marital_stat='$mStat', curr_add='$cAdd', perm_add='$pAdd', phone='$phone', specialization='$special', past_experience='$past', email='$email' WHERE employee_id='$empid'";
		$result=mysql_query($query, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
		header("Location: userdetails.php");
	}
}
ob_end_flush();
?>
<html>
<head>
<title>User Details</title>
<style type="text/css">
<!--
.style1 {font-size: 15px; font-style: italic; color: 'purple'; }
.style2 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
.style3 {
	font-family: "Times New Roman", Times, serif;
	font-style: italic;
	font-size: 14px;
}
-->
</style>
</head>
<body background="Diagrams/bg.gif">
<table width="1000" border="0" align="center">
  <tr>
    <td width="1207"><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="100"><a href="home.php"><strong>Home</strong></a></td>
    <td width="200"><a href="userdetails.php"><strong>Basic information</strong></a></td>
    <td width="382"><div align="center"><strong><span class="style2">Edit  informations </span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg">
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	<table border="0" align="center">
	<tr><td>Middle Name</td><td>: <input type="text" name="mName" value="<?php  echo "$nt[middleName]"; ?>" maxlength="40"></td></tr>
	<tr><td>Last Name</td><td>: <input type="text" name="lName" value="<?php echo "$nt[lastName]";?>" maxlength="40"></td></tr>
	<tr><td>Marital status</td><td>: <select name="mStat">
		<option value ="<?php echo "$nt[marital_stat]"; ?>"></option>
		<option value ="married">Married</option>
		<option value ="single">Single</option></select></td></tr>
	<tr><td>Current address</td><td>: <input type="text area" name="cAdd" value="<?php echo "$nt[curr_add]";?>" maxlength="100"></td></tr>
	<tr><td>Permanent address</td><td>: <input type="text area" name="pAdd" value="<?php echo "$nt[perm_add]";?>" maxlength="100"></td></tr>
	<tr><td>Specialization</td><td>: <input type="text" name="special" value="<?php echo "$nt[specialization]";?>" maxlength="200"></td></tr>
	<tr><td>Past experience</td><td>: <input type="text" name="past" value="<?php echo "$nt[past_experience]";?>" maxlength="200"></td></tr>
	<tr><td>Phone number</td><td>: <input type="text" name="phone" value="<?php echo "$nt[phone]";?>" maxlength="40"></td></tr>
	<tr><td>E mail id</td><td>: <input type="text" name="email" value="<?php echo "$nt[email]";?>" maxlength="40"><br> 
	  <span class="style3"> example@xmail.com</span></td>
	</tr>
	<tr><td><div align="right"><input name="submit" type="submit" value="Save"></div></td><td><input name="" type="reset" /></td></tr>
	</table>
</form><div class="style1">
        <center><?php
//Check if $message is set, and output it if it is:
if(!empty($messages)){
	displayErrors($messages);
}
?></center></div><p></th>
  </tr>
 </table>	  