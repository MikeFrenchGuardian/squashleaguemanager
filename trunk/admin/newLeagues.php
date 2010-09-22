<?php require_once '../includes/adminhead.php'; ?>


<span class="text-header">Create Season: Step 2</span><br><br>
<?php 
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
<form method="post" action="setupDivision.php">

	<!-- Season Drop Down -->
Choose Season: 
<select name="season" size="1">
<option value=<?php echo $currSeason ?>><?php echo $name ?></option>
<?php 
for ($j = 0; $j < $rows ; ++$j) {

	echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'startdate') . '</option>';
}
?> 
</select>
<br><br>
	<!-- League entry box -->
<span class="text-normal">Enter number of leagues: </span><input type="text" name="leagueNum" />
<br>
<input type="submit">
</form>

<?php require_once '../includes/adminfooter.php'; ?>