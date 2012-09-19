<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Emoome API : Analyze
 *
 */
class Analyze extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('natural_language');       
        $this->load->library('emoome');

    	$this->form_validation->set_error_delimiters('', '');        
	}

	function me_get()
	{
		$person				= $this->social_auth->get_user('user_id', 1);
		$person_meta		= $this->social_auth->get_user_meta(1);
		$log_count			= $this->logs_model->count_logs_user(1);
		$user_logs			= $this->logs_model->get_logs_user(1);
		$words_link			= $this->words_model->get_words_links_user(1);
		$last_five			= $this->emoome_model->get_user_most_recent(1, 5);

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




		// Common Words
		$common_count=0;
		
		foreach ($common_words as $count => $words)
		{
			if ($common_count <= 7)
			{
				$common_count++; 
			
				// Was in DIV
				$count;
	
				$word_count = count($words); $i = 1; $comma = ', ';
				
				foreach ($words as $word)
				{
					$i++; if ($i > $word_count) $comma = ' '; 
					echo $word.$comma;
				}
			}
		}

		

		// Strong Experiences
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

		// Output Data
		$message = array(
			'status' 		=> 'success', 
			'message' 		=> 'Yay found your logs', 
			'word_map' 		=> $word_map,
			'last_five'		=> $last_five,
			'common_words'	=> $common_words,
		);

		echo '<pre>';
		print_r($message);

        //$this->response($message, 200);
	}
	

	function log_get()
	{
		
		if ($log = $this->logs_model->get_log($this->get('id')))
		{
			$analysis = $this->emoome->analyze_log($log, TRUE);

			echo '<pre>';
			print_r($analysis);
		}
		else
		{
			echo 'Soz, no dice soldier!';
		}		
	}


	function time_authd_get()
	{
		if (($this->get('start') != '') AND ($this->get('end') != ''))
		{
			// Set Range
			$emotions = $this->logs_model->get_emotions_range_time($this->oauth_user_id, $this->get('start'), $this->get('end'));

			if ($emotions)
			{				
	            $message = array('status' => 'success', 'message' => 'Yay we found some feelings', 'emotions' => $emotions);
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'You have not recorded any feelings during that time period');
			}
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'One or more search parameters are missing');
		}

        $this->response($message, 200);
	}


	function date_authd_get()
	{
		if (($this->get('start') != '') AND ($this->get('end') != ''))
		{
			// Set Range
			$emotions = $this->logs_model->get_emotions_range_date($this->oauth_user_id, $this->get('start'), $this->get('end'));
	
			if ($emotions)
			{				
	            $message = array('status' => 'success', 'message' => 'Yay we found some feelings', 'emotions' => $emotions);
			}
			else
			{
	            $message = array('status' => 'error', 'message' => 'You have not recorded any feelings during that time period');
			}
		}
		else
		{
            $message = array('status' => 'error', 'message' => 'One or more search parameters are missing');
		}

        $this->response($message, 200);
	}


	function text_post()
	{
	   	$this->form_validation->set_rules('analyze_text', 'Text', 'required');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {		
			$words_array 	= $this->lang->line('common');	
			$text_raw		= $this->input->post('analyze_text');
			$text_clean 	= preg_replace('/[^a-z0-9 ]/i', '', $text_raw);
			$words_raw		= explode(' ', $text_clean);
			$words_types	= array();
			$words_common	= array();
			$words_type		= array();
			$words_type_count= array('E' => 0, 'I' => 0, 'D' => 0, 'S' => 0, 'A' => 0, 'P' => 0, 'U' => 0);
			$words_type_total= 0;
			$sentiment		= 0;
	
			foreach ($words_raw as $word)
			{
				$word = strtolower($word);
			
				// Is Not Common
				if (!in_array($word, $words_array))
				{
					$get_word = $this->words_model->check_word($word);
				
					// Word Exists
					if ($get_word)
					{
						// Output
						$sentiment 							= $sentiment + $get_word->sentiment;	
						$words_type[$get_word->word]		= $get_word->type;
						$words_type_count[$get_word->type]	= 1 + $words_type_count[$get_word->type];				
					}
					// Add Word
					else
					{
						$word_id	= $this->words_model->add_word($word, TRUE, 'U', 'U', 'U', 0);						
						$get_word	= $this->words_model->get_word($word_id);
	
						// Output
						$sentiment 							= $sentiment + $get_word->sentiment;						
						$words_type[$get_word->word] 		= $get_word->type;				
						$words_type_count[$get_word->type]	= 1 + $words_type_count[$get_word->type];
					}
					
					$words_type_total++;
				}
				else
				{
					if (array_key_exists($word, $words_common))
					{
						$words_common[$word] = 1 + $words_common[$word];
					}
					else
					{
						$words_common[$word] = 1;
					}					
				}
			}

			// Prep Output
			arsort($words_common);

			// Output Data
			$analysis = array(
				'words'						=> $words_type,
				'words_count'				=> count($words_raw),
				'words_type_count'			=> $words_type_count,
				'words_type_total_count' 	=> $words_type_total,
				'sentiment'					=> $sentiment,
				'common_count'				=> count($words_common),
				'common_words'				=> $words_common
			);

            $message = array('status' => 'success', 'message' => 'Success word analysis performed', 'analysis' => $analysis);		
		}
		else
		{
	    	$message = array('status' => 'error', 'message' => validation_errors());		
		}

        $this->response($message, 200);
	}

	
}