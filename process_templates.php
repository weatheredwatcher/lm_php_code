<?php
/**
* PROGRAM: process_template.php
* DESCRIPTION: Creates a template file for the LisTrak email system
*              Pulls client information out of the database and
*              auto populates the xml data. After Running, make sure you save this file
*              as an xml file in the format of template_id.xml.  The template is required 
*              and the id after the underscore can be any combination of numbers and letters.
*
*  CREATED BY:David Duggins for Leveraged Media
*  COPYRIGHT: Leveraged Media 2009
*  CREATION DATE: 12/19/2009
*  LAST UPDATED: 12/22/2009
*
*
*  SYSTEM NOTES:
*
*       This file contains two blocks of code that must be updated to keep the script working.
*       The first block is labeled DEFINE SERVER PATH and contains a single variable that sets
*       the server path.  The second block is labeled DEFINE INDUSTRIES BLOCK and contains a 
*		series of if statements that define the various industries that are represented.
*
*		A third maintanable block exists in the event that another industry besides PUROCLEAN needs two logos
*		This code exists between the td blocks labeled as logo2. 
*
*     		<?php if ($bus_type == 200): ?>
*			<img src="<?=$IMAGE_SERVER?>Logo2_<?=$clientID?>.png" />
*			<?php endif; ?>
*
*		If you need to add another industry to this block, you can copy and paste this block directly 
*		after itself, changing the number from 200 to the correct idustry code in the copied block.
*/

include_once('includes/dbconnect.php');


/** DEFINE SERVER PATH 
*
* You must define the image path including the full url here.
* This variable is called whenever a server resource is needed in
* the email */

//$IMAGE_SERVER = "http://leveragedmedia.net/logos/";
$IMAGE_SERVER = "http://tinyurl.com/ydp4f7p/";
/*************************************************************************/



$templateXML = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";

$templateXML .= "<root>\n";
$templateXML .= "<messages>\n";

	$messages=mysql_query("SELECT * FROM tbl_topics");
	while($message_row=mysql_fetch_row($messages)):
	$messageID = $message_row[0];
	$messageTitle = $message_row[1];
	$messageBody = $message_row[2];
	
$templateXML .= "<message>\n";
$templateXML .= "<id>$messageID</id>\n";
$templateXML .= "<subject><![CDATA[$messageTitle]]></subject>\n";
$templateXML .= "<messagetext><![CDATA[\n";
$templateXML .= "<table id=\"main_body\" width=\"700px\" style=\"font-family:Times New Roman;\">";
$templateXML .= "<tr>";
$templateXML .= "<td height=\"532\" rowspan=\"4\">$messageBody</td>";
$templateXML .= "<td valign=\"top\" align=\"right\" width=\"203px\">";
$templateXML .= "<img src=\"$IMAGE_SERVER"."image_lrg_$messageID.png\" width=\"203\" height=\"354\" alt=\"\" />";
$templateXML .= "</td>";
$templateXML .= "</tr>";
$templateXML .= "<tr>";
$templateXML .= "<td valign=\"top\" align=\"right\"><img src=\"$IMAGE_SERVER"."image_sml_$messageID.png\" alt=\"\" />";
$templateXML .= "</td>";
$templateXML .= "</tr>";
$templateXML .= "</table>\n";
$templateXML .= "]]></messagetext>\n";
$templateXML .= "</message>\n";
	 
	endwhile; 
	 
$templateXML .= "</messages>\n";
$templateXML .= "<templates>\n";

