<?php
/* 
 * This is the main content page for the BackOffice System
 * and open the template in the editor.
 */
//TODO:Need to do some work on this page.  Maybe ask Amy for some stock photos
?>
<h1>Welcome to the LeveragedMedia BackOffice System</h1>

<div id="demotip">&nbsp;</div>
<!-- a couple of trigger elements -->
<div id="demo">

		<a href="?id=billing" title="Manage Billing"><img src="images/billing.png" alt="Billing" border="0"  /></a>
		<a href="?id=email" title="Manage Email"><img src="images/email.png" alt="Billing" border="0" /></a>
		<a href="?id=archives" title="Manage Archives"><img src="images/archives.png" alt="Billing" border="0" /></a>
	
		<a href="?id=software" title="Manage Software" ><img src="images/software.png" alt="software" border="0" /></a>
		<a href="?id=logger" title="Click Here to Veiw the Logs"><img src="images/logger.png" alt="Billing" border="0" /></a>
		<a href="http://192.168.1.17:3000" title="Leveraged Media Project Tracker" target="_blank"><img src="images/tracker.png" alt="Billing" border="0" /></a>
		
	</div>
	
	<script>
	// What is $(document).ready ? See: http://flowplayer.org/tools/using.html#document_ready



	$(document).ready(function() {
		$("#demo a[title]").tooltip({
			tip:'#demotip',
			effect: 'fade',
			position: "bottom center",
			offset: [-150, -250]
		
		});
	
	});
	</script>

	