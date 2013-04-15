<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Analyze
 *
 */
class Analyze extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('natural_language');       
        $this->load->library('emoome');

    	$this->form_validation->set_error_delimiters('', '');        
	}

	function me_authd_get()
	{
		$word_types = config_item('emoome_word_types');
	
		// QUERIES
		if ($user_logs = $this->logs_model->get_logs_user($this->oauth_user_id))
		{
			$words_link	= $this->words_model->get_words_links_user($this->oauth_user_id);
	
			// LAST FIVE
			$log_count		= 0;
			$last_five_logs	= array();
			$logs_ids 		= array();
			
			foreach ($user_logs as $log)
			{
				if ($log_count < 6)
				{
					$logs_ids[] = $log->log_id;
					$last_five_logs[] = $log;
					$log_count++;
				}
				else
				{
					break;
				}
			}
	
			// Analyze Five
			$last_five = $this->emoome->analyze_words_link($this->words_model->get_words_links($logs_ids));
	
	
			// ALL TIME
			$person_meta 	= $this->social_auth->get_user_meta($this->oauth_user_id);
			$word_map		= '';
	
			if ($person_meta)
			{
				foreach ($person_meta as $meta)
				{
					if ($meta->meta == 'word_type_map')
					{
						$word_map = $meta->value;
						break;
					}
				}
			}
			else
			{
				$word_map = json_encode(array());
			}
	
			$all_time_json 	= get_object_vars(json_decode($word_map));
	
	
	
			// COMMON WORDS
			$common_count		= 0;
			$common_words_count = array();
			$log_word_types		= array();
	
	
			// Words Link Sort
			foreach ($words_link as $link)
			{
				// For Strong Experiences
				if (array_key_exists($link->log_id, $log_word_types))
				{
					$log_word_types[$link->log_id][] = $link->type; 
				}
				else
				{
					$log_word_types[$link->log_id] = array($link->type);
				}
			
				// For Common Words
				if (array_key_exists($link->word, $common_words_count))
				{
					$common_words_count[$link->word] = $common_words_count[$link->word] + 1;
				}
				else
				{			
					$common_words_count[$link->word] =  1;
				}
			}

			arsort($common_words_count);
			
		
			// STRONG EXPERIENCES
			$experience_count	= 0;
			$strong_experiences	= array();
	
			// Loop through Logs
			foreach ($user_logs as $log)
			{
				// Limit # of Experiences to most recent
				if ($experience_count <= 10)
				{
					$log_types	= $log_word_types[$log->log_id];
					$type_count = array_count_values($log_types);
	
					// Check Type count of different Types
					foreach ($type_count as $count_key => $count_value)
					{
						if (($count_value > 2) AND ($count_key != 'U'))
						{
							$strong_experiences[] = array(
								'log_id'		=> $log->log_id,
								'experience'	=> $log->experience,
								'date'			=> $log->created_date,
								'time'			=> $log->created_time,
								'type'			=> $word_types[$count_key],
								'count'			=> $count_value
							);
	
							$experience_count++;
						}
					}	
				}
			}

			// OUTPUT DATA
			$message = array(
				'status' 				=> 'success', 
				'message' 				=> 'Yay found your logs',
				'logs_count'			=> count($user_logs),
				'last_five'				=> $last_five,
				'all_time'				=> array(
					'language' 			=> $all_time_json,
					'language_total'	=> array_sum($all_time_json),
					'words'				=> $common_words_count
				),
				'strong_experiences'	=> $strong_experiences
			);
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Could not find any logs');
		}

        $this->response($message, 200);
	}


	function log_authd_get()
	{
		if ($log = $this->logs_model->get_log($this->get('id')))
		{
			if ($log->user_id == $this->oauth_user_id)
			{
				$analysis = $this->emoome->analyze_log($log, TRUE);

				$message = array('status' => 'success', 'message' => 'Yay found your logs', 'analysis' => $analysis);
			}
			else
			{
				$message = array('status' => 'error', 'message' => 'Oops that is your not log, carry on now!');			
			}
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Could not find that log');	
		}

        $this->response($message, 200);
	}

	
	function last_five_get()
	{
		// Get Logs
		if ($logs = $this->logs_model->get_logs_user(1, 5))
		{
			// Log IDS for words
			$logs_ids = $this->emoome->generate_object_ids($logs, 'log_id');

			// Words
			$words = $this->words_model->get_words_links($logs_ids);

			// Analyze
			$analysis = $this->emoome->analyze_words_link($words);
	
			$message = array('status' => 'success', 'message' => 'Yay found your logs', 'analysis' => $analysis);
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Could not find that log');	
		}

        $this->response($message, 200);
	}


	function time_get()
	{
		if (($this->get('start')) AND ($this->get('end')))
		{
			if ($this->get('start') === 00) $start = '00';
			else $start = $this->get('start');

			if ($this->get('end') === 00) $end = '00';
			else $end = $this->get('end');

			// Set Range
			$logs = $this->logs_model->get_logs_range_time(1, $start, $end);

			// Log IDS for words
			$logs_ids = $this->emoome->generate_object_ids($logs, 'log_id');

			// Words
			$words = $this->words_model->get_words_links($logs_ids);

			// MOOD DATA
			$moods				= array();
			$sentiment_emotions	= config_item('emoome_sentiment_emotion');
			$sentiment_arrays	= config_item('emoome_sentiment_emotion_array');
			$moods_logs_ids		= $this->emoome->generate_moods_log_ids($words);			

			foreach ($moods_logs_ids as $sentiment => $mood_logs_ids)
			{
				$this_mood_words = array();
			
				// Words
				foreach ($words as $word)
				{
					if (in_array($word->log_id, $mood_logs_ids))
					{
						$this_mood_words[] = $word;
					}
				}

				// Analyze
				$analysis = $this->emoome->analyze_words_link($this_mood_words);
			
				$mood    	  = $sentiment_emotions[$sentiment];
				$moods[$mood] = $analysis;
			}

			if ($logs)
			{				
	            $message = array('status' => 'success', 'message' => 'Yay we found some feelings', 'moods' => $moods, 'logs' => $logs, 'log_count' => count($logs));
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'You have not recorded any feelings during that time period');
			}

		}
		else
		{
            $message = array('status' => 'error', 'message' => 'One or more search parameters are missing');
		}

		//echo '<pre>';
		//print_r($moods);
		//echo '</pre>';

		$this->response($message, 200);
	}


	function date_authd_get()
	{
		if (($this->get('start') != '') AND ($this->get('end') != ''))
		{
			// Set Range
			$emotions = $this->logs_model->get_emotions_range_date($this->oauth_user_id, $this->get('start'), $this->get('end'));
	
			if ($emotions)
			{				
	            $message = array('status' => 'success', 'message' => 'Yay we found some feelings', 'emotions' => $emotions);
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'You have not recorded any feelings during that time period');
			}
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'One or more search parameters are missing');
		}

        $this->response($message, 200);
	}


	function text_post()
	{
	   	$this->form_validation->set_rules('analyze_text', 'Text', 'required');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {		
			$analysis = $this->emoome->analyze_text($this->input->post('analyze_text'));

            $message = array('status' => 'success', 'message' => 'Success word analysis performed', 'analysis' => $analysis);		
		}
		else
		{
	    	$message = array('status' => 'error', 'message' => validation_errors());		
		}

        $this->response($message, 200);
	}

	
}