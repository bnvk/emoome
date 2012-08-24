<h2 id="search_title">How Do I Feel Between
	<!-- Between (hours), Between (dates), About (enter keyword), At (location) -->
	<?= form_dropdown('start_time', config_item('time_increments_hours_twelve'), date('h'), 'id="start_time"') ?>
	<?= form_dropdown('start_meridian', config_item('time_meridian'), date('A'), 'id="start_meridian"') ?>
	 to 
	<?php 
	$end_hour = date('h') + 3;
	$end_meridian = date('A');
	
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
#start_time		{ margin: 0px 5px 0px 15px; }
#start_meridian	{ margin: 0px 15px 0px 0px; }
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
	width: 220px;
	height: 100px;
	font-size: 18px;
	border-bottom: 1px solid #999;
	clear: both;
}
div.hour_bar_time {
	width: 50px;
	float: left;
	margin-right: 20px;
	padding-top: 40px;
}
div.hour_bar_emotion {
	width: 60px;
	height: 35px;
	border: 1px solid #d9d9d9;
	text-align: center;
	padding-top: 25px;
	margin-top: 20px;
	margin-right: 20px;
	float: left;	
	border-radius: 30px;
	font-size: 11px;
	font-weight: bold;
	color: #ddd;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{

	$('#search_button').bind('click', function(e)
	{
		// Start Time
		var start_time	= $('#start_time').val();
		if ($('#start_meridian').val() == 'PM')
		{
			start_time = parseInt(start_time) + 12;
		}
		
		// End Time
		var end_time 	= $('#end_time').val();
		if ($('#end_meridian').val() == 'PM')
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
					console.log(result);

					if (result.status == 'success')
					{
						$('#visualize_feelings').data('start', start_time);
						$('#visualize_feelings').data('end', end_time)
					
						var hour_array = new Array();
					
						$.each(result.emotions, function(key, value)
						{
							var hour	= value.created_time.split(':');
							var emotion	= '<div class="hour_bar_emotion" style="background-color: ' + type_colors[value.type] + '">' + value.word + '</div>';
						
							if ($.inArray(hour[0], hour_array) > -1)
							{
								$hour_bar = $('#hour_bar_' + hour[0]);
								var new_width = parseInt($hour_bar.width()) + 80;
								
								console.log('original: ' + parseInt($hour_bar.width()));
								console.log('new: ' + new_width);
								
								$hour_bar.append(emotion).width(new_width);
							}
							else
							{
								hour_array.push(hour[0]);
								$visualize_feelings.append('<div id="hour_bar_' + hour[0] + '" class="hour_bar"><div class="hour_bar_time">' + hour[0] + ':00</div>' + emotion + '</div>');
							}		
						});
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