<?php

	$page = "Login";
	include("./system/header.php");
	
?>

	<script>document.getElementById("login_url").style = "color: #f73100 !important;"</script>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
			<!-- Middle Content -->
			<?php if (empty($_SESSION['uid'])) { ?>
			<h2>Login</h2>
			<?php
				if (!empty($_POST['login'])) {
					if (!empty($_POST['email']) && !empty($_POST['password'])) {
						$email = protect($_POST['email']);
						$password = protect($_POST['password']);
						$user_check = mysqli_query($mysqli, "SELECT * FROM user WHERE email='$email' AND password='".md5(md5($password))."'") or die(mysqli_error($mysqli));
						if (mysqli_num_rows($user_check) > 0) {
							$user = mysqli_fetch_assoc($user_check);
							$_SESSION['uid'] = $user['id'];
							
							if (!$user['login']) {
								$user['login'] = 1;
								$user['loginstreak'] += 1;
								$reward_money = 500000000 + $user['loginstreak'] * 50000000;
								if ($reward_money > 1000000000) { $reward_money = 1000000000; }
								$user['money'] += $reward_money;
								send_notification($user['id'], "You have logged in today and received: <b>$" . number_format($reward_money) . "</b>.");
							}
							
							$update = mysqli_query($mysqli, "UPDATE user SET login='".$user['login']."', loginstreak='".$user['loginstreak']."', money='".$user['money']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
							
							if (empty($_GET['return']) || $_GET['return'] == "index" || $_GET['return'] == "login") {
								?>
									<script>location.href = "redirect?url=nation?id=<?php echo $user['id']; ?>";</script>
								<?php
							} else {
								$url = protect($_GET['return']);
								?>
									<script>location.href = "redirect?url=<?php echo $url; ?>";</script>
								<?php
							}
						} else { 
							output("The password or email you have entered are inccorrect.");
						}
					} else {
						output("Please supply all of the fields.");
						echo "<br>";
					}
				}
			?>
			<form action="login<?php if (!empty($_GET['return'])) { echo "?return=" . protect($_GET['return']); } ?>" method="POST" id="login">
				<input type="text" name="email" placeholder="Email" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
				<input type="password" name="password" placeholder="Password" style="width:100%;height:50px;border-radius:2px;font-size:18px;font-family:verdana;" autocomplete="false"></input><p></p>
				<input type="submit" name="login" value="Login">
			</form><br>
			<p>Don't have an account? <a href="register">Register Today!</a></p>
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