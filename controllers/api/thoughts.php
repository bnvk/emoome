<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Thoughts 
 *
 */
class Thoughts extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('natural_language');       
        $this->load->library('emoome');

    	$this->form_validation->set_error_delimiters('', '');        
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
	
}
