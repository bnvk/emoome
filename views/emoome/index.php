<div class="content_double">
	<div id="about_project"><a class="img_link" href="<?= base_url() ?>site/about"><h2 class="hide">About The Project</h2></a></div>
		
	<ul class="arrow">
		<li class="arrow">What'd you do two thursdays ago and how did it make you feel?</li>
		<li class="arrow">Want to change but don't know what?</li>
		<li class="arrow">Believe in the power of the internet?</li>
		<li class="arrow">Want to contribute to art & science?</li>
		<li class="blank"><h3><a href="<?= base_url() ?>site/about">read more</a></h3></li>
	</ul>
	
</div>	

<div class="content_double">

	<?php if($this->session->userdata('is_logged_in') == true) { ?>
	<div id="thanks"><h2 class="hide">Thanks :)</h2></div>
	<ul class="arrow">
		<li class="blank">Thanks <?= $this->session->userdata('name'); ?> for participating in project <strong>emoome</strong>!</li>
		<li class="blank"><h3><a href="<?= base_url() ?>contribute">How do you feel right now?</a></h3></li>
	</ul>

	<?php } if($this->session->userdata('is_logged_in') != true) { ?>
	
	<div id="please_participate"><h2 class="hide">Please Participate</h2></div>
	<div class="small_form center">		
	<div class="small_form_top"></div>
	<div class="small_form_mid form">
	<form method="post" action="<?= base_url() ?>login/validate_credentials" autocomplete="off">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="txt_right">email</td>
			<td><input type="text" size="32" name="email" placeholder="you@website.com" value="" /></td>
		</tr>
		<tr>
			<td class="txt_right">password</td>
			<td><input type="password" size="32" name="password" value="" /></td>
		</tr>
		<tr>
			<td colspan="2" class="txt_right"><input type="submit" value="" class="login right" /></td>
		</tr>
		</table>
	</form>			
	</div>
	<div class="small_form_bot"></div>
	</div>
	<table width="72%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><h3>Join the experiment</h3></td>
		<td><a href="<?= base_url() ?>login/signup" class="signup"></a></td>
	</tr>
	</table>
	<?php } ?>
	
</div>	

<div class="clear"></div>
