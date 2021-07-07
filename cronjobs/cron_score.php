<?php

	include("../system/config.php");
	
	ob_start();
	
?>

	<script>document.title = "Cronjob Score"</script>

	<div class="row">
		<div class="col-1"></div>

		<div class="col-10">
			<?php 
				if (!empty($_GET['password'])) {
					$password = protect($_GET['password']);
					if ($password == "o1N4e3D5o4E7s6sN7oT43sI2m55p3Ly") {
						echo "<b>Beginning the cronjob</b><br><hr><br>";
						
						$users_get = mysqli_query($mysqli, "SELECT * FROM user") or die(mysqli_error($mysqli));
						while($users = mysqli_fetch_assoc($users_get)) {
							echo "<b>Acessing user, " . $users['name'] . " [" . $users['id'] . "] . . .</b><br>";
							$user_military_get = mysqli_query($mysqli, "SELECT * FROM military WHERE id='".$users['id']."'") or die(mysqli_error($mysqli));
							$user_military = mysqli_fetch_assoc($user_military_get);
							echo "- Acessed the user's military<br>";
							$city_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM city WHERE uid='".$users['id']."'"));
							echo "- Found the total amount of cities [" . number_format($city_count) . "]<br>";
							echo "- Calculating the user's score . . .<br>";
							
							$user_score = 0;
							$user_score += $city_count * 2000;
							$user_score += $user_military['soldier'] * 0.005;
							$user_score += $user_military['tank'] * 20;
							$user_score += $user_military['artillery'] * 10;
							$user_score += $user_military['airplane'] * 80;
							$user_score += $user_military['battleship'] * 160;
							
							echo "- Finished calculating the user's score [" . number_format($user_score) . "]<br>";
							
							$update = mysqli_query($mysqli, "UPDATE user SET score='".$user_score."' WHERE id='".$users['id']."'") or die(mysqli_error($mysqli));
							
							echo "- Updated the user's score from [".number_format($users['score'])."] to [".number_format($user_score)."]";
							
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
	$file_name = './logs_score/' . date("G.i.s___m-d-Y", time()) . '.html';
	file_put_contents($file_name, ob_get_contents());
?>