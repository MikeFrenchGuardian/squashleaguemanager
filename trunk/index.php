<?php require_once 'includes/head.php'; ?>
<?php
 
	$url = 'http://twitter.com/statuses/user_timeline/167934744.rss';
	$cache_expire = 3600; // in seconds
 
	$ts = time();
	$info_file = '/tmp/tmp-info.txt';
	$cache_file = '/tmp/tmp-'.$ts.'.xml';
 
	// current info
	$info = unserialize(@file_get_contents($info_file));
 
	if (empty($info) OR $ts > ($info['cache_ts']+$cache_expire))
	{
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
 
		// if a description tag is present we're OK
		if (preg_match('/<description>/iS',$content))
		{
			file_put_contents($cache_file,$content);
 
			@unlink($info['cache_file']);
		}
 
		// known error strings: "over capacity", "rate limit exceeded"
		// else if a description tag is not present something is wrong
		else
		{
			// use current cache until errors resolve itself
			$cache_file = $info['cache_file'];
 
			$content = file_get_contents($info['cache_file']);
		}
 
		// update next cache time and cache file name
		file_put_contents($info_file,serialize(array('cache_ts'=>$ts,'cache_file'=>$cache_file)));
	}
	else
	{
		$content = file_get_contents($info['cache_file']);
	}
 
	$feed = array();
 
	$doc = new DOMDocument();
	$doc->loadXML($content);
 
	foreach ($doc->getElementsByTagName('item') as $node)
	{
		array_push($feed, array 
		( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => preg_replace('/^\w+:/i','',$node->getElementsByTagName('description')->item(0)->nodeValue),
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
		));
	}
 
 
	function linkify_tweet($v)
	{
		$v = ' ' . $v;
 
		$v = preg_replace('/(^|\s)@(\w+)/', '\1@<a href="http://www.twitter.com/\2">\2</a>', $v);
		$v = preg_replace('/(^|\s)#(\w+)/', '\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>', $v);
 
		$v = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $v);
		$v = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $v);
		$v = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $v);
 
		return trim($v);
	}
 
?>

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