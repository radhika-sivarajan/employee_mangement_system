<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
$empid=$_SESSION["employeeid"];
global $link;
$query="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
$query1="SELECT * FROM leave_summary WHERE employee_id='$empid'";
$result=mysql_query($query, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
$result1=mysql_query($query1, $link) or die("Died inserting leave summary info into db.  Error returned if any: ".mysql_error());
$nt=mysql_fetch_array($result);
$nt1=mysql_fetch_array($result1);
?>
<html>
<head>
<title>Service Summary</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
	color: #FF3333;
}
.style2 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
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
    <td width="200"><a href="myinfo.php"><strong>My information</strong></a></td>
    <td width="382"><div align="center"><strong><span class="style2">Service summary</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg"><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
	<p>
		<?php
			$curr_date = date('Y-m-d');
			$d1 = strtotime($curr_date);
			$d2 = strtotime($nt[join_date]);
			$d3 = strtotime($nt[service_entry]);
			$delta1 = $d1 - $d2;
			$delta2 = $d2 - $d3;
			$tot_days_present = (($delta1/86400)+1);
			$tot_days_past = ($delta2/86400);
			$sun_sat1 = getAllSatSun($nt[join_date],$curr_date);
			$sun_sat2 = getAllSatSun($nt[service_entry],$nt[join_date]);
			$num_days1 = $tot_days_present - $sun_sat1;
			$num_days2 = $tot_days_past - $sun_sat2;
		?>
	   <table width="424" border="1">
	   <tr><td>Present institution</td><td>Govt: Engg College Idukki</td></tr>
	   <tr><td>Date of joining</td><td><?php echo $nt[join_date]; ?></td></tr>
	   <tr><td>Service in this institution</td><td><?php echo $num_days1; ?> days</td></tr>
	   <tr><td>Current service in hilly area</td><td>Yes</td></tr>
	   <tr><td>Date of entry in the service</td><td><?php echo $nt[service_entry]; ?></td></tr>
	   <tr><td>Total outstation service</td><td><?php echo $num_days2; ?> days</td></tr>
	   </table>
	 <p>&nbsp;</p>  
    </th>
  </tr>
</table>
 <p>&nbsp;</p>
</body>
</html>