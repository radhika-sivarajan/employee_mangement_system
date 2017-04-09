<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
$empid=$_SESSION["employeeid"];
global $link;
$curr_year = date('Y');
$query="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
$query1="SELECT * FROM leave_summary WHERE employee_id='$empid' AND year='$curr_year'";
$query2="SELECT * FROM leave_ref_table";
$result=mysql_query($query, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
$result1=mysql_query($query1, $link) or die("Died inserting leave summary info into db.  Error returned if any: ".mysql_error());
$result2=mysql_query($query2, $link) or die("Died inserting leave reference table info into db.  Error returned if any: ".mysql_error());
$nt=mysql_fetch_array($result);
$nt1=mysql_fetch_array($result1);
$nt2=mysql_fetch_array($result2);
?>
<html>
<head>
<title>Leave Summary</title>
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
    <td width="200"><a href="leavehome.php"><strong>Leave information</strong></a></td>
    <td width="382"><div align="center"><strong><span class="style2">Leave summary</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg">
	<p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
	<p>
      <?php 
		$nc = $nt1[casual];
		$bc = 6 - $nt1[casual];
		$nm = $nt1[medical];
		$bm = 6 - $nt1[medical];
		$np = $nt1[paid_vacation];
		$bp = 18 - $nt1[paid_vacation];
		$nw = $nt1[without_pay];
		$bw = 100 - $nt1[without_pay];
		$nmt = $nt1[maternity];
		$bmt = 90 - $nt1[maternity];
		$npt = $nt1[paternity];
		$bpt = 14 - $nt1[paternity];
	   ?>
	   <table width="424" border="1">
	   <tr><th>Type of leave</th><th>Total leave</th><th>Taken leave</th><th>Balance leave</th></tr>
	   <tr><td>Casual leave</td><th>6</th><th><?php echo $nc; ?></th><th><?php echo $bc; ?></th></tr>
	   <tr><td>Medical leave</td><th>6</th><th><?php echo $nm; ?></th><th><?php echo $bm; ?></th></tr>
	   <tr><td>Paid vacation</td><th>18</th><th><?php echo $np; ?></th><th><?php echo $bp; ?></th></tr>
	   <tr><td>With out pay</td><th>100</th><th><?php echo $nw; ?></th><th><?php echo $bw; ?></th></tr>
	   <?php if(($nt[gender]=='male')&&($nt[marital_stat]=='married')){
	    ?>
	   <tr><td>Paternity leave</td><th>14</th><th><?php echo $npt; ?></th><th><?php echo $bpt; ?></th></tr>
	   <?php
	    }
		else if(($nt[gender]=='male')&&($nt[marital_stat]=='married')){
	    ?>
	   <tr><td>Maternity leave</td><th>90</th><th><?php echo $nmt; ?></th><th><?php echo $bmt; ?></th></tr>
	   <?php
	    }
	    ?>
	   </table>
	 <p>&nbsp;</p>  
    </th>
  </tr>
</table>
 <p>&nbsp;</p>
</body>
</html>