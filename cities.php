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
			
				<h2>Your Cities</h2>
				<?php
					$cities_get = mysqli_query($mysqli, "SELECT * FROM city WHERE uid='".$user['id']."'") or die(mysqli_error($mysqli));
					$city_count = mysqli_num_rows($cities_get);
					if ($city_count > 0) {
						?>
							<table class="table table-borderless">
								<tbody>
									<?php
										while ($cities = mysqli_fetch_assoc($cities_get)) {
											echo "<tr>";
											echo "<td><h5><a href='city?id=" . $cities['id'] . "'>" . display($cities['name']) . "</a></h5></td>";
											echo "<td><h5>" . $cities['land'] . " available square miles</h5></td>";
											if ($user['capitol'] == $cities['id']) {
												echo "<td><h5><b>Capitol</b></h5></td>";
											}
											echo "<tr>";
										}
									?>
								</tbody>
							</table>
						<?php
					} else {
						?>
							<p>You appear to not have built any cities so far, to build a city click <a href="createcity">here</a></p>
						<?php
					}
				?>
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