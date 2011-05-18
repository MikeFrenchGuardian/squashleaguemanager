<?php

function checkPlayer($email) {
  $query = "select email from player where email = $email";
  $result = mysql_query($query);
  $rows = mysql_num_rows($result);
  return $rows;
}

//function checkSeasonClash($seasonID) {
//  $previousSeason = $seasonID - 1;
//  $start = getSeasonStart($seasonID);
//  $end = getSeasonEnd($previousSeason);
//  if ($start > $end) {
//    echo "New season needs to start after previous";
//    }
//}



function getRequiredMatches($division,$seasonID) {
	$toPlay = getDivSize($division,$seasonID) -1;	
}

function getLastMatch() {
	$query = "select MAX(id) from results where player1=$playerID and seasonid=$seasonID or  player2=$playerID and seasonid=$seasonID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'MAX(id)'};
	
}

function getDivSize($division,$seasonID) {
	//	$query = "select playerdiv.playerID from playerdiv,division where  playerdiv.divisionID=division.number and division.seasonid=$seasonID and playerdiv.divisionid=$division";
		$query = "select playerdiv.playerid from playerdiv,division where playerdiv.divisionid = division.id and division.number = $division and division.seasonid=$seasonID";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
//		$row = mysql_fetch_object($result);
//		$name = $row->{'count(playerdiv.playerID)'};
		return $rows;
}

function numLeagues($seasonID) {
	$query = "select number from division where seasonID = $seasonID";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	return $rows;
}

	
function getDivPlayers($division,$seasonID,$divPosition) {
// Gets player list from selected division and season.
//		$query = "select playerdiv.playerID from playerdiv,division where  playerdiv.divisionID=division.number and division.seasonid=$seasonID and playerdiv.divisionid=$division LIMIT $divPosition,1";
		$query = "select playerdiv.playerid from playerdiv,division where playerdiv.divisionid = division.id and division.number = $division and division.seasonid=$seasonID LIMIT $divPosition,1";
		$result = mysql_query($query);
		$row = mysql_fetch_object($result);
		$name = $row->playerid;
		return $name;
}

//function getNonDivPlayers($division,$seasonID,$divPosition) {
//		$query = "select playerdiv.playerid from playerdiv,division where playerdiv.divisionid = division.id and division.number = $division and division.seasonid=$seasonID LIMIT $divPosition,1";
//		$result = mysql_query($query);
//		$row = mysql_fetch_object($result);
//		$name = $row->playerid;
//		return $name;
//}

function addPlayerToDiv($playerID,$divisionID,$tjRank) {
		$query = "INSERT INTO playerdiv (divisionID,playerID,tj_ranking) values ($divisionID,$playerID,$tjRank)";
		$result = mysql_query($query) or die(mysql_error());
}

function setTJRank($playerID,$divisionID,$tjRank) {
		$query = "UPDATE playerdiv set tjrank=$tjRank where playerID=$playerID";
		$result = mysql_query($query) or die(mysql_error());
}

// Cant remember why i call this now... 
function checkDivSetup($divisionID) {
		$query = "SELECT COUNT(divisionID) FROM playerdiv WHERE divisionID = $divisionID";
		$result = mysql_query($query)or die(mysql_error());
		$row = mysql_fetch_object($result);
		$name = $row->{'COUNT(divisionID)'};
		return $name;
}

//function editTomJohnRank($playerID,$divisionID) {
//	$query = INSERT INTO playerdiv (divisionID,playerID) values (
//	$query = "insert into playerdiv.tj_ranking from playerdiv,division where division.id = playerdiv.divisionID and division.seasonid = $seasonID and playerdiv.playerID = $playerID";
//	$result = mysql_query($query);
//	$row = mysql_fetch_object($result);
//	$name = $row->tj_ranking;
//	return $name;
//}

function getTomJohnRank($playerID,$seasonID) {
	$query = "select playerdiv.tj_ranking from playerdiv,division where division.id = playerdiv.divisionID and division.seasonid = $seasonID and playerdiv.playerID = $playerID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->tj_ranking;
	return $name;
}

// get specified league victories
function getLeagueWins($playerID,$seasonID) {
	$query = "select count(player1) from results where seasonID = $seasonID and player1 = $playerID and player1_score > player2_score";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'count(player1)'};
	return $name;
}

// get all league victories
function getWins($playerID) {
	$query = "select player1 from results where player1 = $playerID and player1_score > player2_score";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	return $rows;
}

// get specified league defeats
function getLeagueLoses($playerID,$seasonID) {
	$query = "select count(player2) from results where seasonID = $seasonID and player2 = $playerID and player2_score < player1_score";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'count(player2)'};
	return $name;
}

// get all league defeats
function getLosses($playerID) {
	$query = "select player2 from results where player2 = $playerID";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	return $rows;
}

function getRatio($playerID){
	$wins = getWins($playerID);
	$losses = getLosses($playerID);
	if ($losses == "0" || $wins == "0") {
		$average = "N/A";
		return $average;

	} else {
		$average = $wins/$losses*100;
		$average = round($average,2);
		return $average;
	}
}

// get specified league draws
function getLeagueDraws($playerID,$seasonID) {
	$query = "select count(player1) from results where seasonID = $seasonID and player1 = $playerID and player1_score = player2_score";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'count(player1)'};
	
	$query2 = "select count(player2) from results where seasonID = $seasonID and player2 = $playerID and player1_score = player2_score";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_object($result2);
	$name2 = $row2->{'count(player2)'};
	
	$draws = $name + $name2;
	return $draws;
}


// get player league
function getPlayerLeague($playerID,$seasonID) {
	$query = "select division.number from division,playerdiv where division.id = playerdiv.divisionid AND playerdiv.playerid= $playerID AND division.seasonid = $seasonID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->number;
	return $name;
	//return $query;
}

// get player league
function getMaxPlayerID() {
	$query = "select MAX(id) from player";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'MAX(id)'};
	return $name;
}

// get specified league games played #
function getLeagueGamesPlayed($playerID,$seasonID) {
	$won = getLeagueWins($playerID,$seasonID);
	$lost = getLeagueLoses($playerID,$seasonID);
	$drawn = getLeagueDraws($playerID,$seasonID);
	$played = ($won + $lost + $drawn);
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
		}   else if ($player1_score == 2 && $player2_score == 0) {
            $winPoints = 5;
		}	else if ($player1_score == 1 && $player2_score == 1) {
			$winPoints = 3;
		}	else if ($player1_score == 1 && $player2_score == 0) {
			$winPoints = 4;
		}	else if ($player1_score == 3 && $player2_score == -1) {
			$winPoints = 7; 
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
        }   else if ($player1_score == 2 && $player2_score == 0) {
            $lossPoints = 1;
		}	else if ($player1_score == 1 && $player2_score == 1) {
			$lossPoints = 3;
		}	else if ($player1_score == 1 && $player2_score == 0) {
			$lossPoints = 1;
		}	else if ($player1_score == 3 && $player2_score == -1) {
			$lossPoints = 0;
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

// Get players Name from their player ID
function getPlayerEmail($playerID) {
	$query = "SELECT email from player WHERE id = $playerID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->email;
	return $name;
	}

	
	
// Add result to the result table
function addResult($seasonID,$player1,$player2,$p1g1,$p1g2,$p1g3,$p1g4,$p1g5,$p2g1,$p2g2,$p2g3,$p2g4,$p2g5,$p1_score,$p2_score) {
		$query = "INSERT INTO results (seasonID,player1,player2,p1g1,p1g2,p1g3,p1g4,p1g5,p2g1,p2g2,p2g3,p2g4,p2g5,player1_score,player2_score) VALUES (\"$seasonID\",\"$player1\",\"$player2\",\"$p1g1\",\"$p1g2\",\"$p1g3\",\"$p1g4\",\"$p1g5\",\"$p2g1\",\"$p2g2\",\"$p2g3\",\"$p2g4\",\"$p2g5\",\"$p1_score\",\"$p2_score\");";
		$result = mysql_query($query);
}

// Email results to both players and the results address.
function emailMatchResult($player1,$player2,$p1score,$p2score,$p1Elo,$p2Elo,$p1NewEloScore,$p2NewEloScore) {
	$player1Name = getPlayerName($player1);
	$player2Name = getPlayerName($player2);
	$player1Email = getPlayerEmail($player1);
	$player2Email = getPlayerEmail($player2);	
	$adminEmail = "results@tomjohnleague.co.uk";
	$to  = $player1Email . "," . $player2Email . "," . $adminEmail;
	if ($p1NewEloScore == "nochange"){
		$message = "Sadly " . $player2Name . " was unable to attend, handing the points to " . $player1Name . "\n \n Check your latest position in the league http://www.tomjohnleague.co.uk/showleague.php";
	} else {
		$message = "The result of a match you have played has been added to the website \n " . $player1Name . " " . $p1score . " - " . $p2score . " " . $player2Name . "\n \n" . $player1Name . '\'s ranking score was ' . $p1Elo . " and is now " . $p1NewEloScore . "\n \n" . $player2Name . '\'s ranking score was ' . $p2Elo . " and is now " . $p2NewEloScore . "\n \n Check your latest position in the league http://www.tomjohnleague.co.uk/showleague.php";
	}
	$message = wordwrap($message, 70);
	$headers = 'From: results@tomjohnleague.co.uk' . "\r\n" .
    'Reply-To: results@tomjohnleague.co.uk' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	mail($to, 'TomJohn Result', $message, $headers);
}
	
// Add result to the result table
function addMatchResult($seasonID,$player1,$player2,$p1score,$p2score) {
		$query = "INSERT INTO results (seasonID,player1,player2,p1g1,p1g2,p1g3,p1g4,p1g5,p2g1,p2g2,p2g3,p2g4,p2g5,player1_score,player2_score) VALUES (\"$seasonID\",\"$player1\",\"$player2\",\"NA\",\"NA\",\"NA\",\"NA\",\"NA\",\"NA\",\"NA\",\"NA\",\"NA\",\"NA\",\"$p1score\",\"$p2score\");";
	$result = mysql_query($query) or die(mysql_error());
}


// Adding Results Checks
// 1. Check the result has not been added
function checkDuplicates($player1,$player2) {
	//Checks to see if the result has already been added, in which case go to match edit screen.
	$currSeason = currentSeason();
	$query = "SELECT player1,player2 FROM results where seasonID = $currSeason and (player1 = $player1 and player2 = $player2) or seasonID = $currSeason and (player1 = $player2 and player2 = $player1);";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
		if ($rows != 0) {
			$dup = "yes";
		} else {
			$dup = "no";
		}
		return $dup;	
}

// Check players are not the same

function checkPlayersAreDifferent($player1,$player2) {
	if ($player1 == $player2) {
		$dup = "yes";
	} else {
		$dup = "no";
	}
	return $dup;
}

function checkSameLeague($player1,$player2) {
	$currSeason = currentSeason();
	$p1 = getCurrentPlayerDivID($player1);
	$p2 = getCurrentPlayerDivID($player2);
	if ($p1 == $p2) {
		$sameDiv = "yes";
	} else {
		$sameDiv = "no";
	}
	return $sameDiv;
}

// 2. Check the players are not the same
function checkPlayers($player1,$player2) {
	if ($player1 == $player2) {
		$error = true;
		return $error;
	} else {
		$error = false;
	}	
}

// Sorting Functions

function sortDescending ($a, $b)
{
    if ($a['points'] == $b['points']) {
        return 0;
    }
    return ($a['points'] > $b['points']) ? -1 : 1;
}

function sortRatio ($a, $b)
{
    if ($a['ratio'] == $b['ratio']) {
        return 0;
    }
    return ($a['ratio'] > $b['ratio']) ? -1 : 1;
}

function sortPlayed ($a, $b)
{
    if ($a['played'] == $b['played']) {
        return 0;
    }
    return ($a['played'] > $b['played']) ? -1 : 1;
}

function sortWon ($a, $b)
{
    if ($a['wins'] == $b['wins']) {
        return 0;
    }
    return ($a['wins'] > $b['wins']) ? -1 : 1;
}

function sortLost ($a, $b)
{
    if ($a['losses'] == $b['losses']) {
        return 0;
    }
    return ($a['losses'] > $b['losses']) ? -1 : 1;
}

function sortRank ($a, $b)
{
    if ($a['tjrank'] == $b['tjrank']) {
        return 0;
    }
    return ($a['tjrank'] > $b['tjrank']) ? -1 : 1;
}

function sortWithTomJohn($a, $b)
{
  $retval = strnatcmp($b['points'], $a['points']);
  if($retval == "0") return strnatcmp($a['tjRank'], $b['tjRank']);
  return $retval;
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
                        break;
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

        if ($daysLeft < 1) {
        		echo "This league is finished. New one coming very soon!	 \n";
        } else if ($daysLeft < 10) {
                echo "The current league has " . $daysLeft . " days to go, get those games in! \n";
        } else if ($daysLeft > 28) {
                echo "The current league has " . $daysLeft . " days to go \n";
        } else echo $daysLeft . " days to go.";
}


function showCurrentDate() {
	date_default_timezone_set('UTC');
	$currentDate = date('Ymd');
	return $currentDate;
}

function createNewLeagues($seasonID,$leagueNumber) {
	$query = "INSERT INTO division (number,seasonID) VALUES  ($leagueNumber,$seasonID)";
	$result = mysql_query($query);
//	echo $query;
}
	
function sanitizeString($var) {
        $var = stripslashes($var);
        $var = htmlentities($var);
        $var = strip_tags($var);
        return $var;
} 

function getSeasonStart($seasonID) {
		$query = "SELECT startDate FROM season where id = $seasonID";
		$result = mysql_query($query);
		$row = mysql_fetch_object($result);
		$name = $row->startDate;
		return $name;
}

function getSeasonEnd($seasonID) {
		$query = "SELECT endDate FROM season where id = $seasonID";
		$result = mysql_query($query);
		$row = mysql_fetch_object($result);
		$name = $row->endDate;
		return $name;
}

function getSeasonID($startDate) {
		$query = "SELECT id FROM season where startdate = $startDate";
		$result = mysql_query($query);
		$row = mysql_fetch_object($result);
		$name = $row->id;
		return $name;
}

function getTotalPlayers() {
		$query = "SELECT id from player";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		return $rows;
}


function editPlayerDiv($playerID,$divisionID,$newDivisionID) {
		$query = "UPDATE playerdiv set divisionID = $newDivisionID where playerID = $playerID and divisionID = $divisionID";
		$result = mysql_query($query) or die(mysql_error());
}

function getDivisionID($seasonID,$div) {
		$query = "select id from division where number=$div and seasonid=$seasonID";
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_object($result);
		$name = $row->id;
		return $name;
}

function prettyDate($date) {
		$year = substr($date, 0,4);
		$monthNo = substr($date, 4,-2);
		$day = substr($date, 6);
		if ($monthNo == "1") {
			$month = "Jan";
		} else if ($monthNo == "2") {
			$month = "Feb";
		} else if ($monthNo == "3") {
			$month = "Mar";
		} else if ($monthNo == "4") {
			$month = "Apr";
		} else if ($monthNo == "5") {
			$month = "May";
		} else if ($monthNo == "6") {
			$month = "Jun";
		} else if ($monthNo == "7") {
			$month = "Jul";
		} else if ($monthNo == "8") {
			$month = "Aug";
		} else if ($monthNo == "9") {
			$month = "Sep";
		} else if ($monthNo == "10") {
			$month = "Oct";
		} else if ($monthNo == "11") {
			$month = "Nov";
		} else if ($monthNo == "12") {
			$month = "Dec";
		}
			
		$fullDate = $day . " " . $month . " " . $year;
		return $fullDate;
}



function checkExistingPlayer ($name) {
	$query =  "SELECT name from player";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	for ($j = 0 ; $j < $rows ; ++$j) {
		$existingNames = mysql_result($result,$j);
		if ($name == $existingNames) {
			return 1;
		} 
	}
}

function createPlayer ($name, $fname, $lname, $phone, $mobilePhone, $email) {
	$query =  "INSERT INTO player (name,fname,lname,phone,mobilephone,email,elo_score) VALUES (\"$name\",\"$fname\",\"$lname\", \"$phone\",\"$mobilePhone\", \"$email\", 1000);";
	$result = mysql_query($query) or die(mysql_error());
	echo '<span class="text-normal">';
	echo $name;
	echo " added to database successfully</span>";
}

function checkSeasonClash($startDate) {
  $query = "select endDate from season ORDER BY endDate DESC LIMIT 1";
  $result = mysql_query($query);
  $row = mysql_fetch_object($result);
		$endingDate = $row->endDate;
  if ($endingDate > $startDate) {
    return 0;
  } else {
    return 1;
  }  
}

function checkSeasonLength($startDate,$endDate) {
	if ($endDate > $startDate) {
		return 1;
	} else {
		return 0;
	}
}

function createSeason($startDate, $endDate) {
	$query = "INSERT INTO season (startDate,endDate,setup) VALUES (\"$startDate\", \"$endDate\", 0)";
	$result = mysql_query($query);	
}

function checkDivCreation($seasonID) {
	$query = "select COUNT(division.seasonID) from division,season where season.id = division.seasonID and season.id = $seasonID";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_object($result);
	$name = $row->{'COUNT(playerdiv.playerid)'};
	return $name;
}

function checkPlayerDiv($seasonID) {
	$query = "select COUNT(playerdiv.playerid) from playerdiv,division,season where season.id = division.seasonid and playerdiv.divisionid = division.id and season.id=$seasonID";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_object($result);
	$name = $row->{'COUNT(playerdiv.playerid)'};
	return $name;
}

function addBlogPost($currDate,$subject,$synopsis,$contents) {
	$query = "insert into blog (date,subject,synopsis,contents) values ('$currDate', '$subject', '$synopsis',  '$contents');";
	$result = mysql_query($query) or die(mysql_error());
	}

function editBlogPost($blogID,$subject,$synopsis,$contents) {
	$query = ("update blog set subject='$subject', synopsis='$synopsis', contents='$contents' where id='$blogID'");
	$result = mysql_query($query) or die(mysql_error());

}

function getBlogPost($id) {
	$query = "select date,subject,synopsis,contents from blog where id = $id";
	$result = mysql_query($query);

}

function getBlogCount() {
	$query = "select count(id) from blog";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'count(id)'};
	return $name;
}

function getCurrentPlayerDivID($playerID) {
	$season = currentSeason();	
	$query = "select playerdiv.divisionID from playerdiv,division where division.id = playerdiv.divisionid and division.seasonid = $season and  playerid=$playerID";	
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->divisionID;
	return $name;
}

class elo_calculator
{ public function rating($S1,$S2,$R1,$R2)
  { if (empty($S1) OR empty($S2) OR empty($R1) OR empty($R2)) return null;
    if ($S1!=$S2) { if ($S1>$S2) { $E=30-round(1/(1+pow(10,(($R2-$R1)/400)))*30); $R['R3']=$R1+$E; $R['R4']=$R2-$E; }
                            else { $E=30-round(1/(1+pow(10,(($R1-$R2)/400)))*30); $R['R3']=$R1-$E; $R['R4']=$R2+$E; }}
             else { if ($R1==$R2) { $R['R3']=$R1; $R['R4']=$R2; }
                             else { if($R1>$R2) { $E=(30-round(1/(1+pow(10,(($R1-$R2)/400)))*30))-(30-round(1/(1+pow(10,(($R2-$R1)/400)))*30)); $R['R3']=$R1-$E; $R['R4']=$R2+$E; }
                                           else { $E=(30-round(1/(1+pow(10,(($R2-$R1)/400)))*30))-(30-round(1/(1+pow(10,(($R1-$R2)/400)))*30)); $R['R3']=$R1+$E; $R['R4']=$R2-$E; }}}
    $R['S1']=$S1; $R['S2']=$S2; $R['R1']=$R1; $R['R2']=$R2;
    $R['P1']=((($R['R3']-$R['R1'])>0)?"+".($R['R3']-$R['R1']):($R['R3']-$R['R1']));
    $R['P2']=((($R['R4']-$R['R2'])>0)?"+".($R['R4']-$R['R2']):($R['R4']-$R['R2']));
    return $R; }}

function getEloRating($playerID) {
	//$query = "select elo_score from player where id = $playerID";
	$query = "select elo from elo where playerID=$playerID ORDER BY id DESC LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->elo;
	return $name;
}

function getElo($playerID) {
	$query = "select id,elo from elo where playerid = $playerID ORDER BY id DESC limit 0,1";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->elo;
	return $name;
}

function updateEloRating($playerID,$newEloScore) {
        $query = "update player set elo_score='$newEloScore' where id='$playerID'";
        $result = mysql_query($query) or die(mysql_error());
}

function updateElo($playerID,$newEloScore) {
		$currDate = showCurrentDate();
		$query = "INSERT INTO elo (date,playerID,elo) values ($currDate,$playerID,$newEloScore)";
		$result = mysql_query($query) or die(mysql_error());
}

function getGamesWon($playerID, $seasonID) {
	$query = "select SUM(player1_score) from results where seasonId=$seasonID and player1=$playerID";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_object($result);
	$name = $row->{'SUM(player1_score)'};
	$query2 = "select SUM(player2_score) from results where seasonId=$seasonID and player2=$playerID";
	$result2 = mysql_query($query2) or die(mysql_error());
	$row2 = mysql_fetch_object($result2);
	$name2 = $row2->{'SUM(player2_score)'};
	$total = $name + $name2;
	return $total;
}
	
function getGamesLost($playerID, $seasonID) {
	$query = "select SUM(player1_score) from results where seasonId=$seasonID and player2=$playerID";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_object($result);
	$name = $row->{'SUM(player1_score)'};
	$query2 = "select SUM(player2_score) from results where seasonId=$seasonID and player1=$playerID";
	$result2 = mysql_query($query2) or die(mysql_error());
	$row2 = mysql_fetch_object($result2);
	$name2 = $row2->{'SUM(player2_score)'};
	$total = $name + $name2;
	return $total;
}
	
function terminatorScore($playerID, $seasonID) {
	$won = getGamesWon($playerID, $seasonID);
	$lost = getGamesLost($playerID, $seasonID);	
	$terminator	= $won - $lost;
	return $terminator;
}	

function getSeasonCount() {
	$query = "select COUNT(id) from season";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'COUNT(id)'};
	return $name;
}

function getEloMax($playerID){
$eloMaxquery = "SELECT MAX(elo) FROM elo WHERE playerid=$playerID";
	$eloMaxresult = mysql_query($eloMaxquery);
	$eloMaxRow = mysql_fetch_object($eloMaxresult);
	$eloMax = $eloMaxRow->{'MAX(elo)'};
	return $eloMax;
}

function getEloMin($playerID){
	$eloMinquery = "SELECT MIN(elo) FROM elo WHERE playerid=$playerID";
	$eloMinresult = mysql_query($eloMinquery);
	$eloMinRow = mysql_fetch_object($eloMinresult);
	$eloMin = $eloMinRow->{'MIN(elo)'};
	return $eloMin;
}

function lockSeason($seasonID) {
	$query = "UPDATE season SET setup = 1 where id = $seasonID";
	$result = mysql_query($query) or die(mysql_error());
}

function seasonMatchCount($seasonID) {
	$query = "select COUNT(id) from results where seasonid=$seasonID";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'COUNT(id)'};
	return $name;
}

function getMaxSeasonID() {
	$query = "select MAX(id) from season";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'MAX(id)'};
	return $name;
}

function getTotalLeaguePlayers($seasonID) {
	$query = "select COUNT()";
}
function getEnvironment() {
	$query = "select env from environment";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$env = $row->env;
	return $env;
}

function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function getCurrentDivNum($id) {
	$divisionID = getCurrentPlayerDivID($id);
	$query = "select number from division where id = $divisionID";
//	$query = "select MAX(division.number) from division,playerdiv where playerdiv.divisionid = division.id and  playerdiv.playerid=25";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$name = $row->{'number'};
	return $name;
}
?>
