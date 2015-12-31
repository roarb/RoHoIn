<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../core/Core.php';
    $core = new AllCore();
    include '../../admin/header.php';
    $allWeapons = new AllWeapons();
    $weaponsList = $allWeapons->getAllWeapons();
    $allTypes = new AllDamageImmunityTypes();
    $typesList = $allTypes->getAllDamageImmunityTypes();
    $allSpecialAbilities = new AllSpecialAbilities();
    $abilitiesList = $allSpecialAbilities->getAllSpecialAbilities();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add a New Weapon - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($core->getAdmin()): ?>
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
                <h1 class="full-page-title">Add a New Weapon</h1>
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
                        <h3>Current Weapons:</h3>
                        <?php foreach ($weaponsList as $weapon): ?>
                            <paper-item>
                                <paper-material elevation="1" class="list-items">
                                    <div class="md-tile-content" style="position:relative;">
                                    <paper-fab mini icon="edit" class="edit-block-fab link-out primary-focus" data-src="/admin/builder/weapon-edit.php?name=<?php echo $weapon['name']?>"></paper-fab>
                                    <h3><?php echo $weapon['name']?></h3>
                                    <p><?php
                                        if ($weapon['ranged'] == true){echo '<strong>Ranged Weapon</strong><br />';}
                                        if ($weapon['shooting_distance']){echo '<strong>Range:</strong> '.$weapon['shooting_distance'].'<br />';}
                                        if ($weapon['rof']){echo '<strong>Rate of Fire:</strong> '.$weapon['rof'].'<br />';}
                                        if ($weapon['aoe']){echo '<strong>Aera of Effect:</strong> '.$weapon['aoe'].'<br />';}
                                        echo '<strong>POW:</strong> '.$weapon['pow'].'<br />';
                                        if ($weapon['damage_type']){echo '<strong>Damage Type:</strong> '.$weapon['damage_type'].'<br />';}
                                        if ($weapon['critical_effect']){echo '<strong>Critical Effect:</strong> '.$weapon['critical_effect'].'<br />';}
                                        if ($weapon['continuous_effect']){echo '<strong>Continuous Effect:</strong> '.$weapon['continuous_effect'].'<br />';}
                                        if ($weapon['special_action_1']){echo '<strong>Special Action:</strong> '.$weapon['special_action_1'].'<br />';}
                                        if ($weapon['special_action_2']){echo '<strong>Special Action Two:</strong> '.$weapon['special_action_2'].'<br />';}
                                        if ($weapon['reach'] == true){echo '<strong>Reach</strong><br />';}
                                        if ($weapon['open_fist'] == true){echo '<strong>Open Fist</strong><br />';}
                                        if ($weapon['magical'] == true){echo '<strong>Magical Attacks</strong><br />';}
                                        if ($weapon['weapons_master'] == true){echo '<strong>Weapons Master</strong><br />';};
                                        if ($weapon['thrown'] == true){echo '<strong>Thrown Weapon</strong><br />';};
                                        if ($weapon['buckler'] == true){echo '<strong>Buckler</strong><br />';};
                                        if ($weapon['shield'] == true){echo '<strong>Shield</strong><br />';}; ?>
                                        </p>
                                    </div>
                                </paper-material>
                            </paper-item>
                        <?php endforeach; ?>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Weapon:</h3>
                        <form action="weapon-save.php" method="post" id="weapon-form" name="AdminForm">
                            <paper-input-container>
                                <label>Weapon Name</label>
                                <input required id="name" name="name" is="iron-input">
                            </paper-input-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Ranged:</label><paper-toggle-button onclick="toggleCheckbox('#ranged')"></paper-toggle-button>
                                <input name="ranged" id="ranged" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-input-container>
                                <label>Range:</label>
                                <input id="range" name="range" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Rate of Fire:</label>
                                <input id="rof" name="rof" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>Area of Effect:</label>
                                <input id="aoe" name="aoe" maxlength="6" is="iron-input" />
                            </paper-input-container>
                            <paper-input-container>
                                <label>POW:</label>
                                <input id="pow" name="pow" maxlength="6" is="iron-input" />
                            </paper-input-container>
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
                                <label for="critical-effect">Critical Effect:</label>
                                <select name="critical-effect">
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
                            <paper-select-container>
                                <label for="special-ability-3">Third Special Ability / Action:</label><br />
                                <select name="special-ability-3">
                                    <option value="" selected>None</option>
                                    <?php foreach ($abilitiesList as $ability): ?>
                                        <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <paper-select-container>
                                <label for="special-ability-4">Fourth Special Ability / Action:</label><br />
                                <select name="special-ability-4">
                                    <option value="" selected>None</option>
                                    <?php foreach ($abilitiesList as $ability): ?>
                                        <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </paper-select-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Reach:</label><paper-toggle-button onclick="toggleCheckbox('#reach')"></paper-toggle-button>
                                <input id="reach" name="reach" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Open Fist:</label><paper-toggle-button onclick="toggleCheckbox('#open-fist')"></paper-toggle-button>
                                <input id="open-fist" name="open-fist" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Magical Weapon:</label><paper-toggle-button onclick="toggleCheckbox('#magical')"></paper-toggle-button>
                                <input id="magical" name="magical" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Weapons Master:</label><paper-toggle-button onclick="toggleCheckbox('#weapons-master')"></paper-toggle-button>
                                <input id="weapons-master" name="weapons-master" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Thrown Weapon:</label><paper-toggle-button onclick="toggleCheckbox('#thrown')"></paper-toggle-button>
                                <input id="thrown" name="thrown" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Buckler:</label><paper-toggle-button onclick="toggleCheckbox('#buckler')"></paper-toggle-button>
                                <input id="buckler" name="buckler" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-switch-container>
                                <label style="margin-right:10px;">Shield:</label><paper-toggle-button onclick="toggleCheckbox('#shield')"></paper-toggle-button>
                                <input id="shield" name="shield" value="0" class="hidden" />
                            </paper-switch-container>
                            <paper-button raised class="full-width-button" onclick="submitForm('#weapon-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .weapon').addClass('active');
    });
</script>
</body>
</html>