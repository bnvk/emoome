<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
// Plutchiks wheel of emotions
// http://en.wikipedia.org/wiki/Contrasting_and_categorization_of_emotions#Plutchik.27s_wheel_of_emotions

$lang["basic_emotions"]	= array("joy", "trust", "fear", "surprise", "sadness", "disgust", "anger", "anticipation");
$lang["basic_emotions_opposites"] = array("sadness", "disgust", "anger", "anticipation", "joy", "trust", "fear", "surprise");

// Human feelings (results of emotions)
$lang["feelings_primary"] = array("optimism", "love", "submission", "awe", "disappointment", "remorse", "contempt", "aggressiveness");

// Primary Emotions That Lead to Feelings
$lang["feelings_primary_optimism"]					= array("anticipation", "joy");
$lang["feelings_primary_opposite_optimism"]			= array("disapproval");

$lang["feelings_primary_love"]						= array("joy", "trust");
$lang["feelings_primary_opposite_love"]				= array("remorse");

$lang["feelings_primary_submission"]				= array("trust", "fear");
$lang["feelings_opposite_submission"]				= array("contempt");

$lang["feelings_primary_awe"]						= array("fear", "surprise");	
$lang["feelings_primary_opposite_awe"]				= array("aggressiveness");

$lang["feelings_primary_disappointment"]			= array("surprise", "sadness");	
$lang["feelings_primary_opposite_disappointment"]	= array("optimism");

$lang["feelings_primary_remorse"]					= array("sadness", "disgust");
$lang["feelings_primary_opposite_remorse"]			= array("love");

$lang["feelings_primary_contempt"]					= array("disgust", "anger");
$lang["feelings_primary_opposite_contempt"]			= array("submission");

$lang["feelings_primary_aggressiveness"]			= array("anger", "anticipation");	
$lang["feelings_primary_opposite_aggressiveness"]	= array("awe");

// Secondary Emotions That Lead to Feelings
$lang["feelings_secondary_guilt"]					= array("joy", "fear");
$lang["feelings_secondary_curiosity"]				= array("trust", "surprise");
$lang["feelings_secondary_despair"]					= array("fear", "sadness");
$lang["feelings_secondary_uncertainty"]				= array("surprise", "disgust");
$lang["feelings_secondary_envy"]					= array("sadness", "anger");
$lang["feelings_secondary_cynism"]					= array("disgust", "anticipation");
$lang["feelings_secondary_pride"]					= array("anger", "joy");
$lang["feelings_secondary_fatalism"]				= array("anticipation", "trust");

// Tertiary Emotions That Lead to Feelings
$lang["feelings_tertiary_delight"]					= array("joy", "surprise");
$lang["feelings_tertiary_sentimentality"]			= array("trust", "sadness");
$lang["feelings_tertiary_shame"]					= array("fear", "disgust");
$lang["feelings_tertiary_outrage"]					= array("surprise", "anger");
$lang["feelings_tertiary_pessimism"]				= array("sadness", "anticipation");
$lang["feelings_tertiary_morbidness"]				= array("disgust", "joy");
$lang["feelings_tertiary_dominance"]				= array("anger", "trust");
$lang["feelings_tertiary_anxiety"]					= array("anticipation", "fear");

