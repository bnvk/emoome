<div id="visualize_waiting" class="content_center text_center hide">
	<h1>We are computing your emotions</h1>
	<div id="logs_needed">
		<p>You need to record</p>
		<div id="logs_needed_count"></div> 
		<p>More feelings before you can visualize</p>
	</div>
</div>

<h1 id="visualize_title" class="hide">Visualize : Your Language</h1>
<div id="visualize_language" class="hide">
	<!-- <div id="person_circles"><div class="clear"></div></div> -->

	<div id="visualize_last_five">
		<h3>Last Five Entries</h3>
		<!-- <h3>Feeling: <span id="last_five_feeling"></span></h3> -->
		<div id="last_five"></div>
	</div>

	<div id="visualize_all_time">
		<h3>All Entries</h3>
		<div id="all_time"></div>
	</div>

	<div class="clear"></div>
	<p id="your_language_map" ><a class="button" href="<?= base_url() ?>visualize/map">Your Language Map</a></p>

</div>


<div id="visualize_common" class="hide">
	<h2>Common Words & Feelings</h2>
	<?php $common_count=0; foreach ($common_words as $count => $words): if ($common_count <= 7): $common_count++; ?>
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


<!-- Do NLP on Experiences look for names of People, Places, Media
<h2>Significant Words</h2>
<p>We don't know what these words mean, but you have mentioned them in your activities more than once.</p>
<p>These words might be people, places, or things you do. You can help us better understand you by flagging these words.</p>
-->
<script type="text/javascript" src="<?= $this_module_assets ?>js/raphael.js"></script>
<script type="text/javascript" src="<?= $this_module_assets ?>js/g.raphael.js"></script>
<script type="text/javascript" src="<?= $this_module_assets ?>js/g.pie.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var word_map	= <?= $word_map ?>;
	var last_five	= <?= $last_five ?>;
	var words		= <?= $word_links ?>;
	var logs_raw	= <?= $logs ?>;
	var logs_count	= logs_raw.length;
	var logs		= new Array();
	var total		= 0;
	var largest		= 0;
	var percents	= '';

	function doWordTypes()
	{
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
	}
	

	function doLastFive()
	{
		// Detect Mood
		//var feeling = renderSentimentHuman(last_five.sentiment, 20);
		//$('#last_five_feeling').html(feeling);
	
		// Create Pie Chart
		var types 			= last_five.types;		
		var types_colors	= new Array();
		var word_values		= new Array();
		var word_percents	= new Array();
	
		// Build Data Values
		for (var type in types)
		{
			if (type != 'U')
			{
				word_values.push(types[type]);			
				word_percents.push("%% " + word_types[type]);
				types_colors.push(type_colors[type]);
			}
		}
		
		renderPieChart("last_five", word_values, word_percents, types_colors);
	}

	function doAllTime()
	{	
		// Create Pie Chart
		var types 			= word_map;		
		var types_colors	= new Array();
		var word_values		= new Array();
		var word_percents	= new Array();
	
		// Build Data Values
		for (var type in types)
		{		
			var this_type = type[0].toUpperCase();
			
			if (this_type != 'U')
			{			
				word_values.push(types[type]);			
				word_percents.push("%% " + word_types[this_type]);
				types_colors.push(type_colors[this_type]);
			}
		}
	
		renderPieChart("all_time", word_values, word_percents, types_colors);
	}	
	
	function renderPieChart(element, word_values, word_percents, types_colors)
	{
	    var r = Raphael(element, 575, 375);
	    pie = r.piechart(175, 175, 150, word_values,
	    { 
	    	colors 	 : types_colors,
	    	legend	 : word_percents,
	    	'stroke-width': 1, 'stroke': '#c3c3c3',
	    	legendpos: "east"
	    }).attr({"font": "24px 'Ralway', 'Helvetica Neue', Helvetica, Arial, Sans-Serif", "font-family": "'Ralway', 'Helvetica Neue', Helvetica, Arial, Sans-Serif", "font-size": 24, "font-weight": 100, "letter-spacing": 2});

	    pie.hover(function()
	    {	    
	        this.sector.stop();
	        this.sector.scale(1.1, 1.1, this.cx, this.cy);
	
	        if (this.label) {
	            this.label[0].stop();
	            this.label[0].attr({ r : 15 });
	        }
	    }, function() 
	    {	    
	        this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 1000, "bounce");
	
	        if (this.label)
	        {
	            this.label[0].animate({ r : 10 }, 750, "bounce");
	        }
	    });		
	
		return true;	
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
			
								$strong_experiences.append('<div class="strong_experience"><div class="strong_experience_circle" id="strong_experience_' + log_id + '"></div><div class="strong_experience_experience">"' + logs_raw[log].experience + '" <span class="strong_experience_date">' + mysqlDateParser(logs_raw[log].created_date).date('short') + '</span></div>' + '<div class="clear"></div></div>');
			
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
		
});
</script>