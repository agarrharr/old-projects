<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	$frequency = $_GET['frequency'];
	$tag = $_GET['tag'];
	$needle = $_GET['needle'];
	
	$sql = "SELECT verses.verse_id, books.name, verses.chapter, verses.verse ";
	$sql .= "FROM books, verses ";
	$sql .= "WHERE books.book_id = verses.book_id ";
	$sql .= "AND verses.user_id = " . $_SESSION['user_id'] . " ";
	if (isset($frequency)){
		$sql .= "AND verses.stage IN(" . $frequency . ");";
	}
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) >= 1){
		echo "<ul id='selectable-verses' class='selectable'>";
		$count = 0;
		while($verses = mysql_fetch_array($result_set)){
			echo "<li value='".$verses["verse_id"]."'";
			if ($count == 0){ echo "class='ui-selected'";}
			echo ">" . $verses["name"] . " " . $verses['chapter'] . ":" . $verses["verse"] . "</li>";
			$count++;
		}
		echo "</ul>";
	}else{
		if($frequency == '0' || $frequency == '0,1,2,3'){
			echo "You have no verses yet.<br/><a href='addVerse.php'>Add one.</a>";
		}else{
			echo "You have no verses in this category yet.";
		}
	}
	echo $needle;
?>