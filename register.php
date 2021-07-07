<?php

	$page = "Register";
	include("./system/header.php");
	
?>

	<script>document.getElementById("register_url").style = "color: #f73100 !important;"</script>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
			<!-- Middle Content -->
			<?php if (empty($_SESSION['uid'])) { ?>
				<?php
					if (!empty($_POST['register'])) {
						if (!empty($_POST['email']) && !empty($_POST['confirm-email']) && !empty($_POST['password']) && !empty($_POST['confirm-password']) && !empty($_POST['country-name']) && !empty($_POST['leader-name'])) {
							$email = protect($_POST['email']);
							$confirm_email = protect($_POST['confirm-email']);
							$password = protect($_POST['password']);
							$confirm_password = protect($_POST['confirm-password']);
							$country_name = protect($_POST['country-name']);
							$leader_name = protect($_POST['leader-name']);
							if ($confirm_email != $email) {
								output("The emails you provided did not match.");
							} else if ($confirm_password != $password) {
								output("The passwords you provided did not match.");
							} else {
								if (strlen($email) > 100) {
									output("Your email cannot exceed 100 characters.");
								} else if (strlen($password) > 25) {
									output("Your password cannot exceed 25 characters.");
								} else if (strlen($country_name) > 30) {
									output("Your leader's name cannot exceed 30 characters.");
								} else if (strlen($leader_name) > 30) {
									output("Your leader's name cannot exceed 30 characters.");
								} else {
									
									$email_check = mysqli_query($mysqli, "SELECT * FROM user WHERE email='$email'") or die(mysqli_error($mysqli));
									$country_check = mysqli_query($mysqli, "SELECT * FROM user WHERE name='$country_name'") or die(mysqli_error($mysqli));
									
									if (mysqli_num_rows($email_check) > 0) {
										output("The email you have entered is already in use.");
									} else if (mysqli_num_rows($country_check) > 0) {
										output("The country name you have entered is already in use.");
									} else {
										$user_create = mysqli_query($mysqli, "INSERT INTO user (email, password, date, name, leader, money, alliance, quote, flag, land, login) VALUES ('$email', '".md5(md5($password))."', '".time()."', '$country_name', '$leader_name', '1500000000', '0', 'NaN', 'britonian', '3500', '1')") or die(mysqli_error($mysqli));
										$user_create = mysqli_query($mysqli, "INSERT INTO resource (aluminum, ammunition, bauxite, coal, food, gasoline, iron, lead, oil, steel, uranium) VALUES ('2000', '2000', '2000', '2000', '2000', '2000', '2000', '2000', '2000', '2000', '2000');") or die(mysqli_error($mysqli));
										$user_create = mysqli_query($mysqli, "INSERT INTO military (soldier, artillery, tank, airplane, battleship) VALUES ('0', '0', '0', '0', '0')") or die(mysqli_error($myssqli));
										output("You have been successfully registerd. You are being redirected to the login page.");
										?>
											<script>
												location.href='redirect?url=login';
											</script>
										<?php
									}
								}
							}
						} else {
							output("Please supply all of the fields.");
							echo "<br>";
						}
					}
				?>
				<form action="register" method="POST" id="register">
					<h2>Account Settings</h2>
					<input type="text" name="email" placeholder="Email" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
					<input type="text" name="confirm-email" placeholder="Confirm Email" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
					<input type="password" name="password" placeholder="Password" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
					<input type="password" name="confirm-password" placeholder="Confirm Password" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p><hr><hr>
					<h2>Nation Preferences</h2>
					<input type="text" name="country-name" placeholder="Country Name" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
					<input type="text" name="leader-name" placeholder="Leader Name" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
					<input type="submit" name="register" value="Register">
				</form><br>
			<?php } else {
				output("You are currenltly already signed in.");
			} ?>
		</div>
		
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>