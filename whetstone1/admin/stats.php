<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
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
				<div id="rightPane"></div>
			</td>
		</tr>
	</table>
</div>

<?php
include("../template/body2.php");
?>