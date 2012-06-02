<!-- Log Type: Feeling -->
<div id="log_thought" class="content_center text_center hide">
	<h1>Describe what you see right now</h1>
	<p><textarea name="log_thought" id="log_val_thought" placeholder="Very pretty but disturbing"></textarea></p>
	<p><a id="log_action_next" href="javascript:logThought()" class="button">Save</a></p>
</div>

<form name="log_data" id="log_data"></form>

<!-- Log Complete Screen -->
<div id="log_thanks" class="content_center text_center hide">
	<h1>Thanks :)</h1>
	<h3 id="log_completion_message"></h3>
	<p><a id="log_action_next" class="button" href="javascript:logThanks();">Another</a></p>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	logThoughtStart();

});
</script>