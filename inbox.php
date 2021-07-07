<?php

	$page = "Battle";
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
					?>
					
						<h2>Current messages</h2>
						<?php
							if (!empty($_POST['deletemessage'])) {
								if (!empty($_POST['id'])) {
									$id = protect($_POST['id']);
									$message_get = mysqli_query($mysqli, "SELECT * FROM message WHERE id='$id'") or die(mysqli_error($mysqli));
									if (mysqli_num_rows($message_get) > 0) {
										$message = mysqli_fetch_assoc($message_get);
										if ($message['receiver'] == $user['id']) {
											$delete = mysqli_query($mysqli, "DELETE FROM message WHERE id='$id'") or die(mysqli_error($mysqli));
											output("That message was deleted.");
										} else {
											output("That message is not yours.");
										}
									} else {
										output("That message never existed or no longer exists.");
									}
								} else {
									output("There was a probelm deleting that message.");
								}
							}
						?>
						<table class="table table-borderless table-striped">
							<thead class="thead-dark">
								<th scope="col">Date</th>
								<th scope="col">Sender</th>
								<th scope="col">Action</th>
							</thead>
							<tbody>
								<?php
									$message_get = mysqli_query($mysqli, "SELECT * FROM message WHERE receiver='".$user['id']."' ORDER BY date DESC") or die(mysqli_error($mysqli));
									while ($message = mysqli_fetch_assoc($message_get)) {
										$sender_get = mysqli_query($mysqli, "SELECT * FROM user WHERE id='".$message['sender']."'") or die(mysqli_error($mysqli));
										$sender = mysqli_fetch_assoc($sender_get);
										?>
											<tr class="<?php if (!$message['seen']) { echo "table-info"; } ?>">
												<td><b><?php echo date("g:i A - m/d/Y", $message['date']); ?></b></td>
												<td><h5><?php echo display($sender['name']); ?></h5></td>
												<td><form action="inbox" method="POST"><input type="hidden" value="<?php echo $message['id']; ?>" name="id"><input type="submit" value="Delete" name="deletemessage"></form></td>
											</tr>
											<tr class="<?php if (!$message['seen']) { echo "table-info"; } ?>">
												<td colspan="3"><p><?php echo display($message['message']); ?></p></td>
											</tr>
										<?php
										if (!$message['seen']) {
											$update = mysqli_query($mysqli, "UPDATE message SET seen='1' WHERE id='".$message['id']."'") or die(mysqli_error($mysqli));
										}
									}
								?>
							</tbody>
						</table>
						<br><br><br><br><hr><br>
					
						<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
						<script>tinymce.init({ selector:'textarea' });</script>
						
						<h2>Send a message</h2>
						<p>In order to send a message type who you want to send it to in the "Who are you sending this too?" field. Then you type your message that 
						you want to send. Once you are finished and happy with your message click the "Send message" button to finish sending your message. You 
						can also resize the message container to any size you desire. (<b>P.S close the popup inside of the message box to type in it</b>.)</p>
						<?php
							if (!empty($_POST['sendmessage'])) {
								if (!empty($_POST['message']) && !empty($_POST['receiver'])) {
									$receiver = protect($_POST['receiver']);
									$message = protect($_POST['message']);
									$user_check_get = mysqli_query($mysqli, "SELECT * FROM user WHERE name='$receiver'") or die(mysqli_error($mysqli));
									if (mysqli_num_rows($user_check_get) > 0) {
										$user_check = mysqli_fetch_assoc($user_check_get);
										if (strlen($message) <= 10000) {
											$insert = mysqli_query($mysqli, "INSERT INTO message (sender, receiver, date, seen, message) VALUES ('".$user['id']."', '".$user_check['id']."', '".time()."', '0', '$message')") or die(mysqli_error($mysqli));
											output("Your message was sent to " . $user_check['name'] . ".");
										} else {
											output("Your message exceeds 10,000 characters.");
										}
									} else {
										output("That nation does not exist.");
									}
								} else {
									output("Please supply all of the fields.");
								}
							}
						?>
						<form action="inbox" method="POST">
							<input type="text" name="receiver" placeholder="Nation name" autocomplete="off"><p></p>
							<textarea name="message"></textarea><p></p>
							<input type="submit" name="sendmessage" value="Send message">
						</form>

					<?php
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