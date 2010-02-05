<?php
include_once 'includes/dbconnect.php';
include 'includes/csv_reader.php';

$results=(mysql_query("SELECT client_id, client_name, customer_list, subject_code, email_address, phys_address FROM tbl_clients"))or die(mysql_error());
$emailCount = 0;
$addressCount = 0;
echo ("<table border=1><tr><th>Client Name:</th><th>Email Count</th><th>Email Billed</th><th>Address Count</th><th>Address Billed</th><tr>");
while($row=mysql_fetch_row($results)){
$read     =     new CSV_Reader;
$subject_code = $row[3];
$client_id = $row[0];
$client_name = $row[1];
$email_address = $row[4];
$phys_address = $row[5];
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


$address1 = addslashes($data_array[$customer_index][4]);
$address2 = addslashes($data_array[$customer_index][5]);
$email = $data_array[$customer_index][10];

if (strlen(trim($address1)) == 0 || strlen(trim($address2)) == 0) { }
else{
	$addressCount++;
}

if (strlen(trim($email)) == 0){ }
else{
	$emailCount++;
}
		}
	}
	
	echo ("<tr><td><a href=\"read_sub_list.php?id=$client_id&keepThis=true&TB_iframe=true&height=500&width=950\" title=\"Subscriber List\" class=\"thickbox\">$client_name</a></td><td>$emailCount</td><td>$email_address</td><td>$addressCount</td><td>$phys_address</td></tr>");

}
?>
</table>
