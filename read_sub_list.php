<?php
include_once 'includes/csv_reader.php';
include_once 'includes/dbconnect.php';
$client_id = $_GET['id'];
$results=(mysql_query("SELECT customer_list FROM tbl_clients WHERE client_id = $client_id"))or die(mysql_error());
while($row=mysql_fetch_row($results)){
$read     =     new CSV_Reader;
$read->strFilePath     =     'uploads/'.addslashes($row[0]);
$read->strOutPutMode   =     1;  // 1 will show as HTML 0 will return an array
/**
 * You must run this script to Set the essesntial Configuration
 */
$read->setDefaultConfiguration();
$read->readTheCsv();
$read->printOutPut(); // You can run this script or directly access $read->arrOutPut to get the output

//echo $row[2];
// $read->printOutPut(); // You can run this script or directly acces $read->arrOutPut to get the output
}
?>