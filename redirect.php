<?php

	$page = "Login";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
			<!-- Middle Content -->
			<?php output("You are currently being redirected.<br>Please Wait."); ?>
			<?php if (!empty($_GET['url'])) { ?>
				<script>
					var load = setTimeout(function() {
						location.href='<?php echo protect($_GET['url']); ?>';
					}, 2000);
				</script>
			<?php } else { ?>
				<script>
					var load = setTimeout(function() {
						location.href='index';
					}, 2000);
				</script>
			<?php } ?>
		</div>
		
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>