var NavigationView = Backbone.View.extend(
{
	initialize: function()
	{
		this.render();
	},
	render: function()
	{
		console.log('render NavigationView');
        var template = _.template($("#header_user").html(), user_data);
        this.$el.html(template);
	}
});

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




// Views
var RecordFeelingView = Backbone.View.extend(
{
    initialize: function()
    {    
		this.render();
    },
    render: function()
    {
    	console.log('inside of RecordFeelingView');
    },
    events:
    {
        "click #log_feel_next"			: "processFeeling",
        "click #log_experience_next"	: "processExperience",
        "click #log_describe_next"		: "processDescribe"
    },
    viewFeeling: function()
    {    
    	// Update Model
    	LogFeelingModel.startFeeling();
    
    	// Load View
        var template = _.template($("#record_feeling").html(), user_data);
        this.$el.html(template).hide().delay(250).fadeIn();
    },
    processFeeling: function()
    {
    	console.log('inside recordFeeling');
 		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_feeling_value',
					'rule'		: 'require', 
					'field'		: 'Feeling'
				}],
			message : 'Enter a ',
			success	: function()
			{			
				// Update Model
    			LogFeelingModel.set({
    				feeling			: $('#log_feeling_value').val(),
    				time_feeling 	: getTimeSpent(LogFeelingModel.get('time_feeling')),
    				time_experience : new Date().getTime()
    			});
		
				// Update URL & View
				Backbone.history.navigate('#/record/experience', true);		       
		    },	
			failed : function()
			{
				printUserMessage('Please enter how you feel right now');
			}
		});
    },
    viewExperience: function()
    { 
    	console.log(LogFeelingModel);
       
        var template = _.template($("#record_experience").html(), user_data);
        this.$el.html(template).hide().delay(250).fadeIn();
    },    
    processExperience: function()
    {
		$('#log_describe_this').html('"' + $('#log_val_experience').val() + '"');
	
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_experience_value',
					'rule'		: 'require', 
					'field'		: 'Experience'
				}],
			message : 'Enter a ',
			success	: function()
			{
				// Update Model
    			LogFeelingModel.set({
    				experience		: $('#log_experience_value').val(),
    				time_experience : getTimeSpent(LogFeelingModel.get('time_experience')),
    				time_describe	: new Date().getTime()
    			});

				// Update URL & View
				Backbone.history.navigate('#/record/describe', true);
			},
			failed : function()
			{
				printUserMessage('Please enter one thing you did today');
			}
		});
    },
    viewDescribe: function()
    {
    	console.log(LogFeelingModel.attributes);

        var template = _.template($("#record_describe").html(), user_data);
        this.$el.html(template).hide().delay(250).fadeIn();	  	  
    },
    processDescribe: function()
    {
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_describe_1_value',
					'rule'		: 'require', 
					'field'		: 'Describe 1'
				},{
					'selector' 	: '#log_describe_2_value',
					'rule'		: 'require',
					'field'		: 'Describe 2'
				},{
					'selector' 	: '#log_describe_3_value',
					'rule'		: 'require',
					'field'		: 'Describe 3'
				}],
			message : 'Enter a ',
			success	: function()
			{				
				// Time Data
				var log_time = 0;

				for (time in log_feeling_time)
				{
					log_time += log_feeling_time[time];
				}

				// Update Model
    			LogFeelingModel.set({
    				time_total		: log_time,
    				describe_1		: $('#log_describe_1_value').val(),
    				describe_2		: $('#log_describe_2_value').val(),
    				describe_3		: $('#log_describe_3_value').val()
    			});				
				
    			console.log(LogFeelingModel.attributes);
				
				// Save Data To API
				$.oauthAjax(
				{
					oauth 		: user_data,		
					url			: base_url + 'api/emoome/logs/create_feeling',
					type		: 'POST',
					dataType	: 'json',
					data		: LogFeelingModel.attributes,
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
								
							// Thanks Data
							var new_array = _.shuffle(messages.log_feeling_complete);
							$('#log_completion_message').html(new_array[0]);

							// Update URL & View
							Backbone.history.navigate('#/record/thanks', true); 
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
