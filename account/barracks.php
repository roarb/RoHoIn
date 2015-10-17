<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';
    include '../core/Core.php';
    include '../core/Faction.php';
    include '../core/Barracks.php';
    include '../core/Unit.php';
    $barracks = new Barracks;
    $allFactions = new AllFactions; ?>
    <script src="/skin/jsgrid/src/jsgrid.core.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.load-indicator.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.load-strategies.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.sort-strategies.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.field.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.field.text.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.field.number.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.field.select.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.field.checkbox.js"></script>
    <script src="/skin/jsgrid/src/jsgrid.field.control.js"></script>
    <link rel="stylesheet" type="text/css" href="/skin/jsgrid/css/jsgrid.css" />
    <link rel="stylesheet" type="text/css" href="/skin/jsgrid/css/theme.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Your RoHo.in Barracks</title>
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
            <h1 class="full-page-title">Your RoHo.in Barracks</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <?php /*if (isset($_SESSION['user_name'])): ?>
            <?php $models = $barracks->getAllUserModels($_SESSION['user_id']) ?>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php // get all faction and cross reference with the factions returned for this users $models ?>
                <?php $factions = $allFactions->getAllFactions(); $i = 0; ?>
                <?php foreach ($factions as $faction): ?>
                    <div class="flex-12 center">
                        <?php $factionName = str_replace(' ', '', $faction['name']) ?>
                        <paper-icon-button src="/skin/images/faction/<?php echo $factionName ?>.png" title="<?php echo $faction['name'] ?>"></paper-icon-button>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </paper-toolbar>
        <?php endif;*/ ?>
        <div class="info-block cushion" style="overflow:scroll; padding-bottom:15px;">
            <?php if (isset($_SESSION['user_name'])): ?>
                <?php $models = $barracks->getAllUserModels($_SESSION['user_id']) ?>
                <?php $factions = $allFactions->getAllFactions() ?>
                <paper-material elevation="1" class="cushion">
                    <paper-material elevation="1" class="barracks cushion">
                        <p class="large">Welcome <?php echo $_SESSION['user_name'] ?>, this is your Barracks dashboard.</p>
                        <?php $ownedCount = $barracks->getTotalOwnedByUser($models) ?>
                        <?php $paintedCount = $barracks->getTotalPaintedByUser($models) ?>
                        <p>From here you'll be able to view all the models you currently own, and see which of those are painted.
                            <?php if ($ownedCount >= $paintedCount): ?>
                                Currently you have <strong><?php echo number_format($paintedCount/$ownedCount * 100, 0); ?>%</strong> of your Barracks painted.
                            <?php endif; ?></p>
                        <?php if (isset($models)): ?>
                            <p>Below you'll see all of your models in your barracks. The toolbar on top will allow you narrow your barracks to select Factions.</p>
                        <?php endif; ?>
                    </paper-material>
                    <div id="jsGrid"></div>

                    <script>
                        (function() {

                            var db = {

                                loadData: function(filter) {
                                    console.log(filter);
                                    return $.grep(this.models, function(model) {
                                        return (!filter.name || model.name.indexOf(filter.name) > -1)
                                            && (!filter.faction_id || model.faction_id === filter.faction_id)
                                            //&& (!filter.Country || client.Country === filter.Country)
                                            && (!filter.owned_qty || model.owned_qty === filter.owned_qty)
                                            && (!filter.painted_qty || model.painted_qty === filter.painted_qty);
                                    });
                                }

                            };

                            window.db = db;

                            var factionsDb = <?php echo json_encode($factions) ?>;
                            db.factions = $.merge([ { name: "", id: "" } ], factionsDb);

                            db.models = <?php echo json_encode($models) ?>;

                        }());
                        //console.log(<?php echo json_encode($factions) ?>);
                        //console.log(db);
                        $(function() {

                            $("#jsGrid").jsGrid({
                                height: "90%",
                                width: "100%",

                                filtering: true,
                                editing: false,
                                sorting: true,
                                paging: true,
                                autoload: true,

                                pageSize: 15,
                                pageButtonCount: 5,

                                controller: db,

                                fields: [
                                    { title: "Name", name: "unit_name", type: "text", width: 150, link: "model_link" }, // need to make the line clickable - src to the single model viewer
                                    { title: "Owned", name: "owned_qty", type: "text", width: 50 },
                                    { title: "Painted", name: "painted_qty", type: "text", width:50 },
                                    { title: "Faction", name: "faction_id", type: "select", items: db.factions, valueField: "id", textField: "name" }//,
                                    //{ type: "control" } // default jsGrid is control to show the edit/delete options - look to building a custom edit if the list is owner is viewing
                                ]
                            });

                        });
                    </script>


                    <hr />
                    <?php /*<table class="barracks-entries">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Owned</th>
                            <th>Painted</th>
                            <th>Faction</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($models as $model): ?>
                            <?php if ($model['owned_qty'] > 0): ?>
                                <tr class="show <?php if ($model['painted_qty'] > 0){echo 'painted';}?> <?php echo str_replace(' ', '-', $model['faction']) ?>">
                                    <td class="name"><a href="http://roho.in/playtest/single-unit.php?name=<?php echo $model['unit_name'] ?>" title="<?php echo $model['unit_name'] ?>"><?php echo $model['unit_name'] ?></a></td>
                                    <td class="owned"><?php echo $model['owned_qty'] ?></td>
                                    <td class="painted"><?php echo $model['painted_qty'] ?></td>
                                    <td class="faction"><?php echo $model['faction'] ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>*/ ?>
                </paper-material>
            <?php else: ?>
                <paper-material elevation="1" class="cushion">
                    <p>It doesn't look like you have an account, please <a href="http://roho.in/login/register.php" title="Register a New Account">register for one</a>.</p>
                </paper-material>
            <?php endif; ?>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>
