<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>TomJohn :: League Tables</title>
</head>
<body>

<?php
require_once 'login.php';
require_once 'functions.php';
require_once 'season.php';
require_once 'dbCheck.php';


$seasonID = currentSeason();
$division = 1;


for ($i = 1; $i <= 4; ++$i) {

	echo "Division $i<br><br>";
	echo "<table class=\"stats\">";
	echo "<tr>";
	echo "   <td class=\"hed\">Name</td>";
	echo "   <td class=\"hed\">Games Played</td>";
	echo "   <td class=\"hed\">Wins</td>";
	echo "   <td class=\"hed\">Losses</td>";
	echo "   <td class=\"hed\">Points</td>";
	echo "</tr>";
	
	$leagueArray = "leagueArray" .$i;
	$divSize = getDivSize($i,$seasonID);
	$leagueArray = array();

		for ($j = 0 ; $j < $divSize ; ++$j) {
			$playerID = getDivPlayers($i,$seasonID,$j);
			$playerName = getPlayerName($playerID);
			$gamesPlayed = getLeagueGamesPlayed($playerID,$seasonID);
			$wins = getLeagueWins($playerID,$seasonID);
			$loses = getLeagueLoses($playerID,$seasonID);
			$points = getLeaguePoints($playerID,$seasonID);
			$arrayNo = "player" .$j;
	
			    $arrayNo = array
			    (
			            "player" => $playerName,
		   	 	        "gamesPlayed" => $gamesPlayed,
					    "wins" => $wins,
       		   		  	"loses" => $loses,
       			   	  	"points" => $points,
       			);	   

		$leagueArray[] = $arrayNo;

	}
usort($leagueArray, "sortDescending");
 
foreach ($leagueArray as $position) {
	echo	'<tr>';
	echo	'<td class="text-normal">' . $position['player'] . '</td>';
	echo	'<td class="text-normal">' . $position['gamesPlayed'] . '</td>';
	echo	'<td class="text-normal">' . $position['wins'] . '</td>';
	echo	'<td class="text-normal">' . $position['loses'] . '</td>';
	echo	'<td class="text-normal">' . $position['points'] . '</td>';
	echo	'</tr>';
  }
	echo "</table>  <br><br>";


}


?>

</body>
</html>