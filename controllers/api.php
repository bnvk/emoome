<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Social-Igniter
 *
 */
class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('natural_language');       
        $this->load->library('emoome');

    	$this->form_validation->set_error_delimiters('', '');        
	}
	
	function get_logs_user_authd_get()
	{
		if ($logs = $this->logs_model->get_logs_user($this->oauth_user_id))
		{
			$log_array	= array();
			$output		= array();

			foreach ($logs as $log)
			{
				$log_array[] = $log->log_id;
			}

			$words = $this->words_model->get_words_links($log_array);

            $message = array('status' => 'success', 'message' => 'Success logged feeling', 'logs' => $logs, 'words' => $words);
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'You have not recorded any logs');
		}

        $this->response($message, 200);	
	}
	
	function get_nearby_feelings_authd_get()
	{
		// Distance
		if ($this->get('distance')) $distance = $this->get('distance');
		else $distance = 10;

		// Get Feelings
		$nearby_feelings = $this->logs_model->get_nearby_feelings($this->get('geo_lat'), $this->get('geo_lon'), $distance, $this->oauth_user_id);		
		
		if ($nearby_feelings)
		{				
            $message = array('status' => 'success', 'message' => 'Success found some feelings', 'feelings' => $nearby_feelings);
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'You have not recorded any logs');
		}

        $this->response($message, 200);	
	}

	function get_emotions_range_get()
	{
		if (($this->get('range') != '') AND ($this->get('start') != '') AND ($this->get('end') != ''))
		{
			// Set Range
			if ($this->get('range') == 'time')
			{
				$emotions = $this->logs_model->get_emotions_range_time($this->oauth_user_id, $this->get('start'), $this->get('end'));
			}
			elseif ($this->get('range') == 'date')
			{
				$emotions = $this->logs_model->get_emotions_range_date($this->oauth_user_id, $this->get('start'), $this->get('end'));
			}
	
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
	

	// Log Feeling
	function log_feeling_authd_post()
	{
		// Validation Rules
	   	$this->form_validation->set_rules('feeling', 'Feeling', 'alpha_dash');
	   	$this->form_validation->set_rules('experience', 'Something you did today', 'required');
	   	$this->form_validation->set_rules('describe_1', '1st Describe', 'alpha_dash');
	   	$this->form_validation->set_rules('describe_2', '2nd Describe', 'alpha_dash');
	   	$this->form_validation->set_rules('describe_3', '3rd Describe', 'alpha_dash');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {	
			$log_data = array(
				'user_id'	=> $this->oauth_user_id,
				'type'		=> 'feeling',
				'geo_lat'	=> $this->input->post('geo_lat'),
				'geo_lon'	=> $this->input->post('geo_lon'),
				'time_1'	=> $this->input->post('time_feeling'),
				'time_2'	=> $this->input->post('time_experience'),
				'time_3'	=> $this->input->post('time_describe'),
				'time_total'=> $this->input->post('time_total'),
				'source'	=> $this->input->post('source')
			);
		
			// Add Log
			if ($log_id = $this->logs_model->add_log($log_data))
			{
				// Add Word / Experience / Descriptors
				$feeling		= $this->words_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('feeling'), 'F');		
				$experience_id	= $this->experiences_model->add_experience($log_id, $this->input->post('experience'));
				$describe_1 	= $this->words_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_1'), 'D');
				$describe_2 	= $this->words_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_2'), 'D');
				$describe_3 	= $this->words_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_3'), 'D');
	
				// Update Word Map
				$word_map = $this->emoome->update_users_meta_map($this->oauth_user_id);
	
				// Analyze Log
				// $this->emoome->analyze_log();
	
				// Log Count
				$log_count = $this->logs_model->count_logs_user($this->uri->segment(4));
				
				// Message
	            $message = array('status' => 'success', 'message' => 'Success logged feeling', 'word_map' => $word_map, 'log_count' => $log_count);
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'Could not save log');
			}
		}
		else
		{
	    	$message = array('status' => 'error', 'message' => validation_errors());		
		}

        $this->response($message, 200);
	}

	
	function log_feedback_get()
	{		
		// TEST DATA
		$chooser = array(
			'one'	=> 'I had fun classy sexy depressing time',
			'two'	=> 'hurt worrying frightening glad', 
			'three' => 'crying happy sad glad fucking water'
		);
	
		$log_data = array(
			'feeling'		=> 'confusing',
			'experience'	=> $chooser[$this->get('msg')],
			'word_count'	=> count(explode(' ', $log['experience'])),
			'describe_1'	=> 'glad',
			'describe_2'	=> 'uneasy',
			'describe_3'	=> 'lonely'		
		);

		
		$analysis = $this->emoome->analyze_log($log_data);

		print_r($analysis);
/*		
		echo '<h1>Source</h1>';
		echo $msg_show.' ('.$words_count_experience.' words)';
		echo '<h1>Type</h1>';
		echo '<h1>Sentiment</h1>';
		echo 'Feeling: '.$sentiment_feeling.'<br>';	
		echo 'Experience: '.$sentiment_experience.'<br>';
		echo 'Describe: '.$sentiment_describe.'<br>';
		echo 'Total: '.$sentiment_total;
*/
	}





	// Tools
	function analyze_text_post()
	{
	   	$this->form_validation->set_rules('analyze_text', 'Text', 'required');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {		
			$words_array 	= $this->lang->line('common');	
			$text_raw		= $this->input->post('analyze_text');
			$text_clean 	= preg_replace('/[^a-z0-9 ]/i', '', $text_raw);
			$words_raw		= explode(' ', $text_clean);
			$words_types	= array();
			$words_common	= array();
			$words_type		= array();
			$words_type_count= array('E' => 0, 'I' => 0, 'D' => 0, 'S' => 0, 'A' => 0, 'P' => 0, 'U' => 0);
			$words_type_total= 0;
			$sentiment		= 0;
	
			foreach ($words_raw as $word)
			{
				$word = strtolower($word);
			
				// Is Not Common
				if (!in_array($word, $words_array))
				{
					$get_word = $this->words_model->check_word($word);
				
					// Word Exists
					if ($get_word)
					{
						// Output
						$sentiment 							= $sentiment + $get_word->sentiment;	
						$words_type[$get_word->word]		= $get_word->type;
						$words_type_count[$get_word->type]	= 1 + $words_type_count[$get_word->type];				
					}
					// Add Word
					else
					{
						$word_id	= $this->words_model->add_word($word, TRUE, 'U', 'U', 'U', 0);						
						$get_word	= $this->words_model->get_word($word_id);
	
						// Output
						$sentiment 							= $sentiment + $get_word->sentiment;						
						$words_type[$get_word->word] 		= $get_word->type;				
						$words_type_count[$get_word->type]	= 1 + $words_type_count[$get_word->type];
					}
					
					$words_type_total++;
				}
				else
				{
					if (array_key_exists($word, $words_common))
					{
						$words_common[$word] = 1 + $words_common[$word];
					}
					else
					{
						$words_common[$word] = 1;
					}					
				}
			}

			// Prep Output
			arsort($words_common);

			// Output Data
			$analysis = array(
				'words'						=> $words_type,
				'words_count'				=> count($words_raw),
				'words_type_count'			=> $words_type_count,
				'words_type_total_count' 	=> $words_type_total,
				'sentiment'					=> $sentiment,
				'common_count'				=> count($words_common),
				'common_words'				=> $words_common
			);

            $message = array('status' => 'success', 'message' => 'Success word analysis performed', 'analysis' => $analysis);		
		}
		else
		{
	    	$message = array('status' => 'error', 'message' => validation_errors());		
		}

        $this->response($message, 200);
	}
	
	
	
		
	/* Thoughts Stuff */
	function get_thoughts_words_get()
	{
		if ($this->get('id'))
		{
			if ($words = $this->thoughts_model->get_thoughts_category($this->get('id')))
			{			
	            $message = array('status' => 'success', 'message' => 'Success some thoughts found', 'words' => $words);
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'There are no thoughts for this', 'words' => 0);
			}
		}
		else
		{
	    	$message = array('status' => 'error', 'message' => 'Specify a category of thoughts', 'words' => 0);			
		}

        $this->response($message, 200);			
	}

	function log_thought_authd_post()
	{
	   	$this->form_validation->set_rules('log_thought', 'Thought', 'required');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {	
	    	$log_thought = $this->thoughts_model->add_thought($this->oauth_user_id, $this->input->post('category_id'), $this->input->post('source'), $this->input->post('log_thought'));

			if ($log_thought)
			{
	            $message = array('status' => 'success', 'message' => 'Success we logged your thought', 'data' => $log_thought);		
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'Oops could not log your thought');
			}			
		}
		else
		{
	    	$message = array('status' => 'error', 'message' => validation_errors());		
		}			

        $this->response($message, 200);	
	}
	


	// Utilities & Stats
	function get_user_word_maps_get()
	{
		if ($word_map = $this->emoome_model->get_users_meta_map($this->get('id')))
		{
            $message = array('status' => 'success', 'message' => 'Success word types found', 'word_map' => $word_map);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any word types');
		}

        $this->response($message, 200);
	}

	function add_user_word_maps_get()
	{
		if ($word_map = $this->emoome_model->add_users_meta_map($this->get('id')))
		{
            $message = array('status' => 'success', 'message' => 'Success word types were added', 'word_map' => $word_map);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any word types');
		}

        $this->response($message, 200);
	}	
	
	function update_user_word_maps_get()
	{
		$word_map = $this->emoome_model->update_users_meta_map($this->get('id'));

		if ($word_map)
		{
            $message = array('status' => 'success', 'message' => 'Success word types were found and updated', 'word_map' => $word_map);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any word types');
		}

        $this->response($message, 200);
	}	
	
	
}