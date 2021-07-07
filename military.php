<?php

	$page = "Military";
	include("./system/header.php");

	$barracks_count = 0;
	$arsenal_count = 0;
	$shipyard_count = 0;

	$city_get = mysqli_query($mysqli, "SELECT * FROM city WHERE uid='".$user['id']."'") or die(mysqli_error($mysqli));
	while ($city = mysqli_fetch_assoc($city_get)) {
		$barracks_count += mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM building WHERE cid='".$city['id']."' AND type='barracks'"));
		$arsenal_count += mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM building WHERE cid='".$city['id']."' AND type='arsenal'"));
		$shipyard_count += mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM building WHERE cid='".$city['id']."' AND type='shipyard'"));
	}
?>

	<div class="row">
		<div class="col-1"></div>
		
		<div class="col-10">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
				
				<h2>Military</h2>
				<table class="table table-borderless">
					<tr>
						<td><h5>Barracks slots</h5></td>
						<td><h5><?php echo number_format($military['soldier']); ?> / <?php echo number_format($barracks_count * 2000); ?></h5></td>
					</tr>
					<tr>
						<td><h5>Arsenal slots</h5></td>
						<td><h5><?php echo number_format($military['tank'] + $military['artillery'] + $military['airplane']); ?> / <?php echo number_format($arsenal_count * 250); ?></h5></td>
					</tr>
					<tr>
						<td><h5>Shipyard slots</h5></td>
						<td><h5><?php echo number_format($military['battleship']); ?> / <?php echo number_format($shipyard_count * 5); ?></h5></td>
					</tr>
				</table>
				
				<?php
					if (!empty($_POST['soldier'])) {
						if (!empty($_POST['soldier-count'])) {
							$soldier = protect($_POST['soldier-count']);
							if ($military['soldier'] + $soldier <= $barracks_count * 2000) {
								if ($user['money'] >= $soldier * 18000) {
									$user['money'] -= $soldier * 18000;
									$military['soldier'] += $soldier;
									
									output(number_format($soldier) . " soldiers have been enlisted");
								} else {
									output("You do not have enough resources to enlist those.");
								}
							} else {
								output("You do not have enough vacant barracks slots.");
							}
						} else {
							output("You must fill out all of the fields.");
						}
					} else if (!empty($_POST['tank'])) {
						if (!empty($_POST['tank-count'])) {
							$tank = protect($_POST['tank-count']);
							if ($military['tank'] + $military['artillery'] + $military['airplane'] + $tank <= $arsenal_count * 250) {
								if ($user['money'] >= $tank * 8580000 && $resource['steel'] >= $tank * 5400 && $resource['aluminum'] >= $tank * 2000) {
									$user['money'] -= $tank * 8580000;
									$resource['steel'] -= $tank * 5400;
									$resource['aluminum'] -= $tank * 2000;
									$military['tank'] += $tank;
									
									output(number_format($tank) . " tanks have been manufactured");
								} else {
									output("You do not have enough resources to manufactor those.");
								}
							} else {
								output("You do not have enough vacant barracks slots.");
							}
						} else {
							output("You must fill out all of the fields.");
						}
					} else if (!empty($_POST['artillery'])) {
						if (!empty($_POST['artillery-count'])) {
							$artillery = protect($_POST['artillery-count']);
							if ($military['tank'] + $military['artillery'] + $military['airplane'] + $artillery <= $arsenal_count * 250) {
								if ($user['money'] >= $artillery * 4420000 && $resource['steel'] >= $artillery * 4000) {
									$user['money'] -= $artillery * 8580000;
									$resource['steel'] -= $artillery * 4000;
									$military['artillery'] += $artillery;
									
									output(number_format($artillery) . " artillery units have been manufactured");
								} else {
									output("You do not have enough resources to manufactor those.");
								}
							} else {
								output("You do not have enough vacant barracks slots.");
							}
						} else {
							output("You must fill out all of the fields.");
						}
					} else if (!empty($_POST['airplane'])) {
						if (!empty($_POST['airplane-count'])) {
							$airplane = protect($_POST['airplane-count']);
							if ($military['tank'] + $military['artillery'] + $military['airplane'] + $airplane <= $arsenal_count * 250) {
								if ($user['money'] >= $airplane * 148000000 && $resource['steel'] >= $airplane * 1000 && $resource['aluminum'] >= $airplane * 15000) {
									$user['money'] -= $airplane * 148000000;
									$resource['steel'] -= $airplane * 1000;
									$resource['aluminum'] -= $airplane * 15000;
									$military['airplane'] += $airplane;
									
									output(number_format($airplane) . " airplanes have been manufactured");
								} else {
									output("You do not have enough resources to manufactor those.");
								}
							} else {
								output("You do not have enough vacant barracks slots.");
							}
						} else {
							output("You must fill out all of the fields.");
						}
					} else if (!empty($_POST['battleship'])) {
						if (!empty($_POST['battleship-count'])) {
							$battleship = protect($_POST['battleship-count']);
							if ($military['battleship'] + $battleship <= $shipyard_count * 250) {
								if ($user['money'] >= $battleship * 100000000 && $resource['steel'] >= $battleship * 50000) {
									$user['money'] -= $battleship * 100000000;
									$resource['steel'] -= $battleship * 50000;
									$military['battleship'] += $battleship;
									
									output(number_format($battleship) . " battleships have been manufactured");
								} else {
									output("You do not have enough resources to manufactor those.");
								}
							} else {
								output("You do not have enough vacant barracks slots.");
							}
						} else {
							output("You must fill out all of the fields.");
						}
					}
					
					$update = mysqli_query($mysqli, "UPDATE user SET money='".$user['money']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
					$update = mysqli_query($mysqli, "UPDATE resource SET steel='".$resource['steel']."', aluminum='".$resource['aluminum']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
					$update = mysqli_query($mysqli, "UPDATE military SET soldier='".$military['soldier']."', tank='".$military['tank']."', artillery='".$military['artillery']."', airplane='".$military['airplane']."', battleship='".$military['battleship']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
					
				?>
				
				<table class="table table-borderless">
					<tr>
						<td><img height="128" width="256" src="./assets/art/buildings/soldier.jpg"></td>
						<td><b>Soldier</b></td>
						<td>One soldier costs $18,000 to enlist into your military. Soldiers require a vacant slot in a 
						barracks. In order to enlist a soldier you must have a barracks.</td>
						<td>
							<center><h2><?php echo number_format($military['soldier']); ?></h2></center>
							<form action="military" method="POST"><input type="text" name="soldier-count" placeholder="Amount"><input type="submit" name="soldier" value="Enlist" autocomplete="off"></form>
						</td>
					</tr>
					<tr>
						<td><img height="128" width="256" src="./assets/art/buildings/tank.jpg"></td>
						<td><b>Tank</b></td>
						<td>One tank costs a total of $8,580,000. It also requires 5,400 steel and 2,000 aluminum. Tanks require
						a vacant slot in an arsenal. In order to manufactor a tank you must have a factory.</td>
						<td>
							<center><h2><?php echo number_format($military['tank']); ?></h2></center>
							<form action="military" method="POST"><input type="text" name="tank-count" placeholder="Amount"><input type="submit" name="tank" value="Manufacture"></form>
						</td>
					</tr>
					<tr>
						<td><img height="128" width="256" src="./assets/art/buildings/artillery.jpg"></td>
						<td><b>Artillery</b></td>
						<td>One artillery unit costs $4,420,000 to manufacture. It also requires 4,000 steel. 
						Artillery require a vacant slot in an arsenal. In order to manufactor an artillery unit you must have a factory.</td>
						<td>
							<center><h2><?php echo number_format($military['artillery']); ?></h2></center>
							<form action="military" method="POST"><input type="text" name="artillery-count" placeholder="Amount"><input type="submit" name="artillery" value="Manufacture"></form>
						</td>
					</tr>
					<tr>
						<td><img height="128" width="256" src="./assets/art/buildings/airplane.jpg"></td>
						<td><b>Airplane</b></td>
						<td>One airplane costs $148,000,000 to manufacture. It also requires 1,000 steel and 15,000 aluminum.  
						Airplanes require a vacant slot in an arsenal. In order to manufactor an airplane you must have a factory.</td>
						<td>
							<center><h2><?php echo number_format($military['airplane']); ?></h2></center>
							<form action="military" method="POST"><input type="text" name="airplane-count" placeholder="Amount"><input type="submit" name="airplane" value="Manufacture"></form>
						</td>
					</tr>
					<tr>
						<td><img height="128" width="256" src="./assets/art/buildings/battleship.jpg"></td>
						<td><b>Battleship</b></td>
						<td>One battleship costs $100,000,000 to manufacture. It also requires 50,000 steel.  
						Battleships require a vacant slot in a shipyard. In order to manufactor a battleship you must have a drydock.</td>
						<td>
							<center><h2><?php echo number_format($military['battleship']); ?></h2></center>
							<form action="military" method="POST"><input type="text" name="battleship-count" placeholder="Amount"><input type="submit" name="battleship" value="Manufacture"></form>
						</td>
					</tr>
				</table>
				
			<?php
				} else {
					output("You must be logged in to view this page.");
				}
			?>
		</div

		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>