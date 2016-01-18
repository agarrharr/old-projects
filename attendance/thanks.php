<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../includes/functions.php");
require_once("../includes/connect.php");

if(isset($_POST['submit'])) {
	$leader_id = $_POST["leader_id"];
	$date_id = $_POST["date_id"];
	$myComment = $_POST["myComment"];
	$attendance = $_POST["attendance"];
	
	$query = "INSERT INTO challenge_attendance (leader_id, date_id, comment, attendance) VALUES (".$leader_id.",".$date_id.",'".$myComment."', ".$attendance.")";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	echo "Thank you. It has been submitted.<br/><a href='index.php'>Back</a>";
}
?>