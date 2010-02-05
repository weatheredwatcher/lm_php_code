<?php
/**
This is the billing main page.  From here you will be able to go though the billing process, depending on what steps have already taken place
*/



$webBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/WebHostingBilling.csv";      //this is the website billing file
$marketingBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/MarketingBilling.csv"; //this is the mail and email marketing billing file
$billing = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/billing.csv";                   //this is the combined billing file
$ApprovedBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/ApprovedBilling.csv";                   //this is the combined billing file

//checks to make sure files exist
if(file_exists($webBilling)){$wb_exists = "EXISTS";}else {$wb_exists = "NOT FOUND";}
if(file_exists($marketingBilling)){$mb_exists = "EXISTS";}else {$mb_exists = "NOT FOUND";}
if(file_exists($billing)){$b_exists = "EXISTS";}else {$b_exists = "NOT FOUND";}
if(file_exists($ApprovedBilling)){$ab_exists = "EXISTS";}else {$ab_exists = "NOT FOUND";}

//TODO:Menu needs to be made that display the billing steps
/*
	TODO Need to put in checks to make sure that you can only go one step at a time
*/
if(file_exists($billing)){
	
	
}
?>
<a href="?id=main"><img src="images/back.png" width="62" border="0"/></a>
<img src="images/billing.png" width="62" />
<h2>This is the Billing Management Page</h2>
<table border="1">
<tr><td>WebHostingBilling.csv</td><td><?=$wb_exists?></td></tr>
<tr><td>MarketingBilling.csv</td><td><?=$mb_exists?></td></tr>
<tr><td>billing.csv</td><td><?=$b_exists?></td></tr>
<tr><td>ApprovedBilling.csv</td><td><?=$ab_exists?></td></tr>
</table>
<br />
<p>Here you will be guided through the Billing Process. Before you begin, please make sure that you have the following files:</p>
<ul>
<li>WebHostingBilling.csv</li>
<li>MarketingBilling.csv</li>
<li>The Subscriber Lists zipped up in a zip file</li>
</ul>
<!--
	TODO check if these files exist before allowing the link to be active
-->
<a href="?id=billing">Generate the Billing File</a>
<a href="?id=process_subscriber_lists">Approve the Sales</a>
<a href="?id=generate_data">Generate the Customer Data File </a>

