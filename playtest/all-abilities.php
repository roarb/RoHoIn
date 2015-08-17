<?php include('login/index-start.php'); ?>
<html lang="en">
<head>
    <?php
    include '../admin/header.php';
    include '../core/Core.php';
    include '../core/SpecialAbilities.php';
    include '../core/Unit.php';
    include '../core/AnimusKnown.php';
    include '../core/SpellsKnown.php';
    include '../core/Weapons.php';
    $allAbilities = new AllSpecialAbilities;
    $abilitiesList = $allAbilities->getAllSpecialAbilities();
    $unitsList = '';
    if (!empty($_GET['faction'])){
        $allUnits = new AllUnits;
        $unitsList = $allUnits->getFactionUnitListAbilities($_GET['faction']);
        $allAnimus = new AllAnimusKnown;
        $allSpells = new AllSpellsKnown;
        $allWeapons = new AllWeapons;
        $sortedUnitsList = '';
        if ($unitsList != ''){
            foreach ($unitsList as $list){
                $sortedUnitsList .= implode(',',$list);
            }
        }
    }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View All Available Special Abilities &amp; Actions - RoHo.In</title>
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
            <h1 class="full-page-title">View All Available Special Abilities &amp; Actions - RoHo.In</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
            <div class="background-title">Sort By Faction</div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CircleLogo.png" title="Circle Orboros" class="link-out" data-src="/playtest/all-abilities.php?faction=Circle%20Orboros"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/convergence.png" title="Convergence of Cyriss" class="link-out" data-src="/playtest/all-abilities.php?faction=Convergence%20of%20Cyriss"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CryxLogo.png" title="Cryx" class="link-out" data-src="/playtest/all-abilities.php?faction=Cryx"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CygnarLogo.png" title="Cygnar" class="link-out" data-src="/playtest/all-abilities.php?faction=Cygnar"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/KhadorLogo.png" title="Khador" class="link-out" data-src="/playtest/all-abilities.php?faction=Khador"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/LegionLogo.png" title="Legion of Everblight" class="link-out" data-src="/playtest/all-abilities.php?faction=Legion%20of%20Everblight"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MercsLogo.png" title="Mercenaries" class="link-out" data-src="/playtest/all-abilities.php?faction=Mercenaries"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MinionsLogo.png" title="Minions" class="link-out" data-src="/playtest/all-abilities.php?faction=Minions"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/RetributionLogo.png" title="Retribution of Scyrah" class="link-out" data-src="/playtest/all-abilities.php?faction=Retribution%20of%20Scyrah"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/SkorneLogo.png" title="Skorne" class="link-out" data-src="/playtest/all-abilities.php?faction=Skorne"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MenothLogo.png" title="The Protectorate of Menoth" class="link-out" data-src="/playtest/all-abilities.php?faction=The%20Protectorate%20of%20Menoth"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/TrollbloodsLogo.png" title="Trollbloods" class="link-out" data-src="/playtest/all-abilities.php?faction=Trollbloods"></paper-icon-button>
            </div>
        </paper-toolbar>
        <div class="horizontal layout">
            <div class="flex-1 cushion info-block">
                <?php if (!empty($_GET['faction'])): ?>
                    <ul class="attribute-list">
                        <?php foreach($abilitiesList as $ability):?>
                            <?php if (strpos($sortedUnitsList,$ability['name']) !== false): ?>
                                <li class="display-item">
                                    <strong><?php echo $ability['name']; ?></strong>
                                    <div class="indent"><?php echo $ability['description_text'];?></div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <ul class="attribute-list">
                        <?php foreach($abilitiesList as $ability):?>
                            <li class="display-item">
                                <strong><?php echo $ability['name']; ?></strong>
                                <div class="indent"><?php echo $ability['description_text'];?></div>
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