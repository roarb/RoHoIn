<?php

include '../core/Core.php';
$core = new AllCore();
$allUnits = new AllUnits();

$unit = $allUnits->getUnitOptionalAttachments($_GET['id']);

echo json_encode($unit);
