$.ajaxSetup ({ cache:false });

function showVerse(verse_id){
	if(verse_id){
		$("div#verseText")
			.html("loading...")
			.load("../ajax/myVerse.php?verse_id="+verse_id);
	}else{
		$('div#verseText').html('');
	}
}
function addVerse(){
	var xmlhttp;
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("middlePane").innerHTML=xmlhttp.responseText;
			document.getElementById("rightPane").innerHTML="&nbsp;";
		}
	}
	xmlhttp.open("GET","../ajax/addVerse.php", true);
	xmlhttp.send();
}
function showVerses(frequency, tag, needle){
	if (typeof frequency != "undefined") window.frequency = frequency;
	if (typeof tag != "undefined") window.tag = tag;
	if (typeof needle != "undefined") window.needle = needle;
	$("div#verses")
		.html("loading...")
		.load("../ajax/myVerses.php?frequency="+window.frequency+"&tag="+window.tag+"&needle="+window.needle, function(){
			if($('#selectable-verses').length){
				showVerse($('.ui-selected').val());
				$('#Edit').show();
				$('#Delete').show();
			}else{
				showVerse(0);
				$('#Edit').hide();
				$('#Delete').hide();
			}
		});
}
function showBGVerse(lookup){
	var book = document.getElementById("book_id").value;
	var chapter = document.getElementById("chapter").value;
	var verse = document.getElementById("verse").value;
	var version_id = document.getElementById("version_id").value;
	
	$("div#rightPane")
		.html("<img src='../images/loading.gif'/>")
		.load("../ajax/getVerse.php?book="+book+"&chapter="+chapter+"&verse="+verse+"&version_id="+version_id+"&lookup="+lookup);
}
function saveVerse(){
	var book = document.getElementById("book_id").value;
	var chapter = document.getElementById("chapter").value;
	var verse = document.getElementById("verse").value;
	var verseText = encodeURI(document.getElementById("verseText").value);
	var version_id = document.getElementById("version_id").value;
	
	$("div#rightPane")
		.html("loading...")
		.load("../ajax/saveVerse.php?book="+book+"&chapter="+chapter+"&verse="+verse+"&verseText="+verseText+"&version_id="+version_id
		);
}
function showEditOldVerse(verse_id){
	$("div#verseDiv")
		.html("loading...")
		.load("../ajax/showEditOldVerse.php?verse="+verse_id);
}
function saveOldVerse(verse_id){
	var verseText = encodeURI($("textarea#verseText").val());
	$("div#verseDiv")
		.html("loading...")
		.load("../ajax/saveOldVerse.php?verse_id="+verse_id+"&verseText="+verseText, function(){ showVerse(verse_id); });
}
function showDeleteVerse(verse_id){
	$("div#verseDiv")
		.html("loading...")
		.load("../ajax/showDeleteVerse.php?verse_id="+verse_id);
}
function deleteVerse(verse_id){
	$("div#verseText")
		.html("loading...")
		.load("../ajax/deleteVerse.php?verse_id="+verse_id, function(){ showVerses(); });
}