<?php require_once '../includes/adminhead.php'; 



if (isset($_POST['player'])) {
?>
<span class="text-header">Edit Player</span><br><br>
<?php

	$playerID = sanitizeString($_POST['player']);
	$query = "select id,name,email,phone,mobilephone from player where id = $playerID";
	$result = mysql_query($query);	
	
?>

<form method="get" action="editplayer.php">
<?php 
echo 'Name: <input name="name" type="text" size="25" value="' . mysql_result($result,$j,'name') . '"><br>';
echo 'Email: <input name="email" type="text" size="25" value="' . mysql_result($result,$j,'email') . '"><br>';
echo 'Phone: <input name="phone" type="text" size="25" value="' . mysql_result($result,$j,'phone') . '"><br>';
echo 'Mobile: <input name="mobilephone" type="text" size="25" value="' . mysql_result($result,$j,'mobilephone') . '"><br>';
?>
<input type="submit">
<?php






} else {
?>
	<span class="text-header">Choose Player</span><br><br>
	<form method="post" action="editplayer.php">

<?php

	echo "Choose player to edit: ";
	
	$query = "select id,name from player";
	$result = mysql_query($query);	
	$rows = mysql_num_rows($result);
	
?>


<?php 

		
		// choose player in the dropdown 
?>
<select name="player" size="1">

<?php 
for ($j = 0; $j < $rows ; ++$j) {

	echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'name') . '</option>';
}
?> 
</select>
<br><br>
<input type="submit">

<?php
}



 require_once '../includes/adminfooter.php'; ?>