<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 5/11/2015
 * Time: 4:44 PM
 */
session_start();
include '../core/Core.php';
include '../core/Unit.php';
include '../core/Barracks.php';
include '../core/Faction.php';
$allUnits = new AllUnits();
$core = new AllCore();
$loggedIn = $core->getLoggedIn();
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
        <div class="single-caster unit <?php echo $warcaster['id'].'-'.$count ?> model-id-<?php echo $warcaster['id'] ?>">
            <div class="focus-circle warcaster-portrait"><?php echo $allUnits->getUnitImageName($warcaster['name']) ?></div>
            <label for="<?php echo $warcaster['name'] ?>" class="warcaster<?php echo $count ?>">
                <span class="unit-name"><?php echo $warcaster['name'] ?></span><br />
                <span class="unit-title"><?php echo $warcaster['title'] ?></span><div class="bg-points">BG+<?php echo $warcaster['bg_points']?></div><br />
                <?php if ($loggedIn): ?>
                    <div class="barracks-qty-wrapper">
                        <span class="owned-qty">Owned: <?php if (isset($warcaster['owned_models'])){echo $warcaster['owned_models'];} else {echo '0';} ?></span> -
                        <span class="painted-qty">Painted: <?php if (isset($warcaster['painted_models'])){echo $warcaster['painted_models'];} else {echo '0';} ?></span>
                    </div>
                <?php endif; ?>
            </label>
            <div class="add-model-to-list" onclick="leaderSelected(<?php echo $count ?>, unitObject<?php echo $i ?>)" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                <span class="mo-notice hidden">Add to List</span>
            </div>
            <?php if (is_array($warcaster['tiers'])): ?>
                <div class="tier-options" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                    <paper-icon-button icon="class" class="view-tiers"></paper-icon-button>
                    <span class="mo-notice hidden">View Tier Lists</span>
                </div>
            <?php endif; ?>
            <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                <span class="mo-notice hidden">View Stats</span>
            </div>
            <div class="clearer"></div>
            <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
            <div class="additional-model-info" style="display:none;">
                <?php echo $allUnits->displayArmyBuilderStatsLine($warcaster) ?>
            </div>
            <input type="radio" id="<?php echo $warcaster['name'] ?>" name="warcaster<?php echo $count ?>" value="<?php echo $warcaster['name'] ?>" class="hidden" /><br />
        </div>
        <?php $i++ ?>
    <?php endforeach ?>
</div>
<div class="clearer"></div>
<div class="battlegroup battlegroup-<?php echo $count ?> hidden">
    <div class="battlegroup<?php echo $count ?>-title army-entry-select-title"><span class="leader-name"></span><span class="battlegroup-points"></span></div>
    <script>var bgUnitObject = new Array();</script>
    <?php $i = 1 ?>
    <?php foreach ($battlegroup as $bgUnit): ?>
        <?php $_unit = $allUnits->getUnitByName($bgUnit['name']); ?>
        <script>bgUnitObject[<?php echo $i ?>] = <?php echo json_encode($bgUnit) ?>;</script>
        <div class="unit battle-group-unit model-id-<?php echo $_unit['id'] ?>">
            <div class="add-model-to-list" onclick="addToBattleGroup(<?php echo $count ?>, bgUnitObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                <span class="mo-notice hidden">Add to List</span>
            </div>
            <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                <span class="mo-notice hidden">View Stats</span>
            </div>
            <div class="focus-circle">
                <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                <span class="field-allowance"><?php if ($_unit['field_allowance'] == 'U'): echo '&#x221e;'; ?><?php else: echo $_unit['field_allowance']; ?><?php endif; ?></span>
            </div>
            <div class="model-image">
                <?php // need to make thumbnail images here a future priority for page load speed ?>
                <?php echo $allUnits->getUnitImageName($bgUnit['name']) ?>
            </div>
            <label for="<?php echo $_unit['name'] ?>" class="unit-label">
                <span class="unit-name"><?php echo $_unit['name'] ?></span><br />
                <span class="unit-title"><?php echo $_unit['title'] ?></span><br />
                <?php if ($loggedIn): ?>
                    <div class="barracks-qty-wrapper">
                        <span class="owned-qty">Owned: <?php if (isset($bgUnit['owned_models'])){echo $bgUnit['owned_models'];} else {echo '0';} ?></span> -
                        <span class="painted-qty">Painted: <?php if (isset($bgUnit['painted_models'])){echo $bgUnit['painted_models'];} else {echo '0';} ?></span>
                    </div>
                <?php endif; ?>
            </label>
            <div class="unit-cost"><span class="cost"><?php echo $_unit['cost']?></span> pts</div>
            <div class="clearer"></div>
            <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
            <div class="additional-model-info" style="display:none;">
                <?php echo $allUnits->displayArmyBuilderStatsLine($_unit) ?>
            </div>
        </div>
        <?php $i++ ?>
    <?php endforeach; ?>
</div>