print ("\n");
$results=mysql_query("SELECT DISTINCT(client_id) FROM tbl_clients");
while($row=mysql_fetch_row($results)){
$clientID = $row[0];
$fieldset=mysql_query("SELECT companyName, webColPri, webColSec, address1, address2, city, state , zip, phone, fax, email, weburl, tagline, bus_type FROM tbl_web_billing WHERE client_id = $clientID")or die(mysql_error());
$newrow=mysql_fetch_row($fieldset);
$client_name = $newrow[0];
$webColorPri = $newrow[1];
$webColorSec = $newrow[2];
$address1 = $newrow[3];
$address2 = $newrow[4];
$city = $newrow[5];
$state = $newrow[6];
$zip = $newrow[7];
$phone = $newrow[8];
$fax = $newrow[9];
$email = $newrow[10];


$newurl = $newrow[11];
$weburl = str_replace("http://", " ", $newurl);
$tagline = $newrow[12];

/** DEFINE INDUSTRIES BLOCK
*
* When you add a new industry, you must also add a new if statement 
* to this block in the format of if($newrow[13] =="INDUSTRY NAME"){$bus_type = ###;}
* Where INDUSTRY NAME is the exact industry name from the NetSuite custom field and ### 
* is the three digit bus_type number 
*/

if($newrow[13] == "PEST CONTROL"){$bus_type = 101; $body_font = "Times New Roman";}
if($newrow[13] == "PUROCLEAN"){$bus_type = 200; $body_font = "Arial";}

/*End Define Industries*/



$templateXML .= "<template>\n";
$templateXML .= "<id>$clientID</id>\n";
$templateXML .= "<htmlbody>\n";
$templateXML .= "<![CDATA[\n";
$templateXML .= "<html>";
$templateXML .= "<head>";
$templateXML .= "<title></title>";
$templateXML .= "</head>";
$templateXML .= "<body>";
$templateXML .= "<table width=\"800px\">";
$templateXML .= "<tr id=\"header_top\">";
$templateXML .= "<td id=logo1><img src=\"$IMAGE_SERVER"."logo1_$clientID.png\" /></td>";
						//if the bus_type is not 200, we load the tagline 
$templateXML .= "<td id=\"tagline\" valign=\"bottom\" style=\"font-family:Arial Bold>";
 if ($bus_type == 200){} else { 
	$templateXML .= "<h2>$tagline</h2>";
	} 
$templateXML .= "</td>";

$templateXML .= "<td id=\"logo2\" align=\"right\">";
				
			if ($bus_type == 200):
$templateXML .= "<img src=\"$IMAGE_SERVER"."logo2_$clientID.png\" />";
			endif;
$templateXML .= "</td>";
$templateXML .= "</tr>";
$templateXML .= "</table>";
$templateXML .= "<table width=\"800px\">";
$templateXML .= "<tr id=\"header_bottom\">";
$templateXML .= "<td id=\"logo3\" colspan=\"5\" bgcolor=\"#$webColorPri\">";
$templateXML .= "<img src=\"$IMAGE_SERVER"."header_$bus_type.png\" />";
$templateXML .= "</td>";
$templateXML .= "</tr>";
$templateXML .= "</table>"; 
$templateXML .= "<table width=\"800px\">";
$templateXML .= "<tr id=\"body\" style=\"font-family:$body_font\">";
$templateXML .= "<td id=\"main\" width=\"700px\"><!--CONTENT--></td>";
$templateXML .= "<td id=\"side_bar\" rowspan=\"2\" bgcolor=\"#$webColorSec\" width=\"100px\">";
$templateXML .= "<img src=\"$IMAGE_SERVER"."s_sb.png\" />";
$templateXML .= "</td>";
$templateXML .= "</tr>";
$templateXML .= "<tr>";
$templateXML .= "<td id=\"footer\" colspan=\"3\" align=\"center\" style=\"font-family:Arial Bold;\">";
$templateXML .= "<br />";
$templateXML .= "<br />";
$templateXML .= "<p>$client_name<br />";
		
		if($address1 ==""){}else{$templateXML .= $address1."&nbsp;&bull;&nbsp;";}  // this code places the address block with
		if($address2 ==""){}else{$templateXML .= $address2."&nbsp;&bull;&nbsp;";}  // the appropriate bullets
		if($city ==""){}else{$templateXML .= $city.",";}
		if($state ==""){}else{$templateXML .= $state."&nbsp;&bull;&nbsp;";}		// if a field is not there, it is skipped
		if($zip ==""){}else{$templateXML .= $zip."<br />";}          // but the formatting remains consistant
		if($phone ==""){}else{$templateXML .= "p:".$phone."&nbsp;&bull;&nbsp;";}
		if($fax ==""){}else{$templateXML .= "f:".$fax."&nbsp;&bull;&nbsp;";}     // please use this format to add or change
		if($email ==""){}else{$templateXML .= $email."<br />";}      // any address data.
		if($weburl ==""){}else{$templateXML .= "<a href=".$newurl.">".$weburl."</a></p>";}
$templateXML .= "</td>";
$templateXML .= "</tr>";
$templateXML .= "</table>";
$templateXML .= "</body>";
$templateXML .= "</html>\n";
$templateXML .= "]]>\n";
$templateXML .= "</htmlbody>\n";
$templateXML .= "<textbody>\n";
$templateXML .= "<![CDATA[<!--CONTENT-->]]>\n";
$templateXML .= "</textbody>\n";
$templateXML .= "</template>\n";
} 
$templateXML .= "</templates>\n";
$templateXML .= "</root>";
print $templateXML;