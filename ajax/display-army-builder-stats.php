<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 8/11/2015
 * Time: 4:59 PM
 */
include '../core/Unit.php';
include '../core/Core.php';
$allUnits = new AllUnits();
include '../core/Barracks.php';

$_unit = $allUnits->getUnitById($_GET['id']);

?>

<div class="additional-model-info" style="display:none;">
    <?php echo $allUnits->displayArmyBuilderStatsLine($_unit[0]); ?>
</div>