<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../core/Core.php';
    include '../../core/Unit.php';
    include '../../core/Faction.php';
    include '../../core/SpellsKnown.php';
    include '../../admin/header.php';
    include '../../core/SpecialAbilities.php';
    include '../../core/Weapons.php';
    $allFactions = new AllFactions();
    $allUnits = new AllUnits();
    $allAbilities = new AllSpecialAbilities();
    $allSpells = new AllSpellsKnown();
    $factionsList = $allFactions->getAllFactions();
    $allWeapons = new AllWeapons();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RoHo.in Admin Stat-o-Matic</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../login/index.php'; ?>
            <?php include '../../nav/main-nav.php'; ?>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">RoHo.In Admin Stat-o-Matic</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <div class="info-block cushion">
                <div layout="row">
                    <table class="stats-overview data-table">
                        <thead>
                        <tr class="faction-id">
                            <th></th>
                            <?php foreach ($factionsList as $faction): ?>
                                <th><?php echo $faction['name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="all-units">
                            <td class="label">
                                # of Models - click for units breakdown page<br />
                                <?php $totUnits = count($allUnits->getAllUnitsName()) ?>
                                <?php echo $totUnits ?>
                            </td>
                            <?php foreach ($factionsList as $faction): ?>
                                <td>
                                    <?php $x = $allUnits->getFactionUnitList($faction['name']); ?>
                                    <?php $i = 0; $count = 0; ?>
                                    <?php foreach ($x as $y): ?>
                                        <?php if ($y['companion'] == null){
                                            // count how many units skipping over companions
                                            $count++;
                                        }?>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    <?php echo $count; ?>
                                    <?php $p = ($count / $totUnits) * 100 ?>
                                    <br /><?php echo number_format((float)$p, 2, '.', ''); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr class="all-abilities">
                            <td class="label">
                                # of abilities available<br />
                                <?php $sas = $allAbilities->getAllSpecialAbilitiesName(); ?>
                                <?php $totAbil = count($sas) ?>
                                <?php echo $totAbil ?>
                            </td>
                            <?php foreach ($factionsList as $faction): ?>
                                <td>
                                    <?php $unitsList = $allUnits->getFactionUnitListAbilities($faction['name']);
                                    $count = 0;
                                    $sortedUnitsList = '';
                                    if ($unitsList != ''){
                                        foreach ($unitsList as $list){
                                            $sortedUnitsList .= implode(',',$list);
                                        }
                                    }
                                    foreach($sas as $ability):
                                        if (strpos($sortedUnitsList,$ability['name']) !== false):
                                            $count++;
                                        endif;
                                    endforeach;
                                    echo $count; ?>
                                    <?php $p = ($count / $totAbil) * 100; ?>
                                    <br /><?php echo number_format((float)$p, 2, '.', ''); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr class="all-spells">
                            <td class="label">
                                # of spells available<br />
                                <?php $spells = $allSpells->getAllSpellsName(); ?>
                                <?php $totSpells = count($spells) ?>
                                <?php echo $totSpells ?>
                            </td>
                            <?php foreach ($factionsList as $faction): ?>
                                <td>
                                    <?php $unitsList = $allUnits->getFactionUnitListSpells($faction['name']);
                                    $count = 0;
                                    $sortedUnitsList = '';
                                    if ($unitsList != ''){
                                        foreach ($unitsList as $list){
                                            $sortedUnitsList .= implode(',',$list);
                                        }
                                    }
                                    foreach($spells as $spell):
                                        if (strpos($sortedUnitsList,$spell['name']) !== false):
                                            $count++;
                                        endif;
                                    endforeach;
                                    echo $count; ?>
                                    <?php $p = ($count / $totSpells) * 100; ?>
                                    <br /><?php echo number_format((float)$p, 2, '.', ''); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr class="all-weapons">
                            <td class="label">
                                # of weapons available<br />
                                <?php $weps = $allWeapons->getAllWeaponsName(); ?>
                                <?php $totWeps = count($weps) ?>
                                <?php echo $totWeps ?>
                            </td>
                            <?php foreach ($factionsList as $faction): ?>
                                <td>
                                    <?php $unitsList = $allUnits->getFactionUnitListWeapons($faction['name']);
                                    $count = 0;
                                    $sortedUnitsList = '';
                                    if ($unitsList != ''){
                                        foreach ($unitsList as $list){
                                            $sortedUnitsList .= implode(',',$list);
                                        }
                                    }
                                    foreach($weps as $weapon):
                                        if (strpos($sortedUnitsList,$weapon['name']) !== false):
                                            $count++;
                                        endif;
                                    endforeach;
                                    echo $count; ?>
                                    <?php $p = ($count / $totWeps) * 100; ?>
                                    <br /><?php echo number_format((float)$p, 2, '.', ''); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
<?php else: ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../nav/main-nav.php'; ?>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Please login as Admin first</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <div class="info-block">
                <p class="cushion center">This area is off limits for all but the most awesome of people.</p>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
<?php endif; ?>
</body>
</html>
