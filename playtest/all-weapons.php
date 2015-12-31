<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
<?php
    include '../admin/header.php';
    include '../core/Core.php';
    $core = new AllCore;
    $allWeapons = new AllWeapons;
    $weaponsList = $allWeapons->getAllWeapons();
    $unitsList = '';
    if (!empty($_GET['faction'])){
        $allUnits = new AllUnits;
        $unitsList = $allUnits->getFactionUnitListWeapons($_GET['faction']);
        $sortedUnitsList = '';
        if ($unitsList != ''){
            foreach ($unitsList as $list){
                $sortedUnitsList .= implode(',',$list);
            }
        }
    }
?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View All Available Weapons - RoHo.In</title>
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
            <h1 class="full-page-title">View All Available Weapons - RoHo.In</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
            <div class="background-title">Sort By Faction</div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CircleLogo.png" title="Circle Orboros" class="link-out" data-src="/playtest/all-weapons.php?faction=Circle%20Orboros"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/convergence.png" title="Convergence of Cyriss" class="link-out" data-src="/playtest/all-weapons.php?faction=Convergence%20of%20Cyriss"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CryxLogo.png" title="Cryx" class="link-out" data-src="/playtest/all-weapons.php?faction=Cryx"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/CygnarLogo.png" title="Cygnar" class="link-out" data-src="/playtest/all-weapons.php?faction=Cygnar"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/KhadorLogo.png" title="Khador" class="link-out" data-src="/playtest/all-weapons.php?faction=Khador"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/LegionLogo.png" title="Legion of Everblight" class="link-out" data-src="/playtest/all-weapons.php?faction=Legion%20of%20Everblight"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MercsLogo.png" title="Mercenaries" class="link-out" data-src="/playtest/all-weapons.php?faction=Mercenaries"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MinionsLogo.png" title="Minions" class="link-out" data-src="/playtest/all-weapons.php?faction=Minions"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/RetributionLogo.png" title="Retribution of Scyrah" class="link-out" data-src="/playtest/all-weapons.php?faction=Retribution%20of%20Scyrah"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/SkorneLogo.png" title="Skorne" class="link-out" data-src="/playtest/all-weapons.php?faction=Skorne"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/MenothLogo.png" title="The Protectorate of Menoth" class="link-out" data-src="/playtest/all-weapons.php?faction=The%20Protectorate%20of%20Menoth"></paper-icon-button>
            </div>
            <div class="flex-12 center">
                <paper-icon-button src="/skin/images/faction/TrollbloodsLogo.png" title="Trollbloods" class="link-out" data-src="/playtest/all-weapons.php?faction=Trollbloods"></paper-icon-button>
            </div>
        </paper-toolbar>
        <div class="horizontal layout">
            <div class="flex-1 cushion info-block">
                <?php if (!empty($_GET['faction'])): ?>
                    <ul class="attribute-list">
                        <?php foreach($weaponsList as $weapon):?>
                            <?php if (strpos($sortedUnitsList,$weapon['name']) !== false): ?>
                                <li class="display-item">
                                    <strong><?php echo $weapon['name']; ?></strong>
                                    <div class="indent"><?php
                                        if ($weapon['ranged'] == true){echo '<strong>Ranged Weapon</strong><br />';}
                                        if ($weapon['shooting_distance']){echo '<strong>Range:</strong> '.$weapon['shooting_distance'].'<br />';}
                                        if ($weapon['rof']){echo '<strong>Rate of Fire:</strong> '.$weapon['rof'].'<br />';}
                                        if ($weapon['aoe']){echo '<strong>Aera of Effect:</strong> '.$weapon['aoe'].'<br />';}
                                        echo '<strong>POW:</strong> '.$weapon['pow'].'<br />';
                                        if ($weapon['reach'] == true){echo '<strong>Reach</strong><br />';}
                                        if ($weapon['damage_type']){echo '<strong>Damage Type:</strong> '.$weapon['damage_type'].'<br />';}
                                        if ($weapon['critical_effect']){echo '<strong>Critical Effect:</strong> '.$weapon['critical_effect'].'<br />';}
                                        if ($weapon['continuous_effect']){echo '<strong>Continuous Effect:</strong> '.$weapon['continuous_effect'].'<br />';}
                                        if ($weapon['open_fist'] == true){echo '<strong>Open Fist</strong><br />';}
                                        if ($weapon['magical'] == true){echo '<strong>Magical Attacks</strong><br />';}
                                        if ($weapon['special_action_1']){echo '<strong>Special Action:</strong> '.$weapon['special_action_1'].'<br />';}
                                        if ($weapon['special_action_2']){echo '<strong>Special Action Two:</strong> '.$weapon['special_action_2'].'<br />';}
                                        if ($weapon['weapons_master'] == true){echo '<strong>Weapons Master</strong><br />';};
                                        if ($weapon['thrown'] == true){echo '<strong>Thrown Weapon</strong><br />';};  ?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <ul class="attribute-list">
                        <?php foreach($weaponsList as $weapon):?>
                            <li class="display-item">
                                <strong><?php echo $weapon['name']; ?></strong>
                                <div class="indent"><?php
                                    if ($weapon['ranged'] == true){echo '<strong>Ranged Weapon</strong><br />';}
                                    if ($weapon['shooting_distance']){echo '<strong>Range:</strong> '.$weapon['shooting_distance'].'<br />';}
                                    if ($weapon['rof']){echo '<strong>Rate of Fire:</strong> '.$weapon['rof'].'<br />';}
                                    if ($weapon['aoe']){echo '<strong>Aera of Effect:</strong> '.$weapon['aoe'].'<br />';}
                                    echo '<strong>POW:</strong> '.$weapon['pow'].'<br />';
                                    if ($weapon['reach'] == true){echo '<strong>Reach</strong><br />';}
                                    if ($weapon['damage_type']){echo '<strong>Damage Type:</strong> '.$weapon['damage_type'].'<br />';}
                                    if ($weapon['critical_effect']){echo '<strong>Critical Effect:</strong> '.$weapon['critical_effect'].'<br />';}
                                    if ($weapon['continuous_effect']){echo '<strong>Continuous Effect:</strong> '.$weapon['continuous_effect'].'<br />';}
                                    if ($weapon['open_fist'] == true){echo '<strong>Open Fist</strong><br />';}
                                    if ($weapon['magical'] == true){echo '<strong>Magical Attacks</strong><br />';}
                                    if ($weapon['special_action_1']){echo '<strong>Special Action:</strong> '.$weapon['special_action_1'].'<br />';}
                                    if ($weapon['special_action_2']){echo '<strong>Special Action Two:</strong> '.$weapon['special_action_2'].'<br />';}
                                    if ($weapon['weapons_master'] == true){echo '<strong>Weapons Master</strong><br />';};
                                    if ($weapon['thrown'] == true){echo '<strong>Thrown Weapon</strong><br />';};  ?>
                                </div>
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