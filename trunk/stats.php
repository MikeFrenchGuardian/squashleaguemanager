<?php require_once 'includes/head.php'; ?>

<br><span class="text-header">League Stats</span><br><br>

<span class="text-semibold">Matches Played</span>

<?php
$maxSeason = getMaxSeasonID();



?>
<table class="league">
	<tr>
		<td class="hed">Season Start</td>
		<td class="hed">Matches Played</td>
		<td class="hed">% Matches Played</td>
		<td class="hed">Revenue</td>
	</tr>
<?php 
for ($i = 1; $i < $maxSeason; ++$i) {
	$matches = seasonMatchCount($i);
	$revenue = $matches * 4.60;
	$divCount = numLeagues($i);
	
	for ($j = 1; $j < $divCount; ++$j) {
			$divSize = $getDivSize();
			$leagueMatches = ($divSize / 2) * ($divSize -1);
			$totalMatches = $totalMatches + $leagueMatches;
	}
	$matchesPlayed = (($matches/$totalMatches)*100);
	


	echo "<tr>";
	echo "<td>" . prettyDate(getSeasonStart($i)) . "</td>";
	echo "<td>" . $matches . "</td>";
	echo "<td>" . $matchesPlayed . "</td>";
	echo "<td>&pound;" . $revenue . "</td>";
	echo "</tr>";
	echo '<br>';
}

echo "</table>";

?>

<?php require_once 'includes/footer.php'; ?>

