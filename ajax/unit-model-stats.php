<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 10/1/2015
 * Time: 5:46 PM
 */

include '../core/Core.php';
include '../core/Unit.php';
$allUnits = new AllUnits();
$id = $_GET['id'];

$unit = $allUnits->getUnitById($id);

echo $allUnits->displayArmyBuilderStatsLine($unit[0]);