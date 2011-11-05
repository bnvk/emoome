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
	function count_logs_user($user_id)
	{		
 		$this->db->select('*');
 		$this->db->from('emoome_log');  
	 	$this->db->where('user_id', $user_id);
 		return $this->db->count_all_results();
	}	
	
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



	// Words
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



	// Words Link
	function get_words_links($log_array)
	{
		$this->db->select('*');
		$this->db->from('emoome_words_link');
		$this->db->join('emoome_words', 'emoome_words.word_id = emoome_words_link.word_id');
 		$this->db->or_where_in('emoome_words_link.log_id', $log_array);
 		$result = $this->db->get();
 		return $result->result();
	}

	function add_word_link($log_id, $user_id, $word)
	{
		$check_word = $this->check_word(strtolower($word));
		$word_type	= '';

		// Word Exists
		if ($check_word)
		{
			$word_id	= $check_word->word_id;
			$word_type	= $check_word->type;
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

		if ($word_link_id = $this->db->insert_id())
		{
			return array('word_link_id' => $word_link_id, 'type' => $word_type);
		}

		return FALSE;
	}
	
	
	/*	Utilities (counts various data / logs)
	 *
	 */
	function count_user_word_type($user_id, $type)
	{		
 		$this->db->select('*');
 		$this->db->from('emoome_words_link');  
		$this->db->join('emoome_words', 'emoome_words.word_id = emoome_words_link.word_id');		
	 	$this->db->where('emoome_words_link.user_id', $user_id);
		$this->db->where('emoome_words.type', $type);
 		return $this->db->count_all_results();
	}


	/* Users Meta Values (mostly map reduced user info) 
	 *
	 */
	function get_users_meta_map($user_id)
	{
		$this->db->select('*');
		$this->db->from('users_meta');
		$this->db->where('user_id', $user_id);
		$this->db->where('module', 'emoome');
		$this->db->where('meta', 'word_type_map');
		$this->db->limit(1);    
 		$result = $this->db->get()->row();
 		
 		if ($result)
 		{
 			return $result;	
 		}

 		return FALSE;
	}
	
	function add_users_meta_map($user_id)
	{
		$users_meta	= $this->get_users_meta_map($user_id);
		$word_count = array();

		if (!$users_meta)
		{
			foreach (config_item('emoome_word_types') as $type)
			{
	 			$word_count[$type] = $this->count_user_word_type($user_id, $type);
			}
	
			$add_data = array(
				'user_id'		=> $user_id,
				'site_id'		=> config_item('site_id'),
				'module'		=> 'emoome',
				'meta'			=> 'word_type_map',
				'value'			=> json_encode($word_count),
				'created_at'	=> unix_to_mysql(now()),
				'updated_at'	=> unix_to_mysql(now())
			);
	
			$this->db->insert('users_meta', $add_data);
			
			if ($user_meta_id = $this->db->insert_id())
			{
				$add_data['user_meta_id'] = $user_meta_id;
				return $add_data;
			}		
		}

		return FALSE;		
	}


	function update_users_meta_map($user_id)
	{
		$users_meta	= $this->get_users_meta_map($user_id);
		$word_count	= array();

		if ($users_meta)
		{
			// Loops Existing Word Types
			foreach (config_item('emoome_word_types') as $type)
			{
	 			$word_count[$type] = $this->count_user_word_type($user_id, $type);
			}			
			
			$update_data = array(
				'user_id'		=> $user_id,
				'site_id'		=> config_item('site_id'),
				'module'		=> 'emoome',
				'meta'			=> 'word_type_map',
				'value'			=> json_encode($word_count),
				'updated_at'	=> unix_to_mysql(now())			
			);

			$this->db->where('user_meta_id', $users_meta->user_meta_id);
			$this->db->update('users_meta', $update_data);
			return $update_data;
		}
		else
		{
			return $this->add_users_meta_map($user_id);
		}

		return FALSE;	
	}
	

}