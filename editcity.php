<?php

	$page = "Edit city";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
			<?php
				if (!empty($_GET['id'])) {
					$id = protect($_GET['id']);
					if (!empty($_SESSION['uid'])) {
						$city_get = mysqli_query($mysqli, "SELECT * FROM city WHERE id='$id'") or die(mysqli_error($mysqli));
						$city = mysqli_fetch_assoc($city_get);
						if ($city['uid'] == $user['id']) {
							?>
								<h2><a href="city?id=<?php echo $city['id']; ?>"><?php echo display($city['name']); ?></a></h2>
								<br>
								<?php
									if (!empty($_POST['makecapitol'])) {
										$update_user = mysqli_query($mysqli, "UPDATE user SET capitol='$id' WHERE id='".$user['id']."'") or die(mysqli_query($mysqli));
										output($city['name'] . " has been made your capitol city.");
									}
								?>
								<form method="POST" action="editcity?id=<?php echo $city['id']; ?>">
									<input type="submit" name="makecapitol" value="Make this city your capitol city">
								</form>
								<br><br>
								<?php
									if (!empty($_POST['changename'])) {
										if (!empty($_POST['name'])) {
											$name = protect($_POST['name']);
											if (strlen($name) <= 30) {
												$update_city = mysqli_query($mysqli, "UPDATE city SET name='$name' WHERE id='$id'") or die(mysqli_error($mysqli));
												output("Your city, " . $city['name'] . " has had its name changed to " . display($name) . ".");
											} else {
												output("The name must be at most 30 characters.");
											}
										} else {
											output("Please supply all the fields.");
										}
									}
								?>
								<form method="POST" action="editcity?id=<?php echo $city['id']; ?>">
									<input type="text" name="name" placeholder="New city name (max 30 characters)"><p></p>
									<input type="submit" name="changename" value="Change city name">
								</form>
							<?php
						}
					}
				} else {
					output("You have visited this page incorrectly.");
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