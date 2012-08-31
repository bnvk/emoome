// Record Feeling
var LogFeelingModel = Backbone.Model.extend({
    defaults: {
        type			: 'feeling',
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
    initialize: function()
    {
        console.log("instantiating LogFeeling model");
    },
    geo: function(position)
    {
		this.geo_lat = position.coords.latitude;
		this.geo_lon = position.coords.longitude;
	 
	 	console.log('here in GEO func');   
    },
    startFeeling: function()
    {
	  	if (navigator.geolocation)
		{
			navigator.geolocation.getCurrentPosition(this.geo, geoErrorHandler);	
		}

		this.time_feeling = new Date().getTime();
    },
    endFeeling: function()
    {
	 	   
    }
});

// Instantiate Model
var LogFeelingModel = new LogFeelingModel();