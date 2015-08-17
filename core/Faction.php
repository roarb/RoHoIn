<?php

class AllFactions
{
	public function getAllFactions(){
		$core = new AllCore();
		$conn = $core->connect();
		
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
		} else {
			echo "0 results";
		}
		return $factionsBuild;
	}
	
	function saveFaction($data){
		$core = new AllCore();
		$conn = $core->connect();
		
		$sql = "INSERT INTO faction (name)
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