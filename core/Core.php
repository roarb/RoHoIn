<?php

class AllCore
{
	/**
	 * AllCore constructor.
	 */
	public function __construct()
	{
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/AnimusKnown.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/ArmyBuilder.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/Barracks.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/BaseSize.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/DamageImmunity.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/Faction.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/SpecialAbilities.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/SpellsKnown.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/tiered-list.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/Unit.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/UnitType.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/core/Weapons.php';
	}

	/**
	 * @return mysqli
	 */
	public function connect()
	{
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

	/**
	 * @param $list
	 * @return mixed
	 */
	function sortList($list)
	{
		$sortArray = array();
		foreach ($list as $item) {
			foreach ($item as $key => $value) {
				if (!isset($sortArray[$key])) {
					$sortArray[$key] = array();
				}
				$sortArray[$key][] = $value;
			}
		}
		array_multisort($sortArray['name'], SORT_ASC, $list);
		return $list;
	}

	/**
	 * @param $needle
	 * @param $haystack
	 * @param bool|true $strict
	 * @return bool
	 */
	function in_array_r($needle, $haystack, $strict = true)
	{
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}

	/**
	 * @param $min
	 * @param $max
	 * @param $target
	 * @return bool|int
	 */
	function getSlidePos($min, $max, $target)
	{
		if ($target == '') {
			return false;
		} else {
			if ($max - $min == 0){
				$x = 1;
			} else {
				$x = 100 / ($max - $min);
			}
			$pos = ($target - $min) * $x;
			if ($pos > 100) {
				$pos = 100;
			}
			return $pos;
		}
	}

	/**
	 * @param $per
	 * @return string
	 */
	function getSliderColor($per)
	{
		if ($per == 100) {
			return 'max';
		}
		if ($per < 10) {
			if ($per == 0) {
				return 'min';
			} else {
				return 'c1';
			}
		} else {
			return 'c' . substr($per, 0, 1);
		}
	}

	/**
	 * @param $array
	 * @param $el
	 * @return mixed
	 */
	function removeFromArray($array, $el)
	{
		if (($key = array_search($el, $array)) !== false) {
			unset($array[$key]);
		}
		return $array;
	}

	/**
	 * @param $id
	 * @return string
	 */
	public function getUserNameById($id)
	{
		$sql = "SELECT user_name FROM users WHERE user_id = " . $id;
		$result = $this->connect()->query($sql);
		$user = '';
		foreach ($result as $row) {
			$user = $row['user_name'];
		}
		return $user;
	}

	/**
	 * @return bool
	 */
	public function getLoggedIn()
	{
		if (isset($_SESSION['user_id'])){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $_SESSION['user_id'];
	}

	/**
	 * @return bool
	 */
	public function getAdmin()
	{
		if (isset($_SESSION['user_id'])){
			$result = $this->connect()->query("SELECT admin FROM users WHERE user_id = ". $_SESSION['user_id']);
			foreach ($result as $row){
				if ($row['admin'] == 1){
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function getUserSub($id){
		$result = $this->connect()->query("SELECT user_sub FROM users WHERE user_id = " . $id);
		foreach ($result as $row){
			if ($row['user_sub'] == 1){
				return true;
			}
		}
		return false;
	}
}