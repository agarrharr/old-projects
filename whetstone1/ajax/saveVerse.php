<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$book_id = $_GET['book'];
	$chapter = $_GET['chapter'];
	$verse = $_GET['verse'];
	$verseText = urldecode($_GET['verseText']);
	$version_id = $_GET['version_id'];
		
	$sql = "INSERT INTO verses (user_id, book_id, chapter, verse, text, version_id, dateAdded) ";
	$sql .= "VALUES (".$_SESSION["user_id"].", ".$book_id.", ".$chapter.", '".$verse."','".mysql_prep($verseText)."',".$version_id.", CURDATE());";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	
	$sql = "SELECT LAST_INSERT_ID() AS verse_id;";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$results = mysql_fetch_array($result_set);
		echo $results["verse_id"];
	}
?>