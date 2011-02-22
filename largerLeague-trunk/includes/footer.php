</div>
<div class="login">
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px"><a href="admin" class="text-normal">&nbsp; Admin area</a></div>
<div class="menubar">
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="index.php" class="text-normal">Homepage</a><br>
	
<?php 	
$footerSeason = currentSeason();
$divCount = numLeagues($footerSeason);

if ($divCount < 5) {

	echo '<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="showleague.php" class="text-normal">Leagues</a><br>';

} else {
	$numLinks = $divCount / 5;
	echo '<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal">Leagues<br>';
	for ($i = 1; $i <= $numLinks; ++$i) {
		$end = $i * 5;
		$start =  $end - 4;
		$remainder = $numLinks % 5;
		echo '&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-normal"><a href="showleague.php?page=' . $i . '" class="text-normal">Leagues ' . $start . '-' . $end . '</a><br>';
	}
	if ($remainder != 0) {
		++$i;

		$start = $i;
		$end = ($i + $remainder) - 1;
		echo '&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-normal"><a href="showleague.php?page=' . $i . '" class="text-normal">Leagues ' . $start . '-' . $end . '</a><br>';
	}
}
?>
		

	
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="playerinfo.php" class="text-normal">Player Info</a><br>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="ranking.php" class="text-normal">Rankings</a><br>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="results.php" class="text-normal">Results</a><br>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="stats.php" class="text-normal">League Stats</a><br>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="rules.php" class="text-normal">Rules</a><br>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="http://bookings.wimbledonclub.co.uk/Web/Login.aspx" target=”_blank” class="text-normal">Book a court</a><br><br>


<?php
$ref = getenv("HTTP_REFERER"); 
session_start();
if(!session_is_registered(myusername)){
	$loggedIn = "false";
} else {
	$loggedIn = "true";

}

	
	
if ($loggedIn == "true") { ?>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="addresult.php" class="text-normal">Add result</a><br>
	<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp; <span class="text-normal"><a href="/logout.php">Logout</a><br><br>
<?php } else if ($loggedIn == "false") { ?>
	<form name="form1" method="post" action="/checklogin.php">
	<span class="text-normal">Player Login</span><br>
	<span class="text-normal">Email: &nbsp;&nbsp;&nbsp; <input name="myusername" type="text" id="myusername"><br>
	<span class="text-normal">Password: <input name="mypassword" type="password" id="mypassword"><br>
	<input type="submit" name="Submit" value="Login">
<?php } ?>

<br>
Links<br>

<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp;<a class="text-normal" href="http://wimbledonclub.co.uk/">Wimbledon Racquets</a><br>
<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp;<a class="text-normal" href="http://county.leaguemaster.co.uk">Surrey Cup</a><br>
<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp;<a class="text-normal" href="http://www.surreysra.co.uk">Surrey SRA</a><br>
<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp;<a class="text-normal" href="http://www.squashsite.co.uk">Squashsite</a><br>
<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp;<a class="text-normal" href="http://no-let.blogspot.com">no-let blog</a><br>
<img src="https://s3-eu-west-1.amazonaws.com/tomjohn/blue_arrow.png" height="8px" width="8px">&nbsp;<a class="text-normal" href="http://www.psasquashtv.com">PSA Squash TV</a><br><br>


<script type="text/javascript" src="http://cdn.widgetserver.com/syndication/subscriber/InsertWidget.js"></script><script type="text/javascript">if (WIDGETBOX) WIDGETBOX.renderWidget('2f41a594-c3d2-4984-9c01-363c10c8f62b');</script><noscript>Get the <a href="http://www.widgetbox.com/widget/squash-site-all-about-squash">Squash Site - all about Squash</a> widget and many other <a href="http://www.widgetbox.com/">great free widgets</a> at <a href="http://www.widgetbox.com">Widgetbox</a>! Not seeing a widget? (<a href="http://docs.widgetbox.com/using-widgets/installing-widgets/why-cant-i-see-my-widget/">More info</a>)</noscript>

</span></div>
<div class="divider"></div>
<div class="bottom"><span class="text-normal">&copy; Nick Wales</div>
</div> 


</script>
</body>
</html>