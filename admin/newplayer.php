<?php
require_once '../includes/adminhead.php';
require_once '../login.php';
require_once '../functions.php';

if (isset($_POST['fname'])) {
?>
<span class="text-header">New Player Added</span><br><br>
<?php

if (isset($_POST['fname'])) $fname = sanitizeString($_POST['fname']);
if (isset($_POST['lname'])) $lname = sanitizeString($_POST['lname']);
if (isset($_POST['phone'])) $phone = sanitizeString($_POST['phone']);
if (isset($_POST['mobilephone'])) $mobilePhone = sanitizeString($_POST['mobilephone']);
if (isset($_POST['email'])) $email = sanitizeString($_POST['email']);

$name = $fname . ' ' . $lame;


if ( checkExistingPlayer ("$name") != 1 ) {
	createPlayer ($name, $fname, $lname, $phone, $mobilePhone, $email);
} else {
	echo "Stupid boy, this player is already here";
}




} else {
?>
<span class="text-header">Add new player</span><br><br>
<form method="post" action="newplayer.php">
<span class="text-normal">First Name: <input type="text" name="fname" size="25" maxlength="50" /><br />
Last Name: <input type="text" name="lname" size="25" maxlength="50" /><br />
Phone: <input type="text" name="phone" size="25" maxlength="50" /><br />
Mobile: <input type="text" name="mobilephone" size="25" maxlength="50" /><br />
Email: <input type="text" name="email" size="25" maxlength="50" /><br /></span>

<input type="submit" />
</form>
<?php
}
require_once '../includes/adminfooter.php';
?>