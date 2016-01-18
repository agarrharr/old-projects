<?php header('Content-Type: text/html; charset=utf-8');
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");
confirm_logged_in();
include("../template/head1.php");

//start form processing
$message = "";
if(isset($_POST['submit'])){
	$password = trim(mysql_prep($_POST['old']));
	$hashed_pass = sha1($password);		
	$sql = "SELECT * ";
	$sql .= "FROM members ";
	$sql .= "WHERE email = '{$_SESSION['email']}' ";
	$sql .= "AND hashed_pass = '{$hashed_pass}';";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		if ($_POST['new1'] == $_POST['new2']){
			$password = trim(mysql_prep($_POST['new1']));
			$hashed_pass = sha1($password);
			$sql = "UPDATE members SET hashed_pass = '{$hashed_pass}'";
			$sql .= "WHERE email = '{$_SESSION['email']}';";
			$result_set = mysql_query($sql, $connection);
			confirm_query($result_set);
			$message = "<p>Your password has been changed.</p>";
		}else{
			$message = "<div class='error'>New passwords don't match.</div>";
		}
	}else{
		$message = "<div class='error'>Old password is incorrect.</div><br/>";
	}
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
					Change your password:<br/><br/>
					<form action="password.php" method="post">
						<table border="0">
						<tr><td>Old Password:</td><td><input type="password" name="old" id="old"/></td></tr>
						<tr><td>New Password:</td><td><input type="password" name="new1" id="new1"/></td></tr>
						<tr><td>New Password:</td><td><input type="password" name="new2" id="new2"/></td></tr>
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