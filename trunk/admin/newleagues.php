<?php require_once '../includes/adminhead.php'; ?>


<span class="text-header">Create Season</span><br><br>

<?php 

if (isset($_POST['season'])) $seasonID = sanitizeString($_POST['season']);
if (isset($_POST['leagueNum'])) $leagueNum = sanitizeString($_POST['leagueNum']);

// If the page receives a create leagues request then we create them, otherwise we just add players to the league.

if (isset($seasonID)) {
	//	$seasonID = $seasonID;
	// Insert leagues into DB.
	// Loop for each league to add them to the DB
	
	$update = checkDivCreation($seasonID);
	
	if ( $update > 0 ) {
		echo "Divisions for this season have already been setup, edit using the edit division tool, which doesn't exist just yet.";
	} else {
		for ($h = 1; $h <= $leagueNum; ++$h) {
			createNewLeagues($seasonID,$h);
	}
	echo "All done ";
	}

} else {

	// Setup the season drop down, will want to reverse the order eventually
$query = "select id,startdate from season";
$result = mysql_query($query);
$rows = mysql_num_rows($result);
$currSeason = currentSeason();


//$seasonQuery = "select startdate from season where id=$currSeason";
//$seasonResult = mysql_query($seasonQuery);
//		$row = mysql_fetch_object($seasonResult);
//		$name = $row->{'startdate'};

?>
<form method="post" action="newleagues.php">

	<!-- Season Drop Down -->
Choose Season: 
<select name="season" size="1">
<option value=<?php echo $currSeason ?>><?php echo $name ?></option>
<?php 
for ($j = 0; $j < $rows ; ++$j) {

	echo '<option value="' . mysql_result($result,$j,'id') . '">' . prettyDate(mysql_result($result,$j,'startdate')) . '</option>';
}
?> 
</select>
<br><br>
	<!-- League entry box -->
<span class="text-normal">Enter number of leagues: </span><input type="text" name="leagueNum" />
<br>
<input type="submit">
</form>

<?php 
}

require_once '../includes/adminfooter.php'; ?>
