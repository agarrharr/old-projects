<?php
require_once('../../includes/initialize.php');

$type = isset($_GET['type']) ? $_GET['type'] : 'login';
$logs = new Log($type);

if(isset($_GET['clear']) && $_GET['clear'] == "true"){
	$logs->clear_log();
}

include_layout_template('admin_header');
echo $session->protected_content();
include_layout_template('admin_footer');

function content(){
	global $type, $logs;
	
	echo "<h1>" . ucfirst($type). " Log File</h1>";
	$logs->show_log_files();
	$logs->show_log();
	echo "<p><a href='logs.php?type=" . $type . "&clear=true'>Clear " . ucfirst($type) . " Log File</a></p>";
}
?>