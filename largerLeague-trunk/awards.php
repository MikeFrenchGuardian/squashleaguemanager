<?php require_once 'includes/head.php'; ?>

<span class="text-header">Awards</span><br><br> 
<?php
$players = getTotalPlayers();
$seasons = getSeasonCount();

echo "Terminator Award: Most efficient killer of games<br><br>";
for ($i = 1; $i < $seasons; ++$i ) {
	for ($j = 1; $j <= $players; ++$j ) {	
//		$arnie = 0;
		$score = terminatorScore($j, $i);

		if ($score > $arnie) {
			$arnie = $score;
			$t1000 = $j;
		}
		
		

	}
	//	echo $arnie;
	//	echo "<br>";
	echo 	"Season " . $i . ": " . getPlayerName($t1000). " Game difference of +" . $arnie . "<br>";
//	echo	getPlayerName($t1000);
	$score = 0;
	$arnie = 0;
	$t1000 = 0;

}

?>
<?php require_once 'includes/footer.php'; ?>