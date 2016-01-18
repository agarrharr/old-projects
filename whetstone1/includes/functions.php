<?php
function mysql_prep($value){
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists("mysql_real_escape_string");
	if($new_enough_php){
		if($magic_quotes_active){ $value = stripslashes($value); }
		$value = mysql_real_escape_string($value);
	}else{
		if(!$magic_quotes_active){ $value = addslashes($value); }
	}
	return $value;
}

//The function also has the ability to return the columns numerically, associatively, or both, just as mysql_fetch_array() does. It uses MYSQL_NUM, MYSQL_ASSOC, and MYSQL_BOTH (MYSQL_BOTH being the default)- exactly like mysql_fetch_array().
/*$result = mysql_query($query);
$arr = mysql_fetch_rowsarr($result);
$password = $arr[2]['password'];*/
function mysql_fetch_rowsarr($result, $numass=MYSQL_BOTH){
	$got = array();
	mysql_data_seek($result, 0);
	while ($row = mysql_fetch_array($result, $numass)){
		array_push($got, $row);
	}
	return $got;
}

function redirect_to($location = NULL){
	if($location != NULL){
		header("{$location}");
		exit;
	}
}

function confirm_query($result_set){
	if(!$result_set){
		die("Database query failed: " . mysql_error());
	}
}

function userIsAdmin(){
	if($_SESSION['user_type'] == 1){
		return 1;
	}else{
		return 0;
	}
}

function sql2html($sql){
	$sql = str_replace(" ", "&nbsp;", $sql);
	$sql = nl2br($sql);
	return $sql;
}

function getVersionName($version_id){
	$query = "SELECT versions.version FROM versions WHERE version_id=".$version_id;
	$result_set = mysql_query($query, $GLOBALS['connection']);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$results = mysql_fetch_array($result_set);
		return $results['version'];
	}else{
		return "";
	}
}

function getUrl($book, $chapter, $verse, $version_id){
	$search_term = str_replace(" ", "%20", $book)."%20".$chapter.":".$verse;
	return "http://www.biblegateway.com/passage/?search={$search_term}&version={$version_id}";
}

function getBookName($book_id){
	$query = "SELECT books.name FROM books WHERE book_id=".$book_id.";";
	$result_set = mysql_query($query, $GLOBALS['connection']);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$results = mysql_fetch_array($result_set);
		return $results['name'];
	}else{
		return "";
	}
}

function getVerseName($verse_id){
	$array = getVerse($verse_id);
	return $array[0];
}

function getVerseText($verse_id){
	$array = getVerse($verse_id);
	return $array[1];
}

function getVerse($verse_id){
	$verseArray[0] = "<div id='error'>error getting verse<div>";
	$verseArray[1] = "<div id='error'>error getting verse<div>";
	$query = "SELECT verses.text, books.name, verses.chapter, verses.verse ";
	$query .= "FROM verses, books WHERE verses.book_id=books.book_id AND verse_id = " . $verse_id;
	$result_set = mysql_query($query, $GLOBALS['connection']);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) >= 1){
		$results = mysql_fetch_array($result_set);
		$verse = $results['name'] . " " . $results['chapter'] . ":" . $results['verse'];
		//$verseText = sql2html($results['text']);
		$verseText = $results['text'];
		$verseArray[0] = $verse;
		$verseArray[1] = $verseText;
	
		return $verseArray;
	}
}
?>