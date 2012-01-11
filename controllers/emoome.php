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
		$this->data['content']		= $this->load->view('../modules/emoome/views/emoome/index', $this->data, true);
		
		$this->load->view('layouts/'.$this->layout, $this->data);	
	}

	
}
