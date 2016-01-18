<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$verse_id = $_GET['verse_id'];
	
	if($verse_id != 0){
		$verse = getVerse($verse_id);
		$verseName = $verse[0];
		$verseText = $verse[1];
		
		echo "<div id='verseName' class='underline'>". $verseName . "</div><div class='verseDiv'>" . sql2html($verseText) . "</div>";
	}
?>
