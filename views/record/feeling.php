<!-- Log Type: Feeling -->
<div id="log_feeling" class="content_center text_center hide">
	<h1>How do you feel right now?</h1>
	<p><input type="text" name="log_feeling" id="log_val_feeling" placeholder="Good" value=""></p>
	<p><a id="log_feel_next" class="button" href="javascript:logFeeling()">Next</a></p>
</div>

<div id="log_experience" class="content_center text_center hide">
	<h1>What is one thing you did today?</h1>
	<p><textarea name="log_experience" id="log_val_experience" placeholder="Walked my pet dog"></textarea></p>
	<p><a id="log_experience_next" href="javascript:logExperience()" class="button">Next</a></p>
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
	<input type="hidden" name="log_type" value="feeling">
</form>

<!-- Log Complete Screen -->
<div id="log_thanks" class="content_center text_center hide">
	<h1>Thanks :)</h1>
	<h3 id="log_completion_message"></h3>
	<p><a id="log_thanks_next" class="button" href="javascript:logThanks();">Another</a></p>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	logFeelingStart();

});
</script>