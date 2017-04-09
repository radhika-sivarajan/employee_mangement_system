<?php

function connectToDB() {
	global $link, $dbhost, $dbuser, $dbpass, $dbname;

	($link = mysql_pconnect("$dbhost", "$dbuser", "$dbpass")) || die("Couldn't connect to MySQL");

	 mysql_select_db("$dbname", $link) || die("Couldn't open db: $dbname. Error if any was: ".mysql_error() );
}

function newUser($id, $login, $password, $firstName, $lastName, $middleName, $gender, $dob, $marital_stat, $curr_add, $perm_add, $phone, $join_date, $service, $department, $designation, $pf_no, $edu_quali, $specialization, $past_experience, $email) {
	
	global $link;
	$curr_year = date('Y');
	$query="INSERT INTO users (id, login, password) VALUES('$id','$login','$password')";
	$query1="INSERT INTO ext_employee_details (employee_id, firstName, lastName, middleName, gender, dob, marital_stat, curr_add, perm_add, phone, join_date,  service_entry, department, designation, pf_no, edu_quali, specialization, past_experience, email) VALUES('$id', '$firstName', '$lastName', '$middleName', '$gender', '$dob', '$marital_stat', '$curr_add', '$perm_add', '$phone', '$join_date', '$service', '$department', '$designation', '$pf_no', '$edu_quali', '$specialization', '$past_experience', '$email')";
	$query2="INSERT INTO leave_summary (year, employee_id) VALUES('$curr_year', '$id')";
	$result=mysql_query($query, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
	$result1=mysql_query($query1, $link) or die("Died inserting extented employee details into db. Error returned if any: ".mysql_error());
	$result2=mysql_query($query2, $link) or die("Died inserting leave summary into db. Error returned if any: ".mysql_error());
	return true;
}

function getAllSatSun($from_date, $to_date){ 
    // getting number of days between two date range. 
    $number_of_days = count_days(strtotime($from_date),strtotime($to_date)); 
    $j = 0;
    for($i = 1; $i<=$number_of_days; $i++){ 
        $day = Date('l',mktime(0,0,0,date('m'),date('d')+$i,date('y'))); 
        if($day == 'Saturday' || $day == 'Sunday'){ 
            //echo Date('d-m-Y',mktime(0,0,0,date('m'),date('d')+$i,date('y'))),'<br/>';
			$j = $j + 1;
        }
    } 
	return $j;
} 
// Will return the number of days between the two dates passed in 
function count_days( $a, $b ) 
{ 
    // First we need to break these dates into their constituent parts: 
    $gd_a = getdate( $a ); 
    $gd_b = getdate( $b ); 
    // Now recreate these timestamps, based upon noon on each day 
    // The specific time doesn't matter but it must be the same each day 
    $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] ); 
    $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] ); 
    // Subtract these two numbers and divide by the num1ber of seconds in a 
    // day. Round the result since crossing over a daylight savings time 
    // barrier will cause this time to be off by an hour or two. 
    return round( abs( $a_new - $b_new ) / 86400 ); 
}

function displayErrors($messages) {
	
	print("<b>ERROR !</b>\n<ul>\n");

	foreach($messages as $msg){
		print("<li>$msg</li>\n");
	}
	print("</ul>\n");
}

function checkLoggedIn($status){
	
	switch($status){
		// if yes, check user is logged in:
		case "yes":
			if(!isset($_SESSION["loggedIn"])){
				header("Location: login.php");
				exit;
			}
			break;

		// if no, check NOT logged in:
		// ie for actions where user can't already be logged in
		// (ie for joining up or logging in)
		case "no":
			if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true ){
				header("Location: home.php");
			}
			break;
	}
	return true;
}

function checkPass($login, $password) {
	
	global $link;

	$query="SELECT login, password FROM users WHERE login='$login' and password='$password'";
	$result=mysql_query($query, $link)
		or die("checkPass fatal error: ".mysql_error());

	// Check exactly one row is found:
	if(mysql_num_rows($result)==1) {
		$row=mysql_fetch_array($result);
		return $row;
	}
	//Bad Login:
	return false;
} // end func checkPass($login, $password)

