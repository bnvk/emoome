<div id="search_container"></div>

<script type="text/javascript" src="<?= base_url() ?>js/underscore.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/backbone-min.js"></script>

<script type="text/template" id="search_controls">
	<h2 id="search_title">
		<%= title %>
		<?php
		echo form_dropdown('start_time', config_item('time_increments_hours_twelve'), $start_hour, 'id="start_time"');
		echo form_dropdown('start_meridian', config_item('time_meridian'), $start_meridian, 'id="start_meridian"');
		echo ' to ';
		echo form_dropdown('end_time', config_item('time_increments_hours_twelve'), $end_hour, 'id="end_time"');
		echo form_dropdown('end_meridian', config_item('time_meridian'), $end_meridian, 'id="end_meridian"'); 
		?>
	</h2>
	<input type="button" name="search_button" id="search_button" value="Go">
	<div id="search_visualization"></div>
</script>	

<script type="text/template" id="hour_row">
	<div id="hour_bar_<%= id %>" class="hour_bar">
		<div class="hour_bar_time"><%= display %></div>
		<div class="hour_bar_type_circles"><%= circles %></div>
		<div class="hour_bar_type_words"><%= words %></div>
		<div class="hour_bar_topics"><%= topics %></div>
	</div>		
</script>

<script type="text/javascript">
Logs = Backbone.Model.extend(
{
    defaults: {
        hours: [],
        hours_data: {}
    },
    initialize: function()
    { 
	    
    },
    addHours: function(rows)
    {
    	// Get Current Hours
        var hours_array = this.get('hours');
        var hours_data	= this.get('hours_data');
        
        // Loop Rows
		for (var row in rows)
		{ 
			// Is Row
			if (!_.isUndefined(rows[row].created_time))
			{			
				var time = rows[row].created_time.split(':');
				var hour = time[0]; 
	
				// Is New Hour
				if ($.inArray(hour, hours_array) == -1)
				{
					hours_array.push(hour);
				
					// Update Hours
					this.set({ hours: hours_array });
				
					// Update Hours Data					
				}
	        }
	    }
	},
    addHourData: function(row)  
    {

    }  
});

// Render Search
SearchBox = Backbone.View.extend(
{
    initialize: function()
    {
        this.render();
    },
    render: function()
    {    
    	// ADD SEARCH FEATURES
    	// - When Do I Feel [search], What Makes Me Feel [search]
    	// - Between (hours), Between (dates), About (enter keyword), At (location)
    	var search_data = {
	    	title: "How Do I Feel Between"
    	}
    	
    	// Load Controls
    	var search_template = _.template($('#search_controls').html(), search_data);
    	
    	// Add to HTML
    	this.$el.html(search_template);
    },
    events:
    {
        "click #search_button": "doSearch"  
    },
    doSearch: function()
    {
		// Start Time
		var start_time	= determineHourTime($('#start_time').val(), $('#start_meridian').val());
		var end_time	= determineHourTime($('#end_time').val(), $('#end_meridian').val());
	    	
	    // Search Vars
	    var search_options = {
	    	start_hour: start_time.time,
	    	end_hour: end_time.time
	    }
	    	
	    // Do Search
	    this.getHourSearch(search_options);
    },
	getHourSearch: function(options)
	{
		$.oauthAjax(
		{
			oauth 		: user_data,		
			url			: base_url + 'api/emoome/get_emotions_range/range/time/start/' + options.start_hour + '/end/' + options.end_hour,
			type		: 'GET',
			dataType	: 'json',
		  	success		: function(result)
		  	{
		  		// Yay Feelings
				if (result.status == 'success')
				{
					// Make Model
					// var logs = new Logs();
					// logs.addHours(result.emotions);
				
			  		var render_search = new ResultHours({ el: $("#search_visualization") });
			  		render_search.addHourRow(result.emotions);
				}				
				else
				{
					$('#search_visualization').append('<div id="search_visualization_none">' + result.message + '</div>');
				}
		  	}
		});
	}
});

ResultHours = Backbone.View.extend(
{
    initialize: function()
    {
        this.render();
    },
    render: function()
    {    
	    console.log('starting ResultHours');

    	// ADD SEARCH FEATURES
    	// var search_template = _.template($('#search_controls').html(), search_data);
    },
    addHourRow: function(rows)
    {
    	$.each(rows, function(key, value)
	    {	    
			var time = value.created_time.split(':');
	        var hour = time[0];

		    // Does HTML Row Exist
		    $hour_bar = $('#hour_bar_' + hour);

	    	if ($hour_bar.length == 0)
	    	{
	    		if (hour > 12)
				{
					var hour_display = parseInt(hour) - 12 + ' <span class="hour_time_meridian">PM</span>';
				}
				else if (hour == 12)
				{
					var hour_display = hour + ' <span class="hour_time_meridian">PM</span>';										
				}
				else
				{
					var hour_display = hour + ' <span class="hour_time_meridian">AM</span>';	
				}
	    	
		        var hour_data = { 
		        	id      : hour,
		        	display : hour_display,
		        	circles : '',
		        	words   : '',
		        	topics  : ''
		        };

		        var hour_item = _.template($("#hour_row").html(), hour_data);
		        
		        // Load the compiled HTML into the Backbone "el"
		        $('#search_visualization').append(hour_item);
	        }
	        else
	        {
		        console.log(hour + ' added');
	        }
	        
	        // Add Types
			var emotion		= '<div class="hour_bar_emotion" style="background-color: ' + type_colors[value.type] + '">' + value.word + '</div>';
			var bar_width	= parseInt($hour_bar.width()) + 80;
		
			// Emotions
			$hour_bar.append(emotion).width(bar_width);	
	    });
    }
});

    


function determineHourTime(time, meridian)
{
	var result = {
		time: time,
		meridian: meridian
	}

	if ((result.meridian == 'PM') && (result.time != 12))
	{
		result.time = parseInt(result.time) + 12;
	}
	else
	{
		result.time = parseInt(result.time);
	}	

	return result;
}


// When Ready
$(document).ready(function()
{
	// Instantiate Search
	new SearchBox({ el: $("#search_container") });
	
		
});
</script>