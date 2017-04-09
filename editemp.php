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
<title>Edit employee information</title>
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
    <td width="100"><a href="home.php"><strong>Home</strong></a></td>
    <td width="150"><a href="manageuser.php"><strong>Manage user</strong></a></td>
    <td width="500"><div align="center"><strong><span class="style2">Search for employee</span></strong></div></td>
    <td width="250"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
	  <p>&nbsp;</p>
	  <p class="style3">Enter the name of employee to modify</p>
	  <p class="style3">
	      <input type="text" name="fname" value="<?php echo $_GET['fname']; ?>" />
	    <input type="submit" name="submit" value="Search" />
	    </p>
	</form>
<p>
  <?php
global $link;
if(isset($_GET["submit"])){
	$fname = $_GET['fname'];
	$sql="SELECT * FROM ext_employee_details WHERE (firstName like '%$fname%' OR lastName like '%$fname%') OR middleName like '%$fname%'";
	$result=mysql_query($sql, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
	$num_rows = mysql_num_rows($result);
	if($num_rows>0){
		if($num_rows>1)
			echo "There are $num_rows result\n";
			while ($row = mysql_fetch_array($result)){ 
		   $f = $row[firstName];
		   $l = $row[lastName];
		   $m = $row[middleName];
		   $name = $f. " " .$m. " " .$l;
		   $empid = $row[employee_id];
		   $search1 = "http://localhost:81/EMS/searchresultemp.php?emp_id=$row[employee_id]";
		   $search2 = "http://localhost:81/EMS/editempinfo.php?emp_id=$row[employee_id]";
		   $search3 = "http://localhost:81/EMS/deletemp.php?emp_id=$row[employee_id]";
			?>
      </p>
			<table border="0" align="center">
			<tr>
			  <td width="160"> <?php echo ucwords($name); ?></a></td>
			  <td width="100"> <?php echo ucwords($empid); ?></a></td>
			  <td width="150"><?php echo strtoupper($row[department]); echo" department"; ?></td>
			  <td width="50"><div align='right'><?php print("<a href='$search1'>view</a>"); ?></div></td>
			  <td width="50"><div align='right'><?php print("<a href='$search2'>edit</a>"); ?></div></td>
			  <td width="50"><div align='right'><?php print("<a href='$search3'>delete</a>"); ?></div></td>
			</tr>
			</table>
		  <p>
			<?php
		}
	} 
	else
		echo "Sorry no result !!";
}
?></p></th>
  </tr>
</table>
<p>&nbsp;</p></th>
</body>
</html>