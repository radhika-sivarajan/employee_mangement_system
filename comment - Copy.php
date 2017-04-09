<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
$query="SELECT DISTINCT year FROM comments";
$result=mysql_query($query, $link) or die("Died inserting comments table info into db.  Error returned if any: ".mysql_error());
$nt=mysql_fetch_array($result);
?>
<html>
<head><title>Comments</title>
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
<body>
<table width="1006" border="0" align="center">
  <tr>
    <td width="1207"><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="300"><a href="home.php"><strong>Home</strong></a></td>
    <td width="400"><div align="center"><strong><span class="style1">Comments</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <th><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
    <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="GET">
	  <p>
	  <?php
	  $year = date('Y');
	  $month = date('M');
	  ?>
	  <p>Year: <select name=year value=''><?php echo "<option value=$year>Current year</option>"; ?>
			<option value='2011'>2011</option>
			<option value='2010'>2010</option>
			<option value='2009'>2009</option>
			<option value='2008'>2008</option>
			<option value='2007'>2007</option>
			</select>
	    Month: 
	    <select name="month"><?php echo "<option value=$month>Current month</option>"; ?>
	         <option value ="Jan">January</option>
             <option value ="Feb">February</option>
             <option value ="Mar">March</option>
             <option value ="Apr">April</option>
             <option value ="May">May</option>
             <option value ="Jun">June</option>
             <option value ="Jul">July</option>
             <option value ="Aug">August</option>
             <option value ="Sep">September</option>
             <option value ="Oct">October</option>
             <option value ="Nov">November</option>
             <option value ="Dec">December</option>
           </select>
	    </p>
	  <p>
	    <input name="submit" type="submit" value="Submit"/>
	    
        </p>
    </form>	
<p>
  <?php
global $link;
if(isset($_GET["submit"])){
	$year = $_GET['year'];
	$month = $_GET['month'];
	$query1="SELECT * FROM comments WHERE year='$year' AND month='$month'";
	$result1=mysql_query($query1, $link) or die("Died inserting comments info into db.  Error returned if any: ".mysql_error());
	$num_rows = mysql_num_rows($result1);
	if($num_rows>0){
		if($num_rows>1)
			echo "There are $num_rows result\n";
			while ($row1 = mysql_fetch_array($result1)){
			$empid=$row1[employee_id];
			$query2="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
			$result2=mysql_query($query2, $link) or die("Died inserting extented emplyee details info into db.  Error returned if any: ".mysql_error());
			$row2 = mysql_fetch_array($result2);
		   $f = $row2[firstName];
		   $l = $row2[lastName];
		   $m = $row2[middleName];
		   $name = $f. " " .$m. " " .$l;
		   $comview = "http://localhost:81/EMS/commentview.php?id=$row1[id]";
			?>
      </p>
			<table border="0" align="center">
			<tr>
			  <td width="160"> <?php echo ucwords($name); ?></a></td>
			  <td width="150"><?php echo strtoupper($row2[department]); echo" department"; ?></td>
			  <td width="100"><div align='right'><?php print("<a href='$comview'>view comment</a>"); ?></div></td>
			</tr>
			</table>
		  <p>
			<?php
		}
	} 
	else{?>
		<marquee>
			<?php	
			echo "<font color=\"red\" face='georgia'><i>No comments</i></font>";
			?>
		</marquee>
		<?php
	}
}
?>
	</p>
	<p>&nbsp;        </p></th>
  </tr>
</table>
</BODY>
</HTML>