<?php
/**
*  FILENAME: view_topic.php
*  DESCRIPTION: loads the email data in a lightbox via iframe
*
*
*/
include_once('includes/dbconnect.php');
$subject=$_GET['subject'];
$message=htmlentities($_GET['message']);
$topicID=$_GET['topicID'];
echo html_entity_decode($message);
?>
<hr />
Click Accept to save and cancel to return to editor.  <br />
<a href="write_new_topic.php?topic=<?=$topicID?>&subject=<?=$subject?>&message=<?=$message?>&keepThis=true&TB_iframe=true&height=500&width=800">Accept</a>&nbsp;&nbsp;
