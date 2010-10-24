<?php require_once 'includes/head.php'; 

$query = "SELECT name,elo_score FROM player ORDER BY elo_score DESC";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

?>
<span class="text-header">Player Rankings</span><br><br>

<table class="league">
<tr>
   <td class="hed">Rank</td>
   <td class="hed">Name</td>
   <td class="hed">Points</td>
</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
	$k = $j +1;
	$id = mysql_result($result,$j,'id');
	$name = mysql_result($result,$j,'name');
	$points = mysql_result($result,$j,'elo_score');

	
echo 	'<tr>';
echo 	'<td>' . $k . '</td>';
echo 	'<td><a class="text-normal" href="playerdetail.php?id=' . $id . '">' . $name . '</td>';
echo 	'<td>' . $points . '</td>';
echo	'</tr>';
}
?>
</table>

<?php require_once 'includes/footer.php'; 