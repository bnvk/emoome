<div id="content_index" class="content_left text_left">

	<div id="index_define">
		<h1 id="index_name"><span>emoome</span></h1>		
		<p class="index_define"><strong>emo</strong> - <em>a complex psychophysiological experience of an individual's state of mind as interacting with biochemical (internal) and environmental (external) influences</em></p> 
		<p class="index_define"><strong>ome</strong> - <em>as used in biology, refers to a totality of some sort</em></p>
	</div>

	<h3>~ Quantify Yourself</h3>
	<h3>~ Emotional Journaling</h3>
	<h3>~ Memory Mapping</h2>
	<h3>~ Linguistics + Psychology</h3>
	<h3>~ <a href="mailto:info@emoo.me">Contact</a></h3>

</div>

<div id="content_login" class="content_left text_left">
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

<div id="content_signup" class="content_left text_left">
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
			<label>Password</label><br>
			<input type="password" name="password" id="signup_password" placeholder="********" autocorrect="off" value=""><br>
			<span id="signup_password_error"></span>
		</p>
		<p>	
			<label>Confirm Password</label><br>
			<input type="password" name="password_confirm" id="signup_password_confirm" placeholder="********" autocorrect="off" value=""><br>
			<span id="signup_password_confirm_error"></span>
		</p>
		<p>
			<input type="submit" name="submit" value="Signup">
		</p>
	</form>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	// Show Proper View
	var current_url	= document.location.hash.replace('#!/','');
	var index_views = new Array('content_index', 'content_login', 'content_signup');

	if (current_url.length != '') var this_view = 'content_' + current_url;
	else var this_view = 'content_index';

	$.each(index_views, function(key, view)
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


	// Show Index
	$('#header_home').bind('click', function(e)
	{
		e.preventDefault();		
		history.pushState("", document.title, window.location.pathname + window.location.search);
		$('#content_login, #content_signup').hide();
		$('#content_index').delay(250).fadeIn();		
	});
	
	// Show Login
	$('#button_login').bind('click', function(e)
	{
		$('#content_index, #content_signup').hide();
		$('#content_login').delay(250).fadeIn();	
	});
	
	// Show Signup
	$('#button_signup').bind('click', function(e)
	{
		$('#content_index, #content_login').hide();
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
			  		success		: function(result)
			  		{			  		
						if (result.status == 'success')
						{
							setTimeout(function() { window.location.href = base_url + 'record/feeling' });					
						}
						else
						{
							$('html, body').animate({scrollTop:0});
							$('#content_message').notify({status:result.status,message:result.message});					
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
				},{
					'selector' 	: '#signup_password_confirm', 
					'rule'		: 'confirm', 
					'field'		: 'Please confirm your password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{					
				var signup_data = $('#user_signup').serializeArray();
				signup_data.push({'name':'session','value':'1'});
				$.ajax(
				{
					url			: base_url + 'api/users/signup',
					type		: 'POST',
					dataType	: 'json',
					data		: signup_data,
			  		success		: function(result)
			  		{
						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');
							$('[name=password_confirm]').val('');						

							setTimeout(function() { window.location.href = base_url + 'record/feeling' });
						}
						else
						{
							$('html, body').animate({scrollTop:0});
							$('#content_message').notify({status:result.status,message:result.message});					
						}
				 	}
				});
			}
		});
	});	

});
</script>