<?php
require_once("../includes/session.php");
include_once("processEncourage.php");
confirm_logged_in();

$processE = new MissionTripEncouragement();
$processE->markPrinted();
?>