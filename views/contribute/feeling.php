<!-- Log Type: Feeling -->
<div id="log_feeling" class="view_center">
	<h1>How do you feel right now?</h1>	
	<p><input type="text" name="log_feeling" id="log_val_feeling" value=""></p>		
	<p><a id="log_feel_next" class="form_button center" href="javascript:logFeeling()">Next</a></p>
</div>

<div id="log_action" class="view_center">
	<h1>What is one thing you did today?</h1>
	<!-- <p><input type="text" name="log_action" id="log_val_action" value=""></p> -->
	<p><textarea name="log_action" id="log_val_action"></textarea></p>
	<p><a id="log_action_next" href="javascript:logAction()" class="form_button center">Next</a></p>
</div>

<div id="log_describe" class="view_center">
	<h1>Describe in three words</h1>
	<p id="log_describe_this"></p>
	<p><input type="text" name="log_describe_1" id="log_val_describe_1" value=""></p>
	<p><input type="text" name="log_describe_2" id="log_val_describe_2" value=""></p>
	<p><input type="text" name="log_describe_3" id="log_val_describe_3" value=""></p>
	<p><a id="log_describe_next" class="form_button center" href="javascript:logDescribe();">Finish</a></p>
</div>

<form name="log_data" id="log_data">
	<input type="hidde" name="log_type" value="feeling">
</form>

<!-- Log Complete Screen -->
<div id="log_thanks" class="view_center">
	<h1>Thanks :)</h1>
	<p><a id="log_action_next" class="form_button center" href="javascript:tabLog()">Another</a></p>
</div>