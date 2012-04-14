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

		$this->load->config('emoome');
        $this->load->model('emoome_model');
	}
	
	function get_logs_user_authd_get()
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
		if ($log_id = $this->emoome_model->add_log($this->oauth_user_id, 'feeling', $this->input->post('geo_lat'), $this->input->post('geo_lon')))
		{
			// Add Word / Action / Descriptors
			$feeling	= $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('feeling'), 'F');		
			$action_id	= $this->emoome_model->add_action($log_id, $this->input->post('action'));
			$describe_1 = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_1'), 'D');
			$describe_2 = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_2'), 'D');
			$describe_3 = $this->emoome_model->add_word_link($log_id, $this->oauth_user_id, $this->input->post('describe_3'), 'D');

			// Update Word Map
			$word_map = $this->emoome_model->update_users_meta_map($this->oauth_user_id);

			// Message
            $message = array('status' => 'success', 'message' => 'Success logged feeling', 'word_map' => $word_map);
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