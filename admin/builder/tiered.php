<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/Unit.php';
    include '../../core/Faction.php';  ?>
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
            <?php include '../../nav/main-nav.php'; ?>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Add a Tiered List</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="horizontal layout">
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Current Tiered Lists:</h3>
                        <paper-item>
                            <paper-item-body class="list-items">
                                <div class="md-tile-content">
                                    <ul>
                                        <?php $allLists = new AllTieredLists;
                                        $tieredList = $allLists->getAllTieredLists();
                                        $allFactions = new AllFactions;
                                        $factionsList = $allFactions->getAllFactions();
                                        $allUnits = new AllUnits;
                                        $unitsList = $allUnits->getAllUnits();

                                        foreach ($tieredList as $list): ?>
                                            <?php $caster = $allUnits->getUnitNameById($list['caster'])['name'] ?>
                                            <paper-item><?php echo $list['name'].' - <a href="http://roho.in/playtest/single-unit.php?name='.$caster.'" title="'.$caster.'">'.$caster.'</a> - '.$list['faction'] ?></paper-item>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </paper-item-body>
                        </paper-item>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion" style="overflow-y:auto;">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Tiered List:</h3>
                        <form action="tiered-list-save.php" method="post" id="tiered-list-form">
                            <paper-input-container>
                                <label for="name">Tier List Name:</label>
                                <input id="name" name="name" is="iron-input" />
                            </paper-input-container>
                            <paper-select-container class="faction-picker">
                                <label for="faction">Faction:</label>
                                <select name="faction" onchange="getWarcasterById()" class="warcaster-faction">
                                    <option value="" selected>None</option>
                                    <?php foreach ($factionsList as $faction): ?>
                                        <option value="<?php echo $faction['name'] ?>"><?php echo $faction['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <div class="tier-info" style="display:none;">
                                <paper-select-container class="warcaster-picker">
                                    <label for="caster">Caster:</label>
                                    <select name="caster" id="faction-warcasters">
                                        <option value="" selected>None</option>
                                    </select>
                                </paper-select-container>
                                <paper-input-container>
                                    <textarea required id="description" name="description" rows="4" placeholder="Please add a description"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="req-battlegroup-front" name="req-battlegroup-front" rows="4" placeholder="Allowed battlegroup models front facing to the reader"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Allowed battlegroup models as [model_id,qty][model_id,qty]</label>
                                    <input required id="req-battlegroup-rules" name="req-battlegroup-rules" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="req-units-front" name="req-units-front" rows="4" placeholder="Allowed unit models front facing to the reader"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Allowed unit models as [model_id,qty][model_id,qty]</label>
                                    <input required id="req-units-rules" name="req-units-rules" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="req-solos-front" name="req-solos-front" rows="4" placeholder="Allowed solo models front facing to the reader"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Allowed solo models as [model_id,qty][model_id,qty]</label>
                                    <input required id="req-solos-rules" name="req-solos-rules" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="req-battleengine-front" name="req-battleengine-front" rows="4" placeholder="Allowed battle engine models front facing to the reader"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Allowed battle engine models as [model_id,qty][model_id,qty]</label>
                                    <input required id="req-battleengine-rules" name="req-battleengine-rules" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="tier-1-bonus-front" name="tier-1-bonus-front" rows="4" placeholder="Bonus Description for Tier 1"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 1 Bonus</label>
                                    <input id="tier-1-bonus" name="tier-1-bonus" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="tier-1-req-front" name="tier-1-req-front" rows="4" placeholder="Requirements Description for Tier 1"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 1 Requirements as [model_id,qty]</label>
                                    <input id="tier-1-req" name="tier-1-req" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="tier-2-bonus-front" name="tier-2-bonus-front" rows="4" placeholder="Bonus Description for Tier 2"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 2 Bonus</label>
                                    <input id="tier-2-bonus" name="tier-2-bonus" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="tier-2-req-front" name="tier-2-req-front" rows="4" placeholder="Requirements Description for Tier 2"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 2 Requirements as [model_id,qty]</label>
                                    <input id="tier-2-req" name="tier-2-req" is="iron-input">
                                </paper-input-container><paper-input-container>
                                    <textarea required id="tier-3-bonus-front" name="tier-3-bonus-front" rows="4" placeholder="Bonus Description for Tier 3"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 3 Bonus</label>
                                    <input id="tier-3-bonus" name="tier-3-bonus" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="tier-3-req-front" name="tier-3-req-front" rows="4" placeholder="Requirements Description for Tier 3"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 3 Requirements as [model_id,qty]</label>
                                    <input id="tier-3-req" name="tier-3-req" is="iron-input">
                                </paper-input-container><paper-input-container>
                                    <textarea required id="tier-4-bonus-front" name="tier-4-bonus-front" rows="4" placeholder="Bonus Description for Tier 4"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 4 Bonus</label>
                                    <input id="tier-4-bonus" name="tier-4-bonus" is="iron-input">
                                </paper-input-container>
                                <paper-input-container>
                                    <textarea required id="tier-4-req-front" name="tier-4-req-front" rows="4" placeholder="Requirements Description for Tier 4"></textarea>
                                </paper-input-container>
                                <paper-input-container>
                                    <label>Tier 4 Requirements as [model_id,qty]</label>
                                    <input id="tier-4-req" name="tier-4-req" is="iron-input">
                                </paper-input-container>
                            </div>
                            <paper-button raised class="full-width-button" onclick="submitForm('#tiered-list-form')">Submit</paper-button>
                        </form>
                    </paper-material>
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
        $('.faction-select-toolbar .tier').addClass('active');
    });
    function getWarcasterById(){
        showAjaxLoading();
        $('.faction-picker').hide();
        $('.tier-info').show();
        var faction = $('.warcaster-faction option:selected').val();
        var warcasterSelect = $('#faction-warcasters');
        $.getJSON("/ajax/warcasters-by-faction.php?faction="+faction, function (data) {
            $.each(data, function(key, object){
                var msg = '<option value="'+object["id"]+'">'+object["name"]+'</option>';
                $(warcasterSelect).append(msg);
                hideAjaxLoading();
            })
        });
    }
</script>
</body>
</html>
