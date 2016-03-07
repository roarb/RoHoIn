<?php

class AllWeapons extends AllCore
{
	/**
	 * @return string
	 */
	function getAllWeapons(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM weapon ORDER BY name";
		$weaponsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$weapons = "SELECT * FROM weapon ORDER BY name";
		//$weaponsResult = $conn->query($weapons);
		$weaponsBuild = '';
		if ($weaponsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $weaponsResult->fetch_assoc()) {
				$weaponsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $weaponsBuild;
	}

	/**
	 * @return string
	 */
	function getAllWeaponsName(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT name FROM weapon ORDER BY name";
		$weaponsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$weapons = "SELECT name FROM weapon ORDER BY name";
		//$weaponsResult = $conn->query($weapons);
		$weaponsBuild = '';
		if ($weaponsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $weaponsResult->fetch_assoc()) {
				$weaponsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $weaponsBuild;
	}

	/**
	 * @param $name
	 * @return string
	 */
	function getWeaponByName($name){
		//$conn = $this->connect();
		$name = "'".$name."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM weapon WHERE name = ".$name."";
		$weaponResult = $mysqli->query($sql_query);

		//$weapon = "SELECT * FROM weapon WHERE name = ".$name."";
		//$weaponResult = $conn->query($weapon);
		$weaponBuild = '';
		if ($weaponResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $weaponResult->fetch_assoc()) {
				$weaponBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $weaponBuild;
	}

	/**
	 * @param $name
	 * @param $ranged
	 * @param $range
	 * @param $rof
	 * @param $aoe
	 * @param $pow
	 * @param $reach
	 * @param $damageType
	 * @param $criticalEffect
	 * @param $continuousEffect
	 * @param $openFist
	 * @param $magical
	 * @param $specialAction1
	 * @param $specialAction2
	 * @param $specialAction3
	 * @param $specialAction4
	 * @param $weaponsMaster
	 * @param $thrown
	 * @param $buckler
	 * @param $shield
	 */
	function saveWeapon($name, $ranged, $range, $rof, $aoe, $pow, $reach, $damageType, $criticalEffect, $continuousEffect, $openFist, $magical, $specialAction1, $specialAction2, $specialAction3, $specialAction4, $weaponsMaster, $thrown, $buckler, $shield){
		//$conn = $this->connect();
		
		$name = "'".$name."'";
		$ranged = "'".$ranged."'";
		$reach = "'".$reach."'";
		$openFist = "'".$openFist."'";
		$magical = "'".$magical."'";
		$weaponsMaster = "'".$weaponsMaster."'";
		$thrown = "'".$thrown."'";
		$buckler = "'".$buckler."'";
		$shield = "'".$shield."'";
		if ($range == ''){$range = 'NULL';} else {$range = "'".$range."'";}
		if ($rof == ''){$rof = 'NULL';} else {$rof = "'".$rof."'";}
		if ($aoe == ''){$aoe = 'NULL';} else {$aoe = "'".$aoe."'";}
		if ($pow == ''){$pow = 'NULL';} else {$pow = "'".$pow."'";}
		if ($damageType == ''){$damageType = 'NULL';} else {$damageType = "'".$damageType."'";}
		if ($criticalEffect == ''){$criticalEffect = 'NULL';} else {$criticalEffect = "'".$criticalEffect."'";}
		if ($continuousEffect == ''){$continuousEffect = 'NULL';} else {$continuousEffect = "'".$continuousEffect."'";}
		if ($specialAction1 == ''){$specialAction1 = 'NULL';} else {$specialAction1 = "'".$specialAction1."'";}
		if ($specialAction2 == ''){$specialAction2 = 'NULL';} else {$specialAction2 = "'".$specialAction2."'";}
        if ($specialAction3 == ''){$specialAction3 = 'NULL';} else {$specialAction3 = "'".$specialAction3."'";}
        if ($specialAction4 == ''){$specialAction4 = 'NULL';} else {$specialAction4 = "'".$specialAction4."'";}

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "INSERT INTO weapon (name, ranged, rof, aoe, pow, reach, damage_type, critical_effect, continuous_effect, open_fist, magical, special_action_1, special_action_2, special_action_3, special_action_4, weapons_master, shooting_distance, thrown, buckler, shield)
		VALUES (".$name.", ".$ranged.", ".$rof.", ".$aoe.", ".$pow.", ".$reach.", ".$damageType.", ".$criticalEffect.", ".$continuousEffect.", ".$openFist.", ".$magical.", ".$specialAction1.", ".$specialAction2.", ".$specialAction3.", ".$specialAction4.", ".$weaponsMaster.", ".$range.", ".$thrown.", ".$buckler.", ".$shield.")";

		//$sql = "INSERT INTO weapon (name, ranged, rof, aoe, pow, reach, damage_type, critical_effect, continuous_effect, open_fist, magical, special_action_1, special_action_2, special_action_3, special_action_4, weapons_master, shooting_distance, thrown, buckler, shield)
		//VALUES (".$name.", ".$ranged.", ".$rof.", ".$aoe.", ".$pow.", ".$reach.", ".$damageType.", ".$criticalEffect.", ".$continuousEffect.", ".$openFist.", ".$magical.", ".$specialAction1.", ".$specialAction2.", ".$specialAction3.", ".$specialAction4.", ".$weaponsMaster.", ".$range.", ".$thrown.", ".$buckler.", ".$shield.")";
		
		if ($mysqli->query($sql_query) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql_query . "<br>" . $mysqli->error;
		}
		//mysqli_close($conn); //$conn->close();
	}

	/**
	 * @param $name
	 * @param $ranged
	 * @param $range
	 * @param $rof
	 * @param $aoe
	 * @param $pow
	 * @param $reach
	 * @param $damageType
	 * @param $criticalEffect
	 * @param $continuousEffect
	 * @param $openFist
	 * @param $magical
	 * @param $specialAction1
	 * @param $specialAction2
	 * @param $specialAction3
	 * @param $specialAction4
	 * @param $weaponsMaster
	 * @param $thrown
	 * @param $buckler
	 * @param $shield
	 */
	function updateWeapon($name, $ranged, $range, $rof, $aoe, $pow, $reach, $damageType, $criticalEffect, $continuousEffect, $openFist, $magical, $specialAction1, $specialAction2, $specialAction3, $specialAction4, $weaponsMaster, $thrown, $buckler, $shield){
		//$conn = $this->connect();
		
		$name = "'".$name."'";
		$ranged = "'".$ranged."'";
		$reach = "'".$reach."'";
		$openFist = "'".$openFist."'";
		$magical = "'".$magical."'";
		$weaponsMaster = "'".$weaponsMaster."'";
		$thrown = "'".$thrown."'";
        $buckler = "'".$buckler."'";
		$shield = "'".$shield."'";
		if ($range == ''){$range = 'NULL';} else {$range = "'".$range."'";}
		if ($rof == ''){$rof = 'NULL';} else {$rof = "'".$rof."'";}
		if ($aoe == ''){$aoe = 'NULL';} else {$aoe = "'".$aoe."'";}
		if ($pow == ''){$pow = 'NULL';} else {$pow = "'".$pow."'";}
		if ($damageType == ''){$damageType = 'NULL';} else {$damageType = "'".$damageType."'";}
		if ($criticalEffect == ''){$criticalEffect = 'NULL';} else {$criticalEffect = "'".$criticalEffect."'";}
		if ($continuousEffect == ''){$continuousEffect = 'NULL';} else {$continuousEffect = "'".$continuousEffect."'";}
		if ($specialAction1 == ''){$specialAction1 = 'NULL';} else {$specialAction1 = "'".$specialAction1."'";}
		if ($specialAction2 == ''){$specialAction2 = 'NULL';} else {$specialAction2 = "'".$specialAction2."'";}
        if ($specialAction3 == ''){$specialAction3 = 'NULL';} else {$specialAction3 = "'".$specialAction3."'";}
        if ($specialAction4 == ''){$specialAction4 = 'NULL';} else {$specialAction4 = "'".$specialAction4."'";}

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "UPDATE weapon
		SET ranged=".$ranged.", reach=".$reach.", open_fist=".$openFist.", rof=".$rof.", aoe=".$aoe.", pow=".$pow.", damage_type=".$damageType.", critical_effect=".$criticalEffect.", continuous_effect=".$continuousEffect.", magical=".$magical.", thrown=".$thrown.", buckler=".$buckler.", shield=".$shield.", special_action_1=".$specialAction1.", special_action_2=".$specialAction2.", special_action_3=".$specialAction3.", special_action_4=".$specialAction4.", weapons_master=".$weaponsMaster."
		WHERE name=".$name."";

		//$sql = "UPDATE weapon
		//SET ranged=".$ranged.", reach=".$reach.", open_fist=".$openFist.", rof=".$rof.", aoe=".$aoe.", pow=".$pow.", damage_type=".$damageType.", critical_effect=".$criticalEffect.", continuous_effect=".$continuousEffect.", magical=".$magical.", thrown=".$thrown.", buckler=".$buckler.", shield=".$shield.", special_action_1=".$specialAction1.", special_action_2=".$specialAction2.", special_action_3=".$specialAction3.", special_action_4=".$specialAction4.", weapons_master=".$weaponsMaster."
		//WHERE name=".$name."";
		
		if ($mysqli->query($sql_query) === TRUE) {
			echo "Record updated successfully<br>";
		} else {
			echo "Error: " . $sql_query . "<br>" . $mysqli->error;
		}
		//mysqli_close($conn); //$conn->close();
	}
	
}
