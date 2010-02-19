<?php
/**
*
* Moves the upoaded files and renames them. Checks the paths to make sure that files are present (or in the case of billing.csv, not present)
*
*/

$uploads = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/";
$webhosting = $uploads . 'WebHostingBilling.csv';
$marketing = $uploads . 'MarketingBilling.csv';
$lists = $uploads . 'subscriberLists.zip';
move_uploaded_file($_FILES['webhosting']['tmp_name'], $webhosting );
move_uploaded_file($_FILES['marketing']['tmp_name'], $marketing );

$subscriber = $uploads . basename($_FILES['lists']['name']);
move_uploaded_file($_FILES['lists']['tmp_name'], $subscriber );
//unzips the subscriber lists
$zip = new ZipArchive;
$res = $zip->open($subscriber);
if ($res === TRUE){
echo 'Subscriber Lists Extracted.....OK <br />';
$zip->extractTo('uploads');
$zip->close();
}
else{
echo 'Subscriber Lists Extracted.....failed, code:' .$res.'<br />';
}

$webBilling = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/WebHostingBilling.csv";      //this is the website billing file
$marketingBilling = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/MarketingBilling.csv"; //this is the mail and email marketing billing file
$billing = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/billing.csv";                   //this is the combined billing file
$ApprovedBilling = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/ApprovedBilling.csv";                   //this is the combined billing file

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


The files needed to process billing have been uploaded. Please click on <a href="?id=process_billing">Process Billing</a> to continue