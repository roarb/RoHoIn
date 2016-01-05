<?php

class AllDamageImmunityTypes extends AllCore
{
	/**
	 * @return string
	 */
	function getAllDamageImmunityTypes(){
		$conn = $this->connect();
		
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
		}
		mysqli_close($conn); //$conn->close();
		return $typesBuild;
	}

	/**
	 * @param $data
	 */
	function saveDamageImmunityType($data){
		$conn = $this->connect();
		
		$sql = "INSERT INTO damage_immunity_types (name)
		VALUES ('".$data."')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		}
		mysqli_close($conn); //$conn->close();
	}
}
