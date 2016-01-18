<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	confirm_logged_in();
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi- Add A Member</title>";
	
	include("../includes/layout/h2.php");
	include("../pages/nav.php");
	include("../includes/layout/b1.php");
	
	//the form and form execution
	include("../includes/validate_new_member.php");
	include("../includes/form_new_member.php");
		
	include("../includes/layout/b2.php");
?>