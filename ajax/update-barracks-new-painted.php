<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 6/14/2015
 * Time: 4:38 PM
 */

include "../core/Unit.php";
include "../core/Core.php";
include "../core/Barracks.php";
$userId = $_GET['user'];
$modelId = $_GET['model'];
$allUnits = new AllUnits();
$barracks = new Barracks();
$unit = $allUnits->getUnitById($modelId);
$unit = $unit[0];

?>

<?php //var_dump($unit) ?>

<span class="barracks-sub-head">Add this model to your <a href="/account/barracks.php" title="Your Barracks">Barracks</a></span><br />
<label>You currently own</label>
<select id="count" onChange="updateUnitCount(this.value, 'count', '<?php echo $userId ?>', '<?php echo $unit['name']?>', '<?php echo $modelId ?>')">
    <?php $i = 0 ?>
    <?php $ownedCount = $barracks->userModelCountCheck($userId, $unit['name'], 'count'); ?>
    <?php $maxCount = $allUnits->getTotalAllowedBarracksModelCount($unit['field_allowance'],$unit['purchased_low'],$unit['purchased_high']); ?>
    <?php while ($i < $maxCount): ?>
        <option value="<?php echo $i ?>" <?php if ($ownedCount == $i){echo 'selected';} ?>><?php echo $i ?></option>
        <?php $i++; ?>
    <?php endwhile; ?>
</select>
<?php if ($ownedCount > 0): ?>
    <label>and have Painted</label>
    <select id="painted" onChange="updateUnitCount(this.value, 'painted', '<?php echo $userId ?>', '<?php echo $unit['name']?>', '<?php echo $modelId ?>')">
        <?php $i = 0 ?>
        <?php $paint = $barracks->userModelCountCheck($userId, $unit['name'], 'painted'); ?>
        <?php while ($i < ($ownedCount+1)): ?>
            <option value="<?php echo $i ?>" <?php if ($paint == $i){echo 'selected';} ?>><?php echo $i ?></option>
            <?php $i++; ?>
        <?php endwhile; ?>
    </select>
<?php endif; ?>
<br /><span class="small">Please add each model of a unit, not just '1' for the whole unit.</span>