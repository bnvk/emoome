<?php
class Site extends Site_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->library('emoome');	
	}

	function index()
	{		
		$this->load->view('../modules/emoome/views/site/index', $this->data);
	}

}