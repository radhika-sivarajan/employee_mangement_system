<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
$query="SELECT DISTINCT leave_type, description FROM leave_ref_table";
$result=mysql_query($query, $link) or die("Died inserting leave ref table info into db.  Error returned if any: ".mysql_error());
?>
<html>
<head>
<title>Leave Apply</title>
<style type="text/css">
<!--
.style1 {
	color: #FF3333;
	font-size: 24px;
	font-weight: bold;
}
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
-->
</style>
<script language="javascript" src="calendar/calendar.js">
</script>
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
    <td width="200"><a href="leavehome.php"><strong>Leave information</strong></a></td>
    <td width="382"><div align="center"><strong><span class="style3">Apply for leave </span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <th><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	  <table width="473" border="1">
		<tr>
			<th width="188" scope="row"><div align="left">Leave Type</div></th>
			<td width="275"><?php
			echo "<select name=leavetype value=''><option value=''>Enter Leave type</option>";
			while($nt=mysql_fetch_array($result)){
				echo "<option value=$nt[leave_type]>$nt[description]</option>";
			}
			echo "</select>";
			?></td>
		</tr>
	<tr>
    <th scope="row"><div align="left">Date From</div></th>
    <td><?php
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
   ?></td>
  </tr>
  <tr>
    <th scope="row"><div align="left">Date To</div></th>
    <td><?php
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
   	?></td>
  </tr>
  <tr>
    <th scope="row"><div align="left">Leave Reason</div></th>
    <td><textarea name="leavereason" cols="40" rows="5" wrap="physical"></textarea></td>
  </tr>
 </table>
  <p>
    <input name="submit" type="submit" value="Submit"/>
    <input name="" type="reset" />
    </p>
    </form>	
	<?php
	doCSS();
	$emp_id = $_SESSION["employeeid"];
	//on submit
	if(isset($_POST["submit"])){
		$leavetype = $_POST['leavetype'];
		$date_from = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
		$date_to = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : ""; 
		$reason = $_POST["leavereason"];
			$query1="SELECT * FROM leave_ref_table WHERE leave_type='$leavetype'";
			$result1=mysql_query($query1, $link) or die("Died inserting leave reference table info into db.  Error returned if any: ".mysql_error());
			$nt1=mysql_fetch_array($result1);
			$max = $nt1[max_no_leaves];
			
			$curr_year = date('Y');
			$query2 = "SELECT * FROM leave_summary WHERE employee_id='$emp_id' AND year='$curr_year'";
			$result2 = mysql_query($query2, $link) or die("Error in inserting leave summary info into db.  Error returned if any: ".mysql_error());
			$nt2=mysql_fetch_array($result2);
			$taken = $nt2[$leavetype];
			
			$balance = $max - $taken;
			
			$curr_date = date('Y-m-d');
			$d1 = strtotime($curr_date);
			$d2 = strtotime($date_from);
			$d3 = strtotime($date_to);
			if($d1<=$d2){
				if($d2 <= $d3){
					$delta = $d3 - $d2;
					if($d2 == $d3)
						$tot_days = (($delta/86400)+1);
					else
						$tot_days = (($delta/86400));
					$sun_sat = getAllSatSun($date_from,$date_to);
					$num_days = $tot_days - $sun_sat;
					
					if($num_days > $balance){
						echo "<font color=\"#0101DF\" face='georgia'><i>Sorry !! you don't have enough leave</i></font>";
					}
					else{
						//echo "<font color=\"#0101DF\" face='georgia'><i>$leavetype leave from $date_from to $date_to was entered  $num_days</i></font>";
						applyLeave($emp_id, $leavetype, $date_from, $date_to, $reason);
						header("Location: leavehome.php");
						ob_end_flush();
					}	
				}
				else{
					echo "<font color=\"#0101DF\" face='georgia'><i>Enter a valid to date</i></font>";
				}	
			}
			else{
				echo "<font color=\"#0101DF\" face='georgia'><i>Enter a valid from date</i></font>";
			}
		
	}

  ?><p>&nbsp;</p>
	</th>
  </tr>
</table>
</body>
</html>