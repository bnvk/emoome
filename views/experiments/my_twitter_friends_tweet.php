<h3><?= $text ?></h3>

<p>Sentiment: <?= $sentiment ?></p>

<?php if ($hashtags): ?>
<p>Talks about <?= implode($hashtags) ?></p>
<?php endif; ?>

<?php if ($urls): ?>
<p>Finds these things of interest <?= implode($urls) ?></p>
<?php endif; ?>			

<?php if ($mentions): ?>
<p>Talks with <?= implode($mentions) ?></p>
<?php endif; ?>			
<hr>