<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 5/11/2015
 * Time: 4:44 PM
 */

include '../core/Core.php';
include '../core/Unit.php';
$allUnits = new AllUnits();

$faction = $_GET['faction'];
$count = $_GET['count'];

if ($faction == 'Circle Orboros' || $faction == 'Legion of Everblight' || $faction == 'Minions' || $faction == 'Skorne' || $faction == 'Trollbloods'){
    $type = 'Warlock';
    // vernacular for Hordes
    $leader = 'Warlock';
} else {
    $type = 'Warcaster';
    $leader = 'Warcaster';
}

$warcasters = $allUnits->getWarcasterWarlockUnitsByFaction($faction);
$battlegroup = $allUnits->getBattleGroupUnitsByFaction($faction);

?>

<div class="warcaster warcaster-<?php echo $count ?>">
    <div class="warcaster<?php echo $count ?>-title army-entry-select-title">Select a <?php echo $leader ?> for Battle Group <?echo $count ?></div>
    <?php $i = 1 ?>
    <?php foreach ($warcasters as $warcaster): ?>
        <script>var unitObject<?php echo $i ?> = <?php echo json_encode($warcaster) ?>;</script>
        <div class="single-caster <?php echo $warcaster['id'].'-'.$count ?>" onclick="expandUnitDisplay(this)">
            <div class="focus-circle warcaster-portrait"><?php echo $allUnits->getUnitImageName($warcaster['name']) ?></div>
            <label for="<?php echo $warcaster['name'] ?>" class="warcaster<?php echo $count ?>">
                <span class="unit-name"><?php echo $warcaster['name'] ?></span><br /><span class="unit-title"><?php echo $warcaster['title'] ?></span>
            </label>
            <div class="add-model-to-list" onclick="leaderSelected(<?php echo $count ?>, unitObject<?php echo $i ?>)">
                <iron-icon icon="add-circle-outline" class="add-model"></iron-icon>
                <span class="mo-notice hidden">Add to List</span>
            </div>
            <?php if (is_array($warcaster['tiers'])): ?>
                <div class="tier-options">
                    <iron-icon icon="class" class="view-tiers"></iron-icon>
                    <span class="mo-notice hidden">View Tier Lists</span>
                </div>
            <?php endif; ?>
            <div class="bg-points">BG+<?php echo $warcaster['bg_points']?></div>
            <div class="clearer"></div>
            <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
            <div class="additional-model-info" style="display:none;">
                testing this location and shit.
                <?php print_r($warcaster) ?>
            </div>
            <input type="radio" id="<?php echo $warcaster['name'] ?>" name="warcaster<?php echo $count ?>" value="<?php echo $warcaster['name'] ?>" class="hidden" /><br />
        </div>
        <?php $i++ ?>
    <?php endforeach ?>
</div>
<div class="clearer"></div>
<div class="battlegroup battlegroup-<?php echo $count ?> hidden">
    <div class="battlegroup<?php echo $count ?>-title army-entry-select-title"><span class="leader-name"></span><span class="battlegroup-points"></span></div>
    <?php $i = 1 ?>
    <?php foreach ($battlegroup as $bgUnit): ?>
        <?php $_unit = $allUnits->getUnitByName($bgUnit['name']); ?>
        <script>var bgUnitObject<?php echo $i ?> = <?php echo json_encode($_unit) ?>;</script>
        <div class="unit model-id-<?php echo $_unit['id'] ?>" onclick="addToBattleGroup(<?php echo $count ?>, bgUnitObject<?php echo $i ?>);">
            <div class="focus-circle">
                <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                <span class="field-allowance"><?php if ($_unit['field_allowance'] == 'U'): echo '&#x221e;'; ?><?php else: echo $_unit['field_allowance']; ?><?php endif; ?></span>
            </div>
            <label for="<?php echo $_unit['name'] ?>" class="unit-label">
                <span class="unit-name"><?php echo $_unit['name'] ?></span><br /><span class="unit-title"><?php echo $_unit['title'] ?></span>
            </label>
            <div class="unit-cost"><span class="cost"><?php echo $_unit['cost']?></span> pts</div>
        </div>
        <?php $i++ ?>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $('.add-model-to-list, .tier-options').hover(function(){
        $(this).find('.mo-notice').removeClass('hidden').addClass('active');
    }, function(){
        $(this).find('.mo-notice').removeClass('active').addClass('hidden');
    })
</script>