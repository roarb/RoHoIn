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

        $conn->close();
        return $id;
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
        return $ownedList;
    }

    /**
     * @param $id
     * @return string
     */
    public function getListById($id){
        $conn = $this->connect();
        $sql = "SELECT * FROM army_list WHERE id = ".$id." ORDER BY points";
        $result = $conn->query($sql);
        $list = '';
        foreach ($result as $row)
            $list = $row;
        return $list;
    }
}