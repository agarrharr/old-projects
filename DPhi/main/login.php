<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	echo "<title>Login</title>";
	echo "<p class='title'>Login</p>";
	if(isset($_GET['e']) && $_GET['e'] == 1)
			echo "Username/password combination is incorrect.<br/>";
	include("../includes/form_login.php");
?>