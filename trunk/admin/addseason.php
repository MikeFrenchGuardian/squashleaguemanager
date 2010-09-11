<?php require_once '../includes/adminhead.php'; ?>


<span class="text-header">Add new season</span><br><br>
<form action="newSeason.php" method="post">
Season Start Date
<?php
date_default_timezone_set('UTC');
//get class into the page
require_once('../calendar/classes/tc_calendar.php');

//instantiate class and set properties

	  $myCalendar = new tc_calendar("date1");
	  $myCalendar->setIcon("../calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("../calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01', false);
	  $myCalendar->startMonday(true);
	  $myCalendar->disabledDay("Sat");
	  $myCalendar->disabledDay("sun");
      $myCalendar->setDateFormat('dmy');
	  $myCalendar->writeScript();
	  


?>
<br><br>
Season End Date
<?php
$myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon("../calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("../calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01', false);
	  $myCalendar->startMonday(true);
	  $myCalendar->disabledDay("Sat");
	  $myCalendar->disabledDay("sun");
      $myCalendar->setDateFormat('dmy');
	  $myCalendar->writeScript(); 
	
?>
<input type="submit" value="GOGOGOGOGO">
</form>


<?php

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