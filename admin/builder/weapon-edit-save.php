<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/Weapons.php';

    $name = $_POST['name'];
    $ranged = $_POST['ranged'];
    $range = $_POST['range'];
    $rof = $_POST['rof'];
    $aoe = $_POST['aoe'];
    $pow = $_POST['pow'];
    $reach = $_POST['reach'];
    $damageType = $_POST['damage-type'];
    $criticalEffect = $_POST['critical-effect'];
    $continuousEffect = $_POST['continuous-effect'];
    $openFist = $_POST['open-fist'];
    $magical = $_POST['magical'];
    $specialAction1 = $_POST['special-ability-1'];
    $specialAction2 = $_POST['special-ability-2'];
    $specialAction3 = $_POST['special-ability-3'];
    $specialAction4 = $_POST['special-ability-4'];
    $weaponsMaster = $_POST['weapons-master'];
    $thrown = $_POST['thrown'];
    $buckler = $_POST['buckler'];
    $shield = $_POST['shield'];  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Updated New Weapon - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Updated Weapon <?php echo $name ?>></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <?php $obj = new AllWeapons;
                    $obj->updateWeapon($name, $ranged, $range, $rof, $aoe, $pow, $reach, $damageType, $criticalEffect, $continuousEffect, $openFist, $magical, $specialAction1, $specialAction2, $specialAction3, $specialAction4, $weaponsMaster, $thrown, $buckler, $shield); ?>
                    Thank you, <?php echo $name ?> has been updated.
                    <ul><?php
                        if ($name){echo '<li>Name: '.$name.'</li>';}
                        if ($ranged){echo '<li>Ranged: '.$ranged.'</li>';}
                        if ($range){echo '<li>Range: '.$range.'</li>';}
                        if ($rof){echo '<li>Rate of Fire: '.$rof.'</li>';}
                        if ($aoe){echo '<li>Area of Effect: '.$aoe.'</li>';}
                        if ($pow){echo '<li>POW: '.$pow.'</li>';}
                        if ($damageType){echo '<li>Damage Type: '.$damageType.'</li>';}
                        if ($criticalEffect){echo '<li>Critical Effect: '.$criticalEffect.'</li>';}
                        if ($continuousEffect){echo '<li>Continuous Effect: '.$continuousEffect.'</li>';}
                        if ($specialAction1){echo '<li>Special Action 1: '.$specialAction1.'</li>';}
                        if ($specialAction2){echo '<li>Special Action 2: '.$specialAction2.'</li>';}
                        if ($specialAction3){echo '<li>Special Action 3: '.$specialAction3.'</li>';}
                        if ($specialAction4){echo '<li>Special Action 4: '.$specialAction4.'</li>';}
                        if ($reach){echo '<li>Reach: '.$reach.'</li>';}
                        if ($openFist){echo '<li>Open Fist: '.$openFist.'</li>';}
                        if ($magical){echo '<li>Magical: '.$magical.'</li>';}
                        if ($weaponsMaster){echo '<li>Weapons Master: '.$weaponsMaster.'</li>';}
                        if ($thrown){echo '<li>Thrown Weapon: '.$thrown.'</li>';}
                        if ($buckler){echo '<li>Buckler: '.$buckler.'</li>';}
                        if ($shield){echo '<li>Shield: '.$shield.'</li>';} ?>
                    </ul>
                </paper-material>
                <div class="center">
                    <paper-button class="md-raised md-primary md-mid link-out" data-src="/admin/builder/weapon.php">Back to Weapons Menu</paper-button>
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
        $('.faction-select-toolbar .weapon').addClass('active');
    });
</script>
</body>
</html>
