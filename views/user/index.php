<div id="content_menu" class="content_center text_center">
	<p>
		<a id="button_notifications" class="category_button" href="<?= base_url() ?>emoome/user/#!/notifications">
			<span class="cat_link_icon_small icon_small_notifications"></span>
			<span class="cat_link_text_small">Notifications</span>
		    <br class="clear">
		</a>
	</p>
	<p>
		<a id="button_account" class="category_button" href="<?= base_url() ?>emoome/user/#!/account">
			<span class="cat_link_icon_small icon_small_account"></span>		
			<span class="cat_link_text_small">Account Info</span>
	 	    <br class="clear">
		</a>
	</p>
	<p>
		<a id="button_password" class="category_button" href="<?= base_url() ?>emoome/user/#!/password">
			<span class="cat_link_icon_small icon_small_password"></span>		
			<span class="cat_link_text_small">Password</span>
	  		<br class="clear">
		</a>
	</p>
</div>


<div id="content_notifications" class="content_left text_left hide">
	<h1>Notifications</h1>
	<form name="settings_notifications" id="settings_notifications" method="post">	
	<p>	
		<label>How Often</label><br>	
		<select name="notification_frequency">
			<option value="daily_3">3 x Day</option>
			<option value="daily_1">1 x Day</option>
			<option value="daily_alternate">Every Other Day</option>
			<option value="weekly">Weekly</option>
			<option value="none">None</option>
		</select>
	</p>
	<p><input type="checkbox" name="notification_method" value="mobile"> Mobile Notifications</p>
	<p><input type="checkbox" name="notification_method" value="sms"> Text Messages</p>
	<p><input type="checkbox" name="notification_method" value="email"> Email</p>
	<p><input type="submit" id="settings_notifications_button" class="center" value="Save"> &nbsp;&nbsp; <input type="submit" class="center cancel_button" value="Cancel"></p>			
	</form>
</div>


<div id="content_account" class="content_left text_left hide">
	<h1>Account Info</h1>
	<form name="settings_account" id="settings_account" method="post">	
	<p>	
		<label>Name</label><br>
		<input type="text" name="name" id="profile_name" placeholder="Your Name" value="<?= $this->session->userdata('name') ?>">
	</p>
	<p>
		<label>Email</label><br>
		<input type="email" name="email" id="profile_email" placeholder="you@email.com" value="<?= $this->session->userdata('email') ?>">
	</p>
	<p>
		<label>Phone</label><br>
		<input type="text" name="phone" id="profile_phone" placeholder="503-111-2222" value="<?= $this->session->userdata('phone') ?>">
	</p>
	<p>
		<label>Language</lable><br>
		<?= form_dropdown('language', config_item('languages'), $this->session->userdata('language')); ?>
	</p>
	<p>
		<label>Timezone</lable><br>	
		<select name="timezones" id="profile_timezone">
			<option value=''>---select---</option>
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
	</p>
	<p><input type="checkbox" name="geo_enabled" id="profile_geo_enabled" value="" title="Add Location to Logs"> &nbsp;Add Location</p>
	<p>
		<input type="submit" id="settings_account_button" class="center" value="Save"> &nbsp;&nbsp; <input type="submit" class="center cancel_button" value="Cancel">
	</p>		
	</form>	
</div>


<div id="content_password" class="content_left text_left hide">	
	<h1>Change Password</h1>
	<form name="settings_change_password" id="settings_change_password" method="post">
	<p>
		<label>Old Password</label><br>
		<input type="password" name="old_password" value="">
	</p>
	<p>
		<label>New Password</label><br>
		<input type="password" name="new_password" value="">
	</p>
	<p>
		<label>New Password Confirm</label><br>
		<input type="password" name="new_password_confirm" value="">
	</p>
	<p><input type="submit" id="settings_password_button" class="center" value="Save"> &nbsp;&nbsp; <input type="submit" class="center cancel_button" value="Cancel"></p>			
	</form>
</div>

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function()
{	

	// Already Logged In
	var current_url	= document.location.hash.replace('#!/','');
	var settings_views = new Array('content_menu', 'content_notifications', 'content_account', 'content_password');

	if (current_url.length != '') 
	{
		var this_view = 'content_' + current_url;	

		$.each(settings_views, function(key, view)
		{	
			if (view == this_view)
			{
				$('#' + view).delay(250).fadeIn();			
			}
			else
			{
				$('#' + view).hide();
			}
		});
	}
	else
	{			
		$.each(settings_views, function(key, view)
		{	
			$('#' + view).hide();
		});	
		
		$('#content_menu').delay(250).fadeIn();		
	}


	// Show Views	
	$('#button_notifications').bind('click', function(e)
	{
		$.each(settings_views, function(key, view)
		{	
			$('#' + view).hide();
		});		
	
		$('#content_menu').hide();
		$('#content_notifications').delay(250).fadeIn();	
	});
	
	$('#button_account').bind('click', function(e)
	{
		$.each(settings_views, function(key, view)
		{	
			$('#' + view).hide();
		});		
	
		$('#content_menu').hide();
		$('#content_account').delay(250).fadeIn();	
	});	

	$('#button_password').bind('click', function(e)
	{
		$.each(settings_views, function(key, view)
		{	
			$('#' + view).hide();
		});		
	
		$('#content_menu').hide();
		$('#content_password').delay(250).fadeIn();	
	});
	
	// Cancel / Show Menu
	$('.cancel_button').bind('click', function(e)
	{
		e.preventDefault();	
		history.pushState("", document.title, window.location.pathname + window.location.search);	
	
		$.each(settings_views, function(key, view)
		{	
			$('#' + view).hide();
		});
		
		$('#content_menu').delay(250).fadeIn();					
	});


	// Settings Forms
	$('#settings_notifications').bind('submit', function(e)
	{
		e.preventDefault();
		requestMade('Saving notification settings');
		requestComplete('error', 'Oops we are still working on this feature. It will be ready soon');
	});


	$("#settings_account").bind('submit', function(e)
	{	
		e.preventDefault();	
		$.oauthAjax(
		{
			oauth 		: user_data,
			url			: base_url + 'api/users/modify/id/' + user_data.user_id,
			type		: 'POST',
			dataType	: 'json',
			data		: $('#settings_account').serializeArray(),
			beforeSend	: requestMade('Saving account changes'),			
	  		success		: function(result)
	  		{
				// Close Loading
		  		requestComplete(result.message, result.status);
		 	}
		});		
	});		
	
	
	$("#settings_change_password").bind("submit", function(e)
	{
		e.preventDefault();
		$.oauthAjax(
		{
			oauth 		: user_data,
			url			: base_url + 'api/users/password',
			type		: 'POST',
			dataType	: 'json',
			data		: $('#settings_change_password').serializeArray(),
			beforeSend	: requestMade('Changing your password'),
	  		success		: function(result)
	  		{
				// Close Loading
		  		requestComplete(result.message, result.status);
	  			-			
			 	$('[name=old_password]').val('');
			 	$('[name=new_password]').val('');
			 	$('[name=new_password_confirm]').val('');
	  				  					  			  			
		 	}
		});		
	});		

});
</script>