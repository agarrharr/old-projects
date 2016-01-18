<?php
	if(isset($_POST['submit'])){
		$email = trim(mysql_prep($_POST['email']));
		$phone = trim(mysql_prep($_POST['phone']));	
		$provider = trim(mysql_prep($_POST['provider']));
		$query = "UPDATE members ";
		$query .= "SET email = '{$email}', ";
		$query .= "phone = '{$phone}', ";
		$query .= "provider = '{$provider}' ";
		$query .= "WHERE id = {$_SESSION['user_id']};";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
	}
?>