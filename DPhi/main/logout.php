<?php

	require_once("../includes/functions.php");

	//Four steps to closing a session

	//Find the session
	session_start();
	//Unset all the session variables
	$_SESSION = array();
	//Destroy the session cookie
	if(isset($COOKIE[session_name()])){
		setcookie(session_name(), '', time()-42, '/');
	}
	//Destroy the session
	session_destroy();
	
	redirect_to("Location: ../main/");

?>