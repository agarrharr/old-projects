<?php
	//Make main navigation page
	$FileName = "../pages/nav.php";
	$FileHandle = fopen("../pages/nav.php", 'w') or die("can't open file");
	require("../includes/nav_members.php");
	fwrite($FileHandle, $nav);
	fclose($FileHandle);
	
	//Make navigation page for the created pages because they are one directory lower than every other page
	$FileName2 = "../pages/nav_for_pages.php";
	$FileHandle2 = fopen("../pages/nav_for_pages.php", 'w') or die("can't open file");
	require("../includes/nav_members_for_pages.php");
	fwrite($FileHandle2, $nav);
	fclose($FileHandle2);
?>