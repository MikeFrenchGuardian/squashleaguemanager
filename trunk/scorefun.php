<?php

function getMatchScore($p1g1,$p1g2,$p1g3,$p1g4,$p1g5,$p2g1,$p2g2,$p2g3,$p2g4,$p2g5) {
	$p1MatchScore = 0;
	$p2MatchScore = 0;
	if ($p1g1 > $p2g1) {
		++$p1MatchScore;
	}	else if ($p1g1 < $p2g1) {
		++$p2MatchScore;
	}
	if ($p1g2 > $p2g2) {
		++$p1MatchScore;
	}	else if ($p1g2 < $p2g2) {
		++$p2MatchScore;
	}
	if ($p1g3 > $p2g3) {
		++$p1MatchScore;
	}	else if ($p1g3 < $p2g3) {
		++$p2MatchScore;
	}
	if ($p1g4 > $p2g4) {
		++$p1MatchScore;
	}	else if ($p1g4 < $p2g4) {
		++$p2MatchScore;
	}
	if ($p1g5 > $p2g5) {
		++$p1MatchScore;
	}	else if ($p1g5 < $p2g5) {
		++$p2MatchScore;
	}
$scores = "$p1MatchScore$p2	MatchScore";
return $scores;
}
$scores = getMatchScore(9,9,8,3,9,2,3,9,9,1);
echo $scores;

?>