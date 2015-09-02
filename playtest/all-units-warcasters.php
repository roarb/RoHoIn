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
    $allUnits = new AllUnits;
    $allAnimus = new AllAnimusKnown;
    $allSpells = new AllSpellsKnown;
    $allWeapons = new AllWeapons;
    $core = new AllCore;

    $unitsList = $allUnits->getWarcasterWarlockUnits(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Compare all Warcasters/Warlocks for Warmachine &amp; Hordes with RoHo.In</title>
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
            <h1 class="full-page-title">Compare all Warcasters/Warlocks for Warmachine &amp; Hordes</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>

        <div class="horizontal layout">
            <div class="flex-1 cushion info-block">
                <table id="warcaster-overview" class="data-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Faction</th>
                        <th>SPD</th>
                        <th>STR</th>
                        <th>MAT</th>
                        <th>RAT</th>
                        <th>DEF</th>
                        <th>ARM</th>
                        <th>Damage Boxes</th>
                        <th>BG Points</th>
                        <th>Focus/Fury</th>
                        <th>Spells</th>
                        <th>Abilities</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $averages = $allUnits->getAveragesWarcasterWarlock($unitsList) ?>
                    <?php foreach ($unitsList as $unit): ?>
                        <tr id="unit-<?php echo $unit['id']?>" class="<?php echo $unit['faction'] ?>">
                            <td class="unit-name"><a href="/playtest/single-unit.php?name=<?php echo $unit['name'] ?>"><?php echo $unit['name'] ?></a></td>
                            <td class="faction"><?php echo $unit['faction'] ?></td>
                            <td class="speed">
                                <?php $percent = $core->getSlidePos(min($averages['all-spd']),max($averages['all-spd']),$unit['spd']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="str">
                                <?php $percent = $core->getSlidePos(min($averages['all-str']),max($averages['all-str']),$unit['str']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="mat">
                                <?php $percent = $core->getSlidePos(min($averages['all-mat']),max($averages['all-mat']),$unit['mat']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="rat">
                                <?php $percent = $core->getSlidePos(min($averages['all-rat']),max($averages['all-rat']),$unit['rat']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="def">
                                <?php $percent = $core->getSlidePos(min($averages['all-def']),max($averages['all-def']),$unit['def']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="arm">
                                <?php $percent = $core->getSlidePos(min($averages['all-arm']),max($averages['all-arm']),$unit['arm']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="damage-boxes">
                                <?php // get second highest damage boxes ?>
                                <?php rsort($averages['all-dmg']); ?>
                                <?php //echo $averages['all-dmg'][1]; ?><?php //echo min($averages['all-dmg']) ?><?php //echo $unit['damage_boxes'] ?>
                                <?php $percent = $core->getSlidePos(min($averages['all-dmg']),$averages['all-dmg'][1],$unit['damage_boxes']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="bg-points">
                                <?php $percent = $core->getSlidePos(min($averages['all-bgpoints']),max($averages['all-bgpoints']),$unit['bg_points']); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="focus-fury">
                                <?php $focusfury = '' ?>
                                <?php if ($unit['focus'] != ''):$focusfury = $unit['focus']; ?>
                                <?php else: $focusfury = $unit['fury']; ?>
                                <?php endif; ?>
                                <?php $percent = $core->getSlidePos(min($averages['all-focusfury']),max($averages['all-focusfury']),$focusfury); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="spells">
                                <?php $percent = $core->getSlidePos(min($averages['all-spells']),max($averages['all-spells']),$allUnits->getCountSpells($unit)); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                            <td class="abilities">
                                <?php $percent = $core->getSlidePos(min($averages['all-abilities']),max($averages['all-abilities']),$allUnits->getCountAbilities($unit)); ?>
                                <div class="slider"><div class="slider-pos <?php echo $core->getSliderColor($percent); ?>" style="width:<?php echo round($percent) ?>%;"></div></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>