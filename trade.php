<?php

	$page = "Trade";
	include("./system/header.php");
	
?>
	
	<script>document.getElementById("trade_url").style = "color: #f73100 !important;"</script>
	
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
			
				<h5>Trading</h5>
				<p>Here you can trade with other players with resources or money. You can make a trade offer for money by pressing the button below. You can also
				accept a trade for resources using money in the list of trades below the button.</p>
				<br>
				
				<button class="btn btn-primary" style="width: 100%;" onclick="location.href='createtrade'">Make a trade offer</button>
				<br><br>
			
				<!--<marquee behavior="scroll" direction="left">Here you can trade and do other various other stuff</marquee>-->
			
				<?php
				
					if (!empty($_POST['trade'])) {
						if (!empty($_POST['id'])) {
							$id = protect($_POST['id']);
							$trade_get = mysqli_query($mysqli, "SELECT * FROM trade WHERE id='$id'") or die(mysqli_error($mysqli));
							if (mysqli_num_rows($trade_get) > 0) {
								$trade = mysqli_fetch_assoc($trade_get);
								$trade_user_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='".$trade['uid']."'") or die(mysqli_error($mysqli));
								$trade_user = mysqli_fetch_assoc($trade_user_get);
								$trade_user_resource_get = mysqli_query($mysqli, "SELECT * FROM resource WHERE id='".$trade['uid']."'") or die(mysqli_error($mysqli));
								$trade_user_resource = mysqli_fetch_assoc($trade_user_resource_get);
								if ($user['money'] >= $trade['price']) {
									if ($trade_user_resource[$trade['resource']] >= $trade['amount']) {
										// money
										$user['money'] -= $trade['price'];
										$trade_user['money'] += $trade['price'];
										// resource
										$resource[$trade['resource']] += $trade['amount'];
										$trade_user_resource[$trade['resource']] -= $trade['amount'];
										
										$update = mysqli_query($mysqli, "UPDATE user SET money='".$user['money']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
										$update = mysqli_query($mysqli, "UPDATE user SET money='".$trade_user['money']."' WHERE id='".$trade_user['id']."'") or die(mysqli_error($mysqli));
										
										$update = mysqli_query($mysqli, "UPDATE resource SET ".$trade['resource']."='".$resource[$trade['resource']]."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
										$update = mysqli_query($mysqli, "UPDATE resource SET ".$trade['resource']."='".$trade_user_resource[$trade['resource']]."' WHERE id='".$trade_user['id']."'") or die(mysqli_error($mysqli));										
										
										$delete_trade = mysqli_query($mysqli, "DELETE FROM trade WHERE id='$id'") or die(mysqli_error($mysqli));
										
										output("You have traded with " . $trade_user['name'] . ".");
										send_notification($trade_user['id'], $user['name'] . " has traded with you.");
									} else {
										output("That nation does not have enough resources.");
										$delete_trade = mysqli_query($mysqli, "DELETE FROM trade WHERE id='$id'") or die(mysqli_error($mysqli));
									}
								} else {
									output("You don't have enough " . $trade['resource'] . ".");
								}
							} else {
								output("That trade offer doesn't exist.");
							}
						} else {
							output("There was an error from processing your trade completion.");
						}
					} else if (!empty($_POST['delete'])) {
						if (!empty($_POST['delete-id'])) {
							$id = protect($_POST['delete-id']);
							$delete_trade = mysqli_query($mysqli, "DELETE FROM trade WHERE id='$id'") or die(mysqli_error($mysqli));
							output("You have deleted your trade offer.");
						} else {
							output("There was an error preventing you destroying that trade offer.");
						}
					}
				
				?>
			
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Date</th>
							<th scope="col">Nation</th>
							<th scope="col">Amount</th>
							<th scope="col">Resource</th>
							<th scope="col">Price</th>
							<th scope="col"><!-- Button will be here --></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$trade_get = mysqli_query($mysqli, "SELECT * FROM trade") or die(mysqli_error($mysqli));
							$count = 0;
							while ($trade = mysqli_fetch_assoc($trade_get)) {
								$count++;
								$trade_user_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='".$trade['uid']."'") or die(mysqli_error($mysqli));
								$trade_user = mysqli_fetch_assoc($trade_user_get);
								?>
									<tr>
										<th scope="row"><?php echo number_format($count); ?></th>
										<td><?php echo date("m/d/Y", $trade['date']); ?><br><?php echo date("g:i A", $trade['date']); ?></td>
										<td><a href="nation?id=<?php echo $trade_user['id']; ?>"><?php echo $trade_user['name']; ?></a></td>
										<td><?php echo number_format($trade['amount']); ?></td>
										<td><?php echo ucfirst($trade['resource']); ?></td>
										<td>$<?php echo number_format($trade['price']); ?><br>~$<?php echo number_format($trade['price']/$trade['amount']); ?> each</td>
										<?php if ($user['id'] != $trade_user['id']) { ?>
											<td><form action="trade" method="POST">
												<input type="hidden" name="id" value="<?php echo $trade['id']; ?>">
												<input type="submit" name="trade" value="Trade">
											</form></td>
										<?php } else { ?>
											<td><form action="trade" method="POST">
												<input type="hidden" name="delete-id" value="<?php echo $trade['id']; ?>">
												<input type="submit" name="delete" value="Delete">
											</form></td>

										<?php } ?>
									</tr>
								<?php
							}
						?>
					</tbody>
				</table>
				
			<?php
				} else {
					output("You must be logged in to view this page.");
				}
			?>
		</div
		
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>