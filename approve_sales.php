<?php
/**
This is the new input page for approving sales, before the subscriber lists are processed.
*/


?>
<p>Please upload the approved sales report here once all pending sales have been approved</p>
<form enctype="multipart/form-data" action="?id=upload_approved_sales" method="POST" onsubmit="return checkNames()">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
        ApprovedCashSales.csv: <input name="approved" id='web' type="file" /><br />
        UnapprovedCashSales.csv: <input name="unapproved" id='web' type="file" /><br />
        <input type="submit" name="submit" value="Click here to Upload File" />
    </form>
