<?php
class Utilities extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

		// Load Things
        $this->load->library('emoome');

		if ($this->session->userdata('user_level_id') != 1) redirect();
	}

	function stem()
	{
		$this->load->library('natural_language');
		echo $this->natural_language->stem($this->uri->segment(4));
	}

	function add_sentiment()
	{
		// Load Sentiment TXT file
		$the_file		= "";
		$output			= "No file loaded";
		
		if ($the_file)
		{
			// Opens TXT File of Words
			$file_handle	= fopen($the_file, 'r');
			$dictionary		= fread($file_handle, 5000000);
			$output			= '';
	
			// Turn into array from new line breaks
			$words_sentiment= explode("\n", $dictionary);
	
			// Loop through words
			foreach ($words_sentiment as $word_sentiment)
			{
				// Separate 'word' from 'sentiment'
				$value	= preg_split('/[\s]+/', $word_sentiment);
				$word	= $value[0];
				$sentiment = $value[1];
	
				// Check if added to database (add IF NOT or update)
				$check_word = $this->words_model->check_word($word);
	
				if ($check_word)
				{
					$this->words_model->update_word($check_word->word_id, array('sentiment' => $sentiment));
					$output .= 'updated: '.$word.'<br>';
				}
				else
				{
					$this->words_model->add_word($word, TRUE);
					$output .= 'added: '.$word.'<br>';
				}
			}
		}
	
		echo $output;
	}
	
	function update_stems()
	{
		if (($this->uri->segment(4) != '') AND ($this->uri->segment(5) != ''))
		{
			$field	= $this->uri->segment(4);
			$word	= $this->words_model->check_word($this->uri->segment(5));
		
			if ($word->$field != 'U')
			{
				$words_stem = $this->words_model->get_words_stem($word->stem);
				
				foreach ($words_stem as $stem)
				{
					$this->words_model->update_word($stem->word_id, array($field => $word->$field));

					echo $stem->word.' ---> '.$stem->$field.' ---> '.$word->$field.'<br>';
				}
			}
			else
			{
				echo 'The <b>'.$this->uri->segment(4).'</b> of <b>'.$this->uri->segment(5).'</b> has not been classified yet!';
			}			
		}
		else
		{
			echo 'needed values are not set';
		}	
	}

	function pos_tagger()
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

	function add_words()
	{
		$this->lang->load('firstnames');
		$words_array = $this->lang->line('firstnames');
		$output = '';

		if ($words_array)
		{
			foreach ($words_array as $word)
			{
				$word = preg_replace('/[^a-z0-9 ]/i', '', $word);
				$add_word = $this->words_model->add_word($word, TRUE, 'D', 'NA', 'NP', 0);
				$output .= $add_word.' '.$word.'<br>';
			}
		}

		echo $output;
	}
	
	// Simple tool for cleaning text to copy into an array()
	function clean_text()
	{
		$text = "";

		// Prepare Text
		$text	= preg_replace('/[^a-zA-Z]/', ' ', $text);	// Strip Non Chars
		$text	= preg_replace('/\s+/', ' ', $text);		// Strip Whitespace & Breaks
		$text	= strtolower($text);						// Lowercase
		$words	= explode(" ", $text);						// Make into array
		$words	= array_unique($words);						// Remove Duplicates 	
		$output = '';

		sort($words);

		// Loop through words
		foreach ($words as $word)
		{
			// Clean
			$output .= '"'.$word.'",';
		}

		echo $output;
	}
	
	function find_duplicates()
	{
		$words 		= array();
		$existing	= array();
		$duplicates = array();
		
		foreach ($words as $word)
		{
			if (in_array($word, $existing))
			{
				$duplicates[] = $word;
			}
			else
			{
				$existing[] = $word;
			}
		}
		
		echo '<h1>Duplicates</h1>';
		echo '<pre>';
		print_r($duplicates);
		echo '<hr>';
		print_r($existing);
	}

	function split_date_time()
	{
		$this->db->select('*');
		$this->db->from('emoome_log');
 		$result = $this->db->get();
 		$logs = $result->result();			
		
		foreach ($logs as $log)
		{
			$date_time = explode(' ', $log->created_at); 
			
			echo 'date: '.$date_time[0].' time: '.$date_time[1].'<br>';

			$this->logs_model->update_log($log->log_id, array('created_date' => $date_time[0], 'created_time' => $date_time[1]));
		}
	}

	function update_null_attributes()
	{
		$this->db->select('word_id, word, type_sub, speech');
		$this->db->from('words');
		$this->db->where($this->uri->segment(4), NULL);
 		$query = $this->db->get();
 		$result = $query->result();

		echo '<h1>'.count($result).'</h1>';
		echo '<pre>';
		
		foreach ($result as $word)
		{
			echo 'Updating: '.$word->word.'<br>';	
		
			$this->words_model->update_word($word->word_id, array($this->uri->segment(4) => 'U'));
		}
	}
	
	function update_word_taxonomy()
	{
		
		
		
	}

}