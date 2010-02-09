<?php

/**
This is the file that changes the billing numbers
*/

$id = $_GET['id'];
$billingCode = $_GET['billingCode'];
$billingSubject = $_GET['billingSubject'];
echo $id;
echo $billingCode;
echo $billingSubject;


?>
<form name="update" action="update_billing.php?id=<?=$id?>&code=<?=$billingCode?>&subject=<?=$billingSubject?>" class="thickbox">
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="subject" value="<?=$billingSubject?>" />
	<input type="hidden" name="code" value="<?=$billingCode?>" />
	Enter Amount:<input type="text" name="amount" />
	<input type="submit" name="submit" value="Submit" /> <input type="button" name="cancel" value="Cancel" />
	
</form>
