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
<table>
 <?php
while($row=mysql_fetch_row($results)){
	$topicID = $row[0];
	$topicSubject = $row[1];
	?>
  
<tr><td><?=$topicSubject?></td><td><a href="view_topic.php?topic=<?=$topicID?>&keepThis=true&TB_iframe=true&height=500&width=800" title="<?=$topicSubject?>" class="thickbox">VIEW</a></td><td><a href="edit_topic.php?topic=<?=$topicID?>&keepThis=true&TB_iframe=true&height=500&width=800" title="<?=$topicSubject?>" class="thickbox">EDIT</a></td></tr><?php 
} 
?>
</table>


