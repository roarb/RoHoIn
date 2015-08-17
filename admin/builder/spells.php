<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/SpecialAbilities.php';
    include '../../core/SpellsKnown.php';
    $allSpells = new AllSpellsKnown;
    $spellsList = $allSpells->getAllSpells();
    $allAbilities = new AllSpecialAbilities;
    $abilitiesList = $allAbilities->getAllSpecialAbilities();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Spell Additions - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Add a New Spell</h1>
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
                        <h3>Current Spells:</h3>
                        <?php foreach ($spellsList as $spell): ?>
                            <paper-item>
                                <paper-material elevation="1" class="list-items">
                                    <div class="md-tile-content" style="position:relative;">
                                        <paper-fab mini icon="edit" class="edit-block-fab link-out primary-focus" data-src="/admin/builder/spells-edit.php?name=<?php echo $spell['name']?>"></paper-fab>
                                        <h3><?php echo $spell['name']?></h3>
                                        <p><?php
                                            if ($spell['description']){echo '<strong>Description:</strong> '.$spell['description'].'<br />';};
                                            if ($spell['cost']){echo '<strong>Cost:</strong> '.$spell['cost'].'<br />';};
                                            if ($spell['range_distance']){echo '<strong>Range:</strong> '.$spell['range_distance'].'<br />';};
                                            if ($spell['aoe']){echo '<strong>Area of Effect:</strong> '.$spell['aoe'].'<br />';};
                                            if ($spell['pow']){echo '<strong>POW:</strong> '.$spell['pow'].'<br />';};
                                            if ($spell['upkeep'] ==  true){echo '<strong>Upkeep</strong><br />';};
                                            if ($spell['offensive'] ==  true){echo '<strong>Offensive</strong><br />';};
                                            if ($spell['ability_granted']){echo '<strong>Ability Granted:</strong> '.$spell['ability_granted'].'<br />';};
                                            if ($spell['second_ability_granted']){echo '<strong>Second Ability Granted:</strong> '.$spell['second_ability_granted'].'<br />';};
                                            if ($spell['off_spd_mod']){echo '<strong>Speed Modifier:</strong> '.$spell['off_spd_mod'].'<br />';};
                                            if ($spell['off_str_mod']){echo '<strong>Strength Modifier:</strong> '.$spell['off_str_mod'].'<br />';};
                                            if ($spell['off_mat_mod']){echo '<strong>Melee Attack Modifier:</strong> '.$spell['off_mat_mod'].'<br />';};
                                            if ($spell['off_rat_mod']){echo '<strong>Ranged Attack Modifier:</strong> '.$spell['off_rat_mod'].'<br />';};
                                            if ($spell['off_def_mod']){echo '<strong>Defense Modifier:</strong> '.$spell['off_def_mod'].'<br />';};
                                            if ($spell['off_arm_mod']){echo '<strong>Armor Modifier:</strong> '.$spell['off_arm_mod'].'<br />';};
                                            if ($spell['duration']){echo '<strong>Duration:</strong> '.$spell['duration'].'<br />';};
                                            ?>
                                        </p>
                                    </div>
                                </paper-material
                            </paper-item>
                        <?php endforeach; ?>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Spell:</h3>
                        <form action="spells-save.php" method="post" id="spells-form" name="AdminForm">
                            <paper-input-container>
                                <label>Spell Name</label>
                                <input required id="name" name="name" is="iron-input">
                            </paper-input-container>
                            <paper-input-container>
                                <textarea required id="description" name="description" rows="4" placeholder="Please add a description"></textarea>
                            </paper-input-container>
                            <paper-input-container>
                                <label>Cost:</label>
                                <input required id="cost" name="cost" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Range:</label>
                                <input required id="range" name="range" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Area of Effect:</label>
                                <input id="aoe" name="aoe" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>POW:</label>
                                <input id="pow" name="pow" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Upkeep:</label><paper-toggle-button onclick="toggleCheckbox('#upkeep')"></paper-toggle-button>
                                <input id="upkeep" name="upkeep" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Offensive:</label><paper-toggle-button onclick="toggleCheckbox('#offensive')"></paper-toggle-button>
                                <input name="offensive" id="offensive" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-select-container>
                                <label for="special-ability-1">Special Ability / Action:</label><br />
                                <select name="special-ability-1">
                                    <option value="" selected>None</option>
                                    <?php foreach ($abilitiesList as $ability): ?>
                                        <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <paper-select-container>
                                <label for="special-ability-2">Second Special Ability / Action:</label><br />
                                <select name="special-ability-2">
                                    <option value="" selected>None</option>
                                    <?php foreach ($abilitiesList as $ability): ?>
                                        <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <paper-input-container>
                                <label>Speed Modifier:</label>
                                <input id="off-spd-mod" name="off-spd-mod" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Strength Modifier:</label>
                                <input id="off-str-mod" name="off-str-mod" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Melee Attack Modifier:</label>
                                <input id="off-mat-mod" name="off-mat-mod" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Ranged Attack Modifier:</label>
                                <input id="off-rat-mod" name="off-rat-mod" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Defense Modifier:</label>
                                <input id="off-def-mod" name="off-def-mod" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Armor Modifier:</label>
                                <input id="off-arm-mod" name="off-arm-mod" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Duration:</label>
                                <input id="duration" name="duration" is="iron-input" />
                            </paper-input-container>
                            <paper-button raised class="full-width-button" onclick="submitForm('#spells-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .spells').addClass('active');
    });
</script>
</body>
</html>