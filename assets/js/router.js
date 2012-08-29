var ApplicationRouter = Backbone.Router.extend(
{
	initialize: function(el)
	{
		this.el = el;

		// Public Views
		this.indexView				= new ContentView('#index');
		this.loginView				= new ContentView('#login');
		this.signupView				= new ContentView('#signup');
		this.forgotPasswordView		= new ContentView('#forgot_password');
		this.logoutView				= new ContentView('#logout');
		this.notFoundView			= new ContentView('#not_found');

		// Record Views
		this.record					= new ContentView('#record');
		this.recordFeeling			= new ContentView('#record_feeling');
		this.recordExperience		= new ContentView('#record_experience');
		this.recordDescribe			= new ContentView('#record_describe');		
		this.recordThanks			= new ContentView('#record_thanks');		

		// Visualize Views
		this.visualize				= new ContentView('#visualize');

		// Settings Views
		this.settings				= new ContentView('#settings');
		
	},
	routes: {
		"" 					: "index",
		"login" 			: "login",
		"signup"			: "signup",
		"forgot_password"	: "forgotPassword",
		"logout"			: "logout",
		"record"			: "record",
		"record/:stage"		: "recordViews",
		"visualize"			: "visualize",
		"settings"			: "settings",
		"*else"				: "notFound"
	},
	currentView: null,
	switchView: function(view)
	{
		if (this.currentView)
		{
			// Detach the old view
			this.currentView.remove();
		}

		// Move the view element into the DOM (replacing the old content)
		this.el.html(view.el);

		// Render view after it is in the DOM (styles are applied)
		view.render();

		this.currentView = view;		
	},
	/*
	 * Change the active element in the topbar 
	 */
	setActiveEntry: function(url)
	{
		// Unmark all entries
		// $('li').removeClass('active');

		// Mark active entry
		// $("li a[href='" + url + "']").parents('li').addClass('active');
	},
	index: function()
	{
		this.switchView(this.indexView);
		// this.setActiveEntry('#lorem');
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
		this.switchView(this.logoutView);
	},
	notFound: function()
	{
		this.switchView(this.notFoundView);
	},
	record: function()
	{
		this.switchView(this.record);	
	},
	recordViews: function(stage)
	{
		console.log('hiii yoa recordView');
		console.log(stage);
		if (stage == 'feeling') 
			this.switchView(this.recordFeeling);
		else if (stage == 'experience') 
			this.switchView(this.recordExperience);
		else if (stage == 'describe') 
			this.switchView(this.recordDescribe);
		else if (stage == 'thanks')
			this.switchView(this.recordThanks);
		else
			this.switchView(this.notFoundView);
	},
	visualize: function()
	{
		this.switchView(this.visualize);
	},
	settings: function()
	{
		this.switchView(this.settings);
	}
});