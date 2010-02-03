<?php
/*
This is the file that can take clients approved after the fact and prepare their lists

*/


$approvedSales = new CSV_Reader;
$approvedSales->strFilePath = 'uploads/CashApproved.csv';
$approvedSales->strOutPutMode   =     1;  // 1 will show as HTML 0 will return an array

$approvedSales->setDefaultConfiguration();
$approvedSales->readTheCsv();
$sales_array = $approvedSales->arrOutPut;

foreach($sales_array as $customer_index => $value ){
if ($customer_index == 0 ){
}//do nothing
else { 
$clientID = $value[5];
mysql_query("UPDATE tbl_clients SET billingStatus = 1 WHERE client_id = $clientID");
echo 'Billing Status Updated '.$clientID.'.....OK <br />';

$results=(mysql_query("SELECT client_id, client_name, customer_list, subject_code FROM tbl_clients WHERE client_id= $clientID "))or die(mysql_error());
while($row=mysql_fetch_row($results)){
$read     =     new CSV_Reader;
$subject_code = $row[3];
$client_id = $row[0];
$client_name = $row[1];
$read->strFilePath     =     'uploads/'.addslashes($row[2]);
$read->strOutPutMode   =     1;  // 1 will show as HTML 0 will return an array
/**
 * You must run this script to Set the essesntial Configuration
 */
$read->setDefaultConfiguration();
$read->readTheCsv();
//$read->printOutPut(); // You can run this script or directly access $read->arrOutPut to get the output

//echo $row[2];
// $read->printOutPut(); // You can run this script or directly acces $read->arrOutPut to get the output

$data_array = $read->arrOutPut;

foreach($data_array as $customer_index => $value ){
if ($customer_index == 0){
//do nothing
}
else{

$bus_name = addslashes($data_array[$customer_index][0]);
$bus_name = ereg_replace(',', ' ', $bus_name);
$prefix = $data_array[$customer_index][1];
$name_first = $data_array[$customer_index][2];
$name_last = $data_array[$customer_index][3];
$address1 = addslashes($data_array[$customer_index][4]);
$address2 = addslashes($data_array[$customer_index][5]);
$city = $data_array[$customer_index][6];
$template_id = $client_id;
$state = $data_array[$customer_index][7];
$zip = $data_array[$customer_index][8];
$date = $data_array[$customer_index][9];
$timestamp = strtotime($date);
$birthday = date('yymd' , $timestamp); // m/d/yy
$email = $data_array[$customer_index][10];
$message = $data_array[$customer_index][11];
if (strlen(trim($address1)) == 0 && strlen(trim($address2)) == 0 && strlen(trim($email)) == 0){ 
// do nothing 
} else {
mysql_query("INSERT INTO tbl_customers (client_id, client_name, template_id, subject_code, bus_name, prefix, name_first, name_last, address1, address2, city, state, zip, birthday, email, message) VALUES ('$client_id', '$client_name', '$template_id', '$subject_code', '$bus_name', '$prefix', '$name_first', '$name_last', '$address1', '$address2', '$city', '$state', '$zip', '$birthday', '$email', '$message') ");  
}
}
}
echo $subject_code.' Subscriber Lists '.$row[2].'.....OK <br />';

}
//turn table into csv file for trevets

$csvcreate = new CSVCreation();
$csvcreate->path = 'uploads/';

$csvcreate->createcsv('tbl_customers');

$PrinterData = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/tbl_customers.csv";              

//checks to make sure files exist
if(file_exists($PrinterData)){
echo 'Printer Data File Created.....OK';

}
else {
echo 'Printer Data File Created.....FAIL';
}


}
}


?>


<a href="uploads/tbl_customers.csv"><img src="images/DownloadsLarge.png" alt="DownloadsLarge" border="0" /></a>