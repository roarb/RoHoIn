<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/DamageImmunity.php';
    include '../../core/SpecialAbilities.php';
    $allSpecialAbilities = new AllSpecialAbilities;
    $specialAbilitiesList = $allSpecialAbilities->getAllSpecialAbilities();
    $allTypes = new AllDamageImmunityTypes;
    $typesList = $allTypes->getAllDamageImmunityTypes();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Special Ability / Action Additions - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Add a New Special Ability / Action</h1>
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
                        <h3>Current Abilities and Actions:</h3>
                        <?php foreach ($specialAbilitiesList as $ability): ?>
                            <paper-item>
                                <paper-material elevation="1" class="list-items">
                                    <div class="md-tile-content" style="position:relative;">
                                        <paper-fab mini icon="edit" class="edit-block-fab link-out primary-focus" data-src="/admin/builder/special-abilities-edit.php?name=<?php echo $ability['name']?>"></paper-fab>
                                        <h3><?php echo $ability['name']?></h3>
                                        <p><?php
                                            if ($ability['description_text']){echo '<strong>Description:</strong> '.$ability['description_text'].'<br />';};
                                            if ($ability['immunity']){echo '<strong>Immunity:</strong> '.$ability['immunity'].'<br />';};
                                            if ($ability['damage_type']){echo '<strong>Damage Type:</strong> '.$ability['damage_type'].'<br />';};
                                            if ($ability['continouous_effect']){echo '<strong>Continuous Effect:</strong> '.$ability['continouous_effect'].'<br />';};
                                            if ($ability['off_spd_mod']){echo '<strong>Speed Modifier:</strong> '.$ability['off_spd_mod'].'<br />';};
                                            if ($ability['off_str_mod']){echo '<strong>Strength Modifier:</strong> '.$ability['off_str_mod'].'<br />';};
                                            if ($ability['off_mat_mod']){echo '<strong>Melee Attack Modifier:</strong> '.$ability['off_mat_mod'].'<br />';};
                                            if ($ability['off_rat_mod']){echo '<strong>Ranged Attack Modifier:</strong> '.$ability['off_rat_mod'].'<br />';};
                                            if ($ability['off_def_mod']){echo '<strong>Defense Modifier:</strong> '.$ability['off_def_mod'].'<br />';};
                                            if ($ability['off_arm_mod']){echo '<strong>Armor Modifier:</strong> '.$ability['off_arm_mod'].'<br />';};
                                            if ($ability['weapon_range_mod']){echo '<strong>Weapon Range Modifier:</strong> '.$ability['weapon_range_mod'].'<br />';};
                                            ?>
                                        </p>
                                    </div>
                                </paper-material>
                            </paper-item>
                        <?php endforeach; ?>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Special Ability or Action:</h3>
                        <form action="special-abilities-save.php" method="post" id="abilitiy-form" name="AdminForm">
                            <paper-input-container>
                                <label for="name">Special Ability / Action Name:</label>
                                <input id="name" name="name" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <textarea required id="description" name="description" placeholder="Please add a description" is="iron-input"></textarea>
                            </paper-input-container>
                            <paper-select-container>
                                <label for="immunity">Immunity:</label>
                                <select name="immunity">
                                    <option value="" selected>None</option>
                                    <?php foreach ($typesList as $type): ?>
                                        <option value="<?php echo $type['name'] ?>"><?php echo $type['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <paper-select-container>
                                <label for="damage-type">Damage Type:</label>
                                <select name="damage-type">
                                    <option value="" selected>None</option>
                                    <?php foreach ($typesList as $type): ?>
                                        <option value="<?php echo $type['name'] ?>"><?php echo $type['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <paper-select-container>
                                <label for="continuous-effect">Continuous Effect:</label>
                                <select name="continuous-effect">
                                    <option value="" selected>None</option>
                                    <?php foreach ($typesList as $type): ?>
                                        <option value="<?php echo $type['name'] ?>"><?php echo $type['name'] ?></option>
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
                                <label>Weapon Range Modifier:</label>
                                <input id="weapon-range-mod" name="weapon-range-mod" is="iron-input" />
                            </paper-input-container>
                            <paper-button raised class="full-width-button" onclick="submitForm('#abilitiy-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .abilities').addClass('active');
    });
</script>
</body>
</html>
