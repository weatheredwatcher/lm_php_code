<?php
/**
*  FILENAME: view_topic.php
*  DESCRIPTION: loads the email data in a lightbox via iframe
*
*
*/
include_once('includes/dbconnect.php');
$topicID = $_GET['topic'];
$subject = $_GET['subject'];
$message = addslashes($_GET['message']);
mysql_query("INSERT INTO tbl_topics (id, title, message) VALUES ('$topicID', '$subject', '$message')")or die(mysql_error());

?>
<html>
<body>
The Topic has been written to the database

</body>
</html>