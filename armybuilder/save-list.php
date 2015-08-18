<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';
    include '../core/ArmyBuilder.php';
    include '../core/Core.php';
    include '../core/Unit.php';
    $armyBuilder = new ArmyBuilder();
    $allUnits = new AllUnits(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>New Army List Created at RoHo.In</title>
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
            <h1 class="full-page-title">New Army List Created</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <div class="info-block">
            <?php // get all passed variables

            // this is for the first battle group - duplicate for the next 3
            $warcaster1 = $_POST['warcaster1']; // save to db field 'warcaster_1' as warcaster's name
            $tier1 = '';
            $i = 1;
            $battlegroup1 = array();
            while ($i < 26) { // checks for 25 different models in the battle group - save by model [id,qty][id,qty] battlegroup models will always be qty 1 save to db field 'battle_group_1
                if (isset($_POST['battlegroup-1-'.$i])) {
                    $battlegroup1[$i] = $_POST['battlegroup-1-'.$i];
                    $battlegroup1modelID = explode('|', $battlegroup1[$i]);
                    $battlegroup1Ids[$i]['id'] = $allUnits->getUnitIdByName($battlegroup1modelID[0]);
                    $battlegroup1Ids[$i]['qty'] = $battlegroup1modelID[1];
                }
                $i++;
            }

            // this is for the second battle group
            $warcaster2 = $_POST['warcaster2']; // save to db field 'warcaster_2' as warcaster's name
            $tier2 = '';
            $i = 1;
            $battlegroup2 = array();
            while ($i < 26) { // checks for 25 different models in the battle group - save by model [id,qty][id,qty] battlegroup models will always be qty 1 save to db field 'battle_group_1
                if (isset($_POST['battlegroup-2-'.$i])) {
                    $battlegroup2[$i] = $_POST['battlegroup-2-'.$i];
                    $battlegroup2modelID = explode('|', $battlegroup2[$i]);
                    $battlegroup2Ids[$i]['id'] = $allUnits->getUnitIdByName($battlegroup2modelID[0]);
                    $battlegroup2Ids[$i]['qty'] = $battlegroup2modelID[1];
                }
                $i++;
            }

            // this is for the third battle group
            $warcaster3 = $_POST['warcaster3']; // save to db field 'warcaster_3' as warcaster's name
            $tier3 = '';
            $i = 1;
            $battlegroup3 = array();
            while ($i < 26) { // checks for 25 different models in the battle group - save by model [id,qty][id,qty] battlegroup models will always be qty 1 save to db field 'battle_group_1
                if (isset($_POST['battlegroup-3-'.$i])) {
                    $battlegroup3[$i] = $_POST['battlegroup-3-'.$i];
                    $battlegroup3modelID = explode('|', $battlegroup3[$i]);
                    $battlegroup3Ids[$i]['id'] = $allUnits->getUnitIdByName($battlegroup3modelID[0]);
                    $battlegroup3Ids[$i]['qty'] = $battlegroup3modelID[1];
                }
                $i++;
            }

            // this is for the fourth battle group
            $warcaster4 = $_POST['warcaster4']; // save to db field 'warcaster_4' as warcaster's name
            $tier4 = '';
            $i = 1;
            $battlegroup4 = array();
            while ($i < 26) { // checks for 25 different models in the battle group - save by model [id,qty][id,qty] battlegroup models will always be qty 1 save to db field 'battle_group_1
                if (isset($_POST['battlegroup-4-'.$i])) {
                    $battlegroup4[$i] = $_POST['battlegroup-4-'.$i];
                    $battlegroup4modelID = explode('|', $battlegroup4[$i]);
                    $battlegroup4Ids[$i]['id'] = $allUnits->getUnitIdByName($battlegroup4modelID[0]);
                    $battlegroup4Ids[$i]['qty'] = $battlegroup4modelID[1];
                }
                $i++;
            }

            // will try to grab solos - save by model [id,qty] save to db field 'solos'
            $i = 1;
            $solos = array();
            while ($i < 51) {
                if (isset($_POST['solo-'.$i])) {
                    $solos[$i] = $_POST['solo-'.$i];
                    $soloModelID = explode('|', $solos[$i]);
                    $soloModelIds[$i]['id'] = $allUnits->getUnitIdByName($soloModelID[0]);
                    $soloModelIds[$i]['qty'] = $soloModelID[1];
                }
                $i++;
            }

            // will try to grab units - save by model [id,qty] save to db field 'units'
            $i = 1;
            $units = array();
            while ($i < 51) {
                if (isset($_POST['unit-'.$i])) {
                    $units[$i] = $_POST['unit-'.$i];
                    $unitModelID = explode('|', $units[$i]);
                    $unitModelIds[$i]['id'] = $allUnits->getUnitIdByName($unitModelID[0]);
                    $unitModelIds[$i]['qty'] = $unitModelID[1];
                }
                $i++;
            }

            // will try to grab battle engines - save by model [id,qty] save to db field 'battle_engines
            $i = 1;
            $battleEngines = array();
            while ($i < 51) {
                if (isset($_POST['battle-engine-'.$i])) {
                    $battleEngines[$i] = $_POST['battle-engine-'.$i];
                    $battleEngineID = explode('|', $battleEngines[$i]);
                    $battleEngineIds[$i]['id'] = $allUnits->getUnitIdByName($battleEngineID[0]);
                    $battleEngineIds[$i]['qty'] = $battleEngineID[1];
                }
                $i++;
            }

            // will try to grab battle engines - save by model [id,qty] save to db field 'battle_engines
            $i = 1;
            $ua = array();
            while ($i < 51) {
                if (isset($_POST['unit-attachment-'.$i])) {
                    $uaIds[$i] = $_POST['unit-attachment-'.$i];
                }
                $i++;
            }


            $actualPoints = $_POST['actual_points']; // db field 'actual_points'
            $points = $_POST['points']; // db field 'points'
            $armyName = $_POST['army-name']; // db field 'name'
            $armyFaction = $_POST['faction']; // db field 'faction'
            $mercSolo = ''; // db field 'merc_solo'
            $mercUnits = ''; // db field 'merc_units'
            $user = $_SESSION['user_id']; // db field 'created_by'
            $public = $_POST['public']; // bool 1=yes 0=no - saves to db field 'public'

            $notes = $_POST['notes'];// notes saves to db field 'notes'
            ?>

<?php /* -- redo display of items to work better in the future.
            Warcaster = <?php echo $warcaster1; ?><br />
            <?php foreach($battlegroup1 as $bg1): ?>
                Battle Group Member: <?php echo $armyBuilder->splitNameQtyForUnit($bg1)[0]; ?>, <?php echo $armyBuilder->splitNameQtyForUnit($bg1)[1]; ?><br />
            <?php endforeach ?>
            <?php foreach($units as $unit): ?>
                Unit: <?php echo $armyBuilder->splitNameQtyForUnit($unit)[0]; ?>, <?php echo $armyBuilder->splitNameQtyForUnit($unit)[1]; ?><br />
            <?php endforeach ?>
            <?php foreach($solos as $solo): ?>
                Solo: <?php echo $armyBuilder->splitNameQtyForUnit($solo)[0]; ?>, <?php echo $armyBuilder->splitNameQtyForUnit($solo)[1]; ?><br />
            <?php endforeach ?>
            <?php foreach($battleEngines as $battleEngine): ?>
                Battle Engine: <?php echo $armyBuilder->splitNameQtyForUnit($battleEngine)[0]; ?>, <?php echo $armyBuilder->splitNameQtyForUnit($battleEngine)[1]; ?><br />
            <?php endforeach ?>
            Points = <?php echo $points ?><br />
            Actual Points = <?php echo $actualPoints ?><br />
            Faction = <?php echo $armyFaction ?><br />
            Army Name = <?php echo $armyName ?><br />
            Public = <?php echo $public ?><br /><br /> */?>


            <?php // save the list and add in an error / success message ?>
            <?php // update units to ID values and not names
            $battlegroup1Sql ='';
            foreach ($battlegroup1Ids as $item){
                $battlegroup1Sql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $battlegroup2Sql ='';
            foreach ($battlegroup2Ids as $item){
                $battlegroup2Sql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $battlegroup3Sql ='';
            foreach ($battlegroup3Ids as $item){
                $battlegroup3Sql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $battlegroup4Sql ='';
            foreach ($battlegroup4Ids as $item){
                $battlegroup4Sql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $unitsSql ='';
            foreach ($unitModelIds as $item){
                $unitsSql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $solosSql ='';
            foreach ($soloModelIds as $item){
                $solosSql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $battleEnginesSql ='';
            foreach ($battleEngineIds as $item){
                $battleEnginesSql .= '['.$item['id'].', '.$item['qty'].']';
            }
            $uaSql = '';
            foreach ($uaIds as $item){
                $uaSql .= '['.$item.']';
            }

            $saveArray = $armyName.','.$armyFaction.','.$points.','.$actualPoints.','.$warcaster1.','.$tier1.','.$battlegroup1Sql.','.$warcaster2.','.$tier2.','.$battlegroup2Sql.','.$warcaster3.','.$tier3.','.$battlegroup3Sql.','.$warcaster4.','.$tier4.','.$battlegroup4Sql.','.$unitsSql.','.$solosSql.','.$battleEnginesSql.','.$uaSql.','.$mercSolo.','.$mercUnits.','.$user.','.$public.','.$notes;

            $saveListId = '';//$armyBuilder->createNewArmyList($saveArray);

            ?>

            <paper-material elevation="1" class="cushion center">
                <?php echo $saveArray; ?>
                <p>$armyName, $armyFaction, $points, $actualPoints, $warcaster1, $tier1, $battlegroup1Sql, $warcaster2, $tier2, $battlegroup2Sql</p>
                <p>$warcaster3, $tier3, $battlegroup3Sql, $warcaster4, $tier4, $battlegroup4Sql, $unitsSql, $solosSql, $battleEnginesSql, $uaSql</p>
                <p>$mercSolo, $mercUnits, $user, $public, $notes</p>
                <?php if ($_SESSION['user_name'] != ''): ?>
                    <p>Thank you for creating this army list. <a href="http://roho.in/armybuilder/view-owned.php?id=<?php echo $saveListId ?>" title="Your New Army List">You can view it on your Army List page</a>.</p>
                <?php elseif ($public == 1): ?>
                    <p>Thank you for creating this public army list. <a href="http://roho.in/armybuilder/view-public.php?id=<?php echo $saveListId ?>" title="Public Army List">You can view and share it on our public army list page</a>.</p>
                <?php endif; ?>
            </paper-material>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>