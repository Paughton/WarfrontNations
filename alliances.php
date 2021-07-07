<?php

	$page = "Alliances";
	include("./system/header.php");
	
?>

	<script>document.getElementById("alliance_url").style = "color: #f73100 !important;"</script>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
			<!-- Middle Content -->
			<h5>Alliances</h5>
			<p>Here is a list of alliances that are created by nations. To access an alliance click on the name of the alliance you would like to see.</p>
			<br>
			<?php
				if (!empty($_SESSION['uid'])) { 
					if ($user['allianceid'] == 0) {
						?>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='createalliance';"><i class="far fa-plus-square"></i> Create an alliance</button>
						<?php
					} else {
						?>
							<button type="button" class="btn btn-primary" style="width: 100%;" onclick="location.href='alliance?id=<?php echo $user['allianceid']; ?>';"><i class="fas fa-user-shield"></i> Alliance</button>
						<?php
					}
				}
			?>
			<br>
			<br>
			<table class="table table-borderless">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Alliance</th>
						<th scope="col">Date established</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$alliances_get = mysqli_query($mysqli, "SELECT * FROM alliance") or die(mysqli_error($mysqli_error));
						$count = 0;
						while ($alliances = mysqli_fetch_assoc($alliances_get)) {
							$count++;
							?>
						<tr class="<?php if (!empty($_SESSION['uid'])) { if ($alliance['id'] == $alliances['id']) { echo "table-info"; } } ?>">
									<th scope="row"><?php echo number_format($count); ?>.</th>
									<td><h2><a href="alliance?id=<?php echo $alliances['id']; ?>"><?php echo display($alliances['name']); ?></a></h2></td>
									<td><h2><?php echo date("m/d/Y", $alliances['date']); ?></h2></td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
		
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>