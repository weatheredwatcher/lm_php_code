<?php
require_once('includes/dbconnect.php');
$results=mysql_query("SELECT * FROM tbl_clients");
header("Content-Type: text/xml");
print ("<?xml version=\"1.0\" ?>\n");
print ("<clients>\n");
while($row=mysql_fetch_row($results)){
$clientID = $row[1];
$getCompanyName=mysql_query("SELECT companyName FROM tbl_web_billing WHERE client_id=$clientID");
while($companyRow=mysql_fetch_row($getCompanyName)){
$clientName = $companyRow[0];}
$domainAlias = "";
$replyEmail = $row[8];
$subjectCode = $row[6];
$email_address = $row[9];
if($email_address <= 0) { //do nothing 
} else{
//begin loop client
print (" <client>\n");
print (" <clientname>".$clientName."\n</clientname>");
print (" <domainalias>".$domainAlias."\n</domainalias>");
print (" <messagesettings>\n");
print (" <senddate>\n</senddate>");
print (" <from address='".$replyEmail."' name='".$clientName."' />");
print (" <templateid>".$clientID."\n</templateid>");
print (" <messageid>\n".$subjectCode."</messageid>");
print (" </messagesettings>\n");
print (" <contacts>\n"); //start contacts loop
$customer_results=mysql_query("SELECT * FROM tbl_customers WHERE client_id = $clientID AND subject_code = $subjectCode");
while($cus_row=mysql_fetch_row($customer_results)){
$customer_email = $cus_row[15];
$customer_name = $cus_row[5];
if (strlen(trim($customer_email)) == 0){ //do nothing 
} else {
print (" <contact>\n");
print (" <email>".$customer_email."\n</email>");
print (" <firstname>".htmlspecialchars($customer_name)."\n</firstname>");
print (" </contact>\n");}
}
print (" </contacts>\n"); //end contacts loop
print (" </client>\n");}}
//client loop ends
print ("</clients>\n");

?>
