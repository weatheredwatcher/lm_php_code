<?php
class Log{
	
	var $page_location;
	var $log_msg;
	
function set_page($page_location){
	$this->page_location = $page_location;
	
} 

function set_log($log_msg){
	
	$this->log_msg = $log_msg;
}

function write_log(){
	$host = 'localhost';
	$username = 'lm_backoffice';
	$password = 'password';
	$database = 'LeveragedMedia';


	mysql_connect($host, $username, $password);
	mysql_select_db($database);
	
	$page_location = $this->page_location;
	$log_msg = $this->log_msg;
	
	$results=mysql_query("INSERT INTO tbl_LOG (page_location, log_msg) VALUES('$page_location', '$log_msg')")or die(mysql_error());
}
	
}








?>