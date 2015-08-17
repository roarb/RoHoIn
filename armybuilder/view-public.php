<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';
    include '../core/Core.php';
    include '../core/ArmyBuilder.php';
    $armyBuilder = new ArmyBuilder(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RoHo.in WarmaHordes Public Army Lists</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include '../login/index.php'; ?>
        <?php include '../nav/main-nav.php'; ?>
        <paper-fab mini icon="arrow-back" class="nav-back link-armybuilder-home primary-focus"></paper-fab>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title">All WarmaHordes Public Army Lists</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <div class="info-block">
            <?php $allPublicLists = $armyBuilder->getAllPublicArmyLists(); ?>
            <?php foreach ($allPublicLists as $list): ?>
                <div class="flex-2">
                    <paper-button raised class="full-width-button link-out" data-src="/armybuilder/view-army-list.php?id=<?php echo $list["id"] ?>">
                        <span class="list-faction"><?php echo $list['faction'] ?></span>
                        <span class="list-name"><?php echo $list['name'] ?></span> | <span class="list-points"><?php echo $list['points'] ?> pts.</span>
                    </paper-button>
                </div>
            <?php endforeach; ?>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>