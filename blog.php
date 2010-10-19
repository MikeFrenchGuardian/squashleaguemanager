<?php require_once 'includes/head.php'; 

$blogID = $_GET['blogID'];


?>
<div class="blog">
<?php

// grab 5 most recent blog posts from the db
$blogquery = "SELECT id, date,subject,synopsis,contents FROM blog where id= $blogID"; 
$blogresult = mysql_query($blogquery);
//$blogrows = mysql_num_rows($blogresult);

//	$date = mysql_result($blogresult,'date');
//	$niceDate = prettyDate($date);
//	$subject = mysql_result($blogresult,'subject');
//	$contents = mysql_result($blogresult,'contents');

	$blogrow = mysql_fetch_object($blogresult);
	$blogdate = $blogrow->date;
	$niceDate = prettyDate($blogdate);
	$blogsubject = $blogrow->subject;
	$blogsynopsis = $blogrow->synopsis;
	$blogcontent = $blogrow->contents;




	
	echo '<span class="text-blog-header">' . $blogsubject . '</span><br><span class="text-blog-posted"> Posted on </span><span class="text-blog-date">' . $niceDate . "</span><br>";
	echo '<span class="text-blog"> ' .$blogsynopsis . '<br><br>' .$blogcontent . '</span><br><br>';

 ?>
</div>

<?php require_once 'includes/footer.php'; ?>