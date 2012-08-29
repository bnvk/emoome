<?php
class Record extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

	    if (!$this->social_auth->logged_in()) redirect('login');

        $this->load->library('emoome');

        $this->layout = 'normal';
	}
	
	function index()
	{
		//if ($this->session->userdata('user_level_id') == 4) redirect('record/feeling');
		//redirect('record/feeling');
		$this->data['page_title'] 	= 'Record';
		
		$this->render();
	}

	function feeling()
	{
		$this->data['page_title'] 	= 'Record A Feeling';
		
		$this->render();
	}
	
	function emoticons()
	{
		$this->data['page_title']	= 'Record A Feeling';
	
		$this->render();
	}

	function memory()
	{
		$this->data['page_title']	= 'Memory Builder';
		
		$this->render();
	}
	
	function goal()
	{
		$this->data['page_title']	= 'Goal Mapper';
		
		$this->render();
	}

	function thought()
	{
		$this->data['page_title']	= 'Group Thought';
		
		$this->render();
	}

	
}