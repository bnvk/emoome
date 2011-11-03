<?php
//Contribute deals with making data contributions
class Emoome_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('natural_language');        
    }

	// Logs	
	function get_logs_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('emoome_log');
		$this->db->join('emoome_actions', 'emoome_actions.log_id = emoome_log.log_id');
		$this->db->where('user_id', $user_id);
 		$result = $this->db->get();
 		return $result->result();	
	}
	
	function add_log($user_id, $type)
	{
		$log_data = array(
			'user_id'		=> $user_id,
			'type'			=> $type,
			'created_at'	=> unix_to_mysql(now())
		);

		$this->db->insert('emoome_log', $log_data);

		if ($log_id = $this->db->insert_id())
		{
			return $log_id;
    	}

	    return FALSE;
	}


	// Actions
	function get_action($action_id)
	{
		$this->db->select('*');
		$this->db->from('emoome_actions');
		$this->db->where('action_id', $action_id);
		$this->db->limit(1);
 		$result = $this->db->get();
 		return $result->result();	      
	}

	function add_action($log_id, $action) 
	{	
		$action_data = array(
			'log_id' 		 => $log_id,
			'action' 	 	 => $action
		);
		
		$this->db->insert('emoome_actions', $action_data);

		if ($action_id = $this->db->insert_id())
		{	
			return $action_id;
    	}
	
		return FALSE;
	}


	// Words & Word Link
	function check_word($word)
	{
		$this->db->select('*');
		$this->db->from('emoome_words');
		$this->db->where('word', $word);
		$this->db->limit(1);
 		
 		if ($result = $this->db->get()->row())	
 		{
 			return $result;
 		}

		return FALSE;
	}


    function add_word($word)
    {
    	$stem = $this->natural_language->stem($word);
    
 		$word_data = array(
			'word' 	 	=> $word,
			'stem'		=> $stem,
			'type'		=> ''
		);	

		$this->db->insert('emoome_words', $word_data);

		if ($word_id = $this->db->insert_id())
		{	
			return $word_id;
    	}
    
	    return FALSE;
    }	
	
	// Log Link
	function get_words_links($log_array)
	{	
		$this->db->select('*');
		$this->db->from('emoome_words_link');
		$this->db->join('emoome_words', 'emoome_words.word_id = emoome_words_link.word_id');
 		$this->db->or_where_in('log_id', $log_array);
 		$result = $this->db->get();
 		return $result->result();	
	}
	
	function add_word_link($log_id, $user_id, $word)
	{	
		$check_word = $this->check_word(strtolower($word));
	
		if ($check_word)
		{
			$word_id = $check_word->word_id;		
		}
		else
		{
			$word_id = $this->add_word(strtolower($word));
		}
		
		$link_data = array(
			'log_id'	=> $log_id,
			'user_id'	=> $user_id,
			'word_id'	=> $word_id
		);			

		$this->db->insert('emoome_words_link', $link_data);	
		
		$word_link_id = $this->db->insert_id();
	
		return $word.' '.$word_id.' '.$word_link_id;
		
	}
	
	
	/* Utilities */
	function add_user_id_to_word_link($user_id, $link_id)
	{
		$update['user_id'] = $user_id;
		$this->db->where('link_id', $link_id);
		$this->db->update('emoome_words_link', $update);
		return true;
	}
	
	
	function update_word_type_count()
	{
		
	}
	

}