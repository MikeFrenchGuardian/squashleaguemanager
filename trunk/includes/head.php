<html>
<head>

<?php
require_once 'login.php';
require_once 'dbCheck.php';
require_once 'functions.php';

$curPage = curPageName();

if ($curPage == "rules.php"){
        echo '<title>League Rules | TomJohn League</title>';
} else if ($curPage == "showleague.php") {
        echo '<title>Leagues | TomJohn League</title>';
} else if ($curPage == "ranking.php") {
        echo '<title>Rankings | TomJohn League</title>';
} else if ($curPage == "results.php") {
        echo '<title>Results | TomJohn League</title>';
} else if ($curPage == "stats.php") {
        echo '<title>Statistics | TomJohn League</title>';
} else if ($curPage == "playerinfo.php") {
        echo '<title>Player Info | TomJohn League</title>';
} else {
        echo '<title>TomJohn League</title>';
}
?>


<title>TomJohn League</title>

<META name="description" content="Wimbledon Squash and Fitness Club Online Squash Leagues and Team Website">
<META name="keywords" content="Wimbledon, squash, league, league management, surrey cup">
<link rel="shortcut icon" href="http://s3-eu-west-1.amazonaws.com/tomjohn/favicon.ico" >
<link rel="stylesheet" type="text/css" href="style.css" />

<?php require_once 'googleTracking.php'; ?>

<script language="javascript" src="http://www.google.com/jsapi"></script>

</head>
<body class="text-normal" bgcolor="#C0C0C0" padding="0">

<?php

$ref = getenv("HTTP_REFERER"); 
session_start();
if(!session_is_registered(myusername)){
	$loggedIn = "false";
} else {
	$loggedIn = "true";

}
?>
<div class="content">
<div class="cruising">
<?php 


// grab most recent 5 results from the db
$query = "SELECT player1, player2, player1_score, player2_score FROM results where player2_score != -1"; // LIMIT 0,5";
$result = mysql_query($query);
$rows = mysql_num_rows($result);



$last5 = $rows-5; //not required anymore... db going the other way?!?


      
?>
<div class="recentResults">
<span class="text-medium-header">Latest Results</span><br>
<table class="stats">
<tr>
   <td class="hed" colspan="2">Winner</td>
   <td class="hed" colspan="2">Runner-Up</td>

</tr>
<?php
for ($j = $last5 ; $j < $rows ; ++$j)
{
        $player1 = mysql_result($result,$j,'player1');
        $player2 = mysql_result($result,$j,'player2');
        $p1_score = mysql_result($result,$j,'player1_score');
        $p2_score = mysql_result($result,$j,'player2_score');


echo    '<tr>';
echo    '<td>' . getPlayerName($player1) . '</td><td>' . $p1_score . '</td>';
echo    '<td>' . $p2_score . '</td><td>' . getPlayerName($player2) . '</td>';
echo    '</tr>';
}
echo "</table> <br><br>";
?>
</div>

<span class="logo-white">TomJohn </span><span class="logo-red"> League</span>


	
</div>
<div class="text-area">
