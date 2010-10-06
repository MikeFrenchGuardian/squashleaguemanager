<?php require_once '../includes/adminhead.php';  ?>
<span class="text-header">Add new season</span><br><br>

<?php
if (isset($_POST['startDay']))  {

$startDay = ($_POST['startDay']);
$startMonth = ($_POST['startMonth']);
$startYear = ($_POST['startYear']);

$startDate = $startYear . $startMonth . $startDay;
echo $startDate;


  //$start = $_POST(startDate);
  //$end = $_POST(endDate);
      //     if (isset($_POST['player1']))
  //if ($start > $end) {
  //}
  
  
} else {
?>
<form action="addseason.php" method="post">
Start Date

<select name="startDay" size="1">
  <option value="Day">Day</option>
<?php 
  for ($j = 01; $j <= 31; ++$j) {
//    return str_pad((int) $number,$n,"0",STR_PAD_LEFT 
?>
  <option value="<?php echo $j ?>"><?php echo $j ?>   </option>
<?php
}
?>

<select name="startMonth" size="1">
  <option value="Month">Month</option>
  <option value="01">Jan</option>
  <option value="02">Feb</option>
  <option value="03">Mar</option>
  <option value="04">Apr</option>
  <option value="05">May</option>
  <option value="06">Jun</option>
  <option value="07">Jul</option>
  <option value="08">Aug</option>
  <option value="09">Sep</option>
  <option value="10">Oct</option>
  <option value="11">Nov</option>
  <option value="12">Dec</option>
</select>


<select name="startYear" size="1">
  <option value="Year">Year</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
</select>

<br><br>

End Date
<select name="endDay" size="1">
  <option value="Day">Day</option>
<?php 
  for ($j = 1; $j <= 31; ++$j) { 
?>
  <option value="<?php echo $j ?>"><?php echo $j ?>   </option>
  <?php
}
?>

<select name="endMonth" size="1">
  <option value="Month">Month</option>
  <option value="01">Jan</option>
  <option value="02">Feb</option>
  <option value="03">Mar</option>
  <option value="04">Apr</option>
  <option value="05">May</option>
  <option value="06">Jun</option>
  <option value="07">Jul</option>
  <option value="08">Aug</option>
  <option value="09">Sep</option>
  <option value="10">Oct</option>
  <option value="11">Nov</option>
  <option value="12">Dec</option>
</select>


<select name="endYear" size="1">
  <option value="Year">Year</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
</select>

<br><br>


<input type="submit" value="Submit">
</form>


<?php
}  
  echo "booooyaaa";

function getNewSeasonStart() {
	$query = "SELECT MAX(endDate) from season ";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	
}

function createSeason($startDate, $endDate) {
	$query = "INSERT INTO season (startDate,endDate) VALUES (\"$startDate\", \"$endDate\");";
	$result = mysql_query($query);	
}

function numberOfLeagues($season, $numOfLeagues) {
	$query =  "INSERT INTO player (name,phone,mobilephone,email) VALUES (\"$name\", \"$phone\",\"$mobilePhone\", \"$email\");";
	$result = mysql_query($query);
	echo '<span class="text-normal">';
	echo $name;
	echo " added to database successfully</span>";
}
?>



<?php require_once '../includes/adminfooter.php'; ?>
<!--//Things to achieve:

//Season startdate enddate
//Number of leagues
//Number of players in each league
//Players in each league -->