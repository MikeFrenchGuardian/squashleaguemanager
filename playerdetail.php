<?php require_once 'includes/head.php';

if ($loggedIn == "true") {		
	$member = yes;	
} else {
	$member = no;
}

$id = $_GET["id"];

$currSeasonID = getCurrentPlayerDivID($id);

$toPlayQuery = "select player.id, player.name, player.email from player,playerdiv where player.id = playerdiv.playerid and playerdiv.divisionID=$currSeasonID and player.id != $id";


$toPlayResult = mysql_query($toPlayQuery);
$toPlayRows = mysql_num_rows($toPlayResult);
?>
<br>
<span class="text-header">Your matches this league:</span><br>
<table class="league">
<tr>
   <td class="hed">Name</td>
   <td class="hed">Email</td>
</tr>
<?php
for ($i = 0 ; $i < $toPlayRows ; ++$i)
{
	
	$toPlayName = mysql_result($toPlayResult,$i,'name');
	$toPlayEmail = mysql_result($toPlayResult,$i,'email');

	echo 	'<tr>';
	echo 	'<td>' . $toPlayName . '</td>';
	if ($member == yes){
		echo 	'<td><a class="text-normal" href="mailto:" . $toPlayName . ">' . $toPlayEmail . '</td>';	
	} else {
			echo 	'<td><span class="text-normal">Requires login</span></td>';	
	}

	echo	'</tr>';
}
	echo "</table><br>";




?>

<span class="text-header">Result History:</span><br>
<table class="league">
<tr>
	<td class="hed">Season</td>
	<td class="hed">Winner</td>
	<td class="hed">Score</td>
	<td class="hed">Loser</td>
</tr>
<?php
$query = "select * from results where player1 = $id or player2 = $id";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
	$season = mysql_result($result,$j,'seasonID');
	$winner = mysql_result($result,$j,'player1');
	$loser = mysql_result($result,$j,'player2');
	$winnerName = getPlayerName($winner);
	$loserName = getPlayerName($loser);
	$p1g = mysql_result($result,$j,'player1_score');
	$p2g = mysql_result($result,$j,'player2_score');
		
echo 	'<tr>';
echo 	'<td class="text-normal">' . $season . '</td>';
if ($winner == $id){
	echo 	'<td class="text-normal-bold"><b>' . $winnerName . '</b></td>';
} else {
	echo	'<td class="text-normal">' . $winnerName . '</td>';
}

if ($p2g == "-1") {
	echo '<td class="text-normal">W/O</td>';
} else {
echo 	'<td class="text-normal">' . $p1g . " " . $p2g . '</td>';
}

if ($loser == $id){
	echo 	'<td class="text-normal"><b>' . $loserName . '</b></td>';
} else {
	echo 	'<td class="text-normal">' . $loserName . '</td>';
}

echo	'</tr>';
}
echo "</table><br>";


$wins = getWins($id);
$losses = getLosses($id);

if ($losses != 0) {
	$average = $wins/$losses*100;
	$average = round($average,2);
} else {
	$average = "Insufficient results at the moment";
}

$averagePointsPerSeason;
?>
<span class="text-header">Player Stats:</span><br>
<?php
echo "Total Wins: " . $wins . "<br>";
echo "Total Defeats: " . $losses . "<br>";
echo "Win Ratio: " . $average . "<br><br>";




// ELO Graph:
	$eloquery = "SELECT date,elo FROM elo WHERE playerid=$id";
	$eloresult = mysql_query($eloquery);
	$elorows = mysql_num_rows($eloresult);

	$eloMax = getEloMax($id);
	$eloMin = getEloMin($id);


?>

  <div id="chart"></div>

   <script type="text/javascript">
      var queryString = '';
      var dataUrl = '';

      function onLoadCallback() {
        if (dataUrl.length > 0) {
          var query = new google.visualization.Query(dataUrl);
          query.setQuery(queryString);
          query.send(handleQueryResponse);
        } else {
          var dataTable = new google.visualization.DataTable();
          dataTable.addRows(<?php echo $elorows ?>);

          dataTable.addColumn('number');
          

          
          <?php for ($k = 0; $k < $elorows; ++$k) {
          	$eloScore = mysql_result($eloresult,$k,'elo');
          	$scaled = $eloScore / 100;
          	echo "dataTable.setValue(" . $k . ", 0, ". $scaled . ");";
          }	
          ?>
       
          draw(dataTable);
        }
      }

      function draw(dataTable) {
        var vis = new google.visualization.ImageChart(document.getElementById('chart'));
        var options = {
	  chtt: 'Ranking Score Movement',
          chxl: '',
          chxp: '',
          chxr: '0,<?php echo $eloMin ?>,<?php echo $eloMax ?>,20',
          chxs: '',
          chxtc: '',
          chxt: 'y',
          chs: '300x225',
          cht: 'lc',
          chco: '3D7930',
          chd: 's:Xhiugtqi',
          chg: '14.3,-1,1,1',
          chls: '2,4,0',
          chm: 'B,C5D4B5BB,0,0,0'
        };
        vis.draw(dataTable, options);
      }

      function handleQueryResponse(response) {
        if (response.isError()) {
          alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
          return;
        }
        draw(response.getDataTable());
      }

      google.load("visualization", "1", {packages:["imagechart"]});
      google.setOnLoadCallback(onLoadCallback);

    </script>


<span class="text-header">League Movement</span><br>
Coming soon:





<?php require_once 'includes/footer.php'; ?>
<!--SHould totally have loads of cool stuff like, w/l tiebreaks, league promotion / demotion graphs -->
