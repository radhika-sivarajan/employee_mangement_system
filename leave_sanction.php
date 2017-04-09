<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Leave Sanction</title>
<style type="text/css">
<!--
.style1 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF00FF;
}
-->
</style>
</head>

<body background="Diagrams/bg.gif">
<table width="1000" border="0" align="center">
  <tr>
    <td><img src="Diagrams/College (3).jpg" width="1000" height="167" /></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="215" scope="row"><a href="home.php"><strong>Home</strong></a></td>
    <td width="556" scope="row"><div align="center" class="style1">Leave applications </div></td>
    <td width="215"><div align="right"><?php print("<a href=\"logout.php"."\"><b>Log out</b></a>");	?></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <th scope="row">
	<p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
	  <p>
	    <?php
if($_SESSION["administrator"]=='1'){
	$query = "SELECT * FROM leave_application_table WHERE approval_status='pending'";
	$result = mysql_query($query, $link) or die("Error in inserting leave application info into db.  Error returned if any: ".mysql_error());
	$num_rows = mysql_num_rows($result);
	$nt=mysql_fetch_array($result);
	
	if($num_rows>0){
		
			$empid = $nt[employee_id];
			$query1 = "SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
			$result1 = mysql_query($query1, $link) or die("Error in inserting employee extension table info into db.  Error returned if any: ".mysql_error());
			$nt1=mysql_fetch_array($result1);
				
			$date_from = $nt[date_from];
			$date_to = $nt[date_to];
			$d1 = strtotime($nt[date_from]);
			$d2 = strtotime($nt[date_to]);
			$delta = $d2 - $d1;
			if($d1 == $d2)
				$tot_days = (($delta/86400)+1);
			else
				$tot_days = (($delta/86400));
			$sun_sat = getAllSatSun($date_from,$date_to);
			$num_days = $tot_days - $sun_sat;
			
			$accepturl = "http://localhost:81/EMS/acceptleave_req.php?app_id=$nt[appln_id]";
			$rejecturl = "http://localhost:81/EMS/rejectleave_req.php?app_id=$nt[appln_id]";?>
			<table height="44" border="1">
			<tr><th width="100">Employee id</th><th width="150">Name</th><th width="100">Applied date</th><th width="150">Type of leave</th><th width="100">Date from</th><th width="100">Date to</th><th width="100">No of days</th><th width="100" colspan=2>Approve</th></tr>
			<tr><td><?php echo "$nt[employee_id]"; ?></td><td><?php echo ucwords($nt1[firstName]); echo " "; echo ucwords($nt1[middleName]); echo " "; echo ucwords($nt1[lastName]); ?></td><td><center><?php echo $nt[date_applied] ?></center></td><td><center><?php echo ucwords($nt[leave_type]) ?></center></td><td><?php echo "$nt[date_from]";?></td><td><?php echo "$nt[date_to] ";?></td><td><center><?php echo "$num_days";?></center></td><th  bgcolor="#EFFBFB"><?php print("<a href='$accepturl'>Yes</a>");?></th><th  bgcolor="#EFFBFB"><?php print("<a href='$rejecturl'>No</a>")?></th></tr>
			</table><p>
			<?php	
		
		while($nt=mysql_fetch_array($result)){
				
			$empid = $nt[employee_id];
			$query1 = "SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
			$result1 = mysql_query($query1, $link) or die("Error in inserting employee extension table info into db.  Error returned if any: ".mysql_error());
			$nt1=mysql_fetch_array($result1);
			
			$date_from = $nt[date_from];
			$date_to = $nt[date_to];
			$d1 = strtotime($nt[date_from]);
			$d2 = strtotime($nt[date_to]);
			$delta = $d2 - $d1;
			if($d1 == $d2)
				$tot_days = (($delta/86400)+1);
			else
				$tot_days = (($delta/86400));
			$sun_sat = getAllSatSun($date_from,$date_to);
			$num_days = $tot_days - $sun_sat;

			$accepturl = "http://localhost:81/EMS/acceptleave_req.php?app_id=$nt[appln_id]";
			$rejecturl = "http://localhost:81/EMS/rejectleave_req.php?app_id=$nt[appln_id]";?>
			<table height="44" border="1">
			<tr><th width="100">Employee id</th><th width="150">Name</th><th width="100">Applied date</th><th width="150">Type of leave</th><th width="100">Date from</th><th width="100">Date to</th><th width="100">No of days</th><th width="100" colspan=2>Approve</th></tr>
			<tr><td><?php echo "$nt[employee_id]"; ?></td><td><?php echo ucwords($nt1[firstName]); echo " "; echo ucwords($nt1[middleName]); echo " "; echo ucwords($nt1[lastName]); ?></td><td><center><?php echo $nt[date_applied] ?></center></td><td><center><?php echo ucwords($nt[leave_type]) ?></center></td><td><?php echo "$nt[date_from]";?></td><td><?php echo "$nt[date_to] ";?></td><td><center><?php echo "$num_days";?></center></td><th  bgcolor="#EFFBFB"><?php print("<a href='$accepturl'>Yes</a>");?></th><th  bgcolor="#EFFBFB"><?php print("<a href='$rejecturl'>No</a>");?></th></tr>
			</table><p>
		<?php	
		}
	}
	else{?>
	<marquee>
		<?php	
		echo "<font color=\"red\" face='georgia'><i>No Leave applications</i></font>";
		?>
	</marquee>
<?php
	}
	
}	
?>
	<p>&nbsp;    </p></th>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
