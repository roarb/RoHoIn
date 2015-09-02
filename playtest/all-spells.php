<?php include('login/index-start.php'); ?>
<html lang="en">
<head>
    <?php
    include '../admin/header.php';
    include '../core/Core.php';
    include '../core/Unit.php';
    include '../core/SpellsKnown.php';
    $allSpells = new AllSpellsKnown;
    $spellsList = $allSpells->getAllSpells();
    $unitsList = '';
    if (!empty($_GET['faction'])){
        $allUnits = new AllUnits;
        $unitsList = $allUnits->getFactionUnitListSpells($_GET['faction']);
        $sortedUnitsList = '';
        if ($unitsList != ''){
            foreach ($unitsList as $list){
                $sortedUnitsList .= implode(',',$list);
            }
        }
    }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View All Available Spells - RoHo.In</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include '../nav/main-nav.php'; ?>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title">View All Available Spells - RoHo.In</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
            <div class="background-title">Sort By Faction</div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CircleLogo.png" title="Circle Orboros" class="link-out" data-src="/playtest/all-spells.php?faction=Circle%20Orboros"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/convergence.png" title="Convergence of Cyriss" class="link-out" data-src="/playtest/all-spells.php?faction=Convergence%20of%20Cyriss"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CryxLogo.png" title="Cryx" class="link-out" data-src="/playtest/all-spells.php?faction=Cryx"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CygnarLogo.png" title="Cygnar" class="link-out" data-src="/playtest/all-spells.php?faction=Cygnar"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/KhadorLogo.png" title="Khador" class="link-out" data-src="/playtest/all-spells.php?faction=Khador"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/LegionLogo.png" title="Legion of Everblight" class="link-out" data-src="/playtest/all-spells.php?faction=Legion%20of%20Everblight"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MercsLogo.png" title="Mercenaries" class="link-out" data-src="/playtest/all-spells.php?faction=Mercenaries"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MinionsLogo.png" title="Minions" class="link-out" data-src="/playtest/all-spells.php?faction=Minions"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/RetributionLogo.png" title="Retribution of Scyrah" class="link-out" data-src="/playtest/all-spells.php?faction=Retribution%20of%20Scyrah"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/SkorneLogo.png" title="Skorne" class="link-out" data-src="/playtest/all-spells.php?faction=Skorne"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MenothLogo.png" title="The Protectorate of Menoth" class="link-out" data-src="/playtest/all-spells.php?faction=The%20Protectorate%20of%20Menoth"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/TrollbloodsLogo.png" title="Trollbloods" class="link-out" data-src="/playtest/all-spells.php?faction=Trollbloods"></paper-icon-button>
            </div>
        </paper-toolbar>
        <div class="horizontal layout">
            <div class="flex-1 cushion info-block">
                <?php if (!empty($_GET['faction'])): ?>
                    <ul class="attribute-list">
                        <?php foreach($spellsList as $spell):?>
                            <?php if (strpos($sortedUnitsList,$spell['name']) !== false): ?>
                                <li class="display-item"><strong><?php echo $spell['name']; ?></strong>
                                    <div class="indent"><?php
                                        if ($spell['description']){echo '<strong>Description:</strong> '.$spell['description'].'<br />';};
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
                                        if ($spell['duration']){echo '<strong>Duration:</strong> '.$spell['duration'].'<br />';};
                                        ?></div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <ul class="attribute-list">
                        <?php foreach($spellsList as $spell):?>
                            <li class="display-item"><strong><?php echo $spell['name']; ?></strong>
                                <div class="indent"><?php
                                    if ($spell['description']){echo '<strong>Description:</strong> '.$spell['description'].'<br />';};
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
                                    if ($spell['duration']){echo '<strong>Duration:</strong> '.$spell['duration'].'<br />';};
                                    ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>