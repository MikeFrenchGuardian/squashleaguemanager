
<?php require_once 'includes/head.php';

$id = $_GET["id"];
$query = "select * from results where player1 = $id or player2 = $id";


$result = mysql_query($query);
$rows = mysql_num_rows($result);

?>
Result History:<br>
<table class="stats">
<tr>
   <td class="hed">Winner</td>
   <td class="hed">Loser</td>
   <td class="hed">Game Score</td>
   <td class="hed">Game1</td>
   <td class="hed">Game2</td>
   <td class="hed">Game3</td>
   <td class="hed">Game4</td>
   <td class="hed">Game5</td>

</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
	
	$winner = mysql_result($result,$j,'player1');
	$loser = mysql_result($result,$j,'player2');
	$winnerName = getPlayerName($winner);
	$loserName = getPlayerName($loser);
	$p1g = mysql_result($result,$j,'player1_score');
	$p2g = mysql_result($result,$j,'player2_score');
	$p1g1 = mysql_result($result,$j,'p1g1');
	$p2g1 = mysql_result($result,$j,'p2g1');
	$p1g2 = mysql_result($result,$j,'p1g2');
	$p2g2 = mysql_result($result,$j,'p2g2');
	$p1g3 = mysql_result($result,$j,'p1g3');
	$p2g3 = mysql_result($result,$j,'p2g3');
	$p1g4 = mysql_result($result,$j,'p1g4');
	$p2g4 = mysql_result($result,$j,'p2g4');
	$p1g5 = mysql_result($result,$j,'p1g5');
	$p2g5 = mysql_result($result,$j,'p2g5');
	
echo 	'<tr>';
echo 	'<td class="text-normal">' . $winnerName . '</td>';
echo 	'<td class="text-normal">' . $loserName . '</td>';
echo 	'<td class="text-normal">' . $p1g . " " . $p2g . '</td>';
echo 	'<td class="text-normal">' . $p1g1 . " " . $p2g1 . '</td>';
echo 	'<td class="text-normal">' . $p1g2 . " " . $p2g2 . '</td>';
echo 	'<td class="text-normal">' . $p1g3 . " " . $p2g3 . '</td>';
echo 	'<td class="text-normal">' . $p1g4 . " " . $p2g4 . '</td>';
echo 	'<td class="text-normal">' . $p1g5 . " " . $p2g5 . '</td>';

echo	'</tr>';
}
echo "</table>";


$wins = getWins($id);
$losses = getLosses($id);
$average = $wins/$losses*100;
$averagePointsPerSeason;


echo "Total Wins:" . $wins;
echo "<br>";
echo "Total Defeats:" . $losses . "<br>";
echo "Average Win %: " . $average;

?>

<?php require_once 'includes/footer.php'; ?>
<!--SHould totally have loads of cool stuff like, w/l tiebreaks, league promotion / demotion graphs -->
