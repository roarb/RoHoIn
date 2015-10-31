<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';
    include '../core/Core.php';
    include '../core/ArmyBuilder.php';
    include '../core/Unit.php';
    include '../core/Barracks.php';
    $armyBuilder = new ArmyBuilder();
    $core = new AllCore();
    $allUnits = new AllUnits();
    $listId = $_GET['id'];
    $armyList = $armyBuilder->getListById($listId);
    $createdBy = $core->getUserNameById($armyList['created_by']); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php if ($armyList['name'] != '' ): echo $armyList['name']; ?>
            <?php if (isset($createdBy)){ echo ' - Created by '.$createdBy;} ?>
        <?php else:  ?>Army List Viewer
        <?php endif; ?>
    </title>
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
            <h1 class="full-page-title">
                <?php if ($armyList['name'] != '' ): echo $armyList['name']; ?>
                    <?php if (isset($createdBy)){ echo ' - Created by '.$createdBy;} ?>
                <?php else:  ?>Army List Viewer
                <?php endif; ?>
            </h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <div class="info-block">
            <?php if (isset($_GET['id'])): ?>
                <paper-material elevation="1" class="cushion army-list-wrapper" id="armylist-view">
                    <h2 class="center"><?php echo $armyList['name'] ?>, a <?php echo $armyList['points'] ?> point <?php echo $armyList['faction'] ?> List - created by <?php echo $createdBy ?></h2>
                    <?php $i = 1 ?>
                    <?php while ($i < 5): ?>
                        <?php if ($armyList['warcaster_'.$i] != ''): ?>
                            <paper-material elevation="1" class="battle-group-built">
                                <div class="units-title army-entry-select-title">Battle Group <?php echo $i ?></div>

                                <?php /* hide original warcaster block
                                <paper-material elevation="1" class="leader">
                                    <?php $leaderObject = $allUnits->getUnitByName($armyList['warcaster_'.$i]) ?>
                                    <span class="unit-name">
                                        <a href="/playtest/single-unit.php?name=<?php echo $leaderObject['name'] ?>"><?php echo $leaderObject['name'] ?></a>
                                    </span> - <?php echo $leaderObject['title'] ?>
                                </paper-material> */ ?>

                                <?php // start build from the battlegroup-build in the army builder section ?>
                                <div class="warcaster">
                                    <?php $warcaster = $allUnits->getWarcasterFullObjectByName($armyList['warcaster_'.$i]) ?>

                                    <div class="single-caster unit <?php echo $warcaster['id'].'-'.$i ?> model-id-<?php echo $warcaster['id'] ?>">
                                        <div class="focus-circle warcaster-portrait"><?php echo $allUnits->getUnitImageThumbnail($warcaster['name']) ?></div>
                                        <label for="<?php echo $warcaster['name'] ?>" class="warcaster<?php echo $i ?>">
                                            <span class="unit-name"><?php echo $warcaster['name'] ?></span><br />
                                            <span class="unit-title"><?php echo $warcaster['title'] ?></span><div class="bg-points">BG+<?php echo $warcaster['bg_points']?></div><br />
                                            <?php if ($loggedIn): ?>
                                                <div class="barracks-qty-wrapper">
                                                    <span class="owned-qty">Owned: <?php if (isset($warcaster['owned_models'])){echo $warcaster['owned_models'];} else {echo '0';} ?></span> -
                                                    <span class="painted-qty">Painted: <?php if (isset($warcaster['painted_models'])){echo $warcaster['painted_models'];} else {echo '0';} ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </label>
                                        <?php if (is_array($warcaster['tiers'])): ?>
                                            <div class="tier-options" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                                                <paper-icon-button icon="class" class="view-tiers"></paper-icon-button>
                                                <span class="mo-notice hidden">View Tier Lists</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">
                                            <paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>
                                            <span class="mo-notice hidden">View Stats</span>
                                        </div>
                                        <div class="clearer"></div>
                                        <?php // the remaining unit specs are hidden until the model item is clicked to display this info ?>
                                        <div class="additional-model-info" style="display:none;">
                                            <?php echo $allUnits->displayArmyBuilderStatsLine($warcaster) ?>
                                        </div>
                                    </div>
                                </div>
                                <?php // end build from the battlegroup-build in the army builder section ?>

                                <?php $armyItems = explode('[', $armyList['battle_group_'.$i]); ?>
                                <?php $modelObject = ''; ?>
                                <?php foreach ($armyItems as $model):
                                    if ($model != ''):
                                        $model = str_replace(']', '', $model);
                                        $model = str_replace(' ', '', $model);
                                        $singleModel = explode(',', $model);
                                        $modelObject = $allUnits->getUnitById($singleModel[0]);
                                        $modelObject = $modelObject[0]; ?>
                                        <?php //$modelObject ?>
                                        <paper-material elevation="1" class="child-model">
                                            <span class="unit-name">
                                                <a href="/playtest/single-unit.php?name=<?php echo $modelObject['name']; ?>"><?php echo $modelObject['name']; ?></a>
                                            </span> - <?php echo $modelObject['title'] ?> | <span class="points"><?php echo $modelObject['cost'] ?> pts.</span>
                                        </paper-material>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </paper-material>
                        <?php endif; ?>
                        <?php $i++ ?>
                    <?php endwhile; ?>
                    <?php if ($armyList['units'] != ''): ?>
                        <paper-material elevation="1" class="units-built">
                            <div class="units-title army-entry-select-title">Units</div>
                            <?php $armyItems = explode('[', $armyList['units']); ?>
                            <?php $modelObject = ''; ?>
                            <?php foreach ($armyItems as $model):
                                if ($model != ''):
                                    $model = str_replace(']', '', $model);
                                    $model = str_replace(' ', '', $model);
                                    $singleModel = explode(',', $model);
                                    $modelObject = $allUnits->getUnitById($singleModel[0]);
                                    $modelObject = $modelObject[0]; ?>
                                    <?php //$modelObject ?>
                                    <paper-material elevation="1" class="unit-model">
                                        <span class="unit-name"><?php echo $modelObject['name']; ?></span> - <?php echo $modelObject['title'] ?> | <span class="points"><?php echo $modelObject['cost'] ?> pts.</span>
                                        <?php if ($singleModel[1] > 1): ?>
                                            <span class="unit-model-qty"><?php echo $singleModel[1] ?> Grunts</span>
                                        <?php endif; ?>
                                    </paper-material>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </paper-material>
                    <?php endif; ?>
                    <?php if ($armyList['solos'] != ''):?>
                        <paper-material elevation="1" class="solos-built">
                            <div class="units-title army-entry-select-title">Solos</div>
                            <?php $armyItems = explode('[', $armyList['solos']); ?>
                            <?php $modelObject = ''; ?>
                            <?php foreach ($armyItems as $model):
                                if ($model != ''):
                                    $model = str_replace(']', '', $model);
                                    $model = str_replace(' ', '', $model);
                                    $singleModel = explode(',', $model);
                                    $modelObject = $allUnits->getUnitById($singleModel[0]);
                                    $modelObject = $modelObject[0]; ?>
                                    <?php //$modelObject ?>
                                    <paper-material elevation="1" class="unit-model">
                                        <span class="unit-name"><?php echo $modelObject['name']; ?></span> - <?php echo $modelObject['title'] ?> | <span class="points"><?php echo $modelObject['cost'] ?> pts.</span>
                                        <?php if ($singleModel[1] > 1): ?>
                                            <span class="unit-model-qty"><?php echo $singleModel[1] ?> Models</span>
                                        <?php endif; ?>
                                    </paper-material>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </paper-material>
                    <?php endif; ?>
                    <?php if ($armyList['battle_engines'] != ''): ?>
                        <paper-material elevation="1" class="battle-engines-built">
                            <div class="units-title army-entry-select-title">Battle Engines</div>
                            <?php $armyItems = explode('[', $armyList['battle_engines']); ?>
                            <?php $modelObject = ''; ?>
                            <?php foreach ($armyItems as $model):
                                if ($model != ''):
                                    $model = str_replace(']', '', $model);
                                    $model = str_replace(' ', '', $model);
                                    $singleModel = explode(',', $model);
                                    $modelObject = $allUnits->getUnitById($singleModel[0]);
                                    $modelObject = $modelObject[0]; ?>
                                    <?php //$modelObject ?>
                                    <paper-material elevation="1" clas="unit-model">
                                        <span class="unit-name"><?php echo $modelObject['name']; ?></span> - <?php echo $modelObject['title'] ?> | <span class="points"><?php echo $modelObject['cost'] ?> pts.</span>
                                        <?php if ($singleModel[1] > 1): ?>
                                            <span class="unit-model-qty"><?php echo $singleModel[1] ?> Models</span>
                                        <?php endif; ?>
                                    </paper-material>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </paper-material>
                    <?php endif; ?>
                </paper-material>
                <paper-fab mini icon="arrow-back" class="fixed-fab link-out" data-src="/armybuilder/index.php"></paper-fab>
                <?php // load error screen for a page called without id= ?>
            <?php else: ?>
                <paper-material elevation="1" class="cushion">
                    <p>Sorry, looks like this page loaded without a proper army list selection.<br /><br />
                    Please choose a list from the <a href="http://roho.in/armybuilder/view-public.php" title="Public Army Lists">Public Army Lists</a>.<br /><br />
                    If you have an account you can <a href="http://roho.in/armybuilder/view-owned.php" title="View Your Army Lists">View Your Army Lists</a>.</p>
                </paper-material>
            <?php endif; ?>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>