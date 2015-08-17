<?php

class AllUnitTypes
{
	function getAllUnitTypes(){
		$core = new AllCore();
		$conn = $core->connect();
		
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
		} else {
			echo "0 results";
		}
		return $unitTypesBuild;
	}
	
	function saveUnitType($data){
		$core = new AllCore();
		$conn = $core->connect();
		
		$sql = "INSERT INTO unit_type (name)
		VALUES ('".$data."')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}
}

?>