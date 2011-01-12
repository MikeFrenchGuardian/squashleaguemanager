<?php require_once 'includes/head.php';



if ($loggedIn == "false") {
	header("location:/index.php");
}

require_once 'includes/addresult.php';
require_once 'includes/footer.php'; ?>