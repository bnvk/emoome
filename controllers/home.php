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

    // Get Meta Values - word map & devices
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
    $common_words = $this->lang->line('common');

    foreach($taxonomy_user as $taxonomy):

      if (in_array($taxonomy->word, $common_words['words']) AND ($taxonomy->count > 1)):
        $this->data['common_words'][] = '<strong>'.$taxonomy->word.'</strong> ('.$taxonomy->count.')';
      else:
        
      endif;

    endforeach;



    $this->data['log_count']	  = $log_count;
    $this->data['sub_title']	  = $person->name;
    $this->data['word_map']		  = $word_map;
    $this->data['devices']		  = $devices;
    $this->data['person']       = $person;
    $this->data['person_meta']	= $person_meta;
    $this->data['taxonomy_user']= $taxonomy_user;

  	$this->render('dashboard_wide');
	}


  function word()
  {
    $word     = $this->words_model->check_word($this->uri->segment(5));
    $word_links = $this->words_model->get_word_links_log_ids($this->uri->segment(4), $word->word_id);
    
    if ($word_links['F']):
      $feelings =  $this->experiences_model->get_experiences($word_links['F']);
    else:
      $feelings = array();
    endif;
        
    if ($word_links['E']):
      $experiences =  $this->experiences_model->get_experiences($word_links['E']);
    else:
      $experiences = array();
    endif;

    if ($word_links['D']):
      $descriptors =  $this->experiences_model->get_experiences($word_links['D']);
    else:
      $descriptors = array();
    endif;

    echo '<pre>';
    print_r($word);
    echo '<hr>';
    print_r($feelings);
    echo '<hr>';
    print_r($experiences);
    echo '<hr>';
    print_r($descriptors);


    die();

    $this->render('dashboard_wide');
  }


	function analyze()
	{
		$this->data['sub_title']	= 'Analyze';	
	
		$this->render('dashboard_wide');		
	}	
	
}