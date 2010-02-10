<?php
include 'includes/dbconnect.php';

$id = $_GET['id'];
$billingCode = $_GET['code'];
$billingSubject = $_GET['subject'];
$amount = $_GET['amount'];

$query='UPDATE tbl_billing SET billingQuanity='.$amount.' WHERE clientID='.$id.' AND billingCode='.$billingCode.' AND billingSubject="'.$billingSubject.'"';

switch($billingCode){
	case 1:
		$query2='UPDATE tbl_clients SET phys_address='.$amount.' WHERE client_id='.$id.' AND subject_human="'.$billingSubject.'"';
		break;
	case 3:
		$query2='UPDATE tbl_clients SET email_address='.$amount.' WHERE client_id='.$id.' AND subject_human="'.$billingSubject.'"';
		break;
}
mysql_query($query);
mysql_query($query2);
?>

Success!  Press ESC to close