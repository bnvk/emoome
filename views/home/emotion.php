	<div id="how_do_you_feel"><h2 class="hide">How do you feel right now?</h2></div>

	<div class="small_form center">
	<div class="small_form_top"></div>
	<div class="small_form_mid form">

		<form method="post" action="<?= base_url() ?>contribute/emotion">		
		<div id="small_form_inside">
			<input class="input_lg" type="text" size="42" name="emotion" value="" /><?= form_error('emotion'); ?>
			<div class="demo">				
				<div id="slider-range-min"></div>				
				<input type="text" size="3" name="percentage" id="emotion_amount" class="amount" />
			</div>	
			<input type="submit" value="" class="next center" />
		</div>	
		</form>		

	</div>
	<div class="small_form_bot"></div>		
	</div>	
