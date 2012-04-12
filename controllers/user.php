<?php
class User extends Site_Controller
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
	
		$this->render();
	}


}