<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name:  	Emoome Library
* Author:  	Brennan Novak 
*
* Location: http://github.com/brennannovak/emoome
*/

class Emoome
{
	protected $ci;

	function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->config('emoome');
		$this->ci->load->helper('math');
		$this->ci->load->helper('emoome');
    $this->ci->load->model('experiences_model');
    $this->ci->load->model('emoome_model');
    $this->ci->load->model('logs_model');
    $this->ci->load->model('thoughts_model');
    $this->ci->load->model('words_model');

    // Language Files
		$this->ci->lang->load('common');
	}


	/**
	 * update_users_meta_map function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return void
	 */
	function update_users_meta_map($user_id)
	{
		$users_meta	= $this->ci->emoome_model->get_users_meta_map($user_id);
		$word_count	= array();

		if ($users_meta):

			// Loops Existing Word Types
			foreach (config_item('emoome_word_types') as $key => $type):
	 			$word_count[$type] = $this->ci->words_model->count_user_word_type($user_id, $key);
			endforeach;			
			
			$update_data = array(
				'user_id'		=> $user_id,
				'site_id'		=> config_item('site_id'),
				'module'		=> 'emoome',
				'meta'			=> 'word_type_map',
				'value'			=> json_encode($word_count),
				'updated_at'	=> unix_to_mysql(now())			
			);

			return $this->ci->emoome_model->update_users_meta_map($users_meta->user_meta_id, $update_data);
		else:
			return $this->ci->emoome_model->add_users_meta_map($user_id);
		endif;

		return FALSE;
	}
	

	/**
	 * generate_object_ids function.
	 * 
	 * @access public
	 * @param mixed $object
	 * @param mixed $param
	 * @return void
	 */
	function generate_object_ids($object, $param)
	{
		$ids = array();
			
		foreach ($object as $item):
			$ids[] = $item->$param;	
		endforeach;
		
		return $ids;
		
	}
	

	/**
	 * generate_moods_log_ids function.
	 * 
	 * @access public
	 * @param mixed $words
	 * @return void
	 */
	function generate_moods_log_ids($words)
	{
		// GENERATE MOOD log_ids
		$moods = array();
				
		foreach ($words as $word):
			if ($word->used == 'F'):
				$sentiment = $word->sentiment * 2;
				$moods[$sentiment][] = $word->log_id;	
			endif;
		endforeach;
				
		krsort($moods);
		
		return $moods;
	}


	/**
	 * analyze_words_link function.
	 * 
	 * @access public
	 * @param mixed $words_link
	 * @param mixed $details (default: FALSE)
	 * @return void
	 */
	function analyze_words_link($words_link, $details=FALSE)
	{
		$analysis				= array();
		$log_ids				= array();
		$language				= array();
		$words					= array();
		$word_used				= config_item('emoome_word_used');
		$word_type				= config_item('emoome_word_types');
		$word_type_sub			= config_item('emoome_word_types_sub');
		$word_type_count		= make_counter_array(config_item('emoome_word_types'));
		$word_type_sub_count	= make_counter_array(config_item('emoome_word_types_sub'));
		$sentiment				= 0;
		$sentiment_normalize	= array('F' => 3, 'D' => 2, 'E' => 1); 			// Gives more priority to Feeling, Descriptor, Experience respectively 	

		// Analyze Words
		foreach ($words_link as $word):

			// Type
			$word_type_count[$word->type] = $word_type_count[$word->type] + 1;

			// Type Sub
			$word_type_sub_count[$word->type_sub] = $word_type_sub_count[$word->type_sub] + 1;
			
			// Sentiment
			$sentiment += $word->sentiment * $sentiment_normalize[$word->used];
			
			// Words
			if (array_key_exists($word->word, $words)):
				$words[$word->word] = $words[$word->word] + 1;			
			else:
				$words[$word->word] = 1;
			endif;
			
			// Logs Count
			if (!in_array($word->log_id, $log_ids)):
				$log_ids[] = $word->log_id;
			endif;

		endforeach;
		
		// Remove Words with only '1' count
		//$words = array_diff($words, array(1));
		
		// Output Type
		$language_total = 0;
				
		foreach (array_filter($word_type_count) as $type => $count):
		    $type   	 	 = $word_type[$type];
		    $percent 		 = $count;
		    $language_total  = $language_total + $count;
		    $language[$type] = $percent;
		endforeach;

		arsort($language);
		$analysis['language']		= $language;
		$analysis['language_total']	= $language_total;

		// Output Type Sub
		foreach (array_filter($word_type_sub_count) as $type_sub => $count):
		    $type_sub_word = $word_type_sub[$type_sub];
		    $analysis['topics'][$type_sub_word] = $word_type_sub_count[$type_sub];
		endforeach;

		// Output Sentiment
		$analysis['sentiment']	= $sentiment;
		
		// Output Words
		arsort($words);
		$analysis['words']		= $words;
		$analysis['log_count']	= count($log_ids);		

		return $analysis;
	}


	/**
	 * analyze_log function.
	 * 
	 * @access public
	 * @param mixed $log
	 * @param mixed $details (default: FALSE)
	 * @return void
	 */
	function analyze_log($log, $details=FALSE)
	{
		$analysis				= array();
		$words					= array();
		$word_used				= config_item('emoome_word_used');
		$word_type				= config_item('emoome_word_types');
		$word_type_sub			= config_item('emoome_word_types_sub');
		$word_type_count		= make_counter_array(config_item('emoome_word_types'));
		$word_type_sub_count	= make_counter_array(config_item('emoome_word_types_sub'));
		$sentiment				= 0;
		$sentiment_normalize	= array('F' => 3, 'D' => 2, 'E' => 1); 	// Gives more priority to Feeling, Descriptor, Experience respectively 

		// Experience
		// To be refactored later using words_link
		$experience_words = $this->ci->words_model->get_words_words(explode(' ', $log->experience));
		
		// Analyze Experience
		foreach ($experience_words as $word):

			// Type
			$word_type_count[$word->type] = $word_type_count[$word->type] + 1;

			// Type Sub
			$word_type_sub_count[$word->type_sub] = $word_type_sub_count[$word->type_sub] + 1;
			
			// Sentiment
			$sentiment += $word->sentiment * $sentiment_normalize['E'];
		endforeach;
		
		// Analyze Words
		foreach ($log->words as $word):

			// Type
			$word_type_count[$word->type] = $word_type_count[$word->type] + 1;

			// Type Sub
			$word_type_sub_count[$word->type_sub] = $word_type_sub_count[$word->type_sub] + 1;
			
			// Sentiment
			$sentiment += $word->sentiment * $sentiment_normalize[$word->used];
			
			// Words
			if (array_key_exists($word->word, $words)):
				$words[$word->word] = $words[$word->word] + 1;
			else:
				$words[$word->word] = 1;
			endif;
		endforeach;

		// Output Type
		foreach (array_filter($word_type_count) as $type => $count):
		    $type    = $word_type[$type];
		    $percent = $count; //percent($count, 4 + count($experience_words));
		    $analysis['language'][$type] = $percent;
		endforeach;
		
		// Output Type Sub
		foreach (array_filter($word_type_sub_count) as $type_sub => $count):
		    $type_sub_word = $word_type_sub[$type_sub];
		    $analysis['topics'][$type_sub_word] = $word_type_sub_count[$type_sub];
		endforeach;

		// Output Sentiment
		$analysis['sentiment']	= $sentiment;
		
		// Output Words
		$analysis['words'] = $words;
		

		// Details (full log result)
		if ($details):
			$analysis['user_id']	= $log->user_id;
			$analysis['experience'] = $log->experience;
			$analysis['type']		= $log->type;
			$analysis['source']		= $log->source;
			$analysis['geo_lat']	= $log->geo_lat;
			$analysis['geo_lon']	= $log->geo_lon;
			$analysis['created_at'] = $log->created_date.' '.$log->created_time; 
		endif;
				
		return $analysis;
	}


	/**
	 * analyze_text function.
	 * 
	 * @access public
	 * @param mixed $text
	 * @param mixed $filter_common (default: FALSE)
	 * @param mixed $filter_mentions (default: FALSE)
	 * @return void
	 */
	function analyze_text($text, $filter_common=FALSE, $filter_mentions=FALSE)
	{
		// Clean Text
		$words_split			= explode(' ', $text);
		$words 					= array_map('strtolower', $words_split);

		// Filter Common
		if ($filter_common):
      print_r($words);
      $this->ci->lang->line('common');
      die();
//			$words = array_diff($words, $this->ci->lang->line('common'));
		endif;

		// Filter Mentions
		if ($filter_mentions):
			$words = array_diff($words, $filter_mentions);
		endif;

		$words_trans	= implode(' ', $words);
		$words_clean 	= preg_replace('/[^A-Za-z0-9-\ ]/i', '', $words_trans);
		$words 			= explode(' ', $words_clean);

		// Get Words from DB
		$experience_words = $this->ci->words_model->get_words_words($words);


		// Set Vars
		$analysis				= array();
		$word_used				= config_item('emoome_word_used');
		$word_type				= config_item('emoome_word_types');
		$word_type_sub			= config_item('emoome_word_types_sub');
		$word_type_count		= make_counter_array(config_item('emoome_word_types'));
		$word_type_sub_count	= make_counter_array(config_item('emoome_word_types_sub'));
		$sentiment				= 0;


		// Analyze Experience
		foreach ($experience_words as $word):

			// Type
			$word_type_count[$word->type] = $word_type_count[$word->type] + 1;

			// Type Sub
			$word_type_sub_count[$word->type_sub] = $word_type_sub_count[$word->type_sub] + 1;
			
			// Sentiment
			$sentiment += $word->sentiment;
		endforeach;
		

		// Output Type
		foreach (array_filter($word_type_count) as $type => $count):
		    $type    = $word_type[$type];
		    $percent = $count; //percent($count, 4 + count($experience_words));
		    $analysis['language'][$type] = $percent;
		endforeach;

		
		// Output Type Sub
		foreach (array_filter($word_type_sub_count) as $type_sub => $count):
		    $type_sub_word = $word_type_sub[$type_sub];
		    $analysis['topics'][$type_sub_word] = $word_type_sub_count[$type_sub];
		endforeach;


		// Output Sentiment
		$analysis['sentiment']	= $sentiment;


		// Output Words
		$analysis['language_total'] = count($words);


		return $analysis;
	}
	
}