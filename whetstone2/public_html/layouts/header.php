<html>
	<head>
		<title>Whetstone</title>
		<link href="../../public_html/layouts/stylesheets/main.css" media="all" rel="stylesheet" type="text/css"/>
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
	<div id="header">
		<h1>Whetstone</h1>
        <?php
			echo $user->get_login_link();
		?>
	</div>
    <div id="main">
    	<div id="message">
			<?php
                $session->output_message();
            ?>
		</div>