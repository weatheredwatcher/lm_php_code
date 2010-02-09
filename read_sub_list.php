<?php
include_once 'includes/csv_reader.php';
include_once 'includes/dbconnect.php';
$client_id = $_GET['id'];
$results=(mysql_query("SELECT customer_list FROM tbl_clients WHERE client_id = $client_id"))or die(mysql_error());
while($row=mysql_fetch_row($results)){
$csv_file = 'uploads/'.addslashes($row[0]);

echo ("<a href=\"$csv_file\">Download CSV File</a>");

}
?>
