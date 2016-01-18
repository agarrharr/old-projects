<?php
include_once("processEncourage.php");
$missione = new MissionTripEncouragement();
$missione->addEncourage();
header('Location: thankyou.php?to=' . $_POST['To']);
?>