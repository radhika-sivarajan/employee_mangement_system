<?php
ob_start();
include_once("config.php");
doCSS();
global $link;
checkLoggedIn("yes");
$empid = $_GET['emp_id'];
$query="SELECT * FROM ext_employee_details WHERE employee_id='$empid'";
$result=mysql_query($query, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
?>
<html>
<head>
<title>Employee Details to edit</title>
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
    <td width="80"><a href="home.php"><strong>Home</strong></a></td>
	<td width="121"><a href="manageuser.php"><strong>Manage user</strong></a></td>
	<td width="152"><<<a href="editemp.php"><strong>Back</strong></a></td>
    <td width="250"><div align="center"><strong><span class="style2">Employee details </span></strong></div></td>
    <td width="375"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg">
      <p><span class="style1">Personal information</span></p>
      <?php
if (($result)||(mysql_errno == 0))
{
	if (mysql_num_rows($result)>0)
	{
		while($nt=mysql_fetch_array($result)){
?>
       <?php
	   $f = $nt[firstName];
	   $l = $nt[lastName];
	   $m = $nt[middleName];
	   $n = $f. " " .$m. " " .$l;
	   ?>
	   <table width="424" border="1">
        <tr>
          <td width="188"><b>Name</b></td>
          <td width="220"><?php echo ucwords($n); ?></td>
        </tr>
        <tr>
          <td><b>Date of birth</b></td>
          <td><?php echo "{$nt[dob]}"; ?></td>
        </tr>
		<tr>
          <td><b>Age</b></td>
          <td><?php
			$dob = $nt[dob];
			$curr_date = date('Y-m-d');
			$d1 = strtotime($dob);
			$d2 = strtotime($curr_date);
			$delta = $d2 - $d1;
			$age = ($delta/31572500);
			echo floor($age); ?></td>
        </tr>
        <tr>
          <td><b>Marital status</b></td>
          <td><?php echo ucwords($nt[marital_stat]); ?></td>
        </tr>
        <tr>
          <td><b>Current address</b></td>
          <td><?php echo ucwords($nt[curr_add]); ?></td>
        </tr>
        <tr>
          <td><b>Permanent address</b></td>
          <td><?php echo ucwords($nt[perm_add]); ?></td>
        </tr>
        <tr>
          <td><b>Phone number</b></td>
          <td><?php echo "{$nt[phone]}"; ?></td>
        </tr>
		<tr>
          <td scope="row"><b>E-mail</b></td>
          <td><?php echo  strtolower($nt[email]); ?></td>
        </tr>
      </table>
      <p><span class="style1">Official information</span></p>
      <table width="424" border="1">
        <tr>
          <td width="188" scope="row"><b>Employee id </b></td>
          <td width="220"><?php echo "{$nt[employee_id]}"; ?></td>
        </tr>
        <tr>
          <td scope="row"><b>Join date </b></td>
          <td><?php echo "{$nt[join_date]}"; ?></td>
        </tr>
        <tr>
          <td scope="row"><b>Department</b></td>
          <td><?php
				$d = $nt[department];
				if ($d=="it")
				  echo "Information Technology";
				elseif ($d=="cse")
				  echo "Computer Science & Engg";
				elseif ($d=="ece")
				  echo "Electronics & Communication Engg";
				elseif ($d=="eee")
				  echo "Electrical & Electronic Engg";
				elseif ($d=="ge")
				  echo "General Engineering"; 
				elseif ($d=="office")
				  echo "Office";  
				?></td></tr>
		<tr>
          <td scope="row"><b>Designation</b></td>
          <td><?php echo ucwords($nt[designation]); ?></td>
        </tr>
		<tr>
          <td scope="row"><b>Specilization</b></td>
          <td><?php echo ucwords($nt[specialization]); ?></td>
        </tr>
      </table>
      <p>
        <?php
		}
	}	
	else{
		echo "<tr><td colspan='" . ($i+1) . "'>No Results found!</td></tr>";
	}
}
else{
	echo "Error in running query :". mysql_error();
}	
?></p></p>
    </th>
  </tr>
</table>
 <p>&nbsp;</p>
</body>
</html>