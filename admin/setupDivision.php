<?php require_once '../includes/adminhead.php'; ?>

<span class="text-header">Add Players to the divisions</span><br>
<?php 
if (isset($_POST['season'])) $seasonID = sanitizeString($_POST['season']);
if (isset($_POST['leagueNum'])) $leagueNum = sanitizeString($_POST['leagueNum']);

// If the page receives a create leagues request then we create them, otherwise we just add players to the league.

if (isset($seasonID)) {
	//	$seasonID = $seasonID;
	// Insert leagues into DB.
	// Loop for each league to add them to the DB
	for ($h = 1; $h <= $leagueNum; ++$h) {
		createNewLeagues($seasonID,$h);
	}
} else {
	$seasonID = currentSeason();
}


// Insert leagues into DB.


// Loop for each league to add them to the DB
//for ($h = 1; $h <= $leagueNum; ++$h) {
//	createNewLeagues($seasonID,$h);
//}
if (isset($seasonID)) {
$startDate = getSeasonStart($seasonID);


echo $leagueNum . " leagues were added to season beginning " . $startDate;
echo "<br>";
}


$seasonID = $_GET["season"];
$seasonID = 3;
if (isset($seasonID)) {
	$seasonID = $seasonID;
}	else {
	$seasonID = currentSeason();
}

$leagueCount = numLeagues($seasonID);


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
<form method="get" action="divsetup2.php">

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
}




echo "<input type=\"submit\">";
echo "</form>";


 require_once '../includes/adminfooter.php'; ?>