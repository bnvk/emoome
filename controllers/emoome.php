<?php
class Emoome extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

		$this->load->config('emoome');

        $this->layout = 'normal';		
	}

	function index()
	{	
		$this->data['page_title']	= 'Welcome to ';

		$this->render();
	}

}
