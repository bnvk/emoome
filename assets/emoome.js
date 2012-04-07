/* Author: Brennan Novak */
var type_colors		= {"E":"#ff0000","I":"#142bd7","D":"#dfd20a","S":"#0aa80e","A":"#ee9700","P":"#cf00ee","G":"#997a38","M":"#ffffff","F":"#18d9f0","C":"#666666","U":"#c3c3c3"}
var word_types		= {"E":"Emotional","I":"Intellectual","D":"Descriptive","S":"Sensory","A":"Action","P":"Physical","G":"Slang","M":"Moral","F":"Food","C":"Common","U":"Undecided"};
var speech_types	= {"V":"Verb","N":"Noun","P":"Pro Noun","A":"Adjective","D":"Adverb","R":"Prepositon","C":"Conjunction","I":"Interjection"};



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
			jQT.goTo('#log_action', 'slideleft');
		},
		failed : function()
		{
			alert('Please enter how you feel');
		}
	});
}

function logAction()
{
	$('#log_describe_this').html($('#log_val_action').val());

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
			jQT.goTo('#log_describe', 'slideleft');
		},
		failed : function()
		{
			alert('Please enter something you did today');
		}
	});
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
				url			: api_url + 'emoome/log_feeling',
				type		: 'POST',
				dataType	: 'json',
				data		: log_data,
				beforeSend	: requestMade('#log_describe', 'Saving your entry'),
			  	success		: function(result)
			  	{
					// Close Loading
		  			requestComplete(result.message);
		  			
		  			console.log(result.word_map);					
					
					if (result.status == 'success')
					{
				  		$('#log_val_feeling').val('');
				  		$('#log_val_action').val('');
				  		$('#log_val_describe_1').val('');
				  		$('#log_val_describe_2').val('');
				  		$('#log_val_describe_3').val('');

						$(this).oneTime(500, function() { jQT.goTo('#log_thanks') });
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

