<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	confirm_logged_in();
	confirm_admin();
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi- View Members</title>";
	
	include("../includes/layout/h2.php");
	include("../pages/nav.php");
	include("../includes/layout/b1.php");
	
	echo "Members</br></br>";
	
	$query = "SELECT *
				FROM members;";
	
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		echo $row["fname"] . " " . $row["lname"] . "</br>";
		$num_rows ++;
	}
	include("../includes/layout/b2.php");
?>