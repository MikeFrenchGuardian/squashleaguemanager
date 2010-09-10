<?php

$league = array 
(
	[0] => array 
	(
		['player'] => 'Nick Wales',
		['leaguePoints'] => 12
	),
	[1] => array 
	(
		['player'] => 'James Balfour',
		['leaguePoints'] => 9
	),
	[2] => array 
	(
		['player'] => 'Rob Cameron',
		['leaguePoints'] => 15
	)
);

function sortDescending ($a, $b)
{
    if ($a['leaguePoints'] == $b['leaguePoints']) {
        return 0;
    }
    return ($a['leaguePoints'] > $b['leaguePoints']) ? -1 : 1;
}
usort($league, "sortDescending");
 
foreach ($league as $playa) {
    echo $playa['player'] . ": " . $playa['leaguePoints'] . "\n";
}


?>