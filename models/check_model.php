<?php
//Only gets data that has been contributed
class Check_model extends Model 
{

	function phase_1_check()
	{
		$sql = "SELECT * FROM words_link WHERE type = ? AND user_id = ?";
		$q = $this->db->query($sql, array('E', $this->session->userdata('user_id')));
		$query = $q->num_rows();
		return $query;
	}
	
	
}