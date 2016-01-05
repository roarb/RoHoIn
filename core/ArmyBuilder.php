<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 5/3/2015
 * Time: 2:21 PM
 */

class ArmyBuilder extends AllCore
{
    /**
     * @param $armyName
     * @param $armyFaction
     * @param $points
     * @param $actualPoints
     * @param $warcaster1
     * @param $tier1
     * @param $battlegroup1Sql
     * @param $warcaster2
     * @param $tier2
     * @param $battlegroup2Sql
     * @param $warcaster3
     * @param $tier3
     * @param $battlegroup3Sql
     * @param $warcaster4
     * @param $tier4
     * @param $battlegroup4Sql
     * @param $unitsSql
     * @param $solosSql
     * @param $battleEnginesSql
     * @param $mercSolo
     * @param $mercUnits
     * @param $user
     * @param $public
     * @param $notes
     * @return string
     */
    public function createNewArmyList($armyName, $armyFaction, $points, $actualPoints, $warcaster1, $tier1, $battlegroup1Sql, $warcaster2, $tier2, $battlegroup2Sql, $warcaster3, $tier3, $battlegroup3Sql, $warcaster4, $tier4, $battlegroup4Sql, $unitsSql, $solosSql, $battleEnginesSql, $mercSolo, $mercUnits, $user, $public, $notes){
        $conn = $this->connect();

        $armyName = "'".$armyName."'";
        $armyFaction = "'".$armyFaction."'";
        $warcaster1 = "'".$warcaster1."'";
        if ($tier1 == ''){$tier1 = 'NULL';} else {$tier1 = "'".$tier1."'";}
        if ($battlegroup1Sql == ''){$battlegroup1Sql = 'NULL';} else {$battlegroup1Sql = "'".$battlegroup1Sql."'";}
        if ($warcaster2 == ''){$warcaster2 = 'NULL';} else {$warcaster2 = "'".$warcaster2."'";}
        if ($tier2 == ''){$tier2 = 'NULL';} else {$tier2 = "'".$tier2."'";}
        if ($battlegroup2Sql == ''){$battlegroup2Sql = 'NULL';} else {$battlegroup2Sql = "'".$battlegroup2Sql."'";}
        if ($warcaster3 == ''){$warcaster3 = 'NULL';} else {$warcaster3 = "'".$warcaster3."'";}
        if ($tier3 == ''){$tier3 = 'NULL';} else {$tier3 = "'".$tier3."'";}
        if ($battlegroup3Sql == ''){$battlegroup3Sql = 'NULL';} else {$battlegroup3Sql = "'".$battlegroup3Sql."'";}
        if ($warcaster4 == ''){$warcaster4 = 'NULL';} else {$warcaster4 = "'".$warcaster4."'";}
        if ($tier4 == ''){$tier4 = 'NULL';} else {$tier4 = "'".$tier4."'";}
        if ($battlegroup4Sql == ''){$battlegroup4Sql = 'NULL';} else {$battlegroup4Sql = "'".$battlegroup4Sql."'";}
        if ($unitsSql == ''){$unitsSql = 'NULL';} else {$unitsSql = "'".$unitsSql."'";}
        if ($solosSql == ''){$solosSql = 'NULL';} else {$solosSql = "'".$solosSql."'";}
        if ($battleEnginesSql == ''){$battleEnginesSql = 'NULL';} else {$battleEnginesSql = "'".$battleEnginesSql."'";}
        if ($mercSolo == ''){$mercSolo = 'NULL';} else {$mercSolo = "'".$mercSolo."'";}
        if ($mercUnits == ''){$mercUnits = 'NULL';} else {$mercUnits = "'".$mercUnits."'";}
        if ($notes == ''){$notes = 'NULL';} else {$notes = "'".$notes."'";}
        $timeCreated = "'".date("Y-m-d H:i:s")."'";

        $sql = "INSERT INTO army_list (name, faction, points, actual_points, warcaster_1, tier_1, battle_group_1, warcaster_2, tier_2, battle_group_2, warcaster_3, tier_3, battle_group_3, warcaster_4, tier_4, battle_group_4, solos, units, battle_engines, merc_solo, merc_units, created_by, public, notes, time_created)
		VALUES (".$armyName.", ".$armyFaction.", ".$points.", ".$actualPoints.", ".$warcaster1.", ".$tier1.", ".$battlegroup1Sql.", ".$warcaster2.", ".$tier2.", ".$battlegroup2Sql.", ".$warcaster3.", ".$tier3.", ".$battlegroup3Sql.", ".$warcaster4.", ".$tier4.", ".$battlegroup4Sql.", ".$solosSql.", ".$unitsSql.", ".$battleEnginesSql.", ".$mercSolo.", ".$mercUnits.", ".$user.", ".$public.", ".$notes.", ".$timeCreated.")";
        if ($conn->query($sql) === TRUE) {
            echo "New Army List created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $id = $this->getListIdByName($armyName);

        mysqli_close($conn); //$conn->close();
        return $id;
    }

    /**
     * @param $name
     * @param $faction
     * @param $points
     * @param $actual_points
     * @param $warcaster_1
     * @param $tier_1
     * @param $battle_group_1
     * @param $warcaster_2
     * @param $tier_2
     * @param $battle_group_2
     * @param $warcaster_3
     * @param $tier_3
     * @param $battle_group_3
     * @param $warcaster_4
     * @param $tier_4
     * @param $battle_group_4
     * @param $units
     * @param $solos
     * @param $battle_engines
     * @param $journeyman_caster
     * @param $journeyman_battlegroup
     * @param $jackmarshal
     * @param $jackmarshal_battlegroup
     * @param $merc_solo
     * @param $merc_units
     * @param $user
     * @param $public
     * @param $notes
     * @return string
     */
    public function ajaxCreateNewArmyList($name, $faction, $points, $actual_points, $warcaster_1, $tier_1, $battle_group_1, $warcaster_2, $tier_2, $battle_group_2, $warcaster_3, $tier_3, $battle_group_3, $warcaster_4, $tier_4, $battle_group_4, $units, $solos, $battle_engines, $journeyman_caster, $journeyman_battlegroup, $jackmarshal, $jackmarshal_battlegroup, $merc_solo, $merc_units, $user, $public, $notes){
        $conn = $this->connect();

        $name = "'".htmlspecialchars($name)."'";
        $faction = "'".htmlspecialchars($faction)."'";
        $warcaster_1 = "'".$warcaster_1."'";
        if ($battle_group_1 != NULL){$battle_group_1 = "'".$battle_group_1."'";} else {$battle_group_1 = 'NULL';}
        if ($warcaster_2 != NULL){$warcaster_2 = "'".$warcaster_2."'";} else {$warcaster_2 = 'NULL';}
        if ($tier_2 == NULL){$tier_2 = 'NULL';}
        if ($battle_group_2 != ''){$battle_group_2 = "'".$battle_group_2."'";} else {$battle_group_2 = 'NULL';}
        if ($warcaster_3 != NULL){$warcaster_3 = "'".$warcaster_3."'";} else {$warcaster_3 = 'NULL';}
        if ($tier_3 == NULL){$tier_3 = 'NULL';}
        if ($battle_group_3 != NULL){$battle_group_3 = "'".$battle_group_3."'";} else {$battle_group_3 = 'NULL';}
        if ($warcaster_4 != NULL){$warcaster_4 = "'".$warcaster_4."'";} else {$warcaster_4 = 'NULL';}
        if ($tier_4 == NULL){$tier_4 = 'NULL';}
        if ($battle_group_4 != NULL){$battle_group_4 = "'".$battle_group_4."'";} else {$battle_group_4 = 'NULL';}
        if ($units != NULL){$units = "'".$units."'";} else {$units = 'NULL';}
        if ($solos != NULL){$solos = "'".$solos."'";} else {$solos = 'NULL';}
        if ($battle_engines != NULL){$battle_engines = "'".$battle_engines."'";} else {$battle_engines = 'NULL';}
        if ($journeyman_caster == NULL){$journeyman_caster = 'NULL';}
        if ($journeyman_battlegroup != NULL){$journeyman_battlegroup = "'".$journeyman_battlegroup."'";} else {$journeyman_battlegroup = 'NULL';}
        if ($jackmarshal == NULL){$jackmarshal = 'NULL';}
        if ($jackmarshal_battlegroup != NULL){$jackmarshal_battlegroup = "'".$jackmarshal_battlegroup."'";} else {$jackmarshal_battlegroup = 'NULL';}
        if ($merc_solo != NULL){$merc_solo = "'".$merc_solo."'";} else {$merc_solo = 'NULL';}
        if ($merc_units != NULL){$merc_units = "'".$merc_units."'";} else {$merc_units = 'NULL';}
        if ($notes != NULL){$notes = "'".htmlspecialchars($notes)."'";} else {$notes = 'NULL';}
        $timeCreated = "'".date("Y-m-d H:i:s")."'";
        $timeUpdated = $timeCreated;
        $guid = "'".substr(com_create_guid(), 1, -1)."'";

        $sql = "INSERT INTO army_list (name, faction, points, actual_points, warcaster_1, tier_1, battle_group_1, warcaster_2, tier_2, battle_group_2, warcaster_3, tier_3, battle_group_3, warcaster_4, tier_4, battle_group_4, solos, units, battle_engines, journeyman_caster, journeyman_battlegroup, jackmarshal, jackmarshal_battlegroup, merc_solo, merc_units, created_by, public, notes, time_created, updated_at, guid)
		VALUES (".$name.", ".$faction.", ".$points.", ".$actual_points.", ".$warcaster_1.", ".$tier_1.", ".$battle_group_1.", ".$warcaster_2.", ".$tier_2.", ".$battle_group_2.", ".$warcaster_3.", ".$tier_3.", ".$battle_group_3.", ".$warcaster_4.", ".$tier_4.", ".$battle_group_4.", ".$solos.", ".$units.", ".$battle_engines.", ".$journeyman_caster.", ".$journeyman_battlegroup.", ".$jackmarshal.", ".$jackmarshal_battlegroup.", ".$merc_solo.", ".$merc_units.", ".$user.", ".$public.", ".$notes.", ".$timeCreated.", ".$timeUpdated.", ".$guid.")";
        if ($conn->query($sql) === TRUE) {
            mysqli_close($conn); //$conn->close();
            echo $guid;
            return true;
        } else {
            mysqli_close($conn); //$conn->close();
            return false;

        }
    }

    /**
     * @param $name
     * @return string
     */
    public function getListIdByName($name){
        $conn = $this->connect();
        $sql = "SELECT id FROM army_list WHERE name = ".$name;
        $result = $conn->query($sql);
        $id = '';
        foreach ($result as $row)
            $id = $row;
        mysqli_close($conn); //$conn->close();
        return $id;
    }

    /**
     * // $cleanObj[0] => unit name $cleanObj[1] => qty
     * @param $obj
     * @return array
     */
    public function splitNameQtyForUnit($obj){
        $cleanObj = explode('|',$obj);
        return $cleanObj;
    }

    /**
     * @return string
     */
    public function getAllPublicArmyLists(){
        $conn = $this->connect();
        $sql = "SELECT * FROM army_list WHERE public = 1 ORDER BY points";
        $result = $conn->query($sql);
        $i = 0;
        $publicList = '';
        foreach ($result as $row){
            $publicList[$i] = $row;
            $publicList[$i]['armyList_link'] = "/armybuilder/view-army-list.php?id=".$row['id'];
            $i++;
        }
        mysqli_close($conn); //$conn->close();
        return $publicList;
    }

    /**
     * @param $id
     * @return string
     */
    public function getAllOwnedArmyLists($id){
        $conn = $this->connect();
        $sql = "SELECT * FROM army_list WHERE created_by = ".$id." ORDER BY points";
        $result = $conn->query($sql);
        $i = 0;
        $ownedList = '';
        foreach ($result as $row){
            $ownedList[$i] = $row;
            $ownedList[$i]['armyList_link'] = "/armybuilder/view-army-list.php?id=".$row['id'];
            $i++;
        }
        mysqli_close($conn); //$conn->close();
        return $ownedList;
    }

    /**
     * @param $id
     * @return string
     */
    public function getListByGuid($id){
        $conn = $this->connect();
        $sql = "SELECT * FROM army_list WHERE guid = '".$id."'";
        $result = $conn->query($sql);
        $list = '';
        if ($result->num_rows > 0){
            foreach ($result as $row){
                $list = $row;
            }
            mysqli_close($conn); //$conn->close();
            return $list;
        } else {
            mysqli_close($conn); //$conn->close();
            return false;
        }
    }
}