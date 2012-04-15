/* Author: Brennan Novak */
var type_colors		= {"E":"#ff0000","I":"#142bd7","D":"#dfd20a","S":"#0aa80e","A":"#ee9700","P":"#cf00ee","U":"#c3c3c3"}
var word_types		= {"E":"Emotional","I":"Intellectual","D":"Descriptive","S":"Sensory","A":"Action","P":"Physical","U":"Undecided"};
var word_types_sub	= {"M":"Moral","S":"Slang","P":"Perception","Y":"Psychological","L":"Feeling","F":"Food","C":"Common","U":"Undecided"}
var speech_types	= {"V":"Verb","N":"Noun","P":"Pro Noun","A":"Adjective","D":"Adverb","R":"Prepositon","C":"Conjunction","I":"Interjection"};

var emoome_icons	= {
	"brain" : "<svg version=\"1.0\" x=\"0px\" y=\"0px\" xml:space=\"preserve\"><path d=\"M100,42.672c0,4.26-1.67,8.128-4.385,11.008c-0.466,6.078-4.317,11.208-9.685,13.521v0.057c-6.555,3.817-10.474,10.333-11.667,18.149h-6.061V67.275c0.04-5.652,1.818-9.271,5.544-11.504c1.363-0.784,2.602-1.681,3.658-2.675c2.766,0.994,5.214,2.942,6.771,5.714c0.324,0.545,0.903,0.852,1.477,0.852c0.278,0,0.568-0.068,0.829-0.222c0.83-0.455,1.125-1.488,0.659-2.306h-0.011c-1.744-3.102-4.396-5.391-7.407-6.754c1.545-2.375,2.403-5.203,2.363-8.6c0-0.017,0.023-0.034,0.023-0.057c0-1.534-0.227-3.027-0.636-4.431c3.539-0.676,6.657-2.471,8.952-5c0.636-0.698,0.59-1.772-0.114-2.397c-0.699-0.63-1.755-0.574-2.38,0.108c-2,2.176-4.698,3.664-7.765,4.073c-2.465-4.567-7.049-7.81-12.422-8.401c0.358-2.897,1.664-5.481,3.629-7.447c0.648-0.659,0.648-1.734,0-2.387c-0.659-0.665-1.75-0.665-2.408,0c-2.516,2.518-4.198,5.88-4.618,9.624c-6.311-0.795-11.173-6.152-11.184-12.674c0-0.926-0.767-1.698-1.676-1.698c-0.96,0-1.71,0.772-1.71,1.698c0,1.102,0.108,2.153,0.318,3.187c-2.392,2.069-5.368,3.114-8.35,3.114c-1.471,0-2.948-0.261-4.339-0.767c0,0-0.023-0.006-0.04-0.011c-1.715-0.619-3.289-1.604-4.652-2.967c-0.653-0.659-1.732-0.659-2.397,0c-0.665,0.659-0.665,1.729,0,2.393c1.397,1.392,2.971,2.471,4.646,3.249c-0.335,4.22-2.789,7.85-6.22,9.889c-1.982-3.011-4.964-5.396-8.628-6.561c-0.915-0.284-1.863,0.21-2.153,1.102c-0.25,0.892,0.205,1.841,1.108,2.119c2.721,0.863,4.908,2.539,6.481,4.675c-1.056,0.284-2.141,0.437-3.294,0.437c0,0,0,0-0.018,0H22.05c-4.351,0-8.35,1.733-11.258,4.568c-0.688,0.653-0.704,1.727-0.028,2.392c0.323,0.341,0.767,0.511,1.227,0.511c0.387,0,0.812-0.159,1.142-0.477c2.307-2.25,5.453-3.607,8.918-3.607h0.182h0.005h0.018c8.156,0,14.933-6.074,15.995-13.946c1.159,0.25,2.317,0.386,3.493,0.386c3.312,0,6.652-1.028,9.463-3.062c1.028,2.346,2.653,4.396,4.624,5.987c-2.011,2.477-3.192,5.419-3.504,8.429c-0.847-0.136-1.738-0.21-2.63-0.21c-2.556,0-5.152,0.607-7.566,1.898c-0.829,0.438-1.142,1.465-0.704,2.295c0.307,0.562,0.903,0.892,1.511,0.892c0.278,0,0.528-0.062,0.772-0.205c1.943-1.017,3.977-1.5,5.987-1.5c0.897,0,1.783,0.097,2.63,0.278c0.369,3.431,1.852,6.788,4.402,9.458c0.341,0.353,0.778,0.523,1.216,0.523c0.415,0,0.846-0.154,1.182-0.466c0.693-0.653,0.71-1.716,0.051-2.392h-0.011c-2.267-2.397-3.465-5.441-3.544-8.52c0-0.046,0.011-0.08,0-0.131c0-0.062,0-0.125,0-0.188c0-2.989,1.034-5.943,3.079-8.317c2.153,1.074,4.606,1.699,7.203,1.699c0,0,0.011,0.005,0.028,0.005c0,0,0.011,0,0.028,0c7.032,0.023,12.724,5.705,12.752,12.736c-1.334-0.352-2.709-0.534-4.118-0.534c-2.016,0-4.061,0.369-6.032,1.182c-0.875,0.358-1.29,1.34-0.937,2.204c0.357,0.863,1.329,1.284,2.198,0.932c1.579-0.63,3.187-0.937,4.771-0.937c1.278,0,2.545,0.193,3.732,0.562c-0.415,1.897-1.227,3.419-2.488,4.771c-0.097,0.085-0.188,0.182-0.261,0.295c-0.966,0.949-2.125,1.823-3.556,2.692c-4.902,2.863-7.254,8.055-7.203,14.418v18.132h-5.783V68.161c0-6.333-3.97-12.339-8.969-14.475c-2.386-0.926-4.874-2.477-6.686-4.505c-2.584,1.755-5.686,2.789-9.021,2.789c-3.346,0-6.447-1.017-9.014-2.76c-2.556,1.681-5.641,2.664-8.94,2.664C7.333,51.875,0,44.524,0,35.464c0-6.772,4.095-12.583,9.958-15.083c1.585-7.227,7.986-12.634,15.688-12.634c0.409,0,0.784,0.034,1.165,0.057c2.903-4.243,7.782-7.027,13.309-7.027c2.738,0,5.306,0.682,7.561,1.897C50.225,0.982,53.269,0,56.546,0c4.209,0,8.043,1.642,10.917,4.306c1.204-0.29,2.448-0.46,3.749-0.46c6.504,0,12.127,3.914,14.638,9.52c6.601,2,11.406,8.124,11.406,15.372c0,1.454-0.193,2.857-0.551,4.192C98.762,35.635,100,39.009,100,42.672z\"/></svg>",
	"profile" : "<svg version=\"1.0\" x=\"0px\" y=\"0px\" width=\"300px\" height=\"300px\" xml:space=\"preserve\"><path d=\"M34.17,62.932l1.099,0.273c4.332-5.283,7.815-12.215,2.554-19.435c-5.44-7.471-7.457-17.142-5.071-26.328C36.532,2.886,42.756,0.366,57.405,0.43c5.008,0.022,15.456,1.76,18.607,6.126c0.792,1.095-0.53,2.522,0.014,3.17c1.979,2.35,3.346,6.891,3.852,11.311c0.104,0.923,2.023,3.147,1.537,4.047c-0.989,1.821-1.444,2.771,0.302,5.242   c1.136,1.61,4.413,6.442,5.144,7.774c1.021,1.857-4.852,1.917-4.337,3.33c0.234,0.644,1.025,2.271,1.28,2.902c0.308,0.762-1.519,1.247-1.528,1.777c0.003,0.202,1.126,0.309,0.949,1.637c-0.108,0.817-1.757,0.177-1.851,3.282   c-0.05,1.686,1.967,4.035-1.403,6.168c-3.623,2.297-16.219-4.463-17.27,8.309c-0.147,1.795-0.103,3.277,0.08,4.547l1.9,0.473   c0,0,0.624,3.211,1.39,6.51c0.45,0.602,0.896,1.207,1.307,1.869c2.723,4.393,7.992,9.795,8.916,15.326   c0.419,2.518,0.566,4.053,0.603,4.979H17.021c0.052-3.385-1.78-14.852,11.745-29.113l0.37-0.385L34.17,62.932L34.17,62.932z\"/></svg>"
}

/* General Functions */
function requestMade(element, message)
{
	console.log(message);
}

function requestComplete(message)
{
	console.log(message)
}


/* Log - Feeling */
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
			alert('Please enter how you feel');
		}
	});
}

function logFeelingComplete()
{
	//jQT.goTo('#log_action', 'slideleft');
	$('#log_feeling').fadeOut();
	$('#log_action').delay(500).fadeIn();

}

function logAction()
{
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
			alert('Please enter something you did today');
		}
	});
}

function logActionComplete()
{
	//jQT.goTo('#log_action', 'slideleft');
	$('#log_action').fadeOut();
	$('#log_describe').delay(500).fadeIn();

}

function logDescribe()
{
	console.log('logDescribe');
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
			var log_data = $('#log_data').serializeArray();

			log_data.push({'name' : 'feeling', 'value' : $('#log_val_feeling').val() });
			log_data.push({'name' : 'action', 'value' : $('#log_val_action').val() });
			log_data.push({'name' : 'describe_1', 'value' : $('#log_val_describe_1').val() });
			log_data.push({'name' : 'describe_2', 'value' : $('#log_val_describe_2').val() });
			log_data.push({'name' : 'describe_3', 'value' : $('#log_val_describe_3').val() });

			// Save Data To API
			$.oauthAjax(
			{
				oauth 		: user_data,		
				url			: base_url + 'api/emoome/log_feeling',
				type		: 'POST',
				dataType	: 'json',
				data		: log_data,
				beforeSend	: requestMade('#log_describe', 'Saving your entry'),
			  	success		: function(result)
			  	{
					// Close Loading
		  			
		  			requestComplete(result.message);
		  			
					
					if (result.status == 'success')
					{
				  		$('#log_val_feeling').val('');
				  		$('#log_val_action').val('');
				  		$('#log_val_describe_1').val('');
				  		$('#log_val_describe_2').val('');
				  		$('#log_val_describe_3').val('');
				  		$('#log_describe_this').html('');

						$('#log_describe').fadeOut();
						$('#log_thanks').delay(500).fadeIn();
					}
			  	}			  			
			});		
		},
		failed : function()
		{
			alert('Please enter three words to describe what you did');
		}
	});
}

function logThanks()
{
	//jQT.goTo('#log_action', 'slideleft');
	$('#log_thanks').fadeOut();
	$('#log_feeling').delay(500).fadeIn();

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


	
/* Geo Location */
function showPosition(position)
{
	var lat = position.coords.latitude;
	var lon = position.coords.longitude;
	
	$('#geo_lat').val(lat);
	$('#geo_lon').val(lon);
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

