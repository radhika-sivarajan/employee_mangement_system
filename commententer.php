<?php
ob_start();
include_once("config.php");
checkLoggedIn("yes");
doCSS();
global $link;
?>
<html>
<head>
<title>Enter comment</title>
<style type="text/css">
<!--
.style1 {
	color: #FF3333;
	font-size: 24px;
	font-weight: bold;
}
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
-->
</style>
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
    <td width="382"><div align="center"><strong><span class="style3">Enter comment</span></strong></div></td>
    <td width="300"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
  <tr>
    <th><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center>
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
	  <table border="0">
		<tr>
		<td><textarea name="comment" cols="40" rows="5" wrap="physical"></textarea></td>
		</tr>
	  </table>
  <p>
    <input name="submit" type="submit" value="Submit"/>
    <input name="" type="reset" />
    </p>
    </form>	
	<?php
	doCSS();
	$empid = $_SESSION["employeeid"];
	if(isset($_POST["submit"])){
		$comment = $_POST['comment'];
		$year = date('Y');
		$month = date('M');
		$query="INSERT INTO comments (employee_id, year, month, comment) VALUES('$empid','$year','$month','$comment')";
		$result=mysql_query($query, $link) or die("Error in accepting leave request. Error returned if any: ".mysql_error());
		header("Location: home.php");
		ob_end_flush();
	}

  ?><p>&nbsp;</p>
	</th>
  </tr>
</table>
</body>
</html>