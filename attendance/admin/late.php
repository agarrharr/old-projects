<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/connect.php");

//confirm_logged_in();

$query = "SELECT x.date, x.name, g.type FROM( ";
$query .= "SELECT d.id as date_id, d.date, l.id as leader_id, l.name, l.grouptype_id ";
$query .= "FROM challenge_dates d, challenge_leaders l) x ";
$query .= "LEFT OUTER JOIN challenge_attendance a ON x.date_id=a.date_id AND x.leader_id=a.leader_id ";
$query .= "INNER JOIN challenge_grouptype g ON x.grouptype_id=g.id ";
$query .= "WHERE a.id IS NULL ";
$query .= "order by g.type, x.leader_id, x.date_id;";

$result_set = mysql_query($query, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	echo "Leaders who haven't submitted attendance.<br/><table>";
	while ($results = mysql_fetch_array($result_set)){
		echo "<tr><td>".$results["date"]."</td><td>".$results["name"]."</td><td>".$results["type"]."</td></tr>";
	}
	echo "</table>";
}else{
	echo "Everyone has submitted all their attendance numbers!";
}
?>