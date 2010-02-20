<?php
/**
This is the page that manage the email logos and the images for the email topics
*/
if (isset($_POST['submit'])){
	$logodir = $_SERVER{'DOCUMENT_ROOT'} . "/logos";

	$images = $logodir . 'images.zip';
	move_uploaded_file($_FILES['images']['tmp_name'], $images );

	//unzips the subscriber lists
	$zip = new ZipArchive;
	$res = $zip->open($images);
	if ($res === TRUE){
	echo 'Images Extracted.....OK <br />';
	$zip->extractTo($logodir);
	$zip->close();
	unlink($images);
	}
	else{
	echo 'Images Extracted.....failed, code:' .$res.'<br />';
	unlink($images);
	}
	
	
	
}
?>
<h1>Logo/Image Managment</h1>
<p>Images: Please note that all images must be in the following formats </p>
<ul>
	<li>Header Image:header_<i>industry number</i>.png</li>
	<li>Large Image: image_lrg_<i>topic id</i>.png</li>
	<li>Small Image: image_sml_<i>topic id</i>.png</li>
	<li>Primary Logo: logo1_<i>client id</i>.png</li>
	<li>Secondary Logo: logo2_<i>client id</i>.png</li>
</ul>
<p>All PuroClean clients use the same two logos, logo1_puro.png and logo2_puro.png<br />
	All logos and images must be zipped up in a zip file.  Please zip the individual files, not a directory.<br />
	Remember that this process will override any logos or images that are already on the server. 
	<form enctype="multipart/form-data" action="?id=manage_logos" method="POST">
	        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	        
			Logos/Images: <input name="images" id='images' type="file" /><br />
	        <input type="submit" name="submit" value="Click here to Upload Files" />
	    </form>
<a href="?id=view_images">Click</a> to view all the images on the server