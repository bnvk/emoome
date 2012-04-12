<h1>Visualizing : <?= $this->session->userdata('name') ?></h1>

<h2>Your Language Type</h2>
<div id="person_circles"></div>
<p><a class="button" href="<?= base_url() ?>visualize/map">Your Map</a></p>

<h2>Common Words & Feelings</h2>
<?php foreach ($common_words as $count => $words): ?>
<div class="common_words">
	<div class="common_words_count"><?= $count ?></div>
	<div class="common_words_words">
	<?php 
	$word_count = count($words); $i = 1; $comma = ', ';
	foreach ($words as $word): 
		$i++; if ($i > $word_count) $comma = ' '; 
		echo $word.$comma;
	endforeach; ?></div>
	<div class="clear"></div>
</div>
<div class="common_words_line"></div>
<?php endforeach; ?>

<h2>Strong Experiences</h2>
<div id="strong_experiences"></div>
<p><a class="button" href="<?= base_url() ?>visualize/experiences">Your Experiences</a></p>	

<!-- Do NLP on Actions look for names of People, Places, Media
<h2>Significant Words</h2>
<p>We don't know what these words mean, but you have mentioned them in your activities more than once.</p>
<p>These words might be people, places, or things you do. You can help us better understand you by flagging these words.</p>
-->

<script type="text/javascript" src="<?= $site_assets ?>js/raphael.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var map_data	= <?= $word_map ?>;
	var total		= 0;
	var largest		= 0;
	var percents	= '';

	// Do Total (key = 'Emotional' and value = 36)
	$.each(map_data, function(key, value)
	{
		//console.log(key);
		total = value + total;
		if (value > largest) largest = value;
	});

	var loop_count		= 0;
	var circle_x		= 0;
	var circle_radius	= 100;
	var circle_margin	= 45;
	var largest_percent	= Math.round(largest / total * 100);
	var largest_diff	= circle_radius - largest_percent;
    var paper			= new Raphael(document.getElementById('person_circles'), 900, 400);

	//console.log('total: ' + total + ' largest: ' + largest + ' largest percent: ' + largest_percent);
	$.each(map_data, function(key, value)
	{
		loop_count++;
		var percentage = Math.round(value / total * 100);

		// Render Circles
		if (percentage > 0)
		{
			if (percentage == largest_percent) circle_size = circle_radius;
			else circle_size = percentage + largest_diff;
			
			var circle_diameter = circle_size * 2;

			//console.log('Loop Count: ' + loop_count);
			if (loop_count == 1)
			{
				circle_x = circle_radius;
				circle_y = circle_radius;
			}
			else if (loop_count > 1 && loop_count < 5)
			{
				circle_x = circle_x + circle_size + circle_margin;					
				circle_y = circle_radius;
			}
			else if (loop_count == 5)
			{
				circle_x = circle_size;
				circle_y = circle_radius * 3;
			}
			else
			{
				circle_x = circle_x + circle_size + circle_margin;					
				circle_y = circle_radius * 3;
			}

			var type 	= key.charAt(0);
			var color 	= type_colors[type];

			//console.log('key: ' + key.charAt(0) + ' color: ' + color + ' percentage: ' + percentage + '% circle_x: ' + circle_x + ' circle_y: ' + circle_y + ' circle_size: ' + circle_size + ' circle_diameter: ' + circle_diameter);
			paper.circle(circle_x, circle_y, circle_size).attr({fill: color, 'stroke-width': 1, 'stroke': '#c3c3c3'});
			paper.text(circle_x, circle_y, percentage + '% ' + key).attr({fill: '#000000'});
			circle_x = circle_x + circle_size;
		}
	});	
	
	
	
	// Make Strong Experiences
	var words	= <?= $word_links ?>;
	var logs_raw= <?= $logs ?>;
	var logs	= new Array();
	
	$strong_experiences	= $('#strong_experiences');

	for (var log in logs_raw)
	{
		var log_id = logs_raw[log].log_id;		
		
		if (log_id !== undefined)
		{		
			for (var type in word_types)
			{
				var type_count 	= countElementsArray(type, words[log_id]);

				if (type_count > 2)
				{
					var color	= type_colors[type];
					var size	= type_count * 10;

					$strong_experiences.append('<div class="strong_experience"><div class="strong_experience_circle" id="strong_experience_' + log_id + '"></div><div class="strong_experience_action">"' + logs_raw[log].action + '" <span class="strong_experience_date">' + mysqlDateParser(logs_raw[log].created_at).date('short') + '</span></div>' + '<div class="clear"></div></div>');

				    var paper = new Raphael(document.getElementById('strong_experience_' + log_id), 80, 80);
					paper.circle(40, 40, size).attr({fill: color, opacity: 0, 'stroke-width': 1, 'stroke': '#c3c3c3'}).animate({opacity: 1}, 1500);
				}
			}
		}
	}

});
</script>