<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi</title>";
	
	include("../includes/layout/h2.php");
	
	if(!logged_in()){
		include("../includes/form_login.php");
	}
	else{
		include(".../pages/nav.php");
	}
	
	include("../includes/layout/b1.php");
	
	if(isset($_GET['e']) && $_GET['e'] == 1)
			echo "Username/password combination is incorrect.<br/>";
			
	include("../includes/layout/b2.php");
?>