<?php if ($this->uri->segment(4)): ?>

<h2><?= $person->name ?></h2>

<h3>Word Map</h3>
<div id="person_map"></div>
<p></p>
<?php if ($devices): ?>
<h3>Devices</h3>
<pre>
<?php print_r($devices); ?>
</pre>
<?php endif; ?>

<script type="text/javascript">
var map_data	= <?= $word_map ?>;
var total		= 0;
var percents	= '';

console.log(map_data);
 
	// Do Total
$.each(map_data, function(key, value)
{    	
	total = value + total;
});

var word_types = {"E":"Emotional","I":"Intellectual","D":"Descriptive","S":"Sensory","A":"Action","P":"Physical","U":"Undecided"};

$.each(map_data, function(key, value)
{
	var percentage = Math.round(value / total * 100);
	percents += '<h4>' + percentage + '% ' + word_types[key] + '</h4>';
});

console.log('total: ' + total);

$('#person_map').html(percents);
	
</script>


<?php else: ?>



<ul>
<?php foreach($people as $person): ?>
	<li><a href="<?= base_url().'home/emoome/people/'.$person->user_id ?>"><?= $person->name ?></a></li>
<?php endforeach; ?>
</ul>

<?php endif; ?>