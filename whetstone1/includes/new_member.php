<?php
	//start form processing
	include("connect.php");
	include("functions.php");
	require_once("connect.php");
	if(isset($_POST['submit'])){
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		$email = trim(mysql_prep($_POST['email']));
		$query = "INSERT INTO members (email, hashed_pass)
					VALUES ('{$email}', '{$hashed_password}');";
		$result_set = mysql_query($query);
		confirm_query($result_set);
		if($result_set){
			redirect_to("Location: ?message=1");
		}else{
			redirect_to("Location: ?message=2");
		}
	}
?>