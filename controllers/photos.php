<?php
class Photos extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

	    if (!$this->social_auth->logged_in()) redirect('login');

        $this->load->library('emoome');

        $this->layout = 'normal';

		// Load Things
		$this->load->library('color_analyze');
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
				$color_html .= '<div style="width:75px; height: 75px; font-size: 11px; margin: 10px; float: left; background: #'.$analysis->hex.';"></div>';
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
				$image_url = $image->images->thumbnail->url;
	
				// Is Added
				if (!$check_photo = $this->photos_model->check_photo_exists($image_url))
				{
					// Do Image Analysis
					$finalpalette = $this->color_analyze->processImage($image_url);

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
					
					
					// Check For Faces
					$do_faces	= TRUE;
					$has_faces	= 'no';
					
					if ($do_faces)
					{
						$this->load->library('face_api');
					
						$auth	= $this->face_api->__call('account_authenticate');
						$faces	= $this->face_api->__call('faces_detect', $image->images->standard_resolution->url);					
					
						foreach ($faces->photos as $photo)
						{
							if (count($photo->tags) > 0)
							{
								$has_faces = 'yes';
							}
						}
					}
		
					// Add Photo
					$photo_data = array(
						'user_id'		=> $user_id,
						'source'		=> 'instagram',
						'context'		=> 'emoome',
						'original'		=> $image_url,
						'text'			=> $text,
						'word_count'	=> $word_count,
						'color_count'	=> $color_count,
						'geo_lat'		=> $geo_lat,
						'geo_lon'		=> $geo_lon,
						'has_faces'		=> $has_faces,
						'originated_at'	=> unix_to_mysql($image->created_time)
					);
			
					$photo_id = $this->photos_model->add_photo($photo_data);
	
					// Add Color Values				
					foreach($finalpalette as $colour)
					{	
						$hsv = $this->color_analyze->rgb_to_hsv($colour['red'], $colour['green'], $colour['blue']);
					
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
					
					$output .= '<img src="'.$image_url.'" style="display: block; margin:10px; float:left;">';
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