<?php
class Thoughts_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }

	/* Thoughts */
	function add_thought($user_id, $category_id, $source, $thought)
	{
		$thought_data = array(
			'user_id'		=> $user_id,
			'category_id'	=> $category_id,
			'source'		=> $source,
			'thought'		=> $thought,
			'created_at'	=>  unix_to_mysql(now())
		);

		$this->db->insert('thoughts', $thought_data);

		if ($thought_id = $this->db->insert_id())
		{
			$text_raw		= $thought;
			$text_clean 	= preg_replace('/[^a-z0-9 ]/i', '', $text_raw);
			$words_raw		= explode(' ', $text_clean);			
	
			foreach ($words_raw as $word)
			{			
				$word_id = $this->words_model->add_word($word, TRUE, 'U', 'U', 'U', 0);
	
				$word_data = array(
					'category_id'	=> $category_id,
					'thought_id'	=> $thought_id,
					'user_id'		=> $user_id,
					'word_id'		=> $word_id,
					'used'			=> 'B'
				);

				$this->db->insert('words_link_thoughts', $word_data);				
			}
			
			return TRUE;
		}

		return FALSE;		
	}
	
	
	function get_thoughts_category($category_id)
	{
		$this->db->select('words_link_thoughts.*, words.word, words.type');
		$this->db->from('words_link_thoughts');
		$this->db->join('words', 'words.word_id = words_link_thoughts.word_id');
 		$this->db->or_where_in('words_link_thoughts.category_id', $category_id);
 		$result = $this->db->get();
 		return $result->result();	
	}


}