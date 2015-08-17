<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/AnimusKnown.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $range = $_POST['range'];
    $aoe = $_POST['aoe'];
    $pow = $_POST['pow'];
    $upkeep = $_POST['upkeep'];
    $offensive = $_POST['offensive'];
    $specialAbility1 = $_POST['special-ability-1'];
    $specialAbility2 = $_POST['special-ability-2'];
    $offSpdMod = $_POST['off-spd-mod'];
    $offStrMod = $_POST['off-str-mod'];
    $offMatMod = $_POST['off-mat-mod'];
    $offRatMod = $_POST['off-rat-mod'];
    $offDefMod = $_POST['off-def-mod'];
    $offArmMod = $_POST['off-arm-mod'];
    $duration = $_POST['duration'];  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Updated Animus - RoHo.in Admin Panel</title>
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
            <paper-fab mini icon="arrow-back" class="nav-back link-out primary-focus" data-src="/admin/builder.php"></paper-fab>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Updated Animus <?php echo $name ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <?php $obj = new AllAnimusKnown;
                    $obj->updateAnimus($name, $description, $cost, $range, $aoe, $pow, $upkeep, $offensive, $specialAbility1, $specialAbility2, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $duration); ?>
                    Thank you, <?php echo $name ?> has been updated.
                    <ul><?php
                        if ($name){echo '<li>Name: '.$name.'</li>';}
                        if ($description){echo '<li>Description: '.$description.'</li>';}
                        if ($cost){echo '<li>Cost: '.$cost.'</li>';}
                        if ($range){echo '<li>Range: '.$range.'</li>';}
                        if ($aoe){echo '<li>Area of Effect: '.$aoe.'</li>';}
                        if ($pow){echo '<li>POW: '.$pow.'</li>';}
                        echo '<li>Upkeep: '; if ($upkeep == true){echo 'Yes';} else{echo 'No';}; echo '</li>';
                        echo '<li>Offensive: '; if ($offensive == true){echo 'Yes';} else{echo 'No';}; echo '</li>';
                        if ($specialAbility1){echo '<li>Special Ability / Action: '.$specialAbility1.'</li>';}
                        if ($specialAbility2){echo '<li>Second Special Ability / Action: '.$specialAbility2.'</li>';}
                        if ($offSpdMod){echo '<li>Speed Modifier: '.$offSpdMod.'</li>';}
                        if ($offStrMod){echo '<li>Strength Modifier: '.$offStrMod.'</li>';}
                        if ($offMatMod){echo '<li>Melee Attack Modifier: '.$offMatMod.'</li>';}
                        if ($offRatMod){echo '<li>Ranged Attack Modifier: '.$offRatMod.'</li>';}
                        if ($offDefMod){echo '<li>Defense Modifier: '.$offDefMod.'</li>';}
                        if ($offArmMod){echo '<li>Armor Modifier: '.$offArmMod.'</li>';}
                        if ($duration){echo '<li>Animus Duration: '.$duration.'</li>';} ?>
                    </ul>
                </paper-material>
                <div class="center">
                    <paper-button class="md-raised md-primary md-mid link-out" data-src="/admin/builder/animus.php">Back to Animus Menu</paper-button>
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
        $('.faction-select-toolbar .animus').addClass('active');
    });
</script>
</body>
</html>
