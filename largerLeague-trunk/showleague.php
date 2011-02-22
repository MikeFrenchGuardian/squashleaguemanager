<?php require_once 'includes/head.php'; 

// Paging for extra leagues
if (isset($_GET["page"])) {
	$page = ($_GET["page"]);
} else {
	$page = 1;		
}

$rowsPerPage = 5;

// counting the offset
$offset = ($rowsPerPage - 1);

$thisPageStart = ($page * $rowsPerPage) - $offset;
$thisPageEnd = $rowsPerPage * $page;



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
    echo '<a class="text-normal" href="showleague.php?season=' . $previousSeason . '">Previous Session</a> ';
}
if (($seasonID > 1) && ($seasonID < $currSeason)) {
  echo ' - ';
  }
if ($seasonID < $currSeason) {
  $nextSeason = $seasonID + 1;
  echo '<a class="text-normal" href="showleague.php?season=' . $nextSeason . '">Next Session</a>';
}
echo '<br><br>';

// Render the leagues in a nested loop
$divCount = numLeagues($seasonID);

$leftOvers = $divCount % $page;
if ($leftOvers <= 5) {
	$thisPageStart = ($page * 5) + 1;
	$thisPageEnd = $thisPageStart + $leftOvers;
}
	

if ($divCount < 5) {
	$thisPageStart = 1;
	$thisPageEnd = $divCount;
}

for ($i = $thisPageStart; $i <= $thisPageEnd; ++$i) {

	echo '<span class="text-semibold">&nbsp; Division ' . $i . '</span><br>';
	echo "<table class=\"league\">";
	echo "<tr>";
	echo "   <td class=\"hed\">Name</td>";
	echo "   <td class=\"hed\">Games Played</td>";
	echo "   <td class=\"hed\">Wins</td>";
	echo "   <td class=\"hed\">Losses</td>";
	echo "   <td class=\"hed\">Draws</td>";
	echo "   <td class=\"hed\">Points</td>";
	echo "</tr>";
	
	$leagueArray = "leagueArray" .$i;
	$divSize = getDivSize($i,$seasonID);
	$leagueArray = array();

		for ($j = 0 ; $j < $divSize ; ++$j) {
			$relegation = $divSize - 2;
			$playerID = getDivPlayers($i,$seasonID,$j);
			$playerName = getPlayerName($playerID);
			$gamesPlayed = getLeagueGamesPlayed($playerID,$seasonID);
			$wins = getLeagueWins($playerID,$seasonID);
			$loses = getLeagueLoses($playerID,$seasonID);
			$draws = getLeagueDraws($playerID,$seasonID);
			$points = getLeaguePoints($playerID,$seasonID);
			$tjRank = getTomJohnRank($playerID,$seasonID);
			$arrayNo = "player" .$j;
	
				$arrayNo = array
				(
						"playerID" => $playerID,
						"player" => $playerName,
						"gamesPlayed" => $gamesPlayed,
						"wins" => $wins,
						"loses" => $loses,
						"draws" => $draws,
						"points" => $points,
						"tjRank" => $tjRank,
				);	   

			$leagueArray[] = $arrayNo;

	}
	
usort($leagueArray, "sortWithTomJohn");
//usort($leagueArray, "sortDescending");
 
 $k = 0;
foreach ($leagueArray as $position) {
	++$k;
	echo '<tr>';
	
        if ($k > $relegation) {
        echo    '<td class="relegation">';
        } else if ($k < "3") {
        echo '<td class="promotion">';
        } else {
        echo    '<td class="normal">';
        }


	echo	'<a href="playerdetail.php?id=' . $position['playerID'] . '" class="text-normal">' . $position['player'] . '</td>';

        if ($k > $relegation) {
        echo    '<td class="relegation">';
        } else if ($k < "3") {
        echo '<td class="promotion">';
        } else {
        echo    '<td class="normal">';
        }


	echo	$position['gamesPlayed'] . '</td>';

        if ($k > $relegation) {
        echo    '<td class="relegation">';
        } else if ($k < "3") {
        echo '<td class="promotion">';
        } else {
        echo    '<td class="normal">';
        }


	echo	$position['wins'] . '</td>';

        if ($k > $relegation) {
        echo    '<td class="relegation">';
        } else if ($k < "3") {
        echo '<td class="promotion">';
        } else {
        echo    '<td class="normal">';
        }

	echo	$position['loses'] . '</td>';

        if ($k > $relegation) {
        echo    '<td class="relegation">';
        } else if ($k < "3") {
        echo '<td class="promotion">';
        } else {
        echo    '<td class="normal">';
        }


	echo	$position['draws'] . '</td>';

        if ($k > $relegation) {
        echo    '<td class="relegation">';
        } else if ($k < "3") {
        echo '<td class="promotion">';
        } else {
        echo    '<td class="normal">';
        }

	echo	$position['points'] . '</td>';
	echo	'</tr>';
  }
	echo "</table>  <br><br>";


}


?>

<?php require_once 'includes/footer.php'; ?>
