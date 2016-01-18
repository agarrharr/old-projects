<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../includes/simple_html_dom.php');
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");
/* php grabber for BibleGateway */


$book_id = $_GET['book'];
$chapter = $_GET['chapter'];
$verse = $_GET['verse'];
$version_id = $_GET['version_id'];
$lookup = $_GET['lookup'];
$book = getBookName($book_id);
$versionName = getVersionName($version_id);
$url = getUrl($book, $chapter, $verse, $versionName);

if ($lookup == 0){
	$verse_text = "";
	showTextArea($verse_text, $url);
}else{
	$verse_text = getBGVerseText($book, $chapter, $verse, $url);
	if ($verse_text <> ""){
		showTextArea($verse_text, $url);
	}else{
		echo "<div class='error'>There seems to have been a problem. getVerse line 27.</div>";
	}
}

function showTextArea($verse_text, $url){
	echo "<textarea id='verseText' rows='10' cols='50'>" . $verse_text . "</textarea>";
	echo "<br/><input type='button' id='submitVerse' value='Add' onClick='javascript:saveVerse();'/></form>";
	echo " <a href='".$url."' target='_blank' class='cursive'>See at BibleGateway</a>";
}
function getBGVerseText($book, $chapter, $verse, $url){
	$errorMessage = "<div class='error'>This verse doesn't exist.</div><p>Click <a href='".$url."' target='_blank'>here</a> to check. If you're still sure it's a verse you can <a href='javascript:showBGVerse(0);'>type it yourself.</a></p>";
	$html = file_get_html($url) or die($errorMessage);
	
	if ($verse == 1){
		$data =  $html->find('span[class=chapternum]');
	}else{
		$data =  $html->find('sup[class=versenum]');
	}
	if (count($data) <= 0){
		die($errorMessage);
	}
	$verse_text = $data[0]->parent();
	$verse_text = str_replace("<br />", "\n", $verse_text);
	$verse_text = str_replace("&nbsp;", " ", $verse_text);
	$verse_text = ltrim(html_entity_decode(strip_tags($verse_text)));
	
	//Get rid of Footnotes
	$length = strpos($verse_text, "Footnotes");
	if ($length != 0){
		$verse_text = substr($verse_text, 0, $length);
	}
	
	$verse_text = substr($verse_text, strpos($verse_text, $book));
	$verse_text = substr($verse_text, strpos($verse_text, $chapter));
	$verse_text = substr($verse_text, strpos($verse_text, $verse));
	
	//Get rid of the brackets that link to footnotes
	$verse_text = trim(preg_replace('/\\[[^)]*\]/', '', $verse_text));
	return $verse_text;
}
?>

<ol id="joyRideTipContent">
	<li data-id="submitVerse">Edit the verse and then hit Add.</li>
</ol>
<script type="text/javascript">
		$(window).joyride({
			'nextButton': false
		});

</script>