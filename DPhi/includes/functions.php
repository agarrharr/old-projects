<?php

function check_required_fields($required_fields, $_POST){
	$errors = array();
	foreach($required_fields as $fieldname){
		if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	return $errors;
}

function check_max_field_lengths($fields_with_lengths, $POST){
	$errors = array();
	foreach($fields_with_lengths as $fieldname){
		$errors[] = odbc_field_len ($_POST[$fieldname]);
	}
	return $errors;
}
function check_password($passwords, $POST){
	$errors = array();
	foreach($passwords as $fieldname){
		if($_POST[$fieldname] != $_POST['password2']){
			$errors[] = $fieldname;
		}
	}
	return $errors;
}

function mysql_prep($value){
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists("mysql_real_escape_string");
	if($new_enough_php){
		if($magic_quotes_active){ $value = stripslashes($value); }
	}else{
		if(!$magic_quotes_active){ $value = addslashes($value); }
	}
	return $value;
}

function redirect_to($location = NULL){
	if($location != NULL){
		header("{$location}");
		exit;
	}
}

function confirm_query($result_set){
	if(!$result_set){
		die("Database query failed: " . mysql_error());
	}
}

function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>