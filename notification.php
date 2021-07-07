<?php

	$page = "Cities";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
			
				<table class="table table-borderless">
					<thead>
						<?php
							$notification_get = mysqli_query($mysqli, "SELECT * FROM notification WHERE uid='".$user['id']."' ORDER BY date DESC") or die(mysqli_error($mysqli));
							while ($notification = mysqli_fetch_assoc($notification_get)) {
								?>
									<tr class="<?php if (!$notification['seen']) { echo "table-info"; } ?>">
										<td><b><?php echo date("g:i A - m/d/Y", $notification['date']); ?></b></td>
										<td><h5><?php echo display($notification['text']); ?></h5></td>
									</tr>
								<?php
								if (!$notification['seen']) {
									$update = mysqli_query($mysqli, "UPDATE notification SET seen='1' WHERE id='".$notification['id']."'") or die(mysqli_error($mysqli));
								}
							}
						?>
					</thead>
				</table>
				
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