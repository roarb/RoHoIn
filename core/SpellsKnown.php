<?php

class AllSpellsKnown extends AllCore
{
	/**
	 * @return string
	 */
	function getAllSpells(){
		$conn = $this->connect();
		
		$spells = "SELECT * FROM spells_known ORDER BY name";
		$spellsResult = $conn->query($spells);
		$spellsBuild = '';
		if ($spellsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $spellsResult->fetch_assoc()) {
				$spellsBuild[$i] = $row;
				$i++;
			}
		}
		return $spellsBuild;
	}

	/**
	 * @return string
	 */
	function getAllSpellsName(){
		$conn = $this->connect();
		
		$spells = "SELECT name FROM spells_known ORDER BY name";
		$spellsResult = $conn->query($spells);
		$spellsBuild = '';
		if ($spellsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $spellsResult->fetch_assoc()) {
				$spellsBuild[$i] = $row;
				$i++;
			}
		}
		return $spellsBuild;
	}

	/**
	 * @param $name
	 * @return string
	 */
	function getSpellByName($name){
		$conn = $this->connect();
		$name = "'".$name."'";
		$spell = "SELECT * FROM spells_known WHERE name = ".$name;
		$spellResult = $conn->query($spell);
		$spellBuild = '';
		if ($spellResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $spellResult->fetch_assoc()) {
				$spellBuild[$i] = $row;
				$i++;
			}
		} 
		return $spellBuild;
	}

	/**
	 * @param $name
	 * @param $description
	 * @param $cost
	 * @param $range
	 * @param $aoe
	 * @param $pow
	 * @param $upkeep
	 * @param $offensive
	 * @param $specialAbility1
	 * @param $specialAbility2
	 * @param $offSpdMod
	 * @param $offStrMod
	 * @param $offMatMod
	 * @param $offRatMod
	 * @param $offDefMod
	 * @param $offArmMod
	 * @param $duration
	 */
	function saveSpells($name, $description, $cost, $range, $aoe, $pow, $upkeep, $offensive, $specialAbility1, $specialAbility2, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $duration){
		$conn = $this->connect();
		
		$name = "'".$name."'";
		$upkeep = "'".$upkeep."'";
		$offensive = "'".$offensive."'";
		if ($description == ''){$description = 'NULL';} else {
			$description = str_replace("'", "\'", $description);
			$description = "'".$description."'";
			}
		if ($cost == ''){$cost = 'NULL';} else {$cost = "'".$cost."'";}
		if ($range == ''){$range = 'NULL';} else {$range = "'".$range."'";}
		if ($aoe == ''){$aoe = 'NULL';} else {$aoe = "'".$aoe."'";}
		if ($pow == ''){$pow = 'NULL';} else {$pow = "'".$pow."'";}
		if ($specialAbility1 == ''){$specialAbility1 = 'NULL';} else {$specialAbility1 = "'".$specialAbility1."'";}
		if ($specialAbility2 == ''){$specialAbility2 = 'NULL';} else {$specialAbility2 = "'".$specialAbility2."'";}
		if ($offSpdMod == ''){$offSpdMod = 'NULL';} else {$offSpdMod = "'".$offSpdMod."'";}
		if ($offStrMod == ''){$offStrMod = 'NULL';} else {$offStrMod = "'".$offStrMod."'";}
		if ($offMatMod == ''){$offMatMod = 'NULL';} else {$offMatMod = "'".$offMatMod."'";}
		if ($offRatMod == ''){$offRatMod = 'NULL';} else {$offRatMod = "'".$offRatMod."'";}
		if ($offDefMod == ''){$offDefMod = 'NULL';} else {$offDefMod = "'".$offDefMod."'";}
		if ($offArmMod == ''){$offArmMod = 'NULL';} else {$offArmMod = "'".$offArmMod."'";}
		if ($duration == ''){$duration = 'NULL';} else{$duration = "'".$duration."'";}
		
		$sql = "INSERT INTO spells_known (name, description, cost, range_distance, aoe, pow, upkeep, offensive, ability_granted, second_ability_granted, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, duration)
		VALUES (".$name.", ".$description.", ".$cost.", ".$range.", ".$aoe.", ".$pow.", ".$upkeep.", ".$offensive.", ".$specialAbility1.", ".$specialAbility2.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$duration.")";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		}
		
		$conn->close();		
	}

	/**
	 * @param $name
	 * @param $description
	 * @param $cost
	 * @param $range
	 * @param $aoe
	 * @param $pow
	 * @param $upkeep
	 * @param $offensive
	 * @param $specialAbility1
	 * @param $specialAbility2
	 * @param $offSpdMod
	 * @param $offStrMod
	 * @param $offMatMod
	 * @param $offRatMod
	 * @param $offDefMod
	 * @param $offArmMod
	 * @param $duration
	 */
	function updateSpell($name, $description, $cost, $range, $aoe, $pow, $upkeep, $offensive, $specialAbility1, $specialAbility2, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $duration){
		$conn = $this->connect();
		
		$name = "'".$name."'";
		$upkeep = "'".$upkeep."'";
		$offensive = "'".$offensive."'";
		if ($description == ''){$description = 'NULL';} else {
			$description = str_replace("'", "\'", $description);
			$description = "'".$description."'";
			}
		if ($cost == ''){$cost = 'NULL';} else {$cost = "'".$cost."'";}
		if ($range == ''){$range = 'NULL';} else {$range = "'".$range."'";}
		if ($aoe == ''){$aoe = 'NULL';} else {$aoe = "'".$aoe."'";}
		if ($pow == ''){$pow = 'NULL';} else {$pow = "'".$pow."'";}
		if ($specialAbility1 == ''){$specialAbility1 = 'NULL';} else {$specialAbility1 = "'".$specialAbility1."'";}
		if ($specialAbility2 == ''){$specialAbility2 = 'NULL';} else {$specialAbility2 = "'".$specialAbility2."'";}
		if ($offSpdMod == ''){$offSpdMod = 'NULL';} else {$offSpdMod = "'".$offSpdMod."'";}
		if ($offStrMod == ''){$offStrMod = 'NULL';} else {$offStrMod = "'".$offStrMod."'";}
		if ($offMatMod == ''){$offMatMod = 'NULL';} else {$offMatMod = "'".$offMatMod."'";}
		if ($offRatMod == ''){$offRatMod = 'NULL';} else {$offRatMod = "'".$offRatMod."'";}
		if ($offDefMod == ''){$offDefMod = 'NULL';} else {$offDefMod = "'".$offDefMod."'";}
		if ($offArmMod == ''){$offArmMod = 'NULL';} else {$offArmMod = "'".$offArmMod."'";}
		if ($duration == ''){$duration = 'NULL';} else{$duration = "'".$duration."'";}
				
		$sql = "UPDATE spells_known 
		SET description=".$description.", cost=".$cost.", range_distance=".$range.", aoe=".$aoe.", pow=".$pow.", upkeep=".$upkeep.", offensive=".$offensive.", ability_granted=".$specialAbility1.", second_ability_granted=".$specialAbility2.", off_spd_mod=".$offSpdMod.", off_str_mod=".$offStrMod.", off_mat_mod=".$offMatMod.", off_rat_mod=".$offRatMod.", off_def_mod=".$offDefMod.", off_arm_mod=".$offArmMod.", duration=".$duration." 
		WHERE name=".$name."";
		
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully<br>";
		}
		$conn->close();		
	}
}
