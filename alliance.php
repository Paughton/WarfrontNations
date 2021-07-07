<?php

	$page = "Alliance";
	include("./system/header.php");
	
	$id = protect($_GET['id']);
	$alliance_check_get = mysqli_query($mysqli, "SELECT * FROM alliance WHERE id='$id'") or die(mysqli_error($mysqli));
	if (mysqli_num_rows($alliance_check_get) > 0) {
		$alliance_check = mysqli_fetch_assoc($alliance_check_get);
		
		$leader_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='".$alliance_check['leader']."'") or die(mysqli_error($mysqli));
		$leader = mysqli_fetch_assoc($leader_get);
		
		$member_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM user WHERE allianceid='".$alliance_check['id']."'"));
		
		?>
			
			<script>document.title = "<?php echo $alliance_check['name'] . " - " . $game_name; ?>";</script>
			
			<div class="row">
				<div class="col-1"></div>
				<div class="col-2">
					<!-- Left Sidebar -->
					
				</div>
				
				<div class="col-6">
					<div class="jumbotron">
						<h1 class="display-4"><?php echo display($alliance_check['name']); ?></h1>
						<p class="lead">Established <?php echo date("F", $alliance_check['date']) . " " . date("d", $alliance_check['date']) . ", " . date("Y", $alliance_check['date']); ?>. Commissioned by, <a href="nation?id=<?php echo $leader['id']; ?>"><?php echo display($leader['name']); ?></a>.</p>
					</div>
					
					<?php 
						if (!empty($_SESSION['uid'])) {
							
							if (!empty($_POST['join'])) {
								if ($user['allianceid'] == 0) {
									$update = mysqli_query($mysqli, "UPDATE user SET allianceid='".$alliance_check['id']."' where id='".$user['id']."'") or die(mysqli_error($mysqli));
									output("You have joined the alliance: " . display($alliance_check['name']) . ".");
									send_notification($leader['id'], $user['name'] . " has joined your alliance");
								} else {
									output("You must not already be in an alliance.");
								}
							} else if (!empty($_POST['leave'])) {
								if ($user['allianceid'] == $alliance_check['id'] && $user['id'] != $alliance_check['leader']) {
									$update = mysqli_query($mysqli, "UPDATE user SET allianceid='0' where id='".$user['id']."'") or die(mysqli_error($mysqli));
									output("You have left the alliance: " . display($alliance_check['name']) . ".");
									send_notification($leader['id'], $user['name'] . " has left your alliance");
								} else {
									output("You must be in the alliance or you must not be the commissioner.");
								}
							} else if (!empty($_POST['disband'])) {
								if ($user['id'] == $alliance_check['leader'] && $member_count == 1) {
									$update = mysqli_query($mysqli, "UPDATE user SET allianceid='0' where allianceid='".$alliance_check['id']."'") or die(mysqli_error($mysqli));
									$delete = mysqli_query($mysqli, "DELETE FROM alliance WHERE id='".$alliance_check['id']."'") or die(mysqli_error($mysqli));
								} else {
									output("You must be the only member in your alliance.");
								}
							}
							
							if ($user['allianceid'] == 0) {
								?>
									<form action="alliance?id=<?php echo $alliance_check['id']; ?>" method="POST">
										<input type="submit" name="join" value="Join">
									</form>
									<br>
								<?php
							} else if ($user['allianceid'] == $alliance_check['id'] && $user['id'] != $alliance_check['leader']) {
								?>
									<form action="alliance?id=<?php echo $alliance_check['id']; ?>" method="POST">
										<input type="submit" name="leave" value="Leave">
									</form>
									<br>
								<?php
							} else if ($user['id'] == $alliance_check['leader'] && $member_count == 1) {
								?>
									<form action="alliance?id=<?php echo $alliance_check['id']; ?>" method="POST">
										<input type="submit" name="disband" value="Disband">
									</form>
									<br>
								<?php
							}
						}
					?>
					
					<h5>Members</h5>
					
					<?php
						if (!empty($_SESSION['uid'])) {
							if ($user['id'] == $alliance_check['leader']) {
								if (!empty($_POST['removeuser'])) {
									if (!empty($_POST['id'])) {
										$id = protect($_POST['id']);
										$user_check_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($mysqli));
										if (mysqli_num_rows($user_check_get) > 0) {
											$user_check = mysqli_fetch_assoc($user_check_get);
											if ($user_check['allianceid'] == $alliance_check['id']) {
												send_notification($user_check['id'], "You were removed from the alliance, ".$alliance_check['name'].".");
												$update = mysqli_query($mysqli, "UPDATE user SET allianceid='0' WHERE id='".$user_check['id']."'") or die(mysqli_error($mysqli));
												output($user_check['name'] . " has been removed from your alliance.");
											} else {
												output("That user is not a part of you alliance.");
											}
										} else {
											output("That user does not exist.");
										}
									} else {
										output("There was a probelm in removing that user.");
									}
								} else if (!empty($_POST['promoteuser'])) {
									if (!empty($_POST['id'])) {
										$id = protect($_POST['id']);
										$user_check_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($mysqli));
										if (mysqli_num_rows($user_check_get) > 0) {
											$user_check = mysqli_fetch_assoc($user_check_get);
											if ($user_check['allianceid'] == $alliance_check['id']) {
												send_notification($user_check['id'], "You were promoted in the alliance, ".$alliance_check['name'].".");
												$alliance_check['leader'] = $user_check['id'];
												$alliance['leader'] = $user_check['id'];
												$update = mysqli_query($mysqli, "UPDATE alliance SET leader='".$alliance_check['leader']."' WHERE id='".$alliance_check['id']."'") or die(mysqli_error($mysqli));
												output($user_check['name'] . " has been promoted.");
											} else {
												output("That user is not a part of you alliance.");
											}
										} else {
											output("That user does not exist.");
										}
									} else {
										output("There was a probelm in promoting that user.");
									}
								}
							}
						}
					?>
					
					<table class="table table-borderless">
						<thead class="thead-dark">
							<th scope="col">Nation</th>
							<?php
								if (!empty($_SESSION['uid'])) {
									if ($user['id'] == $leader['id']) {
										?><th scope="col">Action</th><?php
									}
								}
							?>
						</thead>
						<tbody>
							<?php
								$member_get = mysqli_query($mysqli, "SELECT * FROM user WHERE allianceid='".$alliance_check['id']."'") or die(mysqli_error($mysqli));
								while ($member = mysqli_fetch_assoc($member_get)) {
									?>
										<tr class="<?php if ($member['id'] == $alliance_check['leader']) { echo "table-danger"; } ?>">
											<td><h2><a href="nation?id=<?php echo $member['id']; ?>"><?php echo display($member['name']); ?></a></h2></td>
											<?php
												if (!empty($_SESSION['uid'])) {
													if ($user['id'] == $leader['id']) {
														if ($member['id'] != $user['id']) {
															?>
																<td>
																	<form action="alliance?id=<?php echo $id; ?>" method="POST">
																		<input type="hidden" name="id" value="<?php echo $member['id']; ?>">
																		<input type="submit" name="removeuser" value="Remove">
																	</form>
																	<p></p>
																	<form action="alliance?id=<?php echo $id; ?>" method="POST">
																		<input type="hidden" name="id" value="<?php echo $member['id']; ?>">
																		<input type="submit" name="promoteuser" value="Promote">
																	</form>
																</td>
															<?php
														} else {
															?><td></td><?php
														}
													}
												}
											?>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
				
				<div class="col-2">
					<!-- Left Sidebar -->
				</div>
				<div class="col-1"></div>
			</div>

		<?php

	} else {
		output("That alliance does not exist.");
	}

	include("./system/footer.php");

?>