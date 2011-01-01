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
    echo '<a class="text-normal" href="results.php?season=' . $previousSeason . '">Previous Season</a> ';
}
if (($seasonID > 1) && ($seasonID < $currSeason)) {
  echo ' - ';
  }
if ($seasonID < $currSeason) {
  $nextSeason = $seasonID + 1;
  echo '<a class="text-normal" href="results.php?season=' . $nextSeason . '">Next Season</a>';
}
echo '<br><br>';

// Render the leagues in a nested loop

	echo '<span class="text-semibold">&nbsp; Results for season ' . $i . '</span><br>';
	echo "<table class=\"league\">";
	echo "<tr>";
	echo "   <td class=\"hed\">Player 1</td>";
	echo "   <td class=\"hed\">Score</td>";
	echo "   <td class=\"hed\">Score</td>";
	echo "   <td class=\"hed\">Player 2</td>";
	echo "</tr>";
	
$query = "select * from results where seasonID = $seasonID";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

	for ($j = 0 ; $j < $rows ; ++$j) {
		$winner = mysql_result($result,$j,'player1');
		$loser = mysql_result($result,$j,'player2');
		$winnerName = getPlayerName($winner);
		$loserName = getPlayerName($loser);
		$p1g = mysql_result($result,$j,'player1_score');
		$p2g = mysql_result($result,$j,'player2_score');	

echo 	'<tr>';
echo 	'<td class="text-normal">' . $winnerName . '</td>';
echo 	'<td class="text-normal">' . $p1g . '</td>';
echo 	'<td class="text-normal">' . $p2g . '</td>';
echo 	'<td class="text-normal">' . $loserName . '</td>';
echo	'</tr>';
}
echo "</table><br>";


			
?>		
<?php require_once 'includes/footer.php'; ?>
