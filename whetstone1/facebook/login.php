<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

$app_id = "233665653420678";
$app_secret = "0c77982b8221c10807ce8f1e767c1ef7";
$my_url = "http://mywhetstone.org/facebook/login.php";

session_start();
$code = $_REQUEST["code"];

if(empty($code)) {
	$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
	$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
		. $app_id . "&scope=email&redirect_uri=" . urlencode($my_url) . "&state="
		. $_SESSION['state'];
	
	echo("<script> top.location.href='" . $dialog_url . "'</script>");
}

if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
	$token_url = "https://graph.facebook.com/oauth/access_token?"
		. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
		. "&client_secret=" . $app_secret . "&code=" . $code;
	
	$response = file_get_contents($token_url);
	$params = null;
	parse_str($response, $params);
	
	$graph_url = "https://graph.facebook.com/me?access_token=" 
		. $params['access_token'];
	
	$user = json_decode(file_get_contents($graph_url));
	
	$sql = "SELECT * FROM members WHERE email='" . $user->email . "'";
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$sql = "UPDATE members SET fb_access_token='" . $params['access_token'] . "', fname='" . $user->first_name . "', lname='" . $user->last_name . "' WHERE email='" . $user->email . "'";
	}else{
		$sql = "SELECT * FROM members WHERE fb_access_token='" . $params['access_token'] . "'";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) == 0){
			$sql = "INSERT INTO members (email, fb_access_token, fname, lname) VALUES('" . $user->email . "', '" . $params['access_token'] . "', '" . $user->first_name . "', '". $user->last_name ."')";
		}
	}
	mysql_query($sql, $connection);
	
	$sql = "SELECT members.user_id, members.email, members.version_id, members.type, max(finishDays.date) ";
	$sql .= "FROM members ";
	$sql .= "LEFT OUTER JOIN finishDays ON members.user_id=finishDays.user_id ";
	$sql .= "WHERE fb_access_token='" . $params['access_token'] . "' ";
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
	}
	echo("<script> top.location.href='../members/index.php'</script>");
}
else {
	echo("The state does not match. You may be a victim of CSRF.");
}
?>