<div id="user_word_colors"></div>
<div id="user_word_map_container">
	<div id="user_word_map"></div>
</div>

<script type="text/javascript" src="<?= $site_assets ?>js/raphael.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$.oauthAjax(
	{
		oauth 		: user_data,
		url			: base_url + 'api/emoome/get_logs_user/id/<?= $this->session->userdata('user_id') ?>',
		type		: 'GET',
		dataType	: 'json',
	  	success		: function(result)
	  	{	  			
		    var paper 		= new Raphael(document.getElementById('user_word_map'), 0, 600);
			var circle_x 	= 0;
			var logs		= {}
			var circle_size	= 15;
			var canvas_width= 0;
			var type_colors	= {"E":"#d74714","I":"#142bd7","D":"#dfd20a","S":"#0aa80e","A":"#ee9700","P":"#cf00ee","M":"#ffffff","G":"#333333","U":"#d6d6d6"}
			var word_types	= {"E":"Emotional","I":"Intellectual","D":"Descriptive","S":"Sensory","A":"Action","P":"Physical","G":"Slang","M":"Moral","U":"Undecided","F":"Food","C":"Common"};

			// Group Logs
  			for (link in result.words)
  			{
   				var log_id = result.words[link].log_id;

  				if (logs[log_id] === undefined)
  				{  				
  					logs[log_id] = new Array(result.words[link].type);  								
  				}
  				else
  				{
  					logs[log_id].push(result.words[link].type);
  				}
			}

			// Loop Groups of log_id			
	  		$.each(logs, function(key, value)
	  		{ 
	  			circle_x = circle_x + 45;
				var circle_y = 0;
	  				  			
				for (type in value)
				{
					if (value[type] != 'undefined')
					{				
		  				circle_y = circle_y + 45;
						var this_type 	= value[type];
						var color 		= type_colors[this_type];
	
		  				console.log('color ' + color + ' circle_x ' + circle_x + ' circle_y ' + circle_y);
						
						paper.circle(circle_x, circle_y, circle_size).attr({fill: color, 'stroke-width': 0, 'stroke': '#c6c6c6'});
					}
				}
				
				canvas_width = canvas_width + 45;
				
				paper.setSize(canvas_width, 300)
	  		});		

			// Do Color Key
	  		for (color in type_colors)
	  		{
	  			var color_swatch = '<div class="type_swatch"><div class="color_swatch" style="background:' + type_colors[color] + '"></div>' + word_types[color] + '</div>';
	  			$('#user_word_colors').append(color_swatch);
	  		}
	  									
	  	}		
	});
});
</script>
