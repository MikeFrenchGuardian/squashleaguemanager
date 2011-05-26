<?php require_once 'includes/head.php'; ?>

<span class="text-header"><?php echo daysLeft(); ?></span><br><br> 

<div class="blog">
<?php

// Paging Setup

if (isset($_GET["page"])) {
	$page = ($_GET["page"]);
} else {
	$page = 1;		
}

$rowsPerPage = 9;
// counting the offset
$offset = ($page - 1) * $rowsPerPage;
$thisPageStart = $rowsPerPage * $page;




// grab 5 most recent blog posts from the db
$blogquery = "SELECT id, date,subject,synopsis,contents FROM blog order by id desc LIMIT $offset, $rowsPerPage"; 
$blogresult = mysql_query($blogquery);
$blogrows = mysql_num_rows($blogresult);


	



for ($i = 0 ; $i < $blogrows ; ++$i) {
	$id = mysql_result($blogresult,$i,'id');
	$date = mysql_result($blogresult,$i,'date');
	$niceDate = prettyDate($date);
	$subject = mysql_result($blogresult,$i,'subject');
	$synopsis = mysql_result($blogresult,$i,'synopsis');
	$contents = mysql_result($blogresult,$i,'contents');

	echo '<span class="text-blog-header">' .$subject . '</span><br><span class="text-blog-posted"> Posted on </span><span class="text-blog-date">' . $niceDate . "</span><br>";
	echo '<span class="text-blog"> ' .$synopsis . '</span><br>';
	if ($contents != "NULL") {
		echo '<span class="text-blog"><a href="blog.php?blogID=' . $id . '">Read More</a></span><br><br>';		
	}
} 
echo "</div>";

// setup paging

$prev = $page -1;
$next = $page +1;

if ($rowsPerPage == $blogrows) {
echo '<a class="text-normal" href="index.php?&page=' . $next . '">Older Posts</a>';
}
if ($page != 1) {
echo ' ';
echo '<a class="text-normal" href="index.php?&page=' . $prev . '">Newer Posts</a>';			
}

require_once 'includes/footer.php'; ?>