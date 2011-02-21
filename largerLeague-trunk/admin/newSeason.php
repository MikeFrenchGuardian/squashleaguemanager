<?php
$startDate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
$endDate = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";


$startDate =  str_replace('-', '', $startDate); 
$endDate =  str_replace('-', '', $endDate); 
echo $startDate . "<br>";
echo $endDate;



?> 
<?php

require_once 'login.php';
require_once 'dbCheck.php';


function newSeason($startDate, $endDate) {
	$query = "INSERT INTO season (startDate,endDate) VALUES (\"$startDate\",\"$endDate\");";
	$result = mysql_query($query);
	echo "The following has been added to the database </br>" . $query;
}


newSeason($startDate,$endDate);