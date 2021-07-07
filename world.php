<?php

	$page = "World";
	include("./system/header.php");
	
?>

	<script>document.getElementById("world_url").style = "color: #f73100 !important;"</script>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
			<!-- Middle Content -->
			<h5>Leaderboard</h5>
			<p>Here is a list of users ranked from their score. All nations can be found on this page with the nations with the highest score at the top of the list 
			while the nations with the lowest score at the bottom of the list.</p>
			<br>
			<table class="table table-borderless">
				<thead class="thead-dark">
					<th scope="col">#</th>
					<th scope="col">Flag</th>
					<th scope="col">Nation</th>
					<th scope="col">Quote</th>
					<th scope="col">Score</th>
				</thead>
				<tbody>
					<?php
						$users_get = mysqli_query($mysqli, "SELECT * FROM user ORDER BY score DESC") or die(mysqli_error($mysqli));
						$count = 0;
						while ($users = mysqli_fetch_assoc($users_get)) {
							$count++;
							
							?>
										<tr>
											<th scope="row"><?php echo $count; ?>.</th>
											<td><img src="./assets/art/flags/<?php echo $users['flag']; ?>.png" height="32" width="48"></td>
											<td><h2><a href="nation?id=<?php echo $users['id']; ?>"><?php echo display($users['name']); ?></a></h2></td>
											<?php if ($users['quote'] != "NaN") { ?>
												<td><h5><i class="fas fa-quote-left"></i> <i><?php echo display($users['quote']); ?></i> <i class="fas fa-quote-right"></i></h5></td>
											<?php } else { echo "<td></td>"; } ?>
											<td><h2><?php echo number_format($users['score']); ?></h2></td>
										</tr>
							<?php
						}
					?>
				</tbody >
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