<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
?>
<html><head>
		<title>Whetstone</title>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8" />
		<link type="text/css" href="../js/jquery-ui-1.8.17/css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.17/js/jquery-ui-1.8.17.custom.min.js"></script>		<script type="text/javascript" src="../js/jlayout.border.min.js"></script>
		<script type="text/javascript" src="../js/jquery.jlayout.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.17/development-bundle/ui/minified/jquery.ui.core.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.17/development-bundle/ui/minified/jquery.ui.widget.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.17/development-bundle/ui/minified/jquery.ui.mouse.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.17/development-bundle/ui/minified/jquery.ui.selectable.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../template/styles.css" />
		<script src="../ajax/ajaxFunctions.js"></script>
		<script type="text/javascript">
            $(document).ready(function(){
				var container = $('.layout');
				
				function relayout() {
					container.layout({resize: false});
					$('.east').resizable('option', 'maxWidth', $(document).width() -$('.west').width()-100);
				}
				relayout();
				
				$(window).resize(relayout);
				
				$('.east').resizable({
					handles: 'w',
					stop: relayout,
					minWidth: 240,
					resize: function(event, ui){
						$(this).resizable('option', 'maxWidth', $(document).width() -$('.west').width()-100);
					}
				});
				
				$('.west').resizable({
					handles: 'e',
					stop: relayout,
					minWidth: 175,
					resize: function(event, ui){
						$(this).resizable('option', 'maxWidth', $(document).width() -$('.east').width()-100);
					}
				});
				
                showVerses('0,1,2,3', '', '');
				
				$("#frequency").selectable({
					selected: function(event, ui){
						showVerses(ui.selected.value, '', "");
					}
				});
				
				$("#selectable-verses").live('hover', function(){
					$(this).selectable({
						selected: function(event, ui){
							showVerse($('.ui-selected').val());
						}
					});
				});
				
				$('#Edit').click(function(){
					showEditOldVerse($('.ui-selected').val());
				});
				
				$('#Delete').click(function(){
					showDeleteVerse($('.ui-selected').val());
				});
            });
        </script>
        <style type="text/css">
			.selectable .ui-selecting { background: #FECA40; }
			.selectable .ui-selected { background: #F39814; color: white; }
			.selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
			.selectable li { margin: 3px; padding: 0.4em; height: 18px; }
		</style>
	</head>
	<body>
		<div class="layout {layout: {type: 'border', hgap: 3, vgap: 3}}">
			<div class="center">
                <div style='height:40;background-color:#f2f2f2;' class='underline'>
                </div>
                <div id='verses'>
                	Verses
                </div>
			</div>
			<div class="east">
            	<div style='height:40;background-color:#f2f2f2;' class='underline'>
                    <div style='float:left;width:50%;'>
                    	<!--input type='button' id='New Verse' value='New Verse'/-->
                    </div>
                    <div style='float:right;width:50%;text-align:right;'>
                        <input type='button' id='Edit' value='Edit'/>
                        <input type='button' id='Delete' value='Delete'/>
                    </div>
				</div>
                <div id='verseText' class='underline'>
                	Verse Text
                </div>
			</div>
			<div class='west'>
                <div style='height:40;background-color:#f2f2f2;vertical-align:top;' class='underline'>
                	<img src='../images/whetstoneDraft.jpg' height='40' /> Whetstone
                </div>
                <ul id='frequency' class='selectable'>
                    <li value='0,1,2,3'>All Verses</li>
                    <li value='0' class='ui-selected'>Daily</li>
                    <li value='1'>Weekly</li>
                    <li value='2'>Monthly</li>
                    <li value='3'>Yearly</li>
                </ul>
                <!--p>Tags</p-->
			</div>
			<div class="north">
                <a class='cursive' id='addverse' href='../members/addVerse.php'>+Add Verse</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class='cursive' id='myverses' href='../members/showVerses.php'>My Verses</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class='cursive' id='review' href='../members/review.php'>Test</a>
                
                <div class="cursive" style="float:right;">
                    <a href="../members/settings.php">
                    
                    <?php
                        if (isset($_SESSION['email'])){
							echo $_SESSION['email'] . "- ";
						}else{
							echo "email- ";
						}
                    ?>
                    
                    </a>
                    <a class="cursive" href='../login/logout.php'>Log out</a>
                </div>
			</div>
			<div class="south">
			</div>
		</div>
	</body>
</html>
