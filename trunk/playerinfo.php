<html>
   <head>
      <title>Player Info</title>
<link rel="stylesheet" type="text/css" href="style.css" />
   <head>
   <body>

<?php
require_once 'login.php';
require_once 'functions.php';
require_once 'dbCheck.php';

$query = "SELECT * FROM player";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

?>

<table class="stats">
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
echo 	'<td class="text-normal">' . $mobilephone . '</td>';
echo 	'<td class="text-normal">' . $phone . '</td>';
echo 	'<td><a class="text-normal" href="mailto:' . $email . '">' . $email . '</td>';
echo	'</tr>';
}
?>
</table>

