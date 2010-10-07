<?php require_once '../includes/adminhead.php'; ?>

<span class="text-header">Edit Divisions</span><br><br>
<?php 
	
// Process the new leagues

if (isset($_POST['season'])) {

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
			addPlayerToDiv($playerID,$divisionID);
		} else {
			echo "<br>This " . $name . " isn't in a league <br>";
		}
	}

} else {








	$query = "select id,startdate from season";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$currSeason = currentSeason();
	$seasonID = currentSeason();


	// Setup the season drop down, will want to reverse the order eventually
	$seasonQuery = "select id,startdate from season ORDER BY id DESC";
	$seasonResult = mysql_query($seasonQuery);
	$seasonRows = mysql_num_rows($seasonResult);


	// Insert leagues into DB.


	// Loop for each league to add them to the DB
	//for ($h = 1; $h <= $leagueNum; ++$h) {
	//	createNewLeagues($seasonID,$h);
	//}
	if (isset($_POST['season'])) {
	$startDate = getSeasonStart($seasonID);


	echo $leagueNum . " leagues were added to season beginning " . $startDate;
	echo "<br>";
	}


	$seasonID = $_GET["season"];
	$seasonID = ;
	if (isset($seasonID)) {
		$seasonID = $seasonID;
	}	else {
		$seasonID = currentSeason();
	}

	$leagueCount = numLeagues($seasonID);

	?>
	<form method="get" action="setupDivision.php">

	Choose season to setup: 
	<!-- choose season in the dropdown -->
	<select name="season" size="1">
	<option value=<?php echo $currSeason ?>><?php echo $name ?></option>
	<?php 
	for ($j = 0; $j < $rows ; ++$j) {
		$startDate = mysql_result($result,$j,'startdate');
		$convertedDate = prettyDate($startDate);
	
	echo '<option value="' . mysql_result($result,$j,'id') . '">' . $convertedDate . '</option>';
	}
	?> 
	</select>
	<br><br>



	<?php
	for ($i = 1; $i <= 4; ++$i) {	

		echo "Division $i<br><br>";
		echo "<table class=\"stats\">";
		echo "<tr>";
		echo "   <td class=\"hed\">Name</td>";
		echo "   <td class=\"hed\">Points</td>";
		echo "   <td class=\"hed\">Current League</td>";
		echo "</tr>";
	
		$leagueArray = "leagueArray" .$i;
		$divSize = getDivSize($i,$seasonID);
		$leagueArray = array();

			for ($j = 0 ; $j < $divSize ; ++$j) {
				$playerID = getDivPlayers($i,$seasonID,$j);
				$playerName = getPlayerName($playerID);
				$playerLeague = getPlayerLeague($playerID,$seasonID);
				$points = getLeaguePoints($playerID,$seasonID);
				$arrayNo = "player" .$j;

	
					$arrayNo = array
					(
							"playerID" => $playerID,
							"player" => $playerName,
							"league" => $playerLeague,
							"points" => $points,
					);	   

				$leagueArray[] = $arrayNo;

		}

	usort($leagueArray, "sortDescending");

	?>

	<?php 
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
   	 echo "</select></td>";
		echo	'</tr>';
 	 }
		echo "</table>  <br><br>";





	echo "<input type=\"submit\">";
	echo "</form>";
	}
}
 require_once '../includes/adminfooter.php'; ?>
