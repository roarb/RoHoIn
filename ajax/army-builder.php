<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 5/3/2015
 * Time: 8:20 PM
 */
session_start();
include '../core/Core.php';
$Core = new AllCore();
$allUnits = new AllUnits();
$Barracks = new Barracks();
$loggedIn = $Core->getLoggedIn();
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
$mercUnits = $allUnits->getBuilderMercUnitsByFaction($faction);
$mercSolos = $allUnits->getBuilderMercSolosByFaction($faction);

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
                <?php //$_unit = $allUnits->getUnitByName($unit['name']); ?>
                <script>unitModelObject[<?php echo $i ?>] = <?php echo json_encode($unit) ?>;</script>
                <div class="unit unit-model-option model-id-<?php echo $unit['id'] ?>">
                    <div class="add-model-to-list" onclick="addUnitToArmy(this, unitModelObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
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
                    <div class="model-image">
                        <?php echo $allUnits->getUnitImageThumbnail($unit['name']) ?>
                    </div>
                    <label for="<?php echo $unit['name'] ?>" class="unit-label">
                        <span class="unit-name"><?php echo $unit['name'] ?></span><br />
                        <span class="unit-title"><?php echo $unit['title'] ?></span><br />
                        <?php if ($loggedIn): ?>
                            <div class="barracks-qty-wrapper">
                                <span class="owned-qty">Owned: <?php if (isset($unit['owned_models'])){echo $unit['owned_models'];} else {echo '0';} ?></span> -
                                <span class="painted-qty">Painted: <?php if (isset($unit['painted_models'])){echo $unit['painted_models'];} else {echo '0';} ?></span>
                            </div>
                        <?php endif; ?>
                    </label>
                    <div class="unit-cost"><?php $pts = explode(',', $unit['cost']); echo $pts[0]; ?>pts
                    <?php if (isset($pts[1])): echo ' | ' . $pts[1]; ?>pts<?php endif; ?></div>
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
                <?php //$_unit = $allUnits->getUnitByName($solo['name']); ?>
                <script>soloModelObject[<?php echo $i ?>] = <?php echo json_encode($solo) ?>;</script>
                <div class="unit solo-model model-id-<?php echo $solo['id'] ?>">
                    <div class="add-model-to-list" onclick="addUnitToArmy(this, soloModelObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                        <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                        <span class="mo-notice hidden">Add to List</span>
                    </div>
                    <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                        <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                        <span class="mo-notice hidden">View Stats</span>
                    </div>
                    <div class="focus-circle">
                        <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                        <span class="field-allowance">
                            <?php if ($solo['field_allowance'] == 'U'): echo '&#x221e;'; ?>
                            <?php else: echo $solo['field_allowance']; ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="model-image">
                        <?php echo $allUnits->getUnitImageThumbnail($solo['name']) ?>
                    </div>
                    <label for="<?php echo $solo['name'] ?>" class="unit-label">
                        <span class="unit-name"><?php echo $solo['name'] ?></span><br />
                        <span class="unit-title"><?php echo $solo['title'] ?></span><br />
                        <?php if ($loggedIn): ?>
                            <div class="barracks-qty-wrapper">
                                <span class="owned-qty">Owned: <?php if (isset($solo['owned_models'])){echo $solo['owned_models'];} else {echo '0';} ?></span> -
                                <span class="painted-qty">Painted: <?php if (isset($solo['painted_models'])){echo $solo['painted_models'];} else {echo '0';} ?></span>
                            </div>
                        <?php endif; ?>
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
                    <?php //$_unit = $allUnits->getUnitByName($battleEngine['name']); ?>
                    <script>battleEngineModelObject[<?php echo $i ?>] = <?php echo json_encode($battleEngine) ?>;</script>
                    <div class="unit battle-engine-model model-id-<?php echo $battleEngine['id'] ?>">
                        <div class="add-model-to-list" onclick="addUnitToArmy(this, battleEngineModelObject,<?php echo $i ?>);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
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
                        <div class="model-image">
                            <?php echo $allUnits->getUnitImageThumbnail($battleEngine['name']) ?>
                        </div>
                        <label for="<?php echo $battleEngine['name'] ?>" class="unit-label">
                            <span class="unit-name"><?php echo $battleEngine['name'] ?></span><br />
                            <span class="unit-title"><?php echo $battleEngine['title'] ?></span><br />
                            <?php if ($loggedIn): ?>
                                <div class="barracks-qty-wrapper">
                                    <span class="owned-qty">Owned: <?php if (isset($battleEngine['owned_models'])){echo $battleEngine['owned_models'];} else {echo '0';} ?></span> -
                                    <span class="painted-qty">Painted: <?php if (isset($battleEngine['painted_models'])){echo $battleEngine['painted_models'];} else {echo '0';} ?></span>
                                </div>
                            <?php endif; ?>
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
        <?php if(isset($mercSolos)): ?>
            <paper-material elevation="1" class="m-cushion padding-top-bottom merc-solos" id="merc-solo-picker" style="display:none;">
                <div class="merc-solos-title army-entry-select-title">Mercenary/Minion Solos <span id="merc-solo-points"></span></div>
                <script>var mercSoloModelObject = new Array();</script>
                <?php $i = 0 ?>
                <?php foreach ($mercSolos as $solo): ?>
                    <?php //$_unit = $allUnits->getUnitByName($solo['name']); ?>
                    <script>mercSoloModelObject[<?php echo $i ?>] = <?php echo json_encode($solo) ?>;</script>
                    <div class="unit merc-solo-model model-id-<?php echo $solo['id'] ?>">
                        <div class="add-model-to-list" onclick="addUnitToArmy(this, mercSoloModelObject,<?php echo $i ?>, true);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                            <paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>
                            <span class="mo-notice hidden">Add to List</span>
                        </div>
                        <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                            <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                            <span class="mo-notice hidden">View Stats</span>
                        </div>
                        <div class="focus-circle">
                            <span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>
                            <span class="field-allowance">
                                <?php if ($solo['field_allowance'] == 'U'): echo '&#x221e;'; ?>
                                <?php else: echo $solo['field_allowance']; ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="model-image">
                            <?php echo $allUnits->getUnitImageThumbnail($solo['name']) ?>
                        </div>
                        <label for="<?php echo $solo['name'] ?>" class="unit-label">
                            <span class="unit-name"><?php echo $solo['name'] ?></span><br />
                            <span class="unit-title"><?php echo $solo['title'] ?></span><br />
                            <?php if ($loggedIn): ?>
                                <div class="barracks-qty-wrapper">
                                    <span class="owned-qty">Owned: <?php if (isset($solo['owned_models'])){echo $solo['owned_models'];} else {echo '0';} ?></span> -
                                    <span class="painted-qty">Painted: <?php if (isset($solo['painted_models'])){echo $solo['painted_models'];} else {echo '0';} ?></span>
                                </div>
                            <?php endif; ?>
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
        <?php endif; ?>
        <?php if (isset($mercUnits)): ?>
            <paper-material elevation="1" class="m-cushion padding-top-bottom merc-units" id="merc-unit-picker" style="display:none;">
                <div class="merc-units-title army-entry-select-title">Mercenary/Minion Units <span id="merc-unit-points"></span></div>
                <?php $i = 0 ?>
                <script>var mercUnitModelObject = new Array();</script>
                <?php foreach ($mercUnits as $unit): ?>
                    <?php //$_unit = $allUnits->getUnitByName($unit['name']); ?>
                    <script>mercUnitModelObject[<?php echo $i ?>] = <?php echo json_encode($unit) ?>;</script>
                    <div class="unit merc-unit-model-option model-id-<?php echo $unit['id'] ?>">
                        <div class="add-model-to-list" onclick="addUnitToArmy(this, mercUnitModelObject,<?php echo $i ?>, true);" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
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
                        <div class="model-image">
                            <?php echo $allUnits->getUnitImageThumbnail($unit['name']) ?>
                        </div>
                        <label for="<?php echo $unit['name'] ?>" class="unit-label">
                            <span class="unit-name"><?php echo $unit['name'] ?></span><br />
                            <span class="unit-title"><?php echo $unit['title'] ?></span><br />
                            <?php if ($loggedIn): ?>
                                <div class="barracks-qty-wrapper">
                                    <span class="owned-qty">Owned: <?php if (isset($unit['owned_models'])){echo $unit['owned_models'];} else {echo '0';} ?></span> -
                                    <span class="painted-qty">Painted: <?php if (isset($unit['painted_models'])){echo $unit['painted_models'];} else {echo '0';} ?></span>
                                </div>
                            <?php endif; ?>
                        </label>
                        <div class="unit-cost"><?php $pts = explode(',', $unit['cost']); echo $pts[0]; ?>pts
                            <?php if (isset($pts[1])): echo ' | ' . $pts[1]; ?>pts<?php endif; ?></div>
                        <div class="clearer"></div>
                        <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
                        <div class="additional-model-info" style="display:none;">
                            <?php echo $allUnits->displayArmyBuilderStatsLine($unit) ?>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </paper-material>
        <?php endif; ?>
    </div>
    <div class="flex-2 added-to-list-panel info-block-tools" style="overflow-y:auto;">
        <div id="tier-list-req-notice">
            <div class="tier-1-notice"></div>
            <div class="tier-2-notice"></div>
            <div class="tier-3-notice"></div>
            <div class="tier-4-notice"></div>
        </div>
        <form method="post" name="create-army-list" id="create-army-list" action="save-list.php">
            <paper-material id="requirements" class="hidden"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-1-built" style="display:none;"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-2-built" style="display:none;"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-3-built" style="display:none;"></paper-material>
            <paper-material class="battle-group-built m-cushion" id="battlegroup-4-built" style="display:none;"></paper-material>
            <paper-material class="units-built m-cushion" id="units-built" style="display:none;"></paper-material>
            <paper-material class="solos-built m-cushion" id="solos-built" style="display:none;"></paper-material>
            <paper-material class="battle-engines-built m-cushion" id="battle-engines-built" style="display:none;"></paper-material>
            <paper-material class="merc-solos-built m-cushion" id="merc-solos-built" style="display:none;"></paper-material>
            <paper-material class="merc-units-built m-cushion" id="merc-units-built" style="display:none;"></paper-material>
            <div class="hidden">
                <input type="text" name="army-name" id="input-army-name" value="<?php echo $name ?>" />
                <input type="text" name="faction" value="<?php echo $faction ?>" />
                <input type="text" name="points" id="input-points" />
                <input type="text" name="actual_points" id="input-army-points" />
            </div>
            <paper-material elevation="1" class="army-list-actions m-cushion">
                <?php if ($Core->getLoggedIn()): ?>
                    <paper-switch-container>
                        <label style="margin-right:10px;">Save as Public Army List</label><paper-toggle-button id="public-list-toggle" checked></paper-toggle-button>
                        <input id="public-input" name="public" value="1" class="hidden" />
                    </paper-switch-container>
                    <paper-switch-container>
                        <label style="margin-right:10px;">Use only models from your Barracks</label><paper-toggle-button id="barracks-models-toggle"></paper-toggle-button>
                        <input id="barracks-models-input" name="barracks-models" value="0" class="hidden" />
                    </paper-switch-container>
                <?php endif; ?>
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
<paper-toast style="z-index:1;" id="battlegroup-needed" text="Please add a model to the battle group before saving."></paper-toast>
<paper-toast style="z-index:1;" id="over-points" text="You've used too many models and are over your points allotment."></paper-toast>

