<?php
$query = "SELECT * FROM versions;";
$result_set = mysql_query($query, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) >= 1){
	echo "<select id='version_id' name='version_id'>";
	while ($versions = mysql_fetch_array($result_set)){
		$selected = "";
		if ($versions['version_id'] == $_SESSION['version_id']){
			$selected = "selected";
		}
		echo "<option value='".$versions['version_id']."' ".$selected.">".$versions['desc']."</option>";
	}
	echo "</select>";
}
?>