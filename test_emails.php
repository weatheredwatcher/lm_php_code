<?php
/* 
 
 * This is code generates the template and client xml files for the LisTrak system
 *
 *  Programmer: David Duggins <duggins@leveragedmedia.com
 *  Copyright 2010 Leveraged Media <http://www.leveragedmedia.com>
 */
include_once('includes/dbconnect.php');
include_once('includes/ftpconnect.php');
include_once('includes/email_includes.php');
$mailLog = new Log;
$mailLog->set_page($_SERVER['PHP_SELF']);
//ftp connection id is $conn_id
echo("<script>alert('Connected to the FTP Server');</script>");
$clientXML = testClients();  //this line is to make sure that the test email address is used for the test
$templateXML = getTemplate();
$uploads = $_SERVER{'DOCUMENT_ROOT'} . "/backoffice/uploads/";
$clientFile = "clients_".time().".xml";
$templateFile = "template_".time().".xml";
$clientFilePath = $uploads.$clientFile;
$templateFilePath = $uploads.$templateFile;
$client = fopen($clientFilePath, "x");
$template = fopen($templateFilePath, "x");
fwrite($client, $clientXML);
fwrite($template, $templateXML);
fclose($client);
fclose($template);
$client = fopen($clientFilePath, "r");
$template = fopen($templateFilePath, "r");

// try to upload $file
if (ftp_fput($conn_id, $clientFile, $client, FTP_BINARY)) {
    $mailLog->set_log("Successfully uploaded $file");
	$mailLog->write_log();
	$clientSlug = 1;
} else {
    $mailLog->set_log("Error uploading $file");
	$mailLog->write_log();
}

if (ftp_fput($conn_id, $templateFile, $template, FTP_BINARY)) {
    $mailLog->set_log("Successfully uploaded $file");
	$mailLog->write_log();
	$templateSlug = 1;
} else {
    $mailLog->set_log("Error uploading $file");
	$mailLog->write_log();
	
}

// close the connection
ftp_close($conn_id);  
if($clientSlug == 1 && $templateSlug == 1){
	$finalResult = "Done!";
}
else {
	$finalResult = "Done but with errors.  Please check the log for details.";
	
}

?>
<h2><?=$finalResult?></h2>
<p>