<?php require_once '../includes/adminhead.php';
$currentLeague = currentLeague();
$leagueCount = numLeagues($currentLeague);
$playerListQuery = "select id from player";
$playerListResult = mysql_query($playerListQuery);
$playerListRows = mysql_num_rows($playerListResult);

while($playerListRow = mysql_fetch_array($playerListResult)) {
	$playerlist_array[] = $playerListRow['id'];
}

$leaguePlayerQuery = "select playerdiv.playerid from playerdiv,division where playerdiv.divisionid = division.id and  division.seasonid=2";
$leaguePlayerResult = mysql_query($leaguePlayerQuery) or die(mysql_error());

while($leaguePlayerRow = mysql_fetch_array($leaguePlayerResult)) {
	$leaguePlayer_array[] = $leaguePlayerRow['playerid'];
}

$result = array_diff($playerlist_array, $leaguePlayer_array);

$arraySize = count($result);
echo '<form method="get" action="setupDivision.php">';
echo '<table>';
//print_r($result);
 foreach($result as $playerID) {
     $playerName = getPlayerName($playerID);
echo '<tr><td>' . $playerName . '</td>';

	echo	"<td class=\"text-normal\"><select name=\"" . $playerID . "\">";
			// Run through number of leagues in the given season for each dropdown
		for ($j = 1; $j <= $leagueCount ; ++$j ) {
		
				// Render the option name as the playerID
				echo '<option name="' . $playerName  . '" value="' . $j . '">' . $j . '</option>';
		}
	echo '<option name="' . $playerName  . '" value="None">None</option>';
	echo '</td></tr>';
}
echo '</table>';
echo '<input type="hidden" value="stage2" value="yes">';
echo '<input type="submit" value="Submit">';
echo '</form>';
require_once '../includes/adminfooter.php'; ?>
