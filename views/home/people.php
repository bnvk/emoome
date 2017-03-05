<ul>
<?php foreach($people as $person): ?>
	<li><a href="<?= base_url().'home/emoome/people/'.$person->user_id ?>"><?= $person->name ?></a></li>
<?php endforeach; ?>
</ul>
