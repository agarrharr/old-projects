<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	confirm_logged_in();
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi- Create a Page</title>";
	
	include("../includes/layout/h2.php");
	include("../pages/nav.php");
	include("../includes/layout/b1.php");
	
	
	//include("../includes/validate_create_page.php");
	
	echo "Select where to place the new page:";
	
	//get all directories they have access to
	$query = "SELECT dir, pages.menu_index as x
				FROM priv, pages
				WHERE priv.dir = pages.name
				AND priv.member_id = {$_SESSION['user_id']}
				ORDER BY pages.menu_index;";
	
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		$dirs[$num_rows] = $row["dir"];
		$x[$num_rows] = $row["x"];
		$num_rows++;
	}
	
	//form to select which directory to edit
	echo "<form action='create_page.php' method='POST' name='form'><select name='x'>";
	for($i=0; $i<$num_rows; $i++){
		echo "<option value='{$x[$i]}' ";
			if(isset($_POST['submit']) && isset($_POST['x']) && $_POST['x'] == $x[$i])
				echo "selected";
		echo ">" . $dirs[$i] . "</option>";
	}
	//also, there is an option to create a new menu at the end
	if($_SESSION['type'] == 0){
		$extra = $num_rows + 1;
		echo "<option value='{$extra}' ";
			if(isset($_POST['submit']) && isset($_POST['x']) && $_POST['x'] == $extra)
				echo "selected";
		echo ">*New Menu</option>";
	}
	
	echo "</select>
			<input type='submit' name='submit' value='OK'></form>";
	
	
	//if they want to add a new menu
	if(isset($_POST['submit']) && isset($_POST['x']) && $_POST['x'] > $num_rows){
		$_POST['y'] = 0;
		$_POST['z'] = 0;
	}else{
		//when they select which directory...
		if(isset($_POST['submit']) && isset($_POST['x'])){
			//get all submenus from the menu they selected
			$query = "SELECT name, submenu_index as y
						FROM pages
						WHERE menu_index = {$_POST['x']}
						AND submenu_index != 0
						AND subsubmenu_index = 0
						ORDER BY submenu_index;";
		
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			$num_rows = 0;
			while($row = mysql_fetch_array($result_set)){
				$sub_menus[$num_rows] = $row["name"];
				$y[$num_rows] = $row["y"];
				$num_rows++;
			}
			
				//form to select which submenu to edit
				echo "<form action='create_page.php' method='POST' name='form'><select name='y'>";
				for($i=0; $i<$num_rows; $i++){
					echo "<option value='{$y[$i]}' ";
						if(isset($_POST['submit']) && isset($_POST['y']) && $_POST['y'] == $y[$i])
							echo "selected";
					echo ">" . $sub_menus[$i] . "</option>";
				}
				//also, there is an option to create a new menu at the end
				$extra = $num_rows+1;
				echo "<option value='{$extra}' ";
					if(isset($_POST['submit']) && isset($_POST['y']) && $_POST['y'] == $extra)
						echo "selected";
				echo ">*New Submenu</option>";
				
				echo "</select>
						<input type='hidden' name='x' value='{$_POST['x']}'/>
						<input type='submit' name='submit' value='OK'></form>";
				
				//if they want to add a new submenu
				if(isset($_POST['submit']) && isset($_POST['y']) && $_POST['y'] > $num_rows){
					$_POST['z'] = 0;
				}else{
					//when they select which submenu...
					if(isset($_POST['submit']) && isset($_POST['y'])){
						//get all subsubmenus from the submenu they selected
						$query = "SELECT name, subsubmenu_index as z
									FROM pages
									WHERE menu_index = {$_POST['x']}
									AND submenu_index = {$_POST['y']}
									AND subsubmenu_index!= 0
									ORDER BY subsubmenu_index;";
					
						$result_set = mysql_query($query, $connection);
						confirm_query($result_set);
						$num_rows = 0;
						while($row = mysql_fetch_array($result_set)){
							$subsub_menus[$num_rows] = $row["name"];
							$z[$num_rows] = $row["z"];
							$num_rows++;
						}
						
							//form to select which submenu to edit
							echo "<form action='create_page.php' method='POST' name='form'><select name='z'>";
							for($i=0; $i<$num_rows; $i++){
								echo "<option value={$z[$i]}";
									if(isset($_POST['submit']) && isset($_POST['z']) && $_POST['z'] == $z[$i])
										echo "selected";
								echo ">" . $subsub_menus[$i] . "</option>";
							}
							//also, there is an option to create a new menu at the end
							$extra = $num_rows+1;
							echo "<option value={$extra}";
								if(isset($_POST['submit']) && isset($_POST['z']) && $_POST['z'] == 'after')
									echo "selected";
							echo ">*New SubSubMenu</option>";
							
							echo "</select>
									<input type='hidden' name='x' value='{$_POST['x']}'/>
									<input type='hidden' name='y' value='{$_POST['y']}'/>
									<input type='submit' name='submit' value='OK'></form>";
					}
				}
			}
		}
	//when they select the subsubmenu...
	if(isset($_POST['submit']) && isset($_POST['z'])){
		echo $_POST['x'].$_POST['y'].$_POST['z'];
		include("../includes/form_create_page.php");
	}
				
	include("../includes/layout/b2.php");
?>