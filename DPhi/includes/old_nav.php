//replaced by pages/nav.php

<a href='../index.php'>Home</a><br/>
<a href='../main/members.php'>Members</a><br/>
<a href='../main/info.php'>Info</a><br/>
<a href='../main/change_password.php'>Change Password</a><br/>
<a href='../main/logout.php'>Log out</a><br/>

<?php
	$query = "SELECT name FROM pages;";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		echo $row["name"] . "<br/>";
		$num_rows++;
	}
?>