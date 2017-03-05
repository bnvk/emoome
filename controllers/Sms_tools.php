<?php
class Sms_tools extends MY_Controller
{
    function __construct()
    {
        parent::__construct();       

		// Load Things
        $this->load->library('emoome');
	}
		
	/*	
	Sid			- A 34 character string that uniquely identifies this resource.
	DateCreated	- The date that this resource was created, given in RFC 2822 format.
	DateUpdated	- The date that this resource was last updated, given in RFC 2822 format.
	DateSent	- The date that the SMS was sent, given in RFC 2822 format.
	AccountSid	- The unique id of the Account that sent this SMS message.
	From		- The phone number that initiated the message in E.164 format. For incoming messages, this will be the remote phone. For outgoing messages, this will be one of your Twilio phone numbers.
	To			- The phone number that received the message in E.164 format. For incoming messages, this will be one of your Twilio phone numbers. For outgoing messages, this will be the remote phone.
	Body		- The text body of the SMS message. Up to 160 characters long.
	Status		- The status of this SMS message. Either queued, sending, sent, received, or failed.
	Direction	- The direction of this SMS message. incoming for incoming messages, outbound-api for messages initiated via the REST API, outbound-call for messages initiated during a call or outbound-reply for messages initiated in response to an incoming SMS.
	Price		- The amount billed for the message.
	ApiVersion	- The version of the Twilio API used to process the SMS message.
	Uri			- The URI for this resource, relative to https://api.twilio.com	
	*/
	function log_words()
	{
		$from			= substr($this->input->post('From'), -10);
		$user			= $this->social_auth->get_user('phone_number', $from);	
		$category_id	= 0;
		$process_sms	= FALSE;
		$ask_for_email	= FALSE;
		
		if ($user)
		{
			$user_id		= $user->user_id;
			$process_sms	= TRUE;
		}
		else
		{
			$user_id		= 0;
			$process_sms	= TRUE;
			// Check For Email
			/*
			if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $this->input->post('Body'), $has_email))
			{ 
				$username			= url_username($from, 'none', true);
		    	$password			= $this->input->post('password');
		    	$additional_data 	= array(
		    		'phone_number'	=> $from,
		    		'name'			=> 'Emoome User',
		    		'image'			=> '',
		    		'language'		=> 'en'  		
		    	);
      	
		    	// Create User
		    	if ($new_user = $this->social_auth->register($username, $password, $has_email[0], $additional_data, config_item('default_group')))
		    	{
			    	$user_id		= $new_user_id->user_id;
			    	$process_sms	= TRUE;
				}
			}
			else
			{
				$ask_for_email = TRUE;
			}
			*/
		}
	
		// Process SMS
		if ($process_sms)
		{
	    	$log_thought = $this->thoughts_model->add_thought($user_id, 10, 'sms', $this->input->post('Body'));
		}
		
		// Ask For Email
		/*
		if ($ask_for_email)
		{
			$this->load->config('twilio/twilio');
			$this->load->library('twilio/twilio');
			
			$sms_from 	= config_item('twilio_phone_number');
			$sms_to		= $from;
			$message 	= 'Please send us your email address before you start';
	
			$send_sms = $this->twilio->sms($sms_from, $sms_to, $message);
		}
		*/
	}
	
	function send_sms()
	{
	
		$this->load->config('twilio/twilio');
		$this->load->library('twilio/twilio');

		$from		= substr('+15036622442', -10);

		
		$sms_from 	= config_item('twilio_phone_number');
		$sms_to		= $from;
		$message 	= 'Please send us your email before you start';

		$send_sms = $this->twilio->sms($sms_from, $sms_to, $message);		
		
	}
	
	function test()
	{
		$from			= substr('+15036622442', -10);
		$user			= $this->social_auth->get_user('phone_number', 5036622442);	
		
		echo  'Hiii';
	
		print_r($user);
	}
	
}