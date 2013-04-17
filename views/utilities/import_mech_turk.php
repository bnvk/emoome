<table width="70%" cellpadding="5">
<tr>
	<td><strong>Word</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td><strong>Action</strong></td>
</tr>
<?php
foreach ($report1 as $item):

	// Word Model
	$word = $this->words_model->check_word($item->word);
	$word_type = 'U';

	if ($item->Answer == 'Gibberish'):
	$word_status = 'N';
?>
<tr>
	<td><h3><?= $item->word ?></h3></td>
	<td><?= $item->Answer1 ?></td>
	<td><?= $item->Answer2 ?></td>
	<td></td>
	<td><span style="color: green">Updated as U</span></td>
</tr>
<?php 
	elseif ($item->Agreement == 'Yes'):
	$word_type = $item->Answer[0];
	$word_status = 'Y';
?>
<tr>
	<td><h3><?= $item->word ?></h3></td>
	<td><?= $item->Answer1 ?></td>
	<td><?= $item->Answer2 ?></td>
	<td></td>
	<td><span style="color: green">Updated as <?= $item->Answer[0] ?></span></td>
</tr>
<?php else: 
	
	// Find Average	
	if ($report2[$item->word] != 'Gibberish'):
		if (($report2[$item->word] == $item->Answer1) OR ($report2[$item->word] == $item->Answer2)):
			$action = '<span style="color: blue">Match :) updated as ' . $report2[$item->word][0];

			$word_type = $report2[$item->word][0];
			$word_status = 'Y';

			/*
			echo '<pre>';
			print_r($report2[$item->word]);
			echo '</pre>';
			*/
		else: 
			$action = '<span style="color: red">No Match :(';
			$word_status = 'N';
		endif;
	else: 
		$action = '<span style="color: black">Left as Gibberish U';
		$word_status = 'N';
	endif;	
?>
<tr>
	<td><h3><?= $item->word ?></h3></td>
	<td><?= $item->Answer1 ?></td>
	<td><?= $item->Answer2 ?></td>
	<td>	
	<?= $report2[$item->word] ?></td>
	<td><?= $action ?></span></td>
</tr>	
<?php
	endif;	
	
	
	// Update Word
	if ($word_status == 'Y'):
		$this->words_model->update_word($word->word_id, array('type' => $word_type));	
	endif;
	
	// Update Turk Status
	$this->db->where('HITID', $item->HITID);
	$this->db->update('import1', array('Updated' => $word_status));
		
endforeach; ?>
</table>