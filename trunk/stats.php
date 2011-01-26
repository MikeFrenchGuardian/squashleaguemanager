<?php require_once 'includes/head.php'; ?>

<br><span class="text-header">League Stats</span><br><br>

<span class="text-semibold">Matches Played</span><br>

<?php
$maxSeason = getMaxSeasonID();

for ($i = 1; $i < $maxSeason; ++$i) {
	$matches = seasonMatchCount($i);
	$revenue = $matches * 4.60;
	echo 'Season starting ' . getSeasonStart($i) . ' ';
	echo  $matches . ' - Revenue - ' . $revenue;
	echo '<br>';
}



?>

<?php require_once 'includes/footer.php'; ?>

