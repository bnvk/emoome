<form name="analyze_text_form" id="analyze_text_form">
	<input type="hidden" id="analyze_text" name="analyze_text" value="<?= $transcriptions[0]->message_text ?>">
</form>

<div id="analysis_results" class="hide">
	<h1 id="analysis_text"></h1>
	<h3>Sentiment: <span id="analysis_sentiment"></span> &nbsp;&nbsp; Common Words: <span id="common_count"></span></h3>	
	<h3>&nbsp;</h3>
	  
	<div id="last_five"></div>

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
<script type="text/javascript" src="<?= $this_module_assets ?>js/raphael.js"></script>
<script type="text/javascript" src="<?= $this_module_assets ?>js/g.raphael.js"></script>
<script type="text/javascript" src="<?= $this_module_assets ?>js/g.pie.js"></script>
<script type="text/javascript">
$(document).ready(function()
{


	function renderPieChart(element, word_values, word_percents, types_colors)
	{
	    var r = Raphael(element, 575, 375);
	    pie = r.piechart(175, 175, 150, word_values,
	    { 
	    	colors 	 : types_colors,
	    	legend	 : word_percents,
	    	'stroke-width': 1, 'stroke': '#c3c3c3',
	    	legendpos: "east"
	    }).attr({"font": "24px 'Ralway', 'Helvetica Neue', Helvetica, Arial, Sans-Serif", "font-family": "'Ralway', 'Helvetica Neue', Helvetica, Arial, Sans-Serif", "font-size": 24, "font-weight": 100, "letter-spacing": 2});

	    pie.hover(function()
	    {	    
	        this.sector.stop();
	        this.sector.scale(1.1, 1.1, this.cx, this.cy);
	
	        if (this.label) {
	            this.label[0].stop();
	            this.label[0].attr({ r : 15 });
	        }
	    }, function() 
	    {	    
	        this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 1000, "bounce");
	
	        if (this.label)
	        {
	            this.label[0].animate({ r : 10 }, 750, "bounce");
	        }
	    });		
	
		return true;	
	}



	var analyze_data = $('#analyze_text_form').serializeArray();

	$.ajax(
	{
		url			: base_url + 'api/emoome/analyze_text',
		type		: 'POST',
		dataType	: 'json',
		data		: analyze_data,
	  	success		: function(result)
	  	{
	  		var text_output		 = $('#analyze_text').val();
	  		var common_words	 = '';
	  		var words_type_count = parseInt(result.analysis.words_type_total_count);

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
			$('#analysis_percents').append('<h3>' + percent + '% ' + word_types[key] + ' </h3>');
			});


	  		// Add Common Words
			$.each(result.analysis.common_words, function(key, value)
			{
				if (value > 1)
				{
					common_words += '<strong>' + key + '</strong> (x' + value + '), ';  
				}
  			});

	
  			console.log(result.analysis.words_type_count);
 
 
			// Create Pie Chart
			var types 			= result.analysis.words_type_count;		
			var types_colors	= new Array();
			var word_values		= new Array();
			var word_percents	= new Array();
			var i=0;
		
			// Build Data Values
			for (var type in types)
			{			
				if (type != 'U')
				{
					word_values.push({order: i++, value: types[type] });			
					word_percents.push("%% " + word_types[type]);
					types_colors.push(type_colors[type]);
				}
			}

		console.log(word_values);
		console.log(word_percents);
		console.log(types_colors);

  			//renderPieChart("all_time", word_values, word_percents, types_colors);


	  		// Update Stats
	  		$('#analysis_sentiment').html(result.analysis.sentiment);
	  		$('#common_count').html(result.analysis.common_count);
			$('#common_words').html(common_words);

			// Show Analysis
			$('#analysis_results').delay(1000).fadeIn('slow');
	  	}		
	});						

});
</script>
