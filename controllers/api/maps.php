<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Maps
 *
 */
class Maps extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('natural_language');       
        $this->load->library('emoome');

    	$this->form_validation->set_error_delimiters('', '');        
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