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
    $unit = $allUnits->getUnitByName($_GET['name']);
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
    <title>Edit Unit / Models - RoHo.in Admin Panel</title>
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
                <h1 class="full-page-title">Edit Unit/Model <?php echo $unit['name']; ?></h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block-tools cushion">
                <paper-material elevation="1" class="cushion">
                    <form action="unit-edit-save.php" method="post" id="unit-edit-form">
                        <h3>Edit <?php echo $unit['name'] ?>:</h3>
                        <paper-select-container>
                            <label for="unit-type">Model Type:</label>
                            <select name="unit-type" id="unit-type" onChange="unitSelected();">
                                <option selected value="">Please Select</option>
                                <?php foreach ($unitTypesList as $unitType): ?>
                                    <option value="<?php echo $unitType['name']?>" <?php if ($unit['type'] == $unitType['name']){echo 'selected';} ?>><?php echo $unitType['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container>
                            <label for="faction">Faction:</label>
                            <select name="faction" id="faction" onChange="factionSelected();">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($factionsList as $faction): ?>
                                    <option value="<?php echo $faction['name']?>" <?php if ($unit['faction'] == $faction['name']){echo 'selected';}?>><?php echo $faction['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id ="related-faction-item">
                            <label for="related-faction">Related Factions:</label><br />
                            <?php foreach ($factionsList as $faction): ?>
                                <input type="checkbox" name="related-faction[]" value="<?php echo $faction['name'] ?>" <?php if ($unit['related_factions'] == $faction['name']){echo 'checked';}?> /> <?php echo $faction['name']; ?><br />
                            <?php endforeach; ?>
                            <paper-checkbox checked onclick="toggleCheckInCheckbox('#no-faction')">None</paper-checkbox><br />
                            <input type="checkbox" name="related-faction[]" id="no-faction" class="hidden" value="" checked/>
                        </paper-select-container>
                        <paper-input-container>
                            <label for="name">Model / Unit Name:</label>
                            <input required id="name" name="name" value="<?php echo $unit['name'] ?>" readonly class="readonly" is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="title">Title:</label>
                            <input required id="title" name="title" <?php if (isset($unit['title'])){echo 'value="'.$unit['title'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="cost">Cost:</label>
                            <input required id="cost" name="cost" <?php if (isset($unit['cost'])){echo 'value="'.$unit['cost'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container>
                            <label for="field-allowance">Field Allowance:</label>
                            <input required id="field-allowance" name="field-allowance" <?php if (isset($unit['field_allowance'])){echo 'value="'.$unit['field_allowance'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="bg-points-item">
                            <label for="bg-points">Battle Group Points:</label>
                            <input id="bg-points" name="bg-points" <?php if (isset($unit['bg_points'])){echo 'value="'.$unit['bg_points'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="purchase-low-item">
                            <label for="purchase-low">Unit Minimum Model Count:</label>
                            <input id="purchase-low" name="purchase-low" <?php if (isset($unit['purchased_low'])){echo 'value="'.$unit['purchased_low'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="purchase-high-item">
                            <label for="purchase-high">Unit Maximum Model Count:</label>
                            <input id="purchase-high" name="purchase-high" <?php if (isset($unit['purchased_high'])){echo 'value="'.$unit['purchased_high'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="focus-item">
                            <label for="focus">Focus:</label>
                            <input id="focus" name="focus" <?php if (isset($unit['focus'])){echo 'value="'.$unit['focus'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="fury-item">
                            <label for="fury">Fury:</label>
                            <input id="fury" name="fury" <?php if (isset($unit['fury'])){echo 'value="'.$unit['fury'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="threshold-item">
                            <label for="threshold">Threshold:</label>
                            <input id="threshold" name="threshold" <?php if (isset($unit['threshold'])){echo 'value="'.$unit['threshold'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="spd-item">
                            <label for="spd">Speed:</label>
                            <input id="spd" name="spd" <?php if (isset($unit['spd'])){echo 'value="'.$unit['spd'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="str-item">
                            <label for="str">Strength:</label>
                            <input id="str" name="str" <?php if (isset($unit['str'])){echo 'value="'.$unit['str'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="mat-item">
                            <label for="mat">Melee Attack:</label>
                            <input id="mat" name="mat" <?php if (isset($unit['mat'])){echo 'value="'.$unit['mat'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="rat-item">
                            <label for="rat">Ranged Attack:</label>
                            <input id="rat" name="rat" <?php if (isset($unit['rat'])){echo 'value="'.$unit['rat'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="def-item">
                            <label for="def">Defense:</label>
                            <input id="def" name="def" <?php if (isset($unit['def'])){echo 'value="'.$unit['def'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="arm-item">
                            <label for="arm">Armor:</label>
                            <input id="arm" name="arm" <?php if (isset($unit['arm'])){echo 'value="'.$unit['arm'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="cmd-item">
                            <label for="cmd">Command:</label>
                            <input id="cmd" name="cmd" <?php if (isset($unit['cmd'])){echo 'value="'.$unit['cmd'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="damage-boxes-item">
                            <label for="damage-boxes">Damage Boxes:</label>
                            <input id="damage-boxes" name="damage-boxes" <?php if (isset($unit['damage_boxes'])){echo 'value="'.$unit['damage_boxes'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="damage-grid-item">
                            <label for="damage-grid">Damage Grid:</label>
                            <input id="damage-grid" name="damage-grid" <?php if (isset($unit['damage_grid'])){echo 'value="'.$unit['damage_grid'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="damage-spiral-item">
                            <label for="damage-spiral">Damage Spiral:</label>
                            <input id="damage-spiral" name="damage-spiral" <?php if (isset($unit['damage_spiral'])){echo 'value="'.$unit['damage_spiral'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-select-container id="animus-known-item">
                            <label for="animus-known">Animus Known:</label>
                            <select name="animus-known">
                                <option value="" <?php if (!isset($unit['animus_known'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($animusList as $animus): ?>
                                    <option value="<?php echo $animus['name'] ?>" <?php if ($unit['animus_known'] == $animus['name']){echo 'selected';} ?>><?php echo $animus['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-input-container id="mount-item">
                            <label for="mount">Mount POW:</label>
                            <input id="mount" name="mount" <?php if (isset($unit['mount'])){echo 'value="'.$unit['mount'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-select-container id="mount-ability-item">
                            <label for="mount-ability">Mount Abiliy:</label>
                            <select name="mount-ability">
                                <option value="" <?php if (!isset($unit['mount_ability'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['mount_ability'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="mount-ability-2-item">
                            <label for="mount-ability-2">Mount Abiliy 2:</label>
                            <select name="mount-ability-2">
                                <option value="" <?php if (!isset($unit['mount_ability_2'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['mount_ability_2'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="base-size-item">
                            <label for="base-size">Base Size:</label>
                            <select name="base-size">
                                <?php foreach ($baseSizesList as $base): ?>
                                    <option value="<?php echo $base['base_size'] ?>" <?php if ($unit['base_size'] == $base['base_size']){echo 'selected';} ?>><?php echo $base['base_size'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon1-item">
                            <label for="weapon1">Weapon 1:</label>
                            <select name="weapon1">
                                <option value="" <?php if (!isset($unit['weapon1'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>" <?php if ($unit['weapon1'] == $weapon['name']){echo 'selected';} ?>><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon2-item">
                            <label for="weapon2">Weapon 2:</label>
                            <select name="weapon2">
                                <option value="" <?php if (!isset($unit['weapon2'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>" <?php if ($unit['weapon2'] == $weapon['name']){echo 'selected';} ?>><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon3-item">
                            <label for="weapon3">Weapon 3:</label>
                            <select name="weapon3">
                                <option value="" <?php if (!isset($unit['weapon3'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>" <?php if ($unit['weapon3'] == $weapon['name']){echo 'selected';} ?>><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon4-item">
                            <label for="weapon4">Weapon 4:</label>
                            <select name="weapon4">
                                <option value="" <?php if (!isset($unit['weapon4'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>" <?php if ($unit['weapon4'] == $weapon['name']){echo 'selected';} ?>><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="weapon5-item">
                            <label for="weapon5">Weapon 5:</label>
                            <select name="weapon5">
                                <option value="" <?php if (!isset($unit['weapon5'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($weaponsList as $weapon): ?>
                                    <option value="<?php echo $weapon['name'] ?>" <?php if ($unit['weapon5'] == $weapon['name']){echo 'selected';} ?>><?php echo $weapon['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability1-item">
                            <label for="special-ability1">Special Ability / Action 1:</label>
                            <select name="special-ability1">
                                <option value="" <?php if (!isset($unit['special_ability_1'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_1'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability2-item">
                            <label for="special-ability2">Special Ability / Action 2:</label>
                            <select name="special-ability2">
                                <option value="" <?php if (!isset($unit['special_ability_2'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_2'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability3-item">
                            <label for="special-ability3">Special Ability / Action 3:</label>
                            <select name="special-ability3">
                                <option value="" <?php if (!isset($unit['special_ability_3'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_3'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability4-item">
                            <label for="special-ability4">Special Ability / Action 4:</label>
                            <select name="special-ability4">
                                <option value="" <?php if (!isset($unit['special_ability_4'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_4'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability5-item">
                            <label for="special-ability5">Special Ability / Action 5:</label>
                            <select name="special-ability5">
                                <option value="" <?php if (!isset($unit['special_ability_5'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_5'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability6-item">
                            <label for="special-ability6">Special Ability / Action 6:</label>
                            <select name="special-ability6">
                                <option value="" <?php if (!isset($unit['special_ability_6'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_6'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability7-item">
                            <label for="special-ability7">Special Ability / Action 7:</label>
                            <select name="special-ability7">
                                <option value="" <?php if (!isset($unit['special_ability_7'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_7'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability8-item">
                            <label for="special-ability8">Special Ability / Action 8:</label>
                            <select name="special-ability8">
                                <option value="" <?php if (!isset($unit['special_ability_8'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_8'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability9-item">
                            <label for="special-ability9">Special Ability / Action 9:</label>
                            <select name="special-ability9">
                                <option value="" <?php if (!isset($unit['special_ability_9'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_9'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="special-ability10-item">
                            <label for="special-ability10">Special Ability / Action 10:</label>
                            <select name="special-ability10">
                                <option value="" <?php if (!isset($unit['special_ability_10'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($abilitiesList as $ability): ?>
                                    <option value="<?php echo $ability['name'] ?>" <?php if ($unit['special_ability_10'] == $ability['name']){echo 'selected';} ?>><?php echo $ability['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell1-item">
                            <label for="spell1">Spell 1:</label>
                            <select name="spell1">
                                <option value="" <?php if (!isset($unit['spell_1'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_1'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell2-item">
                            <label for="spell2">Spell 2:</label>
                            <select name="spell2">
                                <option value="" <?php if (!isset($unit['spell_2'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_2'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell3-item">
                            <label for="spell3">Spell 3:</label>
                            <select name="spell3">
                                <option value="" <?php if (!isset($unit['spell_3'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_3'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell4-item">
                            <label for="spell4">Spell 4:</label>
                            <select name="spell4">
                                <option value="" <?php if (!isset($unit['spell_4'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_4'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell5-item">
                            <label for="spell5">Spell 5:</label>
                            <select name="spell5">
                                <option value="" <?php if (!isset($unit['spell_5'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_5'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell6-item">
                            <label for="spell6">Spell 6:</label>
                            <select name="spell6">
                                <option value="" <?php if (!isset($unit['spell_6'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_6'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell7-item">
                            <label for="spell7">Spell 7:</label>
                            <select name="spell7">
                                <option value="" <?php if (!isset($unit['spell_7'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_7'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell8-item">
                            <label for="spell8">Spell 8:</label>
                            <select name="spell8">
                                <option value="" <?php if (!isset($unit['spell_8'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_8'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell9-item">
                            <label for="spell9">Spell 9:</label>
                            <select name="spell9">
                                <option value="" <?php if (!isset($unit['spell_9'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_9'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-select-container id="spell10-item">
                            <label for="spell10">Spell 10:</label>
                            <select name="spell10">
                                <option value="" <?php if (!isset($unit['spell_10'])){echo 'selected';} ?>>None</option>
                                <?php foreach ($spellsKnownList as $spell): ?>
                                    <option value="<?php echo $spell['name'] ?>" <?php if ($unit['spell_10'] == $spell['name']){echo 'selected';} ?>><?php echo $spell['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </paper-select-container>
                        <paper-input-container id="feat-item">
                            <label>Feat:</label>
                            <textarea id="feat" name="feat">
                                <?php if (isset($unit['feat'])){echo $unit['feat'];}?>
                            </textarea>
                        </paper-input-container>
                        <paper-input-container id="attached-to-item">
                            <label for="attached-to">Attached To: ex. Unit Name|Next Unit Name</label>
                            <input id="attached-to" name="attached-to" <?php if (isset($unit['attached_to'])){echo 'value="'.$unit['attached_to'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="companion-item">
                            <label for="companion">Companion: ex. Unit Name|Next Unit Name</label>
                            <input id="companion" name="companion" <?php if (isset($unit['companion'])){echo 'value="'.$unit['companion'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-input-container id="leader-item">
                            <label for="leader">Leader: ex. Unit Name|Next Unit Name or 'included' for generic leader</label>
                            <input id="leader" name="leader" <?php if (isset($unit['unit_leader'])){echo 'value="'.$unit['unit_leader'].'"';}?> is="iron-input" />
                        </paper-input-container>
                        <paper-button raised class="full-width-button" onclick="submitForm('#unit-edit-form')">Submit</paper-button>
                    </form>
                </paper-material>
            </div>
            <paper-fab mini icon="arrow-back" class="fixed-fab link-out" data-src="/admin/builder/unit.php"></paper-fab>
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
