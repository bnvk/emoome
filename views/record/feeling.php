<!-- Log Type: Feeling -->
<div id="log_feeling_container"></div>

<!-- Templates -->
<script type="text/template" id="log_feeling">
	<div id="log_feeling_view" class="content_center text_center">
		<h1>How do you feel right now?</h1>
		<p><input type="text" name="log_feeling" id="log_val_feeling" placeholder="Good" value=""></p>
		<p><a id="log_feel_next" class="button" href="#">Next</a></p>
	</div>
</script>

<script type="text/template" id="log_experience">
	<div id="log_experience_view" class="content_center text_center">
		<h1>What is one thing you did today?</h1>
		<p><textarea name="log_experience" id="log_val_experience" placeholder="Walked my pet dog"></textarea></p>
		<p><a id="log_experience_next" href="#" class="button">Next</a></p>
	</div>
</script>

<script type="text/template" id="log_describe">
	<div id="log_describe_view" class="content_center text_center hide">
		<h1>Describe in three words</h1>
		<p id="log_describe_this"></p>
		<p><input type="text" name="log_describe_1" id="log_val_describe_1" placeholder="Three" value=""></p>
		<p><input type="text" name="log_describe_2" id="log_val_describe_2" placeholder="Separate" value=""></p>
		<p><input type="text" name="log_describe_3" id="log_val_describe_3" placeholder="Words" value=""></p>
		<p><a id="log_describe_next" class="button" href="#">Finish</a></p>
	</div>
</script>

<script type="text/template" id="log_thanks">
	<div id="log_thanks_view" class="content_center text_center hide">
		<h1>Thanks :)</h1>
		<h3 id="log_completion_message"></h3>
		<p><a id="log_thanks_next" class="button" href="#">Another</a></p>
	</div>
</script>


<form name="log_data" id="log_data">
	<input type="hidden" name="log_type" value="feeling">
</form>

<script type="text/javascript" src="<?= base_url() ?>js/underscore.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/backbone-min.js"></script>
<script type="text/javascript">
// VIEWS
LogViews = Backbone.View.extend(
{
    initialize: function()
    {    
        this.render();
    },
    render: function()
    {
    	/// Get Geo
		if (navigator.geolocation)
		{
			navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);	
		}
	
		// Get Start Time
		log_feeling_time.time_feeling = new Date().getTime();
	
		$('#log_feeling').delay(250).fadeIn('slow');  
  
  
    	//Pass variables in using Underscore.js Template
        var variables = { form_label: "^-- add a name or two or three :D" };
        
        // Compile the template using underscore
        var template = _.template($("#log_feeling").html(), variables);
        
        // Load the compiled HTML into the Backbone "el"
        this.$el.html(template);
    },
    events:
    {
        "click #log_feel_next": "recordFeeling",
        "click #log_experience_next": "recordExperience",
        "click #log_describe_next": "recordDescribe"
    },
    validator: function(params, message)
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
				return true;
			},
			failed : function()
			{
				printUserMessage(message);
			}
		});
    },
    recordFeeling: function()
    {
    	console.log('inside recordFeeling');
    
    	var feeling_params = [{
			'selector' 	: '#log_val_feeling',
			'rule'		: 'require', 
			'field'		: 'Feeling'
		}];

    	var valid = this.validator(feeling_params, 'Please enter how you feel right now');
    
    	console.log(valid);
    	

		// logFeelingComplete();
		// Stamp Times
		log_feeling_time.time_feeling	= getTimeSpent(log_feeling_time.time_feeling);
		log_feeling_time.time_experience	= new Date().getTime();
	
		// jQT.goTo('#log_experience', 'slideleft');
		var variables = { form_label: "^-- add a name or two or three :D" };

        // Compile the template using underscore
        var template = _.template($("#log_experience").html(), variables);

        // Load the compiled HTML into the Backbone "el"
        this.$el.html(template).delay(500).fadeIn()
		
		// FadeIn
		//$('#log_experience_view').delay(500).fadeIn();
    },
    recordExperience: function()
    {
		$('#log_describe_this').html('"' + $('#log_val_experience').val() + '"');
	
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_val_experience',
					'rule'		: 'require', 
					'field'		: 'Experience'
				}],
			message : 'Enter a ',
			success	: function()
			{
				//logExperienceComplete();
				log_feeling_time.time_experience	= getTimeSpent(log_feeling_time.time_experience);
				log_feeling_time.time_describe	= new Date().getTime();

				//jQT.goTo('#log_experience', 'slideleft');
				$('#log_experience').fadeOut();
				$('#log_describe').delay(500).fadeIn();
			},
			failed : function()
			{
				printUserMessage('Please enter one thing you did today');
			}
		});	    
    },
    recordDescribe: function()
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
				log_data.push({'name' : 'experience', 'value' : $('#log_val_experience').val() });
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
					url			: base_url + 'api/emoome/logs/create_feeling',
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
					  		$('#log_val_experience').val('');
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
    },
    recordThanks: function()
    {
	    
    }
});


var LogRouter = Backbone.Router.extend(
{
    /* define the route and function maps for this router */
    routes: {
        "about" : "showAbout",
        /*Sample usage: http://unicorns.com/#about*/

        "photos/:id" : "getPhoto",
        /*This is an example of using a ":param" variable which allows us to match 
        any of the components between two URL slashes*/
        /*Sample usage: http://unicorns.com/#photos/5*/

        "search/:query" : "searchPhotos",
        /*We can also define multiple routes that are bound to the same map function,
        in this case searchPhotos(). Note below how we're optionally passing in a 
        reference to a page number if one is supplied*/
        /*Sample usage: http://unicorns.com/#search/lolcats*/

        "search/:query/p:page" : "searchPhotos",
        /*As we can see, URLs may contain as many ":param"s as we wish*/
        /*Sample usage: http://unicorns.com/#search/lolcats/p1*/

        "photos/:id/download/*imagePath" : "downloadPhoto",
        /*This is an example of using a *splat. splats are able to match any number of 
        URL components and can be combined with ":param"s*/
        /*Sample usage: http://unicorns.com/#photos/5/download/files/lolcat-car.jpg*/

        /*If you wish to use splats for anything beyond default routing, it's probably a good 
        idea to leave them at the end of a URL otherwise you may need to apply regular
        expression parsing on your fragment*/

        "*other"    : "defaultRoute"
        /*This is a default route that also uses a *splat. Consider the
        default route a wildcard for URLs that are either not matched or where
        the user has incorrectly typed in a route path manually*/
        /*Sample usage: http://unicorns.com/#anything*/

    },
    showAbout: function()
    {
    	alert('Hi yooo');
    },

});


$(document).ready(function()
{
	// Instantiate View
	var log_feeling = new LogViews({ el: $("#log_feeling_container") });
	var my_log = new LogRouter();
	// logFeelingStart();
});
</script>