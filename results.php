<html>
   <head>
      <title>Player Results</title>
<link rel="stylesheet" type="text/css" href="style.css" />
   <head>
   <body>

<?php
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());

$query = "SELECT player1, player2, player1_score, player2_score, p1g1, p1g2, p1g3, p1g4, p1g5, p2g1, p2g2, p2g3, p2g4, p2g5 FROM results WHERE player1id=1";

$result = mysql_query($query);

$rows = mysql_num_rows($result);
        $player1 = mysql_result($result,'player1');
        $player2 = mysql_result($result,'player2');
?>

<table class="stats">
<tr>
   <td class="hed">Player 1</td>
   <td class="hed">Player 2</td>
   <td class="hed">Result</td>
   <td class="hed">Game 1</td>
   <td class="hed">Game 2</td>
   <td class="hed">Game 3</td>
   <td class="hed">Game 4</td>
   <td class="hed">Game 5</td>  

</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
        $player1 = mysql_result($result,$j,'player1');
        $player2 = mysql_result($result,$j,'player2');
	$p1_score = mysql_result($result,$j,'player1_score');
	$p2_score = mysql_result($result,$j,'player2_score');
        $p1g1 = mysql_result($result,$j,'p1g1');               
        $p1g2 = mysql_result($result,$j,'p1g2');
        $p1g3 = mysql_result($result,$j,'p1g3');
        $p1g4 = mysql_result($result,$j,'p1g4');
        $p1g5 = mysql_result($result,$j,'p1g5');
        $p2g1 = mysql_result($result,$j,'p2g1');
        $p2g2 = mysql_result($result,$j,'p2g2');
        $p2g3 = mysql_result($result,$j,'p2g3');
        $p2g4 = mysql_result($result,$j,'p2g4');
        $p2g5 = mysql_result($result,$j,'p2g5');

echo    '<tr>';
echo    '<td class="text-normal">' . $player1 . '</td>';
echo    '<td class="text-normal">' . $player2 . '</td>';
echo    '<td class="text-normal">' . $p1_score  . '-' . $p2_score . '</td>';
echo    '<td class="text-normal">' . $p1g1  . '-' . $p2g1 . '</td>';
echo    '<td class="text-normal">' . $p1g2  . '-' . $p2g2 . '</td>';
echo    '<td class="text-normal">' . $p1g3  . '-' . $p2g3 . '</td>';
echo    '<td class="text-normal">' . $p1g4  . '-' . $p2g4 . '</td>';
echo    '<td class="text-normal">' . $p1g5  . '-' . $p2g5 . '</td>';

echo    '</tr>';
}
?>
</table>


