<?php
/**
This is the login form file for logging into the system
*/

include 'includes/dbconnect.php';
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
$pullUsername = mysql_query("SELECT username, password from tbl_login where username = $username");	
	
	
	
	
	
	
}else{}
?>

<form method="post" action="login.php">
	<input type="text" name="username" />
	<input type="password name="password" /">
	<input type="submit" name="submit" value="Submit" />
</form>