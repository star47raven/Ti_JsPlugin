<?php 
	require_once('php/tokener.php');
	error_reporting(0);
	ini_set('html_errors', false);
	$cb_payload = array();
	$xx_payload = array();
	header('Content-Type: text/plain');
	$cb_auth = verifyToken($_GET['backtoken'], $_GET['zb_result'], $cb_payload/*, $xx_payload*/);
	echo "%==-- THIS IS ONLY FOR DEBUGGING PURPOSES --==%\n";
	echo $cb_auth == true ? "VERIFIED" : "INVALID";
	echo "\n";
	var_dump($cb_payload);
	//var_dump($xx_payload);
?>