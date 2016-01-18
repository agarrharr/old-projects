<?php header('Content-Type: text/html; charset=utf-8');
require_once("../includes/session.php");
require_once("../includes/functions.php");
confirm_logged_in();
include("../template/head1.php");
?>

<script src="../js/jquery-1.7.min.js"></script>
<script src="../ajax/ajaxFunctions.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	addVerse();
});
</script>

<?php
include("../template/body1.php");
?>

<div id="all">
	<table width="100%" border="0" style="table-layout:fixed;word-wrap:break-word;">
		<tr valign='top'>
			<td width="400">
				<div id="middlePane"></div>
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