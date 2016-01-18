<?php
	
	require_once("connect.php");
	require_once("functions.php");
	$nav = "
			<a href='../main/index.php'>Home</a><br/>
			<a href='../main/members.php'>Members</a><br/>
			<a href='../main/info.php'>Edit Info</a><br/>
			<a href='../main/change_password.php'>Change Password</a><br/>
			<a href='../main/create_page.php'>Create a New Page</a><br/>
			<a href='../main/change_page.php'>Change a Page</a><br/>
			<a href='../main/delete_page.php'>Delete a Page</a><br/>
			<a href='../main/logout.php'>Log out</a><br/><br/>";
	
	//display the admin navigation if they are an admin
	//notice the backslash is the escape character to show a quotation mark
	$nav .= "<?php
				if(is_admin()){
					echo \"<a href='../admin/privileges.php'>Privileges</a><br/>
						<a href='../admin/view_members.php'>View Members</a><br/>
						<a href='../admin/add_member.php'>Add a Member</a><br/><br/>\";
				}
			?>
			";
	
	$query = "SELECT MAX(menu_index)
				FROM pages;";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
	$menus = $row[0];
	for($x = 1; $x <= $menus; $x++){
		$query = "SELECT MAX(submenu_index)
					FROM pages
					WHERE menu_index = {$x};";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		$row = mysql_fetch_array($result_set);
		$submenus = $row[0];
		$query = "SELECT name, menu_name
					FROM pages
					WHERE menu_index = {$x}
						AND submenu_index = 0
						AND subsubmenu_index = 0;";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		$row = mysql_fetch_array($result_set);
		$nav .= "<a href='../pages/{$row['menu_name']}/{$row['name']}.php'>" . $row[0] . "</a><br/>";
		for($y = 1; $y <= $submenus; $y++){
			$query = "SELECT MAX(subsubmenu_index)
						FROM pages
						WHERE menu_index = {$x}
							AND submenu_index = {$y};";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			$row = mysql_fetch_array($result_set);
			$subsubmenus = $row[0];
			$query = "SELECT name, menu_name
						FROM pages
						WHERE menu_index = {$x}
							AND submenu_index = {$y}
							AND subsubmenu_index = 0;";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			$row = mysql_fetch_array($result_set);
			$nav .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='../pages/{$row['menu_name']}/{$row['name']}.php'>" . $row[0] . "</a><br/>";
			for($z = 1; $z <= $subsubmenus; $z++){
				$query = "SELECT name, menu_name
							FROM pages
							WHERE menu_index = {$x}
								AND submenu_index = {$y}
								AND subsubmenu_index = {$z};";
				$result_set = mysql_query($query, $connection);
				confirm_query($result_set);
				$row = mysql_fetch_array($result_set);
				$nav .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='../pages/{$row['menu_name']}/{$row['name']}.php'>" . $row[0] . "</a><br/>";
			}
		}
	}
?>