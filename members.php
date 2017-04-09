<?php
include_once("config.php");

// Check user logged in already:
checkLoggedIn("yes");
doCSS();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logout</title>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 18px;
}
-->
</style>
</head>
<body background="Diagrams/bg.gif"><center>
    <div class="a">
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><?php print("Hello user <b>".$_SESSION["login"]."</b><br>\n"); ?> </p>
      <table width="367" border="0">
        <tr>
          <th scope="row"><span class="style1">Before you leave you have to logout</span></th>
        </tr>
        <tr>
          <th height="91" scope="row"><table width="158" height="37" border="1" bordercolor="#CC0099" bgcolor="#F993F7">
              <tr>
                <th scope="row"><?php print("<a href=\"logout.php"."\">Logout</a>");?></th>
              </tr>
          </table></th>
        </tr>
      </table>
    </div>
    <p>&nbsp;</p>
</center>
</body>
</html>
