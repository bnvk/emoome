<?php
class Visualize extends Site_Controller
{
    function __construct()
    {
        parent::__construct();
        
	    if (!$this->social_auth->logged_in()) redirect('login');        

		$this->load->config('emoome');
		$this->load->model('emoome_model');		
	}

	function index()
	{
		$this->data['page_title']	= 'Visualize';

		$person			= $this->social_auth->get_user('user_id', $this->session->userdata('user_id'));
		$person_meta	= $this->social_auth->get_user_meta($this->session->userdata('user_id'));
		$log_count		= $this->emoome_model->count_logs_user($this->session->userdata('user_id'));
		$devices		= array();
		$word_map		= '';
		
		// Get Meta Values
		foreach ($person_meta as $meta)
		{
			// Word Map
			if ($meta->meta == 'word_type_map')
			{
				$word_map = $meta->value;
			}
		}		
		
		$this->data['word_map']		= $word_map;

		$this->render();
	}

	function experiences()
	{
		$this->data['page_title']	= 'Experiences';

		$this->render();
	}

	function map()
	{
		$this->data['page_title']	= 'Map';
	
		$this->render();
	}


}