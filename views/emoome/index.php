<div id="content_index" class="hide">

	<div id="index_content_1" class="index_content">
		<h2>record your experiences & feelings</h2>
		<h2>visualize moments from your life</h2>
	</div>
	
	<div id="index_define">
		<p><strong>emo</strong> - <em>a complex psychophysiological experience of an individual's state of mind; interacting w/ biochemical & environmental influences</em></p> 
		<p><strong>ome</strong> - <em>as used in biology, refers to a totality of some sort</em></p>
		<br class="clear">
	</div>

	<div id="index_content_2" class="index_content">
		<h2>discover patterns in your thinking</h2>	
	</div>

	<div id="index_signup">
		<?php if ($this->social_auth->logged_in()): ?>
		<h2>Ready to begin?</h2>
		<h3>Get Started Now</h3>
		<form method="post" name="user_signup_short" id="user_signup_short">
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
		<?php else: ?>
		
		<?php endif; ?>
	</div>
	<div class="clear"></div>

	<div id="index_quotes">
		<h1>Learn more about emo<span class="name_ome">ome...</span></h1>
		<div class="quote_container">
			<a href="http://www.readwriteweb.com/archives/how-well-get-beyond-the-emoticon.php" target="_blank">
				<span class="quote_title">How We'll Get Beyond the Emoticon</span>
				<span class="quote_quote">"[Emoome] reveals shifts around major life events, which is powerful to look back on after the fact"</span>
				<span class="quote_image quote_image_rww"></span>
			</a>
		</div>
		<div class="quote_container">
			<a href="http://siliconflorist.com/2012/05/01/emoome-emotional/" target="_blank">
				<span class="quote_title">Are you trying to get all emotional on me?</span>
				<span class="quote_quote">"The site is addictive. And the visualizations are beautiful, even in this early iteration."</span>
				<span class="quote_image quote_image_silicon"></span>
			</a>
		</div>
	</div>

</div>




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
