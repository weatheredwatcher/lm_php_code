<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>LeveragedMedia BackOffice</title>
  <!--LeveragedMedia BackOffice System Version 0.01b -->
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
  <link href="stylesheets/thickbox.css" rel="stylesheet" type="text/css" />
		<script src="javascript/jquery-1.3.2.min.s" type="text/javascript"></script>
		<script src="http://cdn.jquerytools.org/1.1.2/jquery.tools.min.js"></script>
		
		<script src="javascript/thickbox.js" type="text/javascript"></script>
	
        </head>
    <body>
        <?php
        include("includes/global-inc.php");
        include("includes/dbconnect.php");
		include("includes/global-class.php");
       	ini_set('display_errors',1);
		/**
		Here are the error handling hooks
		*/
		//error_reporting(E_ALL|E_STRICT);
        set_error_handler("myErrorHandler");
        ?>
        <div id="header">
            <a href="index.php"><img src="images/header.png" alt="LeveragedMedia" /></a>
        </div>
        <div id="main">
        <?php
        
    $id = $_GET['id'];
    
        

if (!isset($id)){

$id = "main";

}

include($id.'.php');
        ?>
        </div>
       
 		<div id="menu">
            <ul> 
            	<li><a href="?id=billing_managment">Billing Management</a></li>
                <li><a href="?id=email">Email Campaign</a></li>
                <li><a href="?id=admin">Archive Management</a></li>
                <li><a href="?id=software">Software Management</a></li>
                <li><a href="?id=logger">System Logs</a></li>
				<li><a href="?id=manage_logos">Image and Logo Managment</a></li>
            </ul>
        </div>
        
    </body>
</html>
