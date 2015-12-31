<?php

include '../core/Core.php';
$core = new AllCore();

$allUnits = new AllUnits;

$unit = $allUnits->getUnitById($_GET['id']);

echo json_encode($unit);
