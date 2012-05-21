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



<!-- Auth Pages -->
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




<!-- Log Type: Feeling -->
<div id="content_log_feeling" class="hide">

	<div id="log_feeling" class="content_center text_center">
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
		<input type="hidden" name="log_type" value="feeling">
	</form>
	
	<!-- Log Complete Screen -->
	<div id="log_thanks" class="content_center text_center hide">
		<h1>Thanks :)</h1>
		<h3 id="log_completion_message"></h3>
		<p><a id="log_action_next" class="button" href="javascript:logThanks();">Another</a></p>
	</div>

</div>


<script type="text/javascript">
$(document).ready(function()
{
	// Determine View
	determineView();



	// Show Index
	$('#header_home').bind('click', function(e)
	{
		e.preventDefault();
		history.pushState("", document.title, window.location.pathname + window.location.search);

		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});	

		$('#content_index').delay(250).fadeIn();
	});


	$('.navigation_button').bind('click', function(e)
	{
		var view = $(this).attr('href').split('#!/');
		console.log('show view ' + view[1]);
	
		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});

		$('#content_' + view[1]).delay(250).fadeIn();	
	});
	


	// Hijack Spacebar For Log...
	$('#log_val_feeling').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function(key)
	{		
		printUserMessage('Enter only a single word (no spaces or numbers)');
	});


	$('#log_val_describe_1, #log_val_describe_2, #log_val_describe_3').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function()
	{
		printUserMessage('Enter only a single word (no spaces or numbers)');
	});	
	

});
</script>
