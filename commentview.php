<?php
ob_start();
include_once("config.php");
doCSS();
global $link;
checkLoggedIn("yes");
$id = $_GET['id'];
$query="SELECT * FROM comments WHERE id='$id'";
$result=mysql_query($query, $link) or die("Died inserting extended employee details info into db.  Error returned if any: ".mysql_error());
$nt=mysql_fetch_array($result);
?>
<html>
<head>
<title>View comment</title>
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
.style3 {color: #0000CC}
-->
</style>
</head>
<body>
<table width="1000" border="0" align="center">
  <tr>
    <td width="1207"><img src="Diagrams/College (3).jpg" width="1000" height="167"></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="94"><a href="home.php"><strong>Home</strong></a></td>
	<td width="166"><span class="style3"><<</span><a href="comment.php"><strong>Back</strong></a></td>
    <td width="462"><div align="center"><strong><span class="style2">Read comment</span></strong></div></td>
    <td width="260"><div align="right"><a href="logout.php"><strong>Log out</strong></a></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" >
  <tr>
    <th background="Diagrams/plasma-turbulence-web-background.jpg"><p>&nbsp;</p>
      <table width="200" border="0" bgcolor="#FFFFFF">
        <tr>
          <td><?php echo $nt[comment]; ?></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </th>
  </tr>
</table>
 </body>
</html>