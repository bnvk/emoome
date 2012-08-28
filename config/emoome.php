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

$config['emoome_word_types_count'] = array(
	'E' => 0,
	'I' => 0,
	'S' => 0,
	'D' => 0,
	'A' => 0,
	'P' => 0,
	'U' => 0
);

$config['emoome_word_types_sub'] = array(
	'A'	 => 'animals',
	'AL' => 'alcohol',
	'C'  => 'common',
	'CO' => 'color',
	'CL' => 'clothing',
	'CU' => 'culture',
	'F'  => 'food',
	'FA' => 'family',
	'FE' => 'feeling',
	'G'  => 'significance',
	'H'  => 'home',
	'HY' => 'hygiene',
	'M'  => 'moral',
	'MO' => 'movement',
	'MU' => 'music',
	'N'  => 'nature',
	'NA' => 'names',
	'NU' => 'numbers',
	'OB' => 'objects',
	'P'  => 'people',
	'PE' => 'perception',
	'PL' => 'place',
	'PS' => 'psychological',	
	'S'  => 'slang',
	'SO' => 'social',
	'SP' => 'sports',
	'T'  => 'talking',
	'TE' => 'technology',
	'UR' => 'urban',
	'V'  => 'violence',
	'W'  => 'weapons',
	'U' => 'undecided'	
);

$config['emoome_word_types_sub_count'] = array(
	'A'	 => 0,
	'AL' => 0,
	'C'  => 0,
	'CO' => 0,
	'CL' => 0,
	'CU' => 0,
	'F'  => 0,
	'FA' => 0,
	'FE' => 0,
	'G'  => 0,
	'H'  => 0,
	'HY' => 0,
	'M'  => 0,
	'MO' => 0,
	'MU' => 0,
	'N'  => 0,
	'NA' => 0,
	'NU' => 0,
	'OB' => 0,
	'P'  => 0,
	'PE' => 0,
	'PL' => 0,
	'PS' => 0,	
	'S'  => 0,
	'SO' => 0,
	'SP' => 0,
	'T'  => 0,
	'TE' => 0,
	'UR' => 0,
	'V'  => 0,
	'W'  => 0,
	'U'  => 0
);

$config['emoome_word_used'] = array(
	'F' => 'feeling',
	'D' => 'descriptor',
	'E' => 'experience'
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
