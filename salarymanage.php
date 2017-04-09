<?php
include_once("config.php");
checkLoggedIn("yes");
doCSS();
$query1="SELECT * FROM ext_employee_details ORDER BY firstName";
$result1=mysql_query($query1, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
?>
<html>
<head>
<title>Manage salary</title>
<style type="text/css">
<!--
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
.style6 {font-family: "Brush Script Std"; }
-->
</style>
</head>
<body background="Diagrams/bg.gif">
<table width="1000" border="0" align="center">
  <tr>
    <td><div align="center"><img src="Diagrams/College (3).jpg" width="1000" height="167"></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="150"><a href="home.php"><strong>Home</strong></a></td>
	<td width="150"><a href="manageuser.php"><strong>Manage user</strong></a></td>
        <td width="400"><div align="center"><strong><span class="style3">Manage salary</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <td><p><center><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center><p>
    <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	 <p align="center">&nbsp;</p>
	 <table width="311" border="0" align="center">
       <tr>
         <td width="144">Employee ID:</td>
         <td width="147"><?php
			echo "<select name=id value=''><option value=''>Enter the name of employee</option>";
			while($nt1=mysql_fetch_array($result1)){
				$f = $nt1[firstName];
				$m = $nt1[middleName];
				$l = $nt1[lastName];
				$n = $f. " " .$m. " " .$l;
				$name = ucwords($n);
				echo "<option value=$nt1[employee_id]>$name</option>";
			}
			echo "</select>";
			?></td>
       </tr>
       <tr>
         <td>Year:<select name="year">
             <option value ="2011">2011</option>
             <option value ="2010">2010</option>
             <option value ="2009">2009</option>
             <option value ="2008">2008</option>
             <option value ="2007">2007</option>
             <option value ="2006">2006</option>
             <option value ="2005">2005</option>
             <option value ="2004">2004</option>
             <option value ="2003">2003</option>
             <option value ="2002">2002</option>
             <option value ="2001">2001</option>
             <option value ="2000">2000</option>
             </select>
         </td>
         <td>Month:
           <select name="month">
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
           </select></td>
       </tr>
       <tr>
         <td>Basic pay</td>
         <td><input type="text" name="basicpay" value="" maxlength="10"></td>
       </tr>
	   <tr>
         <td>DA percetage</td>
         <td><input type="text" name="da_per" value="" maxlength="10"></td>
       </tr>
	   <tr>
         <td>PF amount</td>
         <td><input type="text" name="pf_amt" value="" maxlength="10"></td>
       </tr>
	   <tr>
         <td>State Life Insurance</td>
         <td><input type="text" name="sli" value="" maxlength="10"></td>
       </tr>
	   <tr>
         <td>Group Insurance</td>
         <td><input type="text" name="gis" value="" maxlength="10"></td>
       </tr>
      </table>
	 <p align="center"><input name="submit" type="submit" value="Submit"/>
	 </form>	</td>
  </tr>
  <tr>
   <td>
   <?php
   if(isset($_POST["submit"])){
		$id=$_POST['id'];
		$year=$_POST['year'];
		$month=$_POST['month'];
		$basicpay=$_POST['basicpay'];
		$da_per=$_POST['da_per'];
		$pf=$_POST['pf_amt'];
		$sli=$_POST['sli'];
		$gis=$_POST['gis'];
		
		$other_ded = $sli + $gis;
		$da = $da_per * $basicpay;
		
		if($year == 2011)
			$hta = 450;
		else if($year == 2010)
			$hta = 400;
		else if($year == 2009)
			$hta = 350;
		else if($year == 2008)
			$hta = 300;
		else if($year == 2007)
			$hta = 250;
		else if($year == 2006)
			$hta = 200;
		else if($year == 2005)
			$hta = 150;
		else
			$hta = 100;
			
		if($basicpay < 5000){
			$hra = 450;
		}
		else if($basicpay >= 5000 && $basicpay < 10000)
			$hra = 600;
		else if($basicpay >= 10000 && $basicpay < 15000)
			$hra = 750;
		else if($basicpay >= 15000 && $basicpay < 20000)
			$hra = 900;
		else if($basicpay >= 25000 && $basicpay < 30000)
			$hra = 1050;
		else if($basicpay >= 35000 && $basicpay < 40000)
			$hra = 1200;
		else
			$hra = 1350;
			
		$totsal = $basicpay + $da + $hta  + $hra;
		
		if($totsal <5000)
			$tax = 0;
		else if($totsal >=5000 && $totsal <10000)
			$tax = 250;
		else if($totsal >=10000 && $totsal <15000)
			$tax = 500;
		else if($totsal >=15000 && $totsal <20000)
			$tax = 750;
		else if($totsal >=20000 && $totsal <25000)
			$tax = 1000;
		else if($totsal >=25000 && $totsal <30000)
			$tax = 1250;
		else if($totsal >=30000 && $totsal <35000)
			$tax = 1500;
		else if($totsal >=35000 && $totsal <40000)
			$tax = 1750;
		else
			$tax = 2000;
		$deduction = $pf + $other_ded + $tax;
		$query="INSERT INTO payslip (employee_id, year,month,basic_pay,da,hta,hra,pf_amt,tax_amt,other_ded,tot_sal,deduction) VALUES('$id','$year','$month','$basicpay','$da','$hta','$hra','$pf','$tax','$other_ded','$totsal','$deduction')";
		$result=mysql_query($query, $link) or die("Died inserting payslip  Error!: ".mysql_error());
		
   } ?>
   <table width="200" border="1">
     <tr>
       <td>BP <?php echo $basicpay; ?></td><td>DA <?php echo $da; ?></td>
       <td>HTA <?php echo $hta; ?></td><td>HRA <?php echo $hra; ?></td>
       <td>TOT <?php echo $totsal; ?></td><td>PF <?php echo $pf; ?></td>
       <td>OTH <?php echo $other_ded; ?></td><td>TAX <?php echo $tax; ?></td>
     </tr>
   </table>
   </td>
  </tr>
</table>
</body>
</html>