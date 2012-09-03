// Lightbox
var LightboxView = Backbone.View.extend(
{
	initialize: function()
	{
		this.render();
	},
	render: function()
	{
		var data     = { lightbox_message: 'Yo dog, sup?' };
        var template = _.template($("#ligthbox_template").html(), data);        
        this.$el.append(template);
	},
	requestMade: function(message)
	{	
		$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
		$('#request_lightbox').delay(250).fadeIn();
	
		// Adjust Height For Device
		if (user_data.source == 'mobile')
		{
			var new_lightbox_height = $('body').height() + 150;	
			var new_lightbox_scroll	= $(window).scrollTop() + 50;
		}
		else
		{
			var new_lightbox_height = $('body').height() + 100;
			var new_lightbox_scroll = $(window).scrollTop() + 100;
		}
	
		$('#lightbox_message').css('top', new_lightbox_scroll);
		$('#request_lightbox').height(new_lightbox_height);	
	},
	requestComplete: function(message, status)
	{
		$('#lightbox_message').html(message);
		
		if (status == 'success')
		{
			$('#lightbox_message').addClass('lightbox_message_success');
			$("#request_lightbox").delay(1500).fadeOut();
		}
		else
		{
			$('#lightbox_message').addClass('lightbox_message_error');
			$("#request_lightbox").delay(2500).fadeOut();		
		}
	},
	printUserMessage: function(message)
	{
		$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
		$('#request_lightbox').delay(250).fadeIn();
		$("#request_lightbox").delay(1500).fadeOut();
	}	
});

var Lightbox = new LightboxView({ el: $('body') });



// Header
var NavigationView = Backbone.View.extend(
{
	initialize: function()
	{
		this.render();
	},
	render: function()
	{	
		if (user_data.user_id != '')
		{
			this.renderLogged();
		}
		else
		{
			this.renderPublic();
		}
	},
	renderPublic: function()
	{
        var template = _.template($("#header_public").html(), user_data);
        this.$el.html(template);		
	},
	renderLogged: function()
	{
        var template = _.template($("#header_user").html(), user_data);
        this.$el.html(template);		
	}
});



// Generic Content
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



