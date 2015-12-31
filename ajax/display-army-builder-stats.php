<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 8/11/2015
 * Time: 4:59 PM
 */

include '../core/Core.php';
$core = new AllCore();
$allUnits = new AllUnits();
$_unit = $allUnits->getUnitById($_GET['id']);

?>

<div class="additional-model-info" style="display:none;">
    <?php echo $allUnits->displayArmyBuilderStatsLine($_unit[0]); ?>
</div>