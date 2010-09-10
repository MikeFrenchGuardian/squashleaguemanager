<html>
   <head>
      <title>Set Divisions</title>
<link rel="stylesheet" type="text/css" href="style.css" />
   <head>
   <body>

<?php
require_once 'login.php';
require_once 'dbCheck.php';
require_once 'functions.php';


if (isset($_POST['season'])) $season = sanitizeString($_POST['season']);
if (isset($_POST['leagueNum'])) $leagueNum = sanitizeString($_POST['leagueNum']);


// Loop for each league
for ($h = 1; $h =< $leagueNum; ++$h) {

<SELECT NAME="playerdiv1" MULTIPLE SIZE=<?php echo $rowsdiv1 ?>>
	
	
	// Select players currently in the league
	for ($i = 0; $i < $leagueNum; ++$i) {
	$querydiv1 = "select playerID from playerdiv where divisionID=$h";
	$resultdiv1 = mysql_query($querydiv1);
	$rowsdiv1 = mysql_num_rows($resultdiv1);
	$id = mysql_result($resultdiv1,$i,'id');
	$name = mysql_result($resultdiv1,$i,'name');

	echo "<OPTION VALUE=\"$id\">$name"; 
	}

	// Select players not currently in the league
	for ($j = 0; $j < $leagueNum; ++$j) {
	$query = "select player.id, player.name from player,playerdiv where player.id = playerdiv.playerID and playerdiv.divisionid !=";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$id2 = mysql_result($resultdiv1,$j,'id');
	$name2 = mysql_result($resultdiv1,$j,'name');
	echo "<OPTION VALUE=\"$id2\">$name2"; 
	
	}
?>


<SELECT NAME="playerdiv1" MULTIPLE SIZE=<?php echo $rowsdiv1 ?>>
<?php
for ($k = 0 ; $k < $rowsdiv1 ; ++$k) {
	$id = mysql_result($resultdiv1,$j,'id');
	$name = mysql_result($resultdiv1,$j,'name');

	echo "<OPTION VALUE=\"$id\">$name"; 
}



echo "</SELECT>";

?>



<input type="submit" />