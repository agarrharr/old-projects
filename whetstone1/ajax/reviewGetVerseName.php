<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

echo getVerseName($_GET['verse_id']);
?>