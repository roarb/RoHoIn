<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php
    include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/tiered-list.php';
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tiered List Additions - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Tiered List <?php // get name hereecho $newType ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="horizontal layout info-block-tools cushion">
                <paper-material elevation="1" class="cushion" style="margin:auto;">
                    <?php
                    $name = $_POST['name'];
                    $faction = $_POST['faction'];
                    $caster = $_POST['caster'];
                    $description = $_POST['description'];
                    $reqBattlegroupFront = $_POST['req-battlegroup-front'];
                    $reqBattlegroupRules = $_POST['req-battlegroup-rules'];
                    $reqUnitsFront = $_POST['req-units-front'];
                    $reqUnitsRules = $_POST['req-units-rules'];
                    $reqSolosFront = $_POST['req-solos-front'];
                    $reqSolosRules = $_POST['req-solos-rules'];
                    $reqBattleengineFront = $_POST['req-battleengine-front'];
                    $reqBattleengineRules = $_POST['req-battleengine-rules'];
                    $tier1BonusFront = $_POST['tier-1-bonus-front'];
                    $tier1Bonus = $_POST['tier-1-bonus'];
                    $tier1ReqFront = $_POST['tier-1-req-front'];
                    $tier1Req = $_POST['tier-1-req'];
                    $tier2BonusFront = $_POST['tier-2-bonus-front'];
                    $tier2Bonus = $_POST['tier-2-bonus'];
                    $tier2ReqFront = $_POST['tier-2-req-front'];
                    $tier2Req = $_POST['tier-2-req'];
                    $tier3BonusFront = $_POST['tier-3-bonus-front'];
                    $tier3Bonus = $_POST['tier-3-bonus'];
                    $tier3ReqFront = $_POST['tier-3-req-front'];
                    $tier3Req = $_POST['tier-3-req'];
                    $tier4BonusFront = $_POST['tier-4-bonus-front'];
                    $tier4Bonus = $_POST['tier-4-bonus'];
                    $tier4ReqFront = $_POST['tier-4-req-front'];
                    $tier4Req = $_POST['tier-4-req'];


                    $obj = new AllTieredLists;
                    $obj->saveTieredLists($name, $faction, $caster, $description, $reqBattlegroupFront, $reqBattlegroupRules, $reqUnitsFront, $reqUnitsRules, $reqSolosFront, $reqSolosRules, $reqBattleengineFront, $reqBattleengineRules, $tier1BonusFront, $tier1Bonus, $tier1ReqFront, $tier1Req, $tier2BonusFront, $tier2Bonus, $tier2ReqFront,$tier2Req, $tier3BonusFront, $tier3Bonus, $tier3ReqFront,$tier3Req, $tier4BonusFront, $tier4Bonus, $tier4ReqFront, $tier4Req);

                    echo 'Thank you, '.$name.' has been added.';
                    echo $name.$faction.$caster.$description.$reqBattlegroupFront.$reqBattlegroupRules.$reqUnitsFront.$reqUnitsRules.$reqSolosFront.$reqSolosRules.$reqBattleengineFront.$reqBattleengineRules.$tier1BonusFront.$tier1Bonus.$tier1ReqFront.$tier1Req.$tier2BonusFront.$tier2Bonus.$tier2ReqFront.$tier2Req.$tier3BonusFront.$tier3Bonus.$tier3ReqFront.$tier3Req.$tier4BonusFront.$tier4Bonus.$tier4ReqFront.$tier4Req;

                    ?>
                    <p><a href="/admin/builder/tiered.php">Back to adding tiered lists</a></p>
                    <p><a href="/admin/builder.php">Back to Builder Land</a></p>
                </paper-material>
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
        $('.faction-select-toolbar .tier').addClass('active');
    });
</script>
</body>
</html>
