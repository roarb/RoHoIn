<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';
    include '../core/Core.php';
    include '../core/ArmyBuilder.php';
    $armyBuilder = new ArmyBuilder(); ?>
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
    <title>RoHo.in WarmaHordes Public Army Lists</title>
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
            <h1 class="full-page-title">All WarmaHordes Public Army Lists</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <div class="info-block">
            <div id="jsGrid"></div>
            <script>
                (function() {

                    var db = {

                        loadData: function(filter) {
                            return $.grep(this.lists, function(list) {
                                return (!filter.name || list.name.indexOf(filter.name) > -1)
                                    && (!filter.faction || list.faction === filter.faction)
                                    && (!filter.points || list.points === filter.points);
                                    //&& (!filter.Address || client.Address.indexOf(filter.Address) > -1)
                                    //&& (!filter.Country || client.Country === filter.Country)
                                    //&& (filter.Married === undefined || client.Married === filter.Married);
                            });
                        }

                    };

                    window.db = db;

                    db.factions = [
                        { Name: "", Code: "" },
                        { Name: "Circle Orboros", Code: "Circle Orboros" },
                        { Name: "Convergence of Cryiss", Code: "Convergence of Cryiss" },
                        { Name: "Cryx", Code: "Cryx" },
                        { Name: "Cygnar", Code: "Cygnar" },
                        { Name: "Khador", Code: "Khador" },
                        { Name: "Legion of Everblight", Code: "Legion of Everblight" },
                        { Name: "Mercenaries", Code: "Mercenaries" },
                        { Name: "Minions", Code: "Minions" },
                        { Name: "Retribution of Scyrah", Code: "Retribution of Scyrah" },
                        { Name: "Skorne", Code: "Skorne" },
                        { Name: "The Protectorate of Menoth", Code: "The Protectorate of Menoth" },
                        { Name: "Trollbloods", Code: "Trollbloods" }
                    ];

                    db.points = [
                        { Value: "" },
                        { Value: "10" },
                        { Value: "15" },
                        { Value: "25" },
                        { Value: "35" },
                        { Value: "50" },
                        { Value: "75" },
                        { Value: "100" }
                    ];

                    db.lists = <?php echo json_encode($armyBuilder->getAllPublicArmyLists()) ?>;

                }());

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
                            // will need to add some custom functionality to build in a link to view the list and show a 'view' icon in the grid display
                            // perhaps a slide open on hover to display more list information (or a separate warcaster field)
                            // could possibly add in support for why the list was created as well, for a certain event? need to tie that to list creation though
                            { title: "Name", name: "name", type: "text", width: 150 },
                            { title: "Faction", name: "faction", type: "select", items: db.factions, valueField: "Code", textField: "Name" },
                            { title: "Points", name: "points", type: "select", items: db.points, valueField: "Value", textField: "Value" }//,
                            //{ type: "control" } // default jsGrid is control to show the edit/delete options - look to building a custom edit if the list is owner is viewing
                        ]
                    });

                });
            </script>
            <?php /*$allPublicLists = $armyBuilder->getAllPublicArmyLists(); ?>
            <?php foreach ($allPublicLists as $list): ?>
                <div class="flex-2">
                    <paper-button raised class="full-width-button link-out" data-src="/armybuilder/view-army-list.php?id=<?php echo $list["id"] ?>">
                        <span class="list-faction"><?php echo $list['faction'] ?></span>
                        <span class="list-name"><?php echo $list['name'] ?></span> | <span class="list-points"><?php echo $list['points'] ?> pts.</span>
                    </paper-button>
                </div>
            <?php endforeach; */?>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>