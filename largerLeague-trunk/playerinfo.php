<?php require_once 'includes/head.php'; 


if ($loggedIn == "true") {		
	$member = yes;	
} else {
	$member = no;
}


$query = "SELECT * FROM player ORDER by lname";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

?>
<span class="text-header">Player Information</span><br><br>
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
	$fname = mysql_result($result,$j,'fname');
	$lname = mysql_result($result,$j,'lname');
	$mobilephone = mysql_result($result,$j,'mobilephone');
	$phone = mysql_result($result,$j,'phone');
	$email = mysql_result($result,$j,'email');
	
echo 	'<tr>';
echo 	'<td><a class="text-normal" href="playerdetail.php?id=' . $id . '">' . $fname . $lname . '</td>';
if ($member == yes){
	echo 	'<td>' . $mobilephone . '</td>';
} else {
	echo 	'<td><span class="text-normal">Requires login</span></td>';	
}

if ($member == yes){
	echo 	'<td>' . $phone . '</td>';
} else {
	echo 	'<td><span class="text-normal">Requires login</span></td>';	
}

if ($member == yes){
	echo 	'<td><a class="text-normal" href="mailto:' . $email . '">' . $email . '</td>';
} else {
	echo 	'<td><span class="text-normal">Requires login</span></td>';	
}



echo	'</tr>';
}
?>
</table>

<?php require_once 'includes/footer.php'; 