<html>
<head>
<title>TomJohn League</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="text-normal" bgcolor="#C0C0C0" padding="0">
<?php
require_once 'login.php';
require_once 'dbCheck.php';
require_once 'functions.php';


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
   <td class="hed">Winner</td>
   <td class="hed">Runner-Up</td>

</tr>
<?php
for ($j = $last5 ; $j < $rows ; ++$j)
{
        $player1 = mysql_result($result,$j,'player1');
        $player2 = mysql_result($result,$j,'player2');
        $p1_score = mysql_result($result,$j,'player1_score');
        $p2_score = mysql_result($result,$j,'player2_score');


echo    '<tr>';
echo    '<td>' . getPlayerName($player1) . ' ' . $p1_score . '</td>';
echo    '<td>' . $p2_score . ' ' . getPlayerName($player2) . '</td>';
echo    '</tr>';
}
echo "</table> <br><br>";
?>
</div>

<span class="logo-white">TomJohn </span><span class="logo-red"> League</span>
//<span class="text-header"><?php echo daysLeft(); ?></span><br><br> 

	
</div>
<div class="text-area">
