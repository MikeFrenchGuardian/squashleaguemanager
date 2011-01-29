<?php require_once 'includes/head.php'; ?>

<br><span class="text-header">League Stats</span><br>

<?php
$maxSeason = getMaxSeasonID();



?>
<table class="league">
	<tr>
		<td class="hed">Season</td>
		<td class="hed">Divs</td>
		<td class="hed">Players</td>
		<td class="hed">Matches</td>
		<td class="hed">Max Matches</td>
		<td class="hed">Matches Played %</td>
	</tr>
<?php 
for ($i = 1; $i <= $maxSeason; ++$i) {
	$matches = seasonMatchCount($i);
	$revenue = $matches * 4.60;
	$divCount = numLeagues($i);
	$totalMatches = 0;
	$leagueSize = 0;
	
	for ($j = 1; $j <= $divCount; ++$j) {
			$divSize = getDivSize($j,$i);
			$leagueMatches = ($divSize / 2) * ($divSize -1);
			$totalMatches = $totalMatches + $leagueMatches;
			$leagueSize = $leagueSize + $leagueSize;
	}
	$matchesPlayed = (($matches/$totalMatches)*100);
	


	echo "<tr>";
	echo "<td>" . prettyDate(getSeasonStart($i)) . "</td>";
	echo "<td>" . $divCount . "</td>";
	echo "<td>" . $leagueSize . "</td>";
	echo "<td>" . $matches . "</td>";
	echo "<td>" . $totalMatches . "</td>";
	echo "<td>" . round($matchesPlayed) . "</td>";
	echo "</tr>";
	echo '<br>';
}

echo "</table>";

?>

<?php require_once 'includes/footer.php'; ?>

