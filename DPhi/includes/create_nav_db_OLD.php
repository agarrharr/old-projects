<?php
	//get index variables to know where in the nav to store it
	$x = $_POST['x'];
	$y = $_POST['y'];
	$z = $_POST['z'];
	//get menu name to insert into table
	$query = "SELECT menu_index
				FROM pages
				WHERE menu_index = {$x}
				AND submenu_index = 0
				AND subsubmenu_index = 0;";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
	$menu_name = $row[0];
	
	echo $x . $y . $z;
						
	//find all menus that need to be moved
	if($x != 0){
		$query = "SELECT MAX(menu_index) 
					FROM pages;";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		$row = mysql_fetch_array($result_set);
		$max_menus = $row[0];
		if($max_menus >= $x){
			if($y != 0){
				$query = "SELECT MAX(submenu_index) 
							FROM pages;";
				$result_set = mysql_query($query, $connection);
				confirm_query($result_set);
				$row = mysql_fetch_array($result_set);
				$max_submenus = $row[0];
				if($max_submenus >= $y){
					if($z != 0){
						$query = "SELECT MAX(subsubmenu_index) 
									FROM pages;";
						$result_set = mysql_query($query, $connection);
						confirm_query($result_set);
						$row = mysql_fetch_array($result_set);
						$max_subsubmenus = $row[0];
						if($max_subsubmenus >= $z){
							echo "//need to add one to every subsubmenu >= z";
							$query = "UPDATE pages
										SET subsubmenu_index = subsubmenu_index + 1
										WHERE subsubmenu_index >= {$z}
											AND submenu_index == {$y}
											AND menu_index == {$x}
										ORDER BY submenu_index DESC;";
							$result_set = mysql_query($query, $connection);
							confirm_query($result_set);
						}else{
							echo "//no prob, just add it in the subsubmenu";
						}
					}else{
						echo "//need to add one to every submenu >= y";
						$query = "UPDATE pages
									SET submenu_index = submenu_index + 1
									WHERE submenu_index >= {$y}
										AND menu_index == {$x}
									ORDER BY submenu_index, menu_index DESC;";
						$result_set = mysql_query($query, $connection);
						confirm_query($result_set);
					}
				}else{
					echo "//no prob, just add it in the submenu";
				}
			}else{
				echo "//need  to add one to every menu >= $x";
				$query = "UPDATE pages
							SET menu_index = menu_index + 1
							WHERE menu_index >= {$x}
							ORDER BY menu_index DESC;";
				$result_set = mysql_query($query, $connection);
				confirm_query($result_set);
			}
		}else{
			echo "//no prob, just add it in the menu";
		}
		$query = "INSERT INTO pages
					VALUES ('{$name}', {$x}, {$y}, {$z}, '{$menu_name}');";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
	}
?>