function cleanMemberSession($login, $password) {
	
	$_SESSION["login"]=$login;
	$_SESSION["password"]=$password;
	$_SESSION["loggedIn"]=true;
	
	global $link;
	$query="select administrator from users where login='$login'";
	$result=mysql_query($query, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
	$administrator=mysql_result($result, 0);
	$_SESSION["administrator"]=$administrator;
	$query1="select id from users where login='$login'";
	$result=mysql_query($query1, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
	$employeeid=mysql_result($result, 0);
	$_SESSION["employeeid"]=$employeeid;
} // end func cleanMemberSession($login, $pass)

function flushMemberSession() {
	/*
	Member session destruction function:
	This function unsets all the session variables initialized
	above and then destroys the current session.
	*/
	// use unset to destroy the session variables
	unset($_SESSION["login"]);
	unset($_SESSION["password"]);
	unset($_SESSION["loggedIn"]);
	unset($_SESSION["administrator"]);
	unset($_SESSION["employeeid"]);
	// and use session_destroy to destroy all data associated
	// with current session:
	session_destroy();

	return true;
} 

function applyLeave($employee_id, $leave_type, $date_from, $date_to, $reason){
	$curr_date = date('Y-m-d');
	global $link;
	$query2="INSERT INTO leave_application_table (employee_id, leave_type, date_from, date_to, date_applied, reason) VALUES('$employee_id','$leave_type', '$date_from', '$date_to', '$curr_date', '$reason')";
	$result2=mysql_query($query2, $link) or die("Error in inserting leave apply info into db.  Error returned if any: ".mysql_error());
	header("Location: home.php");
}

function updateLeaveSummary($emp_id, $leavetype, $num_days){
	global $link;
	echo "hello";
	if($leavetype == casual){
		$query3="UPDATE leave_summary SET casual= casual +'$num_days' WHERE employee_id='$emp_id'";
		$result3=mysql_query($query3, $link) or die("Died inserting leave summary into db.  Error returned if any: ".mysql_error());
	}
	elseif($leavetype == medical){
		$query4="UPDATE leave_summary SET medical= medical +'$num_days' WHERE employee_id='$emp_id'";
		$result4=mysql_query($query4, $link) or die("Died inserting leave summary into db.  Error returned if any: ".mysql_error());
	}
	elseif($leavetype == paternity){
		$query5="UPDATE leave_summary SET paternity= paternity +'$num_days' WHERE employee_id='$emp_id'";
		$result5=mysql_query($query5, $link) or die("Died inserting leave summary into db.  Error returned if any: ".mysql_error());
	}
	elseif($leavetype == maternity){
		$query6="UPDATE leave_summary SET maternity= maternity +'$num_days' WHERE employee_id='$emp_id'";
		$result6=mysql_query($query6, $link) or die("Died inserting leave summary into db.  Error returned if any: ".mysql_error());
	}
	elseif($leavetype == paid_vacation){
		$query7="UPDATE leave_summary SET paid_vacation= paid_vacation +'$num_days' WHERE employee_id='$emp_id'";
		$result7=mysql_query($query7, $link) or die("Died inserting leave summary into db.  Error returned if any: ".mysql_error());
	}
	elseif($leavetype == without_pay){
		$query8="UPDATE leave_summary SET without_pay= without_pay +'$num_days' WHERE employee_id='$emp_id'";
		$result8=mysql_query($query8, $link) or die("Died inserting leave summary into db.  Error returned if any: ".mysql_error());
	}
}

function doCSS() {
	?>
<style type="text/css">
body{font-family: Arial, Helvetica; font-size: 10pt}
h1{font-size: 12pt}
</style>
	<?php
} // end func doCSS()

# function validates HTML form field data passed to it:
function field_validator($field_descr, $field_data, $field_type, $min_length="", $max_length="",  $field_required=1) {
	
	# array for storing error messages
	global $messages;

	# first, if no data and field is not required, just return now:
	if(!$field_data && !$field_required){ return; }

	# initialize a flag variable - used to flag whether data is valid or not
	$field_ok=false;

	# this is the regexp for email validation:
	$email_regexp="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|";
	$email_regexp.="(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$";

	# a hash array of "types of data" pointing to "regexps" used to validate the data:
	$data_types=array(
		"email"=>$email_regexp,
		"digit"=>"^[0-9]$",
		"number"=>"^[0-9]+$",
		"alpha"=>"^[a-zA-Z]+$",
		"alpha_space"=>"^[a-zA-Z ]+$",
		"alphanumeric"=>"^[a-zA-Z0-9]+$",
		"alphanumeric_space"=>"^[a-zA-Z0-9 ]+$",
		"string"=>""
	);

	# check for required fields
	if ($field_required && empty($field_data)) {
		$messages[] = "$field_descr is a required field.";
		return;
	}

	# if field type is a string, no need to check regexp:
	if ($field_type == "string") {
		$field_ok = true;
	} else {
		# Check the field data against the regexp pattern:
		$field_ok = ereg($data_types[$field_type], $field_data);
	}

	# if field data is bad, add message:
	if (!$field_ok) {
		$messages[] = "Please enter a valid $field_descr.";
		return;
	}

	# field data min length checking:
	if ($field_ok && ($min_length > 0)) {
		if (strlen($field_data) < $min_length) {
			$messages[] = "$field_descr is invalid, it should be at least $min_length character(s).";
			return;
		}
	}

	# field data max length checking:
	if ($field_ok && ($max_length > 0)) {
		if (strlen($field_data) > $max_length) {
			$messages[] = "$field_descr is invalid, it should be less than $max_length characters.";
			return;
		}
	}
}
?>
