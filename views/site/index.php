<!-- Where The Magic Happens -->
<div id="application"></div>

<!-- Public Views -->
<script type="text/html" id="index">
	<div id="content_index">
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
					<input type="text" name="name" id="signup_name_short" placeholder="Joe Smith" autocorrect="off" value=""><br>
					<span id="signup_name_short_error"></span>
				</p>
				<p>
					<label>Email</label><br>
					<input type="text" name="email" id="signup_email_short" placeholder="your@email.com" autocorrect="off" value=""><br>
					<span id="signup_email_short_error"></span>
				</p>		
				<p>
					<label>Password</label><br>
					<input type="password" name="password" id="signup_password_short" placeholder="********" autocorrect="off" value=""><br>
					<span id="signup_password_short_error"></span>
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
			<h1>Read about emo<span class="name_ome">ome...</span></h1>
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
</script>

<script type="text/html" id="login">
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
				<a href="<?= base_url() ?>#/forgot_password">Forgot password?</a>
			</p>
			<p>
				<input type="submit" name="submit" value="Login">
		  	</p>
		</form>
	</div>
</script>

<script type="text/html" id="signup">
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
</script>

<script type="text/html" id="logout">
		<h1>Thanks :)</h1>
		<h3>You are now logged out</h3>
</script>

<script type="text/html" id="forgot_password">
	<h1>Forgot Password</h1>
	<p>Please enter your email address</p>
	<form method="post" name="user_forgot_password" id="user_forgot_password" action="<?= base_url()."api/users/password_forgot"; ?>">
		<p>
			<input type="text" name="email" id="forgot_email" placeholder="you@email.com" value="">
		  	<span id="forgot_email_error"></span>
		</p>
		<p id="email_error"></p>
		<p><input type="submit" name="submit" value="Retrieve" /></p>
	</form>
</script>

<script type="text/html" id="not_found">
	<h1>Ooops</h1>
	<p>Sorry Broski, we could not find that page</p>
</script>


<!-- Record Views -->
<script type="text/html" id="record">
	<div id="content_test" class="content_center text_center">
		<p><a id="button_cat_feeling" class="list_button" href="<?= base_url() ?>#/record/feeling"><span class="list_icon list_icon_profile"></span>How You Feel</a></p>
		<p><a id="button_cat_memory" class="list_button" href="<?= base_url() ?>#/record/thought"><span class="list_icon list_icon_brain"></span>Group Thought</a></p>
	</div>
</script>

<script type="text/template" id="record_feeling">
	<div id="log_feeling_view" class="content_center text_center">
		<h1>How do you feel right now?</h1>
		<p><input type="text" name="log_feeling" id="log_val_feeling" placeholder="Good" value=""></p>
		<p><a id="log_feel_next" class="button" href="#">Next</a></p>
	</div>
</script>

<script type="text/html" id="record_experience">
	<div id="log_experience_view" class="content_center text_center">
		<h1>What is one thing you did today?</h1>
		<p><textarea name="log_experience" id="log_val_experience" placeholder="Walked my pet dog"></textarea></p>
		<p><a id="log_experience_next" href="#" class="button">Next</a></p>
	</div>
</script>

<script type="text/html" id="record_describe">
	<div id="log_describe_view" class="content_center text_center">
		<h1>Describe in three words</h1>
		<p id="log_describe_this"></p>
		<p><input type="text" name="log_describe_1" id="log_val_describe_1" placeholder="Three" value=""></p>
		<p><input type="text" name="log_describe_2" id="log_val_describe_2" placeholder="Separate" value=""></p>
		<p><input type="text" name="log_describe_3" id="log_val_describe_3" placeholder="Words" value=""></p>
		<p><a id="log_describe_next" class="button" href="#">Finish</a></p>
	</div>
</script>

<script type="text/html" id="record_thanks">
	<div id="log_thanks_view" class="content_center text_center">
		<h1>Thanks :)</h1>
		<h3 id="log_completion_message"></h3>
		<p><a id="log_thanks_next" class="button" href="#">Another</a></p>
	</div>
</script>


<!-- Visualize Views -->
<script type="text/html" id="visualize">
	<div id="visualize_waiting" class="content_center text_center">
		<h1>We are computing your emotions</h1>
		<div id="logs_needed">
			<p>You need to record</p>
			<div id="logs_needed_count"></div> 
			<p>More feelings before you can visualize</p>
		</div>
	</div>
</script>


<!-- Settings Views -->
<script type="text/html" id="settings">
	<div id="content_menu" class="content_center text_center">
		<?php if (!$this->agent->is_mobile()): ?>
		<h1>Settings</h1>
		<?php endif; ?>
		<p>
			<a id="button_notifications" class="list_button" href="<?= base_url() ?>#/settings/notifications">
				<span class="list_icon list_icon_notifications"></span>
				Notifications
			    <br class="clear">
			</a>
		</p>
		<p>
			<a id="button_account" class="list_button" href="<?= base_url() ?>#/settings/account">
				<span class="list_icon list_icon_account"></span>		
				Account Info
		 	    <br class="clear">
			</a>
		</p>
		<p>
			<a id="button_password" class="list_button" href="<?= base_url() ?>#/settings/password">
				<span class="list_icon list_icon_password"></span>		
				Password
		  		<br class="clear">
			</a>
		</p>
		<p>
			<a class="list_button" href="<?= base_url() ?>#/logout">
				<span class="list_icon list_icon_login"></span>		
				Logout
		  		<br class="clear">
			</a>
		</p>
	</div>
</script>


<script type="text/javascript" src="<?= base_url() ?>js/underscore.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/backbone-min.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/views.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/router.js"></script>
<script type="text/javascript">
	var router = new ApplicationRouter($('#application'));
	Backbone.history.start();
</script>
