<?php

class AllBaseSizes extends AllCore
{
	/**
	 * @return string
	 */
	function getAllBaseSizes(){
		$conn = $this->connect();
		
		$baseSizes = "SELECT base_size FROM base_size ORDER BY base_size";
		$baseSizesResult = $conn->query($baseSizes);
		$baseSizesBuild = '';
		if ($baseSizesResult->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $baseSizesResult->fetch_assoc()) {
				$baseSizesBuild[$i] = $row;
				$i++;
			}
		}
		return $baseSizesBuild;
	}

	/**
	 * @param $data
	 */
	function saveBaseSize($data){
		$conn = $this->connect();
		
		$sql = "INSERT INTO base_size (base_size)
		VALUES ('".$data."')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		}
		
		$conn->close();
	}
}
