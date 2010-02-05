<?php
/**
This is the file that will generate the customer Data file for Trevitts
*/
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

?>


<a href="uploads/tbl_customers.csv"><img src="images/DownloadsLarge.png" alt="DownloadsLarge" border="0" /></a>
2

