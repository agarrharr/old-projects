<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

$sql = "UPDATE members ";
$sql .= "SET weekly = CASE WHEN weekly > 6 THEN 1 ELSE weekly + 1 END, monthly = CASE WHEN monthly > 30 THEN 1 ELSE monthly + 1 END, yearly = CASE WHEN yearly > 364 THEN 1 ELSE yearly + 1 END ";
$sql .= "WHERE user_id=" . $_SESSION['user_id'] . " ";
$result_set = mysql_query($sql, $connection);
confirm_query($result_set);

$sql = "INSERT INTO finishDays VALUES(" . $_SESSION['user_id'] . ", '" . date('Y-m-d') . "')";
$result_set = mysql_query($sql, $connection);
confirm_query($result_set);

$_SESSION['finishDay'] = 1;
echo "<p>You've reviewed all your verses for today! Be sure and come back everyday to stay sharp.</p>";
?>