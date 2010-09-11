<?php require_once '../includes/adminhead.php';

//$query = "SELECT id,name from player";

$currSeason = currentSeason();
$query = "select player.id, player.name, division.number from player,division,playerdiv where player.id=playerdiv.playerID and playerdiv.divisionid = division.id and division.seasonid = $currSeason";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

?>
<span class="text-header">Add a result</span><br><br>
<form method="post" action="resultadded.php">
<select name="player1" size="1">
<option value=Nick Wales>Winner</option>
<?php 
for ($j = 0; $j < $rows ; ++$j) {
	echo '<option value="' . mysql_result($result,$j,'id') . '">Div:' .  mysql_result($result,$j,'number') . " " .  mysql_result($result,$j,'name') . '</option>';
}
?>

</select>
	
<select name="p1g1" size="1">
<?php 
   for ($i = 0 ; $i <= 10; ++$i) {
	echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
 <select name="p1g2" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p1g3" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p1g4" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p1g5" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>

</select>
<br>
<select name="player2" size="1">
<option value=Nick Wales>Runner Up</option>


<?php
for ($j = 0; $j < $rows ; ++$j) {
		echo '<option value="' . mysql_result($result,$j,'id') . '">Div:' .  mysql_result($result,$j,'number') . " " .  mysql_result($result,$j,'name') . '</option>';
//        echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'name') . '</option>';
}
?>

</select>
<select name="p2g1" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p2g2" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p2g3" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p2g4" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<select name="p2g5" size="1">
<?php
   for ($i = 0 ; $i <= 10; ++$i) {
        echo '<option value="' . $i . '">' . $i . '</option>';
   }
?>
</select>
<input type="submit" />

<?php
require_once '../includes/adminfooter.php'; ?>