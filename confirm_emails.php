<a href="?id=email"><img src="images/back.png" width="62" border="0"/></a>
<img src="images/send_mail.png" width="62" />
<h2>Send Emails </h2>
<?php
include_once 'includes/dbconnect.php';
$results=mysql_query("select count(*), client_name from tbl_customers where email !='' group by client_name");
while($row=mysql_fetch_row($results)){

$email_count = $row[0];
$bus_name = $row[1];

echo("
<table border ='1' width='300px'>
<tr><td width='75%''>".$bus_name."</td><td width='25%'>".$email_count."</td></tr>
</table>
");	

$total_count = $total_count + $email_count;
}
?>
<br />
<?php if($total_count == 0):
echo ("<p>There are no emails to be sent");
echo "<br />";
echo "<br />";
echo "<img src='images/SendEmailLarge.png' alt='Send Emails' border='0'/>";

else:
?>
<p>You are about to send emails to <?=$total_count?> customers. </p>
<br />
<br />
<a href="?id=send_emails.php" border="0"><img src="images/SendEmailLarge.png" alt="Send Emails" border="0"/></a>
<?
endif;
?>