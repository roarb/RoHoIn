<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 5/3/2015
 * Time: 8:20 PM
 */

include '../core/Core.php';
include '../core/Unit.php';
$allUnits = new AllUnits();

$faction = $_GET['faction'];
$points = $_GET['points'];
$name = $_GET['name'];
$type = '';
if ($faction == 'Circle Orboros' || $faction == 'Legion of Everblight' || $faction == 'Minions' || $faction == 'Skorne' || $faction == 'Trollbloods'){
    $type = 'Warlock';
    // vernacular for Hordes
    $leader = 'Warlock';
    $heavy = 'Heavy Warbeast';
    $light = 'Light Warbeast';
    $colossal = 'Gargantuan';
} else {
    $type = 'Warcaster';
    // vernacular for Warmachine
    $leader = 'Warcaster';
    if ($faction == 'Cryx'){
        $heavy = 'Helljack';
        $light = 'Bonejack';
    } elseif ($faction == 'Retribution of Scyrah'){
        $heavy = 'Heavy Myrmidon';
        $light = 'Light Myrmidon';
    } elseif ($faction == 'Convergence of Cyriss'){
        $heavy = 'Heavy Vector';
        $light = 'Light Vector';
        $colossal = 'Colossal Vector';
    }
    else {
        $heavy = 'Heavy Warjack';
        $light = 'Light Warjack';
        $colossal = 'Colossal';
    }
}

$units = $allUnits->getBuilderUnitsByFaction($faction);
$solos = $allUnits->getBuilderSolosByFaction($faction);
$battleEngines = $allUnits->getBattleEngineUnitsByFaction($faction);

?>

