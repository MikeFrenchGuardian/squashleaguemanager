<?php
$consumerKey    = 'MmLpCfZryJpziDQrP6v2fA';
$consumerSecret = 'r1JnVOv0fqpKWf85PYy7NqIeujLlso7Rz77dMBz0GJM';
$oAuthToken     = '304956678-t1zBhgd9WPsLt2iPziMtMJUky7N67At8sBJOLVtE';
$oAuthSecret    = 'S1Y9hkH9Sx9HOvXHzFDpceX1JyNZjKveaWmUl0QaMQ';
 
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/twitter/twitteroauth.php');
 
// create a new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
 
//send a tweet
$tweet->post('statuses/update', array('status' => 'Hello World'));
?>