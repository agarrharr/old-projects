<?php
	require_once("session.php");
	require_once("../includes/functions.php");	
	require_once("../includes/connect.php");

	if(isset($_POST['submit'])){
		$uname = trim(mysql_prep($_POST['uname']));
		$password = trim(mysql_prep($_POST['pass']));
		$hashed_pass = sha1($password);
		$query = "SELECT *";
		$query .= "FROM members ";
		$query .= "WHERE uname = '{$uname}' ";
		$query .= "AND hashed_pass = '{$hashed_pass}';";
		//echo $query;
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) == 1){
			$found_user = mysql_fetch_array($result_set);
			$_SESSION['user_id'] = $found_user['id'];
			$_SESSION['type'] = $found_user['type'];
			$_SESSION['fname'] = $found_user['fname'];
			$_SESSION['lname'] = $found_user['lname'];
			$_SESSION['uname'] = $found_user['uname'];
			$_SESSION['email'] = $found_user['email'];
			$_SESSION['phone'] = $found_user['phone'];
			$_SESSION['provider'] = $found_user['provider'];
			redirect_to("Location: ../main/members.php");
		}else{
			redirect_to("Location: ../main/index.php?e=1&u={$uname}");
		}
	}else{
		redirect_to("Location: ../main");
	}
?>