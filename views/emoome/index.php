<div id="content_index" class="content_left text_left hide">

	<div id="index_define">
		<h1 id="index_name"><span>emoome</span></h1>		
		<p class="index_define"><strong>emo</strong> - <em>a complex psychophysiological experience of an individual's state of mind as interacting with biochemical (internal) and environmental (external) influences</em></p> 
		<p class="index_define"><strong>ome</strong> - <em>as used in biology, refers to a totality of some sort</em></p>
	</div>

	<h3>~ Quantify Yourself</h3>
	<h3>~ Emotional Journaling</h3>
	<h3>~ Memory Mapping</h3>
	<h3>~ Life Visualization</h3>
	<h3>~ <a href="mailto:info@emoo.me">Contact Us</a></h3>

</div>

<?php if (!$this->agent->is_mobile()): ?>
<div id="content_discover" class="content_left text_center index_content hide">

	<h1>discover</h1>
	<h2>patterns in your thinking</h2>
	<img src="<?= $site_assets ?>images/dataviz_type_colors_small_1.png" border="0" alt="">
	<img src="<?= $site_assets ?>images/dataviz_type_colors_small_2.png" border="0" alt="">
	<h3>emotional &nbsp; physical &nbsp; sensory</h3>
	<h3>descriptive &nbsp; action &nbsp; intellectual</h3>

</div>

<div id="content_visualize" class="content_left text_center index_content hide">

	<h1>visualize</h1>
	<h2>experiences & feelings</h2>
	<img src="<?= $site_assets ?>images/dataviz_behavior_type_1.png" border="0" alt="">

</div>

<div id="content_about" class="content_left text_center index_content hide">

	<h1>about</h1>
	<p>Curious what this project is about? Browse this slideshow that was presented at the most recent <a href="http://quantifiedself.com" target="_blank">Quantified Self</a> Show & Tell held in Portland <a href="http://www.meetup.com/PDX-Quantified-Self/events/53688892/" target="_blank">April 10th, 2012</a></p>
	<div style="width:425px; margin: 25px auto" id="__ss_12504072"> 
		<iframe src="http://www.slideshare.net/slideshow/embed_code/12504072" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
	</div>

</div>
<?php endif; ?>


<div id="content_login" class="content_left text_left hide">
	<h1>Login</h1>
	<form method="post" name="user_login" id="user_login">
		<p>
			<label>Email</label><br>
			<input type="text" name="email" id="login_email" placeholder="you@email.com" autocorrect="off" value=""><br>
			<span id="login_email_error"></span>
		</p>
		<p>
			<label>Password</label><br>
			<input type="password" name="password" id="login_password" placeholder="********" autocorrect="off" value=""><br>
			<span id="login_password_error"></span>
		</p>
		<p>
			<label>Remember</label> <?= form_checkbox('remember', '1', TRUE, 'id="login_remember"');?> 
			<a href="<?= base_url() ?>forgot_password">Forgot password?</a>
		</p>
		<p>
			<input type="submit" name="submit" value="Login">
	  	</p>
	</form>
</div>

<div id="content_signup" class="content_left text_left hide">
	<h1>Signup</h1>
	<form method="post" name="user_signup" id="user_signup">
		<p>
			<label>Name</label><br>
			<input type="text" name="name" id="signup_name" placeholder="Joe Smith" autocorrect="off" value=""><br>
			<span id="signup_name_error"></span>
		</p>
		<p>
			<label>Email</label><br>
			<input type="text" name="email" id="signup_email" placeholder="your@email.com" autocorrect="off" value=""><br>
			<span id="signup_email_error"></span>
		</p>
		<p>
			<label>Phone (optional for reminders)</label><br>
			<input type="text" name="phone_number" id="profile_phone" placeholder="503-111-2222" value="<?= $this->session->userdata('phone') ?>">
		</p>		
		<p>
			<label>Password</label><br>
			<input type="password" name="password" id="signup_password" placeholder="********" autocorrect="off" value=""><br>
			<span id="signup_password_error"></span>
		</p>
		<p>
			<label>Language</lable><br>
			<?= form_dropdown('language', config_item('languages'), 'en') ?>
		</p>
		<p>
			<input type="submit" name="submit" value="Signup">
		</p>
	</form>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	// Already Logged In
	var current_url	= document.location.hash.replace('#!/','');
	var index_views = new Array('content_index', 'content_discover', 'content_visualize', 'content_about');
	var pages_views	= new Array('content_login', 'content_signup');

	if (current_url.length != '') 
	{
		var this_view = 'content_' + current_url;
		
		$.each(index_views, function(key, view)
		{	
			$('#' + view).hide();
		});		

		$.each(pages_views, function(key, view)
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
		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});	
	
		$.each(index_views, function(key, view)
		{	
			$('#' + view).delay(250).fadeIn();
		});		
	}



	// Show Index
	$('#header_home').bind('click', function(e)
	{
		e.preventDefault();
		history.pushState("", document.title, window.location.pathname + window.location.search);
		$('#content_login, #content_signup').hide();

		$.each(index_views, function(key, view)
		{	
			$('#' + view).delay(250).fadeIn();
		});	
	});

	// Show Login
	$('#button_login').bind('click', function(e)
	{
		$.each(index_views, function(key, view)
		{	
			$('#' + view).hide();
		});		
	
		$('#content_signup').hide();
		$('#content_login').delay(250).fadeIn();	
	});

	// Show Signup
	$('#button_signup').bind('click', function(e)
	{
		$.each(index_views, function(key, view)
		{	
			$('#' + view).hide();
		});

		$('#content_login').hide();
		$('#content_signup').delay(250).fadeIn();	
	});

	$('#user_login').bind('submit', function(e)
	{	
		e.preventDefault();
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#login_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid Email',
					'action'	: 'label'	
				},{
					'selector' 	: '#login_password', 
					'rule'		: 'require', 
					'field'		: 'Please enter your Password',
					'action'	: 'label'
				}],
			message : '',
			success	: function()
			{
				var login_data = $('#user_login').serializeArray();
				login_data.push({'name':'session','value':'1'});
			
				$.ajax(
				{
					url			: base_url + 'api/users/login',
					type		: 'POST',
					dataType	: 'json',
					data		: login_data,
					beforeSend	: requestMade('Logging You In'),					
			  		success		: function(result)
			  		{
						// Close Loading
			  			requestComplete(result.message, result.status);
	  			  		
						if (result.status == 'success')
						{
							setTimeout(function() { window.location.href = base_url + 'record/feeling' });					
						}
				 	}
				});
			}
		});
	});


	$("#user_signup").bind('submit', function(e)
	{	
		e.preventDefault();	
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#signup_name', 
					'rule'		: 'require', 
					'field'		: 'Enter your name',
					'action'	: 'label'					
				},{
					'selector' 	: '#signup_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid email',
					'action'	: 'label'							
				},{
					'selector' 	: '#signup_password', 
					'rule'		: 'require', 
					'field'		: 'Please enter a password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{					
				var signup_data = $('#user_signup').serializeArray();
				signup_data.push({'name':'session','value':'1'},{'name':'password_confirm','value':$('#signup_password').val()});
				$.ajax(
				{
					url			: base_url + 'api/users/signup',
					type		: 'POST',
					dataType	: 'json',
					data		: signup_data,
					beforeSend	: requestMade('Creating Account'),
			  		success		: function(result)
			  		{
						// Close Loading
			  			requestComplete(result.message, result.status);	
	
						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');

							setTimeout(function() { window.location.href = base_url + 'record/feeling' });
						}
				 	}
				});
			}
		});
	});	

});
</script>
