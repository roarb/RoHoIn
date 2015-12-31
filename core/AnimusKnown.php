<?php

class AllAnimusKnown extends AllCore
{
	/**
	 * @return string
	 */
	function getAllAnimus(){
		$core = new AllCore();
		$conn = $core->connect();
		
		$animus = "SELECT * FROM animus_known ORDER BY name";
		$animusResult = $conn->query($animus);
		$animusBuild = '';
		if ($animusResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $animusResult->fetch_assoc()) {
				$animusBuild[$i] = $row;
				$i++;
			}
		}
		return $animusBuild;
	}

	/**
	 * @return string
	 */
	function getAllAnimusName(){
		$core = new AllCore();
		$conn = $core->connect();
		
		$animus = "SELECT name FROM animus_known ORDER BY name";
		$animusResult = $conn->query($animus);
		$animusBuild = '';
		if ($animusResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $animusResult->fetch_assoc()) {
				$animusBuild[$i] = $row;
				$i++;
			}
		}
		return $animusBuild;
	}

	/**
	 * @param $name
	 * @return string
	 */
	function getAnimusByName($name){
		$core = new AllCore();
		$conn = $core->connect();
		$name = "'".$name."'";
		$animus = "SELECT * FROM animus_known WHERE name = ".$name;
		$animusResult = $conn->query($animus);
		$animusBuild = '';
		if ($animusResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $animusResult->fetch_assoc()) {
				$animusBuild[$i] = $row;
				$i++;
			}
		} 
		return $animusBuild;
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
	function saveAnimus($name, $description, $cost, $range, $aoe, $pow, $upkeep, $offensive, $specialAbility1, $specialAbility2, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $duration){
		$core = new AllCore();
		$conn = $core->connect();
		
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
		
		$sql = "INSERT INTO animus_known (name, description, cost, range_distance, aoe, pow, upkeep, offensive, ability_granted, second_ability_granted, off_spd_mod, off_str_mod, off_mat_mod, off_rat_mod, off_def_mod, off_arm_mod, duration)
		VALUES (".$name.", ".$description.", ".$cost.", ".$range.", ".$aoe.", ".$pow.", ".$upkeep.", ".$offensive.", ".$specialAbility1.", ".$specialAbility2.", ".$offSpdMod.", ".$offStrMod.", ".$offMatMod.", ".$offRatMod.", ".$offDefMod.", ".$offArmMod.", ".$duration.")";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
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
	function updateAnimus($name, $description, $cost, $range, $aoe, $pow, $upkeep, $offensive, $specialAbility1, $specialAbility2, $offSpdMod, $offStrMod, $offMatMod, $offRatMod, $offDefMod, $offArmMod, $duration){
		$core = new AllCore();
		$conn = $core->connect();
		
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
				
		$sql = "UPDATE animus_known 
		SET description=".$description.", cost=".$cost.", range_distance=".$range.", aoe=".$aoe.", pow=".$pow.", upkeep=".$upkeep.", offensive=".$offensive.", ability_granted=".$specialAbility1.", second_ability_granted=".$specialAbility2.", off_spd_mod=".$offSpdMod.", off_str_mod=".$offStrMod.", off_mat_mod=".$offMatMod.", off_rat_mod=".$offRatMod.", off_def_mod=".$offDefMod.", off_arm_mod=".$offArmMod.", duration=".$duration." 
		WHERE name=".$name;
		
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();		
	}
}
