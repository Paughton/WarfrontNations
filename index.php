<?php
	include("./system/config.php");
?>

<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<title>Home - <?php echo $game_name; ?></title>
		
		<!-- Bootstrap & Jquery & Responsive Related -->
		<link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
		<script src="./assets/jquery/jquery-3.3.1.min.js"></script>
		<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta charset="utf-8">
		
		<!-- Font Awesome -->
		<script defer src="./assets/fontawesome/js/all.js"></script>
		
		<!-- CSS && JS -->
		<link rel="stylesheet" href="./assets/style.css?v=1.4">
		<script src="./assets/script.js"></script>
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="favicon.png">
	</HEAD>
	
	<BODY>
		
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top home_navbar fixed-top">
			<!--<a class="navbar-brand" href="index"><?php echo $game_name; ?>&emsp;</a>-->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<!-- Navbar Links LEFT -->
					<!--<li class="nav-item">
						<a class="nav-link" href="">&emsp;Warfront Nations&emsp;</a>
					</li>&emsp;-->
					<!--<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Dropdown
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>-->
				</ul>
				<ul class="navbar-nav">
					<!-- Navbar Links RIGHT -->
					<?php if (!empty($_SESSION['uid'])) { ?>
						<span class="navbar-text unselectable">
							<img src="./assets/art/money.png" height="16" width="24" title="Money"> $<?php echo number_format($user['money']); ?> &nbsp&nbsp
							<img src="./assets/art/aluminum.png" height="16" width="16" title="Aluminum"> <?php echo number_format($resource['aluminum']); ?> &nbsp
							<img src="./assets/art/ammunition.png" height="16" width="16" title="Ammunition"> <?php echo number_format($resource['ammunition']); ?> &nbsp
							<img src="./assets/art/bauxite.png" height="16" width="16" title="Bauxite"> <?php echo number_format($resource['bauxite']); ?> &nbsp
							<img src="./assets/art/coal.png" height="16" width="16" title="Coal"> <?php echo number_format($resource['coal']); ?> &nbsp
							<img src="./assets/art/food.png" height="16" width="16" title="Food"> <?php echo number_format($resource['food']); ?> &nbsp
							<img src="./assets/art/gasoline.png" height="16" width="16" title="Gasoline"> <?php echo number_format($resource['gasoline']); ?> &nbsp
							<img src="./assets/art/iron.png" height="16" width="16" title="Iron"> <?php echo number_format($resource['iron']); ?> &nbsp
							<img src="./assets/art/lead.png" height="16" width="16" title="Lead"> <?php echo number_format($resource['lead']); ?> &nbsp
							<img src="./assets/art/oil.png" height="16" width="16" title="Oil"> <?php echo number_format($resource['oil']); ?> &nbsp
							<img src="./assets/art/steel.png" height="16" width="16" title="Steel"> <?php echo number_format($resource['steel']); ?> &nbsp
							<img src="./assets/art/uranium.png" height="16" width="16" title="Uranium"> <?php echo number_format($resource['uranium']); ?> &nbsp
						</span>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link" href="register"><i class="fas fa-user-plus"></i>&emsp;Register&emsp;</a>
						</li>&emsp;
						<li class="nav-item">
							<a class="nav-link" href="login"><i class="fas fa-sign-in-alt"></i>&emsp;Login&emsp;</a>
						</li>&emsp;
					<?php } ?>
				</ul>
			</div>
		</nav>
		
		<div class="container-fluid">
			<?php include("./system/navigation.php"); ?>
			
			<script>document.getElementById("home_url").style = "color: #f73100 !important;"</script>
			
			<hr>
			<div class="row">
				<div class="col-1"></div>
				<div class="col-2">
					<!-- Left Sidebar -->
					<?php if (empty($_SESSION['uid'])) { ?>
						<h2>Register Today</h2>
						<p>Start building up your nation. You get to decide what happens in your nation, such as a more peaceful or warbaring nation.</p>
						<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='register';"><i class="fas fa-flag"></i> Create your Nation!</button>
						<br><br>
						<h2>Free to Play</h2>
						<p><?php echo $game_name; ?> will not require any credit cards or any other form of payment to play.</p>
						<hr>
						<h2>Login</h2>
						<form action="login" method="POST" id="login">
							<input type="text" name="email" placeholder="Email" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
							<input type="password" name="password" placeholder="Password" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
							<input type="submit" name="login" value="Login">
						</form><br>
						<p>Don't have an account? <a href="register">Register Today!</a></p>
						<hr>
					<?php } ?>
					<h2>Game Statistics</h2>
					<p><b>Nations Created</b>: <?php echo number_format($user_count); ?></p>
				</div>
				
				<div class="col-6">
					<!-- Middle Content -->
					<center>
						<h2>Begin your Conquest</h2><hr>
					</center>
						<p><?php echo $game_name; ?> is a free-to-play nation simluator game that can be played online and with your friends. You can build cities and equip them with the best forms of power generation. You can build the mightiest military
						that will make your foes trememble, or you can deal you probelms with diplomacy and be the most peacful nation on the planet. Whatever you desire is, you can do it in <?php echo $game_name; ?>. The sky is the limit when it comes
						to creating your nation. Here you are the one in charge of your nation development.</p>
						<p>New to the game? Click <a href="tutorial">here</a> for a tutorial.</p><br>
						<table class="table table-borderless">
							<thead class="thead-dark">
								<tr>
									<th scope="col">01/04/2019</th>
									<th scope="col">Released the game today!</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2">
										<p>Today I have released the game after about a week in the making. I hope there aren't too many bugs or erros lets just pray that it will
										go well. Oh well... I hope you enjoy the game as much as I have enojyed programming it. This game takes a lot of time and effort to make. This 
										game is currently in beta due to I am not quite yet satisfied with it yet. If you find any bugs or things you would like in the game pleaes contact 
										me at <a href="mailto:tanktotgames@gmail.com">tanktotgames@gmail.com</a>.</p>
									</td>
								</tr>
							</tbody>
						</table>
						<p><?php echo $game_name; ?> is currently under development. <?php echo $game_version; ?></p>
				</div>
				
				<div class="col-2">
					<!-- Right Sidebar -->
					<h2>Email Newsletters</h2>
					<p>If you want to have emails sent to you whenever a new update or something exciting is coming to <?php echo $game_name; ?> then subscribe to our Email Newsletters.</p>
					<form action="subscribe" method="POST" id="subscribe">
						<input type="text" name="email" placeholder="Email" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
						<input type="submit" name="subscribe" value="Subscribe">
					</form><br>
					<hr>
					<?php
						$random_number = rand(0, 2);
						$count = 0;
						switch ($random_number) {
							case 0:
								// This will be for the richest nations
								$users_get = mysqli_query($mysqli, "SELECT * FROM user ORDER BY money DESC LIMIT 5") or die(mysqli_error($mysqli));
								echo "<h2>Richest Nations</h2>";
								echo "<table class=\"table table-borderless\">";
								while ($users = mysqli_fetch_assoc($users_get)) {
									$count++;
									?>
										<tr>
											<td>#<?php echo $count; ?></td>
											<td><a href="nation?id=<?php echo $users['id']; ?>"><?php echo display($users['name']); ?></a></td>
											<td>$<?php echo number_format($users['money']); ?></td>
										</tr>
									<?php
								}
								echo "</table>";
								break;
								
							case 1:
								// This will be for the oldest nations
								$users_get = mysqli_query($mysqli, "SELECT * FROM user ORDER BY date ASC LIMIT 5") or die(mysqli_error($mysqli));
								echo "<h2>Oldest Nations</h2>";
								echo "<table class=\"table table-borderless\">";
								while ($users = mysqli_fetch_assoc($users_get)) {
									$count++;
									?>
										<tr>
											<td>#<?php echo $count; ?></td>
											<td><a href="nation?id=<?php echo $users['id']; ?>"><?php echo display($users['name']); ?></a></td>
											<td><?php echo date("m/d/Y", $users['date']); ?></td>
										</tr>
									<?php
								}
								echo "</table>";
								break;
								
							case 2:
								// This will be for the newest nations
								$users_get = mysqli_query($mysqli, "SELECT * FROM user ORDER BY date DESC LIMIT 5") or die(mysqli_error($mysqli));
								echo "<h2>Newest Nations</h2>";
								echo "<table class=\"table table-borderless\">";
								while ($users = mysqli_fetch_assoc($users_get)) {
									$count++;
									?>
										<tr>
											<td>#<?php echo $count; ?></td>
											<td><a href="nation?id=<?php echo $users['id']; ?>"><?php echo display($users['name']); ?></a></td>
											<td><?php echo date("m/d/Y", $users['date']); ?></td>
										</tr>
									<?php
								}
								echo "</table>";
								break;
						}
					?>
				</div>
				<div class="col-1"></div>
			</div>
		</div>
		
		<br><br><br>
		<center>
			<div style="width: 728px; height: 90px; background: #428bca; color: #fff; line-height: 90px; text-align: center; ">~*~ AD PLACEHOLDER ~*~</div><br />
		</center>
		<?php echo date("g:i A T ", time()); ?><br>
		<?php echo date("m/d/Y", time()); ?>
		<footer class="footer page-footer font-small blue pt-4 mt-4">
			<div class="container-fluid text-center text-md-left">
				<div style="background-color: #002c56;" class="row">
					<div class="col-md-1 mt-md-0 mt-3"></div>
					<div class="col-md-3 mt-md-0 mt-3 footer-products">
						<h5><b>Terms of Use</b></h5>
						<hr class="footer-line" style="width: 50px;"></hr>
						<a href="">Terms of Service</a><br>
						<a href="">Privacy Policy</a><br>
					</div>
					<div class="col-md-2 mt-md-0 mt-3 footer-products">
						<h5><b>About the Game</b></h5>
						<hr class="footer-line" style="width: 50px;"></hr>
						<a href="">Game Rules</a><br>
						<a href="">Frequently Asked Questions</a><br>
						<a href="">Meet the Creator</a><br>
					</div>
					<div class="col-md-1 mt-md-0 mt-3"></div>
					<div class="col-md-2 mt-md-0 mt-3 footer-products">
						<h5><b>Contact Us</b></h5>
						<hr class="footer-line" style="width: 50px;"></hr>
						<a href="">Contact Information</a><br>
						<a href="">Report a bug</a><br>
						<a href="">Report a Player</a><br>
						<br /><br />
					</div>
					<div class="col-md-2 mt-md-0 mt-3 footer-info">
						<h5><b>The Site</b></h5>
						<hr class="footer-line" style="width: 50px;"></hr>
						<p>&copy; <?php echo date("Y"); ?> Tanktot Games</p>
						<p>Created by, Paughton</p>
					</div>
					<div class="col-md-1 mt-md-0 mt-3"></div>
				</div>
			</div>
			<div class="footer-copyright text-center py-3">Copyright &copy 2018 - <?php echo date("Y"); ?> <a href="">Tanktot Games</a>. All Rights Reserved</div>
		</footer>
	</BODY>
</HTML>