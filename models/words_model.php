<?php
/**
 * Words Model
 * 
 * A model for Emoome Words table
 * 
 * @author Brennan Novak @brennannovak
 * @package Emoome\Models
 */
class Words_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }

	/**
	 * get_word function.
	 * 
	 * @access public
	 * @param mixed $word_id
	 * @return void
	 */
	function get_word($word_id)
	{
		$this->db->select('*');
		$this->db->from('words');
		$this->db->where('word_id', $word_id);
		$this->db->limit(1);
 		
 		if ($result = $this->db->get()->row()):
 			return $result;
 		endif;

		return FALSE;
	}

	/**
	 * check_word function.
	 * 
	 * @access public
	 * @param mixed $word
	 * @return void
	 */
	function check_word($word)
	{
		$this->db->select('*');
		$this->db->from('words');
		$this->db->where('word', $word);
		$this->db->limit(1);

 		if ($result = $this->db->get()->row()):	
 			return $result;
 		endif;

		return FALSE;
	}

	/**
	 * get_words_words function.
	 * 
	 * @access public
	 * @param mixed $words_array
	 * @return object The result of the query
	 */
	function get_words_words($words_array)
	{
		$this->db->select('*');
 		$this->db->from('words');
 		$this->db->or_where_in('word', $words_array);	 	
 		$result = $this->db->get();	
 		return $result->result();		
	}

	/**
	 * get_words_stem function.
	 * 
	 * @access public
	 * @param mixed $stem A word stripped of any gerunds (running -> run)
	 * @return void
	 */
	function get_words_stem($stem)
	{
		$this->db->select('*');
		$this->db->from('words');
		$this->db->where('stem', $stem);
 		$result = $this->db->get();
 		return $result->result();	      
	}

	/**
     * add_word function.
     * 
     * @access public
     * @param string $word The word that is being added
     * @param bool $check_stem Checks if a word with similar stem exists (to copy other properties)
     * @param string $type The Emoome language type classification
     * @param string $type_sub The Emoome language topic
     * @param string $speech Part of speech
     * @param int $sentiment The sentiment of the word -5 to 5
     * @return int|false Either word_id of newly inserted word for FALSE
     */
    function add_word($word, $check_stem=FALSE, $type='U', $type_sub='U', $speech='U', $sentiment=0)
    {
    	$word		= strtolower($word);
		$check_word = $this->check_word($word);
    
    	// Word Does Not Exist
    	if ($check_word):
    		return $check_word->word_id;
		else:
		
	    	$stem = $this->natural_language->stem($word);

	    	// Lookup Word Stem
	    	if ($check_stem):
	    		if ($stem_words = $this->get_words_stem($stem)):
		    		$type		= $stem_words[0]->type;
		    		$type_sub	= $stem_words[0]->type_sub;
		    		$speech		= $stem_words[0]->speech;
		    		$sentiment	= $stem_words[0]->sentiment;
	    		endif;
	    	endif;
			
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

			if ($word_id = $this->db->insert_id()):
				return $word_id;
	    	else:
	    		return FALSE;
	    	endif;
	    endif;

	    return FALSE;    
    }

	/**
	 * update_word function.
	 * 
	 * @access public
	 * @param int $word_id The word_id of a word
	 * @param array $word_data An array of attributes of the word to update
	 * @return bool Always returns true
	 */
	function update_word($word_id, $word_data)
	{
		$this->db->where('word_id', $word_id);
		$this->db->update('words', $word_data);

		return TRUE;
	}

	/**
	 * count_user_word_type function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @param mixed $type
	 * @return void
	 */
	function count_user_word_type($user_id, $type)
	{		
 		$this->db->select('*');
 		$this->db->from('words_link');  
		$this->db->join('words', 'words.word_id = words_link.word_id');		
	 	$this->db->where('words_link.user_id', $user_id);
		$this->db->where('words.type', $type);
 		return $this->db->count_all_results();
	} 	

	/**
	 * get_words_links_log function.
	 * 
	 * @access public
	 * @param mixed $log_id
	 * @return void
	 */
	function get_words_links_log($log_id)
	{
		$this->db->select('*');
		$this->db->from('words_link');
		$this->db->join('words', 'words.word_id = words_link.word_id');
 		$this->db->where('words_link.log_id', $log_id);
 		$result = $this->db->get();
 		return $result->result();
	}

	/**
	 * get_words_links function.
	 * 
	 * @access public
	 * @param mixed $log_array
	 * @return void
	 */
	function get_words_links($log_array)
	{
		$this->db->select('*');
		$this->db->from('words_link');
		$this->db->join('words', 'words.word_id = words_link.word_id');
 		$this->db->or_where_in('words_link.log_id', $log_array);
 		$result = $this->db->get();
 		return $result->result();
	}

	/**
	 * get_words_links_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return void
	 */
	function get_words_links_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('words_link');
		$this->db->join('words', 'words.word_id = words_link.word_id');
 		$this->db->where('words_link.user_id', $user_id);
 		$result = $this->db->get();
 		return $result->result();
	}

	/**
	 * get_word_user_count function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @param mixed $word_id
	 * @param mixed $used
	 * @return void
	 */
	function get_word_user_count($user_id, $word_id, $used)
	{
		$this->db->select('*');
		$this->db->from('words_link');
 		$this->db->where(array('user_id' => $user_id, 'word_id' => $word_id, 'used' => $used));
 		return $this->db->count_all_results();
	}
	
	/**
	 * add_word_link function.
	 * 
	 * @access public
	 * @param mixed $log_id
	 * @param mixed $user_id
	 * @param mixed $word
	 * @param mixed $used
	 * @return void
	 */
	function add_word_link($log_id, $user_id, $word, $used)
	{
		// Check / Add Word
		$word_id = $this->add_word($word, TRUE);

		if ($word_id):
			$link_data = array(
				'log_id'	=> $log_id,
				'user_id'	=> $user_id,
				'word_id'	=> $word_id,
				'used'		=> $used
			);
	
			$this->db->insert('words_link', $link_data);

			if ($word_link_id = $this->db->insert_id()):
				$this->increment_word_taxonomy($user_id, $word_id, $used);
				return $word_link_id;
			endif;
		endif;

		return FALSE;
	}

	/**
	 * update_word_link function.
	 * 
	 * @access public
	 * @param mixed $link_id
	 * @param mixed $link_data
	 * @return void
	 */
	function update_word_link($link_id, $link_data)
	{
		$this->db->where('link_id', $link_id);
		$this->db->update('words_link', $link_data);
		
		return TRUE;
	}

    /**
     * increment_word_taxonomy function.
     * 
     * @access public
     * @param mixed $user_id
     * @param mixed $word_id
     * @param mixed $used
     * @return void
     */
    function increment_word_taxonomy($user_id, $word_id, $used)
    {
		$word_total		= $this->get_word_user_count($user_id, $word_id, $used);
		$word_taxonomy	= $this->get_word_taxonomy($user_id, $word_id, $used);

		if ($word_taxonomy):
			$this->update_word_taxonomy($word_taxonomy->word_taxonomy_id, $word_total);
		else:
			$this->add_word_taxonomy($user_id, $word_id, $word_total, $used);
		endif;
    }

    /**
     * get_word_taxonomy function.
     * 
     * @access public
     * @param mixed $user_id
     * @param mixed $word_id
     * @param mixed $used
     * @return void
     */
    function get_word_taxonomy($user_id, $word_id, $used)
    {
 		$this->db->select('*');
 		$this->db->from('words_taxonomy');    
 		$this->db->where(array('user_id' => $user_id, 'word_id' => $word_id, 'used' => $used)); 				
 		$result = $this->db->get()->row();	
 		return $result;    	
    }

    /**
     * add_word_taxonomy function.
     * 
     * @access public
     * @param mixed $user_id
     * @param mixed $word_id
     * @param mixed $count
     * @param mixed $used
     * @return void
     */
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

    /**
     * update_word_taxonomy function.
     * 
     * @access public
     * @param mixed $word_taxonomy_id
     * @param mixed $count
     * @return void
     */
    function update_word_taxonomy($word_taxonomy_id, $count)
    {
		$this->db->where('word_taxonomy_id', $word_taxonomy_id);
		$this->db->update('words_taxonomy', array('count' => $count));        
    }

}