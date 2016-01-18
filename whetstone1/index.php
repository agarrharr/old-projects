<?php
require_once("includes/session.php");
require_once("includes/functions.php");
if(logged_in()){
	redirect_to("Location: members");
}
?>
<head>
<head>
<style>
*{margin:0; padding:0; border:0;}  
body{background:#d7d7d7}
  
/* Slideshow & Billboard Images */      
 #top-zone{overflow:hidden; width:960px; margin:0 auto; height:470px; position:relative;} /*Here to keep images hidden in IE mostly*/  
  
 #billboard{width:940px; height:450px; margin:10px 10px 20px 10px; overflow:hidden; position:relative;}
  
 .slideshow{width:920px; height:410px; margin:10px; overflow:hidden; position:absolute; left:10px;}  
 .slideshow li{list-style:none; float:left; display:inline;}  
  
 .edge-holders{width:940px; height:450px; background:url('images/slideshow/frame.png') no-repeat top center; position:relative; margin:10px 20px 10px 20px; top:-460px; z-index:10;}
 
 .slideSelectorContainer
 {
	position: absolute;
	top: 85%;
	width: 100%;
	z-index: 11;
 }
 
 .slideSelector
 {
	 margin-left:auto;
	 margin-right: auto;
	 z-index:12;
 }
 
 .slideSelector a
 {
	z-index: 13;
	background-color: #d7d7d7;
	border: solid;
	border-color: #252122;
	border-width:1;
	color: #d7d7d7;
	opacity: 0.7;
	width: 8px;
	height: 8px;	 
	float: left;
	margin: 0 5px;
 }
 .slideSelector a.activeSlide{ background-color:white; color:white;}
 </style>
<link href='https://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="template/styles.css" />
<link href="https://plus.google.com/112423622866496732823/" rel="publisher" />

<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.cycle.all.js"></script>
<script>  
$(document).ready(function(){
	function preload(arrayOfImages) {
		$(arrayOfImages).each(function(){
			$('<img/>')[0].src = this;
			// Alternatively you could use:
			// (new Image()).src = this;
		});
	}
	preload([
		'images/fbLoginHover.png',
		'images/fbLoginPressed.png'
	]);
   $("img#fbLogin").hover(function(){
	   $(this).attr("src","images/fbLoginHover.png")
   },function(){
	   $(this).attr("src","images/fbLogin.png")
   });
   $("img#fbLogin").mousedown(function(){
	   $(this).attr("src","images/fbLoginPressed.png")
	});
	
   slides = $(".slideshow li").length;
   $(".slideSelector").width(slides * 20);
   $('.slideshow').cycle({  
   	  pagerAnchorBuilder: function(index, el) {
		  return '<a href="#"></a>';
	  },
      fx: 'fade',  
      speed: 200,  
      timeout: 5000,
	  pager: '.slideSelector',
	  pagerEvent: 'click.cycle'
   });
});  
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=233665653420678";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<center>
<br/><br/>
<!--img src="images/whetstoneDraft.jpg"/-->
<div class='cursive'>Whetstone- Sharpen your sword</div>
<br/><br/>
<form name="form2" method="POST" action="login/login.php">
	Email: <input name="email" type="text" size="30" placeholder="Email"/>
    Password: <input name="pass" type="password" size="30" placeholder="Password" />
	<input type='submit' name='submit' value="Log in" />
</form>
<!--a href='facebook/login.php'><img src='images/fbLogin.png' id='fbLogin'/></a><br/-->
<a href='login/signup.php'>Sign Up</a>
<div id="top-zone">
    <div id="slideSelectorContainer" class="slideSelectorContainer"><div class="slideSelector"></div></div>
    <div id="billboard">
    	<ul class="slideshow">
            <li><img src="images/slideshow/slideRememberScripture.png" /></li>
            <li><a href="blog/"><img src="images/slideshow/slideBlog.png" /></a></li>
    	</ul>
    </div>
    <div class="edge-holders"></div>
</div>
<br/><br/>

<table border='0'>
	<tr>
    	<td width='300' align="center">
			<a href="https://twitter.com/wstoneapp" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @wstoneapp</a>
		</td>
		<td width='300' align="center">
			<a href="https://plus.google.com/112423622866496732823/?prsrc=3" style="text-decoration: none; color: #333;"><div><span style="font: bold 13px/16px arial,sans-serif; margin-right: 4px; margin-top: 7px;">Whetstone</span><span style="font: 13px/16px arial,sans-serif; margin-right: 11px; margin-top: 7px;">on</span><div><img src="https://ssl.gstatic.com/images/icons/gplus-32.png" width="32" height="32" style="border: 0;"/></div><div style="clear: both"></div></div></a>
		</td>
        <td width='300' align="center">
			<p class='cursive'><a href='blog'>Blog</a></p>
		</td>
	</tr>
</table>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</center>
<form name="form1" method="POST" action="new_member.php">
	<table>
		<tr>
			<td>Email:</td>
			<td><input name="email" type="text" size="30" /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input name="password" type="password" size="30" /></td>
		</tr>
		<tr>
			<td>Retype Password:</td>
			<td><input name="password2" type="password" size="30" /></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
				<input type='submit' name='submit' value="Register">
			</td>
		</tr>
	</table>
</form>
</body>
</head>
</html>