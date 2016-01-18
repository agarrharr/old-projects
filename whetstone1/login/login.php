<?php
ob_start();
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");
?>
<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../template/styles.css" />

<?php
//set redirection path to default members page
$_POST['url'] = "../members/";
//redirect away if they are already signed on
if(logged_in()){
	redirect_to("Location: " . $_POST['url']);
}

echo "<title>Login</title>";
echo "<center>
	<br/><br/>
	<a href='index.php'><img src='../images/whetstoneDraft.jpg'/></a>
	<br/><p>Whetstone<br/> Sharpen your sword</p>
	<br/><br/>";

//start form processing
$email = "";
if(isset($_POST['submit'])){
	$email = trim(mysql_prep($_POST['email']));
	$password = trim(mysql_prep($_POST['pass']));
	$hashed_pass = sha1($password);		
	$sql = "SELECT members.user_id, members.email, members.version_id, members.type, max(finishDays.date) ";
	$sql .= "FROM members ";
	$sql .= "LEFT OUTER JOIN finishDays ON members.user_id=finishDays.user_id ";
	$sql .= "WHERE email = '{$email}' ";
	$sql .= "AND hashed_pass = '{$hashed_pass}' ";
	$sql .= "GROUP BY members.user_id, members.email, members.version_id, members.type";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$found_user = mysql_fetch_array($result_set);
		$_SESSION['user_id'] = $found_user['user_id'];
		$_SESSION['email'] = $found_user['email'];
		$_SESSION['version_id'] = $found_user['version_id'];
		$_SESSION['user_type'] = $found_user['type'];
		if(strcmp($found_user['max(finishDays.date)'], date('Y-m-d')) == 0){
			$_SESSION['finishDay'] = 1;
		}else{
			$_SESSION['finishDay'] = 0;
		}
		redirect_to("Location: " . $_POST['url']);
	}else{
		echo "<div class='error'>Email address and password do not match.</div><br/>";
	}
}else{
	echo "<div class='error'>You must be logged in to do that.</div><br/>";
}

echo "<br/><form name='input' action='login.php' method='post'>
	<input name='email' type='text' value='{$email}' placeholder='Email'/>
	<input type='password' name='pass' maxlength='30' placeholder='Password'/>
	<input type='hidden' name='url' value='";
	if(isset($ref)){ echo $ref;}
?>
'><input type='submit' name='submit' value='submit' />
	</form>
</center>