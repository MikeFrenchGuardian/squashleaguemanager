<?php

function getDivSize($division,$seasonID) {
		$query = "select count(playerdiv.playerID) from playerdiv,division where  playerdiv.divisionID=division.number and division.seasonid=$seasonID and playerdiv.divisionid=$division";
		$result = mysql_query($query);
		$row = mysql_fetch_object($result);
		$name = $row->{'count(playerdiv.playerID)'};
		return $name;
}
		
function getDivPlayers($division,$seasonID,$divPosition) {
// Gets player list from selected division and season.
		$query = "select playerdiv.playerID from playerdiv,division where  playerdiv.divisionID=division.number and division.seasonid=$seasonID and playerdiv.divisionid=$division LIMIT $divPosition,1";
		$result = mysql_query($query);
		$row = mysql_fetch_object($result);
		$name = $row->playerID;
		return $name;
}

// get specified league victories
function getLeagueWins($playerID,$seasonID) {
	$query = "select count(player1) from results where seasonID = $seasonID and player1 = $playerID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'count(player1)'};
	return $name;
}

// get specified league defeats
function getLeagueLoses($playerID,$seasonID) {
	$query = "select count(player2) from results where seasonID = $seasonID and player2 = $playerID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'count(player2)'};
	return $name;
}

// get specified league games played #
function getLeagueGamesPlayed($playerID,$seasonID) {
	$won = getLeagueWins($playerID,$seasonID);
	$lost = getLeagueLoses($playerID,$seasonID);
	$played = ($won + $lost);
	return $played;
}

function getLeaguePoints($playerID,$seasonID) {
	// get winning scores
	$query = "select player1_score,player2_score from results where seasonid=$seasonID and player1=$playerID";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);

	for ($j = 0 ; $j < $rows ; ++$j)
	{
		$player1_score = mysql_result($result,$j,'player1_score');
		$player2_score = mysql_result($result,$j,'player2_score');
	
		if ($player1_score == 3 && $player2_score == 2) {
			$winPoints = 6;
		}	else if ($player1_score == 3 && $player2_score == 1) {
			$winPoints = 6;
		}	else if ($player1_score == 3 && $player2_score == 0) {
			$winPoints = 7;
		}	else if ($player1_score == 2 && $player2_score == 2) {
			$winPoints = 4;
		}	else if ($player1_score == 2 && $player2_score == 1) {
			$winPoints = 5;
		}	else if ($player1_score = 1 && $player2_score = 1) {
			$winPoints = 3;
		}	else if ($player1_score = 1 && $player2_score = 0) {
			$winPoints = 4;
		}
		$totalWinPoints = $totalWinPoints + $winPoints;
	}	

	// get losing scores
	$query2 = "select player1_score,player2_score from results where seasonid=$seasonID and player2=$playerID";
	$result2 = mysql_query($query2);
	$rows2 = mysql_num_rows($result2);

	for ($j = 0 ; $j < $rows2 ; ++$j)
	{
		$player1_score = mysql_result($result2,$j,'player1_score');
		$player2_score = mysql_result($result2,$j,'player2_score');
	
		if ($player1_score == 3 && $player2_score == 2) {
			$lossPoints = 3;
		}	else if ($player1_score == 3 && $player2_score == 1) {
			$lossPoints = 2;
		}	else if ($player1_score == 3 && $player2_score == 0) {
			$lossPoints = 1;
		}	else if ($player1_score == 2 && $player2_score == 2) {
			$lossPoints = 4;
		}	else if ($player1_score == 2 && $player2_score == 1) {
			$lossPoints = 2;
		}	else if ($player1_score = 1 && $player2_score = 1) {
			$lossPoints = 3;
		}	else if ($player1_score = 1 && $player2_score = 0) {
			$lossPoints = 1;
		}
		$totalLossPoints = $totalLossPoints + $lossPoints;
	}
	// add totals together
	return ($totalWinPoints + $totalLossPoints);
}


// Get players Name from their player ID
function getPlayerName($playerID) {
	$query = "SELECT name from player WHERE id = $playerID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);

	$name = $row->name;
	return $name;
	}
	
	
// Add result to the result table
function addResult($seasonID,$player1,$player2,$p1g1,$p1g2,$p1g3,$p1g4,$p1g5,$p2g1,$p2g2,$p2g3,$p2g4,$p2g5,$p1_score,$p2_score) {
		$query = "INSERT INTO results (seasonID,player1,player2,p1g1,p1g2,p1g3,p1g4,p1g5,p2g1,p2g2,p2g3,p2g4,p2g5,player1_score,player2_score) VALUES (\"$seasonID\",\"$player1\",\"$player2\",\"$p1g1\",\"$p1g2\",\"$p1g3\",\"$p1g4\",\"$p1g5\",\"$p2g1\",\"$p2g2\",\"$p2g3\",\"$p2g4\",\"$p2g5\",\"$p1_score\",\"$p2_score\");";
		$result = mysql_query($query);
echo "The following has been added to the database </br>" . $query;

}

function checkDuplicates($seasonID,$player1,$player2) {
	//Checks to see if the result has already been added, in which case go to match edit screen.
	$currSeason = getCurrentSeason();
	$query = "SELECT seasonID,player1,player2 FROM results where seasonID = $currSeason and ";
	
}

function sortDescending ($a, $b)
{
    if ($a['points'] == $b['points']) {
        return 0;
    }
    return ($a['points'] > $b['points']) ? -1 : 1;
}

function currentSeason() {
	$query3 = "SELECT id,startDate,endDate FROM season";
	$result = mysql_query($query3);
	$rows = mysql_num_rows($result);
	date_default_timezone_set('UTC');
	$currentDate = date('Ymd');

	for ($j = 0 ; $j < $rows ; ++$j) {
		$sDate = mysql_result($result,$j,'startDate');
		$eDate = mysql_result($result,$j,'endDate');
		$id = mysql_result($result,$j,'id');	
	
		if ( $currentDate >= $sDate && $currentDate <= $eDate) {
			return $id;
		}
	}
}


function daysLeft() {
	$seasonID = currentSeason();
	date_default_timezone_set('UTC');
	$currentDate = date('Ymd');
	$query = "SELECT id,startDate,endDate FROM season where id = " . $seasonID;
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$seasonID = $rows - 1;
	$eDate = mysql_result($result,$seasonID,'endDate');
	$daysLeft = (strtotime($eDate) - (strtotime($currentDate))) / (60 * 60 * 24);

	if ($daysLeft > 28) {
		echo $daysLeft . " days left of the current season \n";
	} else if ($daysLeft < 10) {
		echo $daysLeft . " days to go people, get those games in \n";
	} else echo $daysLeft . " days to go.";
}

function showCurrentDate() {
	date_default_timezone_set('UTC');
	$currentDate = date('Ymd');
	echo $currentDate;
}

function createNewLeagues($seasonID,$leagueNumber) {
	for ($j = 0 ; $j < $leagueNumber ; ++$j)
	{
	$query = "INSERT INTO division number,seasonID VALUES  (\"$j\",\"$seasonID\")";
	$result = mysql_query($query);
	}
}
	
function sanitizeString($var)
{
        $var = stripslashes($var);
        $var = htmlentities($var);
        $var = strip_tags($var);
        return $var;
} 
?>
