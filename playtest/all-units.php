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
        $allAbilities = new AllSpecialAbilities;
        $allUnits = new AllUnits;
        $allAnimus = new AllAnimusKnown;
        $allSpells = new AllSpellsKnown;
        $allWeapons = new AllWeapons;
        $allFactions = new AllFactions;
        $core = new AllCore;

        $factionList = $allFactions->getAllFactions();
        $unitsList = $allUnits->getAllUnits(); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Compare all Warmachine &amp; Hordes Models with RoHo.In</title>
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
                <h1 class="full-page-title">Compare all Warmachine &amp; Hordes Models</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>

            <div class="horizontal layout">
                <div class="flex-1 cushion info-block">
                    <table id="warcaster-overview" class="data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($factionList as $faction): ?>
                                <th><?php echo $faction['name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <td><a href="/playtest/all-units-warcasters.php">Warcasters-Warlocks</a></td>
                        <?php $type = array('Warlock', 'Warcaster') ?>
                        <?php foreach ($factionList as $faction): ?>
                            <td>
                                <?php $units = $allUnits->getCountFactionType($unitsList,$faction['name'],$type); ?>
                                # <?php echo $units['count'] ?><br />
                                <?php $min = $core->removeFromArray($units['all-spd'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-spd']),$units['avg-spd']); ?>
                                SPD: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['all-str'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-str']),$units['avg-str']); ?>
                                STR: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['all-mat'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-mat']),$units['avg-mat']); ?>
                                MAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['all-rat'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-rat']),$units['avg-rat']); ?>
                                RAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['all-def'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-def']),$units['avg-def']); ?>
                                DEF: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['all-arm'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-arm']),$units['avg-arm']); ?>
                                ARM: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['all-dmg'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-dmg']),$units['avg-dmg']); ?>
                                DMG BOXES: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $min = $core->removeFromArray($units['bg_points'], 0) ?>
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-bgpoints']),$units['avg-bgpoints']); ?>
                                BG Points: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-focusfury']),$units['avg-focusfury']); ?>
                                Focus/Fury: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-spells']),$units['avg-spells']); ?>
                                Spells Count: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                <?php $percent = $core->getSlidePos(min($min),max($units['all-abilities']),$units['avg-abilities']); ?>
                                Abilities Count: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                            </td>
                        <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                    <table id="heavy-overview" class="data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($factionList as $faction): ?>
                                <th><?php echo $faction['name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Heavys</td>
                            <?php $type = array('Heavy Warbeast', 'Heavy Warjack', 'Helljack', 'Heavy Vector', 'Heavy Myrmidon') ?>
                            <?php foreach ($factionList as $faction): ?>
                                <td>
                                    <?php $units = $allUnits->getCountFactionType($unitsList,$faction['name'],$type); ?>
                                    # <?php echo $units['count'] ?><br />
                                    <?php $min = $core->removeFromArray($units['all-spd'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-spd']),$units['avg-spd']); ?>
                                    SPD: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-str'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-str']),$units['avg-str']); ?>
                                    STR: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-mat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-mat']),$units['avg-mat']); ?>
                                    MAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-rat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-rat']),$units['avg-rat']); ?>
                                    RAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-def'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-def']),$units['avg-def']); ?>
                                    DEF: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-arm'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-arm']),$units['avg-arm']); ?>
                                    ARM: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-dmg'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-dmg']),$units['avg-dmg']); ?>
                                    DMG BOXES: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['cost'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-cost']),$units['avg-cost']); ?>
                                    COST: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-abilities']),$units['avg-abilities']); ?>
                                    Abilities Count: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                    <table id="light-overview" class="data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($factionList as $faction): ?>
                                <th><?php echo $faction['name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Lights</td>
                            <?php $type = array('Light Warbeast', 'Light Warjack', 'Bone Jack', 'Light Vector', 'Light Myrmidon') ?>
                            <?php foreach ($factionList as $faction): ?>
                                <td>
                                    <?php $units = $allUnits->getCountFactionType($unitsList,$faction['name'],$type); ?>
                                    # <?php echo $units['count'] ?><br />
                                    <?php $min = $core->removeFromArray($units['all-spd'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-spd']),$units['avg-spd']); ?>
                                    SPD: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-str'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-str']),$units['avg-str']); ?>
                                    STR: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-mat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-mat']),$units['avg-mat']); ?>
                                    MAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-rat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-rat']),$units['avg-rat']); ?>
                                    RAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-def'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-def']),$units['avg-def']); ?>
                                    DEF: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-arm'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-arm']),$units['avg-arm']); ?>
                                    ARM: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-dmg'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-dmg']),$units['avg-dmg']); ?>
                                    DMG BOXES: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['cost'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-cost']),$units['avg-cost']); ?>
                                    COST: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-abilities']),$units['avg-abilities']); ?>
                                    Abilities Count: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                    <table id="solo-overview" class="data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($factionList as $faction): ?>
                                <th><?php echo $faction['name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Solos</td>
                            <?php $type = array('Solo', 'Character Solo') ?>
                            <?php foreach ($factionList as $faction): ?>
                                <td>
                                    <?php $units = $allUnits->getCountFactionType($unitsList,$faction['name'],$type); ?>
                                    # <?php echo $units['count'] ?><br />
                                    <?php $min = $core->removeFromArray($units['all-spd'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-spd']),$units['avg-spd']); ?>
                                    SPD: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-str'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-str']),$units['avg-str']); ?>
                                    STR: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-mat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-mat']),$units['avg-mat']); ?>
                                    MAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-rat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-rat']),$units['avg-rat']); ?>
                                    RAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-def'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-def']),$units['avg-def']); ?>
                                    DEF: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-arm'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-arm']),$units['avg-arm']); ?>
                                    ARM: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['cost'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-cost']),$units['avg-cost']); ?>
                                    COST: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-abilities']),$units['avg-abilities']); ?>
                                    Abilities Count: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                    <table id="unit-overview" class="data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($factionList as $faction): ?>
                                <th><?php echo $faction['name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Units</td>
                            <?php $type = array('Unit') ?>
                            <?php foreach ($factionList as $faction): ?>
                                <td>
                                    <?php $units = $allUnits->getCountFactionType($unitsList,$faction['name'],$type); ?>
                                    # <?php echo $units['count'] ?><br />
                                    <?php $min = $core->removeFromArray($units['all-spd'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-spd']),$units['avg-spd']); ?>
                                    SPD: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-str'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-str']),$units['avg-str']); ?>
                                    STR: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-mat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-mat']),$units['avg-mat']); ?>
                                    MAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-rat'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-rat']),$units['avg-rat']); ?>
                                    RAT: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-def'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-def']),$units['avg-def']); ?>
                                    DEF: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['all-arm'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-arm']),$units['avg-arm']); ?>
                                    ARM: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                    <?php $min = $core->removeFromArray($units['cost'], 0) ?>
                                    <?php $percent = $core->getSlidePos(min($min),max($units['all-cost']),$units['avg-cost']); ?>
                                    COST: <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div><br />
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </div>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
</body>
</html>