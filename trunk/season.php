<?php
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());


$query = "SELECT id,startDate,endDate FROM season";
$result = mysql_query($query);
$rows = mysql_num_rows($result);


function currentSeason() {
	$query = "SELECT id,startDate,endDate FROM season";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	date_default_timezone_set('UTC');
	$currentDate = date('Ymd');

	for ($j = 0 ; $j < $rows ; ++$j) {
		$sDate = mysql_result($result,$j,'startDate');
		$eDate = mysql_result($result,$j,'endDate');
		$id = mysql_result($result,$j,'id');	
	
		if ( $currentDate >= $sDate && $currentDate <= $eDate) {
			return $id;
		}
	}
}


function daysLeft() {
	$seasonID = currentSeason();
	
	date_default_timezone_set('UTC');
	$currentDate = date('Ymd');
	$query = "SELECT id,startDate,endDate FROM season where id = " . $seasonID;
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$seasonID = $rows - 1;
	$eDate = mysql_result($result,$seasonID,'endDate');
	$daysLeft = (strtotime($eDate) - (strtotime($currentDate))) / (60 * 60 * 24);

	if ($daysLeft > 28) {
		echo $daysLeft . " days left of the current season \n";
	} else if ($daysLeft < 10) {
		echo $daysLeft . " days to go people, get those games in \n";
	}
}


?>
