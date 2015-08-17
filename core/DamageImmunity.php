<?php

class AllDamageImmunityTypes
{
	function getAllDamageImmunityTypes(){
		$core = new AllCore();
		$conn = $core->connect();
		
		$types = "SELECT * FROM damage_immunity_types ORDER BY name";
		$typesResult = $conn->query($types);
		$typesBuild = '';
		if ($typesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $typesResult->fetch_assoc()) {
				$typesBuild[$i] = $row;
				$i++;
			}
		} else {
			echo "0 results";
		}
		return $typesBuild;
	}
	
	function saveDamageImmunityType($data){
		$core = new AllCore();
		$conn = $core->connect();
		
		$sql = "INSERT INTO damage_immunity_types (name)
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