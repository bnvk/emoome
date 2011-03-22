<?php
//Contribute deals with making data contributions
class Natural_language_model extends Model 
{

	function stem_one_word($word)
	{
		$this->load->library('porterstemmer');
		
		$newword = $this->porterstemmer->stem($word);

		return $newword;
	}

	function stem_multiple_words($words)
	{
		$this->load->library('porterstemmer');
	
		$oldwords = explode(' ', $words);
						
		foreach ($oldwords as $word) :
			
			$wordtostem = preg_replace('/[^A-z0-9]/', '', $word);			
			
			$stem = $this->porterstemmer->stem($wordtostem);
			
			$newwords[] = array('word' => $wordtostem, 'stem' => $stem);
									
		endforeach; 	
		
		return $newwords;
	}

	function word_count($words)
	{

		$oldwords = explode(' ', $words);

		$result = count ($oldwords);
		return $result;	
	
	}

}