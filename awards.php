<?php require_once 'includes/head.php'; ?>

<span class="text-header">Awards</span><br><br> 
<?php
$players = getTotalPlayers();
$seasons = getSeasonCount();


for ($i = 1; $i <= $seasons; ++$i ) {
	for ($j = 1; $j <= $players; ++$j ) {	
		$arnie = terminatorScore($j, $i);
		echo $arnie;
		echo "<br>";
	}
}

?>
<?php require_once 'includes/footer.php'; ?>