<?php

	$page = "Battle";
	include("./system/header.php");

?>

	<div class="row">
		<div class="col-1"></div>
		
		<div class="col-2">
			<!-- Left sidebar -->
			<?php if (!empty($_SESSION['uid'])) { ?>
				<h5>Your military</h5>
				<table class="table table-borderless table-dark">
					<tr>
						<td>Soldiers</td>
						<td><?php echo number_format($military['soldier']); ?></td>
					</tr>
					<tr>
						<td>Tanks</td>
						<td><?php echo number_format($military['tank']); ?></td>
					</tr>
					<tr>
						<td>Artillery</td>
						<td><?php echo number_format($military['artillery']); ?></td>
					</tr>
					<tr>
						<td>Airplanes</td>
						<td><?php echo number_format($military['airplane']); ?></td>
					</tr>
					<tr>
						<td>Battleships</td>
						<td><?php echo number_format($military['battleship']); ?></td>
					</tr>
				</table>
			<?php } ?>
		</div>
		
		<div class="col-6">
			<?php
				if (!empty($_SESSION['uid'])) {
					if (!empty($_GET['id'])) {
						$id = protect($_GET['id']);
						$user_check_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($mysqli));
						if (mysqli_num_rows($user_check_get) > 0) {
							$user_check = mysqli_fetch_assoc($user_check_get);
							if (getAge($user['date']) >= 10) {
								if (getAge($user_check['date']) >= 10) {
									if ($user['attackpoint'] > 0) {
										if ($user['allianceid'] != $user_check['allianceid']) {
											$user_check_military_get = mysqli_query($mysqli, "SELECT * FROM military WHERE id='$id'") or die(mysqli_error($mysqli));
											$user_check_military = mysqli_fetch_assoc($user_check_military_get);
											
											if ($user >= $user['score'] * 0.75 && $user_check['score'] <= $user['score'] * 1.25) {
												?>
													<h2>Confirm attack</h2>
													<p>In order to confirm you attack against, <b><?php echo display($user_check['name']); ?></b> you must click the Confrim Attack 
													button below to execute your attack</p>
													<table class="table table-borderless">
														<tr>
															<td><b>Your score</b></td>
															<td><?php echo number_format($user['score']); ?></td>
														</tr>
														<tr>
															<td><b><?php echo display($user_check['name']); ?>'s score</b></td>
															<td><?php echo number_format($user_check['score']); ?></td>
														</tr>
														<tr>
															<td><b>Your attack points</b></td>
															<td><?php echo number_format($user['attackpoint']); ?></td>
														</tr>
														<tr>
															<td><b><?php echo display($user_check['name']); ?>'s attack points</b></td>
															<td><?php echo number_format($user_check['attackpoint']); ?></td>
														</tr>
													</table>
													<form action="battle" method="POST">
														<input type="hidden" name="id" value="<?php echo $id; ?>">
														<input type="submit" name="battle" value="Confirm Attack">
													</form>
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