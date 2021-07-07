<?php

	$page = "Edit nation";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
				<h2>Edit your nation</h2><p></p>
				<?php
					if (!empty($_POST['edit-quote'])) {
						if (!empty($_POST['quote'])) {
							$quote = protect($_POST['quote']);
							if (strlen($quote) > 100) {
								output("Your quote must be 100 characters or less.");
							} else {
								$update_quote = mysqli_query($mysqli, "UPDATE user SET quote='$quote' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
								output("Your quote has been changed");
							}
						} else {
							output("You must fill out all the fields.");
						}
					} else if (!empty($_POST['edit-leadername'])) {
						if (!empty($_POST['leadername'])) {
							$leadername = protect($_POST['leadername']);
							if (strlen($leadername) > 30) {
								output("Your leader name must be 30 characters or less.");
							} else {
								$update_quote = mysqli_query($mysqli, "UPDATE user SET leader='$leadername' WHERE id='".$user['id']."'") or die(mysqli_error($mysqli));
								output("Your leader name has been changed");
							}
						} else {
							output("You must fill out all the fields.");
						}
					}
				?>
				<form method="POST" action="edit">
					<input type="text" name="leadername" autocomplete="off" placeholder="Change leader name (max 30 characters)"><p></p>
					<input type="submit" name="edit-leadername" value="Make changes">
				</form>
				<br><br>
				<form method="POST" action="edit">
					<input type="text" name="quote" autocomplete="off" placeholder="Change quote (max 100 characters)"><p></p>
					<input type="submit" name="edit-quote" value="Make changes">
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