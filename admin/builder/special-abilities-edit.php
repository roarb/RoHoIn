<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/DamageImmunity.php';
    include '../../core/SpecialAbilities.php';
    $allSpecialAbilities = new AllSpecialAbilities;
    $ability = $allSpecialAbilities->getAbilityByName($_GET['name']);
    $ability = $ability[0]; // set returned array to a single object
    $allTypes = new AllDamageImmunityTypes;
    $typesList = $allTypes->getAllDamageImmunityTypes();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Update a Ability / Action - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Edit Ability Action <?php echo $ability['name'] ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <form action="special-abilities-edit-save.php" method="post" id="abilities-edit-form">
                        <paper-input-container>
                            <label for="cost">Name:</label>
                            <input id="name" name="name" value="<?php echo $ability['name'] ?>" readonly class="readonly" is="iron-input" />
                        </paper-input-container>
                        <paper-textarea-container>
                            <textarea id="description" name="description" cols="140" rows="4"><?php echo $ability['description_text'] ?></textarea>
                        </paper-textarea-container>
                        <paper-select-container>
                            <label for="immunity">Immunity:</label>
                            <select name="immunity">
                                <option value="" selected>None</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo $type['name'] ?>" <?php if($ability['immunity'] == $type['name']){echo 'selected';}?>><?php echo $type['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="damage-type">Damage Type:</label>
                            <select name="damage-type">
                                <option value="" selected>None</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo $type['name'] ?>" <?php if($ability['damage_type'] == $type['name']){echo 'selected';}?>><?php echo $type['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="continuous-effect">Continuous Effect:</label>
                            <select name="continuous-effect">
                                <option value="" selected>None</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo $type['name'] ?>" <?php if($ability['continouous_effect'] == $type['name']){echo 'selected';}?>><?php echo $type['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-input-container>
                            <label for="off-spd-mod">Speed Modifier:</label>
                            <input id="off-spd-mod" name="off-spd-mod" value="<?php echo $ability['off_spd_mod']?>" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-str-mod">Strength Modifier:</label>
                            <input id="off-str-mod" name="off-str-mod" value="<?php echo $ability['off_str_mod']?>"  is="iron-input"/>
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-mat-mod">Melee Attack Modifier:</label>
                            <input id="off-mat-mod" name="off-mat-mod" value="<?php echo $ability['off_mat_mod']?>"  is="iron-input"/>
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-rat-mod">Ranged Attack Modifier:</label>
                            <input id="off-rat-mod" name="off-rat-mod" value="<?php echo $ability['off_rat_mod']?>"  is="iron-input"/>
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-def-mod">Defense Modifier:</label>
                            <input id="off-def-mod" name="off-def-mod" value="<?php echo $ability['off_def_mod']?>"  is="iron-input"/>
                        </paper-input-container>
                        <paper-input-container>
                            <label for="off-arm-mod">Armor Modifier:</label>
                            <input id="off-arm-mod" name="off-arm-mod" value="<?php echo $ability['off_arm_mod']?>"  is="iron-input"/>
                        </paper-input-container>
                        <paper-input-container>
                            <label for="weapon-range-mod">Weapon Range Modifier:</label>
                            <input id="weapon-range-mod" name="weapon-range-mod" value="<?php echo $ability['weapon_range_mod']?>"  is="iron-input"/>
                        </paper-input-container>
                        <paper-button raised class="full-width-button" onclick="submitForm('#abilities-edit-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .abilities').addClass('active');
    });
</script>
</body>
</html>
