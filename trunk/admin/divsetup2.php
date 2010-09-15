<?php require_once '../includes/adminhead.php'; ?>

<span class="text-header">Players Added</span><br><br>

<?php
$seasonID="4";

$totalPlayers = getTotalPlayers();

for ($i = 1; $i <= $totalPlayers; ++$i) {
	$playerID = $i;
	if ((isset($_GET[$i]))) {
		$div = $_GET[$i];
		$name = getPlayerName($playerID);
		$divisionID = getDivisionID($seasonID,$div);

		echo "<br>" . $name . " was added to division " . $div ."<br>";
		addPlayerToDiv($playerID,$divisionID);
	} else {
		echo "This player isn't in a league <br>";
	}

}

// check data against what is currently there for changes / duplicates, don't want to create multiple values for same data
// insert into database.
require_once '../includes/adminfooter.php'; ?>