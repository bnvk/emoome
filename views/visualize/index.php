<h1>Hi, <?= $this->session->userdata('name') ?></h1>

<h2>Your Language Is</h2>
<div id="person_circles"></div>

<h2>Common Feelings</h2>
<p>Feelings listed more than once</p>

<h2>Strong Experiences</h2>
<p>Experiences weighted with more than 1 of the same "type" of word</p>

<h2>Significant Words</h2>
<p>We don't know what these words mean, but you have mentioned them in your activities more than once.</p>
<p>These words might be people, places, or things you do. You can help us better understand you by flagging these words.</p>

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

			console.log('key: ' + key.charAt(0) + ' color: ' + color + ' percentage: ' + percentage + '% circle_x: ' + circle_x + ' circle_y: ' + circle_y + ' circle_size: ' + circle_size + ' circle_diameter: ' + circle_diameter);

			paper.circle(circle_x, circle_y, circle_size).attr({fill: color, 'stroke-width': 1, 'stroke': '#c3c3c3'});
			paper.text(circle_x, circle_y, percentage + '% ' + key).attr({fill: '#000000'});

			circle_x = circle_x + circle_size;
		}
	});	

});
</script>