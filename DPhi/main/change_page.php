<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	confirm_logged_in();
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi- Change the Page</title>";
	
	include("../includes/layout/h2.php");
	include("../pages/nav.php");
	include("../includes/layout/b1.php");
	
	
	include("../includes/validate_create_page.php");
	
	//get all the pages in the order that they are on the left navigation
	$query = "SELECT pages.name, pages.menu_name, pages.menu_index, pages.submenu_index, pages.subsubmenu_index
				FROM pages, priv
				WHERE pages.menu_name = priv.dir
				AND priv.member_id = {$_SESSION['user_id']}
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
	
	//form to select which page to edit
	echo "<form action='change_page.php' method='POST' name='form'><select name='page'>";
	for($i=0; $i<$num_rows; $i++){
		echo "<option value='{$i}' ";
			if(isset($_POST['submit']) && isset($_POST['page']) && $_POST['page'] == $i)
				echo "selected";
		echo ">" . $names[$i] . "</option>";
	}
	echo "</select>
			<input type='submit' name='submit' value='Edit'></form>";
	
	//if there is a GET variable make a POST variable
	if(isset($_GET['page'])){
		$_POST['page'] = $_GET['page'];
		$_POST['submit'] = "submit";
	}
	
	//when they select which page, this is the form to edit it
	if(isset($_POST['submit']) && isset($_POST['page'])){
		$page = $names[$_POST['page']];
		$menu = $menu_names[$_POST['page']];
		
		//read the file
		$myFile = "../pages/{$menu}/{$page}.php";
		$fh = fopen($myFile, "r");
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
		
		//search it for the div tag
		mb_ereg_search_init($theData, "<div class='info'>");
		$arro = mb_ereg_search_pos("<div class='info'>");
		mb_ereg_search_init($theData, "</div>");
		$arroc = mb_ereg_search_pos("</div>");
		echo  "<form action='change_page.php' method='POST'>
				<textarea rows='15' cols='40' name='body'>";
		
		//get the substring between the tags and get rid of the whitespace before and after
		echo trim(strip_tags(substr($theData, $arro[0] + $arro[1], $arroc[0] - ($arro[0] + $arro[1]))));
		echo "</textarea>
				<input type='hidden' name='x' value='{$x[$_POST['page']]}'>
				<input type='hidden' name='y' value='{$y[$_POST['page']]}'>
				<input type='hidden' name='z' value='{$z[$_POST['page']]}'>
				<input type='hidden' name='name' value='{$page}'>
				<input type='hidden' name='html' value='n'>
				<input type='hidden' name='nav' value='n'>
				<input type='submit' name='submit' value='Save'>
				</form>";
	}
	
	include("../includes/layout/b2.php");
?>