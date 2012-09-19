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
        $this->ci->load->model('experiences_model');
        $this->ci->load->model('emoome_model');
        $this->ci->load->model('logs_model');
        $this->ci->load->model('thoughts_model');
        $this->ci->load->model('words_model');
	}

	/* Users Meta Maps */
	function update_users_meta_map($user_id)
	{
		$users_meta	= $this->ci->emoome_model->get_users_meta_map($user_id);
		$word_count	= array();

		if ($users_meta)
		{
			// Loops Existing Word Types
			foreach (config_item('emoome_word_types') as $key => $type)
			{
	 			$word_count[$type] = $this->ci->words_model->count_user_word_type($user_id, $key);
			}			
			
			$update_data = array(
				'user_id'		=> $user_id,
				'site_id'		=> config_item('site_id'),
				'module'		=> 'emoome',
				'meta'			=> 'word_type_map',
				'value'			=> json_encode($word_count),
				'updated_at'	=> unix_to_mysql(now())			
			);

			return $this->ci->emoome_model->update_users_meta_map($users_meta->user_meta_id, $update_data);
		}
		else
		{
			return $this->ci->emoome_model->add_users_meta_map($user_id);
		}

		return FALSE;
	}


	/* Analyze Logs */
	function analyze_logs()
	{
		
		
	}
	
	
	function analyze_log($log, $details=FALSE)
	{
		$analysis				= array();
		$words					= array();
		$word_used				= config_item('emoome_word_used');
		$word_type				= config_item('emoome_word_types');
		$word_type_sub			= config_item('emoome_word_types_sub');
		$word_type_count		= config_item('emoome_word_types_count');
		$word_type_sub_count	= config_item('emoome_word_types_sub_count');
		$sentiment				= 0;
		$sentiment_normalize	= array('F' => 3, 'D' => 2, 'E' => 1); 			// Gives more priority to Feeling, Descriptor, Experience respectively 

		// Experience
		// To be factored out
		$experience_words = $this->ci->words_model->get_words_words(explode(' ', $log->experience));
		
		// Analyze Experience
		foreach ($experience_words as $word)
		{
			// Type
			$word_type_count[$word->type] = $word_type_count[$word->type] + 1;

			// Type Sub
			$word_type_sub_count[$word->type_sub] = $word_type_sub_count[$word->type_sub] + 1;
			
			// Sentiment
			$sentiment += $word->sentiment * $sentiment_normalize['E'];
		}
		
		// Analyze Words
		foreach ($log->words as $word)
		{
			// Type
			$word_type_count[$word->type] = $word_type_count[$word->type] + 2;

			// Type Sub
			$word_type_sub_count[$word->type_sub] = $word_type_sub_count[$word->type_sub] + 1;
			
			// Sentiment
			$sentiment += $word->sentiment * $sentiment_normalize[$word->used];
			
			// Words
			$words[$word->word] = $word_used[$word->used];
		}
		
		// Output Type		
		foreach (array_filter($word_type_count) as $type => $count)
		{
		    $type    = $word_type[$type];
		    $percent = percent($count, 4 + count($experience_words));
		    $analysis['language'][$type] = $percent;
		}
		
		// Output Type Sub
		foreach (array_filter($word_type_sub_count) as $type_sub => $count)
		{
		    $type_sub_word = $word_type_sub[$type_sub];
		    $analysis['topics'][$type_sub_word] = $word_type_sub_count[$type_sub];
		}		

		// Output Sentiment
		$analysis['sentiment']	= $sentiment;
		
		// Output Words
		$analysis['words'] = $words;
		

		// Details (full log result)
		if ($details)
		{
			$analysis['user_id']	= $log->user_id;
			$analysis['experience'] = $log->experience;
			$analysis['type']		= $log->type;
			$analysis['source']		= $log->source;
			$analysis['geo_lat']	= $log->geo_lat;
			$analysis['geo_lon']	= $log->geo_lon;
			$analysis['created_at'] = $log->created_date.' '.$log->created_time; 
		}
				
		return $analysis;
	}
	
	
}