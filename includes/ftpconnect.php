<?php
$ftp_server = "customclientftp.listrak.com";
$ftp_user = "lnet\leveragedmedia";
$ftp_pass = "l3v3r@g3dm3d1@";
$ftpLog = new Log;
$ftpLog->set_page($_SERVER['PHP_SELF']);
$conn_id = ftp_connect($ftp_server) or die("Couldn't Connect to $ft_server");
// try to login
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    $ftpLog->set_log("Connected as $ftp_user@$ftp_server");
	$ftpLog->write_log();
} else {
    $ftpLog->set_log("Error connecting as $ftp_user");
	$ftpLog->write_log();
}
?>