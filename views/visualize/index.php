<div id="visualize_waiting" class="content_center text_center hide">
	<h1>We are computing your emotions</h1>
	<div id="logs_needed">
		<p>You need to record</p>
		<div id="logs_needed_count"></div> 
		<p>More feelings before you can visualize</p>
	</div>
</div>

<h1 id="visualize_title" class="hide">Visualize</h1>
<div id="visualize_language" class="hide">
	<h2>Your Language</h2>
	<div id="person_circles"><div class="clear"></div></div>
	<p id="your_language_map" class="hide"><a class="button" href="<?= base_url() ?>visualize/map">Your Language Map</a></p>
</div>

<div id="visualize_common" class="hide">
	<h2>Common Words & Feelings</h2>
	<?php $common_count=0; foreach ($common_words as $count => $words): if ($common_count <= 6): $common_count++; ?>
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
	<?php endif; endforeach; ?>
</div>

<div id="visualize_experiences" class="hide">
	<h2>Strong Experiences</h2>
	<div id="strong_experiences"></div>
	<p id="your_experiences" class="hide"><a class="button" href="<?= base_url() ?>visualize/experiences">Your Experiences</a></p>	
</div>


<!-- Do NLP on Actions look for names of People, Places, Media
<h2>Significant Words</h2>
<p>We don't know what these words mean, but you have mentioned them in your activities more than once.</p>
<p>These words might be people, places, or things you do. You can help us better understand you by flagging these words.</p>
-->

<script type="text/javascript" src="<?= $this_module_assets ?>js/raphael.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var word_map	= <?= $word_map ?>;
	var words		= <?= $word_links ?>;
	var logs_raw	= <?= $logs ?>;
	var logs_count	= logs_raw.length;
	var logs		= new Array();
	var total		= 0;
	var largest		= 0;
	var percents	= '';

	function doWordTypes()
	{
		// Do Total (key = 'Emotional' and value = 36)
		$.each(word_map, function(key, value)
		{
			total = value + total;
			if (value > largest) largest = value;
		});
	
		var circle_x		= 0;
		var circle_radius	= visualization_sizes[user_data.source].circle_word_types;
		var circle_margin	= 45;
		var largest_percent	= Math.round(largest / total * 100);
		var largest_diff	= circle_radius - largest_percent;
		
		$person_circles = $('#person_circles');
	
		$.each(word_map, function(key, value)
		{
	  		// Dont Show Undecided
			if (key.charAt(0) != 'U')
			{		
				var percentage = Math.round(value / total * 100);
			
				// Render Circles
				if (percentage > 0)
				{
					var type 	= key.charAt(0);
					var color 	= type_colors[type];
				
					if (percentage == largest_percent) size = circle_radius;
					else size = percentage + largest_diff;
					
					var diameter = size * 2;	
					
					var circle_x = size;					
					var circle_y = size;
					
					$person_circles.prepend('<div class="person_circles_circle" id="person_circle_' + type + '" style="width:' + diameter + 'px;"><p>' + percentage + '% ' + key + '</p></div>');
		
					var paper = new Raphael(document.getElementById('person_circle_' + type), diameter, diameter);
		
					paper.circle(circle_x, circle_y, size).attr({fill: color, 'stroke-width': 1, 'stroke': '#c3c3c3'});
				}
			}
		});
		
		$('#visualize_language').delay(500).fadeIn();	
		
		// Show Map Link (if not Mobile)
		if (user_data.source != 'mobile')
		{
			$('#your_language_map').fadeIn();
		}
	}

	
	function doCommonLanguage()
	{
		$('#visualize_common').delay(750).fadeIn();
	}
	

	function doStrongExperiences()
	{		
		// Make Strong Experiences
		$strong_experiences	= $('#strong_experiences');
		
		var experience_count=0;
		
		// Loop Logs	
		for (var log in logs_raw)
		{
			// Limit Experiences Shown
			if (experience_count < 10)
			{
				var log_id = logs_raw[log].log_id;		
				
				if (log_id !== undefined)
				{		
					for (var type in word_types)
					{		
						// Dont Show Undecided
						if (type != 'U')
						{
							var type_count 	= countElementsArray(type, words[log_id]);
			
							if (type_count > 2)
							{
								var color	= type_colors[type];
								var size	= type_count * visualization_sizes[user_data.source].circle_strong_experiences;
								var svg_size= 8 * visualization_sizes[user_data.source].circle_strong_experiences;
								var position= svg_size / 2;
			
								$strong_experiences.append('<div class="strong_experience"><div class="strong_experience_circle" id="strong_experience_' + log_id + '"></div><div class="strong_experience_action">"' + logs_raw[log].action + '" <span class="strong_experience_date">' + mysqlDateParser(logs_raw[log].created_at).date('short') + '</span></div>' + '<div class="clear"></div></div>');
			
							    var paper = new Raphael(document.getElementById('strong_experience_' + log_id), svg_size, svg_size);
								paper.circle(position, position, size).attr({fill: color, opacity: 0, 'stroke-width': 1, 'stroke': '#c3c3c3'}).animate({opacity: 1}, 1500);
							
								experience_count++;
							}
						}
					}
					
				}
			}
		}

		$('#visualize_experiences').delay(1000).fadeIn();
		
		// Show Experience Link (if not Mobile)
		if (user_data.source != 'mobile')
		{
			$('#your_experiences').fadeIn();
		}				
	}
	
	
	// Display Title
	if (logs_count > 5 && user_data.source != 'mobile')
	{
		$('#visualize_title').fadeIn();
	}

	// Display Visualizations by log_count
	if (logs_count < 5)
	{
		$('#logs_needed_count').html(5 - logs_count);
		$('#visualize_waiting').fadeIn('slow');
	}
	else if (logs_count < 10)
	{
		doWordTypes();
	}
	else if (logs_count < 15)
	{
		doWordTypes();
		doCommonLanguage();
	}
	else
	{
		doWordTypes();
		doCommonLanguage();
		doStrongExperiences();
	}
});
</script>