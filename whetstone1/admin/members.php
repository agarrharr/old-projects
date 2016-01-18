<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");
confirm_logged_in();
?>
<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../template/styles.css" />
<script src="../ajax/ajaxFunctions.js"></script>

<?php
include("../template/body1.php");
?>

<div id="all">
	<table width="100%" border="0" style="table-layout:fixed;word-wrap:break-word;">
		<tr valign='top'>
			<td width="400">
				<div id="middlePane"><a href="members.php">Members</a></div>
			</td>
			<td>
				<div id="rightPane">
                	<?php
					$sql = "SELECT user_id, type, fname, lname, email, m.version_id, v.version, fb_access_token ".
						"FROM members m ".
						"INNER JOIN versions v ON m.version_id=v.version_id ".
						"ORDER BY user_id";
					$result_set = mysql_query($sql, $connection);
					confirm_query($result_set);
					if(mysql_num_rows($result_set) > 0){
						echo "<table><tr><td>Name</td><td>email</td><td>Version</td><td>Facebook</td><td>Type</td></tr>";
						while($members = mysql_fetch_array($result_set)){
								if($members["fb_access_token"] <> ""){
									$facebook = "yes";
								}else{
									$facebook = "";
								}
								if($members["type"] == "1"){
									$admin = "admin";
								}else{
									$admin = "";
								}
								echo "<tr><td><a href='".$members["user_id"]."'>".$members["fname"]." ".$members["lname"]."</a></td>".
									"<td><a href='".$members["user_id"]."'>".$members["email"]."</a></td>".
									"<td>".$members["version"]."</td>".
									"<td>".$facebook."</td>".
									"<td>".$admin."</td></tr>";
						}
						echo "</table>";
					}
					?>
                </div>
			</td>
		</tr>
	</table>
</div>

<?php
include("../template/body2.php");
?>