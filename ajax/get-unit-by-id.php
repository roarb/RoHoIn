<?php

include '../core/Core.php';
include '../core/Unit.php';
include '../core/Barracks.php';

$allUnits = new AllUnits;

$unit = $allUnits->getUnitById($_GET['id']);

echo json_encode($unit);
