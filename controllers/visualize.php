<?php
class Visualize extends Site_Controller
{
    function __construct()
    {
        parent::__construct();
        
	    if (!$this->social_auth->logged_in()) redirect('login');        

        $this->load->library('emoome');
	}

	function index()
	{
		$this->data['page_title']	= 'Visualize';

		$person				= $this->social_auth->get_user('user_id', $this->session->userdata('user_id'));
		$person_meta		= $this->social_auth->get_user_meta($this->session->userdata('user_id'));
		$log_count			= $this->logs_model->count_logs_user($this->session->userdata('user_id'));
		$user_logs			= $this->logs_model->get_logs_user($this->session->userdata('user_id'));
		$words_link			= $this->words_model->get_words_links_user($this->session->userdata('user_id'));
		$last_five			= $this->emoome_model->get_user_most_recent($this->session->userdata('user_id'), 5);

		$word_map			= '';
		$common_words		= array();
		$common_words_count = array();
		$log_word_types		= array();

		// Do Word Map
		if ($person_meta)
		{
			foreach ($person_meta as $meta)
			{
				if ($meta->meta == 'word_type_map')
				{
					$word_map = $meta->value;
					break;
				}
			}
		}
		else
		{
			$word_map = json_encode(array());
		}

		// Check Popular Words & Strong Logs
		foreach ($words_link as $link)
		{
			// Build Word Types
			if (array_key_exists($link->log_id, $log_word_types))
			{
				$log_word_types[$link->log_id][] = $link->type; 
			}
			else
			{
				$log_word_types[$link->log_id] = array($link->type);
			}
		
			// Do Common Words
			if (array_key_exists($link->word, $common_words_count))
			{
				$common_words_count[$link->word] = $common_words_count[$link->word] + 1;
			}
			else
			{			
				$common_words_count[$link->word] =  1;
			}
		}
		
		// Build Similar Word Count Array of Words
		foreach ($common_words_count as $word => $count)
		{
			if ($count > 1)
			{		
				if (array_key_exists($count, $common_words))
				{
					$common_words[$count][] = $word;
				}
				else
				{
					$common_words[$count] = array($word); 
				}
			}
		}

		// Sort Words
		krsort($common_words);

		$this->data['word_map']		= $word_map;
		$this->data['last_five']	= json_encode($last_five);
		$this->data['common_words']	= $common_words;
		$this->data['logs']			= json_encode($user_logs);
		$this->data['word_links']	= json_encode($log_word_types);

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

	function location()
	{
		$this->data['page_title'] 	= 'Location';
		
		$this->render();
	}

	function search()
	{
		$this->data['page_title'] 	= 'Search';
		
		// Hour Stuff
		$start_hour = date('H');
		$end_hour	= date('H') + 3;
	
		if ($start_hour > 12)
		{
			$start_hour		= $start_hour - 12;
			$start_meridian	= 'PM';
		}
		else
		{
			$start_meridian	= date('A');
			
		}
			
		if ($end_hour >= 12)
		{
			$end_hour = $end_hour - 12;
			$end_meridian = 'PM';
		}
		else
		{
			$end_meridian = 'AM';
		}

		$this->data['start_hour']		= 04;//$start_hour;
		$this->data['start_meridian']	= 'PM';//$start_meridian;
		$this->data['end_hour']			= 05;//$end_hour;
		$this->data['end_meridian']		= 'PM';//$end_meridian;

		$this->render();
	}


}