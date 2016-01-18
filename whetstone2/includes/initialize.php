<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'Users'.DS.'aharris88'.DS.'dropbox'.DS.'sites'.DS.'adamHarris-whetstoneNew');
//defined('SITE_ROOT') ? null : define('SITE_ROOT', '..');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes/');

if(!defined('URL_ROOT')){
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://" . $_SERVER["SERVER_NAME"];
	if($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= ":" . $_SERVER["SERVER_PORT"].DS."/adamHarris-whetstoneNew";
	}
	define('URL_ROOT', $pageURL);
}

//load config file first
require_once(LIB_PATH.'config.php');
//load basic functions next so that everything after can use them
require_once(LIB_PATH.'functions.php');
//load coe objects
require_once(LIB_PATH.'database_object.php');
require_once(LIB_PATH.'session.php');
require_once(LIB_PATH.'database.php');
require_once(LIB_PATH.'log.php');
//load database-related classes
require_once(LIB_PATH.'user.php');
require_once(LIB_PATH.'verse.php');
require_once(LIB_PATH.'card.php');
require_once(LIB_PATH.'book.php');
require_once(LIB_PATH.'version.php');

$session = new Session();
$session->set_last_page();
$user = User::find_by_session();
?>