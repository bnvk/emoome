<?php
class Actions_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('natural_language');        
    }
 
	// Actions
	// Interacts with "emoome_actions"
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
		$word_count = count(explode(' ', $action));
	
		$action_data = array(
			'log_id'		=> $log_id,
			'action'		=> $action,
			'word_count'	=> $word_count
		);
		
		$this->db->insert('emoome_actions', $action_data);

		if ($action_id = $this->db->insert_id())
		{	
			return $action_id;
    	}
	
		return FALSE;
	}


}