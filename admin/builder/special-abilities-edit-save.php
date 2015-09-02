<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/SpecialAbilities.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $immunity = $_POST['immunity'];
    $damageType = $_POST['damage-type'];
    $continuousEffect = $_POST['continuous-effect'];
    $offSpdMod = $_POST['off-spd-mod'];
    $offStrMod = $_POST['off-str-mod'];
    $offMatMod = $_POST['off-mat-mod'];
    $offRatMod = $_POST['off-rat-mod'];
    $offDefMod = $_POST['off-def-mod'];
    $offArmMod = $_POST['off-arm-mod'];
    $weaponRangeMod = $_POST['weapon-range-mod'];  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Updated Special Ability / Action - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
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
                <h1 class="full-page-title">Updated Ability / Action <?php echo $name ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <?php $obj = new AllSpecialAbilities;
                    $obj->updateSpecialAbility($name, $description, $immunity, $damageType, $continuousEffect, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $weaponRangeMod); ?>
                    Thank you, <?php echo $name ?> has been updated.
                    <ul><?php
                        if ($name){echo '<li>Name: '.$name.'</li>';}
                        if ($description){echo '<li>Description: '.$description.'</li>';}
                        if ($immunity){echo '<li>Immunity Type: '.$immunity.'</li>';}
                        if ($damageType){echo '<li>Damage Type: '.$damageType.'</li>';}
                        if ($continuousEffect){echo '<li>Continuous Effect: '.$continuousEffect.'</li>';}
                        if ($offSpdMod){echo '<li>Offensive Speed Modifier: '.$offSpdMod.'</li>';}
                        if ($offStrMod){echo '<li>Offensive Strength Modifier: '.$offStrMod.'</li>';}
                        if ($offMatMod){echo '<li>Offensive Melee Attack Modifier: '.$offMatMod.'</li>';}
                        if ($offRatMod){echo '<li>Offensive Ranged Attack Modifier: '.$offRatMod.'</li>';}
                        if ($offDefMod){echo '<li>Offensive Defense Modifier: '.$offDefMod.'</li>';}
                        if ($offArmMod){echo '<li>Offensive Armor Modifier: '.$offArmMod.'</li>';}
                        if ($weaponRangeMod){echo '<li>Weapon Range Modifier: '.$weaponRangeMod.'</li>';} ?>
                    </ul>
                </paper-material>
                <div class="center">
                    <paper-button class="md-raised md-primary md-mid link-out" data-src="/admin/builder/special-abilities.php">Back to  Ability / Action Menu</paper-button>
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
            <?php include '../../login/index.php'; ?>
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
<script>
    $(document).ready(function(){
        $('.faction-select-toolbar .abilities').addClass('active');
    });
</script>
</body>
</html>
