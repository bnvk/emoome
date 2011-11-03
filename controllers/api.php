<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Module : Social-Igniter
 *
 */
class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('emoome_model');
	}
	
	function get_logs_user_get()
	{
		if ($logs = $this->emoome_model->get_logs_user($this->get('id')))
		{
			$log_array	= array();
			$output		= array();

			foreach ($logs as $log)
			{
				$log_array[] = $log->log_id;
			}
			
			$words = $this->emoome_model->get_words_links($log_array);
			
            $message = array('status' => 'success', 'message' => 'Success logged feeling', 'logs' => $logs, 'words' => $words);
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'You have not recorded any logs');
		}

        $this->response($message, 200);	
	}	

	// Log Feeling
	function log_feeling_authd_post()
	{
		// Add Log	
		if ($log_id = $this->emoome_model->add_log($this->oauth_user_id, 'feeling'))
		{
			// Add Word
			$feeling = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('feeling'));
			
			// Add Action
			$action_id = $this->emoome_model->add_action($log_id, $this->input->post('action'));

			// Add Descriptors			
			$describe_1 = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_1'));
			$describe_2 = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_2'));
			$describe_3 = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_3'));
			
			// Increment User Maps
			
		
            $message = array('status' => 'success', 'message' => 'Success logged feeling', 'data' => $log_id.' '.$action_id.' '.$feeling);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not save log');
		}

        $this->response($message, 200);
	}

	// Log Music
	function log_music_authd_post()
	{

		if ($_POST)
		{
            $message = array('status' => 'success', 'message' => 'Success item added to cart', 'data' => $_POST);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any classes');
		}

        $this->response($message, 200);	
	}	

	// Log Photo
	function log_image_authd_post()
	{

		if ($_POST)
		{
            $message = array('status' => 'success', 'message' => 'Success item added to cart', 'data' => $_POST);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any classes');
		}

        $this->response($message, 200);	
	}		

	// Log Place
	function log_place_authd_post()
	{

		if ($_POST)
		{
            $message = array('status' => 'success', 'message' => 'Success item added to cart', 'data' => $_POST);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any classes');
		}

        $this->response($message, 200);	
	}

	// Stats
	function get_user_word_types_get()
	{
		$words = $this->emoome_model->get_user_word_type_count($this->get('id'));

		if ($_POST)
		{
            $message = array('status' => 'success', 'message' => 'Success item added to cart', 'data' => $_POST);		
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'Could not find any classes');
		}

        $this->response($message, 200);
	}
	
	
	// Utilities
	
	
	
}