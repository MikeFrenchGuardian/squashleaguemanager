<?php

	$p1Points = 0;
	$p2Points = 0;



function convert2Points($p1GameScore, $p2GameScore) {
	global $p1Points,$p2Points;
	if ($p1GameScore == 3 && $p2GameScore == 0) {
		 $p1Points = 7;
		 $p2Points = 1;
	} else if ($p1GameScore == 3 && $p2GameScore == 1) {
		 $p1Points = 6;
		 $p2Points = 2;
	} else if ($p1GameScore == 3 && $p2GameScore == 2) {
		 $p1Points = 6;
		 $p2Points = 3;
	} else if ($p1GameScore == 2 && $p2GameScore == 0) {
		 $p1Points = 5;
		 $p2Points = 1;
	} else if ($p1GameScore == 2 && $p2GameScore == 1) {
		 $p1Points = 5;
		 $p2Points = 2;
	} else if ($p1GameScore == 2 && $p2GameScore == 2) {
		 $p1Points = 4;
		 $p2Points = 4;
	} else if ($p1GameScore == 1 && $p2GameScore == 0) {
		 $p1Points = 4;
		 $p2Points = 1;
	} else if ($p1GameScore == 1 && $p2GameScore == 1) {
		 $p1Points = 3;
		 $p2Points = 3;
	} else if ($p1GameScore == 0 && $p2GameScore == 0) {
		 $p1Points = 2;
		 $p2Points = 2;
	} else if ($p2GameScore == 3 && $p1GameScore == 0) {
		 $p1Points = 7;
		 $p2Points = 1;
	} else if ($p2GameScore == 3 && $p1GameScore == 1) {
		 $p1Points = 6;
		 $p2Points = 2;
	} else if ($p2GameScore == 3 && $p1GameScore == 2) {
		 $p1Points = 6;
		 $p2Points = 3;
	} else if ($p2GameScore == 2 && $p1GameScore == 0) {
		 $p1Points = 5;
		 $p2Points = 1;
	} else if ($p2GameScore == 2 && $p1GameScore == 1) {
		 $p1Points = 5;
		 $p2Points = 2;
	} else if ($p2GameScore == 2 && $p1GameScore == 2) {
		 $p1Points = 4;
		 $p2Points = 4;
	} else if ($p2GameScore == 1 && $p1GameScore == 0) {
		 $p1Points = 4;
		 $p2Points = 1;
	} else if ($p2GameScore == 1 && $p1GameScore == 1) {
		 $p1Points = 3;
		 $p2Points = 3;
	} else if ($p2GameScore == 0 && $p1GameScore == 0) {
		 $p1Points = 2;
		 $p2Points = 2;
	} else {
		echo "wtf";
	}
//echo $p1Points . "\n";
//echo $p2Points . "\n";
}

//convert2Points($p1GameScore, $p2GameScore);
convert2Points(3,2);
echo $p1Points . "\n";
echo $p2Points . "\n";
?> 