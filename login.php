<?php
ob_start();
include_once("config.php");
// Check user not logged in already:
checkLoggedIn("no");
	// if $submit variable set, login info submitted:
	if(isset($_POST["submit"])) {
		field_validator("login name", $_POST["login"], "alphanumeric", 4, 15);
		// password must be between 4 and 15 chars - any characters can be used:
		field_validator("password", $_POST["password"], "string", 4, 15);

		// if there are $messages, errors were found in validating form data
		if($messages){
			doIndex();
			// note we have to explicity 'exit' from the script, otherwise
			// the lines below will be processed:
			exit;
		}

		// OK if we got this far the form field data was of the right format;
		// now check the user/pass pair match those stored in the db:
		/*
		If checkPass() is successful (ie the login and password are ok),
		then $row contains an array of data containing the login name and
		password of the user.
		If checkPass() is unsuccessful however, $row will simply contain
		the value 'false' - and so in that case an error message is
		stored in the $messages array which will be displayed to the user.
		*/
		if( !($row = checkPass($_POST["login"], $_POST["password"])) ) {
			// login/passwd string not correct, create an error message:
			$messages[]="Incorrect login/password, try again";
		}

		/*
		If there are error $messages, errors were found in validating form data above.
		Call the 'doIndex()' function (which displays the login form) and exit.
		*/
		if($messages){
			doIndex();
			exit;
		}

		/*
		If we got to this point, there were no errors - start a session using the info
		returned from the db:
		*/
		cleanMemberSession($row["login"], $row["password"]);

		// and finally forward user to members page (populating the session id in the URL):
		header("Location: home.php");
	} else {
		// The login form wasn't filled out yet, display the login form for the user to fill in:
		doIndex();
	}

	/*
	This function displays the default 'index' page for this script.  This consists of just a simple
	login form for the user to submit their username and password.
	*/
	function doIndex() {
		/*
		Import the global $messages array.
		If any errors were detected above, they will be stored in the $messages array:
		*/
		global $messages;

		/*
		also import the $title for the page - note you can normally just declare all globals on one line
		- ie:
		global $messages, $title;
		*/
		global $title;

		// drop out of PHP mode to display the plain HTML:
?>

<html>
<head>
<title>Employee Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
div.ex
{
direction:inherit;
width:250px;
height:200px;
background-color:#FEC7CF;
padding:10px;
border:2px solid gray;
margin:1px;
border-color:#F91543;
}
.style1 {
	font-size: xx-large;
	font-weight: bold;
	color: #F72449;
}
.style2 {color: #820000}
.style3 {font-size: 15px; font-style: italic; color: 'purple'; }
</style></head>
<body>
<table width="1197" height="500" border="0" align="center">
  <tr><td width="883" height="114" background="Diagrams/college (1).jpg"></td>
    <td >&nbsp;</td>
    <td width="273">&nbsp;</td>
  </tr>
  <tr><td height="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="344" background="Diagrams/ems.jpg"></td>
    <td>&nbsp;</td>
    <td><form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST" align=right>
      <div class="ex">
        <center>
          <h1 class="style2">Log in</h1>
          <table width="231" border="0">
            <tr>
              <th width="63" height="36" scope="row"><div align="left">User id </div></th>
              <td width="158">:
                <input type="text" name="login" value="<?php print isset($_POST["login"]) ? $_POST["login"] : "" ; ?>" maxlength="15"></td>
            </tr>
            <tr>
              <th height="37" scope="row"><div align="left">Password </div></th>
              <td>:
                <input type="password" name="password" value="" maxlength="15"></td>
            </tr>
          </table>
          <p>
            <input name="submit" type="submit" value="Sign in">
          </center>
      </div>
    </form><div class="style3">
        <center><?php
//Check if $message is set, and output it if it is:
if(!empty($messages)){
	displayErrors($messages);
}
?></center></div></td>
  </tr>
</table>
</body>
</html>
<?php
}
ob_end_flush();
?>

