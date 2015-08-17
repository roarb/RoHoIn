<?php 

include '../core/Core.php';
include '../core/Weapons.php';
include '../core/AnimusKnown.php';
include '../core/SpecialAbilities.php';
include '../core/SpellsKnown.php';

$allWeapons = new AllWeapons;
$weaponList = $allWeapons->getAllWeapons();

$allSpecialAbilities = new AllSpecialAbilities();
$specialAbilitiesList = $allSpecialAbilities->getAllSpecialAbilities();

$allCore = new AllCore;
$allCoreBuild = $allCore->getAllCore();

$i = 0;
foreach ($allCoreBuild as $coreBuild){
	if ($coreBuild['weapon1']){
		$x = $allCore->weaponBuilder($coreBuild['weapon1'], $weaponList);
		$allCoreBuild[$i]['weapon1'] = $x;
	}
	if ($coreBuild['weapon2']){
		$x = $allCore->weaponBuilder($coreBuild['weapon2'], $weaponList);
		$allCoreBuild[$i]['weapon2'] = $x;
	}
	if ($coreBuild['weapon3']){
		$x = $allCore->weaponBuilder($coreBuild['weapon3'], $weaponList);
		$allCoreBuild[$i]['weapon3'] = $x;
	}
	if ($coreBuild['weapon4']){
		$x = $allCore->weaponBuilder($coreBuild['weapon4'], $weaponList);
		$allCoreBuild[$i]['weapon4'] = $x;
	}
	if ($coreBuild['weapon5']){
		$x = $allCore->weaponBuilder($coreBuild['weapon5'], $weaponList);
		$allCoreBuild[$i]['weapon5'] = $x;
	}
	if ($coreBuild['special_ability_1']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_1'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_1'] = $x;
	}
	if ($coreBuild['special_ability_2']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_2'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_2'] = $x;
	}
	if ($coreBuild['special_ability_3']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_3'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_3'] = $x;
	}
	if ($coreBuild['special_ability_4']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_4'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_4'] = $x;
	}
	if ($coreBuild['special_ability_5']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_5'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_5'] = $x;
	}
	if ($coreBuild['special_ability_6']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_6'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_6'] = $x;
	}
	if ($coreBuild['special_ability_7']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_7'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_7'] = $x;
	}
	if ($coreBuild['special_ability_8']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_8'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_8'] = $x;
	}
	if ($coreBuild['special_ability_9']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_9'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_9'] = $x;
	}
	if ($coreBuild['special_ability_10']){
		$x = $allCore->specialAbilitiesBuilder($coreBuild['special_ability_10'], $specialAbilitiesList);
		$allCoreBuild[$i]['special_ability_10'] = $x;
	}

	$i++;
}

var_dump($allCoreBuild);

?>
