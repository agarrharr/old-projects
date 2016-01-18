<?php header('Content-Type: text/html; charset=utf-8');
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");
confirm_logged_in();
include("../template/head1.php");

//start form processing
$message = "";
if(isset($_POST['submit'])){
	$sql = "UPDATE members SET version_id=" . $_POST['version_id'] . " WHERE user_id=" . $_SESSION['user_id'];
	$_SESSION['version_id'] = $_POST['version_id'];
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
}


include("../template/body1.php");
?>

<div id="all">
	<table width="100%" border="0" style="table-layout:fixed;word-wrap:break-word;">
		<tr valign='top'>
			<td width="400">
				<div id="middlePane"></div>
			</td>
			<td>
				<div id="rightPane">
					<?php echo $message . "<br/>"; ?>
					<a href="password.php">Change your password</a><br/><br/>
					<form action="settings.php" method="post">
						<table border="0">
                        <tr><td>Default Version:</td><td><?php include("../ajax/showVersions.php"); ?> (Note: this does not change the version of previously added verses)</td></tr>
						<tr><td>&nbsp;</td><td><input type="submit" name="submit" id="submit" value="Submit"/></td></tr>
						</table>
					</form>
				</div>
			</td>
		</tr>
	</table>
</div>

<?php
include("../template/body2.php");
?>