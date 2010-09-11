<?php require_once '../includes/adminhead.php'; ?>

<span class="text-header">Add Players to the divisions</span><br>
<?php 
if (isset($_POST['season'])) $seasonID = sanitizeString($_POST['season']);
if (isset($_POST['leagueNum'])) $leagueNum = sanitizeString($_POST['leagueNum']);


//$seasonID = $_GET["season"];

//if (isset($seasonID)) {
//	$seasonID = $seasonID;
//}	else {
//	$seasonID = currentSeason();
//}


// Insert leagues into DB.


// Loop for each league to add them to the DB
//for ($h = 1; $h <= $leagueNum; ++$h) {
//	createNewLeagues($seasonID,$h);
//}
if (isset($seasonID)) {
$startDate = getSeasonStart($seasonID);


echo $leagueNum . " leagues were added to season beginning " . $startDate;
echo "<br>";
}


$seasonID = $_GET["season"];

if (isset($seasonID)) {
	$seasonID = $seasonID;
}	else {
	$seasonID = currentSeason();
}




for ($i = 1; $i <= 4; ++$i) {

	echo "Division $i<br><br>";
	echo "<table class=\"stats\">";
	echo "<tr>";
	echo "   <td class=\"hed\">Name</td>";
	echo "   <td class=\"hed\">Current League</td>";
	echo "</tr>";
	
	$leagueArray = "leagueArray" .$i;
	$divSize = getDivSize($i,$seasonID);
	$leagueArray = array();

		for ($j = 0 ; $j < $divSize ; ++$j) {
			$playerID = getDivPlayers($i,$seasonID,$j);
			$playerName = getPlayerName($playerID);
			$playerLeague = getPlayerLeague($playerID,$seasonID);
			$arrayNo = "player" .$j;

	
				$arrayNo = array
				(
						"playerID" => $playerID,
						"player" => $playerName,
						"league" => $playerLeague,
				);	   

			$leagueArray[] = $arrayNo;

	}
usort($leagueArray, "sortDescending");
 
foreach ($leagueArray as $position) {
	echo	'<tr>';
	echo	'<td><a href="playerdetail.php?id=' . $position['playerID'] . '" class="text-normal">' . $position['player'] . '</td>';
	echo	'<td class="text-normal"><select selected="' . $position['league'] . '">';
    echo "<option>1</option><option>2</option><option>3</option><option>4</option></select></td>";
	echo	'</tr>';
  }
	echo "</table>  <br><br>";


}
?>
<?php require_once '../includes/adminfooter.php'; ?>










