<?php

	$page = "Tutorial";
	include("./system/header.php");

?>

	<div class="row">
		<div class="col-1"></div>
		
		<div class="col-2">
			<!-- Left sidebar -->
		</div>
		
		<div class="col-6">
			<h2>Tutorial for <?php echo $game_name; ?>.</h2>
			<p>This tutorial is not the best guide out there to have a great start. This tutorial is here for new players on how to get the feel for the game and have a decent 
			start. Since this is not the most perfect tutorial this page might be updated every so often to make it better. If you have any suggestions please contact me at 
			<a href="mailto:tanktotgames@gmail.com">tanktotgames@gmail</a>.</p>
			<p><b>Supply buildings</b> are buildings that produce resources to help supply the demands of Manufacturing buildings and Power plants. These buildings are faily cheap
			and are highly necessary. These resources can then be stored or traded with other nations.</p>
			<p><b>Manufacturing buildings</b> are buildings that use resources from Supply buildings and manufacture them into better products. These products then can be used for the 
			nation's military or can be traded with other nations for money.</p>
			<p><b>Military buildings</b> are buildings that enlist soldiers or manufacture military weapons. These buildings use resources manufactured by Supply buildings to 
			manufacture military weapons. These buildings can also hold and supply the nation's military.</p>
			<p><b>Power plants</b> are buildings that supply the entire city with power. If the city does not have enough power than the city does not produce any income whatsoever. 
			These power plants could use renewable sources or they could use resources supplied by Supply buildings.</p>
			<br><br>
			<h5>Steps for starting out.</h5>
			<ol>
				<li>
					<p>Build a city and name it whatever you like on this <a href="createcity">page</a>. One way to get to this page is by going to <b>Your Nation</b> 
					and click the <b><i class="fas fa-screwdriver"></i> Build a City</b> button on the left sidebar.</p>
				</li>
				<li>
					<p>Access the city you just built by clicking on its name on your cities <a href="cities">page</a>. One way to get to this page is by going to <b>Your Nation</b> 
					and click the <b><i class="fas fa-city"></i> Cities</b> button on the left sidebar.</p>
				</li>
				<li>
					<p>Once you are on your city page scroll down to the bottom to where it says <b>Assign Land</b>. In the text box where it says, "Amount of land to assign" type 
					in <i>3500</i>. You then must press enter or press the <b>Assign Land</b> button. To know that you have succesfully assigned the land scroll back down and it 
					say, "3,500 sqaure miles was added to this city".</p>
				</li>
				<li>
					<p>Scroll down and click the dropdown menu <b>Supply Buildings</b>. Once the dropdown is down you then need to build some buildings. You can do this by clicking 
					<b>Build</b> next to the building you want to build. Below is a list of Supply Buildings you need to build. Once you have done this, your city will say it is 
					unpowered, but do not worry, we are going to fix this soon.</p>
					<ul>
						<li>1 iron mine</li>
						<li>1 coal mine</li>
						<li>2 bauxite mine</li>
						<li>3 oil wells</li>
						<li>1 lead mine</li>
						<li>1 farm</li>
					</ul>
				</li>
				<br>
				<li>
					<p>Next click on the dropdown menu <b>Manufacturing Buildings</b>. Below is a list of Manufacturing Buildings you need to build.</p>
					<ul>
						<li>1 steel mill</li>
						<li>1 aluminum refinery</li>
						<li>1 ammunition factory</li>
						<li>1 oil refinery</li>
					</ul>
				</li>
				<br>
				<li>
					<p>Next click on the dropdown menu <b>Military Buildings</b>. Below is a list of Military Buildings you need to build.</p>
					<ul>
						<li>6 barracks</li>
					</ul>
				</li>
				<br>
				<li>
					<p>Next click on the dropdown menu <b>Power Plants</b>. Below is a list of Power Plants you need to build.</p>
					<ul>
						<li>1 diesel-fired power plant</li>
					</ul>
				</li>
				<br>
				<li>
					<p>Access your military by going to the military <a href="military">page</a>. One way to get to this page is by going to <b>Your Nation</b> 
					and click the <b><i class="fas fa-chess-rook"></i> Military</b> button on the left sidebar. Once you are there type <i>12000</i> in the 
					"Amount" textbox right next to the soldiers. Once you have done that click <b>Enlist</b>. You should get a message saying enlisting those soldiers 
					was successful.</p>
				</li>
			</ol>
			<p>Congragulations you have completed the tutorial for <?php echo $game_name; ?>. You may do whatever you like with your extra money and land. By the end of this 
			you should have about 750 extra square miles left in your city. If you would like to get some more land you can get some more on the <b>Your Nation</b> page. Just scroll 
			down and you will find the <b>Purchase Land</b> section.</p>
			<br><br>
			<h5>Tips and tricks.</h5>
			<p>This list will be added upon so don't forget to check up on this every so often.</p>
			<ol>
				<li>
					<p>You should always have a good standing military because you will never know when you might be attacked.</p>
				</li>
			</ol>
		</div>	
		
		<div class="col-2">
			<!-- Right sidebar -->
		</div>

		<div class="col-1"></div>
	</div>

<?php

	include("./system/footer.php");

?>