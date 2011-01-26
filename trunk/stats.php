<?php require_once 'includes/head.php'; ?>

<br><span class="text-header">League Stats</span><br><br>

<span class="text-semibold">Matches Played</span>

<?php
$maxSeason = getMaxSeasonID();

for ($i = 0; $i < $maxSeason; ++$i) {
	echo seasonMatchCount($i);
	echo '<br>';
}



?>

<?php require_once 'includes/footer.php'; ?>

