<!-- Log Type: Feeling -->
<div id="log_feeling" class="content_center text_center hide">
	<h1>How do you feel right now?</h1>
	<p><input type="text" name="log_feeling" id="log_val_feeling" placeholder="Good" value=""></p>
	<p><a id="log_feel_next" class="button" href="javascript:logFeeling()">Next</a></p>
</div>

<div id="log_action" class="content_center text_center hide">
	<h1>What is one thing you did today?</h1>
	<p><textarea name="log_action" id="log_val_action" placeholder="Walked my pet dog"></textarea></p>
	<p><a id="log_action_next" href="javascript:logAction()" class="button">Next</a></p>
</div>

<div id="log_describe" class="content_center text_center hide">
	<h1>Describe in three words</h1>
	<p id="log_describe_this"></p>
	<p><input type="text" name="log_describe_1" id="log_val_describe_1" placeholder="Three" value=""></p>
	<p><input type="text" name="log_describe_2" id="log_val_describe_2" placeholder="Separate" value=""></p>
	<p><input type="text" name="log_describe_3" id="log_val_describe_3" placeholder="Words" value=""></p>
	<p><a id="log_describe_next" class="button" href="javascript:logDescribe();">Finish</a></p>
</div>

<form name="log_data" id="log_data">
	<input type="hidden" name="geo_lat" id="geo_lat" value="">
	<input type="hidden" name="geo_lon" id="geo_lon" value="">
	<input type="hidden" name="log_type" value="feeling">
</form>

<!-- Log Complete Screen -->
<div id="log_thanks" class="content_center text_center hide">
	<h1>Thanks :)</h1>
	<h3></h3>
	<p><a id="log_action_next" class="button" href="javascript:logThanks();">Another</a></p>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	logFeelingStart();

	var patt = '';//new RegExp('a-zA-Z', 'some 5 shit');
	console.log(patt);
	
	
	var new_array = _.shuffle(messages.log_feeling_complete);
	
	console.log(new_array[0]);


	// Do Geo Location
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);
	}

	// Hijack Spacebar in a few places...
	$('#log_val_feeling').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function(key)
	{
		console.log(key)
		
		printUserMessage('Enter only a single word');
	});


	$('#log_val_describe_1, #log_val_describe_2, #log_val_describe_3').jkey('space', function()
	{
		printUserMessage('Enter only a single word');
	});

});
</script>