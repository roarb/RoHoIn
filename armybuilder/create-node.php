<?php include('../login/index-start.php'); ?>

<html lang="en">
<head>
    <?php
    include '../admin/header.php';
    include '../core/Core.php';
    $core = new AllCore();
    $allFactions = new AllFactions();
    $armyBuilder = new ArmyBuilder();
    $factions = $allFactions->getAllFactions();
    $loggedIn = false;
    $creatorName = false;
    if ($core->getLoggedIn()){
        $loggedIn = true;
        $creatorName = $_SESSION['user_name'];
    }
    ?>
    <script src="army-builder-node.js"></script>
    <script src="tier-rules-node.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Create a Warmachine or Hordes Army with RoHo.In</title>
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
            <h1 class="full-page-title">Create a New Army List</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <paper-toolbar class="army-builder-toolbar hidden secondary full-width">
            <div class="horizontal layout" style="width:100%;">
                <div id="display-army-name" class="flex-4"></div>
                <div id="display-faction" class="flex-4"></div>
                <div id="display-army-points" class="flex-4"></div>
                <div id="display-army-tier" class="flex-4"></div>
            </div>
        </paper-toolbar>
        <div class="vertical layout info-block army-builder-content">
            <div id="army-name">
                <paper-input-container style="width:80%; margin:0 10%;">
                    <label>Give Your Army A Name</label>
                    <input required id="army-list-name" name="army-list-name" is="iron-input" value="<?php if ($loggedIn == true){echo ucfirst($creatorName).'\'s Army';} ?>" />
                </paper-input-container>
            </div>
            <div id="army-faction">
            <?php $i = 0 ?>
            <?php foreach ($factions as $faction): ?>
                <?php if ($i == 0 || $i == 6): ?>
                    <div class="flex-1 horizontal layout">
                <?php endif; ?>
                <div class="faction-block flex-6">
                    <img src="/skin/images/faction/<?php echo str_replace(' ','',$faction['name']) ?>.png" class="faction-icon" onclick="setActiveFaction('<?php echo str_replace(' ','',$faction['name']) ?>',event, '<?php echo $faction['name'] ?>');" />
                </div>
                <?php if ($i == 5 || $i == 11): ?>
                    </div>
                <?php endif; ?>
                <?php $i++; ?>
                <input type="radio" name="faction" value="<?php echo $faction['name'] ?>" class="hidden faction-select" id="<?php echo str_replace(' ','',$faction['name']) ?>">
            <?php endforeach; ?>
            </div>
            <div id="army-points">
                <div class="flex-1 horizontal layout">
                    <paper-button raised class="points-block-item flex-6 army-points-10" id="army-points-10">
                        <input type="radio" name="pointsValue" value="10" class="hidden" id="points-10">
                        <span class="points-block"><strong>10 points</strong><br />Duel<br />1 Caster</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-6 army-points-15" id="army-points-15">
                        <input type="radio" name="pointsValue" value="15" class="hidden" id="points-15">
                        <span class="points-block"><strong>15 points</strong><br />Duel<br />1 Caster</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-6 army-points-25" id="army-points-25">
                        <input type="radio" name="pointsValue" value="25" class="hidden" id="points-25">
                        <span class="points-block"><strong>25 points</strong><br />Skirmish<br />1 Caster</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-6 army-points-35" id="army-points-35">
                        <input type="radio" name="pointsValue" value="35" class="hidden" id="points-35">
                        <span class="points-block"><strong>35 points</strong><br />Skirmish<br />1 Caster</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-6 army-points-50" id="army-points-50">
                        <input type="radio" name="pointsValue" value="50" class="hidden" id="points-50">
                        <span class="points-block"><strong>50 points</strong><br />Skirmish<br />1 Caster</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-6 army-points-75" id="army-points-75">
                        <input type="radio" name="pointsValue" value="75" class="hidden" id="points-75">
                        <span class="points-block"><strong>75 points</strong><br />Grand Melee<br />1 Caster</span>
                    </paper-button>
                </div>
                <div class="flex-1 horizontal layout hidden">
                    <paper-button raised class="points-block-item flex-5 army-points-100" id="army-points-100">
                        <input type="radio" name="pointsValue" value="100" class="hidden" id="points-100">
                        <span class="points-block"><strong>100 points</strong><br />Grand Melee<br />1 or 2 Casters</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-5 army-points-125" id="army-points-125">
                        <input type="radio" name="pointsValue" value="125" class="hidden" id="points-125">
                        <span class="points-block"><strong>125 points</strong><br />Battle Royale<br />2 Casters</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-5 army-points-150" id="army-points-150">
                        <input type="radio" name="pointsValue" value="150" class="hidden" id="points-150">
                        <span class="points-block"><strong>150 points</strong><br />Battle Royale<br />2 or 3 Casters</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-5 army-points-175" id="army-points-175">
                        <input type="radio" name="pointsValue" value="175" class="hidden" id="points-175">
                        <span class="points-block"><strong>175 points</strong><br />War<br />3 Casters</span>
                    </paper-button>
                    <paper-button raised class="points-block-item flex-5 army-points-200" id="army-points-200">
                        <input type="radio" name="pointsValue" value="200" class="hidden" id="points-200">
                        <span class="points-block"><strong>200 points</strong><br />War<br />3 or 4 Casters</span>
                    </paper-button>
                </div>
            </div>
            <div id="start-building">
                <paper-button raised class="m-cushion start-building" id="start-army-list-builder">Start Building</paper-button>
            </div>
            <div id="ajax-armybuilder"></div>
        </div>
        <paper-toast id="faction-error" text="Please Choose a Faction"></paper-toast>
        <paper-toast id="points-error" text="Please Choose a Points Value"></paper-toast>
        <paper-toast id="faction-mercs" text="We're sorry, we're still in beta phase and cannot create Mercenary armies yet."></paper-toast>
        <paper-toast id="faction-minions" text="We're sorry, we're still in beta phase and cannot create Minion armies yet."></paper-toast>
        <paper-toast id="single-caster-error" text="We're sorry, we're still in beta phase and can only create armies with a single battlegroup. Please check back again in the future"></paper-toast>
    </paper-header-panel>
</paper-drawer-panel>

<script>
    // start the session array of objects that will temp store this army list until it is saved.
    var armyBuilder = {
        "army": {
            "name": null,
            "faction": {
                "faction_id": null,
                "faction_name": null
            },
            "army_models_avil": {
                "leaders": [],
                "bg1_models": [],
                "unit_models": [],
                "solo_models": [],
                "battle_engine_models": [],
                "merc_unit_models": [],
                "merc_solo_models": [],
                "merc_bg_models": []
            },
            "army_models_added": {
                "leader": [],
                "bg1_models": [],
                "unit_models": [],
                "solo_models": [],
                "battle_engine_models": [],
                "merc_unit_models": [],
                "merc_solo_models": [],
                "merc_bg_models": [],
                "journeyman": {
                    "model_id": null,
                    "active": false,
                    "battlegroup": null,
                    "temp": null
                },
                "jackmarshal": {
                    "model_id": null,
                    "active": false,
                    "battlegroup": null,
                    "temp": null
                }
            },
            "points": {
                "selected": null,
                    "caster_mod": null,
                    "used": null
            },
            "tiers": {
                "list_level_set": null,
                    "level_1_ben": null,
                    "level_2_ben": null,
                    "level_3_ben": null,
                    "level_4_ben": null,
                    "level_1_req": null,
                    "level_2_req": null,
                    "level_3_req": null,
                    "level_4_req": null,
                    "model_updates": null
            },
            "public_list": true,
                "barracks_models": false,
                "painted_models": false,
                "owner": {
                    "logged_in": <?php if ($loggedIn){echo 'true';}else {echo 'false';} ?>,
                    "name": <?php if ($creatorName){echo "'".$creatorName."'";}else {echo 'null';} ?>,
                    "id": <?php if ($loggedIn){echo $_SESSION['user_id'];}else {echo 'null';} ?>
            },
            "guid": '<?php echo $armyBuilder->getGUID() ?>'
        }
    };

    $('#start-army-list-builder').on('touchstart click', function(){

        // first run validation on army selected and points selected
        var faction = $('#army-faction input:checked');
        var points = $('#army-points input:checked');
        if (faction.length < 1){
            document.querySelector('#faction-error').show();
            return false;
        }
        if (points.length < 1){
            document.querySelector('#points-error').show();
            return false;
        }
        if (points.val() > 100 ){
            document.querySelector('#single-caster-error').show();
            return false;
        }

        //$.get("http://roho.in:8081/army_builder", {armyBuilder}, function(data){
        //   console.log(data);
        //}, "json");

        startArmyListBuilder();
    });

    $(document).ready(function(){
        $('#army-points-10').on('touchstart click', function(){
            setActivePoints(10,'.army-points-10');
            });
        $('#army-points-15').on('touchstart click', function(){
            setActivePoints(15,'.army-points-15');
        });
        $('#army-points-25').on('touchstart click', function(){
            setActivePoints(25,'.army-points-25');
        });
        $('#army-points-35').on('touchstart click', function(){
            setActivePoints(35,'.army-points-35');
        });
        $('#army-points-50').on('touchstart click', function(){
            setActivePoints(50,'.army-points-50');
        });
        $('#army-points-75').on('touchstart click', function(){
            setActivePoints(75,'.army-points-75');
        });
        $('#army-points-100').on('touchstart click', function(){
            setActivePoints(100,'.army-points-100');
        });
        $('#army-points-125').on('touchstart click', function(){
            setActivePoints(125,'.army-points-125');
        });
        $('#army-points-150').on('touchstart click', function(){
            setActivePoints(150,'.army-points-150');
        });
        $('#army-points-175').on('touchstart click', function(){
            setActivePoints(175,'.army-points-175');
        });
        $('#army-points-200').on('touchstart click', function(){
            setActivePoints(200,'.army-points-200');
        });
    });
</script>
</body>
</html>