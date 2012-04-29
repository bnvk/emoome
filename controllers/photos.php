<?php
class Photos extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

	    if (!$this->social_auth->logged_in()) redirect('login');

		$this->load->config('emoome');

        $this->layout = 'normal';

		// Load Things
		$this->load->library('spectrum');
		$this->load->model('photos_model');
	}
	
	function index()
	{
		$this->load->model('photos_model');

		$photos = $this->photos_model->get_photos_user($this->session->userdata('user_id'));
		$photos_analysis = $this->photos_model->get_photos_analysis_user($this->session->userdata('user_id'));
	
		if ($photos)
		{
		
			$color_html = '';
		
			foreach ($photos_analysis as $analysis)
			{
				$color_html .= '<div style="width:50px; height: 50px; margin: 10px; float: left; background: #'.$analysis->hex.';"></div>';
			}
	
			echo '<h1>Your Instagram Colors</h1>';
			echo $color_html;
			echo '<div style="clear:both;"></div>';
		}
		else
		{
			redirect('emoome/photos/get_photos');
		}

	}	
	
	function get_photos()
	{
		// Instagram Shit
		$this->load->config('instagram/instagram');
		$module_site		= $this->social_igniter->get_site_view_row('module', 'instagram');		
		$check_connection 	= $this->social_auth->check_connection_user($this->session->userdata('user_id'), 'instagram', 'primary');
	
		if (!$check_connection) redirect('connections/instagram/add');	
	
		$this->load->library('instagram/instagram_api', $check_connection->auth_one);
	

		// Get Images
		$images = $this->instagram_api->getUserRecent($check_connection->connection_user_id);

		if (isset($images->data))
		{
			$output = '';
		
			// Loop Images		
			foreach ($images->data as $image)
			{
				$image = $image->images->thumbnail->url;
	
				// Is Added
				if (!$check_photo = $this->photos_model->check_photo_exists($image))
				{
					// Do Image Analysis
					$finalpalette = $this->spectrum->processImage($image);

					// User
					$user_id = $this->session->userdata('user_id');

					// Text
					if (isset($image->caption->text))
					{
						$text = $image->caption->text;
						$word_count = count(explode(" ", $text));
					}
					else
					{
						$text = '';
						$word_count = 0;
					}
	
					// Color Values
					$color_count = count($finalpalette);
	
					// Geo Values
					if (isset($image->location->latitude)) $geo_lat = $image->location->latitude;
					else $geo_lat = 0;
		
					if (isset($image->location->longitude)) $geo_lon = $image->location->longitude;
					else $geo_lon = 0;
		
					// Add Photo
					$photo_data = array(
						'user_id'		=> $user_id,
						'source'		=> 'instagram',
						'context'		=> 'emoome',
						'original'		=> $image,
						'text'			=> $text,
						'word_count'	=> $word_count,
						'color_count'	=> $color_count,
						'geo_lat'		=> $geo_lat,
						'geo_lon'		=> $geo_lon,
						'originated_at'	=> '2012-04-23 01:23:55'
					);
			
					$photo_id = $this->photos_model->add_photo($photo_data);
	
					// Add Color Values				
					foreach($finalpalette as $colour)
					{	
						$hsv = $this->spectrum->rgb_to_hsv($colour['red'], $colour['green'], $colour['blue']);
					
						$photo_analysis = array(
							'photo_id'	=> $photo_id,
							'user_id'	=> $user_id,
							'red' 		=> $colour['red'],
							'green' 	=> $colour['green'],
							'blue' 		=> $colour['blue'],
							'hue'		=> $hsv['H'],
							'saturation'=> $hsv['S'],
							'value'		=> $hsv['V'],
							'hex' 		=> $colour['hex']
						);
						
						$this->photos_model->add_photo_analysis($photo_analysis);
					}
					
					$output .= '<img src="'.$image.'" style="display: block; margin:10px; float:left;">';
				}
				else
				{
					$output .= 'Image already added<br>';
				}
			}

			echo $output.'<div style="clear: both;"></div>';
			echo 'Great now go see <a href="'.base_url().'emoome/photos">your color palate</a>';		
		}
		else
		{
			echo 'You do not have any Instagram pictures :(';
		}
		
	}
	
}