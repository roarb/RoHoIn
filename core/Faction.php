<?php

class AllFactions extends AllCore
{
	/**
	 * @return string
	 */
	public function getAllFactions(){
		$conn = $this->connect();
		
		$factions = "SELECT * FROM faction ORDER BY name";
		$factionsResult = $conn->query($factions);
		$factionsBuild = '';
		if ($factionsResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $factionsResult->fetch_assoc()) {
				$factionsBuild[$i] = $row;
				$i++;
			}
		}
		return $factionsBuild;
	}

	/**
	 * @param $name
	 * @return array|string
	 */
    public function getFactionIdByName($name){
        $conn = $this->connect();

        $query = "SELECT id FROM faction WHERE name = '".$name."'";
        $return = $conn->query($query);
        $returnId = '';
        if ($return->num_rows > 0) {
            while($row = $return->fetch_assoc()) {
                $returnId = $row;
            }
        }
        return $returnId;
    }

	/**
	 * @param $data
	 */
	function saveFaction($data){
		$conn = $this->connect();
		
		$sql = "INSERT INTO faction (name)
		VALUES ('".$data."')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		}
		
		$conn->close();
	}
}
