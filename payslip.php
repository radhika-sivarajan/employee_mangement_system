<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
$empid=$_SESSION["employeeid"];
global $link;
$query1="SELECT DISTINCT year FROM payslip WHERE employee_id='$empid'";
$result1=mysql_query($query1, $link) or die("Died inserting payslip table.  Error returned if any: ".mysql_error());
$query2="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
$result2=mysql_query($query2, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
?>
<html>
<head>
<title>Pay slip</title>
<style type="text/css">
<!--
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
.style6 {font-family: "Brush Script Std"; }
-->
</style>
<script language="javascript" src="calendar/calendar.js"></script>
</head>
<body background="Diagrams/bg.gif">
<table width="1000" border="0" align="center">
  <tr>
    <td><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="300"><a href="home.php"><strong>Home</strong></a></td>
    <td width="400"><div align="center"><strong><span class="style3">Pay slip</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <th><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
    <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	  <p>
	  <?php
	  $year = date('Y');
	  $month = date('M');
	  ?>
	  <p>Year: <?php
			echo "<select name=year value=''><option value=$year>Current year</option>";
			while($nt1=mysql_fetch_array($result1)){
				echo "<option value=$nt1[year]>$nt1[year]</option>";
			}
			echo "</select>";
			?>
	    Month: 
	    <select name="month"><?php echo "<option value=$month>Current month</option>"; ?>
	         <option value ="jan">January</option>
             <option value ="feb">February</option>
             <option value ="mar">March</option>
             <option value ="apr">April</option>
             <option value ="may">May</option>
             <option value ="jun">June</option>
             <option value ="jul">July</option>
             <option value ="aug">August</option>
             <option value ="sep">September</option>
             <option value ="oct">October</option>
             <option value ="nov">November</option>
             <option value ="dec">December</option>
           </select>
	    </p>
	  <p>
	    <input name="submit" type="submit" value="Get payslip"/>
	    
        </p>
    </form>	
	<p>
	<?php
	$empid=$_SESSION["employeeid"];
    if(isset($_POST["submit"])){
		$year=$_POST['year'];
		$month=$_POST['month'];
		
		$query3="SELECT * FROM payslip WHERE employee_id='$empid' AND (year='$year' AND month='$month')";
		$result3=mysql_query($query3, $link) or die("The given input not found in payslip table ".mysql_error());
		$nt3=mysql_fetch_array($result3);
		$net = $nt3[tot_sal] - $nt3[deduction];
		
		if($net != 0){		
		?>
			<table width="539" border="1">
			  <tr>
				<th colspan="2">Earnings</th>
				<th colspan="2">Deduction</th>
			  </tr>
			  <tr>
				<td width="120"><div align="center" class="style6">Category</div></td>
				<td width="120"><div align="center" class="style6">Amount</div></td>
				<td width="120"><div align="center" class="style6">Category</div></td>
				<td width="112"><div align="center" class="style6">Amount</div></td>     
			</tr>
			<tr>
				<td width="120">Basic pay</td>
				<td width="120"><div align="center"><?php echo $nt3[basic_pay]; ?></div></td>
				<td width="120">PF amount</td>
				<td width="112"><div align="center"><?php echo $nt3[pf_amt]; ?></div></td>
			</tr>
			<tr>
				<td width="120">HRA</td>
				<td width="120"><div align="center"><?php echo $nt3[hra]; ?></div></td>
				<td width="120">Professional tax</td>
				<td width="112"><div align="center"><?php echo $nt3[tax_amt]; ?></div></td>
			</tr>
			<tr>
				<td width="120">DA</td>
				<td width="120"><div align="center"><?php echo $nt3[da]; ?></div></td>
				<td width="120">Other deduction</td>
				<td width="112"><div align="center"><?php echo $nt3[other_ded]; ?></div></td>
			</tr>
			<tr>
				<td width="120">HTA</td>
				<td width="120"><div align="center"><?php echo $nt3[hta]; ?></div></td>
				<td width="120">&nbsp;</td>
				<td width="112"><div align="center">&nbsp;</div></td>
			</tr>
			<tr>
				<td width="120"><div align="left"><strong>Total salary</strong></div></td>
				<td width="120"><div align="center"><?php echo $nt3[tot_sal]; ?></div></td>
				<td width="120"><div align="left"><strong>Total deduction</strong></div></td>
				<td width="112"><div align="center"><?php echo $nt3[deduction]; ?></div></td>
			</tr>
			  </table>
			<p>
			<table width="279" border="1">
			  <tr>
			   <td width="131"><strong>Net salary</strong></td>
				<td width="132"><div align="center"><?php echo $net; ?></div></td>
			  </tr>
			</table>
		<?php
		}
		else{?>
		<marquee>
			<?php	
			echo "<font color=\"red\" face='georgia'><i>Sorry!! payslip for '$month, $year' not available</i></font>";
			?>
		</marquee>
		<?php
		}
	}
	?>
	<p>
	</th>
  </tr>
</table>
</body>
</html>