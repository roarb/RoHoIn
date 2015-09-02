<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/Weapons.php';
    include '../../core/DamageImmunity.php';
    include '../../core/SpecialAbilities.php';
    $weapons = new AllWeapons();
    $weapon = $weapons->getWeaponByName($_GET['name']);
    $weapon = $weapon[0]; // set returned array to a single object
    $allTypes = new AllDamageImmunityTypes;
    $typesList = $allTypes->getAllDamageImmunityTypes();
    $allSpecialAbilities = new AllSpecialAbilities;
    $abilitiesList = $allSpecialAbilities->getAllSpecialAbilities();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Update a Weapon - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Edit Weapon <?php echo $weapon['name'] ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <form action="weapon-edit-save.php" method="post" id="weapon-edit-form">
                        <paper-input-container>
                            <input id="name" name="name" value="<?php echo $weapon['name'] ?>" readonly class="readonly" is="iron-input" />
                        </paper-input-container>
                        <paper-switch-container>
                            <label for="ranged" style="margin-right:10px;">Ranged:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#ranged')" <?php if ($weapon['ranged'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="ranged" name="ranged" value="<?php if ($weapon['ranged'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-input-container>
                            <label for="range">Range:</label>
                            <input id="range" name="range" value="<?php echo $weapon['shooting_distance']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="rof">Rate of Fire:</label>
                            <input id="rof" name="rof" value="<?php echo $weapon['rof']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="aoe">Area of Effect:</label>
                            <input id="aoe" name="aoe" value="<?php echo $weapon['aoe']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="pow">POW:</label>
                            <input id="pow" name="pow" value="<?php echo $weapon['pow']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-select-container>
                            <label for="damage-type">Damage Type:</label>
                            <select name="damage-type">
                                <option value="" selected>None</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo $type['name'] ?>" <?php if($weapon['damage_type'] == $type['name']){echo 'selected';}?>><?php echo $type['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="critical-effect">Critical Effect:</label>
                            <select name="critical-effect">
                                <option value="" selected>None</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo $type['name'] ?>" <?php if($weapon['critical_effect'] == $type['name']){echo 'selected';}?>><?php echo $type['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="continuous-effect">Continuous Effect:</label>
                            <select name="continuous-effect">
                                <option value="" selected>None</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo $type['name'] ?>" <?php if($weapon['continuous_effect'] == $type['name']){echo 'selected';}?>><?php echo $type['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="special-ability-1">Special Action 1:</label>
                            <select name="special-ability-1">
                                <option value="" selected>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if($weapon['special_action_1'] == $ability['name']){echo 'selected';}?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="special-ability-2">Special Action 2:</label>
                            <select name="special-ability-2">
                                <option value="" selected>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if($weapon['special_action_2'] == $ability['name']){echo 'selected';}?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="special-ability-3">Special Action 3:</label>
                            <select name="special-ability-3">
                                <option value="" selected>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if($weapon['special_action_3'] == $ability['name']){echo 'selected';}?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="special-ability-4">Special Action 4:</label>
                            <select name="special-ability-4">
                                <option value="" selected>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if($weapon['special_action_4'] == $ability['name']){echo 'selected';}?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-switch-container>
                            <label for="reach" style="margin-right:10px;">Reach:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#reach')" <?php if ($weapon['reach'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="reach" name="reach" value="<?php if ($weapon['reach'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="open-fist" style="margin-right:10px;">Open Fist:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#open-fist')" <?php if ($weapon['open_fist'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="open-fist" name="open-fist" value="<?php if ($weapon['open_fist'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="magical" style="margin-right:10px;">Magical Weapon:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#magical')" <?php if ($weapon['magical'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="magical" name="magical" value="<?php if ($weapon['magical'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="weapons-master" style="margin-right:10px;">Weapons Master:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#weapons-master')" <?php if ($weapon['weapons_master'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="weapons-master" name="weapons-master" value="<?php if ($weapon['weapons_master'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="thrown" style="margin-right:10px;">Thrown Weapon:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#thrown')" <?php if ($weapon['thrown'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="thrown" name="thrown" value="<?php if ($weapon['thrown'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="buckler" style="margin-right:10px;">Buckler:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#buckler')" <?php if ($weapon['buckler'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="buckler" name="buckler" value="<?php if ($weapon['buckler'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>
                        <paper-switch-container>
                            <label for="shield" style="margin-right:10px;">Shield:</label>
                            <paper-toggle-button onclick="toggleCheckbox('#shield')" <?php if ($weapon['shield'] == 1){echo 'checked';} ?>></paper-toggle-button>
                            <input id="shield" name="shield" value="<?php if ($weapon['shield'] == 1){echo '1';} else {echo '0';} ?>" class="hidden" />
                        </paper-switch-container>

                        <paper-button raised class="full-width-button" onclick="submitForm('#weapon-edit-form')">Submit</paper-button>
                    </form>
                </paper-material>
            </div>
            <paper-fab mini icon="arrow-back" class="fixed-fab link-out" data-src="/admin/builder/weapon.php"></paper-fab>
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
        $('.faction-select-toolbar .weapon').addClass('active');
    });
</script>
</body>
</html>
