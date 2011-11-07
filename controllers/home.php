<?php
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->data['page_title']		= 'Emoome';
		$this->data['emoome_assets']	= base_url().'application/modules/emoome/assets/';

		$this->load->config('emoome');
		$this->load->model('emoome_model');
	}
	
	function people()
	{		
		if ($this->uri->segment(4))
		{			
			$person			= $this->social_auth->get_user('user_id', $this->uri->segment(4));
			$person_meta	= $this->social_auth->get_user_meta($this->uri->segment(4));
			$log_count		= $this->emoome_model->count_logs_user($this->uri->segment(4));
			$devices		= array();
			
			foreach ($person_meta as $meta)
			{
				// Word Map
				if ($meta->meta == 'word_type_map')
				{
					$word_map = $meta->value;
				}
				
				// Devices
				if ($meta->meta == 'device')
				{
					$devices[] = $meta->value;
				}
			}

			$this->data['log_count']	= $log_count;
			$this->data['sub_title']	= $person->name;
			$this->data['word_map']		= $word_map;
			$this->data['devices']		= $devices;
			$this->data['person']		= $person;
			$this->data['person_meta']	= $person_meta;
		}
		else
		{
			$this->data['sub_title']	= 'People';	
			$this->data['people'] 		= $this->social_auth->get_users('active', 1);
		}
		
		
		$this->render('dashboard_wide');
	}
	
	
	// Old Site
	function emotion()
	{

		$this->form_validation->set_rules('emotion', 'Emotion', 'trim|required|min_length[2]');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['header']			= 'header';			
			$data['main_content']	= 'emotion';			
			$data['footer']			= 'footer';	
			$this->load->view('specific/inc_site', $data);	
		}
		else
		{
		
			$word = $this->input->post('emotion');
			$chkword = $this->contribute_model->word_check($word);
						
			//If word not in dictionary insert it
			if ($chkword == "empty")
			{
				$stem = $this->natural_language_model->stem_one_word($word);
									
				$this->contribute_model->word_add($word, $stem, "E");
				$word_id = $this->db->insert_id();
				
				$this->contribute_model->emotion_add($word_id);
				
				//NEED TO ADD TAXONOMY INSERTION
				redirect('contribute/behaviors/'.$word_id);	
			}
			//Word is in dictionary then insert link & taxonomy
			else
			{
				$word_id = $chkword;
				
				$this->contribute_model->emotion_add($word_id);
			
				//NEED TO ADD TAXONOMY INSERTION
				redirect('contribute/behaviors/'.$word_id);				
			}
		}
	}


	function behaviors()
	{
		$data['header']			= 'header';			
		$data['main_content']	= 'behaviors';			
		$data['footer']			= 'footer';	
		$this->load->view('specific/inc_site', $data);	
	}

	function behaviors_add()
	{

		$this->form_validation->set_rules('behavior_1', 'Behavior', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('behavior_2', 'Behavior', 'trim|required|min_length[2]');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == FALSE)
		{	
			$data['header']			= 'header';			
			$data['main_content']	= 'behaviors';			
			$data['footer']			= 'footer';	
			$this->load->view('specific/inc_site', $data);				
		}
		else
		{
			$this->contribute_model->behaviors_add();
			redirect('contribute/describe');	
		}
	}

	function describe()
	{
					
		$data = array();

		//If both behaviors have been describbed go to thanks page
		if (($this->session->flashdata('behavior_1') == "") && ($this->session->flashdata('behavior_2') == "")) {		
			redirect('contribute/thanks');	
		}
		//Describe 1st behavior
		elseif (($this->session->flashdata('behavior_1') != "") && ($this->session->flashdata('behavior_2') != ""))
		{
				
			//Gets behavior for quote
			$behavior_id = $this->session->flashdata('behavior_1');
			if ($query = $this->contribute_model->behavior_get($behavior_id))
			{
				$data['records'] = $query;
			}	
					
			//Validation
			$this->form_validation->set_rules('describe1', 'Describe', 'trim|required|min_length[2]');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->keep_flashdata('behavior_1');
				$this->session->keep_flashdata('behavior_2');		
			}
			else
			{
				$this->descriptors_add($behavior_id);
				$this->session->set_userdata('behavior_1', '');
				$this->session->keep_flashdata('behavior_2');					
				redirect('contribute/describe/');											
			}			
				
		}
		//Descrbie 2nd behavior
		elseif (($this->session->flashdata('behavior_1') == "") && ($this->session->flashdata('behavior_2') != "")) 
		{
		
			//Gets behavior for quote
			$behavior_id = $this->session->flashdata('behavior_2');
			if ($query = $this->contribute_model->behavior_get($behavior_id))
			{
				$data['records'] = $query;
			}			
			//Validation
			$this->form_validation->set_rules('describe1', 'Describe', 'trim|required|min_length[2]');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->keep_flashdata('behavior_2');		
			}
			else
			{
				$this->descriptors_add($behavior_id);
				$this->session->set_userdata('behavior_2', '');
				redirect('contribute/describe/');						
			}	
		
		}
		else
		{
			redirect('contribute/thanks');	
		}		
		
		$data['header']			= 'header';			
		$data['main_content']	= 'describe';			
		$data['footer']			= 'footer';	
		$this->load->view('specific/inc_site', $data);	
	}
	
	function descriptors_add($behavior_id)
	{
	
		$descriptors = array($this->input->post('describe1'), $this->input->post('describe2'), $this->input->post('describe3'));
		foreach ($descriptors as $describe) :
		
		if ($describe != "")
		{
			$chkword = $this->contribute_model->word_check($describe);
						
			if ($chkword == "empty")
			{

				$stem = $this->natural_language_model->stem_one_word($describe);
				$this->contribute_model->word_add($describe, $stem);
				$word_id = $this->db->insert_id();
				
				$this->contribute_model->describe_add($word_id, $behavior_id);										
				//NEED TO ADD TAXONOMY INSERTION				

			}
			else
			{
				$word_id = $chkword;
				$this->contribute_model->describe_add($word_id, $behavior_id);
				//NEED TO ADD TAXONOMY INSERTION				
			
			}	
		}										
		endforeach;	
	
	}
	

	//After contribution is made
	function thanks()
	{
		$query = $this->check_model->phase_1_check();

		$data['records'] 		= 7 - $query;		
		$data['header']			= 'header';			
		$data['main_content']	= 'thanks';			
		$data['footer']			= 'footer';	
		$this->load->view('specific/inc_site', $data);	
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{		
			$this->session->sess_destroy();
			redirect(base_url());
		}		
	}		
	
}