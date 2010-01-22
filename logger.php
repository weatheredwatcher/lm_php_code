<?php
/*
	TODO Need to access the log db and place the data here in an easy to use format
	Thinking of showing a dump, then offering a drop-down with various pages on the log to jump straight to that page log hits
*/
include 'includes/dbconnect.php';
$results = mysql_query("SELECT * FROM tbl_LOG ");
$timestamps = mysql_query("SELECT DISTINCT(timstamp) FROM tbl_LOG");
$page_locations = mysql_query("SELECT DISTINCT(page_location) FROM tbl_LOG");

?>

<h2>System Log</h2>

<table>
	<tr><td></td></tr>
	</table>