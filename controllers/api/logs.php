<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Logs 
 *
 */
class Logs extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('natural_language');       
        $this->load->library('emoome');

    	$this->form_validation->set_error_delimiters('', '');        
	}
	
	// Log
	function view_get()
	{		
		if ($log = $this->logs_model->get_log($this->get('id')))
		{

            $message = array('status' => 'success', 'message' => 'Success logged feeling', 'log' => $log);
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'You have not recorded any logs');
		}

        $this->response($message, 200);
	}

	
	// Logs User
	function user_authd_get()
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
	
	// Logs Nearby
	function near_authd_get()
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
	

	// Feeling
	function create_feeling_authd_post()
	{
		// Validation Rules
	   	$this->form_validation->set_rules('feeling', 'Feeling', 'alpha_dash');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {	
			$log_data = array(
				'user_id'	=> $this->oauth_user_id,
				'type'		=> 'feeling',
				'geo_lat'	=> $this->input->post('geo_lat'),
				'geo_lon'	=> $this->input->post('geo_lon'),
				'time_1'	=> $this->input->post('time_feeling'),
				'time_2'	=> 0,
				'time_3'	=> 0,
				'time_total'=> $this->input->post('time_feeling'),
				'source'	=> $this->input->post('source')
			);
		
			// Add Log
			if ($log_id = $this->logs_model->add_log($log_data))
			{
				// Add Word
				$feeling = $this->words_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('feeling'), 'F');		
	
				// Update Word Map
				$word_map = $this->emoome->update_users_meta_map($this->oauth_user_id);
	
				// Analyze Log
				// $this->emoome->analyze_log();
	
				// Log Count
				$log_count = $this->logs_model->count_logs_user($this->uri->segment(4));
				
				// Message
	            $message = array('status' => 'success', 'message' => 'Success logged a feeling', 'word_map' => $word_map, 'log_count' => $log_count);
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


	// Feeling
	function create_experience_authd_post()
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
				'type'		=> 'experience',
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
	            $message = array('status' => 'success', 'message' => 'Success logged an experience', 'word_map' => $word_map, 'log_count' => $log_count);
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
	
}