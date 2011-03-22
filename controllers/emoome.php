<?php
class Module_template extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

		$this->load->config('emoome');
	}
	
	function index()
	{
		$this->data['page_title'] = 'Emmome';
		$this->render();	
	}

	function view() 
	{		
		// Basic Content Redirect	
		$this->render();
	}
	
}
