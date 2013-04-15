<h1>@<?= $person ?>'s</h1>
<?php 
$language_count = array_sum($language);
$topics_count	= array_sum($topics);
$significant_count = $language_count + $topics_count;
?>
<p>Of 200 Tweets <strong><?= round($significant_count / $words_total, 2) * 100 ?>% are significant</strong> and not common words, hashtags, or mentions (<?= $significant_count ?> significant / <?= $words_total ?> total)</p>

<h3>Language - <?= $language_count ?></h3>
<?php foreach ($language as $key => $count): ?>
	<strong><?= round($count / $language_count, 2) * 100 ?>%</strong> - <?= $count ?> <?= $key ?> words<br>
<?php endforeach; ?>

<hr>

<h3>Topics - <?= $topics_count ?></h3>
<?php foreach ($topics as $key => $count): 
	$percent = round($count / $topics_count, 2) * 100;
	if ($percent > 0):
?>
	<strong><?= $percent ?>%</strong> <?= $key ?><br>
<?php endif; endforeach; ?>

<hr>

<?= $tweets ?>