<?php require_once 'includes/head.php'; ?>

<span class="text-header">Awards</span><br><br> 
<?php
$players = getTotalPlayers();
$seasons = getSeasonCount();


for ($i = 1; $i <= $seasons; ++$i ) {
	for ($j = 1; $j <= $players; ++$j ) {	
//		$arnie = 0;
		$score = terminatorScore($j, $i);

		if ($score > $arnie) {
			$arnie = $score;
		}
		$t1000 = $j;
		

	}
	//	echo $arnie;
	//	echo "<br>";
	echo	getPlayerName($t1000);

}

?>
<?php require_once 'includes/footer.php'; ?>