// Record Views
var RecordFeelingView = Backbone.View.extend(
{
    initialize: function()
    {    
		this.render();
    },
    render: function(){},
    events:
    {
    	"click #log_feeling_use_text"		: "viewFeelingText",
    	"click #log_feeling_use_emoticons"	: "viewFeelingEmoticons",
    	"click #log_feeling_use_audio"		: "viewFeelingAudio",
    	"click a.log_save_feeling"			: "processFeeling",
    	"click div.emoticon_item"			: "processFeelingEmoticons",
        "click #log_feel_next"				: "processFeelingText",
        "click #log_experience_next"		: "processExperience",
        "click #log_describe_next"			: "processDescribe"
    },
    viewFeeling: function()
    {
    	// Update Model
    	LogFeelingModel.startFeeling();

    	// GeoLocation
	    if (navigator.geolocation)
		{
			function geoSuccess(position)
			{
				LogFeelingModel.set({ geo_lat: position.coords.latitude, geo_lon: position.coords.longitude });	
			}

			navigator.geolocation.getCurrentPosition(geoSuccess);
		} 

    	// Load View
        var template = _.template($("#record_feeling").html());
        this.$el.html(template).hide().delay(250).fadeIn();


		// Build Emoticons
		var emoticons 		= '';
		var emoticons_width	= 475;
	
		$.each(core_emotions, function(key, value)
		{
			emoticons += '<div class="emoticon_item"><img data-feeling="' + value + '" src="' + base_url + 'application/modules/emoome/assets/images/emoticons-' + value + '.png"><span>' + value + '</span></div>';
			emoticons_width += 475;
		});

		$('#emoticons').html(emoticons).width(emoticons_width);

		// Show User Prefered Log Type
		this.viewFeelingText();
    },
    viewFeelingText: function()
    {
    	// Load View
    	$('#emoticon_container').hide();
    	$('#log_feeling_view').fadeIn();
    	
    	// Icon On
        //$('#log_feeling_use_text').removeClass().addClass('');
        
        // Limit Keys
		$('#log_feeling_value').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function(key)
		{		
			Lightbox.printUserMessage('Enter only a single word (no spaces or numbers)');
		});

    },
    viewFeelingEmoticons: function()
    {
    	$('#log_feeling_view').hide();
    	$('#emoticon_container').fadeIn();
    	
		// Hover Emoticon
		$('.emoticon_item').live('mouseover', function()
		{
			$(this).css('background-color', '#d6d6d6');		
		}).live('mouseleave', function()
		{
			$(this).css('background-color', '');
		});
    },
    viewFeelingAudio: function()
    {
		console.log('use AUDIO gdammit');  
    },
    processFeelingText: function()
    {    
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
    			LogFeelingModel.processFeeling($('#log_feeling_value').val());
		
				// Update URL & View
				Backbone.history.navigate('#/record/experience', true);		       
		    },	
			failed : function()
			{
				Lightbox.printUserMessage('Please enter how you feel right now');
			}
		});
    },
    processFeelingEmoticons: function(e)
    {
		// Update Model
		LogFeelingModel.processFeeling($(e.target).data('feeling'));

		// Update URL & View
		Backbone.history.navigate('#/record/experience', true);
    },
    processFeeling: function(e)
    {
	    e.preventDefault();

		// Save To API
		$.oauthAjax(
		{
			oauth 		: user_data,	
			url			: base_url + 'api/emoome/logs/create_feeling',
			type		: 'POST',
			dataType	: 'json',
			data		: LogFeelingModel.returnData(),
			beforeSend	: Lightbox.requestMade('Saving your entry'),
		  	success		: function(result)
		  	{
				// Close Loading
	  			Lightbox.requestComplete(result.message, result.status);

				// Is Saved
				if (result.status == 'success')
				{
					// Thanks Data
					$('#log_completion_message').html(_.shuffle(UIMessages.log_feeling_complete)[0]);

					// Update URL & View
					Backbone.history.navigate('#/record/thanks', true); 
				}
		  	}			  			
		});		    
    },       
    viewExperience: function()
    {
    	console.log(LogFeelingModel.attributes);
    
        var template = _.template($("#record_experience").html(), user_data);
        this.$el.html(template).hide().delay(250).fadeIn();
    },
    processExperience: function()
    {	
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
				LogFeelingModel.processExperience();

				// Update URL & View
				Backbone.history.navigate('#/record/describe', true);
			},
			failed : function()
			{
				Lightbox.printUserMessage('Please enter one thing you did today');
			}
		});
    },
    viewDescribe: function()
    {
    	var view_data	= { describe_this: LogFeelingModel.get('experience') };
        var template	= _.template($("#record_describe").html(), view_data);
        this.$el.html(template).hide().delay(250).fadeIn();

        // Limit Keys
		$('#log_describe_1_value, #log_describe_2_value, #log_describe_3_value').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function()
		{
			Lightbox.printUserMessage('Enter only a single word (no spaces or numbers)');
		});        	  	  
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
				// Update Model
				LogFeelingModel.processDescribe();

				// Save To API
				$.oauthAjax(
				{
					oauth 		: user_data,	
					url			: base_url + 'api/emoome/logs/create_experience',
					type		: 'POST',
					dataType	: 'json',
					data		: LogFeelingModel.returnData(),
					beforeSend	: Lightbox.requestMade('Saving your entry'),
				  	success		: function(result)
				  	{
						// Close Loading
			  			Lightbox.requestComplete(result.message, result.status);

						// Is Saved
						if (result.status == 'success')
						{
							// Thanks Data
							$('#log_completion_message').html(_.shuffle(UIMessages.log_feeling_complete)[0]);

							// Update URL & View
							Backbone.history.navigate('#/record/thanks', true); 
						}
				  	}			  			
				});				
			},
			failed : function()
			{
				Lightbox.printUserMessage('Please enter three words to describe what you did today');
			}
		});	    
    },
    viewThanks: function()
    {
    	// Clear Data
		this.clearInput();

    	// Prep Template
    	var view_data	= { describe_this: LogFeelingModel.get('experience') };
        var template	= _.template($("#record_thanks").html(), view_data);

        // Render
        this.$el.html(template).hide().delay(250).fadeIn();			
    },
    clearInput: function()
    {
  		this.$('#log_val_feeling').val('');
  		this.$('#log_val_experience').val('');
  		this.$('#log_val_describe_1').val('');
  		this.$('#log_val_describe_2').val('');
  		this.$('#log_val_describe_3').val('');
  		this.$('#log_describe_this').html('');
    }
});
