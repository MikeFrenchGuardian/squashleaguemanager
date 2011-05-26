<?php require_once '../includes/adminhead.php'; 

if (isset($_GET["delete"])) {
	
	$result = ($_GET["result"]);
	
	// The page heading
	echo '<span class="text-header">Confirm Deletion</span><br><br>';

	echo 'Are you sure you want to delete this result?<br><br>';
	
	echo '<a href="/admin/editresults.php?deleted=yes&"';
	
	
} else if (isset($_GET["deleted"])) {
	
	$result = ($_GET["result"]);
	
	deleteResult($result);

	// The page heading
	echo '<span class="text-header">Result Deleted</span><br><br>';
	
	echo "You've deleted that result... well done.";
	
} else if (isset($_GET["edit"])) {
	


} else {

 // Grab the season ID from the URL if available
$seasonID = ($_GET["seasonID"]);

if (isset($_GET["page"])) {
	$page = ($_GET["page"]);
} else {
	$page = 1;		
}
 

// If its not set use the current season
if (!isset($seasonID)) {
	$seasonID = currentSeason();
}

// Create a new var to play with later on
$currSeason =  currentSeason();

// This gives the page heading the right date
$startDate = getSeasonStart($seasonID);
$niceDate = prettyDate($startDate);

// The page heading
echo '<span class="text-header">League Beginning ' . $niceDate . "</span><br><br>";



// Previous and Next buttons on the league page.
$previousSeason = $seasonID - 1;
if ($seasonID > 1) {
    echo '<a class="text-normal" href="results.php?seasonID=' . $previousSeason . '">Previous Season</a> ';
}
if (($seasonID > 1) && ($seasonID < $currSeason)) {
  echo ' - ';
  }
if ($seasonID < $currSeason) {
  $nextSeason = $seasonID + 1;
  echo '<a class="text-normal" href="results.php?seasonID=' . $nextSeason . '">Next Season</a>';
}
echo '<br><br>';

// Create multiple pages if results are more than 45 in total

$rowsPerPage = 45;
// counting the offset
$offset = ($page - 1) * $rowsPerPage;
$thisPageStart = $rowsPerPage * $page;


$query = "select * from results where seasonID = $seasonID LIMIT $offset, $rowsPerPage";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

// build the table header

	echo '<span class="text-semibold"> Results for season ' . $seasonID . '</span><br>';
	echo "<table class=\"league\">";
	echo "<tr>";
	echo "   <td class=\"hed\">Player 1</td>";
	echo "   <td class=\"hed\">Score</td>";
	echo "   <td class=\"hed\">Player 2</td>";
	echo "</tr>";
	
//fill it with content

	for ($j = 0 ; $j < $rows ; ++$j) {
		$id = mysql_result($result,$j,'id');
		$winner = mysql_result($result,$j,'player1');
		$loser = mysql_result($result,$j,'player2');
		$winnerName = getPlayerName($winner);
		$loserName = getPlayerName($loser);
		$p1g = mysql_result($result,$j,'player1_score');
		$p2g = mysql_result($result,$j,'player2_score');	

echo 	'<tr>';
echo 	'<td class="text-normal">' . $winnerName . '</td>';
if ($p2g == "-1") {
	echo 	'<td class="text-normal">W/O</td>';	
} else {
	echo 	'<td class="text-normal">' . $p1g . ' - ' . $p2g . '</td>';
}
echo 	'<td class="text-normal">' . $loserName . '</td>';
echo	'<td class="text-normal">Edit Result';
echo	'<a href="/admin/editresults.php?delete=yes&result=' . $id . '" class="text-normal">Delete Result</a>';
echo	'</tr>';
}
echo "</table><br>";

// setup paging

$prev = $page -1;
$next = $page +1;

if ($rowsPerPage == $rows) {
echo '<a href="editresults.php?seasonID=' . $seasonID . '&page=' . $next . '">Next</a>';
}
if ($page != 1) {
echo ' ';
echo '<a href="editresults.php?seasonID=' . $seasonID . '&page=' . $prev . '">Previous</a>';			
}
?>		


<?php require_once '../includes/adminfooter.php'; ?>
