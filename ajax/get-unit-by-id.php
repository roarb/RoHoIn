<?php

include '../core/Core.php';
include '../core/Unit.php';

$allUnits = new AllUnits;

$unit = $allUnits->getUnitById($_GET['id']);

echo json_encode($unit);
