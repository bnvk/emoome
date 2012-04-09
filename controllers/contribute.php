<?php
class Contribute extends Site_Controller
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
		$this->data['page_title'] 	= 'Contribute';
		
		$this->render();
	}

	function feeling()
	{
		$this->data['page_title'] 	= 'Feeling';
		
		$this->render();
	}

	function memory()
	{
		$this->data['page_title']	= 'Memory Mapper ';
		
		$this->render();
	}

	
}