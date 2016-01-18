<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	
	$verse_id = $_GET["verse_id"];
	
	echo "Are you sure you want to delete this verse?<br/>";
	echo "<div id='delete'><input type='button' value='Yes' onclick='javascript:deleteVerse(".$verse_id.");'/>";
	echo "<input type='button' value='No' onclick='javascript:showVerse(".$verse_id.");'/></div>";
?>