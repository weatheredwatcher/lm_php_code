<?php
/**
This is the billing main page.  From here you will be able to go though the billing process, depending on what steps have already taken place
*/



$webBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/WebHostingBilling.csv";      //this is the website billing file
$marketingBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/MarketingBilling.csv"; //this is the mail and email marketing billing file
$billing = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/billing.csv";                   //this is the combined billing file
$ApprovedBilling = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/ApprovedBilling.csv";                   //this is the combined billing file
$cust_data = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/cust_data.csv";    
//checks to make sure files exist
if(file_exists($webBilling)){$wb_exists = "EXISTS"; $wb_link = "<a href=\"uploads/WebHostingBilling.csv\">WebHostingBilling.csv</a>";}else {$wb_exists = "NOT FOUND"; $wb_link = "WebHostingBilling.csv";}
if(file_exists($marketingBilling)){$mb_exists = "EXISTS"; $mb_link = "<a href=\"uploads/MarketingBilling.csv\">MarketingBilling.csv</a>";}else {$mb_exists = "NOT FOUND"; $mb_link = "MarketingBilling.csv";}
if(file_exists($billing)){$b_exists = "EXISTS"; $b_link = "<a href=\"uploads/billing.csv\">billing.csv</a>";}else {$b_exists = "NOT FOUND"; $b_link = "WebHostingBilling.csv";}
if(file_exists($ApprovedBilling)){$ab_exists = "EXISTS"; $ab_link = "<a href=\"uploads/ApprovedBilling.csv\">ApprovedBilling.csv</a>";}else {$ab_exists = "NOT FOUND"; $ab_link = "ApprovedBilling.csv";}
if(file_exists($cust_data)){$cd_link = "<a href=\"uploads/cust_data.csv\"><img src=\"images/DownloadsLarge.png\" alt=\"DownloadsLarge\" border=\"0\" /></a>";}else {$cd_link = "Customer Data File Not Found";}
//TODO:Menu needs to be made that display the billing steps
/*
	TODO Need to put in checks to make sure that you can only go one step at a time
*/
if(file_exists($billing)){
	
	
}
?>
<a href="?id=main"><img src="images/back.png" width="62" border="0"/></a>
<img src="images/billing.png" width="62" />
<h2>This is the Data Download Page</h2>
<table border="1">
<tr><td><?=$wb_link?></td><td><?=$wb_exists?></td></tr>
<tr><td><?=$mb_link?></td><td><?=$mb_exists?></td></tr>
<tr><td><?=$b_link?></td><td><?=$b_exists?></td></tr>
<tr><td><?=$ab_link?></td><td><?=$ab_exists?></td></tr>
</table>
<br />
<hr />
Click Here to Download the Data for Trevetts:
<?=$cd_link?>
