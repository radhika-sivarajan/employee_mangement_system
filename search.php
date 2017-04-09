<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
?>
<html>
<head><title>Search</title>
<style type="text/css">
<!--
.style1 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF00FF;
}
.style4 {font-style: italic; font-family: "Times New Roman", Times, serif;}
-->
</style>
</head>
<body background="Diagrams/bg.gif">
<table width="1006" border="0" align="center">
  <tr>
    <td width="1207"><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="200"><a href="home.php"><strong>Home</strong></a></td>
    <td width="586"><div align="center" class="style1">Search for employee </div></td>
    <td width="200"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
   <th background="Diagrams/plasma-turbulence-web-background.jpg"><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  <span class="style4">Enter the name </span>
  <input type="text" name="fname" value="<?php echo $_GET['fname']; ?>" />
<input type="submit" name="submit" value="Search" />
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
		   $search = "http://localhost:81/EMS/searchresult.php?emp_id=$row[employee_id]";
			?>
      </p>
			<table border="0" align="center">
			<tr>
			  <td width="160"> <?php echo ucwords($name); ?></a></td>
			  <td width="150"><?php echo strtoupper($row[department]); echo" department"; ?></td>
			  <td width="50"><div align='right'><?php print("<a href='$search'>view</a>"); ?></div></td>
			</tr>
			</table>
		  <p>
			<?php
		}
	} 
	else
		echo "Sorry no result !!";
}
?>
	</p>
	<p>&nbsp;        </p></th>
  </tr>
</table>
</BODY>
</HTML>