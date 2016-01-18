<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$verse_id = $_GET["verse_id"];
	
	$query = "DELETE FROM verses ";
	$query .= "WHERE user_id=".$_SESSION["user_id"]." AND verse_id=".$verse_id.";";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
?>