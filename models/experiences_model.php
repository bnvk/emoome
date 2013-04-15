<?php
class Experiences_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
 
	// Experiences
	// Interacts with "experiences"
	function get_experience($experience_id)
	{
		$this->db->select('*');
		$this->db->from('experiences');
		$this->db->where('experience_id', $experience_id);
		$this->db->limit(1);
 		$result = $this->db->get();
 		return $result->result();	      
	}

	function add_experience($log_id, $experience) 
	{	
		$word_count = count(explode(' ', $experience));
	
		$experience_data = array(
			'log_id'		=> $log_id,
			'experience'	=> $experience,
			'word_count'	=> $word_count
		);
		
		$this->db->insert('experiences', $experience_data);

		if ($experience_id = $this->db->insert_id())
		{	
			return $experience_id;
    	}
	
		return FALSE;
	}


}