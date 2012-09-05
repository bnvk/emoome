<!DOCTYPE html>  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>untitled</title>

<style type="text/css">
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li,
fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed,  figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video { margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; } article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; } body { line-height: 1; }
ol, ul { list-style: none; } blockquote, q { quotes: none; } blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; } table { border-collapse: collapse; border-spacing: 0; }

/* EMOOME CUSTOM STYLES */
@font-face { font-family: 'Raleway'; src: url('http://emoo.me/application/modules/emoome/assets/raleway_thin-webfont.eot'); src: url('http://emoo.me/application/modules/emoome/assets/raleway_thin-webfont.eot?#iefix') format('embedded-opentype'), url('http://emoo.me/application/modules/emoome/assets/raleway_thin-webfont.woff') format('woff'), url('http://emoo.me/application/modules/emoome/assets/raleway_thin-webfont.ttf') format('truetype'), url('http://emoo.me/application/modules/emoome/assets/raleway_thin-webfont.svg#Helvetica Neue') format('svg'); }

h1, h2, h3	{ font-family: 'Raleway', 'Helvetica Neue', Helvetica, Arial, Sans-Serif; font-weight: 100; margin: 0px 0px 15px 0px; padding: 0px; }
h1			{ font-size: 48px; line-height: 60px; }
h2			{ font-size: 36px; line-height: 48px; }
h3			{ font-size: 30px; line-height: 36px; }
p			{ font-size: 14px; margin: 10px 0 25px 0; }

/* Start App CSS */
body	{  background: #e9e8e8; /* background: #e9e8e8; */ margin: 20px; font-size: 13px; line-height: 1.231; font-family: Helvetica, Arial, Sans-serif; font-size: 14px; }

#header			{ height: 75px; }
#header	h1		{ float: left; } 
 
#nav			{ margin-bottom: 30px; float: right; margin-top: 15px; }
#nav a			{ background: #c6c6c6; padding: 8px 15px; border-radius: 10px; font-size: 18px; margin: 15px; text-decoration: none; color: #333333; }

#slideshow		{ position: relative; top: 0px; left: 0px; margin-left: 15px; }
#slideshow img	{ height: 375px; }
  
#graphs { 
	position: relative;
	top: 400px;
	z-index: 1000;
	width: 100%;	
	margin: 0 15px 30px 15px;
	
}

ul.word_column {
	bottom: 0px;
	width: 145px; 
	border-radius: 25px;
	float: left;
	padding: 10px 25px;
	margin: 0 15px;
}

ul.word_column li {
	font-size: 24px;
	line-height: 24px;
	margin: 15px 0px;
	color: #e9e8e8;;
	font-family: Helvetica, Arial, Sans-Serif; 
	font-weight: normal;
	text-shadow: 1px 1px 1px #333333;
	text-transform: capitalize;
}

span.word_count {
	float: right;
	color: #c3c3c3;
	font-style: italic;
	
}

.clear { clear: both; }

#E_words { background-color: #ff0000; }
#I_words { background-color: #142bd7; }
#D_words { background-color: #dcca07; }
#S_words { background-color: #0aa80e; }
#P_words { background-color: #cf00ee; }
#A_words { background-color: #ee9700; }

</style>

</head>
<body>
<header>
	<div id="header">
		<h1>Group Think</h1>
	    <div id="nav"></div>
	    <div class="clear"></div>
	</div>
</header>

<div id="slideshow" class="pics" style="position: relative; ">
	<img src="http://emoo.me/uploads/slideshow/emo_phone_number.jpg">
	<img src="http://emoo.me/uploads/slideshow/Red%20Apple.jpg">
	<img src="http://emoo.me/uploads/slideshow/Steve%20Jobs%20RIP.png">
	<img src="http://emoo.me/uploads/slideshow/Squirrel%20And%20Birds.jpg">
	<img src="http://emoo.me/uploads/slideshow/Flying%20Dog%20Bite%20Lady%20Face.jpg">
	<img src="http://emoo.me/uploads/slideshow/Bear%20Hunting%20Kill.jpg">
	<img src="http://emoo.me/uploads/slideshow/Bacon%20Breakfast%20Gun.jpg">
	<img src="http://emoo.me/uploads/slideshow/Belle%20Isle%20Conversatory.jpeg">
	<img src="http://emoo.me/uploads/slideshow/Birds%20From%20Heaven.jpg">"
	<img src="http://emoo.me/uploads/slideshow/beaver-picture.jpg">
</div>

<div id="graphs">
	<ul id="E_words" class="word_column"></ul>
	<ul id="I_words" class="word_column"></ul>
	<ul id="D_words" class="word_column"></ul>
	<ul id="S_words" class="word_column"></ul>
	<ul id="P_words" class="word_column"></ul>
	<ul id="A_words" class="word_column"></ul>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/js/social.core.js"></script>

<script type="text/javascript" src="http://malsup.github.com/chili-1.7.pack.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.easing.1.3.js"></script>

<!-- the real deal -->
<script type="text/javascript">
//<![CDATA[
$(document).ready(function()
{
	/* Thought Demo Stuff for Hackday */
	function logThoughtStart()
	{
		/// Get Geo
		if (navigator.geolocation)
		{
			navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);	
		}
	
		$('#log_thought').delay(250).fadeIn('slow');
	}
	
	
	function logThought()
	{
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#log_val_thought',
					'rule'		: 'require', 
					'field'		: 'Thought'
				}],
			message : 'Enter a ',
			success	: function()
			{			
				var log_data = $('#log_data').serializeArray();
				log_data.push({'name' : 'category_id', 'value' : 9 });
				log_data.push({'name' : 'source', 'value' : user_data.source });
				log_data.push({'name' : 'log_thought', 'value' : $('#log_val_thought').val() });
	
				console.log(log_data);
	
				// Save Data To API
				$.oauthAjax(
				{
					oauth 		: user_data,		
					url			: base_url + 'api/emoome/log_thought',
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
					  		$('#log_val_thought').val('');
	
							$('#log_thought').fadeOut();
							
							// Show Completion View
							$('#log_completion_message').html('Great, thanks for logging your thought');
							$('#log_thanks').delay(500).fadeIn();
						}
				  	}			  			
				});
			},
			failed : function()
			{
				printUserMessage('Please enter your thought');
			}
		});
	}
	
	function logThoughtThanks()
	{
		//jQT.goTo('#log_experience', 'slideleft');
		$('#log_thanks').fadeOut();
		logThoughtStart();
	}


	$('#slideshow') 
	.before('<div id="nav">') 
	.cycle({ 
	    fx:     'turnDown', 
	    speed:  'fast', 
	    timeout: 0, 
	    pager:  '#nav' 
	});
	
	jQuery.data(document.body, 'word_count', 0);

	$('body').everyTime(1000, function()
	{	
		$.ajax(
		{
			url			: 'http://emoo.me/api/emoome/get_thoughts_words/id/10',
			type		: 'GET',
			dataType	: 'json',
		  	success		: function(result)
		  	{			  	
		  		var words_length = result.words.length;
		  		
		  		// If New Words
		  		if (words_length > jQuery.data(document.body, 'word_count'))
		  		{	
		  			// Update Word Count
		  			jQuery.data(document.body, 'word_count', words_length);
		  						  
					for (raw_array in result.words)
					{
						var word = result.words[raw_array];	
						if (word.word !== 'undefined')
						{						
							if ($('#word_' + word.word).length)
							{
								var current_count = $('#word_count_' + word.word).html();
								var increment_count	= parseInt(current_count) + 1;
								//console.log('current ' + current_count + ' inc: ' + current_count);
								$('#word_count_' + word.word).html(increment_count);
							}
							else
							{
								$('#' + word.type + '_words').append('<li id="word_' + word.word + '">' + word.word + '<span id="word_count_' + word.word + '" class="word_count">1</span></li>');	
							}
							//console.log(word.word);
				  		}
					}
		  		}
		  		else
		  		{
			  		console.log('no new words');	
		  		}		  			  			  	
		  	}		
		});			

	});


});
//]]>
</script>



    
</body>
</html>