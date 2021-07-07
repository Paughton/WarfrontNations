<?php
	include("config.php");
?>

<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<title><?php echo $page; ?> - <?php echo $game_name; ?></title>
		
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
		
		<nav class="navbar navbar-expand-lg fixed-top home_navbar fixed-top">
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
			<hr>