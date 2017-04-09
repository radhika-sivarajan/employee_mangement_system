<?php
	include_once("config.php");
	checkLoggedIn("yes");
	doCSS();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manage User</title><style type="text/css">
<!--
.style1 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FF00FF;
}
-->
</style></head>
<body background="Diagrams/bg.gif">
<p><center>
  <p><img src="Diagrams/College (3).jpg" width="1000" height="167" align="middle"></p>
  <table width="1000" border="0">
    <tr>
      <td width="284"><a href="home.php"><strong>Home</strong></a></td>
      <td width="418"><div align="center"><strong><span class="style1">Manage user</span></strong></div></td>
      <td width="284"><div align="right"><?php print("<a href=\"logout.php"."\"><b>Log out</b></a>");
	?></div></td>
    </tr>
  </table>
  <table width="1000" border="0" align="center" background="Diagrams/plasma-turbulence-web-background.jpg">
      <tr><th scope="row"><p><img src="Diagrams/gec.jpg" width="101" height="94"></p>
	<center><b>Govt: Engineering College Painavu<br>Idukki District, Pin: 685603</b></center><p>
	<?php
if($_SESSION["administrator"]=='1')
{
print("<center>");
print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
print("<tr>");
print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"adduser.php\">Add a new user</a></th>");
print("</tr>");
print("</table></center>");

print("<p>");

print("<center>");
print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
print("<tr>");
print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"salarymanage.php\">Manage salary</a></th>");
print("</tr>");
print("</table></center>");

print("<p>");

print("<center>");
print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
print("<tr>");
print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"editemp.php\">Edit employee information</a></th>");
print("</tr>");
print("</table></center>");
}
?>
<p>&nbsp;</p>
	</th></tr>
  </table>
  <p>&nbsp;</p>
</center></p>
</body>
</html>