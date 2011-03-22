	<div id="what_are_two_things"><a href=""><h2 class="hide">What are two things you did today?</h2></a></div>

	
	<div class="small_form center">
	<div class="small_form_top"></div>
	<div class="small_form_mid form">

	<form method="post" action="<?= base_url() ?>contribute/behaviors_add/<?= $this->uri->segment(3) ?>">		
	<div id="small_form_inside">
		<input class="input_lg" type="text" size="32" name="behavior_1" value="<?= set_value('behavior_1') ?>" /><?= form_error('behavior_1'); ?>
		<input class="input_lg" type="text" size="32" name="behavior_2" value="<?= set_value('behavior_2') ?>" /><?= form_error('behavior_2'); ?>
		<input type="submit" value="" class="next center" />
	</div>
	</form>
	
	</div>
	<div class="small_form_bot"></div>		
	</div>	