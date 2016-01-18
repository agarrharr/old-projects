<?php header('Content-Type: text/html; charset=utf-8');
require_once("../includes/session.php");
require_once("../includes/functions.php");
$_POST['url'] = $_SERVER["REQUEST_URI"];
confirm_logged_in();
include("../template/head1.php");
?>

<script src="../js/jquery-1.7.min.js"></script>
<script src="../ajax/ajaxFunctions.js"></script>
<script type="text/javascript">
var jsonVerses;
var verseText;
var verseTextArray;
var currentVerse = -1;
var currentWord = 0;
var startPos = 0;
var verseReady = 0;

$(document).ready(function(){
	if(<?php echo $_SESSION['finishDay']; ?> == 1){
		$("div#numberVerses").html("<p>You have already tested today. Please come back and test tomorrow.</p>");
	}else{
		getReviewVerses();
	}
	
	$(document).keypress(function(event) {
		numberOfVersesLeft = jsonVerses.length - currentVerse;
		if(numberOfVersesLeft > 0 && verseReady){
			switch(event.keyCode){
				case 13:
				case 40:
					showNextWord();
					break;
				case 32:
				case 39:
					showNextLine();
					break;
				case 78:
					newVerse(0);
					break;
				case 89:
					newVerse(1);
					break;
				default:
					break;
			}
		}
	});
});

function showNextLine(){
	do{
		showNext();
	}while(verseTextArray[currentWord].indexOf("<br/>") == -1)
	
	if(verseTextArray[currentWord] != "<br/>" && verseTextArray[currentWord].indexOf("<br/>") > 0){
		showNext();
	}
}
function showNextWord(){
	while(verseTextArray[currentWord] == "<br/>" || verseTextArray[currentWord] == "&nbsp;"){
		currentWord++;
	}
	showNext();
}
function showNext(){
	if(currentWord < verseTextArray.length){
		var myRegExp = verseTextArray[currentWord];
		matchPos = verseText.indexOf(myRegExp, startPos);
		verseTextCompleted = verseText.substring(0,matchPos+verseTextArray[currentWord].length);
		$("div#verseText").html(verseTextCompleted);
		startPos = matchPos + verseTextArray[currentWord].length;
	}
	if(currentWord == verseTextArray.length-1){
		verseReady = 0;
		verseTextCompleted = verseTextCompleted + "<p>Done!<br/>Did you get it right?</p><input type='button' value='No' onclick='javascript:newVerse(0);' /><input type='button' value='Yes' onclick='javascript:newVerse(1);' />";
		$("div#verseText").html(verseTextCompleted);
	}
	currentWord++;
}

function getReviewVerses(){
	var xmlhttp;
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			jsonVerses = eval("(" + xmlhttp.responseText + ")");
			newVerse(-1);
		}
	}
	xmlhttp.open("GET","../ajax/showReview.php", true);
	xmlhttp.send();
}

function newVerse(lastVerseCorrect){
	currentVerse++;
	currentWord = 0;
	startPos = 0;
	numberOfVersesLeft = jsonVerses.length - currentVerse;
	if(numberOfVersesLeft >= 0){
		$("div#numberVerses").html("<p>You have " + numberOfVersesLeft + " verses to review</p><br/><br/>");
		if(numberOfVersesLeft > 0){
			$("div#verseName").html("loading...");
			$("div#verseName").load("../ajax/reviewGetVerseName.php?verse_id="+jsonVerses[currentVerse]);
			$("div#verseText").html("&nbsp;");
			$.get("../ajax/reviewGetVerseText.php?verse_id="+jsonVerses[currentVerse], function(data){
				saveVerseText(data);
				verseReady = 1;
			});
		}
		if(numberOfVersesLeft == 0){
			$("div#verseName").html("&nbsp;");
			$("div#verseText").html("&nbsp;");
			if(jsonVerses.length == 0){
				$("div#numberVerses").html("<p>You have no verses. First add some, and then come back.</p>")
			}else{
				finishDay();
			}
		}
	}
	if(lastVerseCorrect > -1){
		$("div#resultSaved").load("../ajax/reviewSaveResult.php?verse_id="+jsonVerses[currentVerse-1]+"&correct="+lastVerseCorrect);
	}
}
function saveVerseText(data){
	verseText = data.replace(/(\r\n|\n|\r)+/g, "<br/> ");
	verseText = verseText.replace(/\s+/g, "&nbsp;");
	verseTextArray = verseText.split(/(&nbsp;)+/g);
}
function finishDay(){
	$("div#numberVerses").load("../ajax/reviewFinishDay.php");
}
</script>

<?php
include("../template/body1.php");
?>

<div id="all">
	<table width="100%" border="0" style="table-layout:fixed;word-wrap:break-word;">
		<tr valign='top'>
			<td width="400">
				<div id="middlePane">
                    <div id="instrucions">space = next line<br/> enter = next word<br/><br/>Say the verse out loud or in your head.<br/>and check yourself as you go.
                    </div>
				</div>
			</td>
			<td>
				<div id="rightPane">
					<div id="top">
						<div id="numberVerses">
						</div><br/>
						<div id="resultSaved">
						</div><br/>
						<div id="verseName">
						</div><br/>
						<div id="helperText">
						</div><br/>
						<div id="verseText">
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<?php
include("../template/body2.php");
?>