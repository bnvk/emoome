<div id="emotion_picker">

	<h2>How Do You Feel Right Now?</h2>	
	<div id="emoticon_container">
		<div id="emoticons"></div>
	</div>

</div>

<div id="emotion_weight" class="hide">
	
	<h2>How Strongly Are You Feeling This Emotion?</h2>	
	<p>Mild <input id="emotion_weight_slide" type="range" min="0" max="100" step="1" value="50"> Intense</p>

	<p><button id="emotion_weight_next">Next</button></p>

</div>

<input type="hidden" value="emotion_value" id="emotion_value">

<style type="text/css">
#emotion_picker {
	text-align: center;
			
}

#emoticon_container {
	width: 100%;
	height: 500px;
	overflow: scroll;
	margin: 0;
}

#emoticons {
	height: 475px;
}
a.emoticon_item {
	width: 475px;
	height: 500px;
	display: block;
	float: left;
	border-radius: 45px;
	color: #999;
	font-size: 18px;
	text-align: center;
}
a.emoticon_item img {
	margin-bottom: 5px;
}
a.emoticon_item:hover {
	text-decoration: none;	
}


#emotion_weight {
	text-align: center;
	
}

input[type='range'] {
	height: 30px;
	-webkit-appearance: none;
	padding-left: 5px; 
	padding-right: 5px;
	-webkit-border-radius: 15px;
	background-color: #c3c3c3;
	border: 1px solid #999;
}


</style>
<script type="text/javascript">
$(document).ready(function()
{
	var emoticons 		= '';
	var emoticons_width	= 475;

	$.each(core_emotions, function(key, value)
	{
		emoticons += '<a href="#" class="emoticon_item"><img src="' + base_url + 'application/modules/emoome/assets/images/emoticons-' + value + '.png"><span>' + value + '</span></a>';
		emoticons_width += 475;
	});

	$('#emoticons').html(emoticons).width(emoticons_width);

	// Hover Emoticon
	$('.emoticon_item').live('mouseover', function()
	{
		$(this).css('background-color', '#d6d6d6');		
	}).live('mouseleave', function()
	{
		$(this).css('background-color', '');
	});
	

	// Select Emoticon
	$('.emoticon_item').bind('click', function()
	{
		var emotion = $(this).find('span').html();
		
		$('#emotion_value').val(emotion);
		$('#emotion_picker').fadeOut(function()
		{
		
			$('#emotion_weight').fadeIn();		
			
		});
				
	});

	$('#emotion_weight_slide').change(function() 
	{
		console.log(this.value);
		
	});
	
	$('#emotion_weight_next').bind('click', function()
	{
	
		$('#emotion_weight').fadeOut(function()
		{
		
			
		});		
		
	});


});
</script>