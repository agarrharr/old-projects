<?php
	if(isset($_POST['submit'])){
		$old = trim(mysql_prep($_POST['old']));
		$new1 = trim(mysql_prep($_POST['new1']));
		$new2 = trim(mysql_prep($_POST['new2']));
		$hashed_old = sha1($old);
		$hashed_new = sha1($new1);
		$query = "SELECT *";
		$query .= "FROM members ";
		$query .= "WHERE id = '{$_SESSION['user_id']}' ";
		$query .= "AND hashed_pass = '{$hashed_old}';";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) >= 1){
		
			if($new1 != $new2){
				echo "The new password does not match the confirmation.";
			}else{
				$query = "UPDATE members ";
				$query .= "SET hashed_pass = '{$hashed_new}'";
				$query .= "WHERE id = {$_SESSION['user_id']};";
				$result_set = mysql_query($query, $connection);
				confirm_query($result_set);
			}
		}
		else{
			echo "That is not the correct password.";
		}
	}
?>