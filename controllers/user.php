<?php
class User extends Site_Controller
{
    function __construct()
    {
        parent::__construct();
        
	    if (!$this->social_auth->logged_in()) redirect('login');        

        $this->load->library('emoome');	
	}

	function index()
	{	
		// Load User Settings
		$user		= $this->social_auth->get_user('user_id', $this->session->userdata('user_id'));
		$user_meta	= $this->social_auth->get_user_meta($this->session->userdata('user_id'));

		foreach (config_item('user_meta_details') as $config_meta)
		{
			$this->data[$config_meta] = $this->social_auth->find_user_meta_value($config_meta, $user_meta);
		}
		
		// Notifications
		$this->load->config('notifications/notifications');
	
		$this->render();
	}

}