<h1>Map : <?= $this->session->userdata('name') ?></h1>

<div id="user_word_colors"></div>
<div id="user_word_map_container">
	<div id="user_word_map_dates"></div>
	<div id="user_word_map"></div>
</div>
<div class="clear"></div>

<script type="text/javascript" src="<?= $site_assets ?>js/raphael.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	function countElementsArray(item, array)
	{
	    var count = 0;
	    $.each(array, function(i,v) { if (v === item) count++; });
	    return count;
	}


	$.oauthAjax(
	{
		oauth 		: user_data,
		url			: base_url + 'api/emoome/get_logs_user/id/<?= $this->uri->segment(4) //$this->session->userdata('user_id') ?>',
		type		: 'GET',
		dataType	: 'json',
	  	success		: function(result)
	  	{	  			
		    var paper 		= new Raphael(document.getElementById('user_word_map'), 0, 1100);
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
  				logs[result.logs[log].log_id] = {"created_at":result.logs[log].created_at,"action":result.logs[log].action};
			}

			// Do Color Key
	  		for (color in type_colors)
	  		{
	  			var color_swatch = '<div class="type_swatch"><div class="color_swatch" style="background:' + type_colors[color] + '"></div>' + word_types[color] + '</div>';
	  			$('#user_word_colors').append(color_swatch);
	  		}	  		
	  		
	  		// Do Color Height
	  		for (type in word_types)
	  		{	
				color_height[type] = height;
				height = height + 100;
			}
			
			$date_row = $('#user_word_map_dates');

			// Loop Groups of Types			
	  		$.each(words, function(log_id, value)
	  		{	  		
	  			circle_x = circle_x + 40;			
				
	  			// Do 4 Types	
				for (type in word_types)
				{					
					var color 		= type_colors[type];
					var circle_y	= color_height[type];
					var size 		= circle_size * countElementsArray(type, value);
					
					if (size > 0)
					{
						//console.log(log_id + ' type: ' + type + ' color: ' + color + ' size: ' + size + ' circle_x: ' + circle_x + ' circle_y: ' + circle_y);
					
						paper.circle(circle_x, circle_y, size).attr({fill: color, opacity: 0, 'stroke-width': 1, 'stroke': '#c3c3c3'})
							.animate({opacity: 1}, 1500)
							.hover(function() {
								
															
								
					         })					        
					        
					}
	  				// circle_y = circle_y + 40;
				}
				
				canvas_width = canvas_width + 40;
				paper.setSize(canvas_width, 700)
	  		});						
	  	}		
	});
});
</script>