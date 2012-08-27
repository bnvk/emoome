<?php
class Logs_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('natural_language');        
    }
 
 	// Logs
 	// Interacts with "emoome_logs"
	function count_logs_user($user_id)
	{		
 		$this->db->select('*');
 		$this->db->from('emoome_logs');  
	 	$this->db->where('user_id', $user_id);
 		return $this->db->count_all_results();
	}	
	
	function get_logs_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('emoome_logs');
		$this->db->join('emoome_actions', 'emoome_actions.log_id = emoome_logs.log_id');
		$this->db->order_by('emoome_logs.created_date', 'desc');
		$this->db->where('user_id', $user_id);
 		$result = $this->db->get();
 		return $result->result();	
	}

    function get_nearby_feelings($geo_lat, $geo_lon, $distance, $user_id=FALSE)
    {
    	if ($user_id)
    	{
    		$actions	= 'JOIN';
    		$user_where = 'AND emoome_logs.user_id = '.$user_id;
    	}
    	else
    	{
    		$user_where = '';
    	}
    
		$sql = "SELECT emoome_logs.log_id, emoome_logs.geo_lat, emoome_logs.geo_lon, emoome_logs.created_at, emoome_words.word,  emoome_words.type, emoome_actions.action,     
				((geo_lat - '.$geo_lat.') * (geo_lat - '.$geo_lat.') + (geo_lon - '.$geo_lon.')*(geo_lon - '.$geo_lon.')) distance
				FROM emoome_log
				JOIN emoome_actions ON emoome_actions.log_id = emoome_logs.log_id
				JOIN emoome_words_link ON emoome_words_link.log_id = emoome_logs.log_id
				JOIN emoome_words ON emoome_words.word_id = emoome_words_link.word_id
				WHERE emoome_logs.geo_lat IS NOT NULL AND emoome_logs.geo_lon IS NOT NULL ".$user_where." AND emoome_words_link.used = 'F' 
				ORDER BY distance ASC
				LIMIT 0,".$distance;

		$query = $this->db->query($sql);	
				
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{				
				$result[] = $row;
			}

			return $result;
		}
    }


	function get_emotions_range_time($user_id, $start_hour, $end_hour, $order='type')
	{
		$start_time	= $start_hour.':00:00';
		$end_hour	= $end_hour + 1;
		$end_time	= $end_hour.':00:00';
		$hours		= $end_hour - $start_hour;

		$this->db->select('*');
		$this->db->from('emoome_logs');
		$this->db->join('emoome_words_link', 'emoome_words_link.log_id = emoome_logs.log_id');
		$this->db->join('emoome_words', 'emoome_words.word_id = emoome_words_link.word_id');
		$this->db->where('emoome_logs.user_id', $user_id);
		$this->db->where('emoome_logs.created_time >=', $start_time);
		$this->db->where('emoome_logs.created_time <=', $end_time);
		$this->db->where('emoome_words_link.used', 'F');
		$this->db->order_by('emoome_logs.created_time', 'asc');
 		$result = $this->db->get();
 		$results = $result->result();

 		return $results;
	}
        

	function add_log($log_data)
	{
		$date_time = explode(' ', unix_to_mysql(now()));

		$log_data['created_date'] = $date_time[0];
		$log_data['created_time'] = $date_time[1];

		$this->db->insert('emoome_logs', $log_data);

		if ($log_id = $this->db->insert_id())
		{
			return $log_id;
    	}

	    return FALSE;
	}

	function update_log($log_id, $log_data)
	{
		$this->db->where('log_id', $log_id);
		$this->db->update('emoome_logs', $log_data);
		return TRUE;
	}

    
}