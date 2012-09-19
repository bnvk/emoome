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
		if (UserData.get('source') == 'mobile')
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
			$("#request_lightbox").delay(150).fadeOut();
		}
		else
		{
			$('#lightbox_message').addClass('lightbox_message_error');
			$("#request_lightbox").delay(2000).fadeOut();		
		}
	},
	printUserMessage: function(message)
	{
		$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
		$('#request_lightbox').delay(250).fadeIn();
		$("#request_lightbox").delay(1000).fadeOut();
	},
	closeFast: function()
	{
		$("#request_lightbox").fadeOut('fast');		
	}	
});

// Instantiate Lightbox
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
		if (UserData.get('user_id') != '')
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
        var template = _.template($("#header_public").html(), UserData.attributes);
        this.$el.html(template);		
	},
	renderLogged: function()
	{
        var template = _.template($("#header_user").html(), UserData.attributes);
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
var AuthView = Backbone.View.extend(
{
    initialize: function()
    {    
		this.render();
    },
    render: function(){},
    events:
    {
    	"click #button_login" 				: "processLogin",
    	"click #button_signup"				: "processSignup",
    	"click #button_signup_short" 		: "processSignupShort",
    	"click #button_forgot_password" 	: "processForgotPassword"
    },
    viewLogin: function()
    {
        var template = _.template($("#login").html());
        this.$el.html(template).hide().delay(250).fadeIn();	    
    },
    viewSignup: function()
    {
        var template = _.template($("#signup").html());
        this.$el.html(template).hide().delay(250).fadeIn();	    
    },
    viewForgotPassword: function()
    {
        var template = _.template($("#forgot_password").html());
        this.$el.html(template).hide().delay(250).fadeIn();
    },
	processLogin: function()
	{	
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#login_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid Email',
					'action'	: 'label'	
				},{
					'selector' 	: '#login_password', 
					'rule'		: 'require', 
					'field'		: 'Please enter your Password',
					'action'	: 'label'
				}],
			message : '',
			success	: function()
			{
				var login_data = $('#user_login').serializeArray();
				login_data.push({'name':'session','value':'1'});
				$.ajax(
				{
					url			: base_url + 'api/users/login',
					type		: 'POST',
					dataType	: 'json',
					data		: login_data,
					beforeSend	: Lightbox.requestMade('Logging You In'),					
			  		success		: function(result)
			  		{			  					  		
						// Close Loading
			  			Lightbox.requestComplete(result.message, result.status);
	  			  		
						if (result.status == 'success')
						{							
							$('[name=email]').val('');
							$('[name=password]').val('');
							
							// Update Model
							UserData.set({ logged: 'yes' });
							UserData.set(result.user);
							
							// Update Header
							var Navigation = new NavigationView({ el: $('#header') });
							Navigation.renderLogged();

							// Update URL & View
							Backbone.history.navigate('#/record/feeling', true); 
						}
				 	}
				});
			}
		});		
	},
	processSignup: function()
	{
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#signup_name', 
					'rule'		: 'require', 
					'field'		: 'Enter your name',
					'action'	: 'label'					
				},{
					'selector' 	: '#signup_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid email',
					'action'	: 'label'							
				},{
					'selector' 	: '#signup_password',
					'rule'		: 'require', 
					'field'		: 'Please enter a password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{					
				var signup_data = $('#user_signup').serializeArray();
				signup_data.push({'name':'session','value':'1'},{'name':'password_confirm','value':$('#signup_password').val()});
				$.ajax(
				{
					url			: base_url + 'api/users/signup',
					type		: 'POST',
					dataType	: 'json',
					data		: signup_data,
					beforeSend	: Lightbox.requestMade('Creating Account'),
			  		success		: function(result)
			  		{			  		
						// Close Loading
			  			Lightbox.requestComplete(result.message, result.status);	
	
						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');

							// Update Model
							UserData.set({ logged: 'yes' });
							UserData.set(result.user);
							
							// Update Header
							var Navigation = new NavigationView({ el: $('#header') });
							Navigation.renderLogged();

							// Update URL & View
							Backbone.history.navigate('#/record/feeling', true); 
						}
				 	}
				});
			}
		});		
	},
	processSignupShort: function(e)
	{
		e.preventDefault();	
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#signup_name_short', 
					'rule'		: 'require', 
					'field'		: 'Enter your name',
					'action'	: 'label'					
				},{
					'selector' 	: '#signup_email_short', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid email',
					'action'	: 'label'							
				},{
					'selector' 	: '#signup_password_short',
					'rule'		: 'require', 
					'field'		: 'Please enter a password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{					
				var signup_data = $('#user_signup_short').serializeArray();
				signup_data.push({'name':'session','value':'1'},{'name':'password_confirm','value':$('#signup_password_short').val()});
				$.ajax(
				{
					url			: base_url + 'api/users/signup',
					type		: 'POST',
					dataType	: 'json',
					data		: signup_data,
					beforeSend	: Lightbox.requestMade('Creating Account'),
			  		success		: function(result)
			  		{
						// Close Loading
			  			Lightbox.requestComplete(result.message, result.status);

						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');

							// Update Model
							UserData.set({ logged: 'yes' });
							UserData.set(result.user);
							
							// Update Header
							var Navigation = new NavigationView({ el: $('#header') });
							Navigation.renderLogged();

							// Update URL & View
							Backbone.history.navigate('#/record/feeling', true); 
						}
				 	}
				});
			}
		});
	},
	processForgotPassword: function()
	{
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#forgot_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid email',
					'action'	: 'label'							
				}],
			message : '',
			success	: function()
			{
				$.ajax(
				{
					url			: base_url + 'api/users/password_forgot',
					type		: 'POST',
					dataType	: 'json',
					data		: $('#user_forgot_password').serializeArray(),
					beforeSend	: Lightbox.requestMade('Resetting Password'),
			  		success		: function(result)
			  		{
						// Close Loading
			  			Lightbox.requestComplete(result.message, result.status);			  			

						// Update URL & View
						Backbone.history.navigate('#/login', true); 
			  		}
			  	});
			
			}
		});		
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
    displayRecordType: function(type)
    {	 
    	// Update Type
    	UserData.set({ default_feeling_type : type });

    	// Loop Types   
	    $.each(['text', 'emoticons', 'audio'], function(key, value)
	    {		
		    if (value == type)
			{
				// Show View
				$('#record_feeling_' + value).fadeIn();
			}
			else
			{
				// Hide Views
				$('#record_feeling_' + value).hide();
			}

			$('#log_feeling_use_' + value).addClass('icon_small_' + value);
	    });

	    // Do Control Buttons
	    $('div.left_control_links').removeClass('icon_small_text_select icon_small_emoticons_select icon_small_audio_select');
	    $('#log_feeling_use_' + type).removeClass('icon_small_' + type).addClass('icon_small_' +  type + '_select');
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


		// Emoticons
		var emoticons 		= '';
		var emoticons_width	= 65;
	
		$.each(core_emotions, function(key, value)
		{
			emoticons += '<div class="emoticon_item"><img data-feeling="' + value + '" src="' + base_url + 'application/modules/emoome/assets/images/emoticons-' + value + '.png"><span>' + value + '</span></div>';
			emoticons_width += 465;
		});

		$('#emoticons').html(emoticons).width(emoticons_width);


		// Show User Prefered Log Type
		if (UserData.get('default_feeling_type') == 'text')
			this.viewFeelingText();
		else if (UserData.get('default_feeling_type') == 'emoticons')
			this.viewFeelingEmoticons();
		else if (UserData.get('default_feeling_type') == 'audio')
			this.viewFeelingAudio();
    },
    viewFeelingText: function()
    {
    	// View
    	this.displayRecordType('text');
        
        // Limit Keys
		$('#log_feeling_value').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function(key)
		{		
			Lightbox.printUserMessage('Enter only a single word (no spaces or numbers)');
		});
    },
    viewFeelingEmoticons: function()
    {		
    	// View
    	this.displayRecordType('emoticons'); 
    	
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
     	// View
    	this.displayRecordType('audio');
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
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_feeling_value',
					'rule'		: 'require', 
					'field'		: 'Experience'
				}],
			message : 'Enter a ',
			success	: function()
			{
				// Save To API
				$.oauthAjax(
				{
					oauth 		: UserData,	
					url			: base_url + 'api/emoome/logs/create_feeling',
					type		: 'POST',
					dataType	: 'json',
					data		: LogFeelingModel.returnData(),
					beforeSend	: Lightbox.requestMade('Saving your feeling'),
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
				Lightbox.printUserMessage('Please enter how you feel right now');
			}			
		});	    
    },  
    viewExperience: function()
    {    
        var template = _.template($("#record_experience").html());
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
					oauth 		: UserData,	
					url			: base_url + 'api/emoome/logs/create_experience',
					type		: 'POST',
					dataType	: 'json',
					data		: LogFeelingModel.returnData(),
					beforeSend	: Lightbox.requestMade('Saving your experience'),
				  	success		: function(result)
				  	{
						// Close Loading
			  			Lightbox.requestComplete(result.message, result.status);

						// Is Saved
						if (result.status == 'success')
						{
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
    	var view_data	= { describe_this: _.shuffle(UIMessages.log_feeling_complete)[0] };
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


// Visualize Views
var VisualizeView = Backbone.View.extend(
{
	initialize: function()
	{
		this.render();		
	},
	render: function()
	{
    	var view_data	= {};
        var template	= _.template($("#visualize_index").html(), view_data);
        this.$el.html(template).hide().delay(250).fadeIn();		
	},
	doLastFive: function()
	{	
		// Create Pie Chart
		var types 			= VisualizeModel.get('last_five').types;		
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
		
		this.renderPieChart("last_five", word_values, word_percents, types_colors);
	},
	doAllTime: function()
	{	
		// Create Pie Chart
		var types 			= VisualizeModel.get('word_map');		
		var types_colors	= new Array();
		var word_values		= new Array();
		var word_percents	= new Array();
	
		// Build Data Values
		for (var type in types)
		{			
			if (type[0] != 'U')
			{
				//console.log(type[0]);
				word_values.push(types[type]);			
				word_percents.push("%% " + type);
				types_colors.push(type_colors[type[0]]);
			}
		}
	
		this.renderPieChart("all_time", word_values, word_percents, types_colors);
	},
	renderPieChart: function(element, word_values, word_percents, types_colors)
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
	},
	renderCommonLanguage: function()
	{
		$('#visualize_common').delay(750).fadeIn();
	},
	renderStrongExperiences: function()
	{		
		// Make Strong Experiences
		$strong_experiences	= $('#strong_experiences');
		
		var experience_count=0;
		
		// Loop Logs	
		for (var log in VisualizeModel.get('logs_raw'))
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
		if (UserData.get('source') != 'mobile')
		{
			$('#your_experiences').fadeIn();
		}				
	}	
	
});


// Settings Views
var SettingsView = Backbone.View.extend(
{
    initialize: function()
    {
		this.render();
    },
    render: function() {},
    events:
    {
    	"click #settings_button_notifications" 	: "processNotifications",
    	"click #settings_button_account" 		: "processAccount",
    	"click #settings_button_password" 		: "processPassword",
    	"click .settings_button_cancel"	 		: "processCancel"
    },
    viewNotifications: function()
    {
    	// Prep Template
    	var view_data	= { describe_this: LogFeelingModel.get('experience') };
        var template	= _.template($("#settings_notifications").html(), view_data);
        this.$el.html(template).hide().delay(250).fadeIn();	    
    },
    viewAccount: function()
    {    
        var template = _.template($("#settings_account").html(), UserData.attributes);
        this.$el.html(template).hide().delay(250).fadeIn();		    
    },
    viewPassword: function()
    {
        var template	= _.template($("#settings_password").html());
        this.$el.html(template).hide().delay(250).fadeIn();		    
    },    
    processNotifications: function()
    {
		var notifications_data = $('#settings_notifications').serializeArray();
		notifications_data.push({'name':'module','value':'notifications'});		

		$.oauthAjax(
		{
			oauth 		: UserData,
			url			: base_url + 'api/users/details/id/' + UserData.get('user_id'),
			type		: 'POST',
			dataType	: 'json',
			data		: notifications_data,
			beforeSend	: Lightbox.requestMade('Saving notification settings'),			
	  		success		: function(result)
	  		{
		  		Lightbox.requestComplete(result.message, result.status);
		 	}
		});
    },
    processAccount: function()
    {
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#profile_name', 
					'rule'		: 'require', 
					'field'		: 'Name is required',
					'action'	: 'label'							
				},{
					'selector' 	: '#profile_email', 
					'rule'		: 'email', 
					'field'		: 'Email is required',
					'action'	: 'label'							
				}],
			message : '',
			success	: function()
			{    	
				var account_data = $('#settings_account').serializeArray();
				account_data.push({'name':'session','value':1});		
				
				$.oauthAjax(
				{
					oauth 		: UserData,
					url			: base_url + 'api/users/modify/id/' + UserData.get('user_id'),
					type		: 'POST',
					dataType	: 'json',
					data		: account_data,
					beforeSend	: Lightbox.requestMade('Saving account changes'),			
			  		success		: function(result)
			  		{
				  		Lightbox.requestComplete(result.message, result.status);

						UserData.set(result.user);
				 	}
				});    	
			}
		});
    },
    processPassword: function()
    {
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#old_password', 
					'rule'		: 'required', 
					'field'		: 'Old Password is required',
					'action'	: 'label'							
				},{
					'selector' 	: '#new_password', 
					'rule'		: 'required', 
					'field'		: 'New Password is required',
					'action'	: 'label'							
				},{
					'selector' 	: '#new_password_confirm', 
					'rule'		: 'confirm', 
					'field'		: 'Needs to match New Password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{
				$.oauthAjax(
				{
					oauth 		: UserData,
					url			: base_url + 'api/users/password',
					type		: 'POST',
					dataType	: 'json',
					data		: $('#settings_change_password').serializeArray(),
					beforeSend	: Lightbox.requestMade('Changing your password'),
			  		success		: function(result)
			  		{
						// Close Loading
				  		Lightbox.requestComplete(result.message, result.status);
					
					 	$('#old_password').val('');
					 	$('#new_password').val('');
					 	$('#new_password_confirm').val('');
				 	}
				});
			},
			failed: function(error)
			{
				console.log(error);
			}
		});
    },    
    processLogout: function()
    {
		// Save To API
		$.oauthAjax(
		{
			oauth 		: UserData,
			url			: base_url + 'api/users/logout',
			type		: 'GET',
			dataType	: 'json',
			beforeSend	: Lightbox.requestMade('Logging you out...'),
		  	success		: function(result)
		  	{
				// Close Loading
	  			Lightbox.closeFast();

				// Update URL & View
				Backbone.history.navigate('#/logout', true); 
	  		}
	  	});	    
    },
    processCancel: function(e)
    {
		e.preventDefault();
		Backbone.history.navigate('#/settings', true); 
    }
});
