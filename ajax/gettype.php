<?php

include '../core/Core.php';
include '../core/Unit.php';
include '../core/UnitType.php';
$allUnits = new AllUnits;
$faction = $_GET['type'];
$modelType = $_GET['model'];
$units = $allUnits->getFactionUnitList($faction);
$allUnitTypes = new AllUnitTypes;
$unitTypesList = $allUnitTypes->getAllUnitTypes();

?>

<?php // check that the model type hasn't been chosen already ?>
<?php if (!isset($_GET['model'])): ?>
    <select id="narrow-type" onchange="showModels(this.value)">
        <option selected deisabled>Choose Model Type</option>
        <?php 
        foreach ($unitTypesList as $type):
            foreach ($units as $unit):
                if ($unit['type'] == $type['name']): ?>
                    <option value="<?php echo $type['name'] ?>&type=<?php echo $faction ?>"><?php echo $type['name'] ?></option>
                <?php    break;
                endif; 
            endforeach;
        endforeach; ?>
    </select>
<?php elseif (isset($_GET['model'])): ?>
	<select id="narrow-modle" onchange="loadSingleModel(this.value)">
        <option selected deisabled>Choose Model</option>
        <?php $models = $allUnits->getAllUnitsNameFactionType($faction, $modelType) ?>
        <?php foreach ($models as $model): ?>
        	<option value="<?php echo $model['name'] ?>"><?php echo $model['name'] ?></option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>
