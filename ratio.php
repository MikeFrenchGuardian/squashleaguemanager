<?php require_once 'includes/head.php'; 

$query = "SELECT id,name,elo_score FROM player";
$result = mysql_query($query);
$rows = mysql_num_rows($result);


?>
<span class="text-header">Player Win/Loss Ratio Ranking</span><br><br>

<table class="league">
<tr>
   <td class="hed">Rank</td>
   <td class="hed">Played</td>
   <td class="hed">Name</td>
   <td class="hed">Won</td>
   <td class="hed">Lost</td>
   <td class="hed">Ratio</td>
   <td class="hed">Ranking</td>
</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
	$k = $j +1;
	$id = mysql_result($result,$j,'id');
	$name = mysql_result($result,$j,'name');
	$tjRank = mysql_result($result,$j,'elo_score');
	$wins = getWins($id);
	$losses = getLosses($id);
	$played = $wins + $losses;
	$ratio = getRatio($id);
	
	$arrayNo = $j;

		$arrayNo = array
		(
				"playerID" => $playerID,
				"player" => $playerName,
				"wins" => $wins,
				"losses" => $loses,
				"ratio" => $ratio,
				"tjrank" => $tjRank

		);	   

	$playerArray[] = $arrayNo;
	
	usort($playerArray, "sortRatio");
	
	$k = 0;
	foreach ($playerArray as $position) {
		++$k;
		echo 	'<tr>';
        echo    '<td class="normal">';
		echo	'<a href="playerdetail.php?id=' . $position['playerID'] . '" class="text-normal">' . $position['player'] . '</td>';
        echo    '<td class="normal">';
		echo	$position['played'] . '</td>';
        echo    '<td class="normal">';
		echo	$position['wins'] . '</td>';	
        echo    '<td class="normal">';
		echo	$position['losses'] . '</td>';
	    echo    '<td class="normal">';
		echo	$position['ratio'] . '</td>';
		echo    '<td class="normal">';
		echo	$position['tjRank'] . '</td>';
		echo	'</tr>';
	}
}

?>
</table>

<?php require_once 'includes/footer.php'; ?>