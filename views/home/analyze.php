<form name="analyze_text_form" id="analyze_text_form">
	<p><textarea id="analyze_text" name="analyze_text" rows="6" cols="75" placeholder="Paste your text here…">I would love to go sky diving over the weekend, if you want to. Aren't you ready to do such things with me? I am getting a little bit frustrated that stuff is not going to work out between you and me. If I'm off base let me know we can chat.</textarea><br>
	<span id="analyze_text_error"></span></p>
	<p><input type="submit" name="submit" value="Submit"></p>
</form>

<div id="analysis_results" class="hide">
	<p>&nbsp;</p>
	<h3>Text Analysis</h3>
	<p>
	  <strong>Sentiment:</strong> <span id="analysis_sentiment"></span><br>
	  <strong>Common Words:</strong> <span id="common_count"></span> <span id="common_words"></span>
	</p>

	<p id="analysis_text"></p>
	
	<p id="analysis_percents"></p>
	
</div>
<style type="text/css">
.font_color_E { color: #ff0000; }
.font_color_I { color: #142bd7; }
.font_color_D { color: #dfd20a; }
.font_color_S { color: #0aa80e; }
.font_color_A { color: #ee9700; }
.font_color_P { color: #cf00ee; }
</style>
<script type="text/javascript">
$(document).ready(function()
{
	$('#analyze_text_form').bind('submit', function(e)
	{
		e.preventDefault();
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#analyze_text', 
					'rule'		: 'require', 
					'field'		: 'Please enter some text',
					'action'	: 'label'	
				}],
			message : '',
			success	: function()
			{	
				var analyze_data = $('#analyze_text_form').serializeArray();
				
				$('#analysis_text').html($('#analyze_text').val());
				$('#analysis_percents').html('');

				$.ajax(
				{
					url			: base_url + 'api/emoome/analyze/text',
					type		: 'POST',
					dataType	: 'json',
					data		: analyze_data,
				  	success		: function(result)
				  	{
						$('#content_message').notify({scroll:true,status:result.status,message:result.message});


				  		var text_output		 = $('#analyze_text').val();
				  		var common_words	 = '';
				  		var words_type_count = parseInt(result.analysis.words_type_total_count);
						var word_types = {
							"E":"emotional",
							"I":"intellectual",
							"D":"descriptive",
							"S":"sensory",
							"A":"action",
							"P":"physical",
							"U":"undecided"
						};

				  		// Show Color Types
						$.each(result.analysis.words, function(key, value)
		  				{						
							if (value != 'U')
							{
								text_output = text_output.replace(key, '<span class="font_color_' + value + '">' + key + '</span>');
							}
		  				});

						$('#analysis_text').html(text_output);


						// Type Percents
						$.each(result.analysis.words_type_count, function(key, value)
		  				{
		  					var percent = Math.round(value / result.analysis.words_type_total_count * 100);
							$('#analysis_percents').append('<strong>' + percent + '%</strong> ' + word_types[key] + ' <br>');
		  				});


				  		// Add Common Words
						$.each(result.analysis.common_words, function(key, value)
		  				{
							if (value > 1)
							{
								common_words += '<strong>' + key + '</strong> (x' + value + '), ';  
							}
			  			});


				  		// Update Stats
				  		$('#analysis_sentiment').html(result.analysis.sentiment);
				  		$('#common_count').html(result.analysis.common_count);
						$('#common_words').html(common_words);

						// Show Analysis
						$('#analysis_results').delay(1000).fadeIn('slow');
				  	}		
				});						
			}
		});
	});	
});
</script>