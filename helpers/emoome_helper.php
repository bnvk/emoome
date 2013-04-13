<?php

/* Makes Array with value of each key being 0 */
function make_counter_array($array) {
	
	$counter_array = array();
	
	foreach ($array as $key => $val) {
		$counter_array[$key] = 0;
	}	
	
	return $counter_array;
}

