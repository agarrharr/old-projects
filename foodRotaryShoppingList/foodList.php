<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

$sql = "SELECT f.id, f.type_id, f.name, f.day, t.type ";
$sql .= "FROM food f ";
$sql .= "INNER JOIN food_type t ON f.type_id=t.id ";
$sql .= "ORDER BY f.day, f.type_id, f.name";
$result_set = mysql_query($sql, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	$previous_day = 0;
	$previous_food_type= 0;
	while ($foods = mysql_fetch_array($result_set)){
		if($previous_day != $foods['day']){
			if ($previous_day != 0){ echo "</div>"; }
			echo "<div><h3>Day " . $foods['day'] . "</h3>";
		}
		if($previous_food_type != $foods['type']){
			echo "<h4>" . $foods['type'] . "</h4>";
		}
		echo $foods['name'] . "<br/>";
		
		$previous_day = $foods['day'];
		$previous_food_type = $foods['type'];
	}
	echo "</div>";
}
?>