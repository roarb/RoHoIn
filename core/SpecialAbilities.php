<?php

class AllSpecialAbilities
{	
	function getAllSpecialAbilities(){
		$core = new AllCore();
		$conn = $core->connect();
		
		$specialAbilities = "SELECT * FROM special_abilities ORDER BY name";
		$specialAbilitiesResult = $conn->query($specialAbilities);
		$specialAbilitiesBuild = '';
		if ($specialAbilitiesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $specialAbilitiesResult->fetch_assoc()) {
				$specialAbilitiesBuild[$i] = $row;
				$i++;
			}
		} else {
			echo "0 results";
		}
		return $specialAbilitiesBuild;
	}
	
	function getAllSpecialAbilitiesName(){
		$core = new AllCore();
		$conn = $core->connect();
		
		$specialAbilities = "SELECT name FROM special_abilities ORDER BY name";
		$specialAbilitiesResult = $conn->query($specialAbilities);
		$specialAbilitiesBuild = '';
		if ($specialAbilitiesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $specialAbilitiesResult->fetch_assoc()) {
				$specialAbilitiesBuild[$i] = $row;
				$i++;
			}
		} else {
			echo "0 results";
		}
		return $specialAbilitiesBuild;
	}
	
	function getAbilityByName($name){
		$core = new AllCore();
		$conn = $core->connect();
		$name = "'".$name."'";
		$ability = "SELECT * FROM special_abilities WHERE name = ".$name."";
		$abilityResult = $conn->query($ability);
		$abilityBuild = '';
		if ($abilityResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $abilityResult->fetch_assoc()) {
				$abilityBuild[$i] = $row;
				$i++;
			}
		} 
		return $abilityBuild;
	}
	
	function saveSpecialAbilities($name, $description, $immunity, $damageType, $continuousEffect, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $weaponRangeMod){
		$core = new AllCore();
		$conn = $core->connect();
		
		$name = "'".$name."'";
		if ($description == ''){$description = 'NULL';} else {
			$description = str_replace("'", "\'", $description);
			$description = "'".$description."'";
			}
		if ($immunity == ''){$immunity = 'NULL';} else {$immunity = "'".$immunity."'";}
		if ($damageType == ''){$damageType = 'NULL';} else {$damageType = "'".$damageType."'";}
		if ($continuousEffect == ''){$continuousEffect = 'NULL';} else {$continuousEffect = "'".$continuousEffect."'";}
		if ($offSpdMod == ''){$offSpdMod = 'NULL';} else {$offSpdMod = "'".$offSpdMod."'";}
		if ($offStrMod == ''){$offStrMod = 'NULL';} else {$offStrMod = "'".$offStrMod."'";}
		if ($offMatMod == ''){$offMatMod = 'NULL';} else {$offMatMod = "'".$offMatMod."'";}
		if ($offRatMod == ''){$offRatMod = 'NULL';} else {$offRatMod = "'".$offRatMod."'";}
		if ($offDefMod == ''){$offDefMod = 'NULL';} else {$offDefMod = "'".$offDefMod."'";}
		if ($offArmMod == ''){$offArmMod = 'NULL';} else {$offArmMod = "'".$offArmMod."'";}
		if ($weaponRangeMod == ''){$weaponRangeMod = 'NULL';} else {$weaponRangeMod = "'".$weaponRangeMod."'";}
		
		$sql = "INSERT INTO special_abilities (name, description_text, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, immunity, damage_type, continouous_effect, weapon_range_mod)
		VALUES (".$name.", ".$description.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$immunity.", ".$damageType.", ".$continuousEffect.", ".$weaponRangeMod.")";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();		
	}
	
	function updateSpecialAbility($name, $description, $immunity, $damageType, $continuousEffect, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $weaponRangeMod){
		$core = new AllCore();
		$conn = $core->connect();
		
		$name = "'".$name."'";
		if ($description == ''){$description = 'NULL';} else {
			$description = str_replace("'", "\'", $description);
			$description = "'".$description."'";
			}
		if ($immunity == ''){$immunity = 'NULL';} else {$immunity = "'".$immunity."'";}
		if ($damageType == ''){$damageType = 'NULL';} else {$damageType = "'".$damageType."'";}
		if ($continuousEffect == ''){$continuousEffect = 'NULL';} else {$continuousEffect = "'".$continuousEffect."'";}
		if ($offSpdMod == ''){$offSpdMod = 'NULL';} else {$offSpdMod = "'".$offSpdMod."'";}
		if ($offStrMod == ''){$offStrMod = 'NULL';} else {$offStrMod = "'".$offStrMod."'";}
		if ($offMatMod == ''){$offMatMod = 'NULL';} else {$offMatMod = "'".$offMatMod."'";}
		if ($offRatMod == ''){$offRatMod = 'NULL';} else {$offRatMod = "'".$offRatMod."'";}
		if ($offDefMod == ''){$offDefMod = 'NULL';} else {$offDefMod = "'".$offDefMod."'";}
		if ($offArmMod == ''){$offArmMod = 'NULL';} else {$offArmMod = "'".$offArmMod."'";}
		if ($weaponRangeMod == ''){$weaponRangeMod = 'NULL';} else {$weaponRangeMod = "'".$weaponRangeMod."'";}
		
		$sql = "INSERT INTO special_abilities (name, description_text, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, immunity, damage_type, continouous_effect, weapon_range_mod)
		VALUES (".$name.", ".$description.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$immunity.", ".$damageType.", ".$continuousEffect.", ".$weaponRangeMod.")";
		$sql = "UPDATE special_abilities 
		SET description_text=".$description.", off_spd_mod=".$offSpdMod.", off_str_mod=".$offStrMod.", off_mat_mod=".$offMatMod.", off_rat_mod=".$offRatMod.", off_def_mod=".$offDefMod.", off_arm_mod=".$offArmMod.", immunity=".$immunity.", damage_type=".$damageType.", continouous_effect=".$continuousEffect.", weapon_range_mod=".$weaponRangeMod." 
		WHERE name=".$name."";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();		
	}
}

?>