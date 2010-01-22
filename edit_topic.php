<?php
/**
*  FILENAME: view_topic.php
*  DESCRIPTION: loads the email data in a lightbox via iframe
*
*
*/
include_once('includes/dbconnect.php');
$topicID = $_GET['topic'];
$results=mysql_query("SELECT * FROM tbl_topics WHERE id=$topicID");
while($row=mysql_fetch_row($results)){
	$subject = $row[1];
	$message = $row[2];
		}
	
?>
<html>
<body>
<h4>Common Tags(Copy from here and paste into your document):</h4>
<table>
<tr><td>The Paragraph Tag: &lt;p&gt;&lt;/p&gt;</td><td>Bold: &lt;strong&gt;&lt;/strong&gt;</td><td>List Items: &lt;li&gt;&lt;/li&gt;</td></tr>
<tr><td>Insert a Link: &lt;a href="http://"&gt;&lt;/a&gt;</td><td>Un-Ordered List: &lt;ul&gt&lt;/ul&gt;</td></tr>
</table>


<hr />
<form name="update" action="update_topic.php" class="thickbox">
<input type="hidden" name="topicID" value=<?=$topicID?> />
Subject<input type="text" id="subject" name="subject" value="<?=$subject?>" /><br />
Message<textarea name="message" cols="150" rows="25" id="messageBody" style="font-size:12px"><?=$message?></textarea>
<input type="submit" name="submit" id="submit" title="Submit" />
</form>
<hr />
<?=$message?>
</body>
</html>



