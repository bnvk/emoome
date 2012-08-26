<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
// Plutchiks wheel of emotions
// http://en.wikipedia.org/wiki/Contrasting_and_categorization_of_emotions#Plutchik.27s_wheel_of_emotions

$lang["opposites_basic"]	= array("joy", "trust", "fear", "surprise", "sadness", "disgust", "anger", "anticipation");
$lang["opposites_opposite"] = array("sadness", "disgust", "anger", "anticipation", "joy", "trust", "fear", "surprise");

// Human feelings (results of emotions)
$lang["feelings"] = array("optimism", "love", "submission", "awe", "disappointment", "remorse", "contempt", "aggressiveness");

// Emotions That Lead to Feelings
$lang["feelings_optimism"]					= array("anticipation", "joy");
$lang["feelings_optimism_opposite"]			= array("disapproval");

$lang["feelings_love"]						= array("joy", "trust");
$lang["feelings_love_opposite"]				= array("remorse");

$lang["feelings_submission"]				= array("trust", "fear");
$lang["feelings_submission_opposite"]		= array("contempt");

$lang["feelings_awe"]						= array("fear", "surprise");	
$lang["feelings_awe_opposite"]				= array("aggressiveness");
		
$lang["feelings_disappointment"]			= array("surprise", "sadness");	
$lang["feelings_disappointment_opposite"]	= array("optimism");

$lang["feelings_remorse"]					= array("sadness", "disgust");
$lang["feelings_remorse_opposite"]			= array("love");

$lang["feelings_contempt"]					= array("disgust", "anger");
$lang["feelings_contempt_opposite"]			= array("submission");

$lang["feelings_aggressiveness"]			= array("anger", "anticipation");	
$lang["feelings_aggressiveness_opposite"]	= array("awe");