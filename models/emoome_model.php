<?php
class Emoome_model extends CI_Model 
{
	protected $ci;

    function __construct()
    {
        parent::__construct();
        
		$this->ci =& get_instance();        

        $this->load->library('natural_language');        
    }


	// Users Meta Values (mostly map reduced user info) 
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


	function update_users_meta_map($user_meta_id, $update_data)
	{
		$this->db->where('user_meta_id', $user_meta_id);
		$this->db->update('users_meta', $update_data);
		return TRUE;
	}


	/* User Specific Calls */
	function get_user_most_recent($user_id, $limit)
	{
		// Get Log & Experience
		$this->db->select('emoome_logs.log_id, emoome_logs.user_id, emoome_logs.geo_lat, emoome_logs.geo_lon, emoome_logs.source, emoome_logs.created_date, emoome_logs.created_time, experiences.experience');
		$this->db->from('emoome_logs');
		$this->db->join('experiences', 'experiences.log_id = emoome_logs.log_id');
		$this->db->order_by('emoome_logs.created_date', 'desc');
		$this->db->where('emoome_logs.user_id', $user_id);
		$this->db->limit($limit);
 		$result 	= $this->db->get();
 		$logs		= $result->result();
 		$log_ids 	= array();
	 	$types		= config_item('emoome_word_types_count');
 	 	$sentiment	= 0;

 		if ($logs)
 		{
 			// Build log_id
	 		foreach ($logs as $log)
	 		{
		 		$log_ids[] = $log->log_id; 	
	 		}
	 		
	 		// Get Words
	 		$this->db->select('emoome_words_link.*, emoome_words.word, emoome_words.type, emoome_words.sentiment');
	 		$this->db->from('emoome_words_link');
	 		$this->db->join('emoome_words', 'emoome_words.word_id = emoome_words_link.word_id');	
	 		$this->db->or_where_in('emoome_words_link.log_id', $log_ids);
	 		$result 	= $this->db->get();
	 		$words 		= $result->result();

	 		// Add Words To Logs
	 		foreach ($logs as $log)
	 		{
	 			$this_words = array();
	 			$this_feeling	= '';
	 		
	 			foreach ($words as $word)
	 			{
		 			if ($log->log_id == $word->log_id)
		 			{			 			
			 			// Type
			 			$types[$word->type] = $types[$word->type] + 1;
			 			
			 			// Sentiment
			 			$sentiment = ($sentiment + $word->sentiment);

			 			// Feeling & Words
			 			if ($word->used == 'F') $this_feeling = $word->word;
			 			else $this_words[] = $word->word;
		 			}
	 			}

	 			$log->feeling	= $this_feeling;
		 		$log->words		= $this_words;
	 		}
 		}

 		arsort($types);

		$output = array(
			'types'			=> $types,
			'sentiment'		=> $sentiment,
			'experiences'	=> $logs
		);
		
		return $output;
	}

}