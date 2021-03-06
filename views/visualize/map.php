<h1>Visualize : Language Map</h1>

<div id="user_word_container">
	<div id="user_word_map"><div id="user_word_colors"></div></div>
	<div class="clear"></div>
</div>

<script type="text/javascript" src="<?= $this_module_assets ?>js/raphael.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$.oauthAjax(
	{
		oauth 		: user_data,
		url			: base_url + 'api/emoome/logs/user/id/' + user_data.user_id,
		type		: 'GET',
		dataType	: 'json',
	  	success		: function(result)
	  	{	  			
			var circle_x 	= 0;
			var circle_y	= 0;
			var circle_size	= 10;
			var height		= 40;
			var logs		= {}
			var words		= {}
			var canvas_width= 0;
			var color_height= {};

			// Group Words By Logs
  			for (link in result.words)
  			{
  				if (words[result.words[link].log_id] === undefined)
  				{			
  					words[result.words[link].log_id] = new Array(result.words[link].type);  								
  				}
  				else
  				{
  					words[result.words[link].log_id].push(result.words[link].type);
  				}
			}

			// Group Logs
  			for (log in result.logs)
  			{
  				logs[result.logs[log].log_id] = {"created_date":result.logs[log].created_date,"experience":result.logs[log].experience};
			}

			// Do Color Key
	  		for (color in type_colors)
	  		{
	  			// Dont Show Undecided
	  			if (color != 'U')
	  			{
	  				var color_swatch = '<div class="type_swatch"><div class="color_swatch" style="background:' + type_colors[color] + '"></div>' + word_types[color] + '</div>';
	  				$('#user_word_colors').append(color_swatch);
	  			}
	  		}	  		
	  		
	  		// Do Color Height
	  		for (type in word_types)
	  		{	
				color_height[type] = height;
				height = height + 100;
			}
			
			$word_map_container = $('#user_word_map');
			var set_width = 80 -125;

			// Loop Groups of Types			
	  		$.each(words, function(log_id, value)
	  		{	  		
	  			circle_x = circle_x + 40;			

				if (log_id !== 'undefined')
				{
					// Make Container
					set_width = set_width + 80;
					
					if (jQuery.inArray('U', value) < 0)
					{
						$word_map_container.append('<div class="word_map_column" data-experience="' + logs[log_id].experience + '" data-created_date="' + logs[log_id].created_date + '" id="word_map_column_' + log_id + '"></div>').width(set_width);
		
						// Make Paper
					    var paper = new Raphael(document.getElementById('word_map_column_' + log_id), 80, 700);
						
			  			// Do 4 Types
						for (type in word_types)
						{	
							if (type != 'U')
							{	
								var color 		= type_colors[type];
								var circle_y	= color_height[type];
								var size 		= circle_size * countElementsArray(type, value);
								
								if (size > 0)
								{
									//console.log(log_id + ' type: ' + type + ' color: ' + color + ' size: ' + size + ' circle_x: ' + circle_x + ' circle_y: ' + circle_y);						
									paper.circle(40, circle_y, size).attr({fill: color, opacity: 0, 'stroke-width': 1, 'stroke': '#c3c3c3'}).animate({opacity: 1}, 1500);				        
								}
							}
						}
					}
				}
	  		});
	
	  		// Size Containers
	  		var new_width = $('#user_word_map').width() + 180;
	  		$('#user_word_map').width(new_width);


			// Do ToolTips
			$('.word_map_column').qtip({
				content: {
					text: function(api) {
						return $(this).data('experience') + ' <span>' + mysqlDateParser($(this).data('created_date')).date('short') + '</span>';
					}
				},
				position: {
					my: 'top left',
					target: 'mouse',
					viewport: $(window), // Keep it on-screen at all times if possible
					adjust: {
						x: 10,  y: 10
					}
				},
				hide: {
					fixed: true // Helps to prevent the tooltip from hiding ocassionally when tracking!-
				},
				style: {
					classes: 'ui-tooltip-tipsy'
				}				
			});
	  	}		
	});
});
</script>
