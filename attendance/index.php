<?php
require_once("../includes/functions.php");
require_once("../includes/connect.php");
?>
<form action="thanks.php" method="POST">
<table>
	<tr>
		<td>Leaders: </td>
		<td><select id="leader_id" name="leader_id">
		<option>select leaders</option>
		<?php
		$query = "SELECT id, name FROM challenge_leaders ORDER BY name;";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) >= 1){
			while ($leaders = mysql_fetch_array($result_set)){
				echo "<option value=".$leaders["id"].">".$leaders["name"]."</option>";
			}
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td>Date: </td>
		<td><select id="date_id" name="date_id">
		<option>select date</option>
		<?php
		$query = "SELECT id, date FROM challenge_dates;";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) >= 1){
			while ($dates = mysql_fetch_array($result_set)){
				echo "<option value=".$dates["id"].">".$dates["date"]."</option>";
			}
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td>Attendance (counting leaders):</td>
		<td><input type="text" id="attendance" name="attendance" size="5"/></td>
	</tr>
	<tr>
		<td>How do you feel your group went?: </td>
		<td><textarea id="myComment" name="myComment" rows="4" cols="30"></textarea></td>
	</tr>
    <tr>
        <td>&nbsp;</td>
        <td>
        	<input type="submit" id="submit" name="submit" value="Submit" />
        </td>
    </tr>
</table>
</form>
