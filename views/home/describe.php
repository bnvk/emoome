	<div id="describe_in_three"><a href=""><h2 class="hide">About The Project</h2></a></div>

	<?php if(isset($records)) : foreach($records as $row) : ?>
	<h3 class="describe_behavior">"<?= $row->behavior; ?>"</h3>
	<?php  endforeach; endif; ?>
		
	<div class="small_form center">
	<div class="small_form_top"></div>
	<div class="small_form_mid form">

	<form method="post" action="<?= base_url() ?>contribute/describe">		
	<div id="small_form_inside">			
		<input type="text" size="32" name="describe1" value="<?= set_value('describe1') ?>" /><?= form_error('describe1'); ?>
		<input type="text" size="32" name="describe2" value="<?= set_value('describe2') ?>" />
		<input type="text" size="32" name="describe3" value="<?= set_value('describe3') ?>" />
		<input type="submit" value="" class="next center" />
	</div>		
	</form>
	
	</div>
	<div class="small_form_bot"></div>		
	</div>	