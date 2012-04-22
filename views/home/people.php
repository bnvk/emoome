<style type="text/css">
#person_circles	{ width: 900px; margin: 20px 0 20px 0; }
#person_map		{  }
#person_map h4	{ font-size: 14px; margin: 0 0 10px 0; }
</style>
<?php if ($this->uri->segment(4)): ?>
	<h2><?= $person->name ?></h2>
	<h3>Logged <?= $log_count ?> Items</h3>
	<p>Update: &nbsp;<a href="<?= $this->uri->segment(4) ?>" id="update_word_types">Word Types</a>, &nbsp; <a href="<?= $this->uri->segment(4) ?>" id="update_word_taxonomies">Word Use Taxonomies</a>
	<div id="person_circles"></div>
	<div id="person_map"></div>
	<p></p>
	<?php if ($devices): ?>
	<h3>Devices</h3>
	<?php foreach ($devices as $device): $device_json = json_decode($device); ?>
		<h4><?= $device_json->name ?></h4>
	<?php endforeach; endif; ?>
	<script type="text/javascript" src="<?= $this_module_assets ?>js/raphael.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		// Update Word Types
		$('#update_word_types').bind('click', function(e)
		{
			e.preventDefault();
			var user_id = $(this).attr('href');
			$.ajax(
			{
				oauth 		: user_data,		
				url			: base_url + 'api/emoome/update_user_word_maps/id/' + user_id,
				type		: 'GET',
				dataType	: 'json',
			  	success		: function(result)
			  	{							  	
					$('html, body').animate({scrollTop:0});
					$('#content_message').notify({scroll:true,status:result.status,message:result.message});									
			  	}		
			});						
		});	

	
		var map_data	= <?= $word_map ?>;
		var total		= 0;
		var largest		= 0;
		var percents	= '';
	
		// Do Total
		$.each(map_data, function(key, value)
		{
			console.log(key);
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

		console.log('total: ' + total + ' largest: ' + largest + ' largest percent: ' + largest_percent);
		
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

				console.log('Loop Count: ' + loop_count);

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

				//console.log(key + ' percentage: ' + percentage + '% circle_x: ' + circle_x + ' circle_y: ' + circle_y + ' circle_size: ' + circle_size + ' circle_diameter: ' + circle_diameter);

				paper.circle(circle_x, circle_y, circle_size).attr({fill: '#d6d6d6', 'stroke-width': 1, 'stroke': '#c6c6c6'});
				paper.text(circle_x, circle_y, percentage + '% ' + key).attr({fill: '#888888'});

				circle_x = circle_x + circle_size;

				percents += '<h4>' + percentage + '% ' + key + '</h4>';
			}
		});
				
		$('#person_map').html(percents);

	});
	</script>
<?php else: ?>
<ul>
<?php foreach($people as $person): ?>
	<li><a href="<?= base_url().'home/emoome/people/'.$person->user_id ?>"><?= $person->name ?></a></li>
<?php endforeach; ?>
</ul>

<?php endif; ?>