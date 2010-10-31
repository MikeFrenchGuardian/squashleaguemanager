<?php require_once '../includes/adminhead.php'; ?>


<?php 
	
	$currSeason = currentSeason();
	$seasonID = currentSeason();
	
// Editing Instead
if (isset($_POST['stage3'])) { ?>

	<span class="text-header">Edit Divisions 3</span><br><br> 

<?php	
	if (isset($_POST['season'])) {
		$seasonID = sanitizeString($_POST['season']);
	} else {
		echo "No season selected, please try again";
	}


	$totalPlayers = getTotalPlayers();

	for ($i = 1; $i <= $totalPlayers; ++$i) {
		$playerID = $i;
		if ((isset($_GET[$i]))) {
			$div = $_GET[$i];
			$name = getPlayerName($playerID);
			$divisionID = getDivisionID($seasonID,$div);

			echo "<br>" . $name . " was added to division " . $div ."<br>";
			editPlayerDiv($playerID,$divisionID,$newDivisionID);
		} else {
			echo "<br>This " . $name . " isn't in a league <br>";
		}
	}



// Completed Form - Database Updated	
} else if (isset($_GET['stage2'])) { ?>
	
	<span class="text-header">Edit Divisions 3</span><br><br> 
	
<?php	
	if (isset($_GET['season'])) {
		$seasonID = sanitizeString($_GET['season']);
	} else {
		echo "No season selected, please try again";
	}


	$totalPlayers = getTotalPlayers();

	for ($i = 1; $i <= $totalPlayers; ++$i) {
		$playerID = $i;
		if ((isset($_GET[$i]))) {
			$div = $_GET[$i];
			$tjrank = $_GET[$i . '_tjrank'];
			$name = getPlayerName($playerID);
			$divisionID = getDivisionID($seasonID,$div);

			if ($div == "remove") {
				echo "<br>" . $name . " was removed from the league<br>";	
			} else {
			echo "<br>" . $name . " was added to division " . $div ."<br>";
			addPlayerToDiv($playerID,$divisionID,$tjrank);
		} 
	}
	}


} else if (isset($_GET['stage1'])) { ?>

<span class="text-header">Edit Division - Part 2</span><br><br>

<?php
		if (isset($_POST['season'])) {
	$startDate = getSeasonStart($seasonID);

	}


	$seasonID = $_GET["season"];

	if (isset($seasonID)) {
		$seasonID = $seasonID;
	}	else {
		$seasonID = currentSeason();
	}
	
		$prevSeason = $seasonID - 1;

	$leagueCount = numLeagues($seasonID);		
	$prevleagueCount = numLeagues($prevSeason);

	?>
	<form method="get" action="setupDivision.php">
	<?php
	for ($i = 1; $i <= $prevleagueCount; ++$i) {	

		echo "Division $i<br><br>";
		echo "<table class=\"league\">";
		echo "<tr>";
		echo "   <td class=\"hed\">Name</td>";
		echo "   <td class=\"hed\">Points</td>";
		echo "   <td class=\"hed\">Current League</td>";
		echo "	 <td class=\"hed\">TJ Rank</td>";
		echo "</tr>";
	
		$leagueArray = "leagueArray" .$i;
		$leagueArray = array();
		$divSize = getDivSize($i,$prevSeason);
		$totalPlayers = getTotalPlayers();
			
			for ($j = 0 ; $j < $divSize ; ++$j) {
				$playerID = getDivPlayers($i,$prevSeason,$j);
				$playerName = getPlayerName($playerID);
				$playerLeague = getPlayerLeague($playerID,$seasonID);
				$points = getLeaguePoints($playerID,$prevSeason);
				$tjRank = getTomJohnRank($playerID,$seasonID);
				$arrayNo = "player" .$j;

	
					$arrayNo = array
					(
							"playerID" => $playerID,
							"player" => $playerName,
							"league" => $playerLeague,
							"points" => $points,
							"tjRank" => $tjRank,
					);	   

				$leagueArray[] = $arrayNo;

		}

	usort($leagueArray, "sortWithTomJohn");



	// setup the leagues
	foreach ($leagueArray as $position) {
		echo	'<tr>';
		// Render PlayerName
		echo	'<td><a href="playerdetail.php?id=' . $position['playerID'] . '" class="text-normal">' . $position['player'] . '</td>';
		// Render Player Points
		echo	'<td class="text-normal">' . $position['points'] . '</td>';
		// Render Division dropdown
		echo	"<td class=\"text-normal\"><select name=\"" . $position['playerID'] . "\">";
			// Run through number of leagues in the given season for each dropdown
		for ($j = 1; $j <= $leagueCount ; ++$j ) {
			if ($j==$i) {
				// Render the option name as the playerID
				echo "<option name=\"" . $position['playerID'] ."\" value=\"" . $j . "\"selected>" . $j . "</option>";
			} else {
				echo "<option name=\"" . $position['playerID'] ."\" value=\"" . $j . "\">" . $j . "</option>";
			}	
		
		}
				echo "<option name=\"" . $position['playerID'] ."\" value=\"remove\">Remove</option>";
   	 echo "</select></td>";
   	

		 echo "<td class=\"text-normal\"><select name=\"" . $position['tjrank'] . "\">";   	
	   	 for ($k = 1; $k <= $totalPlayers; ++$k) {

		 echo "<option name=\"" . $position['tjrank'] . "\" value=\"" . $k . "\">" . $k . "</option>";
	
   	 }
   	 	 echo "</td>";			 
		echo	'</tr>';
 	 }
		echo "</table>  <br><br>";




	}
	echo '<input type="hidden" name="stage2" value="yes">';
	echo "<input type=\"submit\">";
	echo "</form>";



// Choose the season...we need to do this incase we have extra or fewer leagues.

} else { ?>
	<span class="text-header">Edit Divisions</span><br><br>
	
<?php
	// Setup the season drop down, will want to reverse the order eventually
	$seasonQuery = "select id,startdate from season ORDER BY id DESC";
	$seasonResult = mysql_query($seasonQuery);
	$seasonRows = mysql_num_rows($seasonResult);
?>
	<form method="get" action="setupDivision.php">

	Choose season to setup: 
	<!-- choose season in the dropdown -->
	<select name="season" size="1">
	<option value=<?php echo $currSeason ?>><?php echo $name ?></option>
	<?php 
	for ($j = 0; $j < $seasonRows ; ++$j) {
		$startDate = mysql_result($seasonResult,$j,'startdate');
		$convertedDate = prettyDate($startDate);
	
	echo '<option value="' . mysql_result($seasonResult,$j,'id') . '">' . $convertedDate . '</option>';
	}
	?> 
	</select>
	<?php
	echo '<input type="hidden" name="stage1" value="yes">';
	echo "<input type=\"submit\">";
	echo "</form>";


}	
 require_once '../includes/adminfooter.php'; ?>
