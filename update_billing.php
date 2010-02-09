<?php
include 'includes/dbconnect.php';

$id = $_GET['id'];
$billingCode = $_GET['code'];
$billingSubject = $_GET['subject'];
$amount = $_GET['amount'];

$query='UPDATE tbl_billing SET billingQuanity='.$amount.' WHERE clientID='.$id.' AND billingCode='.$billingCode.' AND billingSubject="'.$billingSubject.'"';

mysql_query($query);

?>

Success!  Press ESC to close