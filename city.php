<?php

	$page = "City";
	include("./system/header.php");
	
	$id = protect($_GET['id']);
	$city_check_get = mysqli_query($mysqli, "SELECT * FROM city WHERE id='$id'") or die(mysqli_error($mysqli));
	if (mysqli_num_rows($city_check_get) > 0) {
		$city_check = mysqli_fetch_assoc($city_check_get);
		$main_col = 10;
		
		$user_get_check = mysqli_query($mysqli, "SELECT * FROM user WHERE id='".$city_check['uid']."'") or die(mysqli_error($mysqli));
		$user_get = mysqli_fetch_assoc($user_get_check);
		
		$user_isOwner = false;
		if (!empty($_SESSION['uid'])) {
			if ($user['id'] == $city_check['uid']) {
				$user_isOwner = true;
			}
		}
		
		$nuclear_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='nuclear'"));
		$hydroelectric_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='hydroelectric'"));
		$coalfired_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='coalfired'"));
		$dieselfired_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='dieselfired'"));
		$solar_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='solar'"));
		$wind_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='wind'"));
		$barracks_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='barracks'"));
		$factory_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='factory'"));
		$drydock_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='drydock'"));
		$arsenal_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='arsenal'"));
		$shipyard_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='shipyard'"));
		$steelmill_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='steelmill'"));
		$aluminumrefinery_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='aluminumrefinery'"));
		$ammunitionfactory_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='ammunitionfactory'"));
		$oilrefinery_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='oilrefinery'"));
		$ironmine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='ironmine'"));
		$coalmine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='coalmine'"));
		$bauxitemine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='bauxitemine'"));
		$oilwell_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='oilwell'"));
		$leadmine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='leadmine'"));
		$uraniummine_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='uraniummine'"));
		$farm_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM building WHERE cid='".$city_check['id']."' AND type='farm'"));
		
		$power_production = ($nuclear_count * $nuclear_power) + ($hydroelectric_count * $hydroelectric_power) + ($coalfired_count * $coalfired_power) + ($dieselfired_count * $dieselfired_power) + ($solar_count * $solar_power) + ($wind_count * $wind_power);
		$power_usage = ($barracks_count * $barracks_power) + ($factory_count * $factory_power) + ($drydock_count * $drydock_power) + ($arsenal_count * $arsenal_power);
		$power_usage += ($shipyard_count * $shipyard_power) + ($steelmill_count * $steelmill_power) + ($aluminumrefinery_count * $aluminumrefinery_power);
		$power_usage += ($ammunitionfactory_count * $ammunitionfactory_power) + ($oilrefinery_count * $oilrefinery_power) + ($ironmine_count * $ironmine_power);
		$power_usage += ($coalmine_count * $coalmine_power) + ($bauxitemine_count * $bauxitemine_power) + ($oilwell_count * $oilwell_power);
		$power_usage += ($leadmine_count * $leadmine_power) + ($uraniummine_count * $uraniummine_power) + ($farm_count * $farm_power);
		
		$total_land = ($nuclear_count * $nuclear_land) + ($hydroelectric_count * $hydroelectric_land) + ($coalfired_count * $coalfired_land) + ($dieselfired_count * $dieselfired_land) + ($solar_count * $solar_land) + ($wind_count * $wind_land);
		$total_land += ($barracks_count * $barracks_land) + ($factory_count * $factory_land) + ($drydock_count * $drydock_land) + ($arsenal_count * $arsenal_land);
		$total_land += ($shipyard_count * $shipyard_land) + ($steelmill_count * $steelmill_land) + ($aluminumrefinery_count * $aluminumrefinery_land);
		$total_land += ($ammunitionfactory_count * $ammunitionfactory_land) + ($oilrefinery_count * $oilrefinery_land) + ($ironmine_count * $ironmine_land);
		$total_land += ($coalmine_count * $coalmine_land) + ($bauxitemine_count * $bauxitemine_land) + ($oilwell_count * $oilwell_land);
		$total_land += ($leadmine_count * $leadmine_land) + ($uraniummine_count * $uraniummine_land) + ($farm_count * $farm_land) + $city_check['land'];
		
		$population = $total_land * 80;
		
		$city_isPowered = true;
		if ($power_usage > $power_production) {
			$city_isPowered = false;
		}
		
		?>
			
			<script>document.title = "<?php echo $city_check['name'] . " - " . $game_name; ?>";</script>
			
			<div class="row">
				<div class="col-1"></div>
				
				<?php if ($user_isOwner) { $main_col = 8; ?>
					<div class="col-2">
						<!-- Left Sidebar -->
						<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='editcity?id=<?php echo $city_check['id']; ?>';"><i class="fas fa-edit"></i> Edit</button><p></p>
					</div>
				<?php } ?>
				
				<div class="col-<?php echo $main_col; ?>">
					<!-- Middle Content -->
					<div class="jumbotron">
						<h1 class="display-4"><?php echo display($city_check['name']); ?></h1>
						<?php if($user_isOwner) { ?><p><?php echo number_format($city_check['land']); ?> available square miles</p><?php } ?>
						<?php if (!$city_isPowered) { ?><p style="color:red"><b>Unpowered</b></p><?php } ?>
					</div>
					<table class="table table-borderless">
						<tbody>
							<tr>
								<td><h5><b>Country</b></h5></td>
								<td><h5><a href="nation?id=<?php echo $user_get['id']; ?>"><?php echo display($user_get['name']); ?></a></h5></td>
							</tr>
							<tr>
								<td><h5>Power usage</h5></td>
								<td><h5><?php echo number_format($power_usage); ?> GW / <?php echo number_format($power_production); ?> GW</h5></td>
							</tr>
							<tr>
								<td><h5>Population</h5></td>
								<td><h5><?php echo number_format($population); ?></h5></td>
							</tr>
							<tr>
								<td><h5>Land</h5></td>
								<td><h5><?php echo number_format($total_land); ?> square miles</h5></td>
							</tr>
						</tbody>
					</table>
					
					<?php
						
						if ($user_isOwner) {
							if (!empty($_POST['nuclear'])) {
								if ($user['money'] >= $nuclear_cost) {
									if ($city_check['land'] >= $nuclear_land) {
										$user['money'] -= $nuclear_cost;
										$city_check['land'] -= $nuclear_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'nuclear')") or die(mysqli_query($mysqli));
										output("Your nuclear power plant was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['hydroelectric'])) {
								if ($user['money'] >= $hyrdoelelectric_cost) {
									if ($city_check['land'] >= $hydroelectric_land) {
										$user['money'] -= $hyrdoelelectric_cost;
										$city_check['land'] -= $hydroelectric_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'hydroelectric')") or die(mysqli_query($mysqli));
										output("Your hydroelectric power plant was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['coal-fired'])) {
								if ($user['money'] >= $coalfired_cost) {
									if ($city_check['land'] >= $coalfired_land) {
										$user['money'] -= $coalfired_cost;
										$city_check['land'] -= $coalfired_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'coalfired')") or die(mysqli_query($mysqli));
										output("Your coal-fired power plant was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['diesel-fired'])) {
								if ($user['money'] >= $dieselfired_cost) {
									if ($city_check['land'] >= $dieselfired_land) {
										$user['money'] -= $dieselfired_cost;
										$city_check['land'] -= $dieselfired_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'dieselfired')") or die(mysqli_query($mysqli));
										output("Your diesel-fired power plant was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['solar'])) {
								if ($user['money'] >= $solar_cost) {
									if ($city_check['land'] >= $solar_land) {
										$user['money'] -= $solar_cost;
										$city_check['land'] -= $solar_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'solar')") or die(mysqli_query($mysqli));
										output("Your solar power plant was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['wind'])) {
								if ($user['money'] >= $wind_cost) {
									if ($city_check['land'] >= $wind_land) {
										$user['money'] -= $wind_cost;
										$city_check['land'] -= $wind_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'wind')") or die(mysqli_query($mysqli));
										output("Your wind power plant was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['barracks'])) {
								if ($user['money'] >= $barracks_cost) {
									if ($city_check['land'] >= $barracks_land) {
										$user['money'] -= $barracks_cost;
										$city_check['land'] -= $barracks_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'barracks')") or die(mysqli_query($mysqli));
										output("Your barracks was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['factory'])) {
								if ($user['money'] >= $factory_cost) {
									if ($city_check['land'] >= $factory_land) {
										$user['money'] -= $factory_cost;
										$city_check['land'] -= $factory_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'factory')") or die(mysqli_query($mysqli));
										output("Your factory was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['drydock'])) {
								if ($user['money'] >= $drydock_cost) {
									if ($city_check['land'] >= $drydock_land) {
										$user['money'] -= $drydock_cost;
										$city_check['land'] -= $drydock_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'drydock')") or die(mysqli_query($mysqli));
										output("Your drydock was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['arsenal'])) {
								if ($user['money'] >= $arsenal_cost) {
									if ($city_check['land'] >= $arsenal_land) {
										$user['money'] -= $arsenal_cost;
										$city_check['land'] -= $arsenal_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'arsenal')") or die(mysqli_query($mysqli));
										output("Your arsenal was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['shipyard'])) {
								if ($user['money'] >= $shipyard_cost) {
									if ($city_check['land'] >= $shipyard_land) {
										$user['money'] -= $shipyard_cost;
										$city_check['land'] -= $shipyard_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'shipyard')") or die(mysqli_query($mysqli));
										output("Your shipyard was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['steelmill'])) {
								if ($user['money'] >= $steelmill_cost) {
									if ($city_check['land'] >= $steelmill_land) {
										$user['money'] -= $steelmill_cost;
										$city_check['land'] -= $steelmill_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'steelmill')") or die(mysqli_query($mysqli));
										output("Your steel mill was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['aluminumrefinery'])) {
								if ($user['money'] >= $aluminumrefinery_cost) {
									if ($city_check['land'] >= $aluminumrefinery_land) {
										$user['money'] -= $aluminumrefinery_cost;
										$city_check['land'] -= $aluminumrefinery_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'aluminumrefinery')") or die(mysqli_query($mysqli));
										output("Your aluminum refinery was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['ammunitionfactory'])) {
								if ($user['money'] >= $ammunitionfactory_cost) {
									if ($city_check['land'] >= $ammunitionfactory_land) {
										$user['money'] -= $ammunitionfactory_cost;
										$city_check['land'] -= $ammunitionfactory_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'ammunitionfactory')") or die(mysqli_query($mysqli));
										output("Your ammunition factory was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['oilrefinery'])) {
								if ($user['money'] >= $oilrefinery_cost) {
									if ($city_check['land'] >= $oilrefinery_land) {
										$user['money'] -= $oilrefinery_cost;
										$city_check['land'] -= $oilrefinery_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'oilrefinery')") or die(mysqli_query($mysqli));
										output("Your oil refinery was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['ironmine'])) {
								if ($user['money'] >= $ironmine_cost) {
									if ($city_check['land'] >= $ironmine_land) {
										$user['money'] -= $ironmine_cost;
										$city_check['land'] -= $ironmine_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'ironmine')") or die(mysqli_query($mysqli));
										output("Your iron mine was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['coalmine'])) {
								if ($user['money'] >= $coalmine_cost) {
									if ($city_check['land'] >= $coalmine_land) {
										$user['money'] -= $coalmine_cost;
										$city_check['land'] -= $coalmine_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'coalmine')") or die(mysqli_query($mysqli));
										output("Your coal mine was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['bauxitemine'])) {
								if ($user['money'] >= $bauxitemine_cost) {
									if ($city_check['land'] >= $bauxitemine_land) {
										$user['money'] -= $bauxitemine_cost;
										$city_check['land'] -= $bauxitemine_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'bauxitemine')") or die(mysqli_query($mysqli));
										output("Your bauxite mine was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['oilwell'])) {
								if ($user['money'] >= $oilwell_cost) {
									if ($city_check['land'] >= $oilwell_land) {
										$user['money'] -= $oilwell_cost;
										$city_check['land'] -= $oilwell_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'oilwell')") or die(mysqli_query($mysqli));
										output("Your oil well was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['leadmine'])) {
								if ($user['money'] >= $leadmine_cost) {
									if ($city_check['land'] >= $leadmine_land) {
										$user['money'] -= $leadmine_cost;
										$city_check['land'] -= $leadmine_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'leadmine')") or die(mysqli_query($mysqli));
										output("Your lead mine was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['uraniummine'])) {
								if ($user['money'] >= $uraniummine_cost) {
									if ($city_check['land'] >= $uraniummine_land) {
										$user['money'] -= $uraniummine_cost;
										$city_check['land'] -= $uraniummine_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'uraniummine')") or die(mysqli_query($mysqli));
										output("Your uranium mine was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							} else if (!empty($_POST['farm'])) {
								if ($user['money'] >= $farm_cost) {
									if ($city_check['land'] >= $farm_land) {
										$user['money'] -= $farm_cost;
										$city_check['land'] -= $farm_land;
										$insert_building = mysqli_query($mysqli, "INSERT INTO building (cid, type) VALUES ('".$city_check['id']."', 'farm')") or die(mysqli_query($mysqli));
										output("Your farm was built");
									} else {
										output("You do not have enough land to build that building upon.");
									}
								} else {
									output("You do not have enough money to build that building.");
								}
							}
							
							$update_user = mysqli_query($mysqli, "UPDATE user SET money='".$user['money']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
							$update_city = mysqli_query($mysqli, "UPDATE city SET land='".$city_check['land']."' WHERE id='".$city_check['id']."'") or die(mysqli_error($mysqli));
						}
					?>
					
					<?php if ($user_isOwner) { ?>
						<br>
						<h2>Build buildings</h2>
						<p>In order to build a building click on the category you want and a dropdown will appear. Then click <b>Build</b> to the building you want to build</p>
						<div id="accordion">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Supply Buildings
										</button>
									</h5>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<table class="table table-borderless">
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/ironmine.jpg"></td>
												<td><b>Iron mine</b></td>
												<td>This building costs <b>$25,000,000</b> to build and costs <b>$5,000,000</b> to maintain everyday. This building uses <b>100 GW</b>
												every hour. This building requires <b>100 sqmi</b>. This building mines 75,000 iron every hour.</td>
												<td><center><h2><?php echo number_format($ironmine_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="ironmine" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/coalmine.jpg"></td>
												<td><b>Coal mine</b></td>
												<td>This building costs <b>$30,000,000</b> to build and costs <b>$7,500,000</b> to maintain everyday. This building uses <b>125 GW</b>
												every hour. This building requires <b>125 sqmi</b>. This building mines 2,000 coal every hour.</td>
												<td><center><h2><?php echo number_format($coalmine_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="coalmine" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/bauxitemine.jpg"></td>
												<td><b>Bauxite mine</b></td>
												<td>This building costs <b>$20,000,000</b> to build and costs <b>$4,000,000</b> to maintain everyday. This building uses <b>75 GW</b>
												every hour. This building requires <b>85 sqmi</b>. This building mines 3,000 bauxite every hour.</td>
												<td><center><h2><?php echo number_format($bauxitemine_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="bauxitemine" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/oilwell.jpg"></td>
												<td><b>Oil well</b></td>
												<td>This building costs <b>$35,000,000</b> to build and costs <b>$9,000,000</b> to maintain everyday. This building uses <b>150 GW</b>
												every hour. This building requires <b>150 sqmi</b>. This building mines 4,200 oil every hour.</td>
												<td><center><h2><?php echo number_format($oilwell_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="oilwell" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/leadmine.jpg"></td>
												<td><b>Lead mine</b></td>
												<td>This building costs <b>$25,000,000</b> to build and costs <b>$5,000,000</b> to maintain everyday. This building uses <b>110 GW</b>
												every hour. This building requires <b>90 sqmi</b>. This building mines 1,000 lead every hour.</td>
												<td><center><h2><?php echo number_format($leadmine_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="leadmine" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/uraniummine.jpg"></td>
												<td><b>Uranium mine</b></td>
												<td>This building costs <b>$40,000,000</b> to build and costs <b>$10,000,000</b> to maintain everyday. This building uses <b>200 GW</b>
												every hour. This building requires <b>200 sqmi</b>. This building mines 500 uranium every hour.</td>
												<td><center><h2><?php echo number_format($uraniummine_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="uraniummine" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/farm.jpg"></td>
												<td><b>Farm</b></td>
												<td>This building costs <b>$1,000,000</b> to build and costs <b>$250,000</b> to maintain everyday. This building uses <b>15 GW</b>
												every hour. This building requires <b>400 sqmi</b>. This building mines 300,000 food every hour.</td>
												<td><center><h2><?php echo number_format($farm_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="farm" value="Build"></form></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							
							<div class="card">
								<div class="card-header" id="headingTwo">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
											Manufacturing Buildings
										</button>
									</h5>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
									<div class="card-body">
										<table class="table table-borderless">
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/steelmill.jpg"></td>
												<td><b>Steel mill</b></td>
												<td>This building costs <b>$40,000,000</b> to build and costs <b>$5,000,000</b> to maintain everyday. This building uses <b>500 GW</b>
												every hour. This building requires <b>250 sqmi</b>. This building uses 1,500 coal and 54,000 iron to combine into 2,200 steel every 
												hour.</td>
												<td><center><h2><?php echo number_format($steelmill_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="steelmill" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/aluminumrefinery.jpg"></td>
												<td><b>Aluminum refinery</b></td>
												<td>This building costs <b>$80,000,000</b> to build and costs <b>$10,000,000</b> to maintain everyday. This building uses <b>750 GW</b>
												every hour. This building requires <b>325 sqmi</b>. This building uses 6,000 bauxite to make 1,500 aluminum ever hour.</td>
												<td><center><h2><?php echo number_format($aluminumrefinery_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="aluminumrefinery" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/ammunitionfactory.jpg"></td>
												<td><b>Ammunition factory</b></td>
												<td>This building costs <b>$20,000,000</b> to build and costs <b>$4,000,000</b> to maintain everyday. This building uses <b>200 GW</b>
												every hour. This building requires <b>125 sqmi</b>. This building uses 1,000 lead to make 63,000 bullets ever hour.</td>
												<td><center><h2><?php echo number_format($ammunitionfactory_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="ammunitionfactory" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/oilrefinery.jpg"></td>
												<td><b>Oil refinery</b></td>
												<td>This building costs <b>$100,000,000</b> to build and costs <b>$15,000,000</b> to maintain everyday. This building uses <b>1,000 GW</b>
												every hour. This building requires <b>400 sqmi</b>. This building uses 4,200 oil to make 2,000 gasoline ever hour.</td>
												<td><center><h2><?php echo number_format($oilrefinery_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="oilrefinery" value="Build"></form></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							
							<div class="card">
								<div class="card-header" id="headingThree">
									<h5 class="mb-0">
										<button class="btn btn-link button-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
											Military Buildings
										</button>
									</h5>
								</div>
								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
									<div class="card-body">
										<table class="table table-borderless">
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/barracks.jpg"></td>
												<td><b>Barracks</b></td>
												<td>This building costs <b>$10,000,000</b> to build and costs <b>$500,000</b> to maintain everyday. This building uses <b>100 GW</b> 
												every hour. This building houses a total of <b>2,000 soilders</b>. This building requires <b>25 sqmi</b>. This building can also 
												train soilders into your military.</td>
												<td><center><h2><?php echo number_format($barracks_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="barracks" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/factory.jpg"></td>
												<td><b>Factory</b></td>
												<td>This building costs <b>$350,000,000</b> to build and costs <b>$25,000,000</b> to maintain everyday. This building uses <b>1,000 GW</b>
												every hour. This building requires <b>75 sqmi</b>. This building manufactures tanks, airplanes, and artillery.</td>
												<td><center><h2><?php echo number_format($factory_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="factory" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/drydock.jpg"></td>
												<td><b>Drydrock</b></td>
												<td>This building costs <b>$650,000,000</b> to build and costs <b>$75,000,000</b> to maintain everyday. This building uses <b>1,500 GW</b>
												every hour. This building requires <b>100 sqmi</b>. This building manufactures battleships.</td>
												<td><center><h2><?php echo number_format($drydock_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="drydock" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/arsenal.jpg"></td>
												<td><b>Arsenal</b></td>
												<td>This building costs <b>$100,000,000</b> to build and costs <b>$750,000</b> to maintain everyday. This building uses <b>250 GW</b>
												every hour. This building requires <b>75 sqmi</b>. This building holds up to 250 tanks, airplanes, and artillery.</td>
												<td><center><h2><?php echo number_format($arsenal_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="arsenal" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/shipyard.jpg"></td>
												<td><b>Shipyard</b></td>
												<td>This building costs <b>$200,000,000</b> to build and costs <b>$1,500,000</b> to maintain everyday. This building uses <b>350 GW</b>
												every hour. This building requires <b>100 sqmi</b>. This building holds up to 5 battleships.</td>
												<td><center><h2><?php echo number_format($shipyard_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="shipyard" value="Build"></form></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							
							<div class="card">
								<div class="card-header" id="headingFour">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
											Power Plants
										</button>
									</h5>
								</div>
								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
									<div class="card-body">
										<table class="table table-borderless">
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/nuclearpowerplant.jpg"></td>
												<td><b>Nuclear Power Plant</b></td>
												<td>This building costs <b>$9,000,000,000</b> to build and costs <b>$71,000,000</b> to maintain every day. This building requires 
												<b>260 sqmi</b>. This building requires 450 uranium every day. This power plant produces <b>18,000 GW</b> per hour.</td>
												<td><center><h2><?php echo number_format($nuclear_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="nuclear" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/hydroelectricpowerplant.jpg"></td>
												<td><b>Hydroelectric Power Plant</b></td>
												<td>This building costs <b>$2,000,000,000</b> to build and costs <b>$200,000,000</b> to maintain every day. This building requries 
												<b>200 sqmi</b>. This power plants produces <b>11,000 GW</b> per hour.</td>
												<td><center><h2><?php echo number_format($hydroelectric_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="hydroelectric" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/coalfiredpowerplant.jpg"></td>
												<td><b>Coal-fired Power Plant</b></td>
												<td>This building costs <b>$1,000,000,000</b> to build and costs <b>$23,000,000</b> to maintain every day. This building requires
												<b>165 sqmi</b>. This building requires 4,000 coal every day. This power plant produces <b>7,000 GW</b> per hour.</td>
												<td><center><h2><?php echo number_format($coalfired_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="coal-fired" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/dieselfiredpowerplant.jpg"></td>
												<td><b>Diesel-fired Power Plant</b></td>
												<td>This building costs <b>$500,000,000</b> to build and costs <b>$10,000,000</b> to maintain every day. This building requires
												<b>165 sqmi</b>. This building requires 2,000 oil every day. This power plant produces <b>4,000 GW</b> per hour.</td>
												<td><center><h2><?php echo number_format($dieselfired_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="diesel-fired" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/solarpowerplant.jpg"></td>
												<td><b>Solar Power Plant</b></td>
												<td>This building costs <b>$750,000,000</b> to build and costs <b>$1,000,000</b> to maintain every day. This building requires
												<b>50 sqmi</b>. This power plant produces <b>1,500 GW</b> per hour.</td>
												<td><center><h2><?php echo number_format($solar_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="solar" value="Build"></form></td>
											</tr>
											<tr>
												<td><img height="128" width="256" src="./assets/art/buildings/windpowerplant.jpg"></td>
												<td><b>Wind Power Plant</b></td>
												<td>This building costs <b>$4,000,000,000</b> to build and costs <b>$5,000,000</b> to maintain every day. This building requires
												<b>50 sqmi</b>. This power plant produces <b>6,000 GW</b> per hour.</td>
												<td><center><h2><?php echo number_format($wind_count); ?></h2></center><form method="POST" action="city?id=<?php echo $id; ?>"><input type="submit" name="wind" value="Build"></form></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						<?php } ?>
						
						<br><br>
						
						<?php
						
							if ($user_isOwner) {
								if (!empty($_POST['assignland'])) {
									if (!empty($_POST['land'])) {
										$land = protect($_POST['land']);
										if ($user['land'] >= $land) {
											$user['land'] -= $land;
											$city_check['land'] += $land;
											
											$update1 = mysqli_query($mysqli, "UPDATE user SET land='".$user['land']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
											$update2 = mysqli_query($mysqli, "UPDATE city SET land='".$city_check['land']."' WHERE id='".$city_check['id']."'") or die(mysqli_error($mysqli));
											
											output(number_format($land) . " sqaure miles was added to this city.");
										} else {
											output("You do not have that much land to assign to this city.");
										}
									} else {
										output("You need to fill out all of the fields.");
									}
								}
							}
						
						?>
						
						<?php if ($user_isOwner) { ?>
							<h2>Assign land</h2>
							<p>In order to assign land put the amount of square miles you want to add to this city in the text box and click the button, <b>Assign Land</b>.</p>
							<form action="city?id=<?php echo $city_check['id']; ?>" method="POST">
								<input type="text" name="land" placeholder="Amount of land to assign (<?php echo number_format($user['land']); ?> sqmi available)">
								<input type="submit" name="assignland" value="Assign Land">
							</form>
						<?php } ?>
						
					</div>
					
				</div>
				
				<div class="col-1"></div>
			</div>

		<?php

	} else {
		output("That city does not exist.");
	}

	include("./system/footer.php");

?>