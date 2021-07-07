<center>
	<h1 style="font-size: 72px;">~*~ <?php echo $game_name ?> ~*~</h1>
	<h5>A game of war and peace</h5>
	<h5><a id="home_url" href="index">Home</a>&emsp;&emsp;
	<?php if (!empty($_SESSION['uid'])) { ?>
		<a id="nation_url" href="nation?id=<?php echo $user['id']; ?>">Your Nation</a>&emsp;&emsp;
		<a id="trade_url" href="trade">Trade</a>&emsp;&emsp;
		<a id="alliance_url" href="alliances">Alliances</a>&emsp;&emsp;
		<a id="world_url" href="world">World</a>&emsp;&emsp;
		<a href="logout">Logout</a>&emsp;&emsp;
	<?php } else { ?>
		<a id="alliance_url" href="alliances">Alliances</a>&emsp;&emsp;
		<a id="world_url" href="world">World</a>&emsp;&emsp;
		<a id="register_url" href="register">Register</a>&emsp;&emsp;
		<a id="login_url" href="login?return=<?php echo str_replace("/", "", $_SERVER['REQUEST_URI']); ?>">Login</a></h5>&emsp;&emsp;
	<?php } ?>
</center>