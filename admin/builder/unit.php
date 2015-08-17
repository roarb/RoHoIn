<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../admin/header.php';
    include '../../core/Core.php';
    include '../../core/AnimusKnown.php';
    include '../../core/BaseSize.php';
    include '../../core/DamageImmunity.php';
    include '../../core/Faction.php';
    include '../../core/SpecialAbilities.php';
    include '../../core/SpellsKnown.php';
    include '../../core/Unit.php';
    include '../../core/UnitType.php';
    include '../../core/Weapons.php';
    $allUnits = new AllUnits;
    $unitsList = $allUnits->getAllUnitsName();
    $allAbilities = new AllSpecialAbilities;
    $abilitiesList = $allAbilities->getAllSpecialAbilitiesName();
    $allWeapons = new AllWeapons;
    $weaponsList = $allWeapons->getAllWeaponsName();
    $allUnitTypes = new AllUnitTypes;
    $unitTypesList = $allUnitTypes->getAllUnitTypes();
    $allFactions = new AllFactions;
    $factionsList = $allFactions->getAllFactions();
    $allAnimus = new AllAnimusKnown;
    $animusList = $allAnimus->getAllAnimusName();
    $allSizes = new AllBaseSizes;
    $baseSizesList = $allSizes->getAllBaseSizes();
    $allSpells = new AllSpellsKnown;
    $spellsKnownList = $allSpells->getAllSpellsName();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Unit / Model Additions - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Add a New Unit / Model</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <form action="unit-save.php" method="post" id="unit-form" name="AdminForm">
                        <paper-select-container>
                            <label for="unit-type">Model Type:</label>
                            <select name="unit-type" id="unit-type" onChange="unitSelected();">
                                <option required value="" selected>Please Select</option>
                                <?php foreach ($unitTypesList as $unitType): ?>
                                    <option value="<?php echo $unitType['name']?>"><?php echo $unitType['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="faction">Faction:</label>
                            <select name="faction" id="faction" onChange="factionSelected();">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($factionsList as $faction): ?>
                                    <option value="<?php echo $faction['name']?>"><?php echo $faction['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id ="related-faction-item" style="display:none;">
                            <label for="related-faction">Related Factions:</label><br />
                            <?php foreach ($factionsList as $faction): ?>
                                <paper-checkbox onclick="toggleCheckInCheckbox('#<?php echo str_replace(' ','',$faction['name']) ?>')"><?php echo $faction['name'] ?></paper-checkbox><br />
                                <input type="checkbox" name="related-faction[]" value="<?php echo $faction['name'] ?>" id="<?php echo str_replace(' ','',$faction['name']) ?>" class="hidden" />
                            <?php endforeach; ?>
                            <paper-checkbox checked onclick="toggleCheckInCheckbox('#no-faction')">None</paper-checkbox><br />
                            <input type="checkbox" name="related-faction[]" id="no-faction" class="hidden" value="" checked/>
                        </paper-select-container>
                        <paper-input-container>
                            <label for="name">Model / Unit Name:</label>
                            <input required id="name" name="name" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="title">Title:</label>
                            <input required id="title" name="title" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="cost">Cost:</label>
                            <input required id="cost" name="cost" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="field-allowance">Field Allowance:</label>
                            <input required id="field-allowance" name="field-allowance" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="bg-points-item" style="display:none;">
                            <label for="bg-points">Battle Group Points:</label>
                            <input id="bg-points" name="bg-points" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="purchase-low-item" style="display:none;">
                            <label for="purchase-low">Unit Minimum Model Count:</label>
                            <input id="purchase-low" name="purchase-low" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="purchase-high-item" style="display:none;">
                            <label for="purchase-high">Unit Maximum Model Count:</label>
                            <input id="purchase-high" name="purchase-high" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="focus-item" style="display:none;">
                            <label for="focus">Focus:</label>
                            <input id="focus" name="focus" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="fury-item" style="display:none;">
                            <label for="fury">Fury:</label>
                            <input id="fury" name="fury" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="threshold-item" style="display:none;">
                            <label for="threshold">Threshold:</label>
                            <input id="threshold" name="threshold" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="spd-item">
                            <label for="spd">Speed:</label>
                            <input id="spd" name="spd" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="str-item">
                            <label for="str">Strength:</label>
                            <input id="str" name="str" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="mat-item">
                            <label for="mat">Melee Attack:</label>
                            <input id="mat" name="mat" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="rat-item">
                            <label for="rat">Ranged Attack:</label>
                            <input id="rat" name="rat" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="def-item">
                            <label for="def">Defense:</label>
                            <input id="def" name="def" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="arm-item">
                            <label for="arm">Armor:</label>
                            <input id="arm" name="arm" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="cmd-item">
                            <label for="cmd">Command:</label>
                            <input id="cmd" name="cmd" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="damage-boxes-item">
                            <label for="damage-boxes">Damage Boxes:</label>
                            <input id="damage-boxes" name="damage-boxes" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="damage-grid-item" style="display:none;">
                            <label for="damage-grid">Damage Grid:</label>
                            <input id="damage-grid" name="damage-grid" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="damage-spiral-item" style="display:none;">
                            <label for="damage-spiral">Damage Spiral:</label>
                            <input id="damage-spiral" name="damage-spiral" is="iron-input" />
                        </paper-input-container>
                        <paper-select-container id="animus-known-item" style="display:none;">
                            <label for="animus-known">Animus Known:</label>
                            <select name="animus-known">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($animusList as $animus): ?>
                                    <option value="<?php echo $animus['name'] ?>"><?php echo $animus['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-input-container id="mount-item">
                            <label for="mount">Mount POW:</label>
                            <input id="mount" name="mount" onChange="reveal('#mount-ability-item');" is="iron-input" />
                        </paper-input-container>
                        <paper-select-container id="mount-ability-item" style="display:none;">
                            <label for="mount-ability">Mount Abiliy:</label>
                            <select name="mount-ability" onChange="reveal('#mount-ability-2-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="mount-ability-2-item" style="display:none;">
                            <label for="mount-ability-2">Mount Abiliy 2:</label>
                            <select name="mount-ability-2">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="base-size-item">
                            <label for="base-size">Base Size:</label>
                            <select name="base-size">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($baseSizesList as $base): ?>
                                    <option value="<?php echo $base['base_size'] ?>"><?php echo $base['base_size'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon1-item">
                            <label for="weapon1">Weapon 1:</label>
                            <select name="weapon1" onChange="reveal('#weapon2-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>"><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon2-item" style="display:none;">
                            <label for="weapon2">Weapon 2:</label>
                            <select name="weapon2" onChange="reveal('#weapon3-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>"><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon3-item" style="display:none;">
                            <label for="weapon3">Weapon 3:</label>
                            <select name="weapon3" onChange="reveal('#weapon4-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>"><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon4-item" style="display:none;">
                            <label for="weapon4">Weapon 4:</label>
                            <select name="weapon4" onChange="reveal('#weapon5-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>"><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon5-item" style="display:none;">
                            <label for="weapon5">Weapon 5:</label>
                            <select name="weapon5">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>"><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability1-item">
                            <label for="special-ability1">Special Ability / Action 1:</label>
                            <select name="special-ability1" onChange="reveal('#special-ability2-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability2-item" style="display:none;">
                            <label for="special-ability2">Special Ability / Action 2:</label>
                            <select name="special-ability2" onChange="reveal('#special-ability3-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability3-item" style="display:none;">
                            <label for="special-ability3">Special Ability / Action 3:</label>
                            <select name="special-ability3" onChange="reveal('#special-ability4-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability4-item" style="display:none;">
                            <label for="special-ability4">Special Ability / Action 4:</label>
                            <select name="special-ability4" onChange="reveal('#special-ability5-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability5-item" style="display:none;">
                            <label for="special-ability5">Special Ability / Action 5:</label>
                            <select name="special-ability5" onChange="reveal('#special-ability6-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability6-item" style="display:none;">
                            <label for="special-ability6">Special Ability / Action 6:</label>
                            <select name="special-ability6" onChange="reveal('#special-ability7-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability7-item" style="display:none;">
                            <label for="special-ability7">Special Ability / Action 7:</label>
                            <select name="special-ability7" onChange="reveal('#special-ability8-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability8-item" style="display:none;">
                            <label for="special-ability8">Special Ability / Action 8:</label>
                            <select name="special-ability8" onChange="reveal('#special-ability9-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability9-item" style="display:none;">
                            <label for="special-ability9">Special Ability / Action 9:</label>
                            <select name="special-ability9" onChange="reveal('#special-ability10-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability10-item" style="display:none;">
                            <label for="special-ability10">Special Ability / Action 10:</label>
                            <select name="special-ability10">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>"><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell1-item" style="display:none;">
                            <label for="spell1">Spell 1:</label>
                            <select name="spell1" onChange="reveal('#spell2-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell2-item" style="display:none;">
                            <label for="spell2">Spell 2:</label>
                            <select name="spell2" onChange="reveal('#spell3-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell3-item" style="display:none;">
                            <label for="spell3">Spell 3:</label>
                            <select name="spell3" onChange="reveal('#spell4-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell4-item" style="display:none;">
                            <label for="spell4">Spell 4:</label>
                            <select name="spell4" onChange="reveal('#spell5-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell5-item" style="display:none;">
                            <label for="spell5">Spell 5:</label>
                            <select name="spell5" onChange="reveal('#spell6-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell6-item" style="display:none;">
                            <label for="spell6">Spell 6:</label>
                            <select name="spell6" onChange="reveal('#spell7-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell7-item" style="display:none;">
                            <label for="spell7">Spell 7:</label>
                            <select name="spell7" onChange="reveal('#spell8-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell8-item" style="display:none;">
                            <label for="spell8">Spell 8:</label>
                            <select name="spell8" onChange="reveal('#spell9-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell9-item" style="display:none;">
                            <label for="spell9">Spell 9:</label>
                            <select name="spell9" onChange="reveal('#spell10-item');">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell10-item" style="display:none;">
                            <label for="spell10">Spell 10:</label>
                            <select name="spell10">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>"><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-input-container id="feat-item" style="display:none;">
                            <label for="feat">Feat:</label>
                            <textarea id="feat" name="feat"></textarea>
                        </paper-input-container>
                        <paper-input-container id="attached-to-item">
                            <label for="attached-to">Attached To: ex. Unit Name|Next Unit Name</label>
                            <input id="attached-to" name="attached-to" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="companion-item">
                            <label for="companion">Companion: ex. Unit Name|Next Unit Name</label>
                            <input id="companion" name="companion" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="leader-item">
                            <label for="leader">Leader: ex. Unit Name|Next Unit Name or 'included' for generic leader</label>
                            <input id="leader" name="leader" is="iron-input" />
                        </paper-input-container>
                        <paper-button raised class="full-width-button" onclick="submitForm('#unit-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .unit').addClass('active');
    });
</script>
</body>
</html>
