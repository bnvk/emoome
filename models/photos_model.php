<?php
class Photos_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }


	// Photos
	function get_photos_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('emoome_photos');
		$this->db->where('user_id', $user_id);
 		$result = $this->db->get();
 		return $result->result();	
	}

	function get_photos_analysis_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('emoome_photos_analysis');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('hue', 'desc');
		$this->db->order_by('saturation', 'desc');
		$this->db->order_by('value', 'desc');
 		$result = $this->db->get();
 		return $result->result();	
	}

	
	function check_photo_exists($original)
	{
		$this->db->select('*');
		$this->db->from('emoome_photos');
		$this->db->where('original', $original);
		$this->db->limit(1);
 		
 		if ($result = $this->db->get()->row())	
 		{
 			return $result;
 		}	
	
		return FALSE;
	}
	
	function add_photo($photo_data)
	{
		$photo_data['added_at'] = unix_to_mysql(now());

		$this->db->insert('emoome_photos', $photo_data);

		if ($photo_id = $this->db->insert_id())
		{
			return $photo_id;
    	}

	    return FALSE;
	}
	
	function update_photo($photo_id, $photo_data)
	{
		$this->db->where('photo_id', $photo_id);
		$this->db->update('emoome_photos', $photo_data);
		
		return TRUE;
	}

	function add_photo_analysis($photo_analysis)
	{
		$this->db->insert('emoome_photos_analysis', $photo_analysis);

		if ($analysis_id = $this->db->insert_id())
		{
			return $analysis_id;
    	}

	    return FALSE;
	}
	
}