<?php
require_once 'login.php';


$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());

$query = "SELECT id,name from player";
$result = mysql_query($query);

$rows = mysql_num_rows($result);

?>

<html>
	<head>
	<title>Add Score</title>
	<body>
<form method="post" action="resultadded.php">
<select name="player1" size="1">
<option value=Nick Wales>Choose Player 1</option>
<?php 
for ($j = 0; $j < $rows ; ++$j) {

	echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'name') . '</option>';
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
<option value=Nick Wales>Choose Player 2</option>
<?php
for ($j = 0; $j < $rows ; ++$j) {

        echo '<option value="' . mysql_result($result,$j,'id') . '">' . mysql_result($result,$j,'name') . '</option>';
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

	</body>
</html>

