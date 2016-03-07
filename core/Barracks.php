<?php

class Barracks extends AllCore
{
	/**
	 * @param $userId
	 * @param $unitName
	 * @param $count
	 * @param $type
	 * @return string
	 */
	function updateUnitForUser($userId, $unitName, $count, $type){
		//$conn = $this->connect();
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		// check if the user already has the unit counted 
		$exists = $this->userModelCountCheck($userId, $unitName, 'count');
		// check again for counted painted models
		if ($exists == ''){
				$exists = $this->userModelCountCheck($userId, $unitName, 'painted');
			}
		if ($exists == ''){
			// add the new value
			$this->addUnitForUser($userId, $unitName, $count, $type);
			if ($type == 'count'){
				$typeMessage = 'models';
			} 
			else { $typeMessage = 'painted models';
			}
			//mysqli_close($conn); //$conn->close();
			return 'This unit has been added. You now have '.$count.' '.$typeMessage.' saved.';
		} 
		else {
			// update the existing record
			$unitName = "'".$unitName."'";
			if ($type == 'count'){
				$sqlUpdate = "UPDATE barracks SET owned_qty=".$count." WHERE user_id=".$userId." AND unit_name=".$unitName."";
				$typeMessage = 'models';
			} 
			else {
				$sqlUpdate = "UPDATE barracks SET painted_qty=".$count." WHERE user_id=".$userId." AND unit_name=".$unitName."";
				$typeMessage = 'painted models';
			}


			if ($mysqli->query($sqlUpdate) === TRUE) {
				return 'This unit has been updated to '.$count.' '.$typeMessage.'.';
			}

			//mysqli_close($conn); //$conn->close();
			}			
	}

	/**
	 * @param $userId
	 * @param $unitName
	 * @param $count
	 * @param $type
	 * @return bool
	 */
	function addUnitForUser($userId, $unitName, $count, $type){
		//$conn = $this->connect();
		$userId = "'".$userId."'";
		$unitName = "'".$unitName."'";
		// install a check to only update the owned or painted and not reset the other to 0
		// switcher
		if ($type == 'count'){
			$ownedQty = "'".$count."'";
			$paintedQty = 0;
		} else {
			$ownedQty = 0;
			$paintedQty = "'".$count."'";
		}

		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "INSERT INTO barracks (user_id, unit_name, owned_qty, painted_qty) VALUES (".$userId.", ".$unitName.", ".$ownedQty.", ".$paintedQty.")";

		//$sqlAdd = "INSERT INTO barracks (user_id, unit_name, owned_qty, painted_qty) VALUES (".$userId.", ".$unitName.", ".$ownedQty.", ".$paintedQty.")";
		
		if ($mysqli->query($sql_query) === TRUE) {
			//mysqli_close($conn); //$conn->close();
			return true;
		} else {
			//mysqli_close($conn); //$conn->close();
			return false;
		}
	}

	/**
	 * @param $userId
	 * @param $unit
	 * @param $type
	 * @return bool|string
	 */
	function userModelCountCheck($userId,$unit,$type){
		$db = database::getInstance();
		$mysqli = $db->getConnection();

		//$conn = $this->connect();
		$unit = "'".$unit."'";
		if ($type == 'count'){
			$sqlCount = "SELECT * FROM barracks WHERE user_id = ".$userId." AND unit_name = ".$unit." ORDER BY unit_name";
			$countResult = $mysqli->query($sqlCount);
			$finalCount = '';
			foreach ($countResult as $row){
				$finalCount .= $row['owned_qty'];
			}
			//mysqli_close($conn); //$conn->close();
			return $finalCount;
		} else if ($type == 'painted') {
			$sqlCount = "SELECT * FROM barracks WHERE user_id = ".$userId." AND unit_name = ".$unit." ORDER BY unit_name";
			$countResult = $mysqli->query($sqlCount);
			$finalCount = '';
			foreach ($countResult as $row){
				$finalCount .= $row['painted_qty'];
			}
			//mysqli_close($conn); //$conn->close();
			return $finalCount;
		}	
		else {return false;}
	}

	/**
	 * // get all users models painted and unpainted
	 * @param $userId
	 * @return string
	 */
	function getAllUserModels($userId){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		//$conn = $this->connect();
		// add in unit class for getting the faction of the units
		$unit = new AllUnits;
        $allFactions = new AllFactions;
		
		$sql = "SELECT * FROM barracks WHERE user_id = ".$userId." AND owned_qty > 0 ORDER BY id";
		$modelsResult = $mysqli->query($sql);
		$finalResuts = array(); $i = 0;
		
		foreach($modelsResult as $row){
			$finalResults[$i] = $row;
			// get the faction of the unit in this row
			$unitFaction = $unit->getFactionByUnitName($row['unit_name']);
			$finalResults[$i]['faction'] = $unitFaction;
            $unitFactionId = $allFactions->getFactionIdByName($unitFaction);
            $finalResults[$i]['faction_id'] = $unitFactionId['id'];
            $finalResults[$i]['model_link'] = "/playtest/single-unit.php?name=".$row['unit_name'];
			$finalResults[$i]['model_id'] = $unit->getUnitIdByName($row['unit_name']);
			$i++;
		}
		//mysqli_close($conn); //$conn->close();
		if ($finalResults == ''){
			return 'No Results Found';
		} else {
			return $finalResults;	
		}
	}

	/**
	 * @param $models
	 * @return int
	 */
	function getTotalOwnedByUser($models){
		$count = 0;
		foreach ($models as $model){
			$count = $count + $model['owned_qty'];
		}
		return $count;
	}

	/**
	 * @param $models
	 * @return int
	 */
	function getTotalPaintedByUser($models){
		$count = 0;
		foreach ($models as $model){
			$count = $count + $model['painted_qty'];
		}
		return $count;
	}

	/**
	 * @param $models
	 * @return string
	 */
	function getAllActiveFactions($models){
		// AllFactions is included in the  barracks.php where this function is called from
		$factions = new AllFactions;
		$factionsList = $factions->getAllFactions();
		$factionsReturn = ''; $i = 0;
		foreach ($factionsList as $faction){
			foreach ($models as $model)	{
				if (in_array($faction['name'],$model)){
					if ($model['owned_qty'] == 0 && $model['painted_qty'] == 0){
					} else {$factionsReturn[$faction['name']] = true;
					}
				}
			}
			$i++;
		}		
		return $factionsReturn;
	}
}

