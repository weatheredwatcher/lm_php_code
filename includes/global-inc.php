<?php
/** 
 file:global-inc.php
  content: This is the global functions include 
  Author: David Duggins
  Created:10/02/2009
  Updated:10/02/2009
 
  function list: (see each function for documentation)
  validEmail()
  send_email()
  upload_file
  get_file_dialog()
  myErrorHandler()
*/

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function login(){
	
	
}



function validEmail($email)

{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
   //   if ($isValid && !(checkdnsrr($domain,"MX") ||
// ↪checkdnsrr($domain,"A")))
  //    {
         // domain not found in DNS
     //    $isValid = false;
    //  }
   }
   return $isValid;
}


function send_mail($to, $subject, $message, $header){
//$to = "weatheredwatcher@gmail.com";
mail($to, $subject, $message, $header);

}

function upload_file($target_path) {
 /*This function will take a file and upload to the server
  * It passes the path to upload and returns a boolean TRUE or FALSE
  */
       $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

       $results=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
       $_SESSION['upload_file']=$_FILES['uploadedfile']['name'];
       echo $_SESSION['upload_file'];
       echo $_FILES['uploadedfile']['name'];
       return $results;
}

function get_file_dialog($referal_page) {
    /*this function shows a get file form. it passes the referal page and returns the file to be processed
     * as a global $_FILES
     */
   echo('
    <form enctype="multipart/form-data" action="?id='.$referal_page.'" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" name="submit" value="Click here to Upload File" />
</form>
');
}

function myErrorHandler($errno, $errstr, $errfile, $errline)
/**
*
* This is a collection of custom error handling procedures for the Leveraged Media System
* It is loaded in the main index file and overrides all error handling with the exception of fatal memory errors
*/
{
	$myLog = new Log;
	$myLog->set_page($_SERVER['PHP_SELF']);
    switch ($errno) {
    case E_USER_ERROR:
        $myLog->set_log("ERROR:[$errno] Fatal error on line $errline ");
	    $myLog->write_log();
    	exit(1);
        break;

    case E_USER_WARNING:
		$myLog->set_log("WARNING:[$errno] $errstr ");
    	$myLog->write_log();
        break;

    case E_USER_NOTICE:
	$myLog->set_log("NOTICE:[$errno] $errstr ");
	$myLog->write_log();
    break;

    default:
        $myLog->set_log("Unknown Error Type:[$errno] $errstr ");
    	$myLog->write_log();
		break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

function editBilling(){
/**
This is where we will start editing the billing based on the counts we processed earlier
We rely on the fact that POST is a global variable and therefore can be read here
*/	
	$results=mysql_query("SELECT client_id, subject_code, subject_human FROM tbl_clients");
	while($row=mysql_fetch_row($results)){
		$client_id = $row[0];
		$subject_code = $row[1];
		$subject_human = $row[2];
		$email_count = $_POST['email'.$client_id.'_'.$subject_code.''];
		$address_count = $_POST['email'.$client_id.'_'.$subject_code.''];
		echo $email_count; 
		echo ("<br />");
		echo $address_count;
	mysql_query("UPDATE billingQuantity VALUE =$email_count WHERE client_id = $client_id AND billingCode = 3 AND billingSubject = $subject_human");
	mysql_query("UPDATE billingQuantity VALUE =$address_count WHERE client_id = $client_id AND billingCode = 1 AND billingSubject = $subject_human");
	}
	
	
echo ("Write Billing data to <a href=\"?id=write_billing\">File</a>");	
	
}

function getBillingCode($code){
	
	switch($code){
	    case 1:
	        $name = "Direct Mail";
	        break;
	    case 2:
	        $name = "WebHosting";
	        break;
	    case 3:
	        $name = "Email";
	        break;
		case 4:
			$name = "Monthly Subscription";
			break;
		default:
			$name = "No Such Code";
			break;
	}
	
	return $name;
	
}

function truncateTables(){
	
	mysql_query("TRUNCATE LeveragedMedia.tbl_billing");
	mysql_query("TRUNCATE LeveragedMedia.tbl_customers");
	mysql_query("TRUNCATE LeveragedMedia.tbl_clients");
	mysql_query("TRUNCATE LeveragedMedia.tbl_web_billing");
	
	echo("<script>alert('All Tables Have Been Cleared');</script>");
}

function cleanUploads(){
	
	
	if ($handle = opendir('uploads/')) {
	  while (false !== ($file = readdir($handle))) {
	    if ($file != "." && $file != ".." && $file !=".archive" && $file != "") {
	     unlink('uploads/'.$file); 
	    }
	  }
	}
	  closedir($handle);
echo("<script>alert('All Files Have Been Cleared from Uploads');</script>");
}

function backupTables(){
	$host = 'localhost';
	$username = 'admin';
	$password = 'Password1';
	$database = 'LeveragedMedia';


	mysql_connect($host, $username, $password) or die(mysql_error());
	//echo "Connected to MySQL<br />";
	mysql_select_db($database) or die(mysql_error());
	
	$billing = "tbl_billing";
	$customers = "tbl_customers";
	$clients = "tbl_clients";
	$webBilling = "tbl_web_billing";
	$backupDir = 'archives/';
	
	$query1      = "SELECT * INTO OUTFILE 'archives/tbl_billing'.date().'.sql' FROM $billing";
	$query2      = "SELECT * INTO OUTFILE 'archives/tbl_customers'.date().'.sql' FROM $customers";
	$query3      = "SELECT * INTO OUTFILE 'archives/tbl_clients'.date().'.sql' FROM $clients";
	$query4      = "SELECT * INTO OUTFILE 'archives/tbl_web_billing'.date().'.sql' FROM $webBilling";
	
	$result1 = mysql_query($query1)or die(mysql_error());
	$result2 = mysql_query($query2)or die(mysql_error());
	$result3 = mysql_query($query3)or die(mysql_error());
	$result4 = mysql_query($query4)or die(mysql_error());
mysql_close();

	
	
	
}
?>
