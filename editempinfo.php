<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
$empid=$_GET['emp_id'];
$query1="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
$result1=mysql_query($query1, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
$nt=mysql_fetch_array($result1);
?>
<html>
<head>
<title>Edit employee information</title>
<style type="text/css">
<!--
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
    <td width="130"><a href="manageuser.php"><strong>Manage user</strong></a></td>
	<td width="150"><<<a href="editemp.php"><strong>Back</strong></a></td>
    <td width="250"><div align="center"><strong><span class="style2">Edit employee information</span></strong></div></td>
    <td width="350"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg">
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	<table border="0" align="center">
	<tr><td>&nbsp;</td><td><input type="hidden" name="empid" value="<?php  echo "$empid"; ?>"></td></tr>
	<tr><td>Middle Name</td><td>: <input type="text" name="mName" value="<?php  echo "$nt[middleName]"; ?>" maxlength="40"></td></tr>
	<tr><td>Last Name</td><td>: <input type="text" name="lName" value="<?php echo "$nt[lastName]";?>" maxlength="40"></td></tr>
	<tr><td>Marital status</td><td>: <select name="mStat">
		<option value ="<?php echo "$nt[marital_stat]"; ?>"></option>
		<option value ="married">Married</option>
		<option value ="single">Single</option></select></td></tr>
	<tr><td>Current address</td><td>: <input type="text area" name="cAdd" value="<?php echo "$nt[curr_add]";?>" maxlength="100"></td></tr>
	<tr><td>Permanent address</td><td>: <input type="text area" name="pAdd" value="<?php echo "$nt[perm_add]";?>" maxlength="100"></td></tr>
	<tr><td>Phone number</td><td>: <input type="text" name="phone" value="<?php echo "$nt[phone]";?>" maxlength="40"></td></tr>
	<tr><td>E mail id</td><td>: <input type="text" name="email" value="<?php echo "$nt[email]";?>" maxlength="40"><br> 
	  <span class="style3"> example@xmail.com</span></td></tr>
	<tr><td>Department</td><td>: <input type="text" name="department" value="<?php echo "$nt[department]";?>" maxlength="100"></td></tr>
	<tr><td>Designation</td><td>: <input type="text" name="designation" value="<?php echo "$nt[designation]";?>" maxlength="100"></td></tr>
	<tr><td>Eductional qulification</td><td>: <input type="text" name="edu_quali" value="<?php echo "$nt[edu_quali]";?>" maxlength="100"></td></tr>
	<tr><td>Specialization</td><td>: <input type="text" name="special" value="<?php echo "$nt[specialization]";?>" maxlength="100"></td></tr>
	<tr><td><div align="right"><input name="submit" type="submit" value="Save"></div></td><td><input name="" type="reset" /></td></tr>
	</table>
</form>
<?php
if(isset($_POST["submit"])){
	$emid=$_POST['empid'];
	$mName=$_POST['mName'];
	$lName=$_POST['lName'];
	$mStat=$_POST['mStat'];
	$cAdd=$_POST['cAdd'];
	$pAdd=$_POST['pAdd'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$query="UPDATE ext_employee_details SET middleName='$mName', lastName='$lName', marital_stat='$mStat', curr_add='$cAdd', perm_add='$pAdd', phone='$phone', email='$email' WHERE employee_id='$emid'";
	$result=mysql_query($query, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
	header("Location: editemp.php");
	ob_end_flush();
}
?>
    </th>
  </tr>
</table>	  