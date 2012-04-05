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
		//$this->data['content']		= $this->load->view('../modules/emoome/views/emoome/index', $this->data, true);

		$this->render();
	}

	function start()
	{
		$this->data['page_title']	= 'Welcome to ';
		$this->data['content']		= $this->load->view('../modules/emoome/views/emoome/start', $this->data, true);
		
		$this->render();
	}

	function about()
	{
		$this->data['page_title']	= 'Welcome to ';
		$this->data['content']		= $this->load->view('../modules/emoome/views/emoome/about', $this->data, true);
		
		$this->render();		
	}	

	// little helper function to print the results
	function tag_test()
	{
		$this->load->library('post_tagger');
	
		$generate_tags	= $this->post_tagger->tag('The quick brown fox jumped over the lazy dog');
		$part_of_speech = config_item('emoome_brown_corpus_speech');

        foreach($generate_tags as $t)
        {
        	$pos = $t['tag'];
        	echo '<B>'.$t['token'] . "</B> - " . $part_of_speech[$pos].  "<br>";
        }
	}
	
}
