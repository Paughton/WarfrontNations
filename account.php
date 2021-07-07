<?php

	$page = "Account";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		
		<div class="col-2">
			<!-- Left sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
				
				<p>Some stuff regarding your account will appear here. Some day . . . Some day . . .</p>
				
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