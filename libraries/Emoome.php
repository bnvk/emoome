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
	function analyze_log($log)
	{
		// Returns at End
		$analysis		= array();
		$type_count		= config_item('emoome_word_types_count');
		$type_sub_count	= config_item('emoome_word_types_sub_count');

		$words_experience		= explode(' ', $log['experience']);
		$words_desribe			= array($log['describe_1'], $log['describe_2'], $log['describe_3']);
		$words_count_total		= 4 + $words_count_experience;
		$words_types			= config_item('emoome_word_types');


		// Analyze 'Type'
		$type_count[$feeling->type] = 1;



		// Analyze 'Type Sub'
		

		// Sentiment
		$sentiment_feeling 		= $feeling->sentiment;
		$sentiment_experience 	= 0;
		$sentiment_describe 	= 0;
	

		// Experience
		foreach ($words_experience as $word)
		{
			$check_word				= $this->words_model->check_word(strtolower($word));
			$sentiment_experience	= $check_word->sentiment + $sentiment_experience;

			// Increment Type
			$type_count[$check_word->type] = ($type_count[$check_word->type] + 1);
		}


		// Describe
		foreach ($words_desribe as $describe)
		{
			$sentiment_describe 			= $describe->sentiment + $sentiment_describe;
			$type_count[$describe->type] 	= ($type_count[$describe->type] + 1);
		}

		// Totals
		$sentiment_total = $sentiment_feeling + $sentiment_experience + $sentiment_describe;



		foreach ($type_count as $type => $count)
		{
			if ($count > 0 AND $type != 'U')
			{
				$percent = percent($count, $words_count_total);

				$analysis['language'][] = array($words_types[$type] => $percent);
			}
		}
		
				
		return $analysis;
	}
	
	
}