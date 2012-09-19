// Emoome Settings
var EmoomeValues = Backbone.Model.extend({
	type_colors	: {
		"emotional": "#ff0000",
		"intellectual": "#142bd7",
		"descriptive": "#dcca07",
		"sensory": "#0aa80e",
		"action": "#ee9700",
		"physical": "#cf00ee",
		"undecided": "#c3c3c3"
	},
	word_types : {
		"E":"emotional",
		"I":"intellectual",
		"D":"descriptive",
		"S":"sensory",
		"A":"action",
		"P":"physical",
		"U":"undecided"
	},
	types_count : {
		"E":0,"I":0,"D":0,"S":0,"A":0,"P":0,"U":0
	},
	word_types_sub : {
		"M":"moral",
		"S":"slang",
		"P":"perception",
		"Y":"psychological",
		"L":"feeling",
		"F":"food",
		"C":"common",
		"U":"undecided"
	},
	types_sub_count	: {
		"M":0,"S":0,"P":0,"Y":0,"L":0,"F":0,"C":0
	},
	core_emotions : {
		"10":"love",
		"9":"joy",
		"8":"happy",
		"7":"amazement",
		"6":"serenity",
		"5":"interest",
		"4":"optimism",
		"3":"cool",
		"2":"goofy",
		"1":"acceptance",
		"0":"surprise",
		"-1":"annoyed",
		"-2":"crazy",
		"-3":"disapproval",
		"-4":"disgust",
		"-5":"fear",
		"-6":"sad",
		"-7":"shame",
		"-8":"grief",
		"-9":"loathing",
		"-10":"anger",
		"-11":"rage"
	},
	visualization_sizes : {
		"mobile" : {
			"circle_word_types" : 50,
			"circle_strong_experiences" : 5
		},
		"tablet" : {
			"circle_word_types" : 75,
			"circle_strong_experiences" : 10
		},
		"web" : {
			"circle_word_types"	: 100,
			"circle_strong_experiences" : 10
		}
	} 	
});



// UI Messages
var UIMessages = Backbone.Model.extend({
	log_feeling_complete : [
		"Every entry helps us build your emotional map",
		"We suggest logging 1-3 entries per day",
		"Try logging entries at different times of the day",
		"The best entries are when you feel something strongly",
		"If something is hard to describe it is a good entry",
		"The best entries are moments that seem important",
		"Had an intense experience? Log an entry for later analysis"
	],
	memory_quote : [
		"Memory is the scribe of the soul. ~Aristotle",
		"It is a poor sort of memory that only works backwards. ~Lewis Carroll"
	]
});

// Record Feeling
var LogFeelingModel = Backbone.Model.extend({
    defaults: {
        source			: 'web',
        feeling			: '',
        experience		: '',
        describe_1		: '',
        describe_2		: '',
        describe_3		: '',
        time_feeling 	: 0,
        time_experience	: 0,
        time_describe 	: 0,
        time_total 		: 0,
        geo_lat			: 0.00,
        geo_lon			: 0.00
    },
    initialize: function() {},
    startFeeling: function()
    {    
		this.set({ time_feeling : new Date().getTime() });
    },
    processFeeling: function(feeling)
    {    	
	    var now_time = new Date().getTime();	
		var time_feeling = now_time - this.get('time_feeling');    
    
	 	this.set({
			feeling 		: feeling,
			time_feeling 	: time_feeling,
			time_experience : now_time,
	 	});	 	   
    },
    processExperience: function()
    {
	    var now_time = new Date().getTime();	
		var time_experience = now_time - this.get('time_experience');  
    
		this.set({
			type 			: 'experience',
			experience		: $('#log_experience_value').val(),
			time_experience : time_experience,
			time_describe	: now_time
		});    
    },
    processDescribe: function()
    {
	    var now_time		= new Date().getTime();	
		var time_describe	= now_time - this.get('time_describe');  
		var time_total		= this.get('time_feeling') + this.get('time_experience') + time_describe; 
      
		this.set({
			time_describe 	: time_describe,
			time_total		: time_total,
			describe_1		: $('#log_describe_1_value').val(),
			describe_2		: $('#log_describe_2_value').val(),
			describe_3		: $('#log_describe_3_value').val()
		});		    
    },
    returnData: function()
    {
		var log_data = [];
		
		$.each(LogFeelingModel.attributes, function(key, value)
		{
			log_data.push({ name: key, value: value });
		});
		
		return log_data;	
    }
});


// Vizualize Dashboard
var VisualizeModel = Backbone.Model.extend({
    defaults: {
		word_map	: {},
		last_five	: {},
		words		: {},
		logs_raw	: {}   
    }
});


// Instantiate Models
var EmoomeValues	= new EmoomeValues();
var UIMessages		= new UIMessages();
var LogFeelingModel = new LogFeelingModel();
var VisualizeModel	= new VisualizeModel();

