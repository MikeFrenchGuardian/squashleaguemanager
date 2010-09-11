<?php require_once '../includes/adminhead.php'; ?>

<?php 
if (isset($_POST['season'])) $seasonID = sanitizeString($_POST['season']);
if (isset($_POST['leagueNum'])) $leagueNum = sanitizeString($_POST['leagueNum']);


//$seasonID = $_GET["season"];

//if (isset($seasonID)) {
//	$seasonID = $seasonID;
//}	else {
//	$seasonID = currentSeason();
//}
//echo $seasonID;

// Insert leagues into DB.


// Loop for each league to add them to the DB
//for ($h = 1; $h <= $leagueNum; ++$h) {
//	createNewLeagues($seasonID,$h);
//}
$startDate = getSeasonStart($seasonID);
echo "$leagueNum was added to season beginning $startDate";


//echo "<SELECT NAME=\"playerdiv1\" MULTIPLE SIZE=$rowsdiv1>";
	
//	$divSize = getDivSize($h,2);
//	echo $h;
	// Select players currently in the league
//	for ($i = 1; $i <= $divSize; ++$i) {
//	$querydiv1 = "select playerID from playerdiv where divisionID=$h";
//	$resultdiv1 = mysql_query($querydiv1);
//	$rowsdiv1 = mysql_num_rows($resultdiv1);
//	$id = mysql_result($resultdiv1,$i,'playerID');
//	$name = getPlayerName($playerID);

//	echo "<OPTION VALUE=\"$id\">$name"; 
//	}

	// Select players not currently in the league
//	for ($j = 0; $j < $leagueNum; ++$j) {
//	$query = "select player.id, player.name from player,playerdiv where player.id = playerdiv.playerID and playerdiv.divisionid != 2";
//	$result = mysql_query($query);
//	$rows = mysql_num_rows($result);
//	$id2 = mysql_result($resultdiv1,$j,'id');
//	$name2 = mysql_result($resultdiv1,$j,'name');
//	echo "<OPTION VALUE=\"$id2\">$name2"; 
	
//	}
//echo "</SELECT>";
//}
?>
//<input type="submit" />
<?php require_once '../includes/adminfooter.php'; ?>










