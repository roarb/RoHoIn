<?php


class AllCore
{
	public function connect(){
		$servername = "localhost";
		$username = "whrob";
		$password = "kachowLand2";
		$database = "roho_warmahordes";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		return $conn;
	}
	
	function sortList($list){
		$sortArray = array(); 
		foreach($list as $item){ 
			foreach($item as $key=>$value){ 
				if(!isset($sortArray[$key])){ 
					$sortArray[$key] = array(); 
				} 
				$sortArray[$key][] = $value; 
			} 
		} 		
		array_multisort($sortArray['name'],SORT_ASC,$list);
		return $list;
	}
	
	function in_array_r($needle, $haystack, $strict = true) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
	
	function getSlidePos($min,$max,$target){
		if ($target == ''){
			return false;
		}
		else{
			$x = 100/($max-$min);
			$pos = ($target-$min)*$x;
			if ($pos > 100){$pos = 100;}
			return $pos;
		}
	}
	
	function getSliderColor($per){
		if ($per == 100){
			return 'max';
		}
		if ($per < 10){
			if ($per == 0){
				return 'min';
			}
			else {
				return 'c1';
			}
		}
		else {
			return 'c'.substr($per, 0, 1);
		}
	}
	
	function removeFromArray($array, $el){
		if(($key = array_search($el, $array)) !== false) {
    		unset($array[$key]);
		}
		return $array;
	}

    public function getUserNameById($id){
        $conn = $this->connect();
        $sql = "SELECT user_name FROM users WHERE user_id = ".$id;
        $result = $conn->query($sql);
        $user = '';
        foreach ($result as $row){
            $user = $row['user_name'];
        }
        return $user;
    }
}


?>