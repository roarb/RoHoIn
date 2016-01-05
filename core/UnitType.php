<?php

class AllUnitTypes extends AllCore
{
	/**
	 * @return string
	 */
	function getAllUnitTypes(){
		$conn = $this->connect();
		
		$unitTypes = "SELECT * FROM unit_type ORDER BY name";
		$unitTypesResult = $conn->query($unitTypes);
		$unitTypesBuild = '';
		if ($unitTypesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $unitTypesResult->fetch_assoc()) {
				$unitTypesBuild[$i] = $row;
				$i++;
			}
		}
		mysqli_close($conn); //$conn->close();
		return $unitTypesBuild;
	}

	/**
	 * @param $data
	 */
	function saveUnitType($data){
		$conn = $this->connect();
		
		$sql = "INSERT INTO unit_type (name)
		VALUES ('".$data."')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		}
		mysqli_close($conn); //$conn->close();
	}
}

