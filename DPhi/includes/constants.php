<?php
	/*define("SITE_URL", "http://dphi.host56.com"); 
	define("DB_SERVER", "mysql9.000webhost.com");
	define("DB_USER", "a1481748_user");
	define("DB_PASS", "68bpowell");
	define("DB_NAME", "a1481748_DPhi(2)");*/
	
	define("SITE_URL", "http://localhost/dphi/"); 
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "DPhi");
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
?>