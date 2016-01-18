<?php
	require_once("../includes/session.php");
	require_once("../includes/functions.php");
	confirm_logged_in();
	confirm_admin();
	require_once("../includes/connect.php");
	include("../includes/layout/h1.php");
	
	echo "<title>Delta Phi Xi- privileges</title>";
	
	include("../includes/layout/h2.php");
	include("../pages/nav.php");
	include("../includes/layout/b1.php");
	
	//add the privilege to the database
	if(isset($_POST['submit'])){
		$member_id = $_POST['member'];
		$dir = $_POST['dir'];
		$query = "INSERT INTO priv VALUES({$member_id}, '{$dir}');";
		$result_set = mysql_query($query, $connection);
		if(!$result_set)
			echo "That privilege already exists.";
		}
	
	//put all the directories within pages in a drop down menu
	$form = "<form action='privileges.php' method='POST'><select name='dir'>";
	 if ($handle = opendir('../pages'))
	 {
		while (false !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != "..")
			{
				if(substr($file, strlen($file) - 4, 4) != ".php")
				$form .= "<option value='{$file}'>{$file}</a></br>";
			}
		}
		$form .= "</select>";
		closedir($handle);
	}
	
	//find all the members and put them in a drop down menu
	$query = "SELECT *
				FROM members;";
	
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		$ids[$num_rows] =  $row["id"];
		$fnames[$num_rows] =  $row["fname"];
		$lnames[$num_rows] =  $row["lname"];
		$num_rows ++;
	}
	
	$form .= "<select name='member' onchange='this.form.submit();'>";
		for($i = 0; $i < $num_rows; $i++){
			$form .= "<option value='{$ids[$i]}'>{$lnames[$i]}, {$fnames[$i]}</a></br>";
		}
	$form .= "</select>";

	$form .= "<input type='submit' name='submit' value='Add privilege'></form>";
	
echo "<P>{$form}</p>
<P>List of privileges:</p>";


	$query = "SELECT priv.member_id, priv.dir, members.fname, members.lname
				FROM priv, members
				WHERE priv.member_id = members.id;";
	
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	$num_rows = 0;
	while($row = mysql_fetch_array($result_set)){
		echo $row["fname"] . " " . $row["lname"] . "- " . $row["dir"] . "</br>";
		$num_rows ++;
	}
	
	include("../includes/layout/b2.php");
?>