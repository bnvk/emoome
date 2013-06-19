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

$config['emoome_path'] = 'emoome';

/*	Word Types */	
$config['emoome_word_types'] = array(
	'E' => 'emotional',
	'I' => 'intellectual',
	'S' => 'sensory',
	'D' => 'descriptive',
	'A' => 'action',
	'P' => 'physical',
	'U' => 'undecided'
);


$config['emoome_word_types_sub'] = array(
	'A'  =>	'animals',
	'AG' =>	'age',
	'AL' =>	'alcohol',
	'AC' =>	'architecture',
	'AR' =>	'art',
	'AT' => 'activism',
	'B'  => 'body',
	'C'  => 'common',
	'CA' =>	'caffeine',
	'CH' =>	'challenges',
	'CL' =>	'clothing',
	'CM' =>	'companies',
	'CO' =>	'colors',
	'CR' =>	'crime',
	'CU' =>	'culture',
	'D'  =>	'drugs',
	'DE' =>	'deception',
	'E'  =>	'exercise',
	'ED' =>	'education',
	'EN' =>	'entertainment',
	'EV' =>	'events',
	'F'  =>	'food',
	'FA' =>	'family',
	'FE' =>	'feeling',
	'FI' =>	'financial',
	'GA' =>	'games',
	'GE' =>	'gender',
	'GI' =>	'gibberish',
	'H'  =>	'home',
	'HE' =>	'health',
	'HU' =>	'humor',
	'HY' =>	'hygiene',
	'I'  =>	'intelligence',
	'IN' =>	'internet',
	'LE' =>	'legal',
	'M'  =>	'moral',
	'MD' =>	'medicine',
	'ME' =>	'measurement',
	'MO' =>	'movement',
	'MU' =>	'music',
	'N'  =>	'nature',
	'NA' =>	'names',
	'NE' =>	'news',
	'NU' =>	'numbers',
	'O'  =>	'ocean',
	'OB' =>	'objects',
	'OF' =>	'office',
	'P'  =>	'people',
	'PE' =>	'perception',
	'PH' =>	'philosophy',
	'PI' =>	'posession',
	'PL' =>	'places',
	'PO' =>	'politics',
	'PR' =>	'performing',
	'PS' =>	'psychological',
	'R'  =>	'romance',
	'RE' => 'religion',
	'S'  =>	'slang',
	'SC' =>	'science',
	'SE' =>	'sexuality',
	'SI' =>	'significance',
	'SG' => 'sight',
	'SL' =>	'sleep',
	'SM' =>	'smell',
	'SN' =>	'sound',
	'SO' =>	'social',
	'SP' =>	'sports',
	'T'  =>	'talking',
	'TA' =>	'taste',
	'TE' =>	'technology',
	'TI' =>	'time',
	'TO' =>	'touch',
	'TR' =>	'transportation',
	'TV' =>	'travel',
	'U'  =>	'undecided',
	'UR' =>	'urban',
	'V'	 =>	'violence',
	'W'  =>	'weapons',
	'WR' => 'writing',
	'WO' =>	'work'
);


$config['emoome_word_used'] = array(
	'F' => 'feeling',
	'D' => 'descriptor',
	'E' => 'experience'
);

$config['emoome_sentiment_emotion'] = array(
	'10' 	=> "joy",
	'9' 	=> "happy",
	'8' 	=> "amazement",
	'7' 	=> "serenity",
	'6' 	=> "interest",
	'5' 	=> "optimism",
	'4' 	=> "happy",
	'3' 	=> "goofy",
	'2' 	=> "acceptance",
	'1' 	=> "surprise",
	'0' 	=> "neutral",
	'-1' 	=>"annoyed",
	'-2' 	=> "crazy",
	'-3' 	=> "disapproval",
	'-4' 	=> "disgust",
	'-5' 	=> "fear",
	'-6' 	=> "sad",
	'-7' 	=> "shame",
	'-8' 	=> "grief",
	'-9' 	=> "loathing",
	'-10' 	=> "anger",
	'-11'	=> "rage"
);

$config['emoome_sentiment_emotion_array'] = array(
	'10' 		=> array(), // 10
	'8' 		=> array(), // 8
	'6' 		=> array(), // 6
	'4' 		=> array(), // 4
	'2'			=> array(),	// 2
	'0' 		=> array(), // 0
	'-2'		=> array(), // -2
	'-4'		=> array(), // -4	
	'-6' 		=> array(), // -6
	'-8'		=> array(), // -8
	'-10' 		=> array()  // -10
);

$config['emoome_speech_types'] = array(
	'V' => 'verb', 
	'N' => 'noun', 
	'P' => 'pro noun', 
	'A' => 'adjective', 
	'D' => 'adverb', 
	'R' => 'prepositon', 
	'C' => 'conjunction', 
	'I' => 'interjection'
);

$config['emoome_brown_corpus_speech'] = array(
	'.'		=> 'sentence closer (. ; ? *)',
	'('		=> 'left paren',
	')'		=> 'right paren',
	'*'		=> 'not, nt',
	'--' 	=> 'dash',
	','		=> 'comma',
	':'		=> 'colon',
	'ABL' 	=> 'pre-qualifier (quite, rather)',
	'ABN' 	=> 'pre-quantifier (half, all)',
	'ABX' 	=> 'pre-quantifier (both)',
	'AP'	=> 'post-determiner (many, several, next)',
	'AT' 	=> 'article (a, the, no)',
	'BE' 	=> 'be',
	'BED' 	=> 'were',
	'BEDZ'	=> 'was',
	'BEG'	=> 'being',
	'BEM' 	=> 'am',
	'BEN' 	=> 'been',
	'BER' 	=> 'are, art',
	'BEZ' 	=> 'is',
	'CC' 	=> 'coordinating conjunction (and, or)',
	'CD' 	=> 'cardinal numeral (one, two, 2, etc.)',
	'CS' 	=> 'subordinating conjunction (if, although)',
	'DO' 	=> 'do',
	'DOD' 	=> 'did',
	'DOZ' 	=> 'does',
	'DT' 	=> 'singular determiner/quantifier (this, that)',
	'DTI' 	=> 'singular or plural determiner/quantifier (some, any)',
	'DTS' 	=> 'plural determiner (these, those)',
	'DTX' 	=> 'determiner/double conjunction (either)',
	'EX' 	=> 'existential there',
	'FW' 	=> 'foreign word (hyphenated before regular tag)',
	'HV' 	=> 'have',
	'HVD' 	=> 'had (past tense)',
	'HVG' 	=> 'having',
	'HVN' 	=> 'had (past participle)',
	'IN' 	=> 'preposition',
	'JJ' 	=> 'adjective',
	'JJR' 	=> 'comparative adjective',
	'JJS' 	=> 'semantically superlative adjective (chief, top)',
	'JJT' 	=> 'morphologically superlative adjective (biggest)',
	'MD' 	=> 'modal auxiliary (can, should, will)',
	'NC' 	=> 'cited word (hyphenated after regular tag)',
	'NN' 	=> 'singular or mass noun',
	'NN$' 	=> 'possessive singular noun',
	'NNS' 	=> 'plural noun',
	'NNS$' 	=> 'possessive plural noun',
	'NP' 	=> 'proper noun or part of name phrase',
	'NP$' 	=> 'possessive proper noun',
	'NPS' 	=> 'plural proper noun',
	'NPS$' 	=> 'possessive plural proper noun',
	'NR' 	=> 'adverbial noun (home, today, west)',
	'OD' 	=> 'ordinal numeral (first, 2nd)',
	'PN' 	=> 'nominal pronoun (everybody, nothing)',
	'PN$' 	=> 'possessive nominal pronoun',
	'PP$' 	=> 'possessive personal pronoun (my, our)',
	'PP$$' 	=> 'second (nominal) possessive pronoun (mine, ours)',
	'PPL' 	=> 'singular reflexive/intensive personal pronoun (myself)',
	'PPLS' 	=> 'plural reflexive/intensive personal pronoun (ourselves)',
	'PPO' 	=> 'objective personal pronoun (me, him, it, them)',
	'PPS' 	=> '3rd. singular nominative pronoun (he, she, it, one)',
	'PPSS' 	=> 'other nominative personal pronoun (I, we, they, you)',
	'QL'	=> 'qualifier (very, fairly)',
	'QLP' 	=> 'post-qualifier (enough, indeed)',
	'RB' 	=> 'adverb',
	'RBR' 	=> 'comparative adverb',
	'RBT' 	=> 'superlative adverb',
	'RN' 	=> 'nominal adverb (here, then, indoors)',
	'RP' 	=> 'adverb/particle (about, off, up)',
	'TO' 	=> 'infinitive marker to',
	'UH' 	=> 'interjection, exclamation',
	'VB' 	=> 'verb, base form',
	'VBD' 	=> 'verb, past tense',
	'VBG' 	=> 'verb, present participle/gerund',
	'VBN' 	=> 'verb, past participle',
	'VBZ' 	=> 'verb, 3rd. singular present',
	'WDT' 	=> 'wh- determiner (what, which)',
	'WP$' 	=> 'possessive wh- pronoun (whose)',
	'WPO' 	=> 'objective wh- pronoun (whom, which, that)',
	'WPS' 	=> 'nominative wh- pronoun (who, which, that)',
	'WQL' 	=> 'wh- qualifier (how)',
	'WRB' 	=> 'wh- adverb (how, where, when)'
);