<div class="tiered-army-list-options" style="display:none;"></div>
<div class="shadow" id="notice-shadow" style="display:none;"></div>

<script>
    $(document).ready(function(){
        $('#public-list-toggle').on('touchstart click', function(){
            toggleCheckbox('#public-input');
            if (armyBuilder.army.public_list){
                armyBuilder.army.public_list = false;
            } else {
                armyBuilder.army.public_list = true;
            }
        });
        <?php if ($Core->getLoggedIn()): ?>
            $('#barracks-models-toggle').on('touchstart click', function(){
                toggleCheckbox('#barracks-models-input');
                var barracksModels = <?php echo json_encode($Barracks->getAllUserModels($Core->getUserId())) ?>;
                if (armyBuilder.army.barracks_models){
                    useOnlyBarracksModels(false, '');
                    armyBuilder.army.barracks_models = true;
                } else {
                    useOnlyBarracksModels(true, barracksModels);
                    armyBuilder.army.barracks_models = false;
                }
            });
        <?php endif; ?>

        $('#submit').on('touchstart click', function(e){
            e.preventDefault();
            //submitForm('#create-army-list');
            console.log(armyBuilder);
<?php /* submission section
            var battleGroupSql1 = '';
            $(tempList.bg1Models).each(function(key, val){
                battleGroupSql1 += '['+val+',1]';
            });
            if (tempList.bg1Models.length < 1){
                battleGroupSql1 = null;
            }

            var solosSql = '';
            $(tempList.soloModels).each(function(key, val){
               solosSql += '['+val['id']+','+val['count']+']';
            });
            if (tempList.soloModels.length < 1){
                solosSql = null;
            }

            var unitsSql = '';
            $(tempList.unitModels).each(function(key,val){
               unitsSql +=  '['+val['id']+','+val['count']+','+val['cost']+']';
            });
            if (tempList.unitModels.length < 1){
                unitsSql = null;
            }

            var battleEngineSql = '';
            $(tempList.battleEngineModels).each(function(key,val){
                battleEngineSql +=  '['+val['id']+','+val['count']+']';
            });
            if (tempList.battleEngineModels.length < 1){
                battleEngineSql = null;
            }

            var journeymanBgSql = '';
            $(tempList.journeyman_bg).each(function(key, val){
                journeymanBgSql += '['+val+',1]';
            });
            if (tempList.journeyman_bg.length < 1){
                journeymanBgSql = null;
            }

            var user = null;
            if (tempList.creator_id[0] != null){
                user = tempList.creator_id[0];
            }

            var query = 'name='+tempList.name;
            query += '&faction='+tempList.faction;
            query += '&points='+tempList.orig_points;
            query += '&points_used='+tempList.points_used;
            query += '&warcaster1='+tempList.leader1name;
            query += '&tier1='+tempList.tierListLevel;
            if (battleGroupSql1 != null){query += '&bg1='+battleGroupSql1;}
            if (solosSql != null){query += '&solos='+solosSql;}
            if (unitsSql != null){query += '&units='+unitsSql;}
            if (battleEngineSql != null){query += '&battle_engines='+battleEngineSql;}
            if (tempList.journeyman['active'] == 1){query += '&journeyman_caster='+tempList.journeyman['id'];}
            if (journeymanBgSql != null){query += '&journeyman_battlegroup='+journeymanBgSql;}
            // need jackmarshal here
            // need jackmarshal battle group here
            query += '&created_by='+user;
            query += '&public='+tempList.publicList;
            if ($('#notes').val().length > 0){
                query += '&notes='+$('#notes').val();
            }
            query += '&guid='+tempList.guid;

            //console.log(query);
            // run JS validation checks before submitting
            var commitSave = true;

            if (tempList.bg1Models.length == 0){
                commitSave = false;
                document.querySelector('#battlegroup-needed').show();
            }
            if (tempList.points_used > tempList.points){
                commitSave = false;
                document.querySelector('#over-points').show();
            }

            if (commitSave){
                $.post("/ajax/save-army-list.php?"+query, function(guid) {
                    var msg = '<h3>Great news, your army list was saved!</h3>';
                    msg += '<p>You can view it at <a href="/armybuilder/view-army-list.php?id='+guid.slice(1, -1)+'" title="'+tempList.name+'">'+tempList.name+'</a></p>';
                    msg += '<paper-button class="cushion" raised>Create a New Army List</paper-button>';
                    displayNotice(msg, true)
                });
            }
*/ ?>
        });
        $('#go-back').on('touchstart click', function(){
            backToCreateArmyStepOne()
        });

    });

</script>