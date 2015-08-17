<?php
include '../core/Core.php';
include '../core/Barracks.php';
$core = new AllCore();
$barracks = new Barracks();
$userId = $_GET['user'];
$count = $_GET['count'];
$type = $_GET['type'];
$unitName = $_GET['unit'];

// run the barracks unit update 

$update = $barracks->updateUnitForUser($userId,$unitName,$count,$type);

echo '<span class="barracks-msg">'.$update.'</span>';

