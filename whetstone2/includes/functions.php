<?php
function include_layout_template($template=""){
	global $user;
	global $session;
	include(SITE_ROOT.DS.'public_html'.DS.'layouts'.DS.$template.'.php');
}

function strip_zeros_from_date($marked_string=""){
	//for use with strftime() function
	//just put * in front of any part that you want leading zeros removed
	//example: strip_zeros_from_date(strftime("The date is *%m/*$d/%y", time()))
	$no_zeros = str_replace('*0', '', $marked_string);
	$cleaned_string = str_replace('*', '', $no_zeros);
	return $cleaned_string;
}

function redirect_to($location = NULL){
	if($location != NULL){
		header("Location: {$location}");
		exit;
	}
}

function __autoload($class_name){
	$class_name = strtolower($class_name);
	$path = LIB_PATH.DS . $class_name . ".php";
	if(file_exists($path)){
		require_once($path);
	}else{
		die("The file " . $class_name . ".php could not be found.");
	}
}
?>