<?php
class Visualize extends Site_Controller
{
    function __construct()
    {
        parent::__construct();
        
	    if (!$this->social_auth->logged_in()) redirect('login');        

		$this->load->config('emoome');
	}

	function index()
	{
		$this->data['page_title']	= 'Visualize';

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