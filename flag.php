<?php

	$page = "Change Flag";
	include("./system/header.php");
	
?>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<!-- Left Sidebar -->
		</div>
		
		<div class="col-6">
		
			<?php if (!empty($_SESSION['uid'])) { ?>
			<?php
				if (!empty($_POST['changeflag'])) {
					$flag = protect($_POST['flag']);
					$update_user = mysqli_query($mysqli, "UPDATE user SET flag='$flag' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($mysqli));
					output("Your flag has been successfully changed.");
				}
			?>
		
			<script>
				function select_img() {
					var flag = document.getElementById("flag").value;
					document.getElementById("flag_display").src = "./assets/art/flags/" + flag + ".png";
				}
			</script>
			
			<center>
				<h2>Change Flag</h2>
				<img src="./assets/art/flags/britonian.png" id="flag_display">
			</center>
			<hr>
			<form action="flag" method="post" onchange="select_img()">
				<select class="form-control" name="flag" id="flag"><br />
					<option value="britonian">Britonian</option>
					<option value="corrupted">Corrupted</option>
					<option value="danlgen">Danglen</option>
					<option value="eswor">Eswor</option>
					<option value="neworder">New Order</option>
					<option value="oozing">Oozing</option>
					<option value="rebellion">Rebellion</option>
					<option value="risingsun">Rising Sun</option>
					<option value="alda">Alda</option>
					<option value="laerun">Laerun</option>
					<option value="mapel">Mapel</option>
					<option value="marciao">Marciao</option>
					<option value="nacirema">Nacierema</option>
					<option value="nadshaw">Nadshaw</option>
					<option value="namor">Namor</option>
					<option value="noslarc">Noslarc</option>
					<option value="oblivion">Oblivion</option>
					<option value="ogitech">Ogitech</option>
				</select><br />
				<input type="submit" name="changeflag" value="Change Flag"/>
			</form><br /><br />
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