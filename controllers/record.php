<?php
class Record extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

	    if (!$this->social_auth->logged_in()) redirect('login');

		$this->load->config('emoome');

        $this->layout = 'normal';
	}
	
	function index()
	{
		redirect('record/feeling');
	
		$this->data['page_title'] 	= 'Record';
		
		$this->render();
	}

	function feeling()
	{
		$this->data['page_title'] 	= 'Record A Feeling';
		
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

	
}