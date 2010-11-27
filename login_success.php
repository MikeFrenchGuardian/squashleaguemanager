<?php
session_start();
if(!session_is_registered(myusername)){
	$loggedIn = "false";
} else {
	$loggedIn = "true";
}


?>

