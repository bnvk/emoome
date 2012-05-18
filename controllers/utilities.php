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
				$check_word = $this->emoome_model->check_word($word);
	
				if ($check_word)
				{
					$this->emoome_model->update_word($check_word->word_id, array('sentiment' => $sentiment));
					$output .= 'updated: '.$word.'<br>';
				}
				else
				{
					$this->emoome_model->add_word($word, TRUE);
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
			$word	= $this->emoome_model->check_word($this->uri->segment(5));
		
			if ($word->$field != 'U')
			{
				$words_stem = $this->emoome_model->get_words_stem($word->stem);
				
				foreach ($words_stem as $stem)
				{
					$this->emoome_model->update_word($stem->word_id, array($field => $word->$field));

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
		$words_array = config_item('emoome_common_words');

		$add_word = $this->emoome_model->add_word($this->uri->segment(4), TRUE);

		echo '<pre>';
		print_r($add_word);
	}

	function analyze_text()
	{
		$text_raw	= "I would love to go sky diving over the weekend, if you want to. Aren't you ready to do such things with me? I am getting a little bit frustrated that stuff is not going to work out between you and me. If I'm off base let me know we can chat.";
		$text_clean = preg_replace('/[^a-z0-9 ]/i', '', $text_raw);
		$words_raw	= explode(' ', $text_clean);
		
		echo '<h1>Words</h1>';

		foreach ($words_raw as $word)
		{
			echo $word.'<br>';
		}
			
		
		// Output
		$word_count = count($words_raw);

				
		echo '<h1>Stats</h1>';
		echo 'Word Count Total: '.$word_count;
		
	}

}