<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link; ?>

<html>
<head>
<title>Leave cancel</title>
<style type="text/css">
<!--
.style2 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
.style3 {
	font-family: "Times New Roman", Times, serif;
	font-style: italic;
	font-size: 14px;
}
.style4 {
	font-size: 16px;
	font-style: italic;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #CC0000;
	font-weight: bold;
}
-->
</style>
<script language="javascript" src="calendar/calendar.js"></script>
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
    <td width="382"><div align="center"><strong><span class="style2">Cancel leave</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg"><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center>
	  <p><b>Govt: Engineering College Painavu<br>
	    Idukki District, Pin: 685603</b></p>
	  <p>
	</center>
	  <table border="0" align="center">
	  
	    
		
	    <tr>
			<td><div><p>
            <?php
			doCSS();
			$emp_id = $_SESSION["employeeid"];
			$query1 = "SELECT * FROM leave_application_table WHERE employee_id='$emp_id'";
			$result1 = mysql_query($query1, $link) or die("Error leave application table  info into db.  Error returned if any: ".mysql_error());
			$num=mysql_numrows($result1);
			$nt1=mysql_fetch_array($result1);
			if($num != 0){
			?>
			<table height="44" border="1">
			<tr><th width="100">Applied date</th><th width="150">Type of leave</th><th width="100">Date from</th><th width="100">Date to</th><th width="100">No of days</th><th width="100">Status</th></tr>
			<?php
			
			$i=0;
			while ($i < $num) {
				$curr_date = date('Y-m-d');
				$f1=mysql_result($result1,$i,"date_from");
				$f2 = mysql_result($result1,$i,"date_to");
				$d1 = strtotime($f1);
				$d2 = strtotime($f2);
				$d3 = strtotime($curr_date);
				$delta = $d2 - $d1;
				if($d1 == $d2)
					$tot_days = (($delta/86400)+1);
				else
					$tot_days = (($delta/86400));
				$sun_sat = getAllSatSun($date_from,$date_to);
				$num_days = $tot_days - $sun_sat;
				
				$f3=mysql_result($result1,$i,"date_applied");
				$f4=mysql_result($result1,$i,"leave_type");
				$f5=mysql_result($result1,$i,"approval_status");
				?>
				<tr><td><center><?php echo $f3; ?></center></td><td><center><?php echo ucwords($f4); ?></center></td><td><?php echo $f1;?></td><td><?php echo $f2; ?></td><td><center><?php echo "$num_days";?></center></td><td><?php echo ucwords($f5); ?></td></tr>
			<?php
				$i++;
			}
			
			?>
			</table>
			
		    </p></div></td>
		</tr>
		
      </table>
	  <p class="style4">Enter the leave date you want to cancel </p>
	  <table width="200" border="1">
        <tr><th width="306"><form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST"><center>
	      
	        <table width="299" border="0" align="right">
	          <tr>
	            <td width="100"><b>Date from</b></td>
                    <td width="124"><?php
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
	            <td width="100"><b>Date to</b></td>
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
	            <td><div align="right"><input name="submit" type="submit" value="Cancel"></div></td>
                    <td><input name="Input" type="reset" /></td>
                </tr>
	          </table></center>	        
	    </form></th> </tr>
      </table> 
	  <?php
			} 
			else
				echo "<font color=\"red\" face='georgia'><i>You have no leave application summary</i></font>";
		?>
	  <p>&nbsp;</p>
	</th>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <th><?php
	doCSS();
	$emp_id = $_SESSION["employeeid"];
	//on submit
	if(isset($_POST["submit"])){
	
		$leavetype = $_POST['leavetype'];
		$date_from = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
		$date_to = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : ""; 
		
		$query = "SELECT * FROM leave_application_table WHERE employee_id='$emp_id' AND (date_from='$date_from' AND date_to='$date_to')";
		$result = mysql_query($query, $link) or die("Error leave application table  info into db.  Error returned if any: ".mysql_error());
		$nt=mysql_fetch_array($result);
		$app = $nt[appln_id];
		if($nt[approval_status] == pending){
			echo "<font color=\"#0101DF\" face='georgia'><i>Leave application from $date_from to $date_to was cancelled</i></font>";
			$query1 = "UPDATE leave_application_table SET approval_status='cancelled' WHERE appln_id='$app'";
			$result1 = mysql_query($query1, $link) or die("Error leave cancel  info into db.  Error returned if any: ".mysql_error());
		
		}
		elseif($nt[approval_status] == approved){
				echo "<font color=\"#0101DF\" face='georgia'><i>Leave application already approved</i></font>";
		}
		elseif($nt[approval_status] == rejected){
				echo "<font color=\"#0101DF\" face='georgia'><i>Leave application already rejected</i></font>";
		}
		else{
				echo "<font color=\"#0101DF\" face='georgia'><i>Leave application could not be found</i></font>";
		}
	}

  ?>
	</th>
  </tr>
  </table>
</body>
</html>
<?php/*
$empid=$_SESSION["employeeid"];
if(isset($_POST["submit"])){
	$date_from = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	$date_to = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : ""; 
	$query="DELETE FROM leave_application_table  WHERE employee_id='$empid'";
	$result=mysql_query($query, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());
	header("Location: home.php");
}*/
?>	  