<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");
?>
<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../template/styles.css" />

<?php
//redirect away if they are already signed on
if(logged_in()){
	redirect_to("Location: ../members/");
}

echo "<title>Register</title>";
echo "<center><br/><br/><a href='index.php'><img src='../images/whetstoneDraft.jpg'/></a>
	<br/><p class='cursive'>Whetstone<br/> Sharpen your sword</p>";

$email = $_GET["email"];
$code = $_GET["code"];

$sql = "SELECT * FROM members WHERE email='" . $email . "' AND code=" . $code;
$result_set = mysql_query($sql, $connection);
confirm_query($result_set);
if(mysql_num_rows($result_set) == 1){
	$sql = "UPDATE members SET code=NULL WHERE email='" . $email . "' AND code=" . $code;
	$result_set = mysql_query($sql, $connection);
	confirm_query($result_set);
	echo "Thank you for registering! You can <a href='../index.php'>log in</a> now";
}else{
	echo "That doesn't match. Maybe you already registered.";
}
?>