<?php

class AllTieredLists extends AllCore
{
	/**
	 * @return string
	 */
	function getAllTieredLists(){
		$conn = $this->connect();

		$lists = "SELECT * FROM tiered_list ORDER BY name";
		$listsResult = $conn->query($lists);
		$listsBuild = '';
		if ($listsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $listsResult->fetch_assoc()) {
				$listsBuild[$i] = $row;
				$i++;
			}
		}
		mysqli_close($conn); //$conn->close();
		return $listsBuild;
	}

	/**
	 * @param $tierId
	 * @return array|bool|string
	 */
	function getTieredListById($tierId){
		$conn = $this->connect();

		$lists = "SELECT * FROM tiered_list WHERE id = '".$tierId."' ORDER BY name";
		$listsResult = $conn->query($lists);
		$listsBuild = '';
		if ($listsResult->num_rows > 0) {
			while($row = $listsResult->fetch_assoc()) {
				$listsBuild = $row;
			}
		}
		mysqli_close($conn); //$conn->close();
		return $listsBuild;
	}

	/**
	 * @param $name
	 * @param $faction
	 * @param $caster
	 * @param $description
	 * @param $reqBattlegroupFront
	 * @param $reqBattlegroupRules
	 * @param $reqUnitsFront
	 * @param $reqUnitsRules
	 * @param $reqSolosFront
	 * @param $reqSolosRules
	 * @param $reqBattleengineFront
	 * @param $reqBattleengineRules
	 * @param $tier1BonusFront
	 * @param $tier1Bonus
	 * @param $tier1ReqFront
	 * @param $tier1Req
	 * @param $tier2BonusFront
	 * @param $tier2Bonus
	 * @param $tier2ReqFront
	 * @param $tier2Req
	 * @param $tier3BonusFront
	 * @param $tier3Bonus
	 * @param $tier3ReqFront
	 * @param $tier3Req
	 * @param $tier4BonusFront
	 * @param $tier4Bonus
	 * @param $tier4ReqFront
	 * @param $tier4Req
	 */
	function saveTieredLists($name, $faction, $caster, $description, $reqBattlegroupFront, $reqBattlegroupRules, $reqUnitsFront, $reqUnitsRules, $reqSolosFront, $reqSolosRules, $reqBattleengineFront, $reqBattleengineRules, $tier1BonusFront, $tier1Bonus, $tier1ReqFront, $tier1Req, $tier2BonusFront, $tier2Bonus, $tier2ReqFront,$tier2Req, $tier3BonusFront, $tier3Bonus, $tier3ReqFront,$tier3Req, $tier4BonusFront, $tier4Bonus, $tier4ReqFront, $tier4Req){
		$conn = $this->connect();
		$name = "'".$name."'";
		$faction = "'".$faction."'";
		$caster = "'".$caster."'";
		if ($description == ''){$description = 'NULL';} else {
			$description = str_replace("'", "\'", $description);
			$description = "'".$description."'";
			}
		if ($reqBattlegroupFront == ''){$reqBattlegroupFront = 'NULL';} else {
			$reqBattlegroupFront = str_replace("'", "\'", $reqBattlegroupFront);
			$reqBattlegroupFront = "'".$reqBattlegroupFront."'";
		}
		if ($reqBattlegroupRules == ''){$reqBattlegroupRules = 'NULL';} else {
			$reqBattlegroupRules = str_replace("'", "\'", $reqBattlegroupRules);
			$reqBattlegroupRules = "'".$reqBattlegroupRules."'";
		}
		if ($reqUnitsFront == ''){$reqUnitsFront = 'NULL';} else {
			$reqUnitsFront = str_replace("'", "\'", $reqUnitsFront);
			$reqUnitsFront = "'".$reqUnitsFront."'";
		}
		if ($reqUnitsRules == ''){$reqUnitsRules = 'NULL';} else {
			$reqUnitsRules = str_replace("'", "\'", $reqUnitsRules);
			$reqUnitsRules = "'".$reqUnitsRules."'";
		}
		if ($reqSolosFront == ''){$reqSolosFront = 'NULL';} else {
			$reqSolosFront = str_replace("'", "\'", $reqSolosFront);
			$reqSolosFront = "'".$reqSolosFront."'";
		}
		if ($reqSolosRules == ''){$reqSolosRules = 'NULL';} else {
			$reqSolosRules = str_replace("'", "\'", $reqSolosRules);
			$reqSolosRules = "'".$reqSolosRules."'";
		}
		if ($reqBattleengineFront == ''){$reqBattleengineFront = 'NULL';} else {
			$reqBattleengineFront = str_replace("'", "\'", $reqBattleengineFront);
			$reqBattleengineFront = "'".$reqBattleengineFront."'";
		}
		if ($reqBattleengineRules == ''){$reqBattleengineRules = 'NULL';} else {
			$reqBattleengineRules = str_replace("'", "\'", $reqBattleengineRules);
			$reqBattleengineRules = "'".$reqBattleengineRules."'";
		}
		if ($tier1BonusFront == ''){$tier1BonusFront = 'NULL';} else {
			$tier1BonusFront = str_replace("'", "\'", $tier1BonusFront);
			$tier1BonusFront = "'".$tier1BonusFront."'";
			}
		if ($tier1ReqFront == ''){$tier1ReqFront = 'NULL';} else {
			$tier1ReqFront = str_replace("'", "\'", $tier1ReqFront);
			$tier1ReqFront = "'".$tier1ReqFront."'";
		}
		if ($tier1Bonus == ''){$tier1Bonus = 'NULL';} else {
			$tier1Bonus = str_replace("'", "\'", $tier1Bonus);
			$tier1Bonus = "'".$tier1Bonus."'";
		}
		if ($tier1Req == ''){$tier1Req = 'NULL';} else {
			$tier1Req = str_replace("'", "\'", $tier1Req);
			$tier1Req = "'".$tier1Req."'";
		}
		if ($tier2BonusFront == ''){$tier2BonusFront = 'NULL';} else {
			$tier2BonusFront = str_replace("'", "\'", $tier2BonusFront);
			$tier2BonusFront = "'".$tier2BonusFront."'";
		}
		if ($tier2ReqFront == ''){$tier2ReqFront = 'NULL';} else {
			$tier2ReqFront = str_replace("'", "\'", $tier2ReqFront);
			$tier2ReqFront = "'".$tier2ReqFront."'";
		}
		if ($tier2Bonus == ''){$tier2Bonus = 'NULL';} else {
			$tier2Bonus = str_replace("'", "\'", $tier2Bonus);
			$tier2Bonus = "'".$tier2Bonus."'";
		}
		if ($tier2Req == ''){$tier2Req = 'NULL';} else {
			$tier2Req = str_replace("'", "\'", $tier2Req);
			$tier2Req = "'".$tier2Req."'";
		}
		if ($tier3BonusFront == ''){$tier3BonusFront = 'NULL';} else {
			$tier3BonusFront = str_replace("'", "\'", $tier3BonusFront);
			$tier3BonusFront = "'".$tier3BonusFront."'";
		}
		if ($tier3ReqFront == ''){$tier3ReqFront = 'NULL';} else {
			$tier3ReqFront = str_replace("'", "\'", $tier3ReqFront);
			$tier3ReqFront = "'".$tier3ReqFront."'";
		}
		if ($tier3Bonus == ''){$tier3Bonus = 'NULL';} else {
			$tier3Bonus = str_replace("'", "\'", $tier3Bonus);
			$tier3Bonus = "'".$tier3Bonus."'";
		}
		if ($tier3Req == ''){$tier3Req = 'NULL';} else {
			$tier3Req = str_replace("'", "\'", $tier3Req);
			$tier3Req = "'".$tier3Req."'";
		}
		if ($tier4BonusFront == ''){$tier4BonusFront = 'NULL';} else {
			$tier4BonusFront = str_replace("'", "\'", $tier4BonusFront);
			$tier4BonusFront = "'".$tier4BonusFront."'";
		}
		if ($tier4ReqFront == ''){$tier4ReqFront = 'NULL';} else {
			$tier4ReqFront = str_replace("'", "\'", $tier4ReqFront);
			$tier4ReqFront = "'".$tier4ReqFront."'";
		}
		if ($tier4Bonus == ''){$tier4Bonus = 'NULL';} else {
			$tier4Bonus = str_replace("'", "\'", $tier4Bonus);
			$tier4Bonus = "'".$tier4Bonus."'";
		}
		if ($tier4Req == ''){$tier4Req = 'NULL';} else {
			$tier4Req = str_replace("'", "\'", $tier4Req);
			$tier4Req = "'".$tier4Req."'";
		}
		
		
		$sql = "INSERT INTO tiered_list (name, faction, caster, description, tier1_req_front, tier1_bonus_front, tier1_bonus, tier1_req, tier2_req_front, tier2_bonus_front, tier2_bonus, tier2_req, tier3_req_front, tier3_bonus_front, tier3_bonus, tier3_req, tier4_req_front, tier4_bonus_front, tier4_bonus, tier4_req, req_battlegroup_front, req_battlegroup_rules, req_units_front, req_units_rules, req_solos_front, req_solos_rules, req_battleengine_front, req_battleengine_rules)
		VALUES (".$name.", ".$faction.", ".$caster.", ".$description.", ".$tier1ReqFront.", ".$tier1BonusFront.", ".$tier1Bonus.", ".$tier1Req.", ".$tier2ReqFront.", ".$tier2BonusFront.", ".$tier2Bonus.", ".$tier2Req.", ".$tier3ReqFront.", ".$tier3BonusFront.", ".$tier3Bonus.", ".$tier3Req.", ".$tier4ReqFront.", ".$tier4BonusFront.", ".$tier4Bonus.", ".$tier4Req.", ".$reqBattlegroupFront.", ".$reqBattlegroupRules.", ".$reqUnitsFront.", ".$reqUnitsRules.", ".$reqSolosFront.", ".$reqSolosRules.", ".$reqBattleengineFront.", ".$reqBattleengineRules.")";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		mysqli_close($conn); //$conn->close();
	}

	/**
	 * @param $id
	 * @return string
	 */
	function getTierByCasterId($id){
		$conn = $this->connect();

		$list = "SELECT * FROM tiered_list WHERE caster = ".$id." ORDER BY name";
		$listsResult = $conn->query($list);
		$listsBuild = '';
		if ($listsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $listsResult->fetch_assoc()) {
				$listsBuild[$i] = $row;
				$i++;
			}
		}
		mysqli_close($conn); //$conn->close();
	}
}
