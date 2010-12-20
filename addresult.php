<?php require_once 'includes/head.php';

if ($loggedIn == "false") {
	header("location:/index.php");
}

if (isset ($_POST['games'])) {
		$seasonID = currentSeason();

if (isset($_POST['player1'])) $player1 = sanitizeString($_POST['player1']);
if (isset($_POST['player2'])) $player2 = sanitizeString($_POST['player2']);
if (isset($_POST['p1score'])) $p1score = sanitizeString($_POST['p1score']);
if (isset($_POST['p1score'])) $p2score = sanitizeString($_POST['p2score']);

$p1Elo = getEloRating($player1);
$p2Elo = getEloRating($player2);

echo $p1Elo . '<br>';
echo $p2Elo . '<br>';

$duplicate = checkDuplicates($player1,$player2);

if ($duplicate == "yes") {
	echo "These two have already played this season, try again";
} else {
	echo "Your result has been added";	
	addMatchResult($seasonID,$player1,$player2,$p1score,$p2score);
	emailMatchResult($player1,$player2,$p1score,$p2score);	
	    $elo_calculator = new elo_calculator;
	if ($p1score == $p2score) {
        $results=$elo_calculator->rating("draw","draw",$p1Elo,$p2Elo);			
	
	} else {
        $results=$elo_calculator->rating("won","lost",$p1Elo,$p2Elo);

	}
        $R=$results;
        $p1NewEloScore = $results['R3'];
        $p2NewEloScore = $results['R4'];

echo '<br><br>';
updateEloRating($player1,$p1NewEloScore);
echo '<br><br>';
updateEloRating($player2,$p2NewEloScore);
	
}

} else {
 

//$query = "SELECT id,name from player";

$currSeason = currentSeason();
$query = "select player.id, player.name, division.number from player,division,playerdiv where player.id=playerdiv.playerID and playerdiv.divisionid = division.id and division.seasonid = $currSeason order by division.number";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

?>
<span class="text-header">Add a result</span><br><br>
<span class="text-normal"> If you have the game scores, enter them here</span><br><br>
<form method="post" action="resultadded.php">
<select name="player1" size="1">
<option value=Nick Wales>Winner</option>
<?php 
for ($j = 0; $j < $rows ; ++$j) {
	echo '<option value="' . mysql_result($result,$j,'id') . '">Div:' .  mysql_result($result,$j,'number') . " " .  mysql_result($result,$j,'name') . '</option>';
}
?>

</select>

<?php 
for ($i = 1; $i <= 5; ++$i) {

echo '<select name="p1g' . $i . '" size="1">';
   for ($j = 0 ; $j <= 10; ++$j) {
	echo '<option value="' . $j . '">' . $j . '</option>';
   }
</select>
}
?>



<br>
<select name="player2" size="1">
<option value=Nick Wales>Runner Up</option>


<?php
for ($j = 0; $j < $rows ; ++$j) {
		echo '<option value="' . mysql_result($result,$j,'id') . '">Div:' .  mysql_result($result,$j,'number') . " " .  mysql_result($result,$j,'name') . '</option>';
//        echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'name') . '</option>';
}
?>
</select>

<?php 
for ($k = 1; $k <= 5; ++$k) {

echo '<select name="p1g' . $k . '" size="1">';
   for ($l = 0 ; $l <= 10; ++$l) {
	echo '<option value="' . $l . '">' . $l . '</option>';
   }
</select>
}
?>



<input type="hidden" name="points" value="yes">
<input type="submit" />
</form>

<!-- and again for those people who can't remember scores -->
<br><br>
And again for those people who can't remember their scores / walkovers.
<br><br>

<form method="post" action="addresult.php">
<select name="player1" size="1">
<option value=Nick Wales>Winner</option>
<?php 
for ($k = 0; $k < $rows ; ++$k) {
	echo '<option value="' . mysql_result($result,$k,'id') . '">Div:' .  mysql_result($result,$k,'number') . " " .  mysql_result($result,$k,'name') . '</option>';
}
?>

</select>
	
<select name="p1score" size="1">
<?php 
   for ($k = 1 ; $k <= 3; ++$k) {
	echo '<option value="' . $k . '">' . $k . '</option>';
   }
?>
</select>


</select>
<br>
<select name="player2" size="1">
<option value=Nick Wales>Runner Up</option>


<?php
for ($j = 0; $j < $rows ; ++$j) {
		echo '<option value="' . mysql_result($result,$j,'id') . '">Div:' .  mysql_result($result,$j,'number') . " " .  mysql_result($result,$j,'name') . '</option>';

}
?>

</select>
<select name="p2score" size="1">
<?php
   for ($i = 0 ; $i <= 2; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
	echo '<option value="noshow">No show</option>';
?>
</select>

<input type="hidden" name="games" value="yes">
<input type="submit" />
</form>

<?php
 
}
require_once 'includes/footer.php'; ?>