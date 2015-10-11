<?php

class Barracks
{
	
	function updateUnitForUser($userId, $unitName, $count, $type){
		$core = new AllCore();
		$conn = $core->connect();
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
			if ($conn->query($sqlUpdate) === TRUE) {
				return 'This unit has been updated to '.$count.' '.$typeMessage.'.';
			} 
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();	
			}			
	}
	
	function addUnitForUser($userId, $unitName, $count, $type){
		$core = new AllCore();
		$conn = $core->connect();
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
		
		$sqlAdd = "INSERT INTO barracks (user_id, unit_name, owned_qty, painted_qty) VALUES (".$userId.", ".$unitName.", ".$ownedQty.", ".$paintedQty.")";
		
		if ($conn->query($sqlAdd) === TRUE) {
			return true;
		} else { 
			return false;
		}
		$conn->close();
	}
	
	function userModelCountCheck($userId,$unit,$type){
		$core = new AllCore();
		$conn = $core->connect();
		$unit = "'".$unit."'";
		if ($type == 'count'){
			$sqlCount = "SELECT * FROM barracks WHERE user_id = ".$userId." AND unit_name = ".$unit." ORDER BY unit_name";
			$countResult = $conn->query($sqlCount);
			$finalCount = '';
			foreach ($countResult as $row){
				$finalCount .= $row['owned_qty'];
			}
			return $finalCount;
		} else if ($type == 'painted') {
			$sqlCount = "SELECT * FROM barracks WHERE user_id = ".$userId." AND unit_name = ".$unit." ORDER BY unit_name";
			$countResult = $conn->query($sqlCount);
			$finalCount = '';
			foreach ($countResult as $row){
				$finalCount .= $row['painted_qty'];
			}
			return $finalCount;
		}	
		else {return false;}
	}
	
	function getAllUserModels($userId){
		// get all users models painted and unpainted
		$core = new AllCore();
		$conn = $core->connect();
		// add in unit class for getting the faction of the units
		include 'Unit.php';
		$unit = new AllUnits;
        //include 'Faction.php';
        $allFactions = new AllFactions;
		
		$sql = "SELECT * FROM barracks WHERE user_id = ".$userId." AND owned_qty > 0 ORDER BY id";
		$modelsResult = $conn->query($sql);
		$finalResuts = ''; $i = 0;
		
		foreach($modelsResult as $row){
			$finalResults[$i] = $row;
			// get the faction of the unit in this row
			$unitFaction = $unit->getFactionByUnitName($row['unit_name']);
			$finalResults[$i]['faction'] = $unitFaction;
            $unitFactionId = $allFactions->getFactionIdByName($unitFaction);
            $finalResults[$i]['faction_id'] = $unitFactionId['id'];
            $finalResults[$i]['model_link'] = "/playtest/single-unit.php?name=".$row['unit_name'];
			$i++;
		}
		if ($finalResults == ''){
			return 'No Results Found';
		} else {
			return $finalResults;	
		}
	}
	
	function getTotalOwnedByUser($models){
		$count = 0;
		foreach ($models as $model){
			$count = $count + $model['owned_qty'];
		}
		return $count;
	}
	
	function getTotalPaintedByUser($models){
		$count = 0;
		foreach ($models as $model){
			$count = $count + $model['painted_qty'];
		}
		return $count;
	}
	
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

?>