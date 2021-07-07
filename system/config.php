<?php

	session_start();
	date_default_timezone_set("America/Chicago");

	// GENERAL SETTINGS
	$game_name = "Warfront Nations Alpha";
	$game_version = "ALPHA-v1.0.0";

	// DATABASE CONNECTION
	$dbserver 			= "localhost";    // EX: localhost
	$dbusername 		= "root";         // EX: root
	$dbpassword 		= "";
	$db 				= "warfrontnations"; // EX: game
	
	// CREATE CONNECTION
	$mysqli = mysqli_connect($dbserver, $dbusername, $dbpassword, $db) or die(mysqli_error($mysqli));
	
	$users_get = mysqli_query($mysqli, "SELECT * FROM user") or die(mysqli_error($mysqli));
	$user_count = mysqli_num_rows($users_get);
	
	// GET DATABASE VALUES
	if (!empty($_SESSION['uid'])) {
		$user_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($mysqli));
		if (mysqli_num_rows($user_get) > 0) {
			$user = mysqli_fetch_assoc($user_get);
			
			$resource_get = mysqli_query($mysqli, "SELECT * FROM resource WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($mysqli));
			$resource = mysqli_fetch_assoc($resource_get);
			
			$military_get = mysqli_query($mysqli, "SELECT * FROM military WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($mysqli));
			$military = mysqli_fetch_assoc($military_get);
			
			$alliance_get = mysqli_query($mysqli, "SELECT * FROM alliance WHERE id='".$user['allianceid']."'") or die(mysqli_error($mysqli));
			$alliance = mysqli_fetch_assoc($alliance_get);
		} else {
			session_destroy();
		}
	}
	
	// Power plants
	$nuclear_cost = 9000000000;
	$nuclear_land = 260;
	$nuclear_power = 18000;
	$nuclear_upkeep = 71000000;
	$hyrdoelelectric_cost = 2000000000;
	$hydroelectric_land = 200;
	$hydroelectric_power = 11000;
	$hydroelectric_upkeep = 200000000;
	$coalfired_cost = 1000000000;
	$coalfired_land = 165;
	$coalfired_power = 7000;
	$coalfired_upkeep = 23000000;
	$dieselfired_cost = 500000000;
	$dieselfired_land = 165;
	$dieselfired_power = 4000;
	$dieselfired_upkeep = 10000000;
	$solar_cost = 750000000;
	$solar_land = 50;
	$solar_power = 1500;
	$solar_upkeep = 1000000;
	$wind_cost = 4000000000;
	$wind_land = 50;
	$wind_power = 6000;
	$wind_upkeep = 5000000;
	
	// Military buildings
	$barracks_cost = 10000000;
	$barracks_land = 25;
	$barracks_power = 100;
	$barracks_upkeep = 500000;
	$factory_cost = 350000000;
	$factory_land = 75;
	$factory_power = 1000;
	$factory_upkeep = 25000000;
	$drydock_cost = 650000000;
	$drydock_land = 100;
	$drydock_power = 1500;
	$drydock_upkeep = 75000000;
	$arsenal_cost = 100000000;
	$arsenal_land = 75;
	$arsenal_power = 250;
	$arsenal_upkeep = 750000;
	$shipyard_cost = 200000000;
	$shipyard_land = 100;
	$shipyard_power = 350;
	$shipyard_upkeep = 1500000;
	
	// Manufacturing buildings
	$steelmill_cost = 40000000;
	$steelmill_land = 250;
	$steelmill_power = 500;
	$steelmill_upkeep = 5000000;
	$aluminumrefinery_cost = 80000000;
	$aluminumrefinery_land = 325;
	$aluminumrefinery_power = 750;
	$aluminumrefinery_upkeep = 100000000;
	$ammunitionfactory_cost = 20000000;
	$ammunitionfactory_land = 125;
	$ammunitionfactory_power = 200;
	$ammunitionfactory_upkeep = 4000000;
	$oilrefinery_cost = 100000000;
	$oilrefinery_land = 400;
	$oilrefinery_power = 1000;
	$oilrefinery_upkeep = 15000000;
	
	// Supply buildings
	$ironmine_cost = 25000000;
	$ironmine_land = 100;
	$ironmine_power = 100;
	$ironmine_upkeep = 5000000;
	$coalmine_cost = 30000000;
	$coalmine_land = 125;
	$coalmine_power = 125;
	$coalmine_upkeep = 7500000;
	$bauxitemine_cost = 20000000;
	$bauxitemine_land = 85;
	$bauxitemine_power = 75;
	$bauxitemine_upkeep = 4000000;
	$oilwell_cost = 35000000;
	$oilwell_land = 150;
	$oilwell_power = 150;
	$oilwell_upkeep = 9000000;
	$leadmine_cost = 25000000;
	$leadmine_land = 90;
	$leadmine_power = 110;
	$leadmine_upkeep = 5000000;
	$uraniummine_cost = 40000000;
	$uraniummine_land = 200;
	$uraniummine_power = 200;
	$uraniummine_upkeep = 10000000;
	$farm_cost = 1000000;
	$farm_land = 400;
	$farm_power = 15;
	$farm_upkeep = 250000;
	
	// FUNCTIONS
	// WHEN YOU IMPORT THE GAME TO SERVER PLEASE CHANGE THE CREDENTIALS BELOW
	// "localhost" "root" "" "warfrontnations"
	function protect($string) {
		$mysqli = mysqli_connect("localhost", "root", "", "warfrontnations");
		return $mysqli->real_escape_string(strip_tags(addslashes($string)));
	}

	function output($string) {
		echo "<div class=\"output\">" . $string . "</div><br>";
	}
	
	function getAge($date){
		$now = time();
		$datediff = $now - $date;
		return round($datediff / (60 * 60 * 24));
	}
	
	function display($string) {
		return str_replace("\\", "", $string);
	}
	
	function send_notification($uid, $message) {
		$mysqli = mysqli_connect("localhost", "root", "", "warfrontnations");
		$notification = mysqli_query($mysqli, "INSERT INTO notification (uid, date, seen, text) VALUES ('$uid', '".time()."',  '0', '$message')") or die(mysqli_error($mysqli));
	}
	
?>