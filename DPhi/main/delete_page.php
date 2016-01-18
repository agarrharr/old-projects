<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	confirm_logged_in();
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi- Delete the Page</title>";
	
	include("../includes/layout/h2.php");
	include("../pages/nav.php");
	include("../includes/layout/b1.php");
	
	
	include("../includes/validate_create_page.php");
	
	//get all the pages that they have priviledge to access except for the main menus
	$query = "SELECT pages.name, pages.menu_name, pages.menu_index, pages.submenu_index, pages.subsubmenu_index
				FROM pages, priv
				WHERE pages.menu_name = priv.dir
				AND priv.member_id = {$_SESSION['user_id']}
				AND pages.submenu_index != 0
				ORDER BY menu_index, submenu_index, subsubmenu_index;";
	
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		$names[$num_rows] = $row["name"];
		$menu_names[$num_rows] = $row["menu_name"];
		$x[$num_rows] = $row["menu_index"];
		$y[$num_rows] = $row["submenu_index"];
		$z[$num_rows] = $row["subsubmenu_index"];
		$num_rows++;
	}
	
	//form to select which page to delete
	echo "<form action='delete_page.php' method='POST' name='form'><select name='page'>";
	for($i=0; $i<$num_rows; $i++){
		echo "<option value='{$i}' ";
			if(isset($_POST['submit']) && isset($_POST['page']) && $_POST['page'] == $i)
				echo "selected";
		echo ">" . $names[$i] . "</option>";
	}
	echo "</select>
			<input type='submit' name='submit' value='Delete'></form>";
	
	//when they select which page, this is the form to edit it
	if(isset($_POST['submit']) && isset($_POST['page'])){
		$page = $names[$_POST['page']];
		$menu = $menu_names[$_POST['page']];
		
		echo "<form action='delete_page.php' method='POST'>
				<input type='hidden' name='page' value='{$_POST['page']}'/>
				<input type='hidden' name='delete' value='delete'/>
				<input type='submit' name='submit' value='Are you sure you want to delete \"{$names[$_POST['page']]}\"?'/>
				</form>";
		
		if(isset($_POST['submit']) && isset($_POST['delete'])){
			//read the file
			$myFile = "../pages/{$menu}/{$page}.php";
			unlink($myFile);
			
			$query = "DELETE FROM pages
						WHERE name = '{$page}';";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			
			include("../includes/create_nav_page.php");
			
			echo "File is deleted.";
		}
	}
	
	include("../includes/layout/b2.php");
?>