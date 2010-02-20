
<?php
	
	$dir_to_view = $_SERVER{'DOCUMENT_ROOT'} . "/logos"; 
	
	if ($handle = opendir($dir_to_view)) {
	    while (false !== ($file = readdir($handle))) {
	      if ($file != "." && $file != "..") {
	        echo("<table border = 1>");	
	          echo "<tr><td><img style =\"margins:5px; padding:5px;\" src=http://www.leveragedmedia.net/logos/$file /></td></tr>";
	       	  echo "<tr><td>$file</td></tr>";
	echo("</table>");
	      }
	    }
	    closedir($handle);
	  }
	?>
