<?php

	$page = "Battle";
	include("./system/header.php");

?>

	<div class="row">
		<div class="col-1"></div>
		
		<div class="col-2">
			<!-- Left sidebar -->
		</div>
		
		<div class="col-6">
			<?php
				if (!empty($_SESSION['uid'])) {
					if (!empty($_POST['id'])) {
						$id = protect($_POST['id']);
						$user_check_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($mysqli));
						if (mysqli_num_rows($user_check_get) > 0) {
							$user_check = mysqli_fetch_assoc($user_check_get);
							if (getAge($user['date']) >= 10) {
								if (getAge($user_check['date']) >= 10) {
									if ($user['attackpoint'] > 0) {
										if ($user['allianceid'] != $user_check['allianceid']) {
											$user_check_military_get = mysqli_query($mysqli, "SELECT * FROM military WHERE id='$id'") or die(mysqli_error($mysqli));
											$user_check_military = mysqli_fetch_assoc($user_check_military_get);
											$user_check_resource_get = mysqli_query($mysqli, "SELECT * FROM resource WHERE id='$id'") or die(mysqli_error($mysqli));
											$user_check_resource = mysqli_fetch_assoc($user_check_resource_get);
												if ($user >= $user['score'] * 0.75 && $user_check['score'] <= $user['score'] * 1.25) {
													
													$user['attackpoint'] -= 1;
													
													// Checking to see if the user and enemy have enough ammunition
													$user_hasAmmunition = false;
													$enemy_hasAmmunition = false;
													if ($resource['ammunition'] >= $military['soldier'] * 2) {
														$user_hasAmmunition = true;
														$resource['ammunition'] -= $military['soldier'] * 2;
													}
													if ($user_check_resource['ammunition'] >= $user_check_military['soldier'] * 2) {
														$enemy_hasAmmunition = true;
														$user_check_resource['ammunition'] -= $user_check_military['soldier'] * 2;
													}
													
													// Calculating user power
													if ($user_hasAmmunition) {
														$user_power = $military['soldier'] * 0.005;
													} else {
														$user_power = $military['soldier'] * 0.0005;
													}
													$user_power += $military['tank'] * 20;
													$user_power += $military['artillery'] * 10;
													$user_power += $military['airplane'] * 80;
													$user_power += $military['battleship'] * 160;
													
													// Calculating enemy power
													if ($enemy_hasAmmunition) {
														$enemy_power = $user_check_military['soldier'] * 0.005;
													} else {
														$enemy_power = $user_check_military['soldier'] * 0.0005;
													}
													$enemy_power += $user_check_military['tank'] * 20;
													$enemy_power += $user_check_military['artillery'] * 10;
													$enemy_power += $user_check_military['airplane'] * 40;
													$enemy_power += $user_check_military['battleship'] * 80;
													
													// Some mt_randomization
													$user_power += mt_rand($user_power * 0.95, $user_power * 1.10);
													$enemy_power += mt_rand($enemy_power * 0.95, $enemy_power * 1.10);
													
													// Calculating death rate
													$user_deathrate = 0.20;
													$enemy_deathrate = 0.15;
													
													// If the user power is greater than the enemy power
													// In ties the enemy wins
													if ($user_power > $enemy_power) {
														$won_war = true;
														$enemy_deathrate += 0.02;
														$money_stole = round($user_check['money'] * (mt_rand(10, 15)/100));
														$user['money'] += $money_stole;
														$user_check['money'] -= $money_stole;
														if ($user_check['money'] < 0) { $user_check['money'] = 0; }
													} else {
														$won_war = false;
														$user_deathrate += 0.04;
														
													}
													
													// Calculating the losses
													$death_user_soldier = round($military['soldier'] * $user_deathrate);
													$death_user_tank = round($military['tank'] * $user_deathrate);
													$death_user_artillery = round($military['artillery'] * $user_deathrate);
													$death_user_airplane = round($military['airplane'] * $user_deathrate);
													$death_user_battleship = round($military['battleship'] * $user_deathrate);
													
													$death_enemy_soldier = round($user_check_military['soldier'] * $enemy_deathrate);
													$death_enemy_tank = round($user_check_military['tank'] * $enemy_deathrate);
													$death_enemy_artillery = round($user_check_military['artillery'] * $enemy_deathrate);
													$death_enemy_airplane = round($user_check_military['airplane'] * $enemy_deathrate);
													$death_enemy_battleship = round($user_check_military['battleship'] * $enemy_deathrate);
													
													$military['soldier'] -= $death_user_soldier;
													$military['tank'] -= $death_user_tank;
													$military['artillery'] -= $death_user_artillery;
													$military['airplane'] -= $death_user_airplane;
													$military['battleship'] -= $death_user_battleship;
													
													$user_check_military['soldier'] -= $death_enemy_soldier;
													$user_check_military['tank'] -= $death_enemy_tank;
													$user_check_military['artillery'] -= $death_enemy_artillery;
													$user_check_military['airplane'] -= $death_enemy_airplane;
													$user_check_military['battleship'] -= $death_enemy_battleship;
													
													
													$update = mysqli_query($mysqli, "UPDATE military SET soldier='".$military['soldier']."', tank='".$military['tank']."', artillery='".$military['artillery']."', airplane='".$military['airplane']."', battleship='".$military['battleship']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
													$update = mysqli_query($mysqli, "UPDATE military SET soldier='".$user_check_military['soldier']."', tank='".$user_check_military['tank']."', artillery='".$user_check_military['artillery']."', airplane='".$user_check_military['airplane']."', battleship='".$user_check_military['battleship']."' WHERE id='".$user_check['id']."'") or die(mysqli_error($mysqli));
													$update = mysqli_query($mysqli, "UPDATE user SET money='".$user['money']."', attackpoint='".$user['attackpoint']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
													$update = mysqli_query($mysqli, "UPDATE user SET money='".$user_check['money']."' WHERE id='".$user_check['id']."'") or die(mysqli_error($mysqli));
													
													if ($won_war) {
														$message = $user['name'] . " has attacked you and succeded. They stole <b>$" . number_format($money_stole) . "</b>.";
													} else {
														$message = $user['name'] . " has attacked you and failed.";
													}
													$notification = mysqli_query($mysqli, "INSERT INTO notification (uid, date, seen, text) VALUES ('".$user_check['id']."', '".time()."', '0', '$message')") or die(mysqli_error($mysqli));
													
													// Output this to the screen kid
													?>
														<?php if ($won_war) { ?>
															<h2>The battle was victorious</h2>
															<p>You have on the battle against <?php echo display($user_check['name']); ?>. You have stolen a total of
															<b>$<?php echo number_format($money_stole); ?></b>. An alert was sent to <?php echo display($user_check['name']); ?> 
															about the attack you have inflicted upon them.</p>
														<?php } else { ?>
															<h2>The battle was a failure</h2>
															<p>An alert was sent to <?php echo display($user_check['name']); ?> about the attack you have inflicted upon them.</p>
														<?php } ?>
														<br>
														<h5>Your losses</h5>
														<table class="table table-striped table-borderless">
															<tr>
																<td>Soldiers</td>
																<td><?php echo number_format($death_user_soldier); ?></td>
															</tr>
															<tr>
																<td>Tanks</td>
																<td><?php echo number_format($death_user_tank); ?></td>
															</tr>
															<tr>
																<td>Artillery</td>
																<td><?php echo number_format($death_user_artillery); ?></td>
															</tr>
															<tr>
																<td>Airplanes</td>
																<td><?php echo number_format($death_user_airplane); ?></td>
															</tr>
															<tr>
																<td>Battleships</td>
																<td><?php echo number_format($death_user_battleship); ?></td>
															</tr>
														</table>
														<br>
														<h5><?php echo display($user_check['name']); ?>'s losses</h5>
														<table class="table table-striped table-borderless">
															<tr>
																<td>Soldiers</td>
																<td><?php echo number_format($death_enemy_soldier); ?></td>
															</tr>
															<tr>
																<td>Tanks</td>
																<td><?php echo number_format($death_enemy_tank); ?></td>
															</tr>
															<tr>
																<td>Artillery</td>
																<td><?php echo number_format($death_enemy_artillery); ?></td>
															</tr>
															<tr>
																<td>Airplanes</td>
																<td><?php echo number_format($death_enemy_airplane); ?></td>
															</tr>
															<tr>
																<td>Battleships</td>
																<td><?php echo number_format($death_enemy_battleship); ?></td>
															</tr>
														</table>
													<?php
													
												} else {
													output("This nation is either a too low score or too high score for you to attack.");
												}
										} else {
											output("You are in the same alliance as this nation.");
										}
									} else {
										output("You need at least one attack point to attack this nation.");
									}
								} else {
									output("In order for you to attack this nation, it must be 10 days or older.");
								}
							} else {
								output("In order for you to attack, your nation must be 10 days or older.");
							}
						} else {
							output("That user does not exist.");
						}
					} else {
						output("You have incorrectly visited this page.");
					}
				} else {
					output("You must be logged in to view this page.");
				}
			?>
		</div

		<div class="col-2">
			<!-- Right sidebar -->
		</div>

		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>