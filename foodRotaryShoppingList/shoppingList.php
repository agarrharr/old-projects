<?php header('Content-Type: text/xml; charset=utf-8'); ?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

if(isset($_GET['item'])){
	addList();
}else if(isset($_GET['delete'])){
	deleteList();
	showList();
}else{
	showList();
}

function addList(){
	global $connection;
	$day = $_GET['day'];
	$sql = "SELECT id, name FROM food WHERE id IN (" . $_GET['item'] . ")";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) >= 1){
		echo "<foods>";
		while ($foods = mysql_fetch_array($result_set)){
			$sql = "INSERT INTO food_day (food_id, date) VALUES(" . $foods['id'] . ", '" . get_date_of_day($day) . "')";
			$results = mysql_query($sql, $connection);
			confirm_query($results);
			echo "<food id='" . mysql_insert_id($connection) . "'>" . $foods['name'] . "</food>";
		}
		echo "</foods>";
	}
}

function deleteList(){
	global $connection;
	$foods = explode(",", $_GET['delete']);
	foreach($foods as $food){
		$sql = "DELETE FROM food_day WHERE id=" . $food . "";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
	}
}

function showList(){
	global $connection;
	$sql = "SELECT d.id, f.type_id, f.name, d.date ";
	$sql .= "FROM food_day d ";
	$sql .= "INNER JOIN food f ON d.food_id=f.id ";
	$sql .= "WHERE d.date >= CURDATE() ";
	$sql .= "ORDER BY f.type_id, f.name";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	echo "<foods>";
	if(mysql_num_rows($result_set) >= 1){
		while ($foods = mysql_fetch_array($result_set)){
			echo "<food id='" . $foods['id'] . "'>" . $foods['name'] . "</food>";
		}
	}
	echo "</foods>";
}

function get_date_of_day($day){
	$today = strtotime(date("Y-m-d"));
	$date = date("Y-m-d", $today + (($day-1)*3600*24));
	return $date;
}
?>