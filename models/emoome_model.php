<?php
/**
 * Emoome Model
 * 
 * A model for Emoome miscellaneous tables and joins
 * 
 * @author Brennan Novak @brennannovak
 * @package Emoome\Models
 */
class Emoome_model extends CI_Model 
{
	protected $ci;

    function __construct()
    {
        parent::__construct();
        
		$this->ci =& get_instance();
    }

	/**
	 * get_users_meta_map function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return void
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

	/**
	 * add_users_meta_map function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return void
	 */
	function add_users_meta_map($user_id)
	{
		$users_meta	= $this->get_users_meta_map($user_id);
		$word_count = array();

		if (!$users_meta)
		{
			foreach (config_item('emoome_word_types') as $type)
			{
	 			$word_count[$type] = $this->ci->words_model->count_user_word_type($user_id, $type);
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

	/**
	 * update_users_meta_map function.
	 * 
	 * @access public
	 * @param mixed $user_meta_id
	 * @param mixed $update_data
	 * @return void
	 */
	function update_users_meta_map($user_meta_id, $update_data)
	{
		$this->db->where('user_meta_id', $user_meta_id);
		$this->db->update('users_meta', $update_data);
		return TRUE;
	}

	/**
	 * get_user_most_recent function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @param mixed $limit
	 * @return void
	 */
	function get_user_most_recent($user_id, $limit)
	{
		// Get Log & Experience
		$this->db->select('logs.log_id, logs.user_id, logs.geo_lat, logs.geo_lon, logs.source, logs.created_date, logs.created_time, experiences.experience');
		$this->db->from('logs');
		$this->db->join('experiences', 'experiences.log_id = logs.log_id');
		$this->db->order_by('logs.created_date', 'desc');
		$this->db->where('logs.user_id', $user_id);
		$this->db->limit($limit);
 		$result 		= $this->db->get();
 		$logs			= $result->result();
 		$log_ids 		= array();
	 	$types			= config_item('emoome_word_types');
	 	$types_count	= config_item('emoome_word_types_count');
 	 	$sentiment		= 0;

 		if ($logs)
 		{
 			// Build log_id
	 		foreach ($logs as $log)
	 		{
		 		$log_ids[] = $log->log_id; 	
	 		}
	 		
	 		// Get Words
	 		$this->db->select('words_link.*, words.word, words.type, words.sentiment');
	 		$this->db->from('words_link');
	 		$this->db->join('words', 'words.word_id = words_link.word_id');	
	 		$this->db->or_where_in('words_link.log_id', $log_ids);
	 		$result 	= $this->db->get();
	 		$words 		= $result->result();

	 		// Add Words To Logs
	 		foreach ($logs as $log)
	 		{
	 			$this_words = array();
	 			$this_feeling	= '';

	 			// Loop Words
	 			foreach ($words as $word)
	 			{
		 			if ($log->log_id == $word->log_id)
		 			{		
			 			// Type
			 			$this_type = $types[$word->type];
			 			
			 			$types[$word->type] = $types_count[$word->type] + 1;
			 			
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