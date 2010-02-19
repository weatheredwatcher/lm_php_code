<?php
/**
*  FILENAME: topic_form.php
*  DESCRIPTION: This file allows for the editing and adding of topics
*
*
*/
include_once('includes/dbconnect.php');


$results=mysql_query("SELECT * FROM tbl_topics ORDER BY id");


?>
<a href="?id=email"><img src="images/back.png" width="62" border="0"/></a>
<img src="images/topics.png" width="62" />
<h2>Email Topics List</h2>
<a href="add_topic.php?keepThis=true&TB_iframe=true&height=500&width=800" title="Add New Topic" class="thickbox">Add New Email</a> | Test Email
<table>
 <?php
while($row=mysql_fetch_row($results)){
	$topicID = $row[0];
	$topicSubject = $row[1];
	?>
  
<tr><td><?=$topicID?></td><td><?=$topicSubject?></td><td><a href="view_topic.php?topic=<?=$topicID?>&keepThis=true&TB_iframe=true&height=500&width=800" title="<?=$topicSubject?>" class="thickbox">VIEW</a></td><td><a href="edit_topic.php?topic=<?=$topicID?>&keepThis=true&TB_iframe=true&height=500&width=800" title="<?=$topicSubject?>" class="thickbox">EDIT</a></td></tr><?php 
} 
?>
</table>


