<?php
	//1. Create a database connection
	require("constants.php");
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	/*if(!$connection){
		$connection = mysql_connect(DB_SERVER2, DB_USER2, DB_PASS2);
	}else if(!$connection){
		die("Database connection failed: " . mysql_error());
	}*/
	
	//2. Select a database to use
	$db_select = mysql_select_db(DB_NAME, $connection);
	if(!$db_select){
		die("Database selection failed: " . mysql_error());
	}
?>