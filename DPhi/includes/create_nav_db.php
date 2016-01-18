<?php
	//get index variables to know where in the nav to store it
	$x = $_POST['x'];
	$y = $_POST['y'];
	$z = $_POST['z'];
	
	echo $x . $y . $z;
						
	//find all menus that need to be moved
	$query = "SELECT *
				FROM pages
				WHERE menu_index = {$x}
				AND submenu_index = {$y}
				AND subsubmenu_index = {$z};";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$returned_rows = mysql_num_rows ($result_set);
	if($returned_rows != 0){
		if($y == 0){			
			$query = "UPDATE pages
						SET menu_index = menu_index + 1
						WHERE menu_index >= {$x}
						ORDER BY menu_index DESC;";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
		}else if ($z == 0){
			$query = "UPDATE pages
						SET submenu_index = submenu_index + 1
						WHERE submenu_index >= {$y}
							AND menu_index = {$x}
						ORDER BY submenu_index DESC;";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
		}
		else{
			$query = "UPDATE pages
						SET subsubmenu_index = subsubmenu_index + 1
						WHERE subsubmenu_index >= {$z}
							AND submenu_index = {$y}
							AND menu_index = {$x}
						ORDER BY subsubmenu_index DESC;";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
		}
	}
	
	//get menu name to insert into table
	$query = "SELECT name
				FROM pages
				WHERE menu_index = {$x}
				AND submenu_index = 0
				AND subsubmenu_index = 0;";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
	$menu_name = $row[0];
	
	if(!isset($menu_name))
		$menu_name = $name;
	
	$query = "INSERT INTO pages
				VALUES ('{$name}', {$x}, {$y}, {$z}, '{$menu_name}');";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
?>