<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/Faction.php';
    include '../../core/Unit.php';
    include '../../core/UnitType.php';
    $allUnits = new AllUnits;
    $unitsList = $allUnits->getAllUnitsName();
    $allUnitTypes = new AllUnitTypes;
    $unitTypesList = $allUnitTypes->getAllUnitTypes();
    $allFactions = new AllFactions;
    $factionsList = $allFactions->getAllFactions();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View all Unit / Models - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">View all Units &amp; Models</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="horizontal layout info-block-tools cushion">
                <paper-material elevation="1" class="cushion" style="margin:auto;">
                    <h3>Current Units &amp; Models:</h3>
                    <paper-material elevation="1"><?php $i = 0 ?>
                        <?php foreach ($factionsList as $faction): ?>
                            <h3><?php echo $faction['name']?></h3>
                            <div class="faction-container" id="faction<?php echo $i ?>">
                                Need to re add some content here - if needed.
                            </div>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </paper-material>
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
        $('.faction-select-toolbar .unit').addClass('active');
    });
</script>
</body>
</html>
