<?php

class AllUnits extends AllCore
{

	/**
	 * get all units of course
	 * @return string
	 */
	function getAllUnits(){

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		} else {
			echo "0 results";
		}

		return $unitsBuild;
	}

	/**
	 *  get Name Faction Type Companion units by Faction
	 * @param $faction
	 * @return string
	 */
	function getFactionUnitList($faction){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT DISTINCT name, faction, type, companion FROM core WHERE faction='".$faction."' ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}

		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
	function getFactionUnitListAbilities($faction){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT DISTINCT special_ability_1, special_ability_2, special_ability_3, special_ability_4, special_ability_5, special_ability_6, special_ability_7, special_ability_8, special_ability_9, special_ability_10 FROM core WHERE faction='".$faction."' ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}

		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
	function getFactionUnitListWeapons($faction){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT DISTINCT weapon1, weapon2, weapon3, weapon4, weapon5 FROM core WHERE faction='".$faction."' ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT DISTINCT weapon1, weapon2, weapon3, weapon4, weapon5 FROM core WHERE faction='".$faction."' ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
	function getFactionUnitListSpells($faction){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT DISTINCT spell_1, spell_2, spell_3, spell_4, spell_5, spell_6, spell_7, spell_8, spell_9, spell_10 FROM core WHERE faction='".$faction."' ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT DISTINCT spell_1, spell_2, spell_3, spell_4, spell_5, spell_6, spell_7, spell_8, spell_9, spell_10 FROM core WHERE faction='".$faction."' ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $unitName
	 * @return string
	 */
	public function getFactionByUnitName($unitName){
		$unitName = "'" . $unitName . "'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT faction FROM core WHERE name=" . $unitName . " ORDER BY faction";
		$factionResult = $mysqli->query($sql_query);

        //$conn = $this->connect();
        //$factionSql = "SELECT faction FROM core WHERE name=" . $unitName . " ORDER BY faction";
        //$factionResult = $conn->query($factionSql);
        $faction = '';
        foreach ($factionResult as $result) {
            $faction = $result['faction'];
        }
		//mysqli_close($conn); //$conn->close();
        return $faction;
    }

	/**
	 * // get only the name for all units
	 * @return string
	 */
	function getAllUnitsName(){

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT name FROM core ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT name FROM core ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * // get only the name for all units of $faction
	 * @param $faction
	 * @return bool|mysqli_result
	 */
	function getAllUnitsNameFaction($faction){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT name FROM core WHERE faction = '".$faction."' ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT name FROM core WHERE faction = '".$faction."' ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsResult;
	}

	/**
	 * @param $faction
	 * @param $type
	 * @return string
	 */
	function getAllUnitsNameFactionType($faction, $type){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT name FROM core WHERE faction = '".$faction."' AND type = '".$type."' ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT name FROM core WHERE faction = '".$faction."' AND type = '".$type."' ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @return string
	 */
	function getWarcasterWarlockUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Warlock' OR type = 'Warlock Unit' OR type = 'Warcaster' OR type = 'Warcaster Unit' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Warlock' OR type = 'Warlock Unit' OR type = 'Warcaster' OR type = 'Warcaster Unit' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
    function getWarcasterWarlockUnitsByFaction($faction){
		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

		$faction = "'".$faction."'";

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT *
        FROM core
        WHERE  faction =  ".$faction."
        AND (
            type =  'Warlock'
            OR  type =  'Warlock Unit'
            OR  type =  'Warcaster'
            OR  type =  'Warcaster Unit'
        ) ORDER BY name" ;
		$unitsResult = $mysqli->query($sql_query);

        //$conn = $this->connect();
        //$units = "SELECT *
        //FROM core
        //WHERE  faction =  ".$faction."
        //AND (
        //    type =  'Warlock'
        //    OR  type =  'Warlock Unit'
        //    OR  type =  'Warcaster'
        //    OR  type =  'Warcaster Unit'
        //) ORDER BY name" ;
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                $unitsBuild[$i] = $row;
				$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
							$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
                $i++;
            }
        }
		//mysqli_close($conn); //$conn->close();
        // add in 'possible_ua' for each model in the array
		// add in 'tiered options for each model in the array
        $i = 0;
        foreach ($unitsBuild as $x){
            $unitsBuild[$i]['possible_ua'] = $this->getUnitOptionalAttachments($unitsBuild[$i]['id']);
			$unitsBuild[$i]['tiers'] = $this->getWarcasterTierObject($unitsBuild[$i]['id']);
            $i++;
        }

        return $unitsBuild;
    }

	/**
	 * @param $name
	 * @return array
	 */
    function getWarcasterFullObjectByName($name){
        //$conn = $this->connect();
        $barracks = new Barracks();
        $loggedIn = false; $userId = 0;
        if ($this->getLoggedIn()){
            $loggedIn = true;
            $userId = $_SESSION['user_id'];
        }
        $name = '"'.$name.'"';
        $warcaster = array();

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE name = ".$name;
		$result = $mysqli->query($sql_query);

        //$query = "SELECT * FROM core WHERE name = ".$name;
        //$result = $conn->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $warcaster = $row;
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$warcaster['owned_models'] = $modelItem['owned_qty'];
							$warcaster['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $warcaster;
    }

	/**
	 * @return string
	 */
	function getColossalUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Colossal' OR type = 'Colossal Vector' OR type = 'Gargantuan' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Colossal' OR type = 'Colossal Vector' OR type = 'Gargantuan' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @return string
	 */
	function getHeavyUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Heavy Myrmidon' OR type = 'Heavy Vector' OR type = 'Heavy Warbeast' OR type = 'Heavy Warjack' OR type = 'Helljack' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Heavy Myrmidon' OR type = 'Heavy Vector' OR type = 'Heavy Warbeast' OR type = 'Heavy Warjack' OR type = 'Helljack' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @return string
	 */
	function getLightUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Light Myrmidon' OR type = 'Light Vector' OR type = 'Light Warbeast' OR type = 'Light Warjack' OR type = 'Bone Jack' OR type = 'Lesser Warbeast' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Light Myrmidon' OR type = 'Light Vector' OR type = 'Light Warbeast' OR type = 'Light Warjack' OR type = 'Bone Jack' OR type = 'Lesser Warbeast' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
    function getBattleGroupUnitsByFaction($faction){
        //$conn = $this->connect();
		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

        $faction = "'".$faction."'";

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT *
        FROM core
        WHERE  faction =  ".$faction."
        AND (
            type = 'Light Myrmidon'
            OR  type = 'Light Vector'
            OR  type = 'Light Warjack'
            OR  type = 'Light Warbeast'
            OR  type = 'Bone Jack'
            OR  type = 'Lesser Warbeast'
            OR  type = 'Heavy Myrmidon'
            OR  type = 'Heavy Vector'
            OR  type = 'Heavy Warbeast'
            OR  type = 'Heavy Warjack'
            OR  type = 'Helljack'
            OR  type = 'Colossal'
            OR  type = 'Colossal Vector'
            OR  type = 'Gargantuan'
        )
        ORDER BY  name" ;
		$unitsResult = $mysqli->query($sql_query);

        //$units = "SELECT *
        //FROM core
        //WHERE  faction =  ".$faction."
        //AND (
        //    type = 'Light Myrmidon'
        //    OR  type = 'Light Vector'
        //    OR  type = 'Light Warjack'
        //    OR  type = 'Light Warbeast'
        //    OR  type = 'Bone Jack'
        //    OR  type = 'Lesser Warbeast'
        //    OR  type = 'Heavy Myrmidon'
        //    OR  type = 'Heavy Vector'
        //    OR  type = 'Heavy Warbeast'
        //    OR  type = 'Heavy Warjack'
        //    OR  type = 'Helljack'
        //    OR  type = 'Colossal'
        //    OR  type = 'Colossal Vector'
        //    OR  type = 'Gargantuan'
        //)
        //ORDER BY  name" ;
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                $unitsBuild[$i] = $row;
				$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row["name"]);
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
							$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
                $i++;
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	/**
	 * @return string
	 */
	function getUnitUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Unit' OR type = 'Character Unit' OR type = 'Warbeast Pack' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Unit' OR type = 'Character Unit' OR type = 'Warbeast Pack' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
    function getBuilderUnitsByFaction($faction){
        //$conn = $this->connect();
		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

        $faction = "'".$faction."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE  faction =  ".$faction." AND ( type = 'Unit' OR  type = 'Character Unit' OR  type = 'Weapon Crew Unit' OR  type = 'Cavalry Unit' ) ORDER BY  name" ;
		$unitsResult = $mysqli->query($sql_query);

        //$units = "SELECT * FROM core WHERE  faction =  ".$faction." AND ( type = 'Unit' OR  type = 'Character Unit' OR  type = 'Weapon Crew Unit' OR  type = 'Cavalry Unit' ) ORDER BY  name" ;
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                // remove cost '-' units from this list
                if ($row['cost'] != '-') {
                    $unitsBuild[$i] = $row;
					$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
					if ($loggedIn){
						$barracksModels = $barracks->getAllUserModels($userId);
						foreach ($barracksModels as $modelItem){
							if ($modelItem['model_id'] == $row['id']){
								$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
								$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
							}
						}
					}
                    $i++;
                }
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	/**
	 * @return string
	 */
	function getSoloUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Solo' OR type = 'Character Solo' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Solo' OR type = 'Character Solo' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
    function getBuilderSolosByFaction($faction){
        //$conn = $this->connect();
		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

        $faction = "'".$faction."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE  faction =  ".$faction." AND ( type = 'Solo' OR  type = 'Character Solo' ) ORDER BY name" ;
		$unitsResult = $mysqli->query($sql_query);

        //$units = "SELECT * FROM core WHERE  faction =  ".$faction." AND ( type = 'Solo' OR  type = 'Character Solo' ) ORDER BY name" ;
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                // remove cost '-' solos from this list
                if ($row['cost'] != '-') {
                    $unitsBuild[$i] = $row;
					$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
					if ($loggedIn){
						$barracksModels = $barracks->getAllUserModels($userId);
						foreach ($barracksModels as $modelItem){
							if ($modelItem['model_id'] == $row['id']){
								$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
								$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
							}
						}
					}
                    $i++;
                }
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	/**
	 * @return string
	 */
	function getBattleEngineUnits(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE type = 'Battle Engine' ORDER BY faction";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT * FROM core WHERE type = 'Battle Engine' ORDER BY faction";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $faction
	 * @return string
	 */
    function getBattleEngineUnitsByFaction($faction){
        //$conn = $this->connect();

		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

        $faction = "'".$faction."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE  faction =  ".$faction." AND type = 'Battle Engine' ORDER BY  name" ;
		$unitsResult = $mysqli->query($sql_query);

        //$units = "SELECT * FROM core WHERE  faction =  ".$faction." AND type = 'Battle Engine' ORDER BY  name" ;
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                $unitsBuild[$i] = $row;
				$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
							$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
                $i++;
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	function getBuilderMercSolosByFaction($faction) {
		//$conn = $this->connect();

		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

		$faction = "'%".$faction."%'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE  related_factions LIKE ".$faction." AND type LIKE '%solo%' ORDER BY  name" ;
		$unitsResult = $mysqli->query($sql_query);

		//$units = "SELECT * FROM core WHERE  related_factions LIKE ".$faction." AND type LIKE '%solo%' ORDER BY  name" ;
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
							$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	function getBuilderMercUnitsByFaction($faction) {
		//$conn = $this->connect();

		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}

		$faction = "'%".$faction."%'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE  related_factions LIKE ".$faction." AND type LIKE '%unit%' ORDER BY  name" ;
		$unitsResult = $mysqli->query($sql_query);

		//$units = "SELECT * FROM core WHERE  related_factions LIKE ".$faction." AND type LIKE '%unit%' ORDER BY  name" ;
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild[$i] = $row;
				$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
							$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $list
	 * @return mixed
	 */
	public function getAveragesWarcasterWarlock($list){
		$count = 0;
		$i = 0;
		foreach ($list as $item){
			if ($item['spd'] != 0){  // make sure speed value is not null
				if ($item['cost'] != '-'){ // make sure that null cost models are not added
					$aSpd[$i] = $item['spd'];
					$aStr[$i] = $item['str'];
					$aMat[$i] = $item['mat'];
					$aRat[$i] = $item['rat'];
					$aDef[$i] = $item['def'];
					$aArm[$i] = $item['arm'];
					$aDmg[$i] = $item['damage_boxes'];
					$aCost[$i] = $this->getCleanCost($item['cost']);
					$aBGpoints[$i] = $item['bg_points'];
					$aFocusFury[$i] = $item['focus'] + $item['fury'];
					$aSpells[$i] = $this->getCountSpells($item);
					$aAbilities[$i] = $this->getCountAbilities($item);
					$i++;
					$count++;
				}
				elseif ($item['type'] == 'Warlock' || $item['type'] == 'Warcaster'){ // exemption for null cost models as warlocks and warcasters have no cost
					$aSpd[$i] = $item['spd'];
					$aStr[$i] = $item['str'];
					$aMat[$i] = $item['mat'];
					$aRat[$i] = $item['rat'];
					$aDef[$i] = $item['def'];
					$aArm[$i] = $item['arm'];
					$aDmg[$i] = $item['damage_boxes'];
					$aCost[$i] = $this->getCleanCost($item['cost']);
					$aBGpoints[$i] = $item['bg_points'];
					$aFocusFury[$i] = $item['focus'] + $item['fury'];
					$aSpells[$i] = $this->getCountSpells($item);
					$aAbilities[$i] = $this->getCountAbilities($item);
					$i++;
					$count++;
				}
			}
		}
		$unitsReadout['count'] = $count;
		$unitsReadout['all-spd'] = $aSpd;
		$unitsReadout['all-str'] = $aStr;
		$unitsReadout['all-mat'] = $aMat;
		$unitsReadout['all-rat'] = $aRat;
		$unitsReadout['all-def'] = $aDef;
		$unitsReadout['all-arm'] = $aArm;
		$unitsReadout['all-dmg'] = $aDmg;
		$unitsReadout['all-cost'] = $aCost;
		$unitsReadout['all-bgpoints'] = $aBGpoints;
		$unitsReadout['all-focusfury'] = $aFocusFury;
		$unitsReadout['all-spells'] = $aSpells;
		$unitsReadout['all-abilities'] = $aAbilities;
		return $unitsReadout;
	}

	/**
	 * @param $id
	 * @return array|string
	 */
	function getUnitNameById($id){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT name FROM core WHERE id = ".$id." ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$units = "SELECT name FROM core WHERE id = ".$id." ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild = $row;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $name
	 * @return array|string
	 */
	function getUnitByName($name){
		//$conn = $this->connect();
		$name = "'".$name."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE name = ".$name." ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

		//$units = "SELECT * FROM core WHERE name = ".$name." ORDER BY name";
		//$unitsResult = $conn->query($units);
		$unitsBuild = '';
		if ($unitsResult->num_rows > 0) {
			// output data of each row
			while($row = $unitsResult->fetch_assoc()) {
				$unitsBuild = $row;
				$views = $row['views']+1;
				$mysqli->query('UPDATE core SET views = '.$views.' WHERE id = "'.$row['id'].'"');
			}
		}
        // check for possible Unit Attachments:
        $unitsBuild['possible_ua'] = $this->getUnitOptionalAttachments($unitsBuild['id']);
		//mysqli_close($conn); //$conn->close();
		return $unitsBuild;
	}

	/**
	 * @param $name
	 * @return string
	 */
    function getUnitIdByName($name){
        //$conn = $this->connect();
        $name = "'".$name."'";
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT id, views FROM core WHERE name = ".$name;
		$unitsResult = $mysqli->query($sql_query);

		//$units = "SELECT id, views FROM core WHERE name = ".$name;
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        foreach ($unitsResult as $result){
            $unitsBuild = $result['id'];
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	/**
	 * @param $id
	 * @return string
	 */
    function getUnitById($id){
        //$conn = $this->connect();
		$barracks = new Barracks();
		$loggedIn = false; $userId = 0;
		if ($this->getLoggedIn()){
			$loggedIn = true;
			$userId = $_SESSION['user_id'];
		}
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM core WHERE id = ".$id." ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

        //$units = "SELECT * FROM core WHERE id = ".$id." ORDER BY name";
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                $unitsBuild[$i] = $row;
				$unitsBuild[$i]['thumb_img'] = $this->getUnitImageThumbnail($row['name']);
				if ($loggedIn){
					$barracksModels = $barracks->getAllUserModels($userId);
					foreach ($barracksModels as $modelItem){
						if ($modelItem['model_id'] == $row['id']){
							$unitsBuild[$i]['owned_models'] = $modelItem['owned_qty'];
							$unitsBuild[$i]['painted_models'] = $modelItem['painted_qty'];
						}
					}
				}
                $i++;
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	/**
	 * @param $id
	 * @return string
	 */
    public function getUnitOptionalAttachments($id){ // $id = origin model id
        // find all faction models that could be attached to the model requested.
        $unit = $this->getUnitById($id);
        $unit = $unit[0];
        $factionHaveAttached = $this->getUnitFactionAttachedToField($unit['faction']); // returns all models with attached_to not NULL and in the same faction
        // run special rules checks
        // check for faction warcaster/warlock
        $i = 0;
        $outputModels = '';
        if ($unit['type'] == 'Warcaster' || $unit['type'] == 'Warcaster Unit'){ // check for warcasters
            foreach ($factionHaveAttached as $modelCheck){
                if ($modelCheck['attached_to'] == 'Faction Warcaster' || $modelCheck['attached_to'] == 'faction warcaster'){
                    if ($modelCheck['cost'] != '-'){
                        $outputModels[$i] = $modelCheck;
						$i++;
                    }
                }
            }
        } if ($unit['type'] == 'Warlock' || $unit['type'] == 'Warlock Unit'){ // check for warlocks
            foreach ($factionHaveAttached as $modelCheck){
                if ($modelCheck['attached_to'] == 'Faction Warlock' || $modelCheck['attached_to'] == 'faction warlock'){
                    if ($modelCheck['cost'] != '-'){
                        $outputModels[$i] = $modelCheck;
						$i++;
                    }
                }
            }
        } if ($unit['type'] == 'Unit' || $unit['type'] == 'Character Unit'){ // check by unit type 'unit or character unit'
            foreach ($factionHaveAttached as $modelCheck){
                if ($modelCheck['attached_to'] == 'Faction Unit' || $modelCheck['attached_to'] == 'faction unit'){
                    if ($modelCheck['cost'] != '-'){
                        $outputModels[$i] = $modelCheck;
						$i++;
                    }
                }
            }
        }
        foreach ($factionHaveAttached as $modelCheck){ // final check - check by name
            if ($modelCheck['attached_to'] == $unit['name']){
                if ($modelCheck['cost'] != '-'){
                    $outputModels[$i] = $modelCheck;
					$i++;
                }
            }
        }

        return $outputModels;
    }

	/**
	 * @param $id
	 * @return string
	 */
	function getWarcasterTierObject($id){ // $id = warcaster model id
		$tiers =  new AllTieredLists();
		$tierObj = $tiers->getTierByCasterId($id);

		return $tierObj;
	}

	/**
	 * @param $faction
	 * @return string
	 */
    function getUnitFactionAttachedToField($faction){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT attached_to, id, name, cost, field_allowance, title FROM core WHERE faction = '".$faction."' AND attached_to IS NOT NULL ORDER BY name";
		$unitsResult = $mysqli->query($sql_query);

        //$conn = $this->connect();
        //$units = "SELECT attached_to, id, name, cost, field_allowance, title FROM core WHERE faction = '".$faction."' AND attached_to IS NOT NULL ORDER BY name";
        //$unitsResult = $conn->query($units);
        $unitsBuild = '';
        if ($unitsResult->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $unitsResult->fetch_assoc()) {
                $unitsBuild[$i] = $row;
                $i++;
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $unitsBuild;
    }

	/**
	 * @param $list
	 * @param $faction
	 * @param $type
	 * @return mixed
	 */
	public function getCountFactionType($list, $faction, $type){
		$count = 0;
		$i = 0;
		foreach ($list as $item){
			if ($item['spd'] != 0){
				foreach ($type as $t){
					if ($item['type'] == $t){
						$aSpd[$i] = $item['spd'];
						$aStr[$i] = $item['str'];
						$aMat[$i] = $item['mat'];
						$aRat[$i] = $item['rat'];
						$aDef[$i] = $item['def'];
						$aArm[$i] = $item['arm'];
						$aDmg[$i] = $item['damage_boxes'];
						$aCost[$i] = $item['cost'];
						$aBGpoints[$i] = $item['bg_points'];
						$aFocusFury[$i] = $item['focus'] + $item['fury'];
						$aSpells[$i] = $this->getCountSpells($item);
						$aAbilities[$i] = $this->getCountAbilities($item);
						$i++;
					}
					if ($item['faction'] == $faction){
						if ($item['type'] == $t){
							$tSpd = $item['spd'];
							$tStr = $item['str'];
							$tMat = $item['mat'];
							$tRat = $item['rat'];
							$tDef = $item['def'];
							$tArm = $item['arm'];
							$tDmg = $item['damage_boxes'];
							$tCost = $item['cost'];
							$tBGpoints = $item['bg_points'];
							$tFocusFury = $item['focus'] + $item['fury'];
							$tSpells = $this->getCountSpells($item);
							$tAbilities = $this->getCountAbilities($item);
							$count++;
						}
					}
				}
			}
		}
		$unitsReadout['count'] = $count;
		$unitsReadout['avg-spd'] = $tSpd / $count;
		$unitsReadout['all-spd'] = $aSpd;
		$unitsReadout['avg-str'] = $tStr / $count;
		$unitsReadout['all-str'] = $aStr;
		$unitsReadout['avg-mat'] = $tMat / $count;
		$unitsReadout['all-mat'] = $aMat;
		$unitsReadout['avg-rat'] = $tRat / $count;
		$unitsReadout['all-rat'] = $aRat;
		$unitsReadout['avg-def'] = $tDef / $count;
		$unitsReadout['all-def'] = $aDef;
		$unitsReadout['avg-arm'] = $tArm / $count;
		$unitsReadout['all-arm'] = $aArm;
		$unitsReadout['avg-dmg'] = $tDmg / $count;
		$unitsReadout['all-dmg'] = $aDmg;
		$unitsReadout['avg-cost'] = $tCost / $count;
		$unitsReadout['all-cost'] = $aCost;
		$unitsReadout['avg-bgpoints'] = $tBGpoints / $count;
		$unitsReadout['all-bgpoints'] = $aBGpoints;
		$unitsReadout['avg-focusfury'] = $tFocusFury / $count;
		$unitsReadout['all-focusfury'] = $aFocusFury;
		$unitsReadout['avg-spells'] = $tSpells / $count;
		$unitsReadout['all-spells'] = $aSpells;
		$unitsReadout['avg-abilities'] = $tAbilities / $count;
		$unitsReadout['all-abilities'] = $aAbilities;
		return $unitsReadout;
	}

	/**
	 * @param $item
	 * @return int
	 */
	public function getCountSpells($item){
		$x = 0; $i = 0;
		while ($i < 10){
			if (isset($item['spell_'.$i])){$x++;};
			$i++;
		}
		return $x;
	}

	/**
	 * @param $item
	 * @return int
	 */
	public function getCountAbilities($item){
		$x = 0; $i = 0;
		while ($i < 10){
			if (isset($item['special_ability_'.$i])){$x++;};
			$i++;
		}
		return $x;
	}

	/**
	 * update - edit units
	 * @param $name
	 * @param $faction
	 * @param $relatedFaction
	 * @param $unitType
	 * @param $title
	 * @param $cost
	 * @param $bgPoints
	 * @param $fieldAllowance
	 * @param $purchaseLow
	 * @param $purchaseHigh
	 * @param $focus
	 * @param $fury
	 * @param $threshold
	 * @param $spd
	 * @param $str
	 * @param $mat
	 * @param $rat
	 * @param $def
	 * @param $arm
	 * @param $cmd
	 * @param $damageBoxes
	 * @param $damageGrid
	 * @param $damageSpiral
	 * @param $animusKnown
	 * @param $mount
	 * @param $mountAbility
	 * @param $mountAbility2
	 * @param $baseSize
	 * @param $weapon1
	 * @param $weapon2
	 * @param $weapon3
	 * @param $weapon4
	 * @param $weapon5
	 * @param $specialAbility1
	 * @param $specialAbility2
	 * @param $specialAbility3
	 * @param $specialAbility4
	 * @param $specialAbility5
	 * @param $specialAbility6
	 * @param $specialAbility7
	 * @param $specialAbility8
	 * @param $specialAbility9
	 * @param $specialAbility10
	 * @param $spell1
	 * @param $spell2
	 * @param $spell3
	 * @param $spell4
	 * @param $spell5
	 * @param $spell6
	 * @param $spell7
	 * @param $spell8
	 * @param $spell9
	 * @param $spell10
	 * @param $feat
	 * @param $attachedTo
	 * @param $companion
	 * @param $leader
	 */
	function updateUnits($name, $faction, $relatedFaction, $unitType, $title, $cost, $bgPoints, $fieldAllowance, $purchaseLow, $purchaseHigh, $focus, $fury, $threshold, $spd, $str, $mat, $rat, $def, $arm, $cmd, $damageBoxes, $damageGrid, $damageSpiral, $animusKnown, $mount, $mountAbility, $mountAbility2, $baseSize, $weapon1, $weapon2, $weapon3, $weapon4, $weapon5, $specialAbility1, $specialAbility2, $specialAbility3, $specialAbility4, $specialAbility5, $specialAbility6, $specialAbility7, $specialAbility8, $specialAbility9, $specialAbility10, $spell1, $spell2, $spell3, $spell4, $spell5, $spell6, $spell7, $spell8, $spell9, $spell10, $feat, $attachedTo, $companion, $leader){
		//$conn = $this->connect();

		$name = "'".$name."'";
		$faction = "'".$faction."'";
		if ($relatedFaction == ''){$relatedFaction = 'NULL';} else {$relatedFaction = "'".$relatedFaction."'";}
		$unitType = "'".$unitType."'";
		$title = "'".$title."'";
		$cost = "'".$cost."'";
		if ($bgPoints == ''){$bgPoints = 'NULL';} else {$bgPoints = "'".$bgPoints."'";}
		if ($fieldAllowance == ''){$fieldAllowance = 'NULL';} else {$fieldAllowance = "'".$fieldAllowance."'";}
		if ($purchaseLow == ''){$purchaseLow = 'NULL';} else {$purchaseLow = "'".$purchaseLow."'";}
		if ($purchaseHigh == ''){$purchaseHigh = 'NULL';} else {$purchaseHigh = "'".$purchaseHigh."'";}
		if ($focus == ''){$focus = 'NULL';} else {$focus = "'".$focus."'";}
		if ($fury == ''){$fury = 'NULL';} else {$fury = "'".$fury."'";}
		if ($threshold == ''){$threshold = 'NULL';} else {$threshold = "'".$threshold."'";}
		$spd = "'".$spd."'";
		$str = "'".$str."'";
		$mat = "'".$mat."'";
		$rat = "'".$rat."'";
		$def = "'".$def."'";
		$arm = "'".$arm."'";
		if ($cmd == ''){$cmd = 'NULL';} else {$cmd = "'".$cmd."'";}
		$damageBoxes = "'".$damageBoxes."'";
		if ($damageGrid == ''){$damageGrid = 'NULL';} else {$damageGrid = "'".$damageGrid."'";}
		if ($damageSpiral == ''){$damageSpiral = 'NULL';} else {$damageSpiral = "'".$damageSpiral."'";}
		if ($animusKnown == ''){$animusKnown = 'NULL';} else {$animusKnown = "'".$animusKnown."'";}
		if ($mount == ''){$mount = 'NULL';} else {$mount = "'".$mount."'";}
		if ($mountAbility == ''){$mountAbility = 'NULL';} else {$mountAbility = "'".$mountAbility."'";}
		if ($mountAbility2 == ''){$mountAbility2 = 'NULL';} else {$mountAbility2 = "'".$mountAbility2."'";}
		$baseSize = "'".$baseSize."'";
		if ($weapon1 == ''){$weapon1 = 'NULL';} else {$weapon1 = "'".$weapon1."'";}
		if ($weapon2 == ''){$weapon2 = 'NULL';} else {$weapon2 = "'".$weapon2."'";}
		if ($weapon3 == ''){$weapon3 = 'NULL';} else {$weapon3 = "'".$weapon3."'";}
		if ($weapon4 == ''){$weapon4 = 'NULL';} else {$weapon4 = "'".$weapon4."'";}
		if ($weapon5 == ''){$weapon5 = 'NULL';} else {$weapon5 = "'".$weapon5."'";}
		if ($specialAbility1 == ''){$specialAbility1 = 'NULL';} else {$specialAbility1 = "'".$specialAbility1."'";}
		if ($specialAbility2 == ''){$specialAbility2 = 'NULL';} else {$specialAbility2 = "'".$specialAbility2."'";}
		if ($specialAbility3 == ''){$specialAbility3 = 'NULL';} else {$specialAbility3 = "'".$specialAbility3."'";}
		if ($specialAbility4 == ''){$specialAbility4 = 'NULL';} else {$specialAbility4 = "'".$specialAbility4."'";}
		if ($specialAbility5 == ''){$specialAbility5 = 'NULL';} else {$specialAbility5 = "'".$specialAbility5."'";}
		if ($specialAbility6 == ''){$specialAbility6 = 'NULL';} else {$specialAbility6 = "'".$specialAbility6."'";}
		if ($specialAbility7 == ''){$specialAbility7 = 'NULL';} else {$specialAbility7 = "'".$specialAbility7."'";}
		if ($specialAbility8 == ''){$specialAbility8 = 'NULL';} else {$specialAbility8 = "'".$specialAbility8."'";}
		if ($specialAbility9 == ''){$specialAbility9 = 'NULL';} else {$specialAbility9 = "'".$specialAbility9."'";}
		if ($specialAbility10 == ''){$specialAbility10 = 'NULL';} else {$specialAbility10 = "'".$specialAbility10."'";}
		if ($spell1 == ''){$spell1 = 'NULL';} else {$spell1 = "'".$spell1."'";}
		if ($spell2 == ''){$spell2 = 'NULL';} else {$spell2 = "'".$spell2."'";}
		if ($spell3 == ''){$spell3 = 'NULL';} else {$spell3 = "'".$spell3."'";}
		if ($spell4 == ''){$spell4 = 'NULL';} else {$spell4 = "'".$spell4."'";}
		if ($spell5 == ''){$spell5 = 'NULL';} else {$spell5 = "'".$spell5."'";}
		if ($spell6 == ''){$spell6 = 'NULL';} else {$spell6 = "'".$spell6."'";}
		if ($spell7 == ''){$spell7 = 'NULL';} else {$spell7 = "'".$spell7."'";}
		if ($spell8 == ''){$spell8 = 'NULL';} else {$spell8 = "'".$spell8."'";}
		if ($spell9 == ''){$spell9 = 'NULL';} else {$spell9 = "'".$spell9."'";}
		if ($spell10 == ''){$spell10 = 'NULL';} else {$spell10 = "'".$spell10."'";}
		if ($feat == ''){$feat = 'NULL';}
        else {
			$feat = str_replace("'", "\'", $feat);
			$feat = "'".$feat."'";
			}
		if ($attachedTo == ''){$attachedTo = 'NULL';} else {$attachedTo = "'".$attachedTo."'";}
		if ($companion == ''){$companion = 'NULL';} else {$companion = "'".$companion."'";}
        if ($leader == ''){$leader = 'NULL';} else {$leader = "'".$leader."'";}

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "UPDATE core SET faction=".$faction.", related_factions=".$relatedFaction.", type =".$unitType.", title=".$title.", cost=".$cost.", bg_points=".$bgPoints.", field_allowance=".$fieldAllowance.", purchased_low=".$purchaseLow.", purchased_high=".$purchaseHigh.", focus=".$focus.", fury=".$fury.", threshold=".$threshold.", spd=".$spd.", str=".$str.", mat=".$mat.", rat=".$rat.", def=".$def.", arm=".$arm.", cmd=".$cmd.", damage_boxes=".$damageBoxes.", damage_grid=".$damageGrid.", damage_spiral=".$damageSpiral.", animus_known=".$animusKnown.", mount=".$mount.", mount_ability=".$mountAbility.", mount_ability2=".$mountAbility2.", base_size=".$baseSize.", weapon1=".$weapon1.", weapon2=".$weapon2.", weapon3=".$weapon3.", weapon4=".$weapon4.", weapon5=".$weapon5.", special_ability_1=".$specialAbility1.", special_ability_2=".$specialAbility2.", special_ability_3=".$specialAbility3.", special_ability_4=".$specialAbility4.", special_ability_5=".$specialAbility5.", special_ability_6=".$specialAbility6.", special_ability_7=".$specialAbility7.", special_ability_8=".$specialAbility8.", special_ability_9=".$specialAbility9.", special_ability_10=".$specialAbility10.", spell_1=".$spell1.", spell_2=".$spell2.", spell_3=".$spell3.", spell_4=".$spell4.", spell_5=".$spell5.", spell_6=".$spell6.", spell_7=".$spell7.", spell_8=".$spell8.", spell_9=".$spell9.", spell_10=".$spell10.", feat=".$feat.", attached_to=".$attachedTo.", companion=".$companion.", unit_leader=".$leader."
		WHERE name = $name";
		if ($mysqli->query($sql_query) === TRUE){
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql_query . "<br>" . $mysqli->error;
		}

		//$sql = "UPDATE core SET faction=".$faction.", related_factions=".$relatedFaction.", type =".$unitType.", title=".$title.", cost=".$cost.", bg_points=".$bgPoints.", field_allowance=".$fieldAllowance.", purchased_low=".$purchaseLow.", purchased_high=".$purchaseHigh.", focus=".$focus.", fury=".$fury.", threshold=".$threshold.", spd=".$spd.", str=".$str.", mat=".$mat.", rat=".$rat.", def=".$def.", arm=".$arm.", cmd=".$cmd.", damage_boxes=".$damageBoxes.", damage_grid=".$damageGrid.", damage_spiral=".$damageSpiral.", animus_known=".$animusKnown.", mount=".$mount.", mount_ability=".$mountAbility.", mount_ability2=".$mountAbility2.", base_size=".$baseSize.", weapon1=".$weapon1.", weapon2=".$weapon2.", weapon3=".$weapon3.", weapon4=".$weapon4.", weapon5=".$weapon5.", special_ability_1=".$specialAbility1.", special_ability_2=".$specialAbility2.", special_ability_3=".$specialAbility3.", special_ability_4=".$specialAbility4.", special_ability_5=".$specialAbility5.", special_ability_6=".$specialAbility6.", special_ability_7=".$specialAbility7.", special_ability_8=".$specialAbility8.", special_ability_9=".$specialAbility9.", special_ability_10=".$specialAbility10.", spell_1=".$spell1.", spell_2=".$spell2.", spell_3=".$spell3.", spell_4=".$spell4.", spell_5=".$spell5.", spell_6=".$spell6.", spell_7=".$spell7.", spell_8=".$spell8.", spell_9=".$spell9.", spell_10=".$spell10.", feat=".$feat.", attached_to=".$attachedTo.", companion=".$companion.", unit_leader=".$leader."
		//WHERE name = $name";

		//if ($conn->query($sql) === TRUE) {
		//	echo "New record created successfully<br>";
		//} else {
		//	echo "Error: " . $sql . "<br>" . $conn->error;
		//}

		//mysqli_close($conn); //$conn->close();
	}

	/**
	 * // save units
	 * @param $name
	 * @param $faction
	 * @param $relatedFaction
	 * @param $unitType
	 * @param $title
	 * @param $cost
	 * @param $bgPoints
	 * @param $fieldAllowance
	 * @param $purchaseLow
	 * @param $purchaseHigh
	 * @param $focus
	 * @param $fury
	 * @param $threshold
	 * @param $spd
	 * @param $str
	 * @param $mat
	 * @param $rat
	 * @param $def
	 * @param $arm
	 * @param $cmd
	 * @param $damageBoxes
	 * @param $damageGrid
	 * @param $damageSpiral
	 * @param $animusKnown
	 * @param $mount
	 * @param $mountAbility
	 * @param $mountAbility2
	 * @param $baseSize
	 * @param $weapon1
	 * @param $weapon2
	 * @param $weapon3
	 * @param $weapon4
	 * @param $weapon5
	 * @param $specialAbility1
	 * @param $specialAbility2
	 * @param $specialAbility3
	 * @param $specialAbility4
	 * @param $specialAbility5
	 * @param $specialAbility6
	 * @param $specialAbility7
	 * @param $specialAbility8
	 * @param $specialAbility9
	 * @param $specialAbility10
	 * @param $spell1
	 * @param $spell2
	 * @param $spell3
	 * @param $spell4
	 * @param $spell5
	 * @param $spell6
	 * @param $spell7
	 * @param $spell8
	 * @param $spell9
	 * @param $spell10
	 * @param $feat
	 * @param $attachedTo
	 * @param $companion
	 * @param $leader
	 */
	function saveUnits($name, $faction, $relatedFaction, $unitType, $title, $cost, $bgPoints, $fieldAllowance, $purchaseLow, $purchaseHigh, $focus, $fury, $threshold, $spd, $str, $mat, $rat, $def, $arm, $cmd, $damageBoxes, $damageGrid, $damageSpiral, $animusKnown, $mount, $mountAbility, $mountAbility2, $baseSize, $weapon1, $weapon2, $weapon3, $weapon4, $weapon5, $specialAbility1, $specialAbility2, $specialAbility3, $specialAbility4, $specialAbility5, $specialAbility6, $specialAbility7, $specialAbility8, $specialAbility9, $specialAbility10, $spell1, $spell2, $spell3, $spell4, $spell5, $spell6, $spell7, $spell8, $spell9, $spell10, $feat, $attachedTo, $companion, $leader){
		//$conn = $this->connect();

		$name = "'".$name."'";
		$faction = "'".$faction."'";
		if ($relatedFaction == ''){$relatedFaction = 'NULL';} else {$relatedFaction = "'".$relatedFaction."'";}
		$unitType = "'".$unitType."'";
		$title = "'".$title."'";
		$cost = "'".$cost."'";
		if ($bgPoints == ''){$bgPoints = 'NULL';} else {$bgPoints = "'".$bgPoints."'";}
		if ($fieldAllowance == ''){$fieldAllowance = 'NULL';} else {$fieldAllowance = "'".$fieldAllowance."'";}
		if ($purchaseLow == ''){$purchaseLow = 'NULL';} else {$purchaseLow = "'".$purchaseLow."'";}
		if ($purchaseHigh == ''){$purchaseHigh = 'NULL';} else {$purchaseHigh = "'".$purchaseHigh."'";}
		if ($focus == ''){$focus = 'NULL';} else {$focus = "'".$focus."'";}
		if ($fury == ''){$fury = 'NULL';} else {$fury = "'".$fury."'";}
		if ($threshold == ''){$threshold = 'NULL';} else {$threshold = "'".$threshold."'";}
		$spd = "'".$spd."'";
		$str = "'".$str."'";
		$mat = "'".$mat."'";
		$rat = "'".$rat."'";
		$def = "'".$def."'";
		$arm = "'".$arm."'";
		if ($cmd == ''){$cmd = 'NULL';} else {$cmd = "'".$cmd."'";}
		$damageBoxes = "'".$damageBoxes."'";
		if ($damageGrid == ''){$damageGrid = 'NULL';} else {$damageGrid = "'".$damageGrid."'";}
		if ($damageSpiral == ''){$damageSpiral = 'NULL';} else {$damageSpiral = "'".$damageSpiral."'";}
		if ($animusKnown == ''){$animusKnown = 'NULL';} else {$animusKnown = "'".$animusKnown."'";}
		if ($mount == ''){$mount = 'NULL';} else {$mount = "'".$mount."'";}
		if ($mountAbility == ''){$mountAbility = 'NULL';} else {$mountAbility = "'".$mountAbility."'";}
		if ($mountAbility2 == ''){$mountAbility2 = 'NULL';} else {$mountAbility2 = "'".$mountAbility2."'";}
		$baseSize = "'".$baseSize."'";
		if ($weapon1 == ''){$weapon1 = 'NULL';} else {$weapon1 = "'".$weapon1."'";}
		if ($weapon2 == ''){$weapon2 = 'NULL';} else {$weapon2 = "'".$weapon2."'";}
		if ($weapon3 == ''){$weapon3 = 'NULL';} else {$weapon3 = "'".$weapon3."'";}
		if ($weapon4 == ''){$weapon4 = 'NULL';} else {$weapon4 = "'".$weapon4."'";}
		if ($weapon5 == ''){$weapon5 = 'NULL';} else {$weapon5 = "'".$weapon5."'";}
		if ($specialAbility1 == ''){$specialAbility1 = 'NULL';} else {$specialAbility1 = "'".$specialAbility1."'";}
		if ($specialAbility2 == ''){$specialAbility2 = 'NULL';} else {$specialAbility2 = "'".$specialAbility2."'";}
		if ($specialAbility3 == ''){$specialAbility3 = 'NULL';} else {$specialAbility3 = "'".$specialAbility3."'";}
		if ($specialAbility4 == ''){$specialAbility4 = 'NULL';} else {$specialAbility4 = "'".$specialAbility4."'";}
		if ($specialAbility5 == ''){$specialAbility5 = 'NULL';} else {$specialAbility5 = "'".$specialAbility5."'";}
		if ($specialAbility6 == ''){$specialAbility6 = 'NULL';} else {$specialAbility6 = "'".$specialAbility6."'";}
		if ($specialAbility7 == ''){$specialAbility7 = 'NULL';} else {$specialAbility7 = "'".$specialAbility7."'";}
		if ($specialAbility8 == ''){$specialAbility8 = 'NULL';} else {$specialAbility8 = "'".$specialAbility8."'";}
		if ($specialAbility9 == ''){$specialAbility9 = 'NULL';} else {$specialAbility9 = "'".$specialAbility9."'";}
		if ($specialAbility10 == ''){$specialAbility10 = 'NULL';} else {$specialAbility10 = "'".$specialAbility10."'";}
		if ($spell1 == ''){$spell1 = 'NULL';} else {$spell1 = "'".$spell1."'";}
		if ($spell2 == ''){$spell2 = 'NULL';} else {$spell2 = "'".$spell2."'";}
		if ($spell3 == ''){$spell3 = 'NULL';} else {$spell3 = "'".$spell3."'";}
		if ($spell4 == ''){$spell4 = 'NULL';} else {$spell4 = "'".$spell4."'";}
		if ($spell5 == ''){$spell5 = 'NULL';} else {$spell5 = "'".$spell5."'";}
		if ($spell6 == ''){$spell6 = 'NULL';} else {$spell6 = "'".$spell6."'";}
		if ($spell7 == ''){$spell7 = 'NULL';} else {$spell7 = "'".$spell7."'";}
		if ($spell8 == ''){$spell8 = 'NULL';} else {$spell8 = "'".$spell8."'";}
		if ($spell9 == ''){$spell9 = 'NULL';} else {$spell9 = "'".$spell9."'";}
		if ($spell10 == ''){$spell10 = 'NULL';} else {$spell10 = "'".$spell10."'";}
		if ($feat == ''){$feat = 'NULL';} else {
			$feat = str_replace("'", "\'", $feat);
			$feat = "'".$feat."'";
			}
		if ($attachedTo == ''){$attachedTo = 'NULL';} else {$attachedTo = "'".$attachedTo."'";}
		if ($companion == ''){$companion = 'NULL';} else {$companion = "'".$companion."'";}
        if ($leader == ''){$leader = 'NULL';} else {$leader = "'".$leader."'";}

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "INSERT INTO core (name, faction, related_factions, type, title, cost, bg_points, field_allowance, purchased_low, purchased_high, focus, fury, threshold, spd, str, mat, rat, def, arm, cmd, damage_boxes, damage_grid, damage_spiral, animus_known, mount, mount_ability, mount_ability2, base_size, weapon1, weapon2, weapon3, weapon4, weapon5, special_ability_1, special_ability_2, special_ability_3, special_ability_4, special_ability_5, special_ability_6, special_ability_7, special_ability_8, special_ability_9, special_ability_10, spell_1, spell_2, spell_3, spell_4, spell_5, spell_6, spell_7, spell_8, spell_9, spell_10, feat, attached_to, companion, unit_leader)
		VALUES (".$name.", ".$faction.", ".$relatedFaction.", ".$unitType.", ".$title.", ".$cost.", ".$bgPoints.", ".$fieldAllowance.", ".$purchaseLow.", ".$purchaseHigh.", ".$focus.", ".$fury.", ".$threshold.", ".$spd.", ".$str.", ".$mat.", ".$rat.", ".$def.", ".$arm.", ".$cmd.", ".$damageBoxes.", ".$damageGrid.", ".$damageSpiral.", ".$animusKnown.", ".$mount.", ".$mountAbility.", ".$mountAbility2.", ".$baseSize.", ".$weapon1.", ".$weapon2.", ".$weapon3.", ".$weapon4.", ".$weapon5.", ".$specialAbility1.", ".$specialAbility2.", ".$specialAbility3.", ".$specialAbility4.", ".$specialAbility5.", ".$specialAbility6.", ".$specialAbility7.", ".$specialAbility8.", ".$specialAbility9.", ".$specialAbility10.", ".$spell1.", ".$spell2.", ".$spell3.", ".$spell4.", ".$spell5.", ".$spell6.", ".$spell7.", ".$spell8.", ".$spell9.", ".$spell10.", ".$feat.", ".$attachedTo.", ".$companion.", ".$leader.")";
		if ($mysqli->query($sql_query) === TRUE){
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql_query . "<br>" . $mysqli->error;
		}

		//$sql = "INSERT INTO core (name, faction, related_factions, type, title, cost, bg_points, field_allowance, purchased_low, purchased_high, focus, fury, threshold, spd, str, mat, rat, def, arm, cmd, damage_boxes, damage_grid, damage_spiral, animus_known, mount, mount_ability, mount_ability2, base_size, weapon1, weapon2, weapon3, weapon4, weapon5, special_ability_1, special_ability_2, special_ability_3, special_ability_4, special_ability_5, special_ability_6, special_ability_7, special_ability_8, special_ability_9, special_ability_10, spell_1, spell_2, spell_3, spell_4, spell_5, spell_6, spell_7, spell_8, spell_9, spell_10, feat, attached_to, companion, unit_leader)
		//VALUES (".$name.", ".$faction.", ".$relatedFaction.", ".$unitType.", ".$title.", ".$cost.", ".$bgPoints.", ".$fieldAllowance.", ".$purchaseLow.", ".$purchaseHigh.", ".$focus.", ".$fury.", ".$threshold.", ".$spd.", ".$str.", ".$mat.", ".$rat.", ".$def.", ".$arm.", ".$cmd.", ".$damageBoxes.", ".$damageGrid.", ".$damageSpiral.", ".$animusKnown.", ".$mount.", ".$mountAbility.", ".$mountAbility2.", ".$baseSize.", ".$weapon1.", ".$weapon2.", ".$weapon3.", ".$weapon4.", ".$weapon5.", ".$specialAbility1.", ".$specialAbility2.", ".$specialAbility3.", ".$specialAbility4.", ".$specialAbility5.", ".$specialAbility6.", ".$specialAbility7.", ".$specialAbility8.", ".$specialAbility9.", ".$specialAbility10.", ".$spell1.", ".$spell2.", ".$spell3.", ".$spell4.", ".$spell5.", ".$spell6.", ".$spell7.", ".$spell8.", ".$spell9.", ".$spell10.", ".$feat.", ".$attachedTo.", ".$companion.", ".$leader.")";

		//if ($conn->query($sql) === TRUE) {
		//	echo "New record created successfully<br>";
		//} else {
		//	echo "Error: " . $sql . "<br>" . $conn->error;
		//}

		//mysqli_close($conn); //$conn->close();
	}

	/**
	 * @param $name
	 * @return mixed|string
	 */
	function getUnitImageName($name){
		$nameFixed = str_replace(' ','',$name);
		$nameFixed = str_replace(',','',$nameFixed);
		$nameFixed = str_replace('.','',$nameFixed);
		$nameFixed = str_replace('(','',$nameFixed);
		$nameFixed = str_replace(')','',$nameFixed);
		$filePath = $_SERVER['DOCUMENT_ROOT']."/res/unit_images/".$nameFixed.".jpg";
		if (file_exists($filePath)){
			$nameFixed = '<img src="/res/unit_images/'.$nameFixed.'.jpg" alt="'.$name.'" class="unit-image" />';
		}
		else {
			$nameFixed = '<img src="/res/unit_images/no-image.jpg" alt="'.$name.'" class="unit-image" />';
		}
		return $nameFixed;
	}

	/**
	 * @param $name
	 * @return mixed|string
	 */
	function getUnitImageThumbnail($name){
		$nameFixed = str_replace(' ','',$name);
		$nameFixed = str_replace(',','',$nameFixed);
		$nameFixed = str_replace('.','',$nameFixed);
		$nameFixed = str_replace('(','',$nameFixed);
		$nameFixed = str_replace(')','',$nameFixed);
		$filePath = $_SERVER['DOCUMENT_ROOT']."/res/unit_images/thumbs/".$nameFixed.".jpg";
		if (file_exists($filePath)){
			$nameFixed = '<img src="/res/unit_images/thumbs/'.$nameFixed.'.jpg" alt="'.$name.'" class="unit-image unit-thumbnail" />';
		}
		else {
			$nameFixed = '<img src="/res/unit_images/thumbs/no-image.jpg" alt="'.$name.'" class="unit-image unit-thumbnail" />';
		}
		return $nameFixed;
	}

	function getUnitImageSrc($name){
		$nameFixed = str_replace(' ','',$name);
		$nameFixed = str_replace(',','',$nameFixed);
		$nameFixed = str_replace('.','',$nameFixed);
		$nameFixed = str_replace('(','',$nameFixed);
		$nameFixed = str_replace(')','',$nameFixed);
		$filePath = $_SERVER['DOCUMENT_ROOT']."/res/unit_images/thumbs/".$nameFixed.".jpg";
		if (file_exists($filePath)){
			$nameFixed = '/res/unit_images/thumbs/'.$nameFixed.'.jpg';
		}
		else {
			$nameFixed = '/res/unit_images/thumbs/no-image.jpg';
		}
		return $nameFixed;
	}

	/**
	 * @param $companionList
	 * @return array
	 */
	function createCompanionArray($companionList){
		$units = explode("|", $companionList);
		return $units;
	}

	/**
	 * @param $input
	 * @return string
	 */
	function getSpiralDisplay($input){
		$i = explode("]", $input);
		// set each of the 3 branches to their total number entered
		$mindTotal = substr($i[0], 4);
		$bodyTotal = substr($i[1], 4);
		$spiritTotal = substr($i[2], 4);
		// build the branches of the spiral for html output
		$spiralBuild = '<div class="spiral-branch-mind"><span class="branch-title">Mind</span><ul>';
		$i = 0;
		while ($i < $mindTotal){
			if ($i < 2){ $spiralBuild .= '<li class="joined"><span class="damage-box"></span></li>';}
			else {$spiralBuild .= '<li><span class="damage-box"></span></li>';}
			$i++;
		}
		$spiralBuild .= '</ul></div>';
		$spiralBuild .= '<div class="spiral-branch-body"><span class="branch-title">Body</span><ul>';
		$i = 0;
		while ($i < $bodyTotal){
			if ($i < 0){ $spiralBuild .= '<li class="joined"><span class="damage-box"></span></li>';}
			$spiralBuild .= '<li><span class="damage-box"></span></li>';
			$i++;
		}
		$spiralBuild .= '</ul></div>';
		$spiralBuild .= '<div class="spiral-branch-spirit"><span class="branch-title">Spirit</span><ul>';
		$i = 0;
		while ($i < $spiritTotal){
			if ($i < 0){ $spiralBuild .= '<li class="joined"><span class="damage-box"></span></li>';}
			$spiralBuild .= '<li><span class="damage-box"></span></li>';
			$i++;
		}
		$spiralBuild .= '</ul></div>';

		return $spiralBuild;
	}

	/**
	 * @param $input
	 * @return string
	 */
	function getGridDisplay($input){
		if (strpos($input,'Left') !== false){
			// colassal damge grids 1 left 1 right
			$rStart = strpos($input,'Right') + 5;
			$right = substr($input,$rStart);
			$right = substr($right,'2');
			$left = substr($input, 4, (strlen($input)-strlen($right))-9);
			$left = substr($left,'2');
			$leftGrid = $this->gridDisplayBuild($left);
			$rightGrid = $this->gridDisplayBuild($right);
			$output = '<table class="grid-display left-grid"><tr><th colspan="6">Left</th></tr>'.$leftGrid.'</table><table class="grid-display right-grid"><tr><th colspan="6">Right</th></tr>'.$rightGrid.'</table>';
			return $output;
		}
		else { // normal models with a single grid
			$grid = $this->gridDisplayBuild($input);
			$output = '<table class="grid-display">'.$grid.'</table>';
			return $output;
		}
	}

	/**
	 * @param $grid
	 * @return string
	 */
	function gridDisplayBuild($grid){
		$lines = explode("]", $grid);
		$i = 0;
		foreach ($lines as $line){
			$lines[$i] = substr($line,2);
			$i++;
		}
		$i = 0;
		foreach ($lines as $line){
			$lines[$i] = explode(',',$line);
			if (!isset($lines[$i][1])){
				array_unshift($lines[$i], '0');
			}
			if (!isset($lines[$i][2])){
				array_unshift($lines[$i], '0');
			}
			if (!isset($lines[$i][3])){
				array_unshift($lines[$i], '0');
			}
			if (!isset($lines[$i][4])){
				array_unshift($lines[$i], '0');
			}
			if (!isset($lines[$i][5])){
				array_unshift($lines[$i], '0');
			}
			$i++;
		}
		unset($lines[6]);
		$print = '';
		$x = 0;
		while ($x < 6){
			$print .= '<tr>';
			$y = 0;
			while ($y < 6){
				if ($lines[$y][$x] == '0'){
					$print .= '<td class="grid-empty"></td>';
				} else if ($lines[$y][$x] == '1'){
					$print .= '<td class="grid-box"></td>';
				} else {
					$print .= '<td class="grid-system">'.$lines[$y][$x].'</td>';
				}
				$y++;
			}
			$print .= '</tr>';
			$x++;
		}
		return $print;
	}

	/**
	 * @param $cost
	 * @return array
	 */
	function getCleanCost($cost){
		if (strpos($cost,',') !== false) {
			$cost = explode(', ',$cost);
			return $cost[1];
		}
		else {
			return $cost;
		}
	}

	/**
	 * @param $fa
	 * @param $minUnit
	 * @param $maxUnit
	 * @return int
	 */
    function getTotalAllowedBarracksModelCount($fa,$minUnit,$maxUnit){
        if ($maxUnit == ''){$maxUnit = 1;} // set empty $maxUnit to 1
        if ($fa == 'C'){ // for character model/units
            $maxCount = $maxUnit * 2; // even though it's a character unit, count this twice, as people may own more than one.
        }
        else if ($fa == 'U'){ // for unlimited model/units
            $maxCount = $maxUnit * 8; //allow the max unit to be counted up to 8x it's original number
        }
        else {
            $maxCount = $maxUnit * $fa * 2; // if there is a hard field allowance rule, could double that field allowance times the max number of models in that unit.
            $maxCount = $maxCount + $fa;
        }
        $maxCount = $maxCount + 1; // to set the true count and disregard the staring 0 in the select dropdown.
        return $maxCount;
    }

	/**
	 * @param $unit
	 * @return string
	 */
	function displayArmyBuilderStatsLine($unit){
		$unitsList = '';
        if($unit['type'] == 'Warlock' || $unit['type'] == 'Warcaster'):
			$unitsList = $this->getWarcasterWarlockUnits();
		elseif ($unit['type'] == 'Colossal' || $unit['type'] == 'Colossal Vector' || $unit['type'] == 'Gargantuan'):
			$unitsList = $this->getColossalUnits();
		elseif ($unit['type'] == 'Heavy Myrmidon' || $unit['type'] == 'Heavy Vector' || $unit['type'] == 'Heavy Warbeast' || $unit['type'] == 'Heavy Warjack' || $unit['type'] == 'Helljack'):
			$unitsList = $this->getHeavyUnits();
		elseif ($unit['type'] == "Lesser Warbeast" || $unit['type'] == 'Light Myrmidon' || $unit['type'] == 'Light Vector' || $unit['type'] == 'Light Warbeast' || $unit['type'] == 'Light Warjack' || $unit['type'] == 'Bone Jack'):
			$unitsList = $this->getLightUnits();
		elseif ($unit['type'] == "Unit" || $unit['type'] == 'Character Unit' || $unit['type'] == 'Warbeast Pack' || $unit['type'] == 'Cavalry Unit' || $unit['type'] == 'Unit Attachment' || $unit['type'] == 'Weapon Crew Unit'):
			$unitsList = $this->getUnitUnits();
		elseif ($unit['type'] == "Solo" || $unit['type'] == 'Character Solo'):
			$unitsList = $this->getSoloUnits();
		elseif ($unit['type'] == "Battle Engine"):
			$unitsList = $this->getBattleEngineUnits();
		endif;

        $averages = $this->getAveragesWarcasterWarlock($unitsList);
		$outputHtml = '';
		$outputHtml .= '<div class="cushion">';
		$outputHtml .= '<table class="stats-bars left">';
		$outputHtml .= '<tr><th>SPD</th><td>';
		$percent = $this->getSlidePos(min($averages['all-spd']),max($averages['all-spd']),$unit['spd']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		$outputHtml .= '<tr><th>STR</th><td>';
		$percent = $this->getSlidePos(min($averages['all-str']),max($averages['all-str']),$unit['str']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		$outputHtml .= '<tr><th>MAT</th><td>';
		$percent = $this->getSlidePos(min($averages['all-mat']),max($averages['all-mat']),$unit['mat']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		$outputHtml .= '<tr><th>RAT</th><td>';
		$percent = $this->getSlidePos(min($averages['all-rat']),max($averages['all-rat']),$unit['rat']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		$outputHtml .= '<tr><th>DEF</th><td>';
		$percent = $this->getSlidePos(min($averages['all-def']),max($averages['all-def']),$unit['def']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		$outputHtml .= '<tr><th>ARM</th><td>';
		$percent = $this->getSlidePos(min($averages['all-arm']),max($averages['all-arm']),$unit['arm']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		$outputHtml .= '<tr><th>Damage Boxes</th><td>';
		rsort($averages['all-dmg']);
		$percent = $this->getSlidePos(min($averages['all-dmg']),$averages['all-dmg'][1],$unit['damage_boxes']);
		$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		if ($unit['type'] == 'Warlock' || $unit['type'] == 'Warcaster'):
			$outputHtml .= '<tr><th>BG Points</th><td>';
			$percent = $this->getSlidePos(min($averages['all-bgpoints']),max($averages['all-bgpoints']),$unit['bg_points']);
			$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		endif;
		if ($unit['focus'] != '' || $unit['fury'] != ''):
			$focusfury = '';
 			if ($unit['focus'] != ''):
				$outputHtml .= '<tr><th>Focus</th><td>';
 					$focusfury = $unit['focus'];
 			elseif ($unit['fury'] != ''):
 				$outputHtml .= '<tr><th>Focus</th><td>';
 				$focusfury = $unit['fury'];
 			endif;
			$percent = $this->getSlidePos(min($averages['all-focusfury']),max($averages['all-focusfury']),$focusfury);
			$outputHtml .= '<div class="slider"><div class="slider-pos '.$this->getSliderColor($percent).'" style="width:'.round($percent).'%;"></div></div></td></tr>';
		endif;
	if ($unit['feat'] != ''):
		$outputHtml .= '<tr><td colspan="2"><paper-material elevation="1" class="cushion">';
		$outputHtml .= '<strong>Feat:</strong><br />';
		$outputHtml .= '<span style="font-size:12px;">'.$unit['feat'].'</span>';
		$outputHtml .= '</paper-material></td></tr>';
	endif;
	$outputHtml .= '</table>';
	$outputHtml .= '<div class="army-list-model-view-extras">';
	if ($unit['weapon1'] != ''):
		$outputHtml .= '<paper-material elevation="1" class="cushion"><span class="list-head">Weapons</span><hr/><ul>';
		$i = 1;
		while ($i < 6):
			if ($unit['weapon'.$i] != ''):
				$outputHtml .= '<li><span class="line-head">'. $unit['weapon'.$i].'</span></li>';
			endif;
			$i++;
		endwhile;
		$outputHtml .= '</ul>';
		$outputHtml .= '</paper-material>';
	endif;
	if ($unit['special_ability_1'] != ''):
		$outputHtml .= '<paper-material elevation="1" class="cushion"><span class="list-head">Abilities and Special Rules</span><hr/><ul class="special-abilities">';
		$i = 1;
		while ($i < 11):
			if ($unit['special_ability_'.$i] != ''):
				$outputHtml .= '<li><span class="line-head">'. $unit['special_ability_'.$i].'</span></li>';
			endif;
			$i++;
		endwhile;
		$outputHtml .= '</ul>';
		$outputHtml .= '</paper-material>';
	endif;
	if ($unit['spell_1'] != ''):
		$outputHtml .= '<paper-material elevation="1" class="cushion"><span class="list-head">Spells</span><hr/><ul>';
		$i = 1;
		while ($i < 11):
			if ($unit['spell_'.$i] != ''):
				$outputHtml .= '<li><span class="line-head">'. $unit['spell_'.$i].'</span></li>';
			endif;
			$i++;
		endwhile;
		$outputHtml .= '</ul>';
		$outputHtml .= '</paper-material>';
	endif;
	if ($unit['animus_known'] != ''):
		$outputHtml .= '<paper-material elevation="1" class="cushion"><span class="list-head">Animus</span><hr/><ul>';
		$outputHtml .= '<li><span class="line-head">'. $unit['animus_known'].'</span></li>';
		$outputHtml .= '</ul>';
		$outputHtml .= '</paper-material>';
	endif;
	$outputHtml .= '</div>';
 	$outputHtml .= '</div>';

		return $outputHtml;
	}

	function writeModelsToJsonFile() {
		$allAbilities = new AllSpecialAbilities();
		$allWeapons = new AllWeapons();
		$allAnimus = new AllAnimusKnown();
		$allSpells = new AllSpellsKnown();
		$allTiers = new AllTieredLists();
		$msg = 'done running';
		$response = $this->getAllUnits();
		foreach ($response as $key => $model){
			$response[$key]['img_thumb_src'] = $this->getUnitImageSrc($model['name']);
			if ($response[$key]['special_ability_1'] != null){$response[$key]['special_ability_1'] = $allAbilities->getAbilityByName($response[$key]['special_ability_1']);}
			if ($response[$key]['special_ability_2'] != null){$response[$key]['special_ability_2'] = $allAbilities->getAbilityByName($response[$key]['special_ability_2']);}
			if ($response[$key]['special_ability_3'] != null){$response[$key]['special_ability_3'] = $allAbilities->getAbilityByName($response[$key]['special_ability_3']);}
			if ($response[$key]['special_ability_4'] != null){$response[$key]['special_ability_4'] = $allAbilities->getAbilityByName($response[$key]['special_ability_4']);}
			if ($response[$key]['special_ability_5'] != null){$response[$key]['special_ability_5'] = $allAbilities->getAbilityByName($response[$key]['special_ability_5']);}
			if ($response[$key]['special_ability_6'] != null){$response[$key]['special_ability_6'] = $allAbilities->getAbilityByName($response[$key]['special_ability_6']);}
			if ($response[$key]['special_ability_7'] != null){$response[$key]['special_ability_7'] = $allAbilities->getAbilityByName($response[$key]['special_ability_7']);}
			if ($response[$key]['special_ability_8'] != null){$response[$key]['special_ability_8'] = $allAbilities->getAbilityByName($response[$key]['special_ability_8']);}
			if ($response[$key]['special_ability_9'] != null){$response[$key]['special_ability_9'] = $allAbilities->getAbilityByName($response[$key]['special_ability_9']);}
			if ($response[$key]['special_ability_10'] != null){$response[$key]['special_ability_10'] = $allAbilities->getAbilityByName($response[$key]['special_ability_10']);}
			if ($response[$key]['mount_ability'] != null){$response[$key]['mount_ability'] = $allAbilities->getAbilityByName($response[$key]['mount_ability']);}
			if ($response[$key]['mount_ability2'] != null){$response[$key]['mount_ability2'] = $allAbilities->getAbilityByName($response[$key]['mount_ability2']);}
			if ($response[$key]['spell_1'] != null){$response[$key]['spell_1'] = $allSpells->getSpellByName($response[$key]['spell_1']);}
			if ($response[$key]['spell_2'] != null){$response[$key]['spell_2'] = $allSpells->getSpellByName($response[$key]['spell_2']);}
			if ($response[$key]['spell_3'] != null){$response[$key]['spell_3'] = $allSpells->getSpellByName($response[$key]['spell_3']);}
			if ($response[$key]['spell_4'] != null){$response[$key]['spell_4'] = $allSpells->getSpellByName($response[$key]['spell_4']);}
			if ($response[$key]['spell_5'] != null){$response[$key]['spell_5'] = $allSpells->getSpellByName($response[$key]['spell_5']);}
			if ($response[$key]['spell_6'] != null){$response[$key]['spell_6'] = $allSpells->getSpellByName($response[$key]['spell_6']);}
			if ($response[$key]['spell_7'] != null){$response[$key]['spell_7'] = $allSpells->getSpellByName($response[$key]['spell_7']);}
			if ($response[$key]['spell_8'] != null){$response[$key]['spell_8'] = $allSpells->getSpellByName($response[$key]['spell_8']);}
			if ($response[$key]['spell_9'] != null){$response[$key]['spell_9'] = $allSpells->getSpellByName($response[$key]['spell_9']);}
			if ($response[$key]['spell_10'] != null){$response[$key]['spell_10'] = $allSpells->getSpellByName($response[$key]['spell_10']);}
			if ($response[$key]['weapon1'] != null){$response[$key]['weapon1'] = $allWeapons->getWeaponByName($response[$key]['weapon1']);}
			if ($response[$key]['weapon2'] != null){$response[$key]['weapon2'] = $allWeapons->getWeaponByName($response[$key]['weapon2']);}
			if ($response[$key]['weapon3'] != null){$response[$key]['weapon3'] = $allWeapons->getWeaponByName($response[$key]['weapon3']);}
			if ($response[$key]['weapon4'] != null){$response[$key]['weapon4'] = $allWeapons->getWeaponByName($response[$key]['weapon4']);}
			if ($response[$key]['weapon5'] != null){$response[$key]['weapon5'] = $allWeapons->getWeaponByName($response[$key]['weapon5']);}
			if ($response[$key]['animus_known'] != null){$response[$key]['animus_known'] = $allAnimus->getAnimusByName($response[$key]['animus_known']);}

			// add in the block type this model is be shown in
			$leader = array('Calvalry Battle Engine Warlock', 'Warlock', 'Warlock Unit', 'Warcaster', 'Warcaster Unit');
			if (in_array($response[$key]['type'], $leader)){
				$response[$key]['block_type'] = 'leader';
			}

			$battleGroup = array ('Bone Jack', 'Colossal', 'Colossal Vector', 'Gargantuan', 'Heavy Myrmidon', 'Heavy Vector', 'Heavy Warbeast', 'Heavy Warjack', 'Helljack', 'Lesser Warbeast', 'Light Myrmidon', 'Light Vector', 'Light Warbeast', 'Light Warjack', 'Warbeast Pack');
			if (in_array($response[$key]['type'], $battleGroup)){
				$response[$key]['block_type'] = 'battle-group';
			}

			$unit = array ('Cavalry Unit', 'Character Unit', 'Unit');
			if (in_array($response[$key]['type'], $unit)){
				$response[$key]['block_type'] = 'unit';
			}

			$solo = array ('Character Solo', 'Solo');
			if (in_array($response[$key]['type'], $solo)){
				$response[$key]['block_type'] = 'solo';
			}

			if ($response[$key]['type'] == 'Battle Engine'){$response[$key]['block_type'] = 'battle-engine';}


			// if caster, get tiered lists
			if ($response[$key]['type'] == 'Warlock' || $response[$key]['type'] == 'Warcaster' || $response[$key]['type'] == 'Warcaster Unit' || $response[$key]['type'] == 'Warloock Unit'){
				$i = 1;
				$tiers = $allTiers->getTierByCasterId($response[$key]['id']);
				if ($tiers != null){
					foreach ($tiers as $tier){
						$response[$key]['tiered_list_'.$i] = $tier;
						$i++;
					}
				}
			}

		}

		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/node/db/models.js', 'w');
		fwrite($fp, 'var models_db = '.json_encode($response).';');
		fclose($fp);
		$fpNode = fopen($_SERVER['DOCUMENT_ROOT'].'/node/db/models_db.js', 'w');
		fwrite($fpNode, 'var models_db = '.json_encode($response).'; exports.db = models_db;');
		fclose($fpNode);
		return $msg;
	}


}
