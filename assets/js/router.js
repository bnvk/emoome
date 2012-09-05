var ApplicationRouter = Backbone.Router.extend(
{
	initialize: function(el)
	{
		this.el = el;
		
		// Instantiate Navigation
		this.Navigation				= new NavigationView({ el: $('#header') });

		// Public Views
		this.indexView				= new ContentView('#index');
		this.loginView				= new ContentView('#login');
		this.signupView				= new ContentView('#signup');
		this.forgotPasswordView		= new ContentView('#forgot_password');
		this.logoutView				= new ContentView('#logout');
		this.notFoundView			= new ContentView('#not_found');

		// Record Views
		this.recordIndex			= new ContentView('#record');
		this.recordFeeling			= new RecordFeelingView({ el: $('#container') });

		// Visualize Views
		this.visualizeIndex			= new ContentView('#visualize');
		this.visualizeViews			= new VisualizeView({ el: $('#container')});

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
		this.switchView(this.indexView);
	},	
	login: function()
	{	
		this.switchView(this.loginView);
	},
	signup: function()
	{
		this.switchView(this.signupView);
	},
	forgotPassword: function()
	{
		this.switchView(this.forgotPasswordView);		
	},
	logout: function()
	{
		this.Navigation.renderPublic();	  	
	    this.switchView(this.logoutView);
	},
	notFound: function() {
		this.switchView(this.notFoundView);
	},
	recordViews: function(view)
	{
		// Is Logged
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
		// Is Logged
		if (UserData.get('logged') != 'yes') Backbone.history.navigate('#/login', true); 

		console.log('NEED TO WRITE VISUALIZE LOGIC FOR: ' + view);	
		
		// View
		if (view == undefined)	
			this.switchView(this.visualizeIndex);
		else
			this.switchView(this.notFoundView);	
	},
	settingsViews: function(view)
	{	
		// Is Logged
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


