<?php require_once '../includes/adminhead.php'; ?>

<span class="">Add new player</span><br><br>
<form method="post" action="newplayer.php">
<span class="text-normal">Name: <input type="text" name="name" size="25" maxlength="50" /><br />
Phone: <input type="text" name="phone" size="25" maxlength="50" /><br />
Mobile: <input type="text" name="mobilephone" size="25" maxlength="50" /><br />
Email: <input type="text" name="email" size="25" maxlength="50" /><br /></span>

<input type="submit" />
</form>

<?php require_once '../includes/adminfooter.php'; ?>