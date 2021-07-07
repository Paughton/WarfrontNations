<?php

	include("../system/config.php");
	
	ob_start();
	
?>

	<script>document.title = "Cronjob Daily"</script>

	<div class="row">
		<div class="col-1"></div>

		<div class="col-10">
			<?php 
				if (!empty($_GET['password'])) {
					$password = protect($_GET['password']);
					if ($password == "t2He5Ey4e3O46fS83au68Ro53N") {
						echo "<b>Beginning the cronjob</b><br><hr><br>";
						
						$users_get = mysqli_query($mysqli, "SELECT * FROM user") or die(mysqli_error($mysqli));
						while ($users = mysqli_fetch_assoc($users_get)) {
							echo "<b>Accessing the user, " . $users['name'] . " [" . $users['id'] . "]</b><br>";
							if ($users['login'] == 0) {
								echo "- User did not login today<br>";
								$users['loginstreak'] = 0;
								$users['login'] = 0;
								echo "- Reset user's login streak<br>";
							} else {
								echo "- User did login today<br>";
								$users['login'] = 0;
							}
							
							$update = mysqli_query($mysqli, "UPDATE user SET login='".$users['login']."', loginstreak='".$users['loginstreak']."' WHERE id='".$users['id']."'") or die(mysqli_error($mysqli));
							
							echo "- Updated the user's login credentials<br>";
							
							echo "<br><hr><br>";
							
						}
						
						echo "<b>Ending the cronjob</b>";
					} else {
						echo "<b>The password you have entered is incorrect</b>";
					}
				} else {
					echo "<b>You have vistied this page incorrectly.</b>";
				}
			?>
		</div>
		
		<div class="col-1"></div>
	</div>

<?php
	$file_name = './logs_daily/' . date("G.i.s___m-d-Y", time()) . '.html';
	file_put_contents($file_name, ob_get_contents());
?>