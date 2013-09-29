<?php
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->data['page_title']		= 'Emoome';
		$this->data['emoome_assets']	= base_url().'application/modules/emoome/assets/';

        $this->load->library('emoome');
	}
	
	function people()
	{		
		$this->data['sub_title']	= 'People';	
		$this->data['people'] 		= $this->social_auth->get_users('active', 1);

		$this->render('dashboard_wide');
	}	


	function person()
	{
		
    $person			 = $this->social_auth->get_user('user_id', $this->uri->segment(4));
    $person_meta = $this->social_auth->get_user_meta($this->uri->segment(4));
    $log_count   = $this->logs_model->count_logs_user($this->uri->segment(4));
    $devices     = array();
    $word_map    = '';
    
    // Get Meta Values (word map & devices)
    foreach ($person_meta as $meta):
    	if ($meta->meta == 'word_type_map'):
    		$word_map = $meta->value;
    	endif;
    	if ($meta->meta == 'device'):
    		$devices[] = $meta->value;
    	endif;
    endforeach;

    // Taxonomies
    $taxonomy_user = $this->words_model->get_taxonomy_user($this->uri->segment(4));

    $this->data['log_count']	  = $log_count;
    $this->data['sub_title']	  = $person->name;
    $this->data['word_map']		  = $word_map;
    $this->data['devices']		  = $devices;
    $this->data['person']       = $person;
    $this->data['person_meta']	= $person_meta;
    $this->data['taxonomy_user']= $taxonomy_user;

  	$this->render('dashboard_wide');
	}
	
	
	function analyze()
	{
		$this->data['sub_title']	= 'Analyze';	
	
		$this->render('dashboard_wide');		
	}	
	
}