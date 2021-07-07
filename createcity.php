<?php

	$page = "Build a city";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
			
				
				<h2>Build a city</h2>
				<?php
					$cities_get = mysqli_query($mysqli, "SELECT * FROM city WHERE uid='".$user['id']."'") or die(mysqli_error($mysqli));
					$city_count = mysqli_num_rows($cities_get);
					$city_price = round(250000000 * pow(1.50, $city_count+1));
					
					if (!empty($_POST['createcity'])) {
						if (!empty($_POST['name'])) {
							$name = protect($_POST['name']);
							
							if (strlen($name) <= 30) {
								if ($user['money'] >= $city_price) {
									$user['money'] -= $city_price;
									$create_city = mysqli_query($mysqli, "INSERT INTO city (uid, name, land) VALUES ('".$user['id']."', '$name', '0')") or die(mysqli_error($mysqli));
									$update_user = mysqli_query($mysqli, "UPDATE user SET money='".$user['money']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
									output("Your city, " . display($name) . " has been built.");
								} else {
									output("You do not have enough money to build a new city.");
								}
							} else {
								output("The city name must be 30 characters or less");
							}
						} else {
							output("You must input a city name to build a new city.");
						}
					}
				?>
				
				<p>The money you need in order to build a city is <b>$<?php echo number_format($city_price); ?></b>.</p>
				<form action="createcity" method="POST" name="createcity">
					<input type="text" name="name" placeholder="City name (max 30 characters)"><p></p>
					<input type="submit" name="createcity" value="Build city">
				</form>
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