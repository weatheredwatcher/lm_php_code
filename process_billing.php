<?php
/**
*  Billing Process File
*  Loads the files from the uploads folder and
*  processes the billing information
*  Outputs billing.csv
**
*/
require_once ('includes/csv_reader.php');
if(isset($_POST['submit'])){
	editBilling();
}

else {
//sets up the variables before we process the billing
$webBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/WebHostingBilling.csv";      //this is the website billing file
$marketingBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/MarketingBilling.csv"; //this is the mail and email marketing billing file
$billing = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/billing.csv";                   //this is the combined billing file
//checks to make sure files exist

if(file_exists($webBilling) && file_exists($marketingBilling)){

}
else {echo("
<script>alert('Error! ".$webBilling." or ".$marketingBilling."  Not Found.  Please Contact a System Administrator') </script>

");}

if(file_exists($billing)){
echo("
<script>alert('Error!  File Already Exists!  Please Contact a System Administrator') </script>
");


}
else {
/**

 Begins the process of parsing the csv files and dumping the data in the database 

*/


$readMarketingBilling     =     new CSV_Reader;
$readWebBilling     =     new CSV_Reader;

$readMarketingBilling->strFilePath     =     $marketingBilling;
$readMarketingBilling->strOutPutMode   =     0;  // 1 will show as HTML 0 will return an array
$readWebBilling->strFilePath     =     $webBilling;
$readWebBilling->strOutPutMode   =     0;  // 1 will show as HTML 0 will return an array
/**
  You must run this script to Set the essesntial Configuration
 */ 
$readMarketingBilling->setDefaultConfiguration();
$readMarketingBilling->readTheCsv();
$readWebBilling->setDefaultConfiguration();
$readWebBilling->readTheCsv();

$checkDate = $readMarketingBilling->arrOutput;
//$getMonth = $data_array[1][9];
//echo("<script>alert($getMonth);</script>");
//webBilling
$data_array = $readWebBilling->arrOutPut;

foreach($data_array as $customer_index => $value ){
    if($customer_index == 0){
    /* We do nothing*/ 
}
else {
//Internal ID,Customer Internal Id,Name,Email,Web Hosting Services,Item Pricing Level,Company Name,Billing State/Province
$intID= $data_array[$customer_index][0];
$client_id= $data_array[$customer_index][1];
$name= addslashes($data_array[$customer_index][6]);
$reply_email = $data_array[$customer_index][3];
if ($data_array[$customer_index][4] == "Yes"){
$webHosting = TRUE;
}
else {$webHosting = FALSE;}
$webColorPri = $data_array[$customer_index][8];
$webColorSec = $data_array[$customer_index][9];
$address1 = $data_array[$customer_index][10];
$address2 = $data_array[$customer_index][11];
$city = $data_array[$customer_index][12];
$state = $data_array[$customer_index][13];
$zip= $data_array[$customer_index][14];
$phone = $data_array[$customer_index][15];
$fax = $data_array[$customer_index][16];
$email = $data_array[$customer_index][17];
$weburl = $data_array[$customer_index][18];
$tagline = addslashes($data_array[$customer_index][19]);
$bus_type = $data_array[$customer_index][20]; 

$results=mysql_query("INSERT INTO tbl_web_billing (id, client_id, companyName, reply_email, webhosting, webColPri, webColSec, address1, address2, city, state, zip, phone, fax, email, weburl, tagline, bus_type) VALUES('$intID', '$client_id', '$name', '$reply_email', '$webHosting', '$webColorPri', '$webColorSec', '$address1', '$address2', '$city', '$state', '$zip', '$phone', '$fax', '$email', '$weburl', '$tagline', '$bus_type')")or die(mysql_error());
}
}
//end of webBilling


//marketingBilling



// $readMarketingBilling->printOutPut(); // You can run this script or directly acces $read->arrOutPut to get the output

$data_array = $readMarketingBilling->arrOutPut;

foreach($data_array as $customer_index => $value ){
    if($customer_index == 0){
    /* We do nothing*/ 
}
else {
//Internal ID,Customer Internal Id,Name,Subscriber List,# of Physical Addresses,# of Email Addresses,Month,Year,Subject,Subject Code
$intID= $data_array[$customer_index][0];
$client_id= $data_array[$customer_index][1];
$client= $data_array[$customer_index][11];  
$month= $data_array[$customer_index][9];
$year= $data_array[$customer_index][6];
$subject= $data_array[$customer_index][7];
$subscriber_list= $data_array[$customer_index][3];
$subject_code= $data_array[$customer_index][8]; 
/**
* This will pull the reply_email from the tbl_web_billing for the current client and use it as $reply_email
*/

$results = mysql_query("SELECT reply_email FROM tbl_web_billing WHERE client_id = $client_id"); 
while ($row=mysql_fetch_row($results)) {
	$email = $row[0];
}

$email_count = $data_array[$customer_index][5];
$address_count = $data_array[$customer_index][4];

mysql_query("INSERT INTO tbl_clients (client_id, client_name, month, year, subject_human, subject_code, customer_list, reply_email, email_address, phys_address) VALUES('$client_id', '$client', '$month', '$year', '$subject', '$subject_code', '$subscriber_list', '$email', '$email_count', '$address_count')")or die(mysql_error());


}
} //end of marketingBilling

//parse billing elements

//start initial billing
$webresults=mysql_query("SELECT * FROM  tbl_web_billing")or die(mysql_error());
while($webrow=mysql_fetch_row($webresults)){
$client_id = $webrow[1];
$webhosting = $webrow[6];
/*if ($webrow[5] == "SC"){ 
$isTaxable = 1;
} 
else { 
$isTaxable = 0;
}*/
mysql_query("INSERT INTO tbl_billing (clientID, billingCode, billingQuanity) VALUES('$client_id', '4', '1')")or die(mysql_error());

if ($webhosting == 1) {
mysql_query("INSERT INTO tbl_billing (clientID, billingCode, billingQuanity) VALUES('$client_id', '2', '1')")or die(mysql_error());
}//ends the webhosting check

}  //end initial billing

$results=mysql_query("SELECT * FROM  tbl_clients")or die(mysql_error());
while($row=mysql_fetch_row($results)){
$client_id = $row[1];
$email_address = $row[9];
$phys_address = $row[10];
$subject_human = $row[5];
$subscriberList = $row[7];
//if ($stateID == "SC"){ $isTaxable = 1;} else { $isTaxable = 0;}
//bills for email campaign
mysql_query("INSERT INTO tbl_billing (clientID, billingCode, billingQuanity, billingSubject, billingSubscriberList) VALUES('$client_id', '3', '$email_address', '$subject_human', '$subscriberList')")or die(mysql_error());
//bills for direct mail campaign
mysql_query("INSERT INTO tbl_billing (clientID, billingCode, billingQuanity, billingSubject, billingSubscriberList) VALUES('$client_id', '1', '$phys_address', '$subject_human', '$subscriberList')")or die(mysql_error());



} //ends the combine billing process

function writeBillingLines(){
$list = array (
	'Order Number,Customer Internal ID,Name,Item,Subscriber List,Qty,Month,Year,Subject,Item Pricing Level'
    );
    $fp = fopen($billing, "x");

    foreach ($list as $line) {
    fputcsv($fp, split(',', $line));
		}

//grabs the customer numbers from the client table
$clients=mysql_query("SELECT * FROM tbl_web_billing")or die(mysql_error());
while($clientrow=mysql_fetch_row($clients)){
$int_id = $clientrow[0];
$client_id = $clientrow[1];
$nameCompany = addslashes($clientrow[4]);
$nameCompany = ereg_replace(',', ' ', $nameCompany);
$myresults=mysql_query("SELECT * FROM tbl_billing WHERE clientID=$client_id");
while($row=mysql_fetch_row($myresults)){

$date = date('m-d-y');
$orderID = $row[1].'_'.$date;
$customerID = $row[1];
$date = date('m/d/y');
if ($row[2] == 1){ $item = "Printing and Postage Fee"; }
if ($row[2] == 2){ $item = "Website Hosting"; }
if ($row[2] == 3){ $item = "Email Deployment Fee"; }
if ($row[2] == 4){ $item = "Monthly Subscription Fees"; }
$quantity = $row[3];
//$month = date('M');
$year = date('Y');
$sublist = $row[5];
$subject = $row[4];
//Order Number,Name,Item,Subscriber List,Qty,Month,Year,Subject,Item Pricing Level,,,
$list = array (
    ''.$orderID.','.$int_id.','.$nameCompany.','.$item.','.$sublist.','.$quantity.','.$month.','.$year.','.$subject.'');
    foreach ($list as $line) {
    fputcsv($fp, split(',', $line));
			}
		}
	}
//ends billingOutput

fclose($fp);
}

$webBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/WebHostingBilling.csv";      //this is the website billing file
$marketingBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/MarketingBilling.csv"; //this is the mail and email marketing billing file
$billing = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/billing.csv";                   //this is the combined billing file
$ApprovedBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/ApprovedBilling.csv";                   //this is the combined billing file

//checks to make sure files exist
if(file_exists($webBilling)){$wb_exists = "EXISTS";}else {$wb_exists = "NOT FOUND";}
if(file_exists($marketingBilling)){$mb_exists = "EXISTS";}else {$mb_exists = "NOT FOUND";}
if(file_exists($billing)){$b_exists = "EXISTS";}else {$b_exists = "NOT FOUND";}
if(file_exists($ApprovedBilling)){$ab_exists = "EXISTS";}else {$ab_exists = "NOT FOUND";}
?>
<h2>This is the Billing Management Page</h2>
<table border="1">
<tr><td>WebHostingBilling.csv</td><td><?=$wb_exists?></td></tr>
<tr><td>MarketingBilling.csv</td><td><?=$mb_exists?></td></tr>
<tr><td>billing.csv</td><td><?=$b_exists?></td></tr>
<tr><td>ApprovedBilling.csv</td><td><?=$ab_exists?></td></tr>
</table>

<?php
}

include_once 'includes/dbconnect.php';
include_once 'includes/csv_reader.php';

$results=(mysql_query("SELECT id, client_id, client_name, customer_list, subject_human, email_address, phys_address FROM tbl_clients"))or die(mysql_error());

echo ("<form name=\"billing\" method=\"post\" action=\"?id=process_billing\"><table border=1><tr><th>ClientID</th><th>Client Name</th><th>List File</th><th>Topic Code</th><th>NS Address Count</th><th>BackOffice Address Count</th><th>NS Email Count</th><th>BackOffice Email Count</th><th>Do you want to Correct the Count?</th><tr>");
while($row=mysql_fetch_row($results)){
	$emailCount = 0;
	$addressCount = 0;
	
$read     =     new CSV_Reader;
$subject_code = $row[4];
$id = $row[0];
$client_id = $row[1];
$client_name = $row[2];
$email_address = $row[5];
$phys_address = $row[6];
$read->strFilePath     =     'uploads/'.addslashes($row[3]);
$read->strOutPutMode   =     1;  // 1 will show as HTML 0 will return an array
/**
 * You must run this script to Set the essesntial Configuration
 */
$read->setDefaultConfiguration();
$read->readTheCsv();
//$read->printOutPut(); // You can run this script or directly access $read->arrOutPut to get the output

//echo $row[2];
// $read->printOutPut(); // You can run this script or directly acces $read->arrOutPut to get the output
/*
	TODO Need to change this to only show when there is a descrepency in the total count
*/
$data_array = $read->arrOutPut;
$get_id=mysql_query("SELECT id from tbl_billing WHERE clientID = $client_id and billingSubject = $subject_code and billingCode = 3");
while($getrow=mysql_fetch_row($get_id)){
	$emailID = $getRow[0];
	
}
foreach($data_array as $customer_index => $value ){

if ($customer_index == 0){
//do nothing
	}
	else{

$address1 = addslashes($data_array[$customer_index][4]);
$address2 = addslashes($data_array[$customer_index][5]);
$email = $data_array[$customer_index][10];

if (strlen(trim($address1)) == 0) { 
	
	if (strlen(trim($address2)) == 0) {} else {
		$addressCount++;
	}
	
	}
else{
	$addressCount++;
}
if (strlen(trim($email)) == 0){ }
else{
	$emailCount++;
}
		}
	}
	if ($phys_address == $addressCount && $email_address == $emailCount){
		echo ("<tr>
					<td>$client_id</td><td>$client_name</td>
					<td><a href=\"read_sub_list.php?id=$client_id&keepThis=true&TB_iframe=true&height=500&width=950\" title=\"Subscriber List\" class=\"thickbox\">listfile</a></td>
					<td>$subject_code</td>
					<td>$phys_address</td>
					<td>$addressCount</td>
					<td>$email_address</td>
					<td>$emailCount</td>
					<td>
						
					</td>
			</tr>");
		
		
	}else{
		//<a href=\"read_sub_list.php?id=$client_id&keepThis=true&TB_iframe=true&height=500&width=950\" title=\"Subscriber List\" class=\"thickbox\">
	echo ("<tr>
				<td>$client_id</td><td>$client_name</td>
				<td><a href=\"read_sub_list.php?id=$client_id&keepThis=true&TB_iframe=true&height=500&width=950\" title=\"Subscriber List\" class=\"thickbox\">listfile</a></td>
				<td>$subject_code</td>
				<td>$phys_address</td>
				<td>$addressCount</td>
				<td>$email_address</td>
				<td>$emailCount</td>
				<td>
					<input alt=\"change_billing.php?id=$client_id&billingCode=1&billingSubject=$subject_code&keepThis=true&TB_iframe=true&height=250&width=400\" class=\"thickbox\" type=\"button\" name=\"address\" value=\"address\" />
					<input alt=\"change_billing.php?id=$client_id&billingCode=3&billingSubject=$subject_code&keepThis=true&TB_iframe=true&height=250&width=400\" class=\"thickbox\" type=\"button\" name=\"email\" value=\"Email\" />
				</td>
		</tr>");
	}
}
?>
<input type=submit name="submit" />
</table></form>
<?php
}
?>