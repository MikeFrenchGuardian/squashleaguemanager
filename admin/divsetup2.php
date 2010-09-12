<?php require_once '../includes/adminhead.php'; ?>

<span class="text-header">New Result added</span><br><br>

<?php

$totalPlayers = getTotalPlayers();

for ($i = 1; $i <= $totalPlayers; ++$i) {
	$playerID = $i;
	if ((isset($_GET[$i]))) {
		$div = $_GET[$i];
		echo $playerID . " and " . $div  .  "<br>";
	} else {
		echo "This player isn't in a league <br>";
	}

//	if (isset($_GET['$i'])) $div = sanitizeString($_GET['$i']);
		// put data into array
		// player and league
//		echo $playerID . " and " . $div  .  "<br>";
//		echo $div;

}

// check data against what is currently there for changes / duplicates, don't want to create multiple values for same data
// insert into database.
require_once '../includes/adminfooter.php'; ?>