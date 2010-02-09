<?php
//this moves the uploaded files to the correct place
require_once ('includes/csv_reader.php');
include 'includes/dbconnect.php';

$uploads = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/";
$approved = $uploads . 'ApprovedBilling.csv';


move_uploaded_file($_FILES['approved']['tmp_name'], $approved );

/**
This is where we need to build an approved table and a not-approved table
*/

$approvedSales = new CSV_Reader;
$approvedSales->strFilePath = 'uploads/ApprovedBilling.csv';
$approvedSales->strOutPutMode   =     1;  // 1 will show as HTML 0 will return an array

$approvedSales->setDefaultConfiguration();
$approvedSales->readTheCsv();
$sales_array = $approvedSales->arrOutPut;

foreach($sales_array as $customer_index => $value ){
    if($customer_index == 0){
    /* We do nothing*/ 
}
else {
//Internal ID,Customer Internal Id,Name,Email,Web Hosting Services,Item Pricing Level,Company Name,Billing State/Province
$date= $data_array[$customer_index][1];
$ammount = $data_array[$customer_index][4];
$client_id = $data_array[$customer_index][5];
$company_name = $data_array[$customer_index][6];
$results = mysql_query("SELECT * FROM tbl_billing WHERE clientID = $client_id");
	while($row=mysql_fetch_row($results)){
		$billingCode = $row[2];
		$billingQuanity = $row[3];
		$subject = $row[4];
		$list = $row[5];
	}
}
?>

Continue on to <a href="?id=process_subscriber_lists">process subscriber lists</a>