<?php require_once 'includes/head.php'; ?>

<br><span class="text-header">League Stats</span><br><br>

<span class="text-semibold">Matches Played</span>

<?php
$seasonQuery = "select MAX(id) from season";
$seasonResult = mysql_query($seasonQuery);
$row = mysql_fetch_object($seasonResult);
$name = $row->{'MAX(id)'};
return $name;


echo $name;

?>

<?php require_once 'includes/footer.php'; ?>

