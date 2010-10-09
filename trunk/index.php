<?php require_once 'includes/head.php'; ?>

<span class="text-header">Current League has <?php echo daysLeft(); ?></span><br><br> 

<?php if (is_array($feed)): ?>
<ul>
	<?php array_splice($feed,5); ?>
	<?php foreach ($feed as $item): ?>
	<li><?php echo linkify_tweet($item['desc']); ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>



<?php

// grab 5 most recent blog posts from the db
$blogquery = "SELECT date,subject,contents FROM blog"; 
$blogresult = mysql_query($blogquery);
$blogrows = mysql_num_rows($blogresult);

for ($i = 0 ; $i < $blogrows ; ++$i) {
	$date = mysql_result($blogresult,$i,'date');
	$niceDate = prettyDate($date);
	$subject = mysql_result($blogresult,$i,'subject');
	$contents = mysql_result($blogresult,$i,'contents');

	echo $niceDate . " " . $subject . "<br>";
	echo $contents . "<br><br>";

}


// grab most recent 5 results from the db
$query = "SELECT player1, player2, player1_score, player2_score FROM results"; // LIMIT 0,5";
$result = mysql_query($query);
$rows = mysql_num_rows($result);



$last5 = $rows-5; //not required anymore... db going the other way?!?


      
?>
<span class="text-normal">Recent Results</span><br><br>
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
echo    '<td class="text-normal">' . getPlayerName($player1) . ' ' . $p1_score . '</td>';
echo    '<td class="text-normal">' . $p2_score . ' ' . getPlayerName($player2) . '</td>';
echo    '</tr>';
}
echo "</table> <br><br>";



?>

<?php require_once 'includes/footer.php'; ?>