<?php require_once 'includes/head.php'; 

$query = "SELECT * FROM player";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

?>

<table class="league">
<tr>
   <td class="hed">Name</td>
   <td class="hed">Mobile</td>
   <td class="hed">Phone</td>
   <td class="hed">email</td>
</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
	$id = mysql_result($result,$j,'id');
	$name = mysql_result($result,$j,'name');
	$mobilephone = mysql_result($result,$j,'mobilephone');
	$phone = mysql_result($result,$j,'phone');
	$email = mysql_result($result,$j,'email');
	
echo 	'<tr>';
echo 	'<td><a class="text-normal" href="playerdetail.php?id=' . $id . '">' . $name . '</td>';
echo 	'<td>' . $mobilephone . '</td>';
echo 	'<td>' . $phone . '</td>';
echo 	'<td><a class="text-normal" href="mailto:' . $email . '">' . $email . '</td>';
echo	'</tr>';
}
?>
</table>

<?php require_once 'includes/footer.php'; 