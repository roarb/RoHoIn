<?php

class AllUnitTypes extends AllCore
{
	/**
	 * @return string
	 */
	function getAllUnitTypes(){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "SELECT * FROM unit_type ORDER BY name";
		$unitTypesResult = $mysqli->query($sql_query);

		//$conn = $this->connect();
		//$unitTypes = "SELECT * FROM unit_type ORDER BY name";
		//$unitTypesResult = $conn->query($unitTypes);
		$unitTypesBuild = '';
		if ($unitTypesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitTypesResult->fetch_assoc()) {
				$unitTypesBuild[$i] = $row;
				$i++;
			}
		}
		//mysqli_close($conn); //$conn->close();
		return $unitTypesBuild;
	}

	/**
	 * @param $data
	 */
	function saveUnitType($data){
		$db = database::getInstance();
		$mysqli = $db->getConnection();
		$sql_query = "INSERT INTO unit_type (name) VALUES ('".$data."')";
		if ($mysqli->query($sql_query) === TRUE) {
			echo "New record created successfully<br>";
		}

		//$conn = $this->connect();
		//$sql = "INSERT INTO unit_type (name) VALUES ('".$data."')";
		
		//if ($conn->query($sql) === TRUE) {
		//	echo "New record created successfully<br>";
		//}
		//mysqli_close($conn); //$conn->close();
	}
}

