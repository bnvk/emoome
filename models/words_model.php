<?php
class Words_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
    
 	// Words
 	// Interacts with "words"
	function get_word($word_id)
	{
		$this->db->select('*');
		$this->db->from('words');
		$this->db->where('word_id', $word_id);
		$this->db->limit(1);
 		
 		if ($result = $this->db->get()->row())	
 		{
 			return $result;
 		}

		return FALSE;
	}

	function check_word($word)
	{
		$this->db->select('*');
		$this->db->from('words');
		$this->db->where('word', $word);
		$this->db->limit(1);
 		
 		if ($result = $this->db->get()->row())	
 		{
 			return $result;
 		}

		return FALSE;
	}
	
	function get_words_words($words_array)
	{
		$this->db->select('*');
 		$this->db->from('words');
 		$this->db->or_where_in('word', $words_array);	 	
 		$result = $this->db->get();	
 		return $result->result();		
	}

	function get_words_stem($stem)
	{
		$this->db->select('*');
		$this->db->from('words');
		$this->db->where('stem', $stem);
 		$result = $this->db->get();
 		return $result->result();	      
	}

    function add_word($word, $check_stem=FALSE, $type='U', $type_sub='U', $speech='U', $sentiment=0)
    {
    	$word		= strtolower($word);
		$check_word = $this->check_word($word);
    
    	// Word Does Not Exist
    	if ($check_word)
    	{
    		return $check_word->word_id;
		}
		else
		{
	    	$stem = $this->natural_language->stem($word);

	    	// Lookup Similar Word
	    	if ($check_stem)
	    	{
	    		$stem_words = $this->get_words_stem($stem);
	
	    		if ($stem_words)
	    		{
		    		$type		= $stem_words[0]->type;
		    		$type_sub	= $stem_words[0]->type_sub;
		    		$speech		= $stem_words[0]->speech;
		    		$sentiment	= $stem_words[0]->sentiment;
	    		}
	    	}
			
			// Add Word To Dictionary
	 		$word_data = array(
	 			'word'		=> $word,
	 			'stem'		=> $stem,
				'type'		=> $type,
				'type_sub'	=> $type_sub,
				'speech'	=> $speech,
				'sentiment'	=> $sentiment
			);			

			$this->db->insert('words', $word_data);

			if ($word_id = $this->db->insert_id())
			{
				return $word_id;
	    	}
	    	else
	    	{
	    		return FALSE;
	    	}
	    }

	    return FALSE;    
    }

	function update_word($word_id, $word_data)
	{
		$this->db->where('word_id', $word_id);
		$this->db->update('words', $word_data);

		return TRUE;
	}



	// Words Link
 	// Interacts with "words_link"
	function count_user_word_type($user_id, $type)
	{		
 		$this->db->select('*');
 		$this->db->from('words_link');  
		$this->db->join('words', 'words.word_id = words_link.word_id');		
	 	$this->db->where('words_link.user_id', $user_id);
		$this->db->where('words.type', $type);
 		return $this->db->count_all_results();
	} 	
	
	function get_words_links_log($log_id)
	{
		$this->db->select('*');
		$this->db->from('words_link');
		$this->db->join('words', 'words.word_id = words_link.word_id');
 		$this->db->where('words_link.log_id', $log_id);
 		$result = $this->db->get();
 		return $result->result();
	}

	function get_words_links($log_array)
	{
		$this->db->select('*');
		$this->db->from('words_link');
		$this->db->join('words', 'words.word_id = words_link.word_id');
 		$this->db->or_where_in('words_link.log_id', $log_array);
 		$result = $this->db->get();
 		return $result->result();
	}

	function get_words_links_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('words_link');
		$this->db->join('words', 'words.word_id = words_link.word_id');
 		$this->db->where('words_link.user_id', $user_id);
 		$result = $this->db->get();
 		return $result->result();
	}
	
	function get_word_user_count($user_id, $word_id, $used)
	{
		$this->db->select('*');
		$this->db->from('words_link');
 		$this->db->where(array('user_id' => $user_id, 'word_id' => $word_id, 'used' => $used));
 		return $this->db->count_all_results();
	}

	function add_word_link($log_id, $user_id, $word, $used)
	{
		// Check / Add Word
		$word_id = $this->add_word($word, TRUE);

		if ($word_id)
		{
			$link_data = array(
				'log_id'	=> $log_id,
				'user_id'	=> $user_id,
				'word_id'	=> $word_id,
				'used'		=> $used
			);
	
			$this->db->insert('words_link', $link_data);

			if ($word_link_id = $this->db->insert_id())
			{
				$this->increment_word_taxonomy($user_id, $word_id, $used);

				return $word_link_id;
			}
		}

		return FALSE;
	}

	function update_word_link($link_id, $link_data)
	{
		$this->db->where('link_id', $link_id);
		$this->db->update('words_link', $link_data);
		
		return TRUE;
	}



    // Words Taxonomy
 	// Interacts with "words_taxonomy"    
    function increment_word_taxonomy($user_id, $word_id, $use)
    {
		$word_total		= $this->get_word_user_count($user_id, $word_id, $use);			
		$word_taxonomy	= $this->get_word_taxonomy($user_id, $word_id, $use);
			
		if ($word_taxonomy)
		{
			$this->update_word_taxonomy($word_taxonomy->word_taxonomy_id, $word_total);
		}				
		else
		{
			$this->add_word_taxonomy($user_id, $word_id, $word_total, $use);
		}    
    }
    
    function get_word_taxonomy($user_id, $word_id, $used)
    {
 		$this->db->select('*');
 		$this->db->from('words_taxonomy');    
 		$this->db->where(array('user_id' => $user_id, 'word_id' => $word_id, 'used' => $used)); 				
 		$result = $this->db->get()->row();	
 		return $result;    	
    }

    function add_word_taxonomy($user_id, $word_id, $count, $used)
    {
 		$data = array(
 			'user_id'	=> $user_id,
			'word_id'	=> $word_id,
			'count' 	=> $count,
			'used'		=> $used
		);

		return $this->db->insert('words_taxonomy', $data);
    }
    
    function update_word_taxonomy($word_taxonomy_id, $count)
    {
		$this->db->where('word_taxonomy_id', $word_taxonomy_id);
		$this->db->update('words_taxonomy', array('count' => $count));        
    }


}