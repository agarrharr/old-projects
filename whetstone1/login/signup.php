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

echo "<title>Sign Up</title>";
echo "<center><br/><br/><a href='index.php'><img src='../images/whetstoneDraft.jpg'/></a>
	<br/><p class='cursive'>Whetstone<br/> Sharpen your sword</p>";

$email = "";
if(isset($_POST['email'])){
	if($_POST['new1'] == $_POST['new2']){
		$email = trim(mysql_prep($_POST['email']));
		$password = $_POST['new1'];
		$sql = "SELECT * FROM members WHERE email='" . $email . "'";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) == 0){
			$hashed_pass = sha1(trim(mysql_prep($password)));
			$code = rand(0, 1000);
			$query = "INSERT INTO members (email, hashed_pass, code) VALUES ('" . $email . "', '" . $hashed_pass . "', " . $code . ");";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			$subject = "Whetstone Registration";
			$body = "Hi,<br/><br/>Thanks for registering! To complete your registration click this link:<br/><a href='http://www.myWhetstone.org/login/registerEmail.php?email=" . urlencode($email) . "&code=" . $code . "'>http://www.myWhetstone.org/login/registerEmail.php?email=" . urlencode($email) . "&code=" . $code . "</a>";
			$headers = "From: " . strip_tags('adam@a.com') . "\r\n";
			$headers .= "Reply-To: ". strip_tags('adam@a.com') . "\r\n";
			//$headers .= "CC: susan@example.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			if(mail($email, $subject, $body, $headers)){
				echo "<p>Please check your email and click the link to complete your registration.</p>";
			}else{
				echo "Your registration email was not sent. Please email Adam at adam@a.com and he will fix it for you.";
			}
		}else{
			echo "Someone is already registered with this email address.";
		}
	}else{
		echo "The passwords don't match.";
		showForm();
	}
}else{
 showForm();
}

function showForm(){
	echo "<form method='POST' action='signup.php'>";
	echo "<table border='0'>";
	echo "<tr><td>Email:</td><td><input type='text' id='email' name='email'/></td></tr>";
	echo "<tr><td>New Password:</td><td><input type='password' name='new1' id='new1'/></td></tr>";
	echo "<tr><td>New Password:</td><td><input type='password' name='new2' id='new2'/></td></tr>";
	echo "<tr><td>&nbsp;</td><td><input type='submit' name='submit' id='submit' value='Submit'/></td></tr>";
	echo "</table>";
	echo "</form>";
}
?>
