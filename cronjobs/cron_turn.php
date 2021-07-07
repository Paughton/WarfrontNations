<?php

	include("../system/config.php");
	
	ob_start();
	
?>

	<script>document.title = "Cronjob Turn"</script>

	<div class="row">
		<div class="col-1"></div>

		<div class="col-10">
			<?php 
				if (!empty($_GET['password'])) {
					$password = protect($_GET['password']);
					if ($password == "i1LiK5eC6HiK24nNr9i1c67E") {
						echo "<b>Beginning the cronjob</b><br><hr><br>";
						$users_get = mysqli_query($mysqli, "SELECT * FROM user") or die(mysqli_error($mysqli));
						while ($users = mysqli_fetch_assoc($users_get)) {
							echo "<b>Accessing the user, " . $users['name'] . " [" . $users['id'] . "]</b><br>";
							$user_resource_get = mysqli_query($mysqli, "SELECT * FROM resource WHERE id='".$users['id']."'") or die(mysqli_error($mysqli));
							$user_resource = mysqli_fetch_assoc($user_resource_get);
							$cities_get = mysqli_query($mysqli, "SELECT * FROM city WHERE uid='".$users['id']."'") or die(mysqli_error($mysqli));
							if (mysqli_num_rows($cities_get) > 0) {
								while ($city = mysqli_fetch_assoc($cities_get)) {
									echo "- <u>Accessing the city, " . $city['name'] . "</u> [" . $city['id'] . "]<br>";
									
									$nuclear_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='nuclear'"));
									$hydroelectric_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='hydroelectric'"));
									$coalfired_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='coalfired'"));
									$dieselfired_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='dieselfired'"));
									$solar_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='solar'"));
									$wind_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='wind'"));
									$barracks_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='barracks'"));
									$factory_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='factory'"));
									$drydock_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='drydock'"));
									$arsenal_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='arsenal'"));
									$shipyard_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='shipyard'"));
									$steelmill_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='steelmill'"));
									$aluminumrefinery_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='aluminumrefinery'"));
									$ammunitionfactory_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='ammunitionfactory'"));
									$oilrefinery_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='oilrefinery'"));
									$ironmine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='ironmine'"));
									$coalmine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='coalmine'"));
									$bauxitemine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='bauxitemine'"));
									$oilwell_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='oilwell'"));
									$leadmine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='leadmine'"));
									$uraniummine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='uraniummine'"));
									$farm_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city['id']."' AND type='farm'"));
									echo "-- Finished counting all buildings<br>";
									
									$power_production = ($nuclear_count * $nuclear_power) + ($hydroelectric_count * $hydroelectric_power) + ($coalfired_count * $coalfired_power) + ($dieselfired_count * $dieselfired_power) + ($solar_count * $solar_power) + ($wind_count * $wind_power);
									$power_usage = ($barracks_count * $barracks_power) + ($factory_count * $factory_power) + ($drydock_count * $drydock_power) + ($arsenal_count * $arsenal_power);
									$power_usage += ($shipyard_count * $shipyard_power) + ($steelmill_count * $steelmill_power) + ($aluminumrefinery_count * $aluminumrefinery_power);
									$power_usage += ($ammunitionfactory_count * $ammunitionfactory_power) + ($oilrefinery_count * $oilrefinery_power) + ($ironmine_count * $ironmine_power);
									$power_usage += ($coalmine_count * $coalmine_power) + ($bauxitemine_count * $bauxitemine_power) + ($oilwell_count * $oilwell_power);
									$power_usage += ($leadmine_count * $leadmine_power) + ($uraniummine_count * $uraniummine_power) + ($farm_count * $farm_power);
									echo "-- Finished calculating the power production and usage [" . number_format($power_usage) . " GW / " . number_format($power_production) . " GW]<br>";
									
									if ($power_production >= $power_usage) {
										$total_land = ($nuclear_count * $nuclear_land) + ($hydroelectric_count * $hydroelectric_land) + ($coalfired_count * $coalfired_land) + ($dieselfired_count * $dieselfired_land) + ($solar_count * $solar_land) + ($wind_count * $wind_land);
										$total_land += ($barracks_count * $barracks_land) + ($factory_count * $factory_land) + ($drydock_count * $drydock_land) + ($arsenal_count * $arsenal_land);
										$total_land += ($shipyard_count * $shipyard_land) + ($steelmill_count * $steelmill_land) + ($aluminumrefinery_count * $aluminumrefinery_land);
										$total_land += ($ammunitionfactory_count * $ammunitionfactory_land) + ($oilrefinery_count * $oilrefinery_land) + ($ironmine_count * $ironmine_land);
										$total_land += ($coalmine_count * $coalmine_land) + ($bauxitemine_count * $bauxitemine_land) + ($oilwell_count * $oilwell_land);
										$total_land += ($leadmine_count * $leadmine_land) + ($uraniummine_count * $uraniummine_land) + ($farm_count * $farm_land) + $city['land'];
										echo "-- Finished calculating the total land of the city [" . number_format($total_land) . " sqmi]<br>";
										
										$population = $total_land * 80;
										echo "-- Finished calculating the population of the city [" . number_format($population) . " people]<br>";
										
										$total_upkeep = ($nuclear_count * ($nuclear_upkeep/24)) + ($hydroelectric_count * ($hydroelectric_upkeep/24)) + ($coalfired_count * ($coalfired_upkeep/24));
										$total_upkeep += ($dieselfired_count * ($dieselfired_upkeep/24)) + ($solar_count * ($solar_upkeep/24)) + ($wind_count * ($wind_upkeep/24));
										$total_upkeep += ($barracks_count * ($barracks_upkeep/24)) + ($factory_count * ($factory_upkeep/24)) + ($drydock_count * ($drydock_upkeep/24)) + ($arsenal_count * ($arsenal_upkeep/24));
										$total_upkeep += ($shipyard_count * ($shipyard_upkeep/24)) + ($steelmill_count * ($steelmill_upkeep/24)) + ($aluminumrefinery_count * ($aluminumrefinery_upkeep/24));
										$total_upkeep += ($ammunitionfactory_count * ($ammunitionfactory_upkeep/24)) + ($oilrefinery_count * ($oilrefinery_upkeep/24)) + ($ironmine_count * ($ironmine_upkeep/24));
										$total_upkeep += ($coalmine_count * ($coalmine_upkeep/24)) + ($bauxitemine_count * ($bauxitemine_upkeep/24)) + ($oilwell_count * ($oilwell_upkeep/24));
										$total_upkeep += ($leadmine_count * ($leadmine_upkeep/24)) + ($uraniummine_count * ($uraniummine_upkeep/24)) + ($farm_count * ($farm_upkeep/24));
										echo "-- Finished calculating the total upkeep costs [$" . number_format($total_upkeep) . "]<br>";
										
										$raw_revenue = $population * 30;
										echo "-- Finished calculating the raw revenue [$" . number_format($raw_revenue) . "]<br>";
										
										$users['money'] += $raw_revenue;
										
										if ($users['money'] >= $total_upkeep) {
											$food_production = $farm_count * 300000;
											echo "-- Finished calculating the food production over consumption [" . number_format($population) . " / " . number_format($food_production) . "]<br>";
											echo "-- Starting the income process . . .<br>";
											
											if ($food_production + $user_resource['food'] > $population) {
												
												$user_resource['bauxite'] += $bauxitemine_count * 3000;
												$user_resource['coal'] += $coalmine_count * 2000;
												$user_resource['iron'] += $ironmine_count * 75000;
												$user_resource['lead'] += $leadmine_count * 1000;
												$user_resource['oil'] += $oilwell_count * 4200;
												$user_resource['uranium'] += $uraniummine_count * 500;
												$user_resource['food'] += $food_production - $population;
												
												for ($i = 0; $i < $steelmill_count; $i++) {
													if ($user_resource['iron'] >= 54000 && $user_resource['coal'] >= 1500) {
														$user_resource['iron'] -= 54000;
														$user_resource['coal'] -= 1500;
														$user_resource['steel'] += 2200;
														echo "--- <span style='color: green'>Steel mill process succeeded</span><br>";
													} else {
														echo "--- <span style='color: red'>Steel mill process failed</span><br>";
													}
												}
												
												for ($i = 0; $i < $aluminumrefinery_count; $i++) {
													if ($user_resource['bauxite'] >= 6000) {
														$user_resource['bauxite'] -= 6000;
														$user_resource['aluminum'] += 1500;
														echo "--- <span style='color: green'>Aluminum refinery process succeeded</span><br>";
													} else {
														echo "--- <span style='color: red'>Aluminum refinery process failed</span><br>";
													}
												}
												
												for ($i = 0; $i < $ammunitionfactory_count; $i++) {
													if ($user_resource['lead'] >= 1000) {
														$user_resource['lead'] -= 1000;
														$user_resource['ammunition'] += 63000;
														echo "--- <span style='color: green'>Ammunition factory process succeeded</span><br>";
													} else {
														echo "--- <span style='color: red'>Ammunition factory process failed</span><br>";
													}
												}
												
												for ($i = 0; $i < $oilrefinery_count; $i++) {
													if ($user_resource['oil'] >= 4200) {
														$user_resource['oil'] -= 4200;
														$user_resource['gasoline'] += 2000;
														echo "--- <span style='color: green'>Oil refinery process succeeded</span><br>";
													} else {
														echo "--- <span style='color: red'>Oil refinery process failed</span><br>";
													}
												}
												echo "-- Ended the income process<br>";
												echo "-- Checking to see if the city has enough power . . .<br>";
												
												$available_power = 0;
												
												for ($i = 0; $i < $nuclear_count; $i++) {
													if ($user_resource['uranium'] >= 450) {
														$user_resource['uranium'] -= 450;
														$available_power += $nuclear_power;
													} else {
														echo "--- <span style='color: red'>Nuclear power plant did not have enough uranium</span><br>";
													}
												}
												
												for ($i = 0; $i < $hydroelectric_count; $i++) {
													$available_power += $hydroelectric_power;
												}
												
												for ($i = 0; $i < $coalfired_count; $i++) {
													if ($user_resource['coal'] >= 4000) {
														$user_resource['coal'] -= 4000;
														$available_power += $coalfired_power;
													} else {
														echo "--- <span style='color: red'>Coal-fired power plant did not have enough coal</span><br>";
													}
												}
												
												for ($i = 0; $i < $dieselfired_count; $i++) {
													if ($user_resource['oil'] >= 2000) {
														$user_resource['oil'] -= 2000;
														$available_power += $dieselfired_power;
													} else {
														echo "--- <span style='color: red'>Diesel-fired power plant did not have enough oil</span><br>";
													}
												}
												
												for ($i = 0; $i < $solar_count; $i++) {
													$available_power += $solar_power;
												}
												
												for ($i = 0; $i < $wind_count; $i++) {
													$available_power += $wind_power;
												}
												
												echo "-- Finished checking to see if the city has enough power<br>";
												
												$users['money'] += 50000000;
												echo "-- Finished bonus money [$50,000,000]<br>";
												
												if ($available_power >= $power_usage) {
													echo "-- <span style='color: green'>The city does have enough available power</span><br>";
													echo "-- Updating the user and user's resources . . .<br>";
													$update_user = mysqli_query($mysqli, "UPDATE user SET money='".$users['money']."' WHERE id='".$users['id']."'") or die(mysqli_error($mysqli));
													$update_resource = mysqli_query($mysqli, "UPDATE resource SET aluminum='".$user_resource['aluminum']."',
																												  ammunition='".$user_resource['ammunition']."',
																												  bauxite='".$user_resource['bauxite']."',
																												  coal='".$user_resource['coal']."',
																												  food='".$user_resource['food']."',
																												  gasoline='".$user_resource['gasoline']."',
																												  iron='".$user_resource['iron']."',
																												  lead='".$user_resource['lead']."',
																												  oil='".$user_resource['oil']."',
																												  steel='".$user_resource['steel']."',
																												  uranium='".$user_resource['uranium']."' WHERE id='".$users['id']."'") or die(mysqli_error($mysqli));
													
													echo "-- Done updating the user's resources<br>";
													echo "-- Done with this city moving onto the next . . .<br>";
												} else {
													echo "-- <span style='color: red'> Ending process due to city not having anough available power</span><br>";
												}
												
											} else {
												echo "-- <span style='color: red'>Ending process due to not having enough food</span><br>"; 
											}
										} else {
											echo "-- <span style='color: red'>Ending process due to not having enough money</span><br>";
										}
										
									} else {
										echo "-- <span style='color: red'>Ending process due to city not being powered</span><br>";
									}
									
									echo "<br>";
								}
							} else {
								echo "- No cities were found under this user<br>";
								echo "<br>";
							}
							echo "- <u>User turn complete</u><br>";
							echo "<br><hr><br>";
						}
						echo "<b>Ending the cronjob</b>";
					} else {
						echo "<b>The password you have entered is incorrect</b>";
					}
				} else {
					echo "<b>You have vistied this page incorrectly.</b>";
				}
			?>
		</div>
		
		<div class="col-1"></div>
	</div>

<?php
	$file_name = './logs_turn/' . date("G.i.s___m-d-Y", time()) . '.html';
	file_put_contents($file_name, ob_get_contents());
?>