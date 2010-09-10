




	$query = "select playerdiv.playerID from playerdiv,division where  playerdiv.divisionID=division.number and division.seasonid=$seasonID and playerdiv.divisionid=$division";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		
$prices

for ($j = 0 ; $j < $rows ; ++$j)
{
	$playerid = mysql_result($result,$j,'playerid');
	$name = mysql_result($result,$j,'name');
	$mobilephone = mysql_result($result,$j,'mobilephone');
	$phone = mysql_result($result,$j,'phone');
	$email = mysql_result($result,$j,'email');
}