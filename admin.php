<?php
/**
This is the data admin section!!

*/
if(isset($_POST['submit'])){
	
	$toggle = $_POST['toggle'];
	
}

switch($toggle){
	
	case 1: 
		cleanUploads();
		break;
	
	case 2:
		truncateTables();
		break;
	
	default:
		break;
}




?>
<script language="JavaScript"> 
function openDir( form ) { 

	var newIndex = form.fieldname.selectedIndex; 

	if ( newIndex == 0 ) { 

		alert( "Please select a location!" ); 

	} else { 

		cururl = form.fieldname.options[ newIndex ].value; 

		window.location.assign( cururl ); 

	} 

} 

</script> 

 <h2>Data Admin Page</h2>

<p style="color:red">
	WARNING: THIS PAGE WILL DESTROY ALL DATA IN THE SYSTEM!!<br /> PLEASE MAKE SURE THAT YOU HAVE MADE THE APPROPRIATE ARCHIVES FIRST!!
	
</p>

<table width=100% cellpadding=4 cellspacing=0 border=0> 

<form name=form method="post" action="?id=admin"> 

	<tr> 

		<td nowrap> 

			<select name="toggle" size="1" 

				
				<option>Please Make a Choice</option>
				<option value=1>Delete Data</option>
				<option value=2>Empty Tables</options>
				
				
			</select> 

		</td> 

	</tr> 
<input type="submit" name="submit" value="Submit" />
</form> 

</table> 
