var ContentView = Backbone.View.extend(
{
	/* Initialize with the template-id */
	initialize: function(view)
	{
		this.view = view;
	},
	render: function()
	{
		/* Get the template content and render it into a new div-element */
		var template = $(this.view).html();
		$(this.el).html(template).hide().delay(250).fadeIn();
		return this;
	}
});



// VIEWS
LogViews = Backbone.View.extend(
{
    initialize: function()
    {    
        this.render();
    },
    render: function()
    {
    	/// Get Geo
		if (navigator.geolocation)
		{
			navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);	
		}
	
		// Get Start Time
		log_feeling_time.time_feeling = new Date().getTime();
	
		$('#log_feeling').delay(250).fadeIn('slow');  
  
  
    	//Pass variables in using Underscore.js Template
        var variables = { form_label: "^-- add a name or two or three :D" };
        
        // Compile the template using underscore
        var template = _.template($("#log_feeling").html(), variables);
        
        // Load the compiled HTML into the Backbone "el"
        this.$el.html(template);
    },
    events:
    {
        "click #log_feel_next": "recordFeeling",
        "click #log_experience_next": "recordExperience",
        "click #log_describe_next": "recordDescribe"
    },
    validator: function(params, message)
    {
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_val_feeling',
					'rule'		: 'require', 
					'field'		: 'Feeling'
				}],
			message : 'Enter a ',
			success	: function()
			{
				return true;
			},
			failed : function()
			{
				printUserMessage(message);
			}
		});
    },
    recordFeeling: function()
    {
    	console.log('inside recordFeeling');
    
    	var feeling_params = [{
			'selector' 	: '#log_val_feeling',
			'rule'		: 'require', 
			'field'		: 'Feeling'
		}];

    	var valid = this.validator(feeling_params, 'Please enter how you feel right now');
    
    	console.log(valid);
    	

		// logFeelingComplete();
		// Stamp Times
		log_feeling_time.time_feeling	= getTimeSpent(log_feeling_time.time_feeling);
		log_feeling_time.time_experience	= new Date().getTime();
	
		// jQT.goTo('#log_experience', 'slideleft');
		var variables = { form_label: "^-- add a name or two or three :D" };

        // Compile the template using underscore
        var template = _.template($("#log_experience").html(), variables);

        // Load the compiled HTML into the Backbone "el"
        this.$el.html(template).delay(500).fadeIn()
		
		// FadeIn
		//$('#log_experience_view').delay(500).fadeIn();
    },
    recordExperience: function()
    {
		$('#log_describe_this').html('"' + $('#log_val_experience').val() + '"');
	
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_val_experience',
					'rule'		: 'require', 
					'field'		: 'Experience'
				}],
			message : 'Enter a ',
			success	: function()
			{
				//logExperienceComplete();
				log_feeling_time.time_experience	= getTimeSpent(log_feeling_time.time_experience);
				log_feeling_time.time_describe	= new Date().getTime();

				//jQT.goTo('#log_experience', 'slideleft');
				$('#log_experience').fadeOut();
				$('#log_describe').delay(500).fadeIn();
			},
			failed : function()
			{
				printUserMessage('Please enter one thing you did today');
			}
		});	    
    },
    recordDescribe: function()
    {
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_val_describe_1',
					'rule'		: 'require', 
					'field'		: 'Describe 1'
				},{
					'selector' 	: '#log_val_describe_2',
					'rule'		: 'require',
					'field'		: 'Describe 2'
				},{
					'selector' 	: '#log_val_describe_3',
					'rule'		: 'require',
					'field'		: 'Describe 3'
				}],
			message : 'Enter a ',
			success	: function()
			{
				log_feeling_time.time_describe = getTimeSpent(log_feeling_time.time_describe);
			
				var log_data = $('#log_data').serializeArray();
				var log_time = 0;
	
				log_data.push({'name' : 'source', 'value' : user_data.source });
				log_data.push({'name' : 'feeling', 'value' : $('#log_val_feeling').val() });
				log_data.push({'name' : 'experience', 'value' : $('#log_val_experience').val() });
				log_data.push({'name' : 'describe_1', 'value' : $('#log_val_describe_1').val() });
				log_data.push({'name' : 'describe_2', 'value' : $('#log_val_describe_2').val() });
				log_data.push({'name' : 'describe_3', 'value' : $('#log_val_describe_3').val() });
				log_data.push({'name' : 'geo_lat', 'value' : user_data.geo_lat });
				log_data.push({'name' : 'geo_lon', 'value' : user_data.geo_lon });
	
				
				// Time Data
				for (time in log_feeling_time)
				{
					log_time += log_feeling_time[time];
					log_data.push({'name' : time, 'value' : log_feeling_time[time]});
				}
				
				log_data.push({'name' : 'time_total', 'value' : log_time});
	
				// Save Data To API
				$.oauthAjax(
				{
					oauth 		: user_data,		
					url			: base_url + 'api/emoome/logs/create_feeling',
					type		: 'POST',
					dataType	: 'json',
					data		: log_data,
					beforeSend	: requestMade('Saving your entry'),
				  	success		: function(result)
				  	{
						// Close Loading
			  			requestComplete(result.message, result.status);
						
						if (result.status == 'success')
						{
							// Clean Data & Completion
					  		$('#log_val_feeling').val('');
					  		$('#log_val_experience').val('');
					  		$('#log_val_describe_1').val('');
					  		$('#log_val_describe_2').val('');
					  		$('#log_val_describe_3').val('');
					  		$('#log_describe_this').html('');
	
							$('#log_describe').fadeOut();
							
							// Show Completion View
							var new_array = _.shuffle(messages.log_feeling_complete);
							$('#log_completion_message').html(new_array[0]);
							$('#log_thanks').delay(500).fadeIn();
						}
				  	}			  			
				});
			},
			failed : function()
			{
				printUserMessage('Please enter three words to describe what you did today');
			}
		});	    
    },
    recordThanks: function()
    {
	    
    }
});
