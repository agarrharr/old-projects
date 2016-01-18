<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

$verse_id = $_GET["verse_id"];
$correct = $_GET["correct"];

$sql = "UPDATE verses SET correctLast = " . $correct . ", timesTotal = timesTotal+1, correctTotal = correctTotal+" . $correct . ", reviewedLast=curdate() WHERE user_id=" . $_SESSION["user_id"] . " AND verse_id=" . $verse_id;

$result_set = mysql_query($sql, $GLOBALS['connection']);
confirm_query($result_set);
?>