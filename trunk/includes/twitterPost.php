<?php
$consumerKey    = '1XjVDsxhid6RGC2L87iOw';
$consumerSecret = '3D9GIbIEfiKqSMDzHTunAPJ0Cb3jGMpxTGJ5SBKXcZQ';
$oAuthToken     = '167934744-nQHj7SI2fmR9kKgp0xPgqxKThzo3b8E5Zm57LtXh';
$oAuthSecret    = 'w151Vhz4TQ5cMaCGEeJPZyeHfw13X4PgvIek4UXhzk';
 
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/twitter/twitteroauth.php');
 
// create a new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
 
//send a tweet
$tweet->post('statuses/update', array('status' => 'Hello World'));
?>