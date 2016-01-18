<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	require_once("../includes/connect.php");
	
	if(isset($_POST['submit']) && isset($_POST['name']))
	{
		$name = $_POST['name'];
		$html = $_POST['html'];
		$x = $_POST['x'];
		$y = $_POST['y'];
		$z = $_POST['z'];
		
		//make the directory if it is a main menu
		if(($y == 0) && ($z== 0)){
			$dir = $name;
			$FileName = "../pages/{$dir}";
			//of course, check to make sure the directory doesn't already exist
			if(!file_exists($FileName))
				mkdir($FileName) or die("can't make directory");
		}
		else{
			echo $x;
			$query = "SELECT name
						FROM pages
						WHERE menu_index = {$x}
							AND submenu_index = 0
							AND subsubmenu_index = 0;";
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			if(mysql_num_rows($result_set) == 1){
				$found = mysql_fetch_array($result_set);
				$dir = $found['name'];
			}
		}
		
		if(!isset($_POST['nav']) || $_POST['nav'] != 'n'){
			require("../includes/create_nav_db.php");
			require("../includes/create_nav_page.php");
		}
		
		//make the main text of the page
		//add a tag to easily parse the text
		$body = "
			<?php
				require_once('../../includes/session.php');
				require_once('../../includes/functions.php');
				confirm_logged_in();
				require_once('../../includes/connect.php');
				include('../../includes/layout/h1.php');
				echo '<title>Delta Phi Xi- {$name}</title>';
				include('../../includes/layout/h2.php');
				include('../nav_for_pages.php');
				include('../../includes/layout/b1.php');
				echo \"<div class='info'>
		";
		if($html == 'n')
			$body .=  nl2br(strip_tags($_POST['body']));
		else
			$body .=  $_POST['body'];
		$body .= "
				</div>\";
				include('../../includes/form_comment.php');
				include('../../includes/layout/b2.php');
				?>";
				
		//create the file
		$FileName = "../pages/{$dir}/{$name}.php";
		//$FileName = "../pages/{$name}.php";
		$FileHandle = fopen($FileName, 'w') or die("can't open file");
		
		//write to the file
		fwrite($FileHandle, $body);
		fclose($FileHandle);
		
		//then redirect to the newly made file
		redirect_to("Location: ../pages/{$dir}/{$name}.php");
	}
?>