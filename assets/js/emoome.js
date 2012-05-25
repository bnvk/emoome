/* Author: Brennan Novak */

/* Global Values */
var type_colors		= {"E":"#ff0000","I":"#142bd7","D":"#dfd20a","S":"#0aa80e","A":"#ee9700","P":"#cf00ee","U":"#c3c3c3"}
var word_types		= {"E":"Emotional","I":"Intellectual","D":"Descriptive","S":"Sensory","A":"Action","P":"Physical","U":"Undecided"};
var word_types_sub	= {"M":"Moral","S":"Slang","P":"Perception","Y":"Psychological","L":"Feeling","F":"Food","C":"Common","U":"Undecided"}
var speech_types	= {"V":"Verb","N":"Noun","P":"Pro Noun","A":"Adjective","D":"Adverb","R":"Prepositon","C":"Conjunction","I":"Interjection"};

/* User Messages */
var messages = {
	"log_feeling_complete" : [
		"Every entry helps us build your emotional map",
		"We suggest logging 1-3 entries per day",
		"Try logging entries at different times of the day",
		"The best entries are when you feel something strongly",
		"If something is hard to describe it is a good entry",
		"The best entries are moments that seem important",
		"Had an intense experience? Log an entry for later analysis"
	]
}

/* Data Objects */
var log_feeling_time = {
	time_feeling : '',
	time_action : '',
	time_describe : ''
}

/* General Functions */
function requestMade(message)
{	
	$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
	$('#request_lightbox').delay(250).fadeIn();

	//BORKED MOBILE DEVICE HIEGHT DETECTION
	var new_lightbox_height = $('body').height();
	var new_lightbox_scroll	= $(window).scrollTop() + 100;

	// console.log('window: ' + $(window).height() + ' body: ' + $('body').height() + ' new ' + new_lightbox_height + ' scroll: ' + new_lightbox_scroll);
	$('#lightbox_message').css('top', new_lightbox_scroll);
	$('#request_lightbox').height(new_lightbox_height);

	return false;
}

function requestComplete(message, status)
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
	
	return false;
}

function printUserMessage(message)
{
	$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
	$('#request_lightbox').delay(250).fadeIn();
	$("#request_lightbox").delay(1500).fadeOut();

	//$('#content_message').notify({status:'success',message:message});
}


/* Log - Feeling */
function logFeelingStart()
{
	/// Get Geo
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);	
	}

	// Get Start Time
	log_feeling_time.time_feeling = new Date().getTime();

	$('#log_feeling').delay(250).fadeIn('slow');
}


function logFeeling()
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
			logFeelingComplete();
		},
		failed : function()
		{
			printUserMessage('Please enter how you feel right now');
		}
	});
}

function logFeelingComplete()
{
	// Stamp Times
	log_feeling_time.time_feeling	= getTimeSpent(log_feeling_time.time_feeling);
	log_feeling_time.time_action	= new Date().getTime();

	//jQT.goTo('#log_action', 'slideleft');
	$('#log_feeling').fadeOut();
	$('#log_action').delay(500).fadeIn();
}

function logAction()
{
	// Set Action
	$('#log_describe_this').html('"' + $('#log_val_action').val() + '"');

	$.validator(
	{
		elements :
			[{
				'selector' 	: '#log_val_action',
				'rule'		: 'require', 
				'field'		: 'Action'
			}],
		message : 'Enter a ',
		success	: function()
		{
			logActionComplete();
		},
		failed : function()
		{
			printUserMessage('Please enter one thing you did today');
		}
	});
}

function logActionComplete()
{
	// Get Start Time
	log_feeling_time.time_action	= getTimeSpent(log_feeling_time.time_action);
	log_feeling_time.time_describe	= new Date().getTime();

	//jQT.goTo('#log_action', 'slideleft');
	$('#log_action').fadeOut();
	$('#log_describe').delay(500).fadeIn();

}

function logDescribe()
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
			log_data.push({'name' : 'action', 'value' : $('#log_val_action').val() });
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
				url			: base_url + 'api/emoome/log_feeling',
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
				  		$('#log_val_action').val('');
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
}

function logThanks()
{
	//jQT.goTo('#log_action', 'slideleft');
	$('#log_thanks').fadeOut();
	logFeelingStart();
}



/* Utility Functions */
function countElementsArray(item, array)
{
    var count = 0;
	if (array !== undefined)
	{
    	$.each(array, function(i,v) { if (v === item) count++; });
   	}

    return count;
}

function getTimeSpent(start_time)
{
	now_time = new Date().getTime();	
	return now_time - start_time;
}

	
/* Geo Location */
function showPosition(position)
{	
	user_data.geo_lat = position.coords.latitude;
	user_data.geo_lon = position.coords.longitude;
}

// report errors to user
function geoErrorHandler(error)
{
	switch (error.code)
	{ 
		case error.PERMISSION_DENIED:
			alert("Maybe next time try enabling location as the more details you provide, the more meaning we can give you :)");
		break;
		case error.POSITION_UNAVAILABLE:
			//alert("Dang, we could not get your position as this is not available right now");
		break;
		case error.TIMEOUT:
			//alert("Attempt to get position timed out");
		break;
	default:
			//alert("Sorry, an error occurred. Code: " + error.code + " Message: " + error.message);
		break;	
	}
}


function determineView()
{
	var current_url	= document.location.hash.replace('#!/','');

	if (current_url.length != '') 
	{		
		var this_view = 'content_' + current_url;	

		$.each(pages_views, function(key, view)
		{	
			if (view == this_view)
			{
				$('#' + view).delay(250).fadeIn();			
			}
			else
			{
				$('#' + view).hide();
			}
		});
	}
	else
	{					
		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});
		
		$('#content_index').fadeIn('');
	}
}


function showHeaderLogged(name, image)
{
	// Set User Data
//	$('#header_logged_avatar').css('background-image', 'url(' + image + ')');
	$('#header_logged_avatar').html('<a href="' + base_url + 'record/feeling/"><img src="' + image + '"></a>');
	$('#header_logged_name').html('<a href="' + base_url + 'record/feeling">' + name + '</a>');
	
	var entry_count = 175;
	
	$('#header_logged_count').html("You've recorded " + entry_count + " entries");

	// Show Header
	$('#header_not_logged').hide();
	$('#header_logged').fadeIn('normal');
}

// Live Actions
$(document).ready(function()
{
	// Show Index
	$('#header_home').bind('click', function(e)
	{
		e.preventDefault();
		history.pushState("", document.title, window.location.pathname + window.location.search);

		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});	

		$('#content_index').delay(250).fadeIn();
	});

	// Nav Buttons
	$('.navigation_button').bind('click', function(e)
	{
		var view = $(this).attr('href').split('#!/');
	
		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});

		$('#content_' + view[1]).delay(250).fadeIn();	
	});

	// Login
	$('#user_login').bind('submit', function(e)
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
					beforeSend	: requestMade('Logging You In'),					
			  		success		: function(result)
			  		{
						// Close Loading
			  			requestComplete(result.message, result.status);
	  			  		
						if (result.status == 'success')
						{							
							// Update URL & View
							window.location = 'record/feeling';
						}
				 	}
				});
			}
		});
	});

	// Signup
	$("#user_signup").bind('submit', function(e)
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
					beforeSend	: requestMade('Creating Account'),
			  		success		: function(result)
			  		{
						// Close Loading
			  			requestComplete(result.message, result.status);	
	
						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');
							
							// Update URL & View
							window.location = 'record/feeling';
						}
				 	}
				});
			}
		});
	});	
	
	// Signup
	$("#user_signup_short").bind('submit', function(e)
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
					beforeSend	: requestMade('Creating Account'),
			  		success		: function(result)
			  		{
						// Close Loading
			  			requestComplete(result.message, result.status);	
	
						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');

							// Update URL & View
							window.location = 'record/feeling';
						}
				 	}
				});
			}
		});
	});	
	
});
