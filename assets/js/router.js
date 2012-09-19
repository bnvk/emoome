var ApplicationRouter = Backbone.Router.extend(
{
	initialize: function(el)
	{
		this.el = el;
		
		// Instantiate Navigation
		this.Navigation				= new NavigationView({ el: $('#header') });

		// Public Views
		this.indexView				= new ContentView('#index');
		this.authView				= new AuthView({ el: $('#container') });
		this.logoutView				= new ContentView('#logout');
		this.notFoundView			= new ContentView('#not_found');

		// Record Views
		this.recordIndex			= new ContentView('#record');
		this.recordFeeling			= new RecordFeelingView({ el: $('#container') });

		// Settings Views
		this.settingsIndex			= new ContentView('#settings');
		this.settingsViews			= new SettingsView({ el: $('#container')});
	},
	routes: {
		"" 						: "index",
		"login" 				: "login",
		"signup"				: "signup",
		"forgot_password"		: "forgotPassword",
		"logout"				: "logout",
		"logged/:destination"	: "logged",
		"record"				: "recordViews",
		"record/:view"			: "recordViews",
		"visualize"				: "visualizeViews",
		"visualize/:view"		: "visualizeViews",
		"settings"				: "settingsViews",
		"settings/:view"		: "settingsViews"
	},
	currentView: null,
	switchView: function(view)
	{
		if (this.currentView)
		{
			this.currentView.remove();	// Detach the old view
		}

		this.el.html(view.el);			// Move the view element into the DOM (replacing the old content)
		view.render();					// Render view after it is in the DOM (styles are applied)
		this.currentView = view;
	},
	setActiveNav: function(url)		// For Main Nav Links and Shit
	{			    
	    $.each(['record', 'visualize', 'settings'], function(key, value)
	    {		
		    if (value == type)
			{
				$('#record_feeling_' + value).fadeIn();
			}
			else
			{
				$('#record_feeling_' + value).hide(); 
			}
	    });

	    // Do Control Buttons
	    $('div.left_control_links').removeClass('icon_small_text_on icon_small_emoticons_on icon_small_audio_on');
	    $('#log_feeling_use_' + type).addClass('icon_small_' +  type + '_on');
	},
	index: function()
	{
		if (UserData.get('logged') == 'yes') Backbone.history.navigate('#/record/feeling', true);	
		this.switchView(this.indexView);
	},	
	login: function()
	{
		if (UserData.get('logged') == 'yes') Backbone.history.navigate('#/record/feeling', true); 	
		this.authView.viewLogin();
		//this.switchView(this.loginView);
	},
	signup: function()
	{
		if (UserData.get('logged') == 'yes') Backbone.history.navigate('#/record/feeling', true); 	
		this.authView.viewSignup();
	},
	forgotPassword: function()
	{
		this.authView.viewForgotPassword();
	},
	logout: function()
	{
		UserData.set({ logged: 'no', user_id: '', username: '', name: '', user_level_id	: '', name : '', image : '', location : '', geo_enabled : '', language : '', privacy : '', consumer_key : '', consumer_secret : '', token : '', token_secret : '' });
		this.Navigation.renderPublic(); 	
	    this.switchView(this.logoutView);
	},
	notFound: function() {
		this.switchView(this.notFoundView);
	},
	recordViews: function(view)
	{
		if (UserData.get('logged') != 'yes') Backbone.history.navigate('#/login', true); 
		
		// View
		if (view == undefined)
			this.switchView(this.recordIndex);
		else if (view == 'feeling') 
			this.recordFeeling.viewFeeling();
		else if (view == 'experience') 
			this.recordFeeling.viewExperience();
		else if (view == 'describe') 
			this.recordFeeling.viewDescribe();
		else if (view == 'thanks') 
			this.recordFeeling.viewThanks();
		else
			this.switchView(this.notFoundView);
	},
	visualizeViews: function(view)
	{
		if (UserData.get('logged') != 'yes') Backbone.history.navigate('#/login', true);

		// Visualize Views
		VisualizeIndex = new ContentView('#visualize');

		$.oauthAjax(
		{
			oauth 		: UserData,	
			url			: base_url + 'api/emoome/analyze/me',
			type		: 'GET',
			dataType	: 'json',
		  	success		: function(result)
		  	{
		  		// Instantiate Views
				VisualizeViews = new VisualizeView({ el: $('#container')});

				// Is Saved
				if (result.status == 'success')
				{
					// Update URL & View
					VisualizeModel.set(result);
					
					console.log(VisualizeModel.attributes);


					var logs_count	= VisualizeModel.get('logs_raw').length;
					var logs		= new Array();
					var total		= 0;
					var largest		= 0;
					var percents	= '';
										
			
					// Display Title
					if (logs_count > 5 && UserData.get('source') != 'mobile')
					{
						$('#visualize_title').fadeIn();
					}
				
					// Display Visualizations by log_count
					if (logs_count < 5)
					{
						$('#logs_needed_count').html(5 - logs_count);
						$('#visualize_waiting').fadeIn('slow');
					}
					else if (logs_count < 10)
					{
						$('#visualize_language').fadeIn();
				
						//doWordTypes();
						VisualizeViews.doLastFive();
					}
					else if (logs_count < 15)
					{		
						$('#visualize_language').fadeIn();
				
						//doWordTypes();
						VisualizeViews.doLastFive();
						VisualizeViews.doAllTime();
						VisualizeViews.renderCommonLanguage();
				
						if (UserData.get('source') != 'mobile')
						{
							$('#your_language_map').fadeIn();
						}
					}
					else
					{
						$('#visualize_language').fadeIn();
				
						//doWordTypes();
						VisualizeViews.doLastFive();
						VisualizeViews.doAllTime();
						VisualizeViews.renderCommonLanguage();
						VisualizeViews.renderStrongExperiences();
				
						if (UserData.get('source') != 'mobile')
						{
							$('#your_language_map').fadeIn();
						}
					}						
					
				}
		  	}			  			
		});
		
		
		// View
/*
		if (view == undefined)	
			this.switchView(VisualizeIndex);
		else
			this.switchView(this.notFoundView);	
*/
	},
	settingsViews: function(view)
	{	
		if (UserData.get('logged') != 'yes') Backbone.history.navigate('#/login', true); 

		// View
		if (view == undefined)	
			this.switchView(this.settingsIndex);
		else if (view == 'notifications') 
			this.settingsViews.viewNotifications();
		else if (view == 'account') 
			this.settingsViews.viewAccount();
		else if (view == 'password') 
			this.settingsViews.viewPassword();
		else if (view == 'logout')
			this.settingsViews.processLogout();
		else
			this.switchView(this.notFoundView);
	}
});


