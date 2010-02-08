<?php
/**
This is the file that will generate the customer Data file for Trevitts
*/
//turn table into csv file for trevets
/*
	TODO Need to finalize a query to get Trevitts only the customers that it needs
*/
$cust_data = $_SERVER{'DOCUMENT_ROOT'} . "/LeveragedMedia/uploads/cust_data.csv"; 
if(file_exists($cust_data)){}else {  
$list = array (
	'CLIENTID, CLIENTNAME, TEMPLATEID, SUBJECTCODE, COMPANY, PRE, FIRSTNAME, LASTNAME, ADDRESS, ADD2, CITY, STATE, ZIP, BDAY, MESSAGE'
    );
    $fp = fopen($cust_data, "x");

    foreach ($list as $line) {
    fputcsv($fp, split(',', $line));
		}

//grabs the customer numbers from the client table
$results=mysql_query("SELECT * FROM tbl_customers")or die(mysql_error());
while($row=mysql_fetch_row($results)){
$client_id = $row[1];
$clientName = $row[2];
$templateId = $row[3];
$subjectCode = $row[4];
$company = $row[5];
$prefix = $row[6];
$firstname = $row[7];
$lastname = $row[8];
$address1 = $row[9];
$address2 = $row[10];
$city = $row[11];
$state = $row[12];
$zip = $row[13];
$bday = $row[14];
$message = $row[15];
//Order Number,Name,Item,Subscriber List,Qty,Month,Year,Subject,Item Pricing Level,,,
$list = array (
    ''.$client_id.','.$clientName.','.$templateId.','.$subjectCode.','.$company.','.$prefix.','.$firstname.','.$lastname.','.$address1.','.$address2.','.$city.','.$state.','.$zip.','.$bday.','.$message.'');
    foreach ($list as $line) {
    fputcsv($fp, split(',', $line));
			}
		}
	
//ends billingOutput

fclose($fp);
}
?>


<a href="uploads/cust_data.csv"><img src="images/DownloadsLarge.png" alt="DownloadsLarge" border="0" /></a>


