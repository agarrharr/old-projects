<?php
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/connect.php");
?>
<style type="text/css" src="../../jquery/visualize/css/basic.css"></style>
<script type="text/javascript" src="../../js/enhance.js"></script>	
<script type="text/javascript">
		// Run capabilities test
		enhance({
			loadScripts: [
				'../../js/jquery-1.7.min.js',
				'../../js/visualize/js/excanvas.js',
				'../../js/visualize/js/visualize.jQuery.js',
				'../../js/visualize/js/table.js',
			],
			loadStyles: [
				'../../js/visualize/css/visualize.css',
				'../../js/visualize/css/visualize-light.css'
			]	
		}); 
</script>

<?php
$sql = "SELECT d.id, d.date ";
$sql .= "FROM challenge_dates d ";
$sql .= "ORDER BY d.date ASC";

$table = "<table><caption>Challenge Attendance</caption>";
$result_set = mysql_query($sql, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	$table .= "<thead><tr><td></td>";
	$results = mysql_fetch_rowsarr($result_set);
	$numDates = count($results);
	for($x=0; $x < $numDates; $x++){
		$table .= "<th scope='col'>" . $results[$x][1] . "</th>";
	}
	$table .= "</tr></thead>";
}

$sql = "SELECT a.id, l.name, a.attendance, a.comment ";
$sql .= "FROM challenge_attendance a ";
$sql .= "INNER JOIN challenge_leaders l ON a.leader_id=l.id ";
$sql .= "WHERE l.grouptype_id=1 ";
$sql .= "ORDER BY l.name, a.date_id";

$result_set = mysql_query($sql, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	$results = mysql_fetch_rowsarr($result_set);
	$table .= "<tbody><tr><th scope='row'>" . $results[0][1] . "</th>";
	$c = 0;
	for($x=0; $x < count($results); $x++){
		if($x != 0 && $results[$x][1] != $results[$x-1][1]){
			for($c; $c < $numDates; $c++){
				$table .= "<td>&nbsp;</td>";
			}
			$table .= "</tr><tr><th scope='row'>" . $results[$x][1] . "</th>";
			$c = 0;
		}
		$table .= "<td title='" . str_replace( "'", "&#39;", $results[$x][3]) . "'>" . $results[$x][2] . "</td>";
		$c++;
	}
	for($c; $c < $numDates; $c++){
		$table .= "<td>&nbsp;</td>";
	}
	$table .= "</tr></tbody>";
	echo $table;
}else{
	echo "There are no attendance numbers!";
}
?>

<!--example
<table>
	<caption>2009 Employee Sales by Department</caption>
	<thead>
		<tr>
			<td></td>
			<th scope="col">food</th>
			<th scope="col">auto</th>
			<th scope="col">household</th>
			<th scope="col">furniture</th>
			<th scope="col">kitchen</th>
			<th scope="col">bath</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Mary</th>
			<td>190</td>
			<td>160</td>
			<td>40</td>
			<td>120</td>
			<td>30</td>
			<td>70</td>
		</tr>
		<tr>
			<th scope="row">Tom</th>
			<td>3</td>
			<td>40</td>
			<td>30</td>
			<td>45</td>
			<td>35</td>
			<td>49</td>
		</tr>	
	</tbody>
</table-->