<?php require_once '../includes/adminhead.php';  

if (isset($_POST["posted"])) {

	$subject = $_POST["subject"];
	$contents = $_POST["contents"];
	$currDate = showCurrentDate();
	echo '<span class="text-header">Add a post</span><br><br>';
	addBlogPost($currDate,$subject,$contents);
	echo "Post added";
	
} else if (isset($_POST["edited"])) {

	$blogID = $_POST['blogID'];
	$subject = $_POST['subject'];
	$contents = $_POST['contents'];
	$currDate = showCurrentDate();
	echo '<span class="text-header">Post Edited</span><br><br>';
	editBlogPost($blogID,$subject,$contents);
	echo "Post edited";
	
} else if (isset($_GET["editlist"])) { ?>
	<span class="text-header">Edit a post</span><br><br>

<?php
	$blogNo = getBlogCount();
	$query = "select id,date,subject from blog";
	$result = mysql_query($query);
	echo "Choose Post to Edit<br><br>";
	
	for ( $j = 0 ; $j < $blogNo ; ++$j ) {
		  $id = mysql_result($result,$j,'id');
		  $date = mysql_result($result,$j,'date');
		  $subject = mysql_result($result,$j,'subject');
		  $niceDate = prettyDate($date);
		  
		  echo '<a class="text-normal" href="blog.php?editpost=yes&postNo=' . $id .'">' . $niceDate . ': </a> <a class="text-normal" href="/admin/blog.php?editpost=yes&postNo=' . $id .'">'  . $subject .'</a><br><br>'; 	
	}

} else if (isset($_GET["editpost"])) { 
	
	$blogID = $_GET['postNo'];
	$getBlogQuery = "select subject,contents from blog where id= $blogID";
	$getBlogResult = mysql_query($getBlogQuery);

	$getBlogRow = mysql_fetch_object($getBlogResult);
	$subject = $getBlogRow->subject;
	$synopsis = $getBlogRow->synopsis;
	$contents = $getBlogRow->contents;
	?>


<span class="text-header">Edit a post</span><br><br>
<form method="post" action="blog.php">	
Subject:&nbsp; <input type="text" name="subject" value="<?php echo $subject ?>" /><br />
Synopsis: <textarea name="contents" wrap="physical" rows="10" cols="30"><?php echo $synopsis ?> </textarea> <br />
Contents: <textarea name="contents" wrap="physical" rows="10" cols="30"><?php echo $contents ?> </textarea> <br />
<input type="hidden" name="blogID" value="<?php echo $blogID ?>">
<input type="hidden" name="edited" value="yes">
<input type="submit" value="Submit" />

</form>
<?php
} else {
?>
<span class="text-header">Add a post</span><br><br> 
<form method="post" action="blog.php">	
Subject:&nbsp; <input type="text" name="subject" /><br />
Synopsis: <textarea name="synopsis" wrap="physical" rows="10" cols="30"> </textarea> <br />
Contents: <textarea name="contents" wrap="physical" rows="10" cols="30"> </textarea> <br />
<input type="hidden" name="posted" value="yes">
<input type="submit" value="Submit" />

</form>

<?php
}
require_once '../includes/adminfooter.php';  ?>