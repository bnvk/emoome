<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<title><?= $site_title ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="title" content="<?= site_title($sub_title, $page_title, $site_title) ?>" />
<meta name="description" content="<?= $site_description ?>" />
<meta name="keywords" content="<?= $site_keywords ?>" />
<meta name="author" content="Brennan Novak">

<!-- OpenGraph (Facebook) http://ogp.me -->
<meta property="og:title" content="<?= $site_title ?>"/>
<meta property="og:type" content="website" />
<meta property="og:image" content="<?= $site_assets ?>apple-touch-icon-114x114-precomposed.png"/>
<meta property="og:url" content="<?= base_url() ?>"/>
<meta property="og:site_name" content="<?= $site_title ?>"/>
<meta property="og:description" content="<?= $site_description ?>">

<link rel="stylesheet" media="screen" href="<?= $site_assets ?>css/site.css" type="text/css" />

<!-- Apple Icons -->
<link rel="apple-touch-icon-precomposed" href="<?= $site_assets ?>apple-touch-icon-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $site_assets ?>apple-touch-icon-57x57-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $site_assets ?>apple-touch-icon-72x72-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $site_assets ?>apple-touch-icon-114x114-precomposed.png" />

<!-- Favicon -->
<link rel="shortcut icon" href="<?= $site_assets ?>favicon.ico" />
<link rel="icon" type="image/png" href="<?= $site_assets ?>icon-32.png" />
</head>
<body>
<header>
	<div id="header">
		<div class="clear"></div>
	</div>	
</header>

<!-- Where The Magic Happens -->
<div id="container"></div>

<!-- Footer -->
<footer>
	<div class="clear"></div>
	<div id="footer">
		<p><a href="<?= base_url() ?>">Home</a> <a href="<?= base_url() ?>blog">Blog</a> <a href="<?= base_url() ?>privacy">Privacy</a> <a href="mailto:info@emoo.me">Contact</a></p>
		<p>&copy;<?= date('Y').' '.$site_title ?></p>
	</div>
</footer>


<!-- Partials -->
<script type="text/html" id="header_public">
	<div id="header_not_logged">
		<div id="header_logo"></div>
		<h1><a id="header_home" href="<?= base_url() ?>#">emo<span class="name_ome">ome</span></a></h1>
		<ul id="header_links_public" class="header_links">
			<li class="header_text">Have<br>Account</li>
			<li><a href="<?= base_url() ?>#/login"><span class="header_icons icon_login"></span>Login</a></li>
			<li class="header_text">Create<br>Account</li>
			<li><a href="<?= base_url() ?>#/signup"><span class="header_icons icon_signup"></span>Signup</a></li>
		</ul>
		<div class="clear"></div>
	</div>	
</script>

<script type="text/html" id="header_user">
	<div id="header_logged">
		<div id="header_logged_user">
			<div id="header_logged_avatar"><img src="<%= image %>"></div>
			<h1 id="header_logged_name"><%= name %></h1>
			<p id="header_logged_count"></p>
			<div class="clear"></div>
		</div>
		<ul id="header_links_logged" class="header_links">	
			<li><a href="<?= base_url() ?>#/record/feeling"><span class="header_icons icon_record"></span>Record</a></li>	
			<li><a href="<?= base_url() ?>#/visualize"><span class="header_icons icon_visualize"></span>Visualize</a></li>	
			<li><a href="<?= base_url() ?>#/settings"><span class="header_icons icon_settings"></span>Settings</a></li>
		</ul>
	</div>
</script>

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
		<p><input type="text" name="log_feeling" id="log_feeling_value" placeholder="Good" value=""></p>
		<p><button id="log_feel_next">Next</button></p>
	</div>
</script>

<script type="text/html" id="record_experience">
	<div id="log_experience_view" class="content_center text_center">
		<h1>What is one thing you did today?</h1>
		<p><textarea name="log_experience" id="log_experience_value" placeholder="Walked my pet dog"></textarea></p>
		<p><button id="log_experience_next">Next</button></p>
	</div>
</script>

