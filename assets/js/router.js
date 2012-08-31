var ApplicationRouter = Backbone.Router.extend(
{
	initialize: function(el)
	{
		this.el = el;
		
		console.log('initialize router');

		// Public Views
		this.indexView				= new ContentView('#index');
		this.loginView				= new ContentView('#login');
		this.signupView				= new ContentView('#signup');
		this.forgotPasswordView		= new ContentView('#forgot_password');
		this.logoutView				= new ContentView('#logout');
		this.notFoundView			= new ContentView('#not_found');

		// Record Views
		this.record					= new ContentView('#record');
		this.recordFeeling			= new RecordFeelingView({ el: $('#container') });
/*		
		this.recordExperience		= new RecordFeelingView('#record_experience');
		this.recordDescribe			= new RecordFeelingView('#record_describe');		
		this.recordThanks			= new RecordFeelingView('#record_thanks');		
*/
		// Visualize Views
		this.visualize				= new ContentView('#visualize');

		// Settings Views
		this.settings				= new ContentView('#settings');
		this.settingsNotifications	= new ContentView('#settings_notifications');
		this.settingsAccount		= new ContentView('#settings_account');
		this.settingsPassword		= new ContentView('#settings_password');				
	},
	routes: {
		"" 						: "index",
		"login" 				: "login",
		"signup"				: "signup",
		"forgot_password"		: "forgotPassword",
		"logout"				: "logout",
		"record"				: "record",
		"record/:view"			: "recordViews",
//		"record/experience"		: "recordExperience",
		"visualize"				: "visualize",
		"settings"				: "settings",
		"settings/notifications": "settingsNotifications",
		"settings/account"		: "settingsAccount",
		"settings/password"		: "settingsPassword",
		"*else"					: "notFound"
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
	logout: function() {	
		this.switchView(this.logoutView);
	},
	notFound: function() {
		this.switchView(this.notFoundView);
	},
	record: function()
	{
		this.switchView(this.record);	
	},
	recordViews: function(view)
	{		
		if (view == 'feeling') 
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
	visualize: function()
	{
		this.switchView(this.visualize);
	},
	settings: function()
	{
		this.switchView(this.settings);
	},
	settingsNotifications: function()
	{
		this.switchView(this.settingsNotifications);
	},
	settingsAccount: function()
	{
		this.switchView(this.settingsAccount);
	},
	settingsPassword: function()
	{
		this.switchView(this.settingsPassword);
	}
});