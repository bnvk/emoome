<?php
class Experiments extends MY_Controller
{
    function __construct()
    {
        parent::__construct();       

		// Load Things
        $this->load->library('emoome');
	}
	
	function my_twitter_friends()
	{		
		$check_connection = $this->social_auth->check_connection_user($this->session->userdata('user_id'), 'twitter', 'primary');

		if (!$check_connection) {
			echo 'No Tweeters Accounts';
			die();
		}

		$this->load->library('twitter/twitter_igniter', $check_connection);		


		// Get Tweets
		$params = array(
			'count' => 200,
			'include_entities' => true,
			'trim_user' => true
		);

		// Use URL to choose user
		if ($this->uri->segment(4)):
			$this->data['person'] = $this->uri->segment(4);
			$params['screen_name'] = $this->uri->segment(4);
		else:
			$this->data['person'] = 'brennannovak';
		endif;


		// Get Timeline
		$timeline = $this->twitter_igniter->get_user_timeline($params);

		$language	= array();
		$topics		= array();
		$words_total= 0;
		$tweets     = '';
/*
		echo '<pre>';
		print_r($timeline);
		die();
*/		
		// Analyze the Bugga
		foreach($timeline as $tweet):

			$this->data['text']		= $tweet->text;
			$this->data['hashtags']	= $this->process_twitter_entities_hashtags($tweet->entities->hashtags);
			$this->data['urls']		= $this->process_twitter_entities_urls($tweet->entities->urls);
			$this->data['mentions']	= $this->process_twitter_entities_mentions($tweet->entities->user_mentions);


			// Strip Out Usernames & Hashtags
			$emoomed = $this->emoome->analyze_text($tweet->text, TRUE, $this->data['mentions']);

			// Language
			if (isset($emoomed['language'])):
			foreach ($emoomed['language'] as $lang => $count):
				if (array_key_exists($lang, $language)):
					$language[$lang] = $count + $language[$lang];
				else:
					$language[$lang] = $count;									
				endif;
			endforeach;
			endif;

			// Topics
			if (isset($emoomed['topics'])):
			foreach ($emoomed['topics'] as $topic => $count):
				if (array_key_exists($topic, $topics)):
					$topics[$topic] = $count + $topics[$topic];
				else: 
					$topics[$topic] = $count;
				endif;
			endforeach;
			endif;
			
			$words_total = $emoomed['language_total'] + $words_total;

			// Inject Sentiment
			$this->data['sentiment'] = $emoomed['sentiment'];

			// Render Tweet
			$tweets .= $this->load->view('../modules/emoome/views/experiments/my_twitter_friends_tweet', $this->data, true);


		endforeach;
	
		arsort($language);
		arsort($topics);
			
		$this->data['language'] 	= $language;
		$this->data['topics'] 		= $topics;
		$this->data['words_total'] 	= $words_total;
		$this->data['tweets'] 		= $tweets;
		$this->load->view('../modules/emoome/views/experiments/my_twitter_friends', $this->data);

	}
		
	function process_twitter_entities_hashtags($entities)
	{
		$output = array();
		if ($entities):
			foreach ($entities as $entity):
				$output[] = '#'.$entity->text;
			endforeach;
		endif;
		return $output;
	}

	function process_twitter_entities_urls($entities)
	{
		$output = array();
		if ($entities):
			foreach ($entities as $entity):
				$output[] = $entity->url;
			endforeach;
		endif;
		return $output;
	}

	function process_twitter_entities_mentions($entities)
	{
		$output = array();
		if ($entities):
			foreach ($entities as $entity):
				$output[] = '@'.$entity->screen_name;
			endforeach;
		endif;
		return $output;
	}		
}