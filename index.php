<?php
require_once 'login.php';
require_once 'dbCheck.php';
require_once 'functions.php';
?>

<html>
<head>
<title>TomJohn League</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


Welcome to the TomJohn league, for those guys in it, you have <?php echo daysLeft(); ?>
<br><br>
Recent results:


Add a result <a href="addresult.php">here</a>
<br><br>
Create a new season <a href="addseason1.php">here</a>
<br><br>
Add a new player <a href="adduser.php">here</a>
<br><br>
See player info <a href="playerinfo.php">here</a>
<br><br>
See the leagues <a href="showleague.php">here</a>
<br><br>




LeagueMasters go <a href="/admin/">here</a> for administration


<?php

// grab most recent 5 results from the db
$query = "SELECT player1, player2, player1_score, player2_score FROM results LIMIT 0,5";
$result = mysql_query($query);
$rows = mysql_num_rows($result);



//$last5 = $rows - 5; not required anymore... db going the other way?!?

//echo $last5;
      
?>
<br><br><span class="text-normal">Recent Results</span><br><br>
<table class="stats">
<tr>
   <td class="hed">Winner</td>
   <td class="hed">Runner-Up</td>

</tr>
<?php
for ($j = 0 ; $j < 5 ; ++$j)
{
        $player1 = mysql_result($result,$j,'player1');
        $player2 = mysql_result($result,$j,'player2');
        $p1_score = mysql_result($result,$j,'player1_score');
        $p2_score = mysql_result($result,$j,'player2_score');


echo    '<tr>';
echo    '<td class="text-normal">' . getPlayerName($player1) . ' ' . $p1_score . '</td>';
echo    '<td class="text-normal">' . $p2_score . ' ' . getPlayerName($player2) . '</td>';
echo    '</tr>';
}


currentSeason(); 

?>
</table>      

</body>
</html>
