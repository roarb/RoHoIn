<?php
/**
 * Created by PhpStorm.
 * User: rhoeh
 * Date: 1/3/2016
 * Time: 9:23 AM
 */

include_once '../core/Core.php';
$core = new AllCore();
$armyBuilder = new ArmyBuilder();

$name = str_replace("'","\'",$_GET['name']);
$faction = $_GET['faction'];
$points = $_GET['points'];
$actual_points = $_GET['points_used'];
$warcaster_1 = $_GET['warcaster1'];
$tier_1 = $_GET['tier1'];
$battle_group_1 = $_GET['bg1'];
if (isset($_GET['warcaster2'])){$warcaster_2 = $_GET['warcaster2'];} else {$warcaster_2 = null;}
if (isset($_GET['tier2'])){$tier_2 = $_GET['tier2'];} else {$tier_2 = null;}
if (isset($_GET['bg2'])){$battle_group_2 = $_GET['bg2'];} else {$battle_group_2 = null;}
if (isset($_GET['warcaster3'])){$warcaster_3 = $_GET['warcaster3'];} else {$warcaster_3 = null;}
if (isset($_GET['tier3'])){$tier_3 = $_GET['tier3'];} else {$tier_3 = null;}
if (isset($_GET['bg3'])){$battle_group_3 = $_GET['bg3'];} else {$battle_group_3 = null;}
if (isset($_GET['warcaster4'])){$warcaster_4 = $_GET['warcaster4'];} else {$warcaster_4 = null;}
if (isset($_GET['tier4'])){$tier_4 = $_GET['tier4'];} else {$tier_4 = null;}
if (isset($_GET['bg4'])){$battle_group_4 = $_GET['bg4'];} else {$battle_group_4 = null;}
if (isset($_GET['solos'])){$solos = $_GET['solos'];} else {$solos = null;}
if (isset($_GET['units'])){$units = $_GET['units'];} else {$units = null;}
if (isset($_GET['battle_engines'])){$battle_engines = $_GET['battle_engines'];} else {$battle_engines = null;}
if (isset($_GET['journeyman_caster'])){$journeyman_caster = $_GET['journeyman_caster'];} else {$journeyman_caster = null;}
if (isset($_GET['journeyman_battlegroup'])){$journeyman_battlegroup = $_GET['journeyman_battlegroup'];} else {$journeyman_battlegroup = null;}
if (isset($_GET['jackmarshal'])){$jackmarshal = $_GET['jackmarshal'];} else {$jackmarshal = null;}
if (isset($_GET['jackmarshal_battlegroup'])){$jackmarshal_battlegroup = $_GET['jackmarshal_battlegroup'];} else {$jackmarshal_battlegroup = null;}
if (isset($_GET['merc_solo'])){$merc_solo = $_GET['merc_solo'];} else {$merc_solo = null;}
if (isset($_GET['merc_units'])){$merc_units = $_GET['merc_units'];} else {$merc_units = null;}
if (isset($_GET['created_by'])){$user = $_GET['created_by'];} else {$user = null;}
$public = $_GET['public'];
if (isset($_GET['notes'])){$notes = $_GET['notes'];} else {$notes = null;}
$guid = $_GET['guid'];

$submit = $armyBuilder->ajaxCreateNewArmyList($name, $faction, $points, $actual_points, $warcaster_1, $tier_1, $battle_group_1, $warcaster_2, $tier_2, $battle_group_2, $warcaster_3, $tier_3, $battle_group_3, $warcaster_4, $tier_4, $battle_group_4, $units, $solos, $battle_engines, $journeyman_caster, $journeyman_battlegroup, $jackmarshal, $jackmarshal_battlegroup, $merc_solo, $merc_units, $user, $public, $notes, $guid);

//var_dump($submit);

//echo $name;