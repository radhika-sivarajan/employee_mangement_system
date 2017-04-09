<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
$query="SELECT * FROM ext_employee_details ORDER BY firstName";
$result=mysql_query($query, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
$num=mysql_numrows($result);
?>
<html>
<head>
<title>All employees</title>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #FF3333;
}
.style2 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
.style3 {
	font-size: 16px;
	font-style: italic;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #CC0000;
	font-weight: bold;
}
-->
</style>
</head>
<body background="Diagrams/bg.gif">
<table width="1000" border="0" align="center">
  <tr>
    <td width="1000"><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="250"><a href="home.php"><strong>Home</strong></a></td>
    <td width="500"><div align="center"><strong><span class="style2">All employees</span></strong></div></td>
    <td width="250"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>

<table width="1000" border="0" align="center" >
    <tr>
    <th background="Diagrams/plasma.jpg"><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center><p>
<table border="1">
<tr><th>Employee id</th><th>Name</th><th>Join date</th><th>Department</th><th>Designation</th></tr>
<?php
$i=0;
while ($i < $num) {
$f1=mysql_result($result,$i,"employee_id");
	   $f = mysql_result($result,$i,"firstName");
	   $l = mysql_result($result,$i,"lastName");
	   $m = mysql_result($result,$i,"middleName");
$f2 = $f. " " .$m. " " .$l;
$f9=mysql_result($result,$i,"join_date");
$f10=mysql_result($result,$i,"department");
$f11=mysql_result($result,$i,"designation");
?>
<tr><td><?php echo $f1; ?></td>
<td><?php echo ucwords($f2); ?></td><td><?php echo ucwords($f9); ?></td><td><?php echo strtoupper($f10); ?></td><td><?php echo ucfirst($f11); ?></td></tr>
<?php
$i++;
}
?>
</table>
<p>&nbsp;</p></th>
</body>
</html>