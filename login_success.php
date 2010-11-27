<?php
$ref = getenv("HTTP_REFERER"); 
session_start();
if(!session_is_registered(myusername)){
	$loggedIn = "false";
	header("location:" . $ref);
} else {
	$loggedIn = "true";
	header("location:" . $ref);
}


?>

