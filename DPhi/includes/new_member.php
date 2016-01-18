<?php
	//need to make create member for admins because members won't just sign up, they have to be added

	//start form processing
	include("../includes/connect.php");
	include("../includes/functions.php");
	require_once("../includes/connect.php");
	if(isset($_POST['submit'])){
		$fname = ucwords(trim(mysql_prep($_POST['fname'])));
		$lname = ucwords(trim(mysql_prep($_POST['lname'])));
		$uname = ucwords(trim(mysql_prep($_POST['uname'])));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		$email = trim(mysql_prep($_POST['email']));
		$phone = trim(mysql_prep($_POST['phone']));
		$provider = trim(mysql_prep($_POST['provider']));
		$query = "INSERT INTO members (
					fname, lname, uname, email, phone, provider, hashed_pass
					) VALUES (
						'{$fname}', '{$lname}', '{$uname}', '{$email}', '{$phone}', '{$provider}', '{$hashed_password}'
					);";
		$result_set = mysql_query($query);
		confirm_query($result_set);
		if($result_set){
			//require("includes/email.php");
			//email_new_member($name);
			redirect_to("Location: ?message=3");
		}else{
			$message = "The user could not be created. Sorry, try again.";
			$message .= "<br />" . mysql_error();
		}
	}
?>