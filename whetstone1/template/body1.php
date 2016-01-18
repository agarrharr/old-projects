<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31980509-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body>
<div style="position: absolute; top: 0; left: 0; width: 100%;background-color:white;outline-width:1;outline-color:black;outline-style:solid;">

<?php
echo "<a class='cursive' id='addverse' href='../members/addVerse.php'>+Add Verse</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a class='cursive' id='myverses' href='../members'>My Verses</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a class='cursive' id='review' href='../members/review.php'>Test</a>";
?>

<div class="cursive" style="float:right;">
<a href="settings.php">

<?php
	echo $_SESSION['email'] . "- ";
?>

</a>
<a class="cursive" href='../login/logout.php'>Log out</a>
</div>
</div>
<br/><br/>

<?php
if(userIsAdmin()){
	echo "<a href='../admin/stats.php'>admin stats</a>";
}
?>