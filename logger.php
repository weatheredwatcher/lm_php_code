<?php
include 'includes/dbconnect.php';
$results = mysql_query("SELECT * FROM tbl_LOG ORDER BY id DESC");
$timestamps = mysql_query("SELECT DISTINCT(timstamp) FROM tbl_LOG");
$page_locations = mysql_query("SELECT DISTINCT(page_location) FROM tbl_LOG");

?>
<a href="?id=main"><img src="images/back.png" width="62" border="0"/></a>
<img src="images/logger.png" width="62" />
<h2>System Log</h2>

<div id="log">
<table border="1">
<tr><th>Page Location</th><th>Message</th><th>Timestamp</th></tr>	
	<?
	while($row=mysql_fetch_row($results)){

		$page_location = $row[1];
		$msg = $row[2];
		$timestamp = $row[3];
	?>
	<tr><td><?=$page_location?></td><td><?=$msg?></td><td><?=$timestamp?></td></tr>
	<?}?>
	</table>
	</div>