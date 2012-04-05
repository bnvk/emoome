<?php
class Contribute extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

		$this->load->config('emoome');

        $this->layout = 'normal';		
	}
	
	function index()
	{
		$this->data['page_title'] 	= 'Contribute';
		$this->data['content']		= $this->load->view('contribute/index', $this->data, true);
		
		$this->render();
	}

	function feeling()
	{
		$this->data['page_title'] 	= 'Feeling';
		$this->data['content']		= $this->load->view('contribute/feeling', $this->data, true);
		
		$this->render();
	}

	function memory()
	{
		$this->data['page_title']	= 'Memory Mapper ';
		$this->data['content']		= $this->load->view('contribute/memory', $this->data, true);
		
		$this->render();
	}

	function memory_tag()
	{
		$this->data['page_title']	= 'Memory Tagger';
		$this->data['content']		= $this->load->view('contribute/memory_tag', $this->data, true);
		
		$this->render();
	}
	
}