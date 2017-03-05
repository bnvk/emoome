<?php
class Audio extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

	    if (!$this->social_auth->logged_in()) redirect('login');

        $this->load->library('emoome');

        $this->layout = 'normal';
	}
	
	function index()
	{
		$this->db->select('message_text');
 		$this->db->from('voicemails');
 		$this->db->where('transcription_status', 'completed');
 		$this->db->order_by('id', 'desc');	 	
 		$result = $this->db->get()->result();

 		$this->data['transcriptions'] = $result;
		
		$this->render();
	}

}