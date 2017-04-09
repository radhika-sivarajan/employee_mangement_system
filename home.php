<?php

include_once("config.php");
doCSS();
// Check user logged in already:
checkLoggedIn("yes");
//print $_SESSION["lastName"];
?>
<html>
<head>
<title>Home</title>

<?php doCSS(); ?>
<style type="text/css">
<!--
.style1 {
	font-size: 25px;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000099;
}
.style4 {font-size: 18px; font-weight: bold; color: #660000; }
.style5 {font-size: 20px; font-weight: bold; color: #FF0066; }
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
    <td width="285">&nbsp;</td>
    <td width="450"><center><span class="style1">HOME</span>
    </center></td>
    <td width="251"><div align="right"><?php print("<a href=\"logout.php"."\"><b>Logout</b></a>");	?></div></td>
  </tr>
</table>
<table width="1000" border="0" align="center" background="Diagrams/employee.jpg" height="300">
  <tr><td width="360">&nbsp;</td>
    <th width="266"><table width="200" border="0" align="center">
	      <tr>
        <th scope="row"><?php
if($_SESSION["administrator"]=='1'){
	print("<center>");
	print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
	print("<tr>");
	print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"manageuser.php\">Manage users</a></th>");
	print("</tr>");
	print("</table></center>");?></th>
		  </tr>
		  <tr>
			<th scope="row"><?php
	print("<center>");
	print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
	print("<tr>");
	print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"allusers.php\">All users</a></th>");
	print("</tr>");
	print("</table></center>");
}
?></th>
      </tr>
	  <tr>
        <th scope="row"><?php
print("<center>");
print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
print("<tr>");
print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"search.php\">Search employee</a></th>");
print("</tr>");
print("</table></center>");
?></th>
      </tr>
	  <tr>
        <th scope="row"><?php
if($_SESSION["administrator"]=='0'){
	print("<center>");
	print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
	print("<tr>");
	print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"myinfo.php\">My Information</a></th>");
	print("</tr>");
	print("</table></center>"); ?></th>
	    </tr>
		  <tr>
			<th scope="row"><?php
	print("<center>");
	print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
	print("<tr>");
	print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"payslip.php\">Salary Information</a></th>");
	print("</tr>");
	print("</table></center>");

}
?></th>
      </tr>
      <tr>
        <th scope="row"><?php
print("<center>");
print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
print("<tr>");
print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"leavehome.php\">Leave Information</a></th>");
print("</tr>");
print("</table></center>");

?></th>
      </tr>
	  <tr>
        <th scope="row"><?php
if($_SESSION["administrator"]=='0'){
?>
	<tr>
			<th scope="row"><?php
	print("<center>");
	print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
	print("<tr>");
	print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"commententer.php\">Enter comment</a></th>");
	print("</tr>");
	print("</table></center>");

	?></th>
	    </tr><?php
} ?>
	 <tr>
        <th scope="row"><?php
if($_SESSION["administrator"]=='1'){
?>
	<tr>
			<th scope="row"><?php
	print("<center>");
	print("<table width=\"242\" height=\"44\" border=\"1\" align=\"center\">");
	print("<tr>");
	print("<th bgcolor=\"#9DCEFF\" scope=\"row\"><a href=\"comment.php\">Comments</a></th>");
	print("</tr>");
	print("</table></center>");

	?></th>
	    </tr><?php
} ?>
    </table></th><td width="360">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