<div class="horizontal layout">
    <div class="flex-2 all-units-panel info-block-tools" style="overflow-y:auto;">
        <paper-material elevation="1" class="m-cushion padding-top-bottom battlegroup" id="battlegroup-1"></paper-material>
        <paper-material elevation="1" class="m-cushion padding-top-bottom battlegroup" id="battlegroup-2" style="display:none;"></paper-material>
        <paper-material elevation="1" class="m-cushion padding-top-bottom battlegroup" id="battlegroup-3" style="display:none;"></paper-material>
        <paper-material elevation="1" class="m-cushion padding-top-bottom battlegroup" id="battlegroup-4" style="display:none;"></paper-material>

        <paper-material elevation="1" class="m-cushion padding-top-bottom units" id="unit-picker" style="display:none;">
            <div class="units-title army-entry-select-title">Units <span id="unit-points"></span></div>
            <?php $i = 0 ?>
            <script>var unitModelObject = new Array();</script>
            <?php foreach ($units as $unit): ?>
                <?php $_unit = $allUnits->getUnitByName($unit['name']); ?>
                <script>unitModelObject[<?php echo $i ?>] = <?php echo json_encode($unit) ?>;</script>
                <div class="unit unit-model-option model-id-<?php echo $unit['id'] ?>">
                    <div class="add-model-to-list" onclick="addUnitToArmy(unitModelObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                        <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                        <span class="mo-notice hidden">Add to List</span>
                    </div>
                    <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                        <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                        <span class="mo-notice hidden">View Stats</span>
                    </div>
                    <div class="focus-circle">
                        <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                        <span class="field-allowance"><?php if ($unit['field_allowance'] == 'U'): echo '&#x221e;'; ?><?php else: echo $unit['field_allowance']; ?><?php endif; ?></span>
                    </div>
                    <label for="<?php echo $unit['name'] ?>" class="unit-label">
                        <span class="unit-name"><?php echo $unit['name'] ?></span><br /><span class="unit-title"><?php echo $unit['title'] ?></span>
                    </label>
                    <div class="unit-cost"><?php $pts = explode(',', $unit['cost']); echo $pts[0]; ?>pts
                    <?php if ($pts[1] != ''): echo ' | ' . $pts[1]; ?>pts<?php endif; ?></div>
                    <div class="clearer"></div>
                    <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
                    <div class="additional-model-info" style="display:none;">
                        <?php echo $allUnits->displayArmyBuilderStatsLine($unit) ?>
                    </div>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>
        </paper-material>
        <paper-material elevation="1" class="m-cushion padding-top-bottom solos" id="solo-picker" style="display:none;">
            <div class="solos-title army-entry-select-title">Solos <span id="solo-points"></span></div>
            <script>var soloModelObject = new Array();</script>
            <?php $i = 0 ?>
            <?php foreach ($solos as $solo): ?>
                <?php $_unit = $allUnits->getUnitByName($solo['name']); ?>
                <script>soloModelObject[<?php echo $i ?>] = <?php echo json_encode($solo) ?>;</script>
                <div class="unit solo-model model-id-<?php echo $solo['id'] ?>">
                    <div class="add-model-to-list" onclick="addUnitToArmy(soloModelObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                        <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                        <span class="mo-notice hidden">Add to List</span>
                    </div>
                    <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                        <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                        <span class="mo-notice hidden">View Stats</span>
                    </div>
                    <div class="focus-circle">
                        <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                        <span class="field-allowance"><?php if ($solo['field_allowance'] == 'U'): echo '&#x221e;'; ?><?php else: echo $solo['field_allowance']; ?><?php endif; ?></span>
                    </div>
                    <label for="<?php echo $solo['name'] ?>" class="unit-label">
                        <span class="unit-name"><?php echo $solo['name'] ?></span><br /><span class="unit-title"><?php echo $solo['title'] ?></span>
                    </label>
                    <div class="unit-cost"><?php echo $solo['cost']?> pts</div>
                    <div class="clearer"></div>
                    <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
                    <div class="additional-model-info" style="display:none;">
                        <?php echo $allUnits->displayArmyBuilderStatsLine($solo) ?>
                    </div>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>
        </paper-material>
        <?php if (isset($battleEngines)): ?>
            <paper-material elevation="1" class="m-cushion padding-top-bottom battle-engines" id="battle-engine-picker" style="display:none;">
                <div class="battle-engine-title army-entry-select-title">Battle Engines<span id="battle-engine-points"></span></div>
                <script>var battleEngineModelObject = new Array();</script>
                <?php $i = 0 ?>
                <?php foreach ($battleEngines as $battleEngine): ?>
                    <?php $_unit = $allUnits->getUnitByName($battleEngine['name']); ?>
                    <script>battleEngineModelObject[<?php echo $i ?>] = <?php echo json_encode($battleEngine) ?>;</script>
                    <div class="unit battle-engine-model model-id-<?php echo $battleEngine['id'] ?>">
                        <div class="add-model-to-list" onclick="addUnitToArmy(battleEngineModelObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                            <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                            <span class="mo-notice hidden">Add to List</span>
                        </div>
                        <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                            <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                            <span class="mo-notice hidden">View Stats</span>
                        </div>
                        <div class="focus-circle">
                            <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                            <span class="field-allowance"><?php if ($battleEngine['field_allowance'] == 'U'): echo '&#x221e;'; ?><?php else: echo $battleEngine['field_allowance']; ?><?php endif; ?></span>
                        </div>
                        <label for="<?php echo $battleEngine['name'] ?>" class="unit-label">
                            <span class="unit-name"><?php echo $battleEngine['name'] ?></span><br /><span class="unit-title"><?php echo $battleEngine['title'] ?></span>
                        </label>
                        <div class="unit-cost"><?php echo $battleEngine['cost']?> pts</div>
                        <div class="clearer"></div>
                        <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
                        <div class="additional-model-info" style="display:none;">
                            <?php echo $allUnits->displayArmyBuilderStatsLine($battleEngine) ?>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </paper-material>
        <?php endif ?>
    </div>
    <div class="flex-2 added-to-list-panel info-block-tools" style="overflow-y:auto;">
        <form method="post" name="create-army-list" id="create-army-list" action="save-list.php">

            <paper-material class="battle-group-built m-cushion" id="battlegroup-1-built" style="display:none;"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-2-built" style="display:none;"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-3-built" style="display:none;"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-4-built" style="display:none;"></paper-material>
            <paper-material class="units-built m-cushion" id="units-built" style="display:none;"></paper-material>
            <paper-material class="solos-built m-cushion" id="solos-built" style="display:none;"></paper-material>
            <paper-material class="battle-engines-built m-cushion" id="battle-engines-built" style="display:none;"></paper-material>
            <div class="hidden">
                <input type="text" name="army-name" id="input-army-name" value="<?php echo $name ?>" />
                <input type="text" name="faction" value="<?php echo $faction ?>" />
                <input type="text" name="points" id="input-points" />
                <input type="text" name="actual_points" id="input-army-points" />
            </div>
            <paper-material elevation="1" class="army-list-actions m-cushion">
                <paper-switch-container>
                    <label style="margin-right:10px;">Save as Public Army List</label><paper-toggle-button id="public-list-toggle" checked></paper-toggle-button>
                    <input id="public-input" name="public" value="1" class="hidden" />
                </paper-switch-container>
                <paper-input-container style="padding:0 20px;">
                    <textarea rows="4" id="notes" name="notes" placeholder="Army Notes:"></textarea>
                </paper-input-container>
                <div class="center cushion">
                    <paper-button raised class="button" id="submit">Submit</paper-button>
                    <paper-button raised class="button" id="go-back">Back</paper-button>
                </div>
            </paper-material>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#public-list-toggle').on('touchstart click', function(){
            toggleCheckbox('#public-input');
        });
        $('#submit').on('touchstart click', function(){
            submitForm('#create-army-list');
        });
        $('#go-back').on('touchstart click', function(){
            backToCreateArmyStepOne()
        });
    })
</script>