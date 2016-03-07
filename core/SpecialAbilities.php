<?php

class AllSpecialAbilities extends AllCore
{	
	function getAllSpecialAbilities(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM special_abilities ORDER BY name";
		$specialAbilitiesResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$specialAbilities = "SELECT * FROM special_abilities ORDER BY name";
		//$specialAbilitiesResult = $conn->query($specialAbilities);
		$specialAbilitiesBuild = '';
		if ($specialAbilitiesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $specialAbilitiesResult->fetch_assoc()) {
				$specialAbilitiesBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $specialAbilitiesBuild;
	}

	/**
	 * @return string
	 */
	function getAllSpecialAbilitiesName(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT name FROM special_abilities ORDER BY name";
		$specialAbilitiesResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$specialAbilities = "SELECT name FROM special_abilities ORDER BY name";
		//$specialAbilitiesResult = $conn->query($specialAbilities);
		$specialAbilitiesBuild = '';
		if ($specialAbilitiesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $specialAbilitiesResult->fetch_assoc()) {
				$specialAbilitiesBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $specialAbilitiesBuild;
	}

	/**
	 * @param $name
	 * @return string
	 */
	function getAbilityByName($name){
		//$conn = $this->connect();
		$name = "'".$name."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM special_abilities WHERE name = ".$name;
		$abilityResult = $mysqli->query($sql_query);

		//$ability = "SELECT * FROM special_abilities WHERE name = ".$name;
		//$abilityResult = $conn->query($ability);
		$abilityBuild = '';
		if ($abilityResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $abilityResult->fetch_assoc()) {
				$abilityBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $abilityBuild;
	}

	/**
	 * @param $name
	 * @param $description
	 * @param $immunity
	 * @param $damageType
	 * @param $continuousEffect
	 * @param $offSpdMod
	 * @param $offStrMod
	 * @param $offMatMod
	 * @param $offRatMod
	 * @param $offDefMod
	 * @param $offArmMod
	 * @param $weaponRangeMod
	 */
	function saveSpecialAbilities($name, $description, $immunity, $damageType, $continuousEffect, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $weaponRangeMod){
		//$conn = $this->connect();
		
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

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "INSERT INTO special_abilities (name, description_text, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, immunity, damage_type, continouous_effect, weapon_range_mod)
		VALUES (".$name.", ".$description.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$immunity.", ".$damageType.", ".$continuousEffect.", ".$weaponRangeMod.")";

		//$sql = "INSERT INTO special_abilities (name, description_text, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, immunity, damage_type, continouous_effect, weapon_range_mod)
		//VALUES (".$name.", ".$description.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$immunity.", ".$damageType.", ".$continuousEffect.", ".$weaponRangeMod.")";
		
		if ($mysqli->query($sql_query) === TRUE) {
			echo "New record created successfully<br>";
		}

		//mysqli_close($conn); //$conn->close();
	}

	/**
	 * @param $name
	 * @param $description
	 * @param $immunity
	 * @param $damageType
	 * @param $continuousEffect
	 * @param $offSpdMod
	 * @param $offStrMod
	 * @param $offMatMod
	 * @param $offRatMod
	 * @param $offDefMod
	 * @param $offArmMod
	 * @param $weaponRangeMod
	 */
	function updateSpecialAbility($name, $description, $immunity, $damageType, $continuousEffect, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $weaponRangeMod){
		//$conn = $this->connect();
		
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

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "UPDATE special_abilities
		SET description_text=".$description.", off_spd_mod=".$offSpdMod.", off_str_mod=".$offStrMod.", off_mat_mod=".$offMatMod.", off_rat_mod=".$offRatMod.", off_def_mod=".$offDefMod.", off_arm_mod=".$offArmMod.", immunity=".$immunity.", damage_type=".$damageType.", continouous_effect=".$continuousEffect.", weapon_range_mod=".$weaponRangeMod."
		WHERE name=".$name."";

		//$sql = "INSERT INTO special_abilities (name, description_text, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, immunity, damage_type, continouous_effect, weapon_range_mod)
		//VALUES (".$name.", ".$description.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$immunity.", ".$damageType.", ".$continuousEffect.", ".$weaponRangeMod.")";
		//$sql = "UPDATE special_abilities
		//SET description_text=".$description.", off_spd_mod=".$offSpdMod.", off_str_mod=".$offStrMod.", off_mat_mod=".$offMatMod.", off_rat_mod=".$offRatMod.", off_def_mod=".$offDefMod.", off_arm_mod=".$offArmMod.", immunity=".$immunity.", damage_type=".$damageType.", continouous_effect=".$continuousEffect.", weapon_range_mod=".$weaponRangeMod."
		//WHERE name=".$name."";
		if ($mysqli->query($sql_query) === TRUE) {
			echo "Record updated successfully<br>";
		}

		//mysqli_close($conn); //$conn->close();
	}
}
