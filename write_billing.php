<?php

$billing = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/billing.csv";                   //this is the combined billing file
if(file_exists($billing)){} else {
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
//$date = date('m/d/y');
if ($row[2] == 1){ $item = "Printing and Postage Fee"; }
if ($row[2] == 2){ $item = "Website Hosting"; }
if ($row[2] == 3){ $item = "Email Deployment Fee"; }
if ($row[2] == 4){ $item = "Monthly Subscription Fees"; }
$quantity = $row[3];
//$month = date('M');
$year = date('Y');
$sublist = $row[5];
$subject = $row[4];
$month = $row[6];
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

?>
<a href="uploads/billing.csv"><img src="images/BillingCSVLarge.png" width="600" height="152" border="0" alt="BillingCSVLarge"></a><br />
Click to continue on to <a href="?id=approve_sales">Approve Sales</a>, or come back via the billing managment page when the approval process is complete.