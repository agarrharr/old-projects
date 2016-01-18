<?php
	//get index variables to know where in the nav to store it
	$x = $_POST['x'];
	$y = $_POST['y'];
	$z = $_POST['z'];
	
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
						}else{
							echo "//no prob, just add it in the subsubmenu";
						}
					}else{
						echo "//need to add one to every submenu >= y";
					}
				}else{
					echo "//no prob, just add it in the submenu";
				}
			}else{
				echo "//need  to add one to every menu >= $x";
			}
		}else{
			echo "//no prob, just add it in the menu";
			
		}
	}
?>