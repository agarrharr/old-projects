<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

//echo "<p>You have added " . getNumberAddedThisWeek() . " verses this week.</p>";

$query = "SELECT books.book_id, books.name ";
$query .= "FROM books;";
$result_set = mysql_query($query, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	echo "<form id='newVerseForm'><select id='book_id'>";
	while ($books = mysql_fetch_array($result_set)) {
		echo "<option value='" . $books['book_id'] . "'>" . $books['name'] . "</option>";
	}
	echo "</select>";
	echo "<input type='text' id='chapter' size='2'/>:";
	echo "<input type='text' id='verse' size='7'/>";		
	require("../ajax/showVersions.php");
	echo "<br/><input type='button' id='submit' value='Get Verse' onClick='javascript:showBGVerse(1);'/></form>";
}

function getNumberAddedThisWeek(){
	$query = "SELECT COUNT(*) AS number FROM verses WHERE user_id=".$_SESSION["user_id"]." AND dateAdded >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK);";
	$result_set = mysql_query($query, $GLOBALS['connection']);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$results = mysql_fetch_array($result_set);
		$number = $results['number'];
	}else{
		$number = 3;
	}
	return $number;
}
?>