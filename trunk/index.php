<?php require_once 'includes/head.php'; ?>

<span class="text-header"><?php echo daysLeft(); ?></span><br><br> 

<?php if (is_array($feed)): ?>
<ul>
	<?php array_splice($feed,5); ?>
	<?php foreach ($feed as $item): ?>
	<li><?php echo linkify_tweet($item['desc']); ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>


<div class="blog">
<?php

// grab 5 most recent blog posts from the db
$blogquery = "SELECT id, date,subject,contents FROM blog order by id desc "; 
$blogresult = mysql_query($blogquery);
$blogrows = mysql_num_rows($blogresult);

for ($i = 0 ; $i < $blogrows ; ++$i) {
	$date = mysql_result($blogresult,$i,'date');
	$niceDate = prettyDate($date);
	$subject = mysql_result($blogresult,$i,'subject');
	$synopsis = mysql_result($blogresult,$i,'synopsis');

	echo '<span class="text-blog-header">' .$subject . '</span><br><span class="text-blog-posted"> Posted on </span><span class="text-blog-date">' . $niceDate . "</span><br>";
	echo '<span class="text-blog"> ' .$synopsis . '</span><br><br>';

} ?>
</div>

<?php require_once 'includes/footer.php'; ?>