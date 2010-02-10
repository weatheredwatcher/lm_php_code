<?php
include_once 'includes/csv_reader.php';
include_once 'includes/dbconnect.php';

$billingSubject = $_GET['subject'];
$client_id = $_GET['id'];
$query = 'SELECT customer_list FROM tbl_clients WHERE client_id = '.$client_id.' AND subject_human="'.$billingSubject.'"';
$results=(mysql_query($query))or die(mysql_error());
while($row=mysql_fetch_row($results)){
$csv_file = 'uploads/'.addslashes($row[0]);

echo ("<a href=\"$csv_file\">$row[0]</a>");

}
?>
