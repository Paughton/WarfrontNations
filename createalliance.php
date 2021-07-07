<?php

	$page = "Create alliance";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		
		<div class="col-2">
			<!-- Left sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php 
				if (!empty($_SESSION['uid'])) { 
					if ($user['allianceid'] == 0) {
						?>
							
							<h5>Create an alliance</h5>
							<p>Here you can create an alliance for you and your friends (they don't have to your friends). While in an alliance you are not allowed to attack any 
							members part of your alliance. In order to create an alliance you must have a score of 1,000.</p>
							<br>
							
							<?php
								if (!empty($_POST['createalliance'])) {
									if (!empty($_POST['name'])) {
										$name = protect($_POST['name']);
										if (strlen($name) <= 30) {
											$check = mysqli_query($mysqli, "SELECT * FROM alliance WHERE name='$name'") or die(mysqli_error($mysqli));
											if (mysqli_num_rows($check) == 0) {
												$insert = mysqli_query($mysqli, "INSERT INTO alliance (date, leader, name) VALUES ('".time()."', '".$user['id']."', '$name')") or die(mysqli_error($mysqli));
												$alliance_get = mysqli_query($mysqli, "SELECT * FROM alliance WHERE name='$name'") or die(mysqli_error($mysqli));
												$alliance = mysqli_fetch_assoc($alliance_get);
												$update = mysqli_query($mysqli, "UPDATE user SET allianceid='".$alliance['id']."' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
												?><script>location.href="redirect?url=alliance?id=<?php echo $alliance['id']; ?>";</script><?php
											} else {
												output("That alliance name is already in use.");
											}
										} else {
											output("The alliance name must be 30 characters or less.");
										}
									} else {
										output("You must supply all the fields.");
									}
								}
							?>
							
							<form action="createalliance" method="POST">
								<input type="text" name="name" placeholder="Alliance name (max 30 characters)"><p></p>
								<input type="submit" name="createalliance" value="Create alliance">
							</form>
							
						<?php
					} else {
						output("You are already in an alliance.");
					}
				} else {
					output("You must be logged in to view this page.");
				}
			?>
		</div
		
		<div class="col-2">
			<!-- Right sidebar -->
		</div>
		
		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>