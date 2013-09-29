<?php
/**
 * Logs Model
 * 
 * A model for Emoome Logs table
 * 
 * @author Brennan Novak @brennannovak
 * @package Emoome\Models
 */
class Logs_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }

	/**
	 * count_logs_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return void
	 */
	function count_logs_user($user_id)
	{		
 		$this->db->select('*');
 		$this->db->from('logs');  
	 	$this->db->where('user_id', $user_id);
 		return $this->db->count_all_results();
	}
	
	/**
	 * get_log function.
	 * 
	 * @access public
	 * @param mixed $log_id
	 * @return void
	 */
	function get_log($log_id)
	{	
		$this->db->select('*');
		$this->db->from('logs');
		$this->db->join('experiences', 'experiences.log_id = logs.log_id');
		$this->db->where('logs.log_id', $log_id);
 		$log = $this->db->get()->row();
 		
 		if ($log)
 		{
	 		$this->db->select('*');
			$this->db->from('words_link');
			$this->db->join('words', 'words_link.word_id = words.word_id');
			$this->db->where('words_link.log_id', $log_id);
	 		$log->words = $this->db->get()->result();			
 		 		
	 		return $log;	 		
 		}
 		
 		return FALSE;
	}

	/**
	 * get_logs_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @param mixed $limit (default: FALSE)
	 * @return void
	 */
	function get_logs_user($user_id, $limit=FALSE)
	{
		$this->db->select('*');
		$this->db->from('logs');
		$this->db->join('experiences', 'experiences.log_id = logs.log_id');
		$this->db->order_by('logs.created_date', 'desc');
		$this->db->where('user_id', $user_id);
		
		if ($limit):
			$this->db->limit($limit);
		endif;

 		$logs = $this->db->get()->result();
 		return $logs;	
	}

    /**
     * get_nearby_feelings function.
     * 
     * @access public
     * @param mixed $geo_lat
     * @param mixed $geo_lon
     * @param mixed $distance
     * @param mixed $user_id (default: FALSE)
     * @return void
     */
    function get_nearby_feelings($geo_lat, $geo_lon, $distance, $user_id=FALSE)
    {
    	if ($user_id):
    		$actions	= 'JOIN';
    		$user_where = 'AND logs.user_id = '.$user_id;
    	else:
    		$user_where = '';
    	endif;
    
		  $sql = "SELECT logs.log_id, logs.geo_lat, logs.geo_lon, logs.created_at, words.word,  words.type, experiences.action,     
				((geo_lat - '.$geo_lat.') * (geo_lat - '.$geo_lat.') + (geo_lon - '.$geo_lon.')*(geo_lon - '.$geo_lon.')) distance
				FROM emoome_log
				JOIN experiences ON experiences.log_id = logs.log_id
				JOIN words_link ON words_link.log_id = logs.log_id
				JOIN words ON words.word_id = words_link.word_id
				WHERE logs.geo_lat IS NOT NULL AND logs.geo_lon IS NOT NULL ".$user_where." AND words_link.used = 'F' 
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

	/**
	 * get_logs_range_time function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @param mixed $start_hour
	 * @param mixed $end_hour
	 * @param string $order (default: 'type')
	 * @return void
	 */
	function get_logs_range_time($user_id, $start_hour, $end_hour, $order='type')
	{
		$start_time	= $start_hour.':00:00';
		$end_hour	= $end_hour + 1;
		$end_time	= $end_hour.':00:00';
		$hours		= $end_hour - $start_hour;

		$this->db->select('*');
		$this->db->from('logs');
		$this->db->join('experiences', 'experiences.log_id = logs.log_id');
		$this->db->where('logs.user_id', $user_id);
		
		if ($end_time < $start_time)
		{
			$this->db->where('logs.created_time >=', $start_time);
			$this->db->where('logs.created_time >=', $end_time);		
		}
		else
		{
			$this->db->where('logs.created_time >=', $start_time);
			$this->db->where('logs.created_time <=', $end_time);
		}
		
		$this->db->order_by('logs.created_time', 'asc');
 		$result = $this->db->get();
 		$results = $result->result();

 		return $results;
	}

	/**
	 * add_log function.
	 * 
	 * @access public
	 * @param mixed $log_data
	 * @return void
	 */
	function add_log($log_data)
	{
		$date_time = explode(' ', unix_to_mysql(now()));

		$log_data['created_date'] = $date_time[0];
		$log_data['created_time'] = $date_time[1];

		$this->db->insert('logs', $log_data);

		if ($log_id = $this->db->insert_id())
		{
			return $log_id;
    	}

	    return FALSE;
	}

	/**
	 * update_log function.
	 * 
	 * @access public
	 * @param mixed $log_id
	 * @param mixed $log_data
	 * @return void
	 */
	function update_log($log_id, $log_data)
	{
		$this->db->where('log_id', $log_id);
		$this->db->update('logs', $log_data);
		return TRUE;
	}

}