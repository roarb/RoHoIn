<?php include('login/index-start.php'); ?>
<html lang="en">
<head>

    <?php
    include '../admin/header.php';
    include '../core/Core.php';
    include '../core/SpecialAbilities.php';
    include '../core/Unit.php';
    include '../core/Faction.php';
    include '../core/AnimusKnown.php';
    include '../core/SpellsKnown.php';
    include '../core/Weapons.php';
    include '../core/UnitType.php';
    include '../core/Barracks.php';
    include '../core/tiered-list.php';
    $barracks = new Barracks;
    $allAbilities = new AllSpecialAbilities;
    $allUnits = new AllUnits;
    $allAnimus = new AllAnimusKnown;
    $allSpells = new AllSpellsKnown;
    $allWeapons = new AllWeapons;
    $allFactions = new AllFactions;
    $core = new AllCore;
    $allUnitTypes = new AllUnitTypes;
    $tiers = new AllTieredLists;
    $unitTypesList = $allUnitTypes->getAllUnitTypes();
    $factionList = $allFactions->getAllFactions();
    $unitsList = $allUnits->getAllUnitsName();

    $unit = '';
    //$units = $allUnits->getUnitByName($_GET['name']);
    //$unit = $units[0]; // set returned array to a single object

    if (isset($_GET['name'])){
        $unit = $allUnits->getUnitByName($_GET['name']);
    }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if (isset($_GET['name'])){echo $_GET['name'] . ' - ';} ?>RoHo.in WarmaHordes Playtesting Center</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include '../login/index.php'; ?>
        <?php include '../nav/main-nav.php'; ?>
        <paper-fab mini icon="arrow-back" class="nav-back link-playtest-home primary-focus"></paper-fab>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title"><?php if ($unit != ''){echo $unit['name'] . ' - ' . $unit['title'];} else {?>Please Select a Unit<?php } ?></h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <paper-toolbar class="front-toolbar secondary">
            <div class="unit-navigation horizontal layout" style="width:100%;">
                <div class="faction-select flex-3" id="faction-select">
                    <select id="narrow-faction" onChange="showType(this.value);showAjaxLoading();">
                        <option <?php if ($unit == ''){echo 'selected';} ?> disabled>Choose Faction</option>
                        <?php foreach ($factionList as $faction): ?>
                            <option <?php if ($unit['faction'] == $faction['name']){echo 'selected';} ?> value="<?php echo $faction['name'] ?>"><?php echo $faction['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="type-select flex-3" id="type-select">
                    <?php if($unit != ''): ?>
                        <select id="narrow-type" onChange="showModels(this.value);showAjaxLoading();">
                            <option selected disabled>Choose Model Type</option>
                            <?php
                            $unitsSorting = $allUnits->getFactionUnitList($unit['faction']);
                            foreach ($unitTypesList as $type):
                                foreach ($unitsSorting as $unitTemp):
                                    if ($unitTemp['type'] == $type['name']): ?>
                                        <option <?php if ($unit['type'] == $type['name']){echo 'selected';} ?> value="<?php echo $type['name'] ?>&type=<?php echo $unitTemp['faction'] ?>"><?php echo $type['name'] ?></option>
                                        <?php    break;
                                    endif;
                                endforeach;
                            endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="model-select flex-3" id="model-select">
                    <?php if($unit != ''): ?>
                        <select id="narrow-modle" onChange="loadSingleModel(this.value)">
                            <option selected disabled>Choose Model</option>
                            <?php $models = $allUnits->getAllUnitsNameFactionType($unit['faction'], $unit['type']) ?>
                            <?php foreach ($models as $model): ?>
                                <option <?php if ($unit['name'] == $model['name']){echo 'selected';} ?> value="<?php echo $model['name'] ?>"><?php echo $model['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            </div>
        </paper-toolbar>
        <?php $loggedIn = false; ?>
        <?php if ($_SESSION['user_id'] != ''){$loggedIn = true;} ?>
        <div>
            <?php if ($unit != ''): ?>
                <div class="horizontal layout single-unit">
                    <div class="flex-2 unit-info cushion-sides info-block-tools">
                        <paper-material elevation="1" class="cushion unit-name-block">
                            <h2 class="unit-name"><?php echo $unit['name'] ?></h2>
                            <span class="sub-head"><?php echo $unit['title'] ?></span><br />
                        </paper-material>
                        <?php $unitsList = '';
                        if($unit['type'] == 'Warlock' || $unit['type'] == 'Warcaster'):
                            $unitsList = $allUnits->getWarcasterWarlockUnits();
                        elseif ($unit['type'] == 'Colossal' || $unit['type'] == 'Colossal Vector' || $unit['type'] == 'Gargantuan'):
                            $unitsList = $allUnits->getColossalUnits();
                        elseif ($unit['type'] == 'Heavy Myrmidon' || $unit['type'] == 'Heavy Vector' || $unit['type'] == 'Heavy Warbeast' || $unit['type'] == 'Heavy Warjack' || $unit['type'] == 'Helljack'):
                            $unitsList = $allUnits->getHeavyUnits();
                        elseif ($unit['type'] == "Lesser Warbeast" || $unit['type'] == 'Light Myrmidon' || $unit['type'] == 'Light Vector' || $unit['type'] == 'Light Warbeast' || $unit['type'] == 'Light Warjack' || $unit['type'] == 'Bone Jack'):
                            $unitsList = $allUnits->getLightUnits();
                        elseif ($unit['type'] == "Unit" || $unit['type'] == 'Character Unit' || $unit['type'] == 'Warbeast Pack' || $unit['type'] == 'Cavalry Unit' || $unit['type'] == 'Unit Attachment' || $unit['type'] == 'Weapon Crew Unit'):
                            $unitsList = $allUnits->getUnitUnits();
                        elseif ($unit['type'] == "Solo" || $unit['type'] == 'Character Solo'):
                            $unitsList = $allUnits->getSoloUnits();
                        elseif ($unit['type'] == "Battle Engine"):
                            $unitsList = $allUnits->getBattleEngineUnits();
                        endif;
                        $averages = $allUnits->getAveragesWarcasterWarlock($unitsList); ?>
                        <paper-material elevation="1" class="cushion">
                            <table class="stats-bars">
                                <tr>
                                    <th>SPD <?php if ($loggedIn == true){echo '- '.$unit['spd'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-spd']),max($averages['all-spd']),$unit['spd']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <tr>
                                    <th>STR <?php if ($loggedIn == true){echo '- '.$unit['str'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-str']),max($averages['all-str']),$unit['str']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <tr>
                                    <th>MAT <?php if ($loggedIn == true){echo '- '.$unit['mat'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-mat']),max($averages['all-mat']),$unit['mat']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <tr>
                                    <th>RAT <?php if ($loggedIn == true){echo '- '.$unit['rat'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-rat']),max($averages['all-rat']),$unit['rat']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <tr>
                                    <th>DEF <?php if ($loggedIn == true){echo '- '.$unit['def'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-def']),max($averages['all-def']),$unit['def']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <tr>
                                    <th>ARM <?php if ($loggedIn == true){echo '- '.$unit['arm'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-arm']),max($averages['all-arm']),$unit['arm']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <tr>
                                    <th>Damage Boxes <?php if ($loggedIn == true){echo '- '.$unit['damage_boxes'];} ?></th>
                                    <td><?php // get second highest damage boxes ?>
                                        <?php rsort($averages['all-dmg']); ?>
                                        <?php //echo $averages['all-dmg'][1]; ?><?php //echo min($averages['all-dmg']) ?><?php //echo $unit['damage_boxes'] ?>
                                        <?php $percent = $core->getSlidePos(min($averages['all-dmg']),$averages['all-dmg'][1],$unit['damage_boxes']); ?>
                                        <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                </tr>
                                <?php if ($unit['type'] == 'Warlock' || $unit['type'] == 'Warcaster'): ?>
                                    <tr>
                                        <th>BG Points <?php if ($loggedIn == true){echo '- '.$unit['bg_points'];} ?></th>
                                        <td><?php $percent = $core->getSlidePos(min($averages['all-bgpoints']),max($averages['all-bgpoints']),$unit['bg_points']); ?>
                                            <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($unit['focus'] != '' || $unit['fury'] != ''): ?>
                                    <tr>
                                        <th><?php if ($unit['focus'] != ''){echo 'Focus ';} if ($unit['focus'] != '' && $loggedIn == true){echo '- '.$unit['focus'];} if ($unit['fury'] != ''){echo 'Fury ';} if ($unit['fury'] != '' && $loggedIn == true){echo '- '.$unit['fury'];} ?></th>
                                        <td><?php $focusfury = '' ?>
                                            <?php if ($unit['focus'] != ''):$focusfury = $unit['focus']; ?>
                                            <?php else: $focusfury = $unit['fury']; ?>
                                            <?php endif; ?>
                                            <?php $percent = $core->getSlidePos(min($averages['all-focusfury']),max($averages['all-focusfury']),$focusfury); ?>
                                            <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($unit['cost'] != '-'): ?>
                                <?php $cost = $allUnits->getCleanCost($unit['cost']) ?>
                                <tr>
                                    <th>Cost <?php if ($loggedIn == true){echo '- '.$unit['cost'];} ?></th>
                                    <td><?php $percent = $core->getSlidePos(min($averages['all-cost']),max($averages['all-cost']),$cost); ?>
                                        <div class="slider"><div class="cost-slider slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div></td>
                                    <?php endif; ?>
                            </table>
                            <?php if ($unit['damage_spiral'] != ''): ?>
                                <?php $allUnits->getSpiralDisplay($unit['damage_spiral']) ?>
                                <div class="damage-spiral">
                                    <?php echo $allUnits->getSpiralDisplay($unit['damage_spiral']) ?>
                                </div>
                                <div class="clearer"></div>
                            <?php endif; ?>
                            <?php if ($unit['damage_grid'] != ''): ?>
                                <?php $allUnits->getGridDisplay($unit['damage_grid']) ?>
                                <div class="damage-grid">
                                    <?php echo $allUnits->getGridDisplay($unit['damage_grid']) ?>
                                </div>
                                <div class="clearer"></div>
                            <?php endif; ?>
                            <?php if ($unit['purchased_low'] != NULL): ?>
                                <?php // check to see if 'purchased_low' and 'purchased_high' are equal - if so display only one value ?>
                                <?php if ($unit['purchased_low'] == $unit['purchased_high']): ?>
                                    <br /><strong style="font-size:1.3em;">Unit Count:</strong>
                                    <span class="purchased-hight"><?php echo $unit['purchased_high']; ?> Grunts
                                    <?php if ($unit['unit_leader'] != NULL) : ?>
                                        <?php $attached = $allUnits->createCompanionArray($unit['unit_leader']) ?>
                                        <?php foreach ($attached as $attach): ?>
                                            <?php if ($attach == 'included'): ?>
                                                &amp; Leader
                                            <?php else: ?>
                                                &amp; <a href="http://roho.in/playtest/single-unit.php?name=<?php echo $attach ?>" title="<?php echo $attach ?>"><?php echo $attach ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?></span><br />
                                <?php else: ?>
                                    <br /><strong style="font-size:1.3em;">Minimum Unit Count:</strong>
                                    <span class="purchased-low"><?php echo $unit['purchased_low']; ?> Grunts
                                    <?php if ($unit['unit_leader'] != NULL) : ?>
                                        <?php $attached = $allUnits->createCompanionArray($unit['unit_leader']) ?>
                                        <?php foreach ($attached as $attach): ?>
                                            <?php if ($attach == 'included'): ?>
                                                &amp; Leader
                                            <?php else: ?>
                                                &amp; <a href="http://roho.in/playtest/single-unit.php?name=<?php echo $attach ?>" title="<?php echo $attach ?>"><?php echo $attach ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?></span><br />
                                    <strong style="font-size:1.3em;">Maximum Unit Count:</strong>
                                    <span class="purchased-hight"><?php echo $unit['purchased_high']; ?> Grunts
                                    <?php if ($unit['unit_leader'] != NULL) : ?>
                                        <?php $attached = $allUnits->createCompanionArray($unit['unit_leader']) ?>
                                        <?php foreach ($attached as $attach): ?>
                                            <?php if ($attach == 'included'): ?>
                                                &amp; Leader
                                            <?php else: ?>
                                                &amp; <a href="http://roho.in/playtest/single-unit.php?name=<?php echo $attach ?>" title="<?php echo $attach ?>"><?php echo $attach ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?></span><br /><br />
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($unit['field_allowance'] != ''): ?>
                                <br /><strong style="font-size:1.3em;">Feild Allowance:</strong>
                                <span class="field-allowance"><?php if ($unit['field_allowance'] == 'C'){echo 'Character';} elseif ($unit['field_allowance'] == 'U'){echo 'Unlimited';} else echo $unit['field_allowance']; ?></span><br /><br />
                            <?php endif; ?>
                            <?php if ($unit['bg_points'] == NULL && $unit['cost'] == 0): ?>
                                <strong>This model is added to your list with <?php if ($unit['attached_to'] == ''){echo $unit['companion']; } else {echo $unit['attached_to']; } ?></strong><br /><br />
                            <?php endif; ?>
                            <?php // check to see if this unit is an attachment, that is paid for, to a certain unit ?>
                            <?php if ($unit['attached_to'] != NULL): ?>
                                <?php if (strpos($unit['attached_to'], 'Faction') !== false): ?> <?php // start first with looking at 'Faction' attachments' ?>
                                    <?php if (strpos($unit['attached_to'], 'Unit') !== false): ?>
                                        This unit can be attached to any Faction Unit
                                    <?php endif; ?>
                                    <?php if (strpos($unit['attached_to'], 'Warcaster') !== false): ?>
                                        This unit can be attached to a Faction Warcaster
                                    <?php endif; ?>
                                    <?php if (strpos($unit['attached_to'], 'Warlock') !== false): ?>
                                        This unit can be attached to a Faction Warlock
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </paper-material>
                        <?php if ($unit['weapon1'] != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <ul>
                                    <span class="list-head">Weapons</span>
                                    <?php $i = 1 ?>
                                    <?php while ($i < 6): ?>
                                        <?php if ($unit['weapon'.$i] != ''): ?>
                                            <li>
                                                <span class="line-head"><?php echo $unit['weapon'.$i] ?></span>
                                                <?php $weapon = $allWeapons->getWeaponByName($unit['weapon'.$i]) ?><?php $weapon = $weapon[0] ?>
                                                <div class="sub-info">
                                                    <?php
                                                    if ($weapon['ranged'] == true){echo '<strong>Ranged Weapon</strong><br />';}
                                                    if ($weapon['shooting_distance']){echo '<strong>Range:</strong> '.$weapon['shooting_distance'].'<br />';}
                                                    if ($weapon['rof']){echo '<strong>Rate of Fire:</strong> '.$weapon['rof'].'<br />';}
                                                    if ($weapon['aoe']){echo '<strong>Aera of Effect:</strong> '.$weapon['aoe'].'<br />';}
                                                    echo '<strong>POW:</strong> '.$weapon['pow'].'<br />';
                                                    if ($weapon['damage_type']){echo '<strong>Damage Type:</strong> '.$weapon['damage_type'].'<br />';}
                                                    if ($weapon['critical_effect']){echo '<strong>Critical Effect:</strong> '.$weapon['critical_effect'].'<br />';}
                                                    if ($weapon['continuous_effect']){echo '<strong>Continuous Effect:</strong> '.$weapon['continuous_effect'].'<br />';}
                                                    if ($weapon['reach'] == true){echo '<strong><span class="icon-reach">Reach</span></strong><br />';}
                                                    if ($weapon['open_fist'] == true){echo '<strong><span class="icon-openfist">Open Fist</span></strong><br />';}
                                                    if ($weapon['magical'] == true){echo '<strong><span class="icon-magical">Magical Attacks</span></strong><br />';}
                                                    if ($weapon['weapons_master'] == true){echo '<strong><span class="icon-weapons-master">Weapons Master</span></strong><br />';}
                                                    if ($weapon['thrown'] == true){echo '<strong><span class="icon-thrown">Thrown Weapon<span></strong><br />';}
                                                    if ($weapon['buckler'] == true){echo '<strong><span class="icon-buckler">Buckler</span></strong><br />';}
                                                    if ($weapon['shield'] == true){echo '<strong><span class="icon-shield">Shield</span></strong><br />';}
                                                    if ($weapon['special_action_1']){
                                                        echo '<strong>Special Action:</strong> '.$weapon['special_action_1'];
                                                        $ability = $allAbilities->getAbilityByName($weapon['special_action_1']);
                                                        echo '<div class="sub-info">'.$ability[0]['description_text'].'</div>';
                                                    }
                                                    if ($weapon['special_action_2']){
                                                        echo '<strong>Special Action:</strong> '.$weapon['special_action_2'];
                                                        $ability = $allAbilities->getAbilityByName($weapon['special_action_2']);
                                                        echo '<div class="sub-info">'.$ability[0]['description_text'].'</div>';
                                                    }
                                                    if ($weapon['special_action_3']){
                                                        echo '<strong>Special Action:</strong> '.$weapon['special_action_3'];
                                                        $ability = $allAbilities->getAbilityByName($weapon['special_action_3']);
                                                        echo '<div class="sub-info">'.$ability[0]['description_text'].'</div>';
                                                    }
                                                    if ($weapon['special_action_4']){
                                                        echo '<strong>Special Action:</strong> '.$weapon['special_action_4'];
                                                        $ability = $allAbilities->getAbilityByName($weapon['special_action_4']);
                                                        echo '<div class="sub-info">'.$ability[0]['description_text'].'</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php $i++ ?>
                                    <?php endwhile; ?>
                                </ul>
                            </paper-material>
                        <?php endif; ?>
                        <?php if ($unit['special_ability_1'] != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <ul>
                                    <span class="list-head">Abilities and Special Rules</span>
                                    <?php $i = 1 ?>
                                    <?php while ($i < 11):?>
                                        <?php if ($unit['special_ability_'.$i] != ''):?>
                                            <li>
                                                <span class="line-head"><?php echo $unit['special_ability_'.$i] ?></span>
                                                <?php $ability = $allAbilities->getAbilityByName($unit['special_ability_'.$i]) ?><?php $ability = $ability[0] ?>
                                                <div class="sub-info">
                                                    <?php echo $ability['description_text'];?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php $i++ ?>
                                    <?php endwhile; ?>
                                </ul>
                            </paper-material>
                        <?php endif; ?>
                        <?php if ($unit['spell_1'] != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <ul>
                                    <span class="list-head">Spells</span>
                                    <?php $i = 1 ?>
                                    <?php while ($i < 11): ?>
                                        <?php if ($unit['spell_'.$i] != ''):?>
                                            <li>
                                            <span class="line-head"><?php echo $unit['spell_'.$i] ?></span>
                                            <?php $spell = $allSpells->getSpellByName($unit['spell_'.$i]) ?><?php $spell = $spell[0] ?>
                                            <div class="sub-info">
                                                <?php if ($spell['description']){echo '<strong>Description:</strong> '.$spell['description'].'<br />';};
                                                if ($spell['cost']){echo '<strong>Cost:</strong> '.$spell['cost'].'<br />';};
                                                if ($spell['range_distance']){echo '<strong>Range:</strong> '.$spell['range_distance'].'<br />';};
                                                if ($spell['aoe']){echo '<strong>Area of Effect:</strong> '.$spell['aoe'].'<br />';};
                                                if ($spell['pow']){echo '<strong>POW:</strong> '.$spell['pow'].'<br />';};
                                                if ($spell['upkeep'] ==  true){echo '<strong>Upkeep</strong><br />';};
                                                if ($spell['offensive'] ==  true){echo '<strong>Offensive</strong><br />';};
                                                if ($spell['ability_granted']){echo '<strong>Ability Granted:</strong> '.$spell['ability_granted'].'<br />';};
                                                if ($spell['second_ability_granted']){echo '<strong>Second Ability Granted:</strong> '.$spell['second_ability_granted'].'<br />';};
                                                if ($spell['off_spd_mod']){echo '<strong>Speed Modifier:</strong> '.$spell['off_spd_mod'].'<br />';};
                                                if ($spell['off_str_mod']){echo '<strong>Strength Modifier:</strong> '.$spell['off_str_mod'].'<br />';};
                                                if ($spell['off_mat_mod']){echo '<strong>Melee Attack Modifier:</strong> '.$spell['off_mat_mod'].'<br />';};
                                                if ($spell['off_rat_mod']){echo '<strong>Ranged Attack Modifier:</strong> '.$spell['off_rat_mod'].'<br />';};
                                                if ($spell['off_def_mod']){echo '<strong>Defense Modifier:</strong> '.$spell['off_def_mod'].'<br />';};
                                                if ($spell['off_arm_mod']){echo '<strong>Armor Modifier:</strong> '.$spell['off_arm_mod'].'<br />';};
                                                if ($spell['duration']){echo '<strong>Duration:</strong> '.$spell['duration'].'<br />';}; ?>
                                            </div>
                                            </li><?php endif; ?>
                                        <?php $i++ ?>
                                    <?php endwhile; ?>
                                </ul>
                            </paper-material>
                        <?php endif; ?>
                        <?php if ($unit['animus_known'] != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <ul>
                                    <span class="list-head">Animus</span>
                                    <li>
                                        <span class="line-head"><?php echo $unit['animus_known'] ?></span>
                                        <div class="sub-info">
                                            <?php $animus = $allAnimus->getAnimusByName($unit['animus_known']) ?><?php $animus = $animus[0] ?>
                                            <?php if ($animus['description']){echo '<strong>Description:</strong> '.$animus['description'].'<br />';};
                                            if ($animus['cost']){echo '<strong>Cost:</strong> '.$animus['cost'].'<br />';};
                                            if ($animus['range_distance']){echo '<strong>Range:</strong> '.$animus['range_distance'].'<br />';};
                                            if ($animus['aoe']){echo '<strong>Area of Effect:</strong> '.$animus['aoe'].'<br />';};
                                            if ($animus['pow']){echo '<strong>POW:</strong> '.$animus['pow'].'<br />';};
                                            if ($animus['upkeep'] ==  true){echo '<strong>Upkeep</strong><br />';};
                                            if ($animus['offensive'] ==  true){echo '<strong>Offensive</strong><br />';};
                                            if ($animus['ability_granted']){echo '<strong>Ability Granted:</strong> '.$animus['ability_granted'].'<br />';};
                                            if ($animus['second_ability_granted']){echo '<strong>Second Ability Granted:</strong> '.$animus['second_ability_granted'].'<br />';};
                                            if ($animus['off_spd_mod']){echo '<strong>Speed Modifier:</strong> '.$animus['off_spd_mod'].'<br />';};
                                            if ($animus['off_str_mod']){echo '<strong>Strength Modifier:</strong> '.$animus['off_str_mod'].'<br />';};
                                            if ($animus['off_mat_mod']){echo '<strong>Melee Attack Modifier:</strong> '.$animus['off_mat_mod'].'<br />';};
                                            if ($animus['off_rat_mod']){echo '<strong>Ranged Attack Modifier:</strong> '.$animus['off_rat_mod'].'<br />';};
                                            if ($animus['off_def_mod']){echo '<strong>Defense Modifier:</strong> '.$animus['off_def_mod'].'<br />';};
                                            if ($animus['off_arm_mod']){echo '<strong>Armor Modifier:</strong> '.$animus['off_arm_mod'].'<br />';};
                                            if ($animus['duration']){echo '<strong>Duration:</strong> '.$animus['duration'].'<br />';}; ?>
                                        </div>
                                    </li>
                                </ul>
                            </paper-material>
                        <?php endif; ?>
                        <?php if ($unit['feat'] != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <strong style="font-size:1.3em;">Feat:</strong><br />
                                <span class="feat"><?php echo $unit['feat'] ?></span>
                            </paper-material>
                        <?php endif; ?>
                    </div>
                    <div class="flex-2 unit-info cushion-sides info-block-tools">
                        <paper-material elevation="1" class="cushion center">
                            <?php echo $allUnits->getUnitImageName($unit['name']) ?>
                        </paper-material>
                        <?php if ($unit['companion'] != NULL): ?>
                            <?php if (strpos($unit['companion'], '-Base') === false && strpos($unit['companion'], 'Faction') === false): ?>
                                <paper-material elevation="1" class="cushion">
                                    <?php $companions = $allUnits->createCompanionArray($unit['companion']) ?>
                                    <?php foreach ($companions as $companion): ?>
                                        <p><strong>Companion Model:</strong> <a href="http://roho.in/playtest/single-unit.php?name=<?php echo $companion ?>" title="<?php echo $companion ?>"><?php echo $companion ?></a></p>
                                    <?php endforeach; ?>
                                </paper-material>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($unit['attached_to'] != NULL): ?>
                            <?php if (strpos($unit['attached_to'], '-Base') === false && strpos($unit['attached_to'], 'Faction') === false): ?>
                                <paper-material elevation="1" class="cushion">
                                    <?php $attached = $allUnits->createCompanionArray($unit['attached_to']) ?>
                                    <?php foreach ($attached as $attach): ?>
                                        <p><strong>Attached To:</strong> <a href="http://roho.in/playtest/single-unit.php?name=<?php echo $attach ?>" title="<?php echo $attach ?>"><?php echo $attach ?></a></p>
                                    <?php endforeach; ?>
                                </paper-material>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($unit['unit_leader'] != NULL && $unit['unit_leader'] != 'included'): ?>
                            <?php if (strpos($unit['attached_to'], '-Base') === false && strpos($unit['unit_leader'], 'Faction') === false): ?>
                                <paper-material elevation="1" class="cushion">
                                    <?php $attached = $allUnits->createCompanionArray($unit['unit_leader']) ?>
                                    <?php foreach ($attached as $attach): ?>
                                        <p><strong>Unit Leader:</strong> <a href="http://roho.in/playtest/single-unit.php?name=<?php echo $attach ?>" title="<?php echo $attach ?>"><?php echo $attach ?></a></p>
                                    <?php endforeach; ?>
                                </paper-material>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php $tierList = $tiers->getTierByCasterId($unit['id'])[0]; ?>
                        <?php if ($tierList != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <strong><?php echo $tierList['name'] ?> - Tiered List</strong><br />
                                <ul>
                                    <li><strong>Battle Group:</strong> <?php echo $tierList['req_battlegroup_front'] ?></li>
                                    <li><strong>Units:</strong> <?php echo $tierList['req_units_front'] ?></li>
                                    <li><strong>Solos:</strong> <?php echo $tierList['req_solos_front'] ?></li>
                                    <li><strong>Battle Engines:</strong> <?php echo $tierList['req_battleengine_front'] ?></li>
                                </ul>
                                <paper-material elevation="1" class="cushion">
                                    <strong>Tier 1:</strong><br />
                                    <ul>
                                        <li><strong>Requirement:</strong> <?php echo $tierList['tier1_req_front'] ?></li>
                                        <li><strong>Bonus:</strong> <?php echo $tierList['tier1_bonus_front'] ?></li>
                                    </ul>
                                </paper-material>
                                <paper-material elevation="1" class="cushion">
                                    <strong>Tier 2:</strong><br />
                                    <ul>
                                        <li><strong>Requirement:</strong> <?php echo $tierList['tier2_req_front'] ?></li>
                                        <li><strong>Bonus:</strong> <?php echo $tierList['tier3_bonus_front'] ?></li>
                                    </ul>
                                </paper-material>
                                <paper-material elevation="1" class="cushion">
                                    <strong>Tier 3:</strong><br />
                                    <ul>
                                        <li><strong>Requirement:</strong> <?php echo $tierList['tier3_req_front'] ?></li>
                                        <li><strong>Bonus:</strong> <?php echo $tierList['tier3_bonus_front'] ?></li>
                                    </ul>
                                </paper-material>
                                <paper-material elevation="1" class="cushion">
                                    <strong>Tier 4:</strong><br />
                                    <ul>
                                        <li><strong>Requirement:</strong> <?php echo $tierList['tier4_req_front'] ?></li>
                                        <li><strong>Bonus:</strong> <?php echo $tierList['tier4_bonus_front'] ?></li>
                                    </ul>
                                </paper-material>
                                <?php //var_dump($tierList) ?>
                            </paper-material>
                        <?php endif; ?>
                        <?php if ($unit['possible_ua'] != ''): ?>
                            <paper-material elevation="1" class="cushion">
                                <strong>Possible Attachments:</strong><br />
                                <ul>
                                <?php foreach ($unit['possible_ua'] as $ua): ?>
                                    <li><a href="http://roho.in/playtest/single-unit.php?name=<?php echo $ua['name'] ?>" title="<?php echo $ua['name'] ?>"><?php echo $ua['name'] ?> for <?php echo $ua['cost'] ?> pts.</a></li>
                                <?php endforeach; ?>
                                </ul>
                            </paper-material>
                        <?php endif; ?>
                        <?php if ($loggedIn == true): ?>
                            <paper-material elevation="1" class="cushion center">
                                <div id="barracks-update"></div>
                                <div id="unit-update-feedback"></div>
                            </paper-material>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="cushion center" style="width:100%;">Please Choose a Unit from that bar just above this here line of text</div>
            <?php endif; ?>
        </div>
        <?php if ($_SESSION['user_name'] == 'roarb'): ?>
            <paper-fab mini icon="edit" class="edit-fab link-out" data-src="/admin/builder/unit-edit.php?name=<?php echo $unit['name'] ?>"></paper-fab>
        <?php endif; ?>
    </paper-header-panel>
</paper-drawer-panel>
<script> // sizes the 2 columns on the pages to the proper height to add in a scroll bar, need to add a script to fire this on orienation change in the future.
    $(document).ready(function(){
        var h = $(window).height() - 100;
        $('.unit-info').css('max-height',h);
        barracksModelsCount(<?php echo $_SESSION['user_id']?>, <?php echo $unit['id'] ?>);
    })
</script>
</body>
</html>