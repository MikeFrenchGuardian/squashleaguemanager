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


$seasonID = CurrentSeason();
$division = 1;



$divSize = getDivSize($division,$seasonID);

// Get players in the div... feed them into the associative array

for ($i = 0; $i < $divSize; ++$i) {
	echo getDivPlayers($division,$seasonID);
	
}



$divisionID=2;
$divSize = getDivSize(1,2);

//Create the arrays for each Div
$league = array();
echo "Division 1<br><br>";

?>
<table class="stats">
<tr>
   <td class="hed">Name</td>
   <td class="hed">Games Played</td>
   <td class="hed">Wins</td>
   <td class="hed">Losses</td>
   <td class="hed">Points</td>
</tr>

<?php
for ($j = 0 ; $j < $divSize ; ++$j) {
	$playerID = getDivPlayers(1,2,$j);
	$playerName = getPlayerName($playerID);
	$gamesPlayed = getLeagueGamesPlayed($playerID,$divisionID);
	$wins = getLeagueWins($playerID,$divisionID);
	$loses = getLeagueLoses($playerID,$divisionID);
	$points = getLeaguePoints($playerID,$divisionID);
	$arrayNo = "player" .$j;
	
	    $arrayNo = array
	    (
	            "player" => $playerName,
    	        "gamesPlayed" => $gamesPlayed,
			    "wins" => $wins,
       	     	"loses" => $loses,
       	     	"points" => $points,
       	);	   

$league[] = $arrayNo;

}



usort($league, "sortDescending");
 
foreach ($league as $position) {
	echo	'<tr>';
	echo	'<td class="text-normal">' . $position['player'] . '</td>';
	echo	'<td class="text-normal">' . $position['gamesPlayed'] . '</td>';
	echo	'<td class="text-normal">' . $position['wins'] . '</td>';
	echo	'<td class="text-normal">' . $position['loses'] . '</td>';
	echo	'<td class="text-normal">' . $position['points'] . '</td>';
	echo	'</tr>';
  }
	echo "</table>";
?>

</body>
</html>