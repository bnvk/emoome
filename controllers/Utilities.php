<?php
class Utilities extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

		// Load Things
        $this->load->library('emoome');
        $this->load->library('natural_language');

		if ($this->session->userdata('user_level_id') != 1) redirect();
	}

	/**
	 * stem function.
	 * 
	 * @access public
	 * @return void
	 */
	function stem()
	{
		echo $this->natural_language->stem($this->uri->segment(4));
	}

	/**
	 * add_sentiment function.
	 * 
	 * @access public
	 * @return void
	 */
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

	/**
	 * update_stems function.
	 * 
	 * @access public
	 * @return void
	 */
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

	/**
	 * pos_tagger function.
	 * 
	 * @access public
	 * @return void
	 */
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

	/**
	 * add_words function.
	 * 
	 * @access public
	 * @return void
	 */
	function add_words()
	{
		$this->lang->load('firstnames');
		$words_array = $this->lang->line('firstnames');
		$output = '';

		if ($words_array)
		{
			foreach ($words_array as $word)
			{
				$word = preg_replace('/[^A-Za-z0-9-\ ]/i', '', $word);
				$add_word = $this->words_model->add_word($word, TRUE, 'D', 'NA', 'NP', 0);
				$output .= $add_word.' '.$word.'<br>';
			}
		}

		echo $output;
	}

	/**
	 * clean_text_to_array function.
	 * 
	 * @access public
	 * @return void
	 */
	function clean_text_to_array()
	{

		$text = '';

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
	
	/**
	 * find_duplicates function.
	 * 
	 * @access public
	 * @return void
	 */
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

	/**
	 * split_date_time function.
	 * 
	 * @access public
	 * @return void
	 */
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

	/**
	 * update_null_attributes function.
	 * 
	 * @access public
	 * @return void
	 */
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
	
	
	
	/**
	 * update_word_link_experiences function.
	 * 
	 * @access public
	 * @return void
	 */
	function update_word_link_experiences($user_id)
	{
  	$logs = $this->logs_model->get_logs_user($user_id);

  	foreach ($logs as $log):
  	
  	  $experience_words = explode(' ', $log->experience);

  	  echo '<h4>'.$log->experience.'</h4>';

      foreach ($experience_words as $word):

        $word     = preg_replace('/[^a-zA-Z0-9]/', '', $word);
        $add_link = $this->words_model->add_word_link($log->log_id, $user_id, $word, 'E');

        echo $add_link.' - '.$word.'<br>';

      endforeach;

      echo '<hr>';

  	endforeach;
	}
	

	/**
	 * update_word_taxonomy function.
	 * 
	 * @access public
	 * @return void
	 */
	function update_word_taxonomy()
	{
		
		
		
	}

	/**
	 * import_mech_turk function.
	 * 
	 * @access public
	 * @return void
	 */
	function import_mech_turk()
	{
		$this->load->model('words_model');

		$this->db->select('*');
 		$this->db->from('import1');
 		$this->db->where('Updated', 'N');
 		$result = $this->db->get();
 		$this->data['report1'] = $result->result();

		$this->db->select('*');
 		$this->db->from('import2');
 		$result = $this->db->get();
 		$report2 = $result->result();


 		// Handle One Worker Difference
 		$report2_array = array();
 		foreach ($report2 as $item2):
 			$report2_array[$item2->word] = $item2->Answer;
 		endforeach;
 		
 		$this->data['report2'] = $report2_array;

		$this->load->view('../modules/emoome/views/utilities/import_mech_turk', $this->data);
	}
	
	/**
	 * import_json_words function.
	 * 
	 * @access public
	 * @return void
	 */
	function import_json_words() {
	
		// Load Sentiment TXT file
		$the_file		= "/home/emoome/emoome-tools/scraped/english/".$this->uri->segment(4).".json";
		$output			= "No JSON file loaded";
		
		// Opens TXT File of Words
		$file_handle	= fopen($the_file, 'r');
		$dictionary		= json_decode(fread($file_handle, 5000000));
		$words_array 	= $dictionary->words;
		$output 		= '';
/*	
		echo '<pre>';
		print_r($dictionary->topic);
		die();
*/
		if ($words_array):

			// Loop Types
			foreach ($words_array as $key => $words):

				$output_new = '';
				$output_update = '';

				// Loop Words
				foreach ($words as $word):

					$word = preg_replace('/[^A-Za-z0-9-\ ]/i', '', $word);

					// Check if added to database (add IF NOT or update)
					$check = $this->words_model->check_word($word);

					// Word Exists
					if ($check):

						// Classify if "U"
						if ($check->type_sub == 'U'):

							// Does Existing Word have Type specified
							if ($check->type == 'U'):
								$word_update = array('type' => $key, 'type_sub' => $dictionary->topic);
								
								if ($key != 'U'):
									$type_update = $check->type.' ---> '.$key;
								else: 
									$type_update = $check->type;
								endif;
							else:
								$word_update = array('type_sub' => $dictionary->topic);
								$type_update = $check->type;
							endif;

							$this->words_model->update_word($check->word_id, $word_update);

							$output_update .= 
							'<li><b>'.$word.'</b><ul>'.
								'<li> type: '.$type_update.'</li>
								<li> type_sub: '.$check->type_sub.' ---> '.$dictionary->topic.'</li>'.
							'</ul></li>';

						else:
							$output_update .= '<li><b>'.$word.'</b> not changed type: <b>'.$check->type.'</b> / type_sub: <b>'.$check->type_sub.'</b></li>'; 
						endif;
					else:
						$add_word = $this->words_model->add_word($word, FALSE, $key, $dictionary->topic, 'U', 0);
						$output_new .= '<li><b>'.$word.'</b> with: type: <b>'.$key.'</b> / type_sub: <b>'.$dictionary->topic.'</b></li>';
					endif;
				endforeach;

				// Show This Type
				echo '<h1>' . $key . ' type</h1>';
				if ($output_new):
					echo '<h3>New</h3>';
					echo '<ul>'.$output_new.'</ul>';
				endif;
				if ($output_update):
					echo '<h3>Update</h3>';
					echo '<ul>'.$output_update.'</ul>';
				endif;
			endforeach;
		endif;
	}

}