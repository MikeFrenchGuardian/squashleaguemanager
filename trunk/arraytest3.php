<?php

$league = array
(
    "player1" => array
        (
            "player" => 'Nick Wales',
            "leaguePoints"     => 12
        ),
    "player2" => array
        (
            "player" => 'James Balfour',
            "leaguePoints"     => 9
        ),
    "player3" => array
        (
            "player" => 'Rob Cameron',
            "leaguePoints"     => 15
        ),
        
);


function sortDescending ($a, $b)
{
    if ($a['leaguePoints'] == $b['leaguePoints']) {
        return 0;
    }
    return ($a['leaguePoints'] > $b['leaguePoints']) ? -1 : 1;
}
usort($league, "sortDescending");
 
foreach ($league as $position) {
    echo $position['player'] . ": " . $position['leaguePoints'] . "\n";
}
?>