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
	},
    events:
    {
    	"click #button_login" 			: "processLogin",
    	"click #button_signup"			: "processSignup",
    	"click #button_signup_short" 	: "processSignupShort"
    },	
	processLogin: function(e)
	{
		e.preventDefault();
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
	processSignup: function(e)
	{
		e.preventDefault();	
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

		// Save To API
		$.oauthAjax(
		{
			oauth 		: user_data,	
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
					beforeSend	: Lightbox.requestMade('Saving your experience'),
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


// Visualize Views
var VisualizeView = Backbone.View.extend(
{
	initialize: function()
	{
		this.render();
	},
	render: function()
	{
		console.log('VisualizeView');
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
    	console.log('inside viewNotifications');

    	// Prep Template
    	var view_data	= { describe_this: LogFeelingModel.get('experience') };
        var template	= _.template($("#settings_notifications").html(), view_data);
        this.$el.html(template).hide().delay(250).fadeIn();	    
    },
    processNotifications: function(e)
    {
    	e.preventDefault(); 
    	console.log('inside processNotifications');
		var notifications_data = $('#settings_notifications').serializeArray();
		notifications_data.push({'name':'module','value':'notifications'});		

		$.oauthAjax(
		{
			oauth 		: user_data,
			url			: base_url + 'api/users/details/id/' + user_data.user_id,
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
    viewAccount: function()
    {
    	console.log('inside viewAccount');
    
        var template	= _.template($("#settings_account").html());
        this.$el.html(template).hide().delay(250).fadeIn();		    
    },
    processAccount: function(e)
    {
    	e.preventDefault();
    	console.log('inside processAccount');
		var account_data = $('#settings_account').serializeArray();
		account_data.push({'name':'session','value':1});		
		
		$.oauthAjax(
		{
			oauth 		: user_data,
			url			: base_url + 'api/users/modify/id/' + user_data.user_id,
			type		: 'POST',
			dataType	: 'json',
			data		: account_data,
			beforeSend	: Lightbox.requestMade('Saving account changes'),			
	  		success		: function(result)
	  		{
		  		Lightbox.requestComplete(result.message, result.status);
		 	}
		});    	
    },    
    viewPassword: function()
    {
    	console.log('inside viewPassword');

        var template	= _.template($("#settings_password").html());
        this.$el.html(template).hide().delay(250).fadeIn();		    
    },
    processPassword: function(e)
    {
    	console.log('inside processPassword');
		e.preventDefault();
		$.oauthAjax(
		{
			oauth 		: user_data,
			url			: base_url + 'api/users/password',
			type		: 'POST',
			dataType	: 'json',
			data		: $('#settings_change_password').serializeArray(),
			beforeSend	: Lightbox.requestMade('Changing your password'),
	  		success		: function(result)
	  		{
				// Close Loading
		  		Lightbox.requestComplete(result.message, result.status);
			
			 	$('[name=old_password]').val('');
			 	$('[name=new_password]').val('');
			 	$('[name=new_password_confirm]').val('');
		 	}
		});
    },    
    processLogout: function()
    {
		// Save To API
		$.oauthAjax(
		{
			oauth 		: user_data,
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