<script type="text/html" id="record_describe">
	<div id="log_describe_view" class="content_center text_center">
		<h1>Describe in three words</h1>
		<p id="log_describe_this"></p>
		<p><input type="text" name="log_describe_1" id="log_describe_1_value" placeholder="Three" value=""></p>
		<p><input type="text" name="log_describe_2" id="log_describe_2_value" placeholder="Separate" value=""></p>
		<p><input type="text" name="log_describe_3" id="log_describe_3_value" placeholder="Words" value=""></p>
		<p><button id="log_describe_next">Finish</button></p>
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

<script type="text/html" id="settings_notifications">
	<div id="content_notifications" class="content_left text_left">
		<h1>Notifications</h1>
		<form name="settings_notifications" id="settings_notifications" method="post">	
		<p>	
			<label>How Often</label><br>
			<?= form_dropdown('notifications_frequency', config_item('notifications_frequency'), $notifications_frequency, 'id="notifications_frequency"') ?>
		</p>
		<p><input type="checkbox" class="nullify" name="notifications_mobile" value="<?= $notifications_mobile ?>"> &nbsp;Mobile (PUSH) Notifications</p>
		<p><input type="checkbox" class="nullify" name="notifications_sms" value="<?= $notifications_sms ?>"> &nbsp;Text Messages</p>
		<p><input type="checkbox" class="nullify" name="notifications_email" value="<?= $notifications_email ?>"> &nbsp;Email</p>
		<p><input type="submit" id="settings_notifications_button" class="center" value="Save"> &nbsp;&nbsp; <input type="submit" class="center cancel_button" value="Cancel"></p>			
		</form>
	</div>
</script>

<script type="text/html" id="settings_account">
	<div id="content_account" class="content_left text_left">
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
			<label>Phone (for reminders)</label><br>
			<input type="text" name="phone_number" id="profile_phone" placeholder="503-111-2222" value="<?= $this->session->userdata('phone_number') ?>">
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
</script>

<script type="text/html" id="settings_password">
	<div id="content_password" class="content_left text_left">	
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
</script>


<script type="text/javascript" src="<?= base_url() ?>js/jquery.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/emoome.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/backbone-min.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/auth.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/plugins.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/models.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/views.js"></script>
<script type="text/javascript" src="<?= module_assets_url('emoome') ?>js/router.js"></script>
<script type="text/javascript">
//Global User Data:
var user_data = {
	"user_id":"<?= $logged_user_id ?>",
	"username":"<?= $logged_username ?>",
	"user_level_id":"<?= $logged_user_level_id ?>",
	"name":"<?= $logged_name ?>",
	"image":"<?= $logged_image ?>",
	"location":"<?= $logged_location ?>",
	"geo_enabled":"<?= $logged_geo_enabled ?>",
	"geo_lat":"",
	"geo_lon":"",
	"language":"<?= $this->session->userdata('language') ?>",
	"privacy":"<?= $logged_privacy ?>",	 
	"consumer_key": "<?= $oauth_consumer_key ?>",
	"consumer_secret": "<?= $oauth_consumer_secret ?>",
	"token": "<?= $oauth_token ?>",
	"token_secret": "<?= $oauth_token_secret ?>",
	"source": "<?= $user_source ?>"
}

var base_url 		= '<?= base_url() ?>';
var site_assets		= '<?= $site_assets ?>';

$(document).ready(function()
{	
	// Load Auth
	var navigation = new NavigationView({ el: $('#header') });

	// Create Router
	var router = new ApplicationRouter($('#container'));

	// History
	Backbone.history.start();

	// Hides Things
	$('.error').hide();

	// Add Lightbox
	$('body').append('<div id="request_lightbox"><div id="lightbox_message">Blah blah blah I am cool!</div></div>');


	// Language Hide
	if (user_data.language != 'en' && user_data.language != '')
	{
		$('#container').html('<h1>Sorry!</h1><h3>We are not setup to handle non english languages at present.</h3><h3>We will let you know when we are.</h3>');
	}


	// Render Logged In ToolBar
	if (user_data.user_id != '')
	{		
		// Show Content
		if (isNotLoggedUrl(window.location.href))
		{		
			window.location = base_url + 'record/feeling'; 
		}
		else
		{
			//showWebLogged(user_data.name, user_data.image);
		}
	}
	else
	{
		$('#header_not_logged').fadeIn('normal');	
	}

	
});
</script>
<?php if (!$this->uri->segment(1)) echo $google_analytics; ?>
</body>
</html>

