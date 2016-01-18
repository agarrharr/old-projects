<?php header('Content-Type: text/xml; charset=utf-8'); ?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

$where = "";
if(isset($_GET['day'])){
	$where = "WHERE f.day=" .(($_GET['day'] % 4) +1) . " ";
}

$sql = "SELECT f.id, f.type_id, f.name, f.day, t.type ";
$sql .= "FROM food f ";
$sql .= "INNER JOIN food_type t ON f.type_id=t.id ";
$sql .= $where;
$sql .= "ORDER BY f.day, f.type_id, f.name";
$result_set = mysql_query($sql, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	$previous_day = 0;
	$previous_food_type= 0;
	echo "<days>";
	while ($foods = mysql_fetch_array($result_set)){
		if($previous_day != $foods['day']){
			if($previous_day != 0){ echo "</day>"; }
			echo "<day><number>" . $foods['day'] . "</number>";
		}
		if($previous_food_type != $foods['type_id']){
			if($previous_food_type != 0){ echo "</foods>"; }
			echo "<foods><type>" . $foods['type'] . "</type>";
		}
		echo "<food id='" . $foods['id'] . "'>" . $foods['name'] . "</food>";
		
		$previous_day = $foods['day'];
		$previous_food_type = $foods['type_id'];
	}
	echo "</foods></day></days>";
}
?>