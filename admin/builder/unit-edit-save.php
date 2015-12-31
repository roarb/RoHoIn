<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    $core = new AllCore();

    $faction = $_POST['faction'];
    $relatedFaction = $_POST['related-faction'];
    $relatedFactionNew = '';
    foreach ($relatedFaction as $factionTemp){
        $relatedFactionNew .= $factionTemp.'-';
    }
    if ($relatedFactionNew == '-'){$relatedFactionNew = '';}
    $unitType = $_POST['unit-type'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $bgPoints = $_POST['bg-points'];
    $fieldAllowance = $_POST['field-allowance'];
    $purchaseLow = $_POST['purchase-low'];
    $purchaseHigh = $_POST['purchase-high'];
    $focus = $_POST['focus'];
    $fury = $_POST['fury'];
    $threshold = $_POST['threshold'];
    $spd = $_POST['spd'];
    $str = $_POST['str'];
    $mat = $_POST['mat'];
    $rat = $_POST['rat'];
    $def = $_POST['def'];
    $arm = $_POST['arm'];
    $cmd = $_POST['cmd'];
    $damageBoxes = $_POST['damage-boxes'];
    $damageGrid = $_POST['damage-grid'];
    $damageSpiral = $_POST['damage-spiral'];
    $animusKnown = $_POST['animus-known'];
    $mount = $_POST['mount'];
    $mountAbility = $_POST['mount-ability'];
    $mountAbility2 = $_POST['mount-ability-2'];
    $baseSize = $_POST['base-size'];
    $weapon1 = $_POST['weapon1'];
    $weapon2 = $_POST['weapon2'];
    $weapon3 = $_POST['weapon3'];
    $weapon4 = $_POST['weapon4'];
    $weapon5 = $_POST['weapon5'];
    $specialAbility1 = $_POST['special-ability1'];
    $specialAbility2 = $_POST['special-ability2'];
    $specialAbility3 = $_POST['special-ability3'];
    $specialAbility4 = $_POST['special-ability4'];
    $specialAbility5 = $_POST['special-ability5'];
    $specialAbility6 = $_POST['special-ability6'];
    $specialAbility7 = $_POST['special-ability7'];
    $specialAbility8 = $_POST['special-ability8'];
    $specialAbility9 = $_POST['special-ability9'];
    $specialAbility10 = $_POST['special-ability10'];
    $spell1 = $_POST['spell1'];
    $spell2 = $_POST['spell2'];
    $spell3 = $_POST['spell3'];
    $spell4 = $_POST['spell4'];
    $spell5 = $_POST['spell5'];
    $spell6 = $_POST['spell6'];
    $spell7 = $_POST['spell7'];
    $spell8 = $_POST['spell8'];
    $spell9 = $_POST['spell9'];
    $spell10 = $_POST['spell10'];
    $feat = $_POST['feat'];
    $attachedTo = $_POST['attached-to'];
    $companion = $_POST['companion'];
    $leader = $_POST['leader']; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Updated Unit - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($core->getAdmin()): ?>
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
                <h1 class="full-page-title">Saved New Unit / Model</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <?php
                    $obj = new AllUnits;
                    $obj->updateUnits($name, $faction, $relatedFactionNew, $unitType, $title, $cost, $bgPoints, $fieldAllowance, $purchaseLow, $purchaseHigh, $focus, $fury, $threshold, $spd, $str, $mat, $rat, $def, $arm, $cmd, $damageBoxes, $damageGrid, $damageSpiral, $animusKnown, $mount, $mountAbility, $mountAbility2, $baseSize, $weapon1, $weapon2, $weapon3, $weapon4, $weapon5, $specialAbility1, $specialAbility2, $specialAbility3, $specialAbility4, $specialAbility5, $specialAbility6, $specialAbility7, $specialAbility8, $specialAbility9, $specialAbility10, $spell1, $spell2, $spell3, $spell4, $spell5, $spell6, $spell7, $spell8, $spell9, $spell10, $feat, $attachedTo, $companion, $leader);
                    ?><br />
                    Thank you, <?php echo $name ?> has been updated.
                </paper-material>
                <div class="center">
                    <paper-button class="md-raised md-primary md-mid link-out" data-src="/admin/builder/unit.php">Back to Units Menu</paper-button>
                    <paper-button class="md-raised md-primary md-mid link-out" data-src="/playtest/single-unit.php?name=<?php echo $name ?>">View <?php echo $name ?></paper-button>
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
        $('.faction-select-toolbar .unit').addClass('active');
    });
</script>
</body>
</html>
