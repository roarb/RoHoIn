<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 7/23/2015
 * Time: 10:28 PM
 */

include "../core/Core.php";
$core = new AllCore();
$allUnits = new AllUnits();

$warcasters = $allUnits->getWarcasterWarlockUnitsByFaction($_GET['faction']);

echo json_encode($warcasters);