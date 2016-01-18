<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$verse_id = $_GET['verse_id'];
	$verseText = urldecode($_GET['verseText']);
		
	$sql = "UPDATE verses SET text='".mysql_prep($verseText)."' ";
	$sql .= "WHERE verse_id=".$verse_id.";";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	echo $verseText;
?>