<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
if(isset($_POST["submit"])){
	// Info has been submitted, check it:
	// Check login, password and password2 are not empty:
	# field_validator($field_descr, $field_data, $field_type, $min_length="", $max_length="", $field_required=1) {
	field_validator("Login name", $_POST["login"], "alphanumeric", 4, 15);
	field_validator("Password", $_POST["password"], "string", 4, 15);
	field_validator("Confirmation password", $_POST["password2"], "string", 4, 15);
	field_validator("Employee id", $_POST["id"], "alphanumeric", 6, 10);
	field_validator("First name", $_POST["fName"], "string", 1, 50);
	field_validator("Gender", $_POST["gender"], "string", 4, 50);
	field_validator("Marital status", $_POST["marital_stat"], "string", 5, 50);
	//field_validator("curr_add", $_POST["curr_add"], "alphanumeric", 2, 50);
	field_validator("Permanent address", $_POST["perm_add"], "alphanumeric", 2, 50);
	field_validator("Phone", $_POST["phone"], "alphanumeric", 5, 50);
	field_validator("E-mail", $_POST["email"], "email", 5, 50);

	// Check that password and password2 match:
	if(strcmp($_POST["password"], $_POST["password2"])) {
		$messages[]="Your passwords did not match";
	}

	// build query:
	$query="SELECT login FROM users WHERE login='".$_POST["login"]."'";

	// Run query:
	$result=mysql_query($query, $link) or die("MySQL query $query failed.  Error if any: ".mysql_error());

	// If a row exists with that username, issue an error message:
	if( ($row=mysql_fetch_array($result)) ){
		$messages[]="Login ID \"".$_POST["login"]."\" already exists.  Try another.";
	}

	if(empty($messages)) {
			// registration ok, get user id and update db with new info:
			$id=$_POST['id'];
			$login=$_POST['login'];
			$password=$_POST['password'];
			$firstName=$_POST['fName'];
			$lastName=$_POST['lName'];
			$middleName=$_POST['mName'];
			$gender=$_POST['gender']; 
			$dob = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
			$marital_stat=$_POST['marital_stat'];
			$curr_add=$_POST['curr_add'];
			$perm_add=$_POST['perm_add'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$join_date = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
			$service = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
			$department=$_POST['department'];
			$designation=$_POST['designation'];
			$pf_no=$_POST['pf_no'];
			$edu_quali=$_POST['edu_quali'];
			$specialization=$_POST['specialization'];
			$past_experience=$_POST['past_experience'];
			newUser($id, $login, $password,$firstName,$lastName,$middleName,$gender,$dob,$marital_stat,$curr_add,$perm_add,$phone, $join_date, $service, $department, $designation, $pf_no, $edu_quali, $specialization, $past_experience, $email);
			
			// and then redirect them to the members page:
			header("Location: home.php");

	}
}

ob_end_flush();
?>
<html>
<head>
<title>Add User</title>
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
-->
</style>
<script language="javascript" src="calendar/calendar.js"></script>
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
    <td width="150"><a href="manageuser.php"><strong>Manage user</strong></a></td>
    <td width="482"><div align="center"><strong><span class="style3">Add a new user </span></strong></div></td>
    <td width="250"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <td><p><form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
<div class="style1">
        <center><?php
//Check if $message is set, and output it if it is:
if(!empty($messages)){
	displayErrors($messages);
}
?></center></div>
  <p align="center" class="style2">Login information</p>
  <table border="0" width="350"  align="center">
<tr><td width="170">Login</td>
<td width="170">: 
  <input type="text" name="login" value="<?php print isset($_POST["login"]) ? $_POST["login"] : "" ; ?>"maxlength="15"></td></tr>
<tr><td>Password</td><td>: <input type="password" name="password" value="" maxlength="15"></td></tr>
<tr><td>Confirm password</td><td>: <input type="password" name="password2" value="" maxlength="15"></td></tr>
<tr><td>Employee ID</td><td>: <input type="text" name="id" value="" maxlength="10"></td></tr>
</table>
  <p align="center" class="style2">Personal information</p>
  <table border="0" width="360" align="center">
 <tr><td width="179">First Name</td>
 <td width="161">: 
   <input type="text" name="fName" value="" maxlength="40"></td></tr>
<tr><td>Last Name</td><td>: <input type="text" name="lName" value="" maxlength="40"></td></tr>
<tr><td>Middle Name</td><td>: <input type="text" name="mName" value="" maxlength="40"></td></tr>
<tr><td>Gender</td><td>: <select name="gender">
  <option value ="male">Male</option>
  <option value ="female">Female</option></select></td></tr>
<tr><td>Date of birth</td><td>
<?php
require_once('calendar/classes/tc_calendar.php');
$myCalendar = new tc_calendar("date1", true, false);
   $myCalendar->setIcon("calendar/images/iconCalendar.gif");
   $myCalendar->setDate(date('d'), date('m'), date('Y'));
   $myCalendar->setPath("calendar/");
   $myCalendar->setYearInterval(1950, 2015);
   $myCalendar->dateAllow('1950-01-01', '2015-03-01');
   $myCalendar->setDateFormat('j F Y');
   $myCalendar->setAlignment('left', 'bottom');
   $myCalendar->writeScript();
   
?>
</td></tr>
<tr><td>Marital status</td><td>: <select name="marital_stat">
  <option value ="single">Single</option>
  <option value ="married">Married</option></select></td></tr>
<tr><td>Current address</td><td>: <input type="text area" name="curr_add" value="" maxlength="100"></td></tr>
<tr><td>Permanent address</td><td>: <input type="text area" name="perm_add" value="" maxlength="100"></td></tr>
<tr><td>Phone number</td><td>: <input type="text" name="phone" value="" maxlength="15"></td></tr>
<tr><td>E-mail</td><td>: <input type="text" name="email" value="" maxlength="50"></td></tr>
</table>
  <p align="center"><span class="style2">Official information</span></p>
  <table border="0" width="360" align="center">
<tr><td>Join date</td><td>
<?php
require_once('calendar/classes/tc_calendar.php');
$myCalendar = new tc_calendar("date2", true, false);
   $myCalendar->setIcon("calendar/images/iconCalendar.gif");
   $myCalendar->setDate(date('d'), date('m'), date('Y'));
   $myCalendar->setPath("calendar/");
   $myCalendar->setYearInterval(1950, 2015);
   $myCalendar->dateAllow('1950-01-01', '2015-03-01');
   $myCalendar->setDateFormat('j F Y');
   $myCalendar->setAlignment('left', 'bottom');
   $myCalendar->writeScript();
   
?></td></tr>
<tr><td>Service entry</td><td>
<?php
require_once('calendar/classes/tc_calendar.php');
$myCalendar = new tc_calendar("date3", true, false);
   $myCalendar->setIcon("calendar/images/iconCalendar.gif");
   $myCalendar->setDate(date('d'), date('m'), date('Y'));
   $myCalendar->setPath("calendar/");
   $myCalendar->setYearInterval(1950, 2015);
   $myCalendar->dateAllow('1950-01-01', '2015-03-01');
   $myCalendar->setDateFormat('j F Y');
   $myCalendar->setAlignment('left', 'bottom');
   $myCalendar->writeScript();
   
?></td></tr>
<tr><td>Department</td><td>: <select name="department">
  <option value ="cse">Computer Science</option>
  <option value ="eee">Electrical</option>
  <option value ="ece">Electronics</option>
  <option value ="it">Information Technology</option>
  <option value ="ge">General Engineering</option>
  <option value ="office">Office</option></select></td></tr>
<tr><td>Designation</td><td>: <select name="designation">
<option value ="assistant proffessor">Assistant proffessor</option>
<option value ="lecturer">Lecturer</option>
<option value ="computer programmer">Computer programmer</option>
<option value ="instructor grade II">Instructor grade II</option>
<option value ="trade instructor grade II">Trade instructor grade II</option>
<option value ="tradesman">Tradesman</option>
<option value ="account officer">Account officer</option>
<option value ="senior supdt">Senior supdt</option>
<option value ="junior supdt">Junior supdt</option>
<option value ="confidential assistant">Confidential assistant</option>
<option value ="LDC">LDC</option>
<option value ="librarian">Librarian</option>
<option value ="driver">Driver</option>
<option value ="peon">Peon</option>
<option value ="watch man">Watch man</option>
<option value ="sweeper">Sweeper</option></select></td></tr>
<tr><td>PF number</td><td>: <input type="text" name="pf_no" value="" maxlength="15"></td></tr>
<tr><td>Educational qualification</td><td>: <input type="text area" name="edu_quali" value="" maxlength="100"></td></tr>
<tr><td>Specialization</td><td>: <input type="text area" name="specialization" value="" maxlength="100"></td></tr>
<tr><td>Past experiece</td><td>: <input type="text area" name="past_experience" value="" maxlength="100"></td></tr>
<tr><td></td><td><div align="left"><input name="submit" type="submit" value="Submit"></div></td></tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>