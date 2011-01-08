<?php require_once 'includes/head.php';


if ($loggedIn == "false") {
	header("location:/index.php");
}

$id = $_GET["id"];

$currSeasonID = getCurrentPlayerDivID($id);

$toPlayQuery = "select player.id, player.name, player.email from player,playerdiv where player.id = playerdiv.playerid and playerdiv.divisionID=$currSeasonID and player.id != $id";


$toPlayResult = mysql_query($toPlayQuery);
$toPlayRows = mysql_num_rows($toPlayResult);
?>
<br>
<span class="text-header">Your matches this league:</span><br>
<table class="league">
<tr>
   <td class="hed">Name</td>
   <td class="hed">Email</td>
</tr>
<?php
for ($i = 0 ; $i < $toPlayRows ; ++$i)
{
	
	$toPlayName = mysql_result($toPlayResult,$i,'name');
	$toPlayEmail = mysql_result($toPlayResult,$i,'email');

	echo 	'<tr>';
	echo 	'<td>' . $toPlayName . '</td>';
	echo 	'<td><a class="text-normal" href="mailto:" . $toPlayName . ">' . $toPlayEmail . '</td>';	
	echo	'</tr>';
}
	echo "</table><br>";




?>

<span class="text-header">Result History:</span><br>
<table class="league">
<tr>
	<td class="hed">Season</td>
	<td class="hed">Winner</td>
	<td class="hed">Score</td>
	<td class="hed">Loser</td>
</tr>
<?php
$query = "select * from results where player1 = $id or player2 = $id";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
	$season = mysql_result($result,$j,'seasonID');
	$winner = mysql_result($result,$j,'player1');
	$loser = mysql_result($result,$j,'player2');
	$winnerName = getPlayerName($winner);
	$loserName = getPlayerName($loser);
	$p1g = mysql_result($result,$j,'player1_score');
	$p2g = mysql_result($result,$j,'player2_score');
		
echo 	'<tr>';
echo 	'<td class="text-normal">' . $season . '</td>';
if ($winner == $id){
	echo 	'<td class="text-normal-bold">' . $winnerName . '</td>';
} else {
	echo	'<td class="text-normal">' . $winnerName . '</td>';
}


echo 	'<td class="text-normal">' . $p1g . " " . $p2g . '</td>';
if ($loser == $id){
	echo 	'<td class="text-normal-bold">' . $loserName . '</td>';
} else {
	echo 	'<td class="text-normal">' . $loserName . '</td>';
}

echo	'</tr>';
}
echo "</table><br>";


$wins = getWins($id);
$losses = getLosses($id);

if ($losses != 0) {
	$average = $wins/$losses*100;
	$average = round($average,2);
} else {
	$average = "Insufficient results at the moment";
}

$averagePointsPerSeason;
?>
<span class="text-header">Player Stats:</span><br>
<?php
echo "Total Wins: " . $wins . "<br>";
echo "Total Defeats: " . $losses . "<br>";
echo "Win Ratio: " . $average . "<br><br>";
?>
<span class="text-header">League Movement</span><br>
Coming soon:



<?php require_once 'includes/footer.php'; ?>
<!--SHould totally have loads of cool stuff like, w/l tiebreaks, league promotion / demotion graphs -->
