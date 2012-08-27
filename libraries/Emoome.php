<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name:  	Emoome Library
* Author:  	Brennan Novak 
*
* Location: http://github.com/brennannovak/emoome
*/

class Emoome
{
	protected $ci;

	function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->config('emoome');
		$this->ci->load->helper('math');
        $this->ci->load->model('actions_model');
        $this->ci->load->model('emoome_model');
        $this->ci->load->model('logs_model');
        $this->ci->load->model('thoughts_model');
        $this->ci->load->model('words_model');
	}

	function update_users_meta_map($user_id)
	{
		$users_meta	= $this->ci->emoome_model->get_users_meta_map($user_id);
		$word_count	= array();

		if ($users_meta)
		{
			// Loops Existing Word Types
			foreach (config_item('emoome_word_types') as $key => $type)
			{
	 			$word_count[$type] = $this->ci->words_model->count_user_word_type($user_id, $key);
			}			
			
			$update_data = array(
				'user_id'		=> $user_id,
				'site_id'		=> config_item('site_id'),
				'module'		=> 'emoome',
				'meta'			=> 'word_type_map',
				'value'			=> json_encode($word_count),
				'updated_at'	=> unix_to_mysql(now())			
			);

			return $this->ci->emoome_model->update_users_meta_map($users_meta->user_meta_id, $update_data);
		}
		else
		{
			return $this->ci->emoome_model->add_users_meta_map($user_id);
		}

		return FALSE;
	}
	
	
}