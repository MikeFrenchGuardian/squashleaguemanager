<?php
session_start();
if(!session_is_registered(myusername)){
header("location:index.php");
} else {
	$loggedIn = "true";
}


?>



<html>
<body>
Login Successful
</body>
</html>