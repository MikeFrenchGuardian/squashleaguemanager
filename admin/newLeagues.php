<?php require_once '../includes/adminhead.php'; ?>

// Get season startdates
// We'll want to reverse this before it gets too long

<?php 
$query = "select id,startdate from season";
$result = mysql_query($query);
$rows = mysql_num_rows($result);
$currSeason = currentSeason();


$seasonQuery = "select startdate from season where id=$currSeason";
$seasonResult = mysql_query($seasonQuery);
		$row = mysql_fetch_object($seasonResult);
		$name = $row->{'startdate'};

?>
<form method="post" action="setupDivision.php">
<select name="season" size="1">
<option value=<?php echo $currSeason ?>><?php echo $name ?></option>
<?php 
for ($j = 0; $j < $rows ; ++$j) {

	echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'startdate') . '</option>';
}
?> 
</select>
<br><br>
<span class="text-normal">Number of leagues: </span><input type="text" name="leagueNum" />
<br>
<input type="submit">
</form>


<?php require_once '../includes/adminfooter.php'; ?>