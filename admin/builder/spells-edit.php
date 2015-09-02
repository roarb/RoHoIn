<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/SpecialAbilities.php';
    include '../../core/SpellsKnown.php';
    $allSpells = new AllSpellsKnown();
    $spell = $allSpells->getSpellByName($_GET['name']);
    $spell = $spell[0]; // set returned array to a single object
    $allAbilities = new AllSpecialAbilities;
    $abilitiesList = $allAbilities->getAllSpecialAbilities();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Update a Spell - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Edit Spell <?php echo $spell['name'] ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <form action="spells-edit-save.php" method="post" id="spells-edit-form">
                        <paper-input-container>
                            <input id="name" name="name" value="<?php echo $spell['name'] ?>" readonly class="readonly" is="iron-input" />
                        </paper-input-container>
                        <paper-textarea-container>
                            <textarea id="description" name="description" cols="140" rows="4"><?php echo $spell['description'] ?></textarea>
                        </paper-textarea-container>
                        <paper-input-container <?php if ($spell['cost']){?>class="md-input-has-value"<?php }?>>
                            <label for="cost">Cost:</label>
                            <input id="cost" name="cost" value="<?php echo $spell['cost']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="range">Range:</label>
                            <input id="range" name="range" value="<?php echo $spell['range_distance']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="aoe">Area of Effect:</label>
                            <input id="aoe" name="aoe" value="<?php echo $spell['aoe']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="pow">POW:</label>
                            <input id="pow" name="pow" value="<?php echo $spell['pow']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-switch-container>
                            <label for="upkeep" style="margin-right:10px;">Upkeep:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#upkeep')" <?php if ($spell['upkeep'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="upkeep" name="upkeep" value="<?php if ($spell['upkeep'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="upkeep" style="margin-right:10px;">Offensive:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#offensive')" <?php if ($spell['offensive'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="offensive" name="offensive" value="<?php if ($spell['offensive'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-select-container>
                            <label for="special-ability-1">Special Ability / Action:</label>
                            <select name="special-ability-1">
                                <option value="" selected>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if($spell['ability_granted'] == $ability['name']){echo 'selected';}?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="special-ability-2">Second Special Ability / Action:</label>
                            <select name="special-ability-2">
                                <option value="" selected>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if($spell['second_ability_granted'] == $ability['name']){echo 'selected';}?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-input-container>
                            <label for="off-spd-mod">Speed Modifier:</label>
                            <input id="off-spd-mod" name="off-spd-mod" value="<?php echo $spell['off_spd_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-str-mod">Strength Modifier:</label>
                            <input id="off-str-mod" name="off-str-mod" value="<?php echo $spell['off_str_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-mat-mod">Melee Attack Modifier:</label>
                            <input id="off-mat-mod" name="off-mat-mod" value="<?php echo $spell['off_mat_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-rat-mod">Ranged Attack Modifier:</label>
                            <input id="off-rat-mod" name="off-rat-mod" value="<?php echo $spell['off_rat_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-def-mod">Defense Modifier:</label>
                            <input id="off-def-mod" name="off-def-mod" value="<?php echo $spell['off_def_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-arm-mod">Armor Modifier:</label>
                            <input id="off-arm-mod" name="off-arm-mod" value="<?php echo $spell['off_arm_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="duration">Duration:</label>
                            <input id="duration" name="duration" value="<?php echo $spell['duration']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-button raised class="full-width-button" onclick="submitForm('#spells-edit-form')">Submit</paper-button>
                    </form>
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
        $('.faction-select-toolbar .spells').addClass('active');
    });
</script>
</body>
</html>
