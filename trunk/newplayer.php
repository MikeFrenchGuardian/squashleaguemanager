<?php
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());


if (isset($_POST['name'])) $name = sanitizeString($_POST['name']);
if (isset($_POST['phone'])) $phone = sanitizeString($_POST['phone']);
if (isset($_POST['mobilephone'])) $mobilePhone = sanitizeString($_POST['mobilephone']);
if (isset($_POST['email'])) $email = sanitizeString($_POST['email']);



function sanitizeString($var)
{
	$var = stripslashes($var); 
	$var = htmlentities($var); 
	$var = strip_tags($var); 
	return $var;
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

if ( checkExistingPlayer ("$name") != 1 ) {
	createPlayer ($name, $phone, $mobilePhone, $email);
} else {
	echo "Stupid arse, this player is already here";
}

function createPlayer ($name, $phone, $mobilePhone, $email) {
	$query =  "INSERT INTO player (name,phone,mobilephone,email) VALUES (\"$name\", \"$phone\",\"$mobilePhone\", \"$email\");";
	$result = mysql_query($query);
	echo '<span class="text-normal">';
	echo $name;
	echo " added to database successfully</span>";
}

?>