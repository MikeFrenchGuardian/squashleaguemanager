<?php 
require_once 'login.php';
require_once 'dbCheck.php';
require_once 'functions.php';

if (isset($_GET['player1'])) $player1 = sanitizeString($_GET['player1']);
if (isset($_GET['player2'])) $player2 = sanitizeString($_GET['player2']);
if (isset($_GET['p1score'])) $p1score = sanitizeString($_GET['p1score']);
if (isset($_GET['p2score'])) $p2score = sanitizeString($_GET['p2score']);

$p1Elo = getEloRating($player1);
$p2Elo = getEloRating($player2);

$p1name = getPlayerName($player1);
$p2name = getPlayerName($player2);


	
	$elo_calculator = new elo_calculator;
	if ($p1score == $p2score) {
        $results=$elo_calculator->rating("draw","draw",$p1Elo,$p2Elo);			
	
	} else {
        $results=$elo_calculator->rating("won","lost",$p1Elo,$p2Elo);

	}
        $R=$results;
        $p1NewEloScore = $results['R3'];
        $p2NewEloScore = $results['R4'];



updateEloRating($player1,$p1NewEloScore);
updateEloRating($player2,$p2NewEloScore);
	
echo "Result \n";
echo $p1name . ", ";
echo $p1Elo . " -> " . $p1NewEloScore . "\n";
echo $p2name . ", ";
echo $p2Elo . " -> " . $p2NewEloScore . "\n";
?>
