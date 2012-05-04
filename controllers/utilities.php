<?php
class Utilities extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

		// Load Things
		$this->load->config('emoome');
		$this->load->model('emoome_model');

		if ($this->session->userdata('user_level_id') != 1) redirect();
	}
	
	function stem()
	{
		$this->load->library('natural_language');
		echo $this->natural_language->stem($this->uri->segment(3));
	}

	function add_sentiment()
	{
		// Load Sentiment TXT file
		$the_file		= "";
		$output			= "No file loaded";
		
		if ($the_file)
		{
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
				$check_word = $this->emoome_model->check_word($word);
	
				if ($check_word)
				{
					$this->emoome_model->update_word($check_word->word_id, array('sentiment' => $sentiment));
					$output .= 'updated: '.$word.'<br>';
				}
				else
				{
					$this->emoome_model->add_word($word, $sentiment);
					$output .= 'added: '.$word.'<br>';
				}
			}
		}
	
		echo $output;
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
	
}