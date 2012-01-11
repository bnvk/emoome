<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		Social Igniter : Module Template : Config
* Author: 	Brennan Novak
* 		  	contact@social-igniter.com
* 
* Created by Brennan Novak
*
* Project:	http://social-igniter.com
* Source: 	http://github.com/socialigniter/module-template
* 
* Description: this file Social Igniter
*/

$config['emoome_path']			= 'emoome';

/*	Word Types
	E - emotional
	I - intellectual
	S - sensory
	D - descriptor
	A - action
	P - physical
	U - unclassifiable

	NEW CATEGORIES ???
	P - Perception / R - Relative (honest, good)
*/	

$config['emoome_word_types']	= array(
	'E' => 'Emotional',
	'I' => 'Intellectual',
	'S' => 'Sensory',
	'D' => 'Descriptor',
	'A' => 'Action',
	'P' => 'Physical',
	'G' => 'Slang',
	'M' => 'Moral',
	'U' => 'Undecided',
	'F' => 'Food',
	'C' => 'Common'
);
$config['emoome_speech_types']	= array(
	'V' => 'verb', 
	'N' => 'noun', 
	'P' => 'pro noun', 
	'A' => 'adjective', 
	'D' => 'adverb', 
	'R' => 'prepositon', 
	'C' => 'conjunction', 
	'I' => 'interjection'
);
