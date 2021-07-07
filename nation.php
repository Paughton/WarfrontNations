<?php

	$page = "Nation";
	include("./system/header.php");
	
	$id = protect($_GET['id']);
	$user_check_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($mysqli));
	if (mysqli_num_rows($user_check_get) > 0) {
		$user_check = mysqli_fetch_assoc($user_check_get);
		
		$user_military_get = mysqli_query($mysqli, "SELECT * FROM military WHERE id='$id'") or die(mysqli_error($mysqli));
		$user_military = mysqli_fetch_assoc($user_military_get);
		
		$city_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM city WHERE uid='".$user_check['id']."'"));
		$notification_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM notification WHERE uid='".$user_check['id']."' AND seen='0'"));
		$message_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM message WHERE receiver='".$user_check['id']."' AND seen='0'"));
		
		$users_get = mysqli_query($mysqli, "SELECT * FROM user ORDER BY score DESC") or die(mysqli_error($mysqli));
		$count = 0;
		$rank = 0;
		while ($users = mysqli_fetch_assoc($users_get)) {
			$count++;
			if ($users['id'] == $user_check['id']) {
				$rank = $count;
			}
		}
		
		$military_score = 0;
		$military_score += $user_military['soldier'] * 0.005;
		$military_score += $user_military['tank'] * 20;
		$military_score += $user_military['artillery'] * 10;
		$military_score += $user_military['airplane'] * 80;
		$military_score += $user_military['battleship'] * 160;
		
		?>
			
			<script>document.title = "<?php echo $user_check['name'] . " - " . $game_name; ?>";</script>
			<?php if (!empty($_SESSION['uid'])) { if ($user['email'] == $user_check['email']) { ?>
				<script>document.getElementById("nation_url").style = "color: #f73100 !important;"</script>
			<?php } } ?>
			
			<div class="row">
				<div class="col-1"></div>
				<?php if (!empty($_SESSION['uid'])) { ?>
					<div class="col-2">
						<!-- Left Sidebar -->
						<br><br>
						<?php if ($user['email'] != $user_check['email']) { ?>
							<!--<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='';"><i class="fas fa-envelope"></i> Message</button><p></p>-->
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='confirmbattle?id=<?php echo $user_check['id']; ?>';"><i class="fas fa-chess-rook"></i> Battle</button><p></p>
						<?php } else { ?>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='military';"><i class="fas fa-chess-rook"></i> Military</button><p></p>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='cities';"><i class="fas fa-city"></i> Cities</button><p></p>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='createcity';"><i class="fas fa-screwdriver"></i> Build a city</button><p></p>
							<?php /*if ($user['alliance'] != 0) { ?>
								<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='alliance?id=<?php echo $user['alliance']; ?>';"><i class="fas fa-users"></i> Alliance</button><p></p>
							<?php } else { ?>
								<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='createalliance';"><i class="fas fa-plus"></i> Create an alliance</button><p></p>
							<?php } */?>
							<br>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='inbox';"><i class="fas fa-inbox"></i> Inbox <?php if ($message_count > 0) { echo "<i style='color: #FFA07A'>NEW!</i>"; } ?></button><p></p>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='edit';"><i class="fas fa-edit"></i> Edit</button><p></p>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='notification';"><i class="fas fa-bell"></i> Notifications <?php if ($notification_count > 0) { echo "<i style='color: #FFA07A'>NEW!</i>"; } ?></button><p></p>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='account';"><i class="fas fa-user-circle"></i> Account</button><p></p>
						<?php } ?>
						<?php if ($user_check['alliance'] != 0) { ?> <button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='';"><i class="fas fa-users"></i> Alliance</button><p></p> <?php } ?>
					</div>
				<?php } ?>
				
				<div class="col-<?php if(!empty($_SESSION['uid'])){echo"6";}else{echo"8";}?>">
					<!-- Middle Content -->
					<div class="jumbotron">
						<h1 class="display-4"><?php echo display($user_check['name']); ?></h1>
						<p class="lead">Established <?php echo date("F", $user_check['date']) . " " . date("d", $user_check['date']) . ", " . date("Y", $user_check['date']); ?>. Ruled by, <?php echo display($user_check['leader']); ?>.</p>
					</div>
					<?php if ($user_check['quote'] != "NaN") { ?>
						<center><h2 class="unselectable" onclick="location.href = 'edit';"><i class="fas fa-quote-left"></i> <i><?php echo display($user_check['quote']); ?></i> <i class="fas fa-quote-right"></i></h2></center>
					<?php } ?>
					
					<p>The humble nation of <?php echo display($user_check['name']); ?> has a very thriving population to this day. All of its citizens are all
					devoted to their head of state, <?php echo display($user_check['leader']); ?>.</p>
					
					<center>
						<div id="piechart" style="display: inline-block;"></div>
					</center>
					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
					<script type="text/javascript">
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawChart);

						function drawChart() {

							var data = google.visualization.arrayToDataTable([
								['Category', 'Score'],
								['Military', <?php echo $military_score; ?>],
								['City', <?php echo $city_count * 2000; ?>]
							]);

							var options = {
								'title': 'Score distribution'
							};

							var chart = new google.visualization.PieChart(document.getElementById('piechart'));

							chart.draw(data, options);
						}
					</script>
					<p><b>This nation is ranked #<?php echo number_format($rank); ?> out of <?php echo number_format($user_count); ?> nations (<?php echo number_format($rank/$user_count*100); ?>%)</b></p>
					
					<hr>
					
					<?php 
						if (!empty($_SESSION['uid'])) {
							if ($user['email'] == $user_check['email']) {
								
								if(!empty($_POST['purchaseland'])) {
									if (!empty($_POST['land-amount'])) {
										$land_amount = protect($_POST['land-amount']);
										if ($user['money'] >= $land_amount * 500000) {
											$user['money'] -= $land_amount * 500000;
											$user['land'] += $land_amount;
											$update = mysqli_query($mysqli, "UPDATE user SET money='".$user['money']."', land='".$user['land']."' WHERE id='".$user['id']."'") or die(mysqli_query($mysqli));
											output(number_format($land_amount) . " square miles have been purchased.");
										} else {
											output("You don't have enough money to buy that much land.");
										}
									} else {
										output("Please supply all the fields.");
									}
								}
								?>
									<h5>Purchase land</h5>
									<p>Each square mile of land costs exactly <b>$500,000</b>.</p>
									<form action="nation?id=<?php echo $user_check['id']; ?>" method="POST">
										<input type="text" name="land-amount" placeholder="Amount of land" autocomplete="off">
										<input type="submit" name="purchaseland" value="Purchase">
									</form>
								<?php
							}
						}
					?>
				</div>
				
				<div class="col-2">
					<!-- Left Sidebar -->
					<br><br>
					<img class="img-fluid" src="./assets/art/flags/<?php echo $user_check['flag']; ?>.png" onclick="location.href = 'flag'">
					<br><br>
					<table class="table table-borderless table-sm unselectable">
						<tr>
							<td><b>Established</b></td>
							<td><?php echo date("m/d/y", $user_check['date']); ?><br><i><?php echo number_format(getAge($user_check['date'])); ?> days old</i></td>
						</tr>
						<tr>
							<td><b>Capital City</b></td>
							<?php
								if ($user_check['capitol'] != 0) {
									$capitol_get = mysqli_query($mysqli, "SELECT * FROM city WHERE id='".$user_check['capitol']."'") or die(mysqli_error($mysqli));
									$capitol = mysqli_fetch_assoc($capitol_get);
									echo "<td><a href='city?id=" . $capitol['id'] . "'>" . display($capitol['name']) . "</a></td>";
								} else {
									echo "<td>None</td>";
								}
							?>
						</tr>
						<tr>
							<td><b>City count</b></td>
							<td><?php echo number_format($city_count); ?></td>
						</tr>
						<tr>
							<td><b>Head of State</b></td>
							<td><?php echo $user_check['leader']; ?></td>
						</tr>
						<tr><td></td><td></td></tr><tr><td></td><td></td></tr>
						<tr>
							<td><b>Score</b></td>
							<td><?php echo number_format($user_check['score']); ?></td>
						</tr>
						<tr>
							<td><b>War Range</b></td>
							<td><?php echo number_format($user_check['score']*0.75); ?><br><?php echo number_format($user_check['score']*1.25); ?></td>
						</tr>
					</table>
				</div>
				<div class="col-1"></div>
			</div>

		<?php

	} else {
		output("That user does not exist.");
	}

	include("./system/footer.php");

?>