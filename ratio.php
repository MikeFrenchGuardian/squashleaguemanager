<?php require_once 'includes/head.php'; 
$ordering = "tjrank";
$ordering = ($_GET["order"]);

	
$query = "SELECT id,name,elo_score FROM player";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

?>
<span class="text-header">Player Win/Loss Ratio Ranking</span><br><br>

<table class="league">
<tr>

   <td class="hed">Rank</td>
   <td class="hed">Name</td>
   <td class="hed" style="width:50px"><a class="text-normal-white" href="ratio.php?order=played">Played</a></td>
   <td class="hed" style="width:50px"><a class="text-normal-white" href="ratio.php?order=won">Won</a></td>
   <td class="hed" style="width:50px"><a class="text-normal-white" href="ratio.php?order=lost">Lost</a></td>
   <td class="hed" style="width:80px"><a class="text-normal-white" href="ratio.php?order=ratio">W/L Ratio</a></td>
   <td class="hed" style="width:80px"><a class="text-normal-white" href="ratio.php?order=tjrank">Ranking</a></td>
</tr>
<?php


	$playerArray = array();
	
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
	
	$arrayName = "rankingTable";
	
	$arrayName = array
	
		(
				"playerID" => $id,
				"player" => $name,
				"played" => $played,
				"wins" => $wins,
				"losses" => $losses,
				"ratio" => $ratio,
				"tjrank" => $tjRank

		);	   


	$playerArray[] = $arrayName;
}	

	if ($ordering =="played") {
		usort($playerArray, "sortPlayed");
	} else if ($ordering == "won") {
		usort($playerArray, "sortWon");
	} else if ($ordering =="lost") {
		usort($playerArray, "sortLost");
	} else if ($ordering == "ratio") {
		usort($playerArray, "sortRatio");
	} else if ($ordering == "tjrank") {
		usort($playerArray, "sortRank");
	}





	$rank = 0;

	foreach ($playerArray as $position) {
	++$rank;
	
		echo 	'<tr>';
		echo    '<td class="normal">';
		echo	$rank . '</td>';
        echo    '<td class="normal">';
		echo	'<a href="playerdetail.php?id=' . $position['playerID'] . '" class="text-normal">' . $position['player'] . '</td>';
        if ($ordering == "played") {
			echo '<td class="bold">';
		} else {
			echo    '<td class="normal">';
		}
		echo	$position['played'] . '</td>';
		
        if ($ordering == "won") {
			echo '<td class="bold">';
		} else {
        	echo    '<td class="normal">';
		}
		echo	$position['wins'] . '</td>';	
        
       if ($ordering == "won") {
			echo '<td class="bold">';
		} else {
			echo    '<td class="normal">';
		}
		echo	$position['losses'] . '</td>';
	    
	   if ($ordering == "ratio") {
			echo '<td class="bold">';
		} else {
			echo    '<td class="normal">';
		}
		echo	$position['ratio'] . '</td>';
		
		if ($ordering == "tjrank") {
			echo '<td class="bold">';
		} else {
			echo    '<td class="normal">';
		}
		echo	$position['tjrank'] . '</td>';
		echo	'</tr>';
	}


?>
</table>

<?php require_once 'includes/footer.php'; ?>