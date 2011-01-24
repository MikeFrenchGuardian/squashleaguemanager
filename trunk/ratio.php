<?php require_once 'includes/head.php'; 

$query = "SELECT id,name FROM player";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

?>
<span class="text-header">Player Win/Loss Ratio Ranking</span><br><br>

<table class="league">
<tr>
   <td class="hed">Rank</td>
   <td class="hed">Name</td>
   <td class="hed">Ratio</td>
</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
	$k = $j +1;
	$id = mysql_result($result,$j,'id');
	$name = mysql_result($result,$j,'name');
	$ratio = getRatio($id);

	
echo 	'<tr>';
echo 	'<td>' . $k . '</td>';
echo 	'<td><a class="text-normal" href="playerdetail.php?id=' . $id . '">' . $name . '</td>';
echo 	'<td>' . $ratio . '</td>';
echo	'</tr>';
}
?>
</table>

<?php require_once 'includes/footer.php';