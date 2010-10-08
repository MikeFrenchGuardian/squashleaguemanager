<?php require_once '../includes/adminhead.php';  

if (isset($_POST["subject"])) {

	$subject = $_POST["subject"];
	$contents = $_POST["contents"];
	$currDate = showCurrentDate();
	echo '<span class="text-header">Add a post</span><br><br>';
	addBlogPost($currDate,$subject,$contents);
	echo "Post added";
	
} else {	
?>


<span class="text-header">Add a post</span><br><br> 
<form method="post" action="blog.php">	
Subject:&nbsp; <input type="text" name="subject" /><br />
Contents: <textarea name="contents" wrap="physical" rows="10" cols="30"> </textarea> <br />
<input type="submit" value="Submit" />
</form>

<?php
}
require_once '../includes/adminfooter.php';  ?>