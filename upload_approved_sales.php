<?php
//this moves the uploaded files to the correct place
include_once ('includes/csv_reader.php');
include 'includes/dbconnect.php';

$uploads = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/";
$approved = $uploads . 'ApprovedBilling.csv';


if(!isset($_FILES['approved'])){} else {
move_uploaded_file($_FILES['approved']['tmp_name'], $approved );
}
/**
This is where we need to build an approved table and a not-approved table
*/

$approvedSales = new CSV_Reader;
$approvedSales->strFilePath = 'uploads/ApprovedBilling.csv';
$approvedSales->strOutPutMode   =     1;  // 1 will show as HTML 0 will return an array

$approvedSales->setDefaultConfiguration();
$approvedSales->readTheCsv();
$data_array = $approvedSales->arrOutPut;
echo("<h1>Approved Sales:</h1>");
foreach($data_array as $customer_index => $value ){
    if($customer_index == 0){
    /* We do nothing*/ 
}
else {
//Internal ID,Customer Internal Id,Name,Email,Web Hosting Services,Item Pricing Level,Company Name,Billing State/Province
$date= $data_array[$customer_index][1];
$amount = $data_array[$customer_index][4];
$client_id = $data_array[$customer_index][5];
$company_name = $data_array[$customer_index][6];
$array[] = $client_id;
echo("<h2>$company_name($client_id):$date</h2><table>");
$results = mysql_query("SELECT * FROM tbl_billing WHERE clientID = $client_id");
	while($row=mysql_fetch_row($results)){
		
		$billingCode = $row[2];
		$billingName = getBillingCode($billingCode);
		$billingQuanity = $row[3];
		$subject = $row[4];
		$list = $row[5];
	echo("<tr><td>$billingName</td>");
		if($billingCode == 1){echo("<td>$billingQuanity</td><td>$subject</td><td>$list</td></tr>");}
		if($billingCode == 2){echo("<td>Active</td><td></td></tr>");}
		if($billingCode == 3){echo("<td>$billingQuanity</td><td>$subject</td><td>$list</td></tr>");}
		if($billingCode == 4){echo("<td>Active</td><td></td></tr>");}
	}
	echo("</table><br /><i>Total Ammount Billed</i>:$$amount <br /><br /><hr /><br />");
}
}
echo("<h1>Unapproved Sales:</h1>");
$myresults = mysql_query("SELECT DISTINCT clientID FROM tbl_billing");
	while($myrow=mysql_fetch_row($myresults)){
		$clientID = $myrow[0];
		
if (in_array($clientID, $array)) {
    // we skip
}
else {
//we write the UnApproved Lists out.
$nameResults = mysql_query("SELECT companyName FROM tbl_web_billing WHERE client_id = $clientID");
while($nameArray = mysql_fetch_row($nameResults)){
$companyName = $nameArray[0];	}
echo("<h2>$companyName($clientID)</h2><table>");
$moreResults = mysql_query("SELECT * FROM tbl_billing WHERE clientID = $clientID");

while($newrow=mysql_fetch_row($moreResults)){
	
	$billing_code = $newrow[2];
	$billing_quanity = $newrow[3];
	$billing_subject = $newrow[4];
	$mylist = $newrow[5];
	$billing_name = getBillingCode($billing_code);
	
	echo("<tr><td>$billing_name</td>");
	if($billing_code == 1){echo("<td>$billing_quanity</td><td>$billing_subject</td><td>$mylist</td></tr>");}
	if($billing_code == 2){echo("<td>Inactive</td><td></td></tr>");}
	if($billing_code == 3){echo("<td>$billing_quanity</td><td>$billing_subject</td><td>$mylist</td></tr>");}
	if($billing_code == 4){echo("<td>Inactive</td><td></td></tr>");}
}
echo("</table><br /><br /><hr /><br />");

}
}
?>

Continue on to <a href="?id=process_subscriber_lists">approve sales and process the subscriber lists</a>