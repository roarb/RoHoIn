<?php

class AllFactions extends AllCore
{
	/**
	 * @return string
	 */
	public function getAllFactions(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM faction ORDER BY name";
		$factionsResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$factions = "SELECT * FROM faction ORDER BY name";
		//$factionsResult = $conn->query($factions);
		$factionsBuild = '';
		if ($factionsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $factionsResult->fetch_assoc()) {
				$factionsBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $factionsBuild;
	}

	/**
	 * @param $name
	 * @return array|string
	 */
    public function getFactionIdByName($name){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT id FROM faction WHERE name = '".$name."'";
		$return = $mysqli->query($sql_query);

        //$conn = $this->connect();
        //$query = "SELECT id FROM faction WHERE name = '".$name."'";
        //$return = $conn->query($query);
        $returnId = '';
        if ($return->num_rows > 0) {
            while($row = $return->fetch_assoc()) {
                $returnId = $row;
            }
        }
		//mysqli_close($conn); //$conn->close();
        return $returnId;
    }

	/**
	 * @param $data
	 */
	function saveFaction($data){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		//$conn = $this->connect();
		$sql_query = "INSERT INTO faction (name)
		VALUES ('".$data."')";
		//$sql = "INSERT INTO faction (name)
		//VALUES ('".$data."')";
		
		if ($mysqli->query($sql_query) === TRUE) {
			echo "New record created successfully<br>";
		}

		//mysqli_close($conn); //$conn->close();
	}
}
