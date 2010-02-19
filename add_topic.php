<?php
$message = "<h2 align=\"center\" style=\"text-transform: uppercase; font-family:Arial; font-weight:bold;\">Main Header Goes Here</h2>
<p>

</p>";

?>
<html>
<body>
<h4>Common Tags(Copy from here and paste into your document):</h4>
<table>
<tr><td>The Paragraph Tag: &lt;p&gt;&lt;/p&gt;</td><td>Bold: &lt;strong&gt;&lt;/strong&gt;</td><td>List Items: &lt;li&gt;&lt;/li&gt;</td></tr>
<tr><td>Insert a Link: &lt;a href="http://"&gt;&lt;/a&gt;</td><td>Un-Ordered List: &lt;ul&gt&lt;/ul&gt;</td></tr>
</table>


<hr />
<form name="update" action="update_new_topic.php" class="thickbox">
Topic<input type="text" name="topicID" />
Subject<input type="text" id="subject" name="subject" value="<?=$subject?>" /><br />
Message<textarea name="message" cols="150" rows="25" id="messageBody" style="font-size:12px"><?=$message?></textarea>
<input type="submit" name="submit" id="submit" title="Submit" />
</form>

</body>
</html>



