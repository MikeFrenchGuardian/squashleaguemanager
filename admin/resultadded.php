<?php require_once '../includes/adminhead.php'; ?>

<span class="text-header">New Result added</span><br><br>

<?php
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



$seasonID = currentSeason();

$duplicate = checkDuplicates($player1,$player2);

echo $duplicate;

//if ($duplicate = "yes") {
//	echo "These two have already played this season, try again";
//} else {
//	echo $dup;	
//addResult($seasonID,$player1,$player2,$p1g1,$p1g2,$p1g3,$p1g4,$p1g5,$p2g1,$p2g2,$p2g3,$p2g4,$p2g5,$p1_score,$p2_score);
//}

require_once '../includes/adminfooter.php'; ?>