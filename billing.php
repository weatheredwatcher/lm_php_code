<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
<form enctype="multipart/form-data" action="?id=billing_upload" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        WebHostingBilling.csv: <input name="webhosting" id='web' type="file" /><br />
        MarketingBilling.csv: <input name="marketing" id='market' type="file" /><br />
		Subscriber Lists: <input name="lists" id='lists' type="file" /><br />
        <input type="submit" name="submit" value="Click here to Upload Files" />
    </form>



