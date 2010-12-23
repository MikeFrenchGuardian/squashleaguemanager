<html>
<head>
<title>TomJohn League</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20394306-1']);
  _gaq.push(['_setDomainName', '.co.uk']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body class="text-normal" bgcolor="#C0C0C0" padding="0">
<?php
require_once 'login.php';
require_once 'dbCheck.php';
require_once 'functions.php';

$ref = getenv("HTTP_REFERER"); 
session_start();
if(!session_is_registered(myusername)){
	$loggedIn = "false";
} else {
	$loggedIn = "true";

}
?>
<div class="content">
<div class="cruising">
<?php 


// grab most recent 5 results from the db
$query = "SELECT player1, player2, player1_score, player2_score FROM results where player2_score != -1"; // LIMIT 0,5";
$result = mysql_query($query);
$rows = mysql_num_rows($result);



$last5 = $rows-5; //not required anymore... db going the other way?!?


      
?>
<div class="recentResults">
<span class="text-medium-header">Latest Results</span><br>
<table class="stats">
<tr>
   <td class="hed">Winner</td>
   <td class="hed">Runner-Up</td>

</tr>
<?php
for ($j = $last5 ; $j < $rows ; ++$j)
{
        $player1 = mysql_result($result,$j,'player1');
        $player2 = mysql_result($result,$j,'player2');
        $p1_score = mysql_result($result,$j,'player1_score');
        $p2_score = mysql_result($result,$j,'player2_score');


echo    '<tr>';
echo    '<td>' . getPlayerName($player1) . ' ' . $p1_score . '</td>';
echo    '<td>' . $p2_score . ' ' . getPlayerName($player2) . '</td>';
echo    '</tr>';
}
echo "</table> <br><br>";
?>
</div>

<span class="logo-white">TomJohn </span><span class="logo-red"> League</span>


	
</div>
<div class="text-area">
