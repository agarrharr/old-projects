<?php
	if(isset($_POST['submit'])){
		$fname = trim(mysql_prep($_POST['fname']));
		$lname = trim(mysql_prep($_POST['lname']));
		$name = $fname . $lname;
		$email = trim(mysql_prep($_POST['email']));	
		$temp_pass = trim(mysql_prep($_POST['temp_pass']));
		$hashed_temp_pass = sha1($temp_pass);
		$uname = $fname . "." . $lname;
		$query = "INSERT INTO members ";
		$query .= "(fname, lname, uname, email, hashed_pass)";
		$query .= "VALUES ('{$fname}', '{$lname}', '{$uname}', '{$email}', '{$hashed_temp_pass}');";
		echo $query;
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		include("email.php");
		email_new_member($name, $email);
	}
?>