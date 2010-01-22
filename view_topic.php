<?php
/**
*  FILENAME: view_topic.php
*  DESCRIPTION: loads the email data in a lightbox via iframe
*
*
*/
include_once('includes/dbconnect.php');
$topicID = $_GET['topic'];
$results=mysql_query("SELECT message FROM tbl_topics WHERE id=$topicID");
while($row=mysql_fetch_row($results)){
	$message = $row[0];
	
	}
	
?>
<html>
<body>
<?=$message?>
</body>
</html>