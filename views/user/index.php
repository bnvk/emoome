<h2>Notifications</h2>

<ul class="edit rounded">
	<li>			
	<select name="notification_frequency">
		<option value="daily_3">3 x Day</option>
		<option value="daily_1">1 x Day</option>
		<option value="weekly">Weekly</option>
		<option value="none">None</option>
	</select>
</li>
<li><input type="tel" name="email" id="profile_phone" placeholder="503-100-1000" value=""></li>
<li>
	<select name="notification_method">
		<option value="push">Notification</option>
		<option value="sms">SMS</option>
		<option value="email">Email</option>
		<option value="all"></option>
	</select>
</li>
</ul>



<h2>Account</h2>

<ul class="edit rounded">
<li><input type="text" name="name" id="profile_name" placeholder="Your Name" value=""></li>
<li><input type="email" name="email" id="profile_email" placeholder="you@email.com" value=""></li>
<li>
	<select name="language" id="profile_language">
		<option value="en">English</option>
		<option value="fr">French</option>
		<option value="de">German</option>
		<option value="es">Spanish</option>
		<option value="it">Italian</option>
	</select>
</li>
<li>
	<select name="timezones" id="profile_timezone">
		<option value='UM10'>Hawaii Standard</option>
		<option value='UM9'>Alaska Standard</option>
		<option value='UM8'>Pacific Standard</option>
		<option value='UM7'>Mountain Standard</option>
		<option value='UM6'>Central Standard</option>
		<option value='UM5'>Eastern Standard</option>
		<option value='UTC'>Western European</option>
		<option value='UP1'>Central European</option>
		<option value='UP2'>Eastern European</option>
		<option value='UP3'>Moscow Time</option>
		<option value='UP8'>Australian Western / Beijing</option>
		<option value='UP875'>Australian Central</option>
		<option value='UP9'>Japan / Korea Standard</option>
		<option value='UP95'>Australian Central</option>
		<option value='UP10'>Australian Eastern</option>
	</select>				
</li>
<li><input type="checkbox" name="geo_enabled" id="profile_geo_enabled" value="" title="Add Location to Logs"></li>
</ul>



<h2>Change Password</h2>

<form name="change_password" id="change_password" method="post">
	<ul class="edit rounded">			
	<li><input type="password" name="old_password" value="">  </li>
	<li><input type="password" name="new_password" value=""></li>
	<li><input type="password" name="new_password_confirm" value=""></li>
</ul>
<p><input type="submit" id="settings_password_button" class="center" value="Save"></p>			
</form>