<h2 id="search_title">
	<!-- When Do I -->
	How Do I Feel Between
	<!-- Between (hours), Between (dates), About (enter keyword), At (location) -->
	<?php
	echo form_dropdown('start_time', config_item('time_increments_hours_twelve'), $start_hour, 'id="start_time"');
	echo form_dropdown('start_meridian', config_item('time_meridian'), $start_meridian, 'id="start_meridian"');
	echo ' to ';
	echo form_dropdown('end_time', config_item('time_increments_hours_twelve'), $end_hour, 'id="end_time"');
	echo form_dropdown('end_meridian', config_item('time_meridian'), $end_meridian, 'id="end_meridian"'); 
	?>
</h2>
<button name="search_button" id="search_button">Go</button>

<div id="visualize_feelings" data-start="" data-end=""></div>




<style type="text/css">
/* Search Controls */
#search_title 	{ float: left; }
#search_title select { position: relative; top: -7px; left: 0px; }
#start_time		{ margin: 0px 10px 0px 15px; }
#start_meridian	{ margin: 0px 15px 0px 5px; }
#end_time 		{ margin: 0px 10px 0px 15px; }
#end_meridian 	{ margin: 0px 15px 0px 5px; }
#search_button	{ float: left; margin: 2px 0px 0px 20px; }

/* Search Results */
#visualize_feelings {
	width: 100%;
	overflow: scroll;
	clear: both;
}
#visualize_feelings_none {
	width: 500px;
	font-size: 18px;
	font-style: italic;	
	color: #999999;
}

div.hour_bar {
	width: 230px;
	height: 100px;
	font-size: 18px;
	border-bottom: 1px solid #999;
	clear: both;
}
div.hour_bar_time {
	width: 80px;
	float: left;
	text-align: center;
	padding-top: 40px;
}
span.hour_time_meridian {
	font-style: italic;
	color: #999;
}
div.hour_bar_emotion {
	width: 60px;
	height: 35px;
	border: 1px solid #d9d9d9;
	text-align: center;
	padding-top: 25px;
	margin-top: 20px;
	margin-left: 20px;
	float: left;	
	border-radius: 30px;
	font-size: 11px;
	font-weight: bold;
	color: #ddd;
}
</style>
<script type="text/javascript" src="<?= base_url() ?>js/underscore.js"></script>
<script src="http://backbonejs.org/backbone-min.js"></script>

<script type="text/template" id="hour_row">
	<div id="hour_bar_<%= hour_time %>" class="hour_bar">
		<div class="hour_bar_time"><?= hour_display ?></div>
	</div>		
</script>

<script type="text/javascript">
$(document).ready(function()
{

	$('#search_button').bind('click', function(e)
	{
		// Start Time
		var start_time		= $('#start_time').val();
		var start_meridian	= $('#start_meridian').val();
		if ((start_meridian == 'PM') && ($('#start_time').val() != 12))
		{
			start_time = parseInt(start_time) + 12;
		}
		else
		{
			start_time = parseInt(start_time);
		}		
		
		// End Time
		var end_time		= $('#end_time').val();
		var end_meridian	= $('#end_meridian').val();
		if (end_meridian == 'PM')
		{
			end_time = parseInt(end_time) + 12;
		}
		


		// If One Time Value is Different
		if ((start_time != $('#visualize_feelings').data('start')) || (end_time != $('#visualize_feelings').data('end')))	
		{
			$visualize_feelings = $('#visualize_feelings');
			$visualize_feelings.html('');
			
			$.oauthAjax(
			{
				oauth 		: user_data,		
				url			: base_url + 'api/emoome/get_emotions_range/range/time/start/' + start_time + '/end/' + end_time,
				type		: 'GET',
				dataType	: 'json',
			  	success		: function(result)
			  	{
			  		// Yay Feelings
					if (result.status == 'success')
					{
						// Update Range
						$('#visualize_feelings').data('start', start_time);
						$('#visualize_feelings').data('end', end_time)

						// Hour Array
						var hour_object	= new Object;

						// Build Start Rows						
						for (i=0; end_time - start_time + 1 > i; i++)
						{							
							hour = start_time + i;
							display_hour = hour + ' ';
							
							if (hour > 12)
							{
								var time_hour = parseInt(hour) - 12;
								var display_hour = time_hour + ' <span class="hour_time_meridian">PM</span>';
							}
							else if (hour == 12)
							{
								var display_hour = hour + ' <span class="hour_time_meridian">PM</span>';										
							}
							else
							{
								var display_hour = hour + ' <span class="hour_time_meridian">AM</span>';	
							}

							// Add To Backbone
							$visualize_feelings.append('');						
						}

						console.log(result.emotions);
					
						// Loop Through Results
						$.each(result.emotions, function(key, value)
						{
							$hour_bar = $('#hour_bar_' + hour);

							var hour		= value.created_time.split(':');
							var hour 		= hour[0];
							var emotion		= '<div class="hour_bar_emotion" style="background-color: ' + type_colors[value.type] + '">' + value.word + '</div>';
							var bar_width	= parseInt($hour_bar.width()) + 80;
						
							// Emotions
							$hour_bar.width(bar_width).append(emotion);

							//console.log('hour: ' + hour + ' type: ' + value.type + ' count: ' + type_count + ' log_id: ' + value.log_id);
							
							if (hour_object[hour] == undefined)
							{
								console.log('is undefined');
								hour_object[hour] = { "type": types_count, "type_sub" : types_sub_count, "words" : "hiii"};
								hour_object[hour]["type"][value.type] = 1;
								
								console.log(value.type + ': ' + hour_object[hour]["type"][value.type])
								
							}
							else
							{
								var type_count 	= hour_object[hour]["type"][value.type];

								console.log('is DEFINED');
								hour_object[hour]["type"][value.type] = type_count + 1;
							}
							
	
						});
						
						console.log(hour_object);
						
					}
					else
					{
						$visualize_feelings.append('<div id="visualize_feelings_none">' + result.message + '</div>');
					}
			  	}		
			});
		}
	});	

});
</script>