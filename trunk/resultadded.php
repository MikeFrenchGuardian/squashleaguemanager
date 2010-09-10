<html>
<head>
<title>New Result</title>
</head>
<body>

<?php

require_once 'login.php';
require_once 'functions.php';
require_once 'season.php';
require_once 'leaguePoints.php';
require_once 'dbCheck.php';



if (isset($_POST['player1'])) $player1 = sanitizeString($_POST['player1']);
if (isset($_POST['player2'])) $player2 = sanitizeString($_POST['player2']);
if (isset($_POST['p1g1'])) $p1g1 = sanitizeString($_POST['p1g1']);
if (isset($_POST['p1g2'])) $p1g2 = sanitizeString($_POST['p1g2']);
if (isset($_POST['p1g3'])) $p1g3 = sanitizeString($_POST['p1g3']);
if (isset($_POST['p1g4'])) $p1g4 = sanitizeString($_POST['p1g4']);
if (isset($_POST['p1g5'])) $p1g5 = sanitizeString($_POST['p1g5']);
if (isset($_POST['p2g1'])) $p2g1 = sanitizeString($_POST['p2g1']);
if (isset($_POST['p2g2'])) $p2g2 = sanitizeString($_POST['p2g2']);
if (isset($_POST['p2g3'])) $p2g3 = sanitizeString($_POST['p2g3']);
if (isset($_POST['p2g4'])) $p2g4 = sanitizeString($_POST['p2g4']);
if (isset($_POST['p2g5'])) $p2g5 = sanitizeString($_POST['p2g5']);

function sanitizeString($var)
{
        $var = stripslashes($var);
        $var = htmlentities($var);
        $var = strip_tags($var);
        return $var;
} 


$p1_score=0;
$p2_score=0;

if ($p1g1 > $p2g1) {
	$p1_score++ ;
} else if ($p1g1 < $p2g1) {
	$p2_score++ ; 
}
if ($p1g2 > $p2g2) {
        $p1_score++ ;
} else if ($p1g2 < $p2g2) {
        $p2_score++ ; 
} 
if ($p1g3 > $p2g3) {
        $p1_score++ ;
} else if ($p1g3 < $p2g3) {
        $p2_score++ ; 
} 
if ($p1g4 > $p2g4) {
        $p1_score++ ;
} else if ($p1g4 < $p2g4) {
        $p2_score++ ; 
} 
if ($p1g5 > $p2g5) {
        $p1_score++ ;
} else if ($p1g5 < $p2g5) {
        $p2_score++ ; 
} 
//echo $p1_score . '<br>';
//echo $p2_score . '<br>';


$seasonID = currentSeason();


addResult($seasonID,$player1,$player2,$p1g1,$p1g2,$p1g3,$p1g4,$p1g5,$p2g1,$p2g2,$p2g3,$p2g4,$p2g5,$p1_score,$p2_score);
?>

</body>
</html>
