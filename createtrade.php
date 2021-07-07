<?php

	$page = "Trade";
	include("./system/header.php");
	
?>
	
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
			
					<h2>Make trade offer</h2>
					
					<?php
					
						if (!empty($_POST['createtrade'])) {
							if (!empty($_POST['resource']) && !empty($_POST['amount']) && !empty($_POST['price'])) {
								$resource_form = protect($_POST['resource']);
								$amount = protect($_POST['amount']);
								$price = protect($_POST['price']);
								if ($resource[$resource_form] >= $amount) {
									$insert_trade = mysqli_query($mysqli, "INSERT INTO trade (uid, date, resource, amount, price) VALUES ('".$user['id']."', '".time()."', '$resource_form', '$amount', '$price')") or die(mysqli_error($mysqli));
									output("Your trade offer was added to the trade page.");
								} else {
									output("You don't have enough " . $resource_form . ".");
								}
							} else {
								output("Please supply all the fields.");
							}
						}
					
					?>
					
					<form action="createtrade" method="POST">
						<select class="form-control" name="resource"><br />
							<option value="aluminum">Aluminum</option>
							<option value="ammunition">Ammunition</option>
							<option value="bauxite">Bauxite</option>
							<option value="coal">Coal</option>
							<option value="food">Food</option>
							<option value="gasoline">Gasoline</option>
							<option value="iron">Iron</option>
							<option value="lead">Lead</option>
							<option value="oil">Oil</option>
							<option value="steel">Steel</option>
							<option value="uranium">Uranium</option>
						</select><p></p>
						<input type="text" name="amount" placeholder="Amount of Resource"><p></p>
						<input type="text" name="price" placeholder="Price"><p></p>
						<input type="submit" name="createtrade" value="Make trade offer">
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