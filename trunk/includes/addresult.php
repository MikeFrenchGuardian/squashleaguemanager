<?php if (isset ($_POST['games'])) {
		$seasonID = currentSeason();

if (isset($_POST['player1'])) $player1 = sanitizeString($_POST['player1']);
if (isset($_POST['player2'])) $player2 = sanitizeString($_POST['player2']);
if (isset($_POST['p1score'])) $p1score = sanitizeString($_POST['p1score']);
if (isset($_POST['p1score'])) $p2score = sanitizeString($_POST['p2score']);

$p1Elo = getEloRating($player1);
$p2Elo = getEloRating($player2);

$duplicate = checkDuplicates($player1,$player2);
$diffPlayers = checkPlayersAreDifferent($player1,$player2);
$sameLeague = checkSameLeague($player1,$player2);

if ($duplicate == "yes") {
	echo 'These two have already played this season, <a href="javascript:history.go(-1)">click here to try again</a>';
} else if ($diffPlayers == "yes") {
	echo 'You have chosen the same player twice,  <a href="javascript:history.go(-1)">click here to try again</a>';
} else if ($sameLeague == "no") {
	echo 'League Matches must be between people in the same league,  <a href="javascript:history.go(-1)">click here to try again</a>';
} else {
	echo "Your result has been added <br><br>";	
	addMatchResult($seasonID,$player1,$player2,$p1score,$p2score);
	
	
	    $elo_calculator = new elo_calculator;
	if ($p1score == $p2score) {
        $results=$elo_calculator->rating("draw","draw",$p1Elo,$p2Elo);	
		emailMatchResult($player1,$player2,$p1score,$p2score,$p1Elo,$p2Elo,$p1NewEloScore,$p2NewEloScore);		
		
	} else if ($p2score == "-1") {
		$p1NewEloScore = "nochange";
		$p2NewEloScore = "nochange";
		emailMatchResult($player1,$player2,$p1score,$p2score,$p1Elo,$p2Elo,$p1NewEloScore,$p2NewEloScore);

	} else {
        $results=$elo_calculator->rating("won","lost",$p1Elo,$p2Elo);

	 
        $R=$results;
        $p1NewEloScore = $results['R3'];
        $p2NewEloScore = $results['R4'];

		$player1Name = getPlayerName($player1);
		$player2Name = getPlayerName($player2);

		echo $player1Name . "- Ranking points: "  . $p1Elo . ' => ' . $p1NewEloScore . '<br>';
		echo $player2Name . "- Ranking points: "  . $p2Elo . ' => ' . $p2NewEloScore . '<br>';

		echo '<br><br>';
		updateEloRating($player1,$p1NewEloScore);
		echo '<br><br>';
		updateEloRating($player2,$p2NewEloScore);

		updateElo($player1,$p1NewEloScore);
		updateElo($player2,$p2NewEloScore);
			
		emailMatchResult($player1,$player2,$p1score,$p2score,$p1Elo,$p2Elo,$p1NewEloScore,$p2NewEloScore);	
	}
}

} else {
 
$currSeason = currentSeason();
$query = "select player.id, player.name, division.number from player,division,playerdiv where player.id=playerdiv.playerID and playerdiv.divisionid = division.id and division.seasonid = $currSeason order by division.number";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

?>
<span class="text-header">Add a result</span><br><br>


<!-- Only doing match scores now, game scores look unlikely to be workable -->




<form method="post" action="addresult.php">
<select name="player1" size="1">
<option value=Nick Wales>Winner</option>
<?php 
for ($k = 0; $k < $rows ; ++$k) {
	echo '<option value="' . mysql_result($result,$k,'player.id') . '">Div:' .  mysql_result($result,$k,'division.number') . " " .  mysql_result($result,$k,'player.name') . '</option>';
}
?>

</select>
	
<select name="p1score" size="1">
<?php 
   for ($k = 1 ; $k <= 3; ++$k) {
	echo '<option value="' . $k . '" selected="3">' . $k . '</option>';
   }
?>
</select>


</select>
<br>
<select name="player2" size="1">
<option value=Nick Wales>Runner Up</option>


<?php
for ($j = 0; $j < $rows ; ++$j) {
		echo '<option value="' . mysql_result($result,$j,'player.id') . '">Div:' .  mysql_result($result,$j,'division.number') . " " .  mysql_result($result,$j,'player.name') . '</option>';

}
?>

</select>
<select name="p2score" size="1">
<?php
   for ($i = 0 ; $i <= 2; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
	echo '<option value="-1">No show</option>';
?>
</select>

<input type="hidden" name="games" value="yes">
<input type="submit" />
</form>

<?php } ?>