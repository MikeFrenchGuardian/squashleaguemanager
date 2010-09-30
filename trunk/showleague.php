<?php require_once 'includes/head.php'; 

 // Grab the season ID from the URL if available
$seasonID = ($_GET["season"]);

// If its not set use the current season
if (!isset($seasonID)) {
	$seasonID = currentSeason();
}

// Create a new var to play with later on
$currSeason =  currentSeason();

// This gives the page heading the right date
$startDate = getSeasonStart($seasonID);
$niceDate = prettyDate($startDate);

// The page heading
echo '<span class="text-header">League Beginning ' . $niceDate . "</span><br><br>";



// Previous and Next buttons on the league page.
$previousSeason = $seasonID - 1;
if ($seasonID > 1) {
    echo '<a class="text-normal" href="showleague.php?season=' . $previousSeason . '">Previous Season</a> ';
}
if (($seasonID > 1) && ($seasonID < $currSeason)) {
  echo ' - ';
  }
if ($seasonID < $currSeason) {
  $nextSeason = $seasonID + 1;
  echo '<a class="text-normal" href="showleague.php?season=' . $nextSeason . '">Next Season</a>';
}
echo '<br><br>';

// Render the leagues in a nested loop
for ($i = 1; $i <= 4; ++$i) {

	echo '<span class="text-semibold">&nbsp; Division ' . $i . '</span><br>';
	echo "<table class=\"stats\">";
	echo "<tr>";
	echo "   <td class=\"hed\">Name</td>";
	echo "   <td class=\"hed\">Games Played</td>";
	echo "   <td class=\"hed\">Wins</td>";
	echo "   <td class=\"hed\">Losses</td>";
	echo "   <td class=\"hed\">Points</td>";
	echo "</tr>";
	
	$leagueArray = "leagueArray" .$i;
	$divSize = getDivSize($i,$seasonID);
	$leagueArray = array();

		for ($j = 0 ; $j < $divSize ; ++$j) {
			$playerID = getDivPlayers($i,$seasonID,$j);
			$playerName = getPlayerName($playerID);
			$gamesPlayed = getLeagueGamesPlayed($playerID,$seasonID);
			$wins = getLeagueWins($playerID,$seasonID);
			$loses = getLeagueLoses($playerID,$seasonID);
			$points = getLeaguePoints($playerID,$seasonID);
			$arrayNo = "player" .$j;
	
				$arrayNo = array
				(
						"playerID" => $playerID,
						"player" => $playerName,
						"gamesPlayed" => $gamesPlayed,
						"wins" => $wins,
						"loses" => $loses,
						"points" => $points,
				);	   

			$leagueArray[] = $arrayNo;

	}
usort($leagueArray, "sortDescending");
 
foreach ($leagueArray as $position) {
	echo	'<tr>';
	echo	'<td><a href="playerdetail.php?id=' . $position['playerID'] . '" class="text-normal">' . $position['player'] . '</td>';
	echo	'<td class="text-normal">' . $position['gamesPlayed'] . '</td>';
	echo	'<td class="text-normal">' . $position['wins'] . '</td>';
	echo	'<td class="text-normal">' . $position['loses'] . '</td>';
	echo	'<td class="text-normal">' . $position['points'] . '</td>';
	echo	'</tr>';
  }
	echo "</table>  <br><br>";


}


?>
<?php require_once 'includes/footer.php'; ?>
