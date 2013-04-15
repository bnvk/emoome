<?php
class Site extends Site_Controller
{
    function __construct()
    {
        parent::__construct();        
	}

	function index()
	{
		// Global Templates
		$this->data['template_auth']		= $this->load->view('../site_emoome/partials/global_auth', $this->data, true);	
		$this->data['template_record']		= $this->load->view('../site_emoome/partials/global_record', $this->data, true);
		$this->data['template_visualize']	= $this->load->view('../site_emoome/partials/global_visualize', $this->data, true);
		$this->data['template_settings']	= $this->load->view('../site_emoome/partials/global_settings', $this->data, true);
		$this->data['template_public']		= $this->load->view('../site_emoome/partials/global_public', $this->data, true);


		// Mobile or Web Template
		if ($this->agent->is_mobile())
		{
			$this->data['template_visualize']  .= $this->load->view('../site_emoome/partials/mobile_visualize', $this->data, true);
		}
		else
		{
			$this->data['template_visualize']  .= $this->load->view('../site_emoome/partials/web_visualize', $this->data, true);
		}

		$this->render('web');
	}

}