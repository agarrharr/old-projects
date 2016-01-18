<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$verseArray = array();
	$counter = 0;
	
	$sql = "SELECT verses.verse_id ";
	$sql .= "FROM verses, books, members ";
	$sql .= "WHERE verses.book_id = books.book_id AND verses.user_id=" . $_SESSION['user_id'] . " ";
	$sql .= "AND members.user_id=verses.user_id ";
	$sql .= "AND (verses.reviewedLast <> curdate() OR verses.reviewedLast IS NULL) ";
	$sql .= "AND (verses.stage = 0) ";
	$sql .= "OR (verses.stage = 1 AND members.weekly = verses.weekly) ";
	$sql .= "OR (verses.stage = 2 AND members.monthly = verses.monthly) ";
	$sql .= "OR (verses.stage = 3 AND members.yearly = verses.yearly) ";
	$sql .= "ORDER BY verses.stage";
	
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) >= 1){
		while ($verses = mysql_fetch_array($result_set)){
			$verseArray[$counter] = $verses["verse_id"];
			$counter++;
		}
	}
	echo json_encode($verseArray);
?>