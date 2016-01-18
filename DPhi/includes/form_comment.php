<?php

	$page_name = curPageName();
	$date = date( 'Y-m-d H:i:s',  mktime(date("H"), date("i"), date("s"), date("m"), date("d")+1, date("y")) );
	
	if(isset($_POST['submit'])){
		$query = "INSERT INTO comments VALUES({$_POST['user_id']}, '{$_POST['page']}', '{$_POST['timestamp']}', '{$_POST['comment']}');";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
	}
	
	echo "<form action='{$page_name}' method='POST'>
			<textarea name = 'comment' rows='10' cols='30'></textarea></br>
			<input type='hidden' name='user_id' value='{$_SESSION['user_id']}'>
			<input type='hidden' name='page' value='{$page_name}'>
			<input type='hidden' name='timestamp' value='{$date}'>
			<input type='submit' name='submit' value='submit'>
		</form>";

	//echo "The current page name is ". curPageName() . "<br>" . $date;
	
	//now put all the previous comments for this page
	$query = "SELECT comments.date, members.fname, members.lname, comments.comment
				FROM comments, members
				WHERE page_name = '{$page_name}'
				AND comments.member_id = members.id;";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		$fnames[$num_rows] = $row["fname"];
		$lnames[$num_rows] = $row["lname"];
		$dates[$num_rows] = $row["date"];
		$comments[$num_rows] = $row["comment"];
		
		echo $fnames[$num_rows] . " " . $lnames[$num_rows] . "- " . $dates[$num_rows] . "</br>" . $comments[$num_rows] . "</br>";
		$num_rows++;
	}
?>