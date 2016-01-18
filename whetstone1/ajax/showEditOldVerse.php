<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$verse_id = $_GET['verse'];
	
	$sql = "SELECT verses.text ";
	$sql .= "FROM verses WHERE verse_id = " . $verse_id;
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) >= 1){
		$results = mysql_fetch_array($result_set);
		$verseText = $results['text'];
	}
	
	echo "<textarea id='verseText' rows='10' cols='50'>" . $verseText . "</textarea>";
	echo "<br/><input type='button' value='Save' onclick='javascript:saveOldVerse(".$verse_id.");'>";
?>
