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
	
	function nearby()
	{
		$this->data['page_title']	= 'Nearby Feelings';
		
		$this->render();
	}
	
	function test()
	{
		$this->load->model('emoome_model');

		$start = $this->uri->segment(3);
		$end = $this->uri->segment(4);
		
		foreach (range($start, $end) as $log_id)
		{
			if ($word_links = $this->emoome_model->get_words_links_log($log_id))
			{
				$i=0;
		
				foreach ($word_links as $link)
				{
					$i++;
				
					if ($i == 1) $use = 'F';
					else $use = 'D';
					
					$this->emoome_model->update_word_link($link->link_id, array('use' => $use));
				}
			}
		}

		echo 'Done!';
	}
	
	
	/* Tools */
	function stem()
	{
		$this->load->library('natural_language');
		echo $this->natural_language->stem($this->uri->segment(3));
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
