<?php
//Contribute deals with making data contributions
class Contribute_model extends Model 
{
	
	function word_check($word)
	{
		$sql = "SELECT * FROM words WHERE word = ?";
		$q = $this->db->query($sql, $word);
		if($q->num_rows() >= 1) {
			foreach ($q->result() as $row) {
				$query[] = $row;
			}
			$query = $row->word_id;
		}	
		else {
			$query = "empty";
		}	
		return $query;	
	}
	
	function word_add($word, $stem, $type=NULL)
	{
		$data = array(
			'word'	=> $word,
			'stem'	=> $stem,
			'type'	=> $type
		);	
		$insert = $this->db->insert('words', $data);
		return $insert;	
	}
	
	//EMOTION
	function emotion_add($word_id) 
	{
		//Data for Word
		$data = array(
			'word_id'		=> $word_id,
			'user_id' 		=> $this->session->userdata('user_id'),
			'type' 			=> "E",
			'weight' 	 	=> $this->input->post('percentage'),			
			'date_time' 	=> mdate("%Y-%m-%d %h:%i:00", time())
		);	
		$insert = $this->db->insert('words_link', $data);
		return $insert;	
	}	

	//BEHAVIOR
	function behavior_get($behavior_id)
	{

		$sql = "SELECT * FROM behaviors WHERE behavior_id = ?";
		$q = $this->db->query($sql, $behavior_id);

		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$query[] = $row;
			}
			return $query;
		}
	
	}

	function behaviors_add() 
	{	
		$data1 = array(
			'word_id'	 	 => $this->uri->segment(3),
			'user_id' 		 => $this->session->userdata('user_id'),
			'behavior' 	 	 => $this->input->post('behavior_1'),
			'type' 			 => "B",			
			'date_time' 	 => mdate("%Y-%m-%d %h:%i:00", time())
		);
		$this->db->insert('behaviors', $data1);
		
		$this->session->set_flashdata('behavior_1', $this->db->insert_id());
						
		$data2 = array(
			'word_id'	 	 => $this->uri->segment(3),
			'user_id' 		 => $this->session->userdata('user_id'),
			'behavior' 	 	 => $this->input->post('behavior_2'),
			'type' 			 => "B",			
			'date_time' 	 => mdate("%Y-%m-%d %h:%i:00", time())
		);
		$this->db->insert('behaviors', $data2);

		$this->session->set_flashdata('behavior_2', $this->db->insert_id());
	}

	//DESCRIPTORS
	function describe_add($word_id, $behavior_id)
	{	
	
		$data = array(
			'word_id'		=> $word_id,
			'behavior_id'	=> $behavior_id,
			'user_id' 		=> $this->session->userdata('user_id'),
			'type' 			=> "D",
			'weight' 	 	=> "",			
			'date_time' 	=> mdate("%Y-%m-%d %h:%i:00", time())
		);	

		$this->db->insert('words_link', $data);
			
	}

}