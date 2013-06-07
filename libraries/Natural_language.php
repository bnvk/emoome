<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Natural Language Library
*
* @package		Natural Language
* @subpackage	Natural Language Library
* @author		Brennan Novak
* @link			http://brennannovak.com
*
* runs natural language proccessing, removes common words, stems, etc...
*/

class Natural_language {

	function __construct() 
	{
		$this->ci =& get_instance();
		$this->ci->lang->load('common');
	}
     
	function remove_words($words, $stoplist)
	{
	    $words = explode(' ', strtolower($words));

		foreach ($words as $word)
		{			
			if ($this->check_word($word, $stoplist) == false) 
			{			
				$clean_special = preg_replace('/[^A-z0-9]/', '', $word);
			
				if ($clean_special)
				{			
					$thisword[] = array("word" => $clean_special);				
				}
			}
		}		
		return $thisword;	
	}
	
	// Checks If Word Is In List
    function check_word($checkword, $stoplist)
    {
    	$stopwords = $this->ci->lang->line($stoplist);
    	
    	foreach ($stopwords as $word)
    	{   	
    		if ($checkword == $word) 
    		{
    			$result = true;    	
    	    	break;    	
    		}
    		else
    		{
    			$result = false;
    		}
    	}
    	return $result;    	    	
    }	  


	// PORTER STEMMER
    private static $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';
    private static $regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
    public static function stem($word)
    {
        if (strlen($word) <= 2) {
            return $word;
        }
        $word = self::step1ab($word);
        $word = self::step1c($word);
        $word = self::step2($word);
        $word = self::step3($word);
        $word = self::step4($word);
        $word = self::step5($word);
        return $word;
    }

    private static function step1ab($word)
    {
        if (substr($word, -1) == 's') {

               self::replace($word, 'sses', 'ss')
            OR self::replace($word, 'ies', 'i')
            OR self::replace($word, 'ss', 'ss')
            OR self::replace($word, 's', '');
        }

        if (substr($word, -2, 1) != 'e' OR !self::replace($word, 'eed', 'ee', 0)) {
            $v = self::$regex_vowel;

            if (   preg_match("#$v+#", substr($word, 0, -3)) && self::replace($word, 'ing', '')
                OR preg_match("#$v+#", substr($word, 0, -2)) && self::replace($word, 'ed', '')) {
                if (    !self::replace($word, 'at', 'ate')
                    AND !self::replace($word, 'bl', 'ble')
                    AND !self::replace($word, 'iz', 'ize')) {

                    if (    self::doubleConsonant($word)
                        AND substr($word, -2) != 'll'
                        AND substr($word, -2) != 'ss'
                        AND substr($word, -2) != 'zz') {

                        $word = substr($word, 0, -1);

                    } else if (self::m($word) == 1 AND self::cvc($word)) {
                        $word .= 'e';
                    }
                }
            }
        }

        return $word;
    }

    private static function step1c($word)
    {
        $v = self::$regex_vowel;

        if (substr($word, -1) == 'y' && preg_match("#$v+#", substr($word, 0, -1))) {
            self::replace($word, 'y', 'i');
        }

        return $word;
    }

    private static function step2($word)
    {
        switch (substr($word, -2, 1)) {
            case 'a':
                   self::replace($word, 'ational', 'ate', 0)
                OR self::replace($word, 'tional', 'tion', 0);
                break;
            case 'c':
                   self::replace($word, 'enci', 'ence', 0)
                OR self::replace($word, 'anci', 'ance', 0);
                break;
            case 'e':
                self::replace($word, 'izer', 'ize', 0);
                break;
            case 'g':
                self::replace($word, 'logi', 'log', 0);
                break;
            case 'l':
                   self::replace($word, 'entli', 'ent', 0)
                OR self::replace($word, 'ousli', 'ous', 0)
                OR self::replace($word, 'alli', 'al', 0)
                OR self::replace($word, 'bli', 'ble', 0)
                OR self::replace($word, 'eli', 'e', 0);
                break;
            case 'o':
                   self::replace($word, 'ization', 'ize', 0)
                OR self::replace($word, 'ation', 'ate', 0)
                OR self::replace($word, 'ator', 'ate', 0);
                break;
            case 's':
                   self::replace($word, 'iveness', 'ive', 0)
                OR self::replace($word, 'fulness', 'ful', 0)
                OR self::replace($word, 'ousness', 'ous', 0)
                OR self::replace($word, 'alism', 'al', 0);
                break;
            case 't':
                   self::replace($word, 'biliti', 'ble', 0)
                OR self::replace($word, 'aliti', 'al', 0)
                OR self::replace($word, 'iviti', 'ive', 0);
                break;
        }

        return $word;
    }

    private static function step3($word)
    {
        switch (substr($word, -2, 1)) {
            case 'a':
                self::replace($word, 'ical', 'ic', 0);
                break;
            case 's':
                self::replace($word, 'ness', '', 0);
                break;
            case 't':
                   self::replace($word, 'icate', 'ic', 0)
                OR self::replace($word, 'iciti', 'ic', 0);
                break;
            case 'u':
                self::replace($word, 'ful', '', 0);
                break;
            case 'v':
                self::replace($word, 'ative', '', 0);
                break;
            case 'z':
                self::replace($word, 'alize', 'al', 0);
                break;
        }

        return $word;
    }

    private static function step4($word)
    {
        switch (substr($word, -2, 1)) {
            case 'a':
                self::replace($word, 'al', '', 1);
                break;
            case 'c':
                   self::replace($word, 'ance', '', 1)
                OR self::replace($word, 'ence', '', 1);
                break;
            case 'e':
                self::replace($word, 'er', '', 1);
                break;
            case 'i':
                self::replace($word, 'ic', '', 1);
                break;
            case 'l':
                   self::replace($word, 'able', '', 1)
                OR self::replace($word, 'ible', '', 1);
                break;
            case 'n':
                   self::replace($word, 'ant', '', 1)
                OR self::replace($word, 'ement', '', 1)
                OR self::replace($word, 'ment', '', 1)
                OR self::replace($word, 'ent', '', 1);
                break;
            case 'o':
                if (substr($word, -4) == 'tion' OR substr($word, -4) == 'sion') {
                   self::replace($word, 'ion', '', 1);
                } else {
                    self::replace($word, 'ou', '', 1);
                }
                break;
            case 's':
                self::replace($word, 'ism', '', 1);
                break;
            case 't':
                   self::replace($word, 'ate', '', 1)
                OR self::replace($word, 'iti', '', 1);
                break;
            case 'u':
                self::replace($word, 'ous', '', 1);
                break;
            case 'v':
                self::replace($word, 'ive', '', 1);
                break;
            case 'z':
                self::replace($word, 'ize', '', 1);
                break;
        }

        return $word;
    }

    private static function step5($word)
    {
        if (substr($word, -1) == 'e') {
            if (self::m(substr($word, 0, -1)) > 1) {
                self::replace($word, 'e', '');

            } else if (self::m(substr($word, 0, -1)) == 1) {

                if (!self::cvc(substr($word, 0, -1))) {
                    self::replace($word, 'e', '');
                }
            }
        }

        if (self::m($word) > 1 AND self::doubleConsonant($word) AND substr($word, -1) == 'l') {
            $word = substr($word, 0, -1);
        }

        return $word;
    }

    private static function replace(&$str, $check, $repl, $m = null)
    {
        $len = 0 - strlen($check);

        if (substr($str, $len) == $check) {
            $substr = substr($str, 0, $len);
            if (is_null($m) OR self::m($substr) > $m) {
                $str = $substr . $repl;
            }

            return true;
        }

        return false;
    }

    private static function m($str)
    {
        $c = self::$regex_consonant;
        $v = self::$regex_vowel;

        $str = preg_replace("#^$c+#", '', $str);
        $str = preg_replace("#$v+$#", '', $str);

        preg_match_all("#($v+$c+)#", $str, $matches);

        return count($matches[1]);
    }

    private static function doubleConsonant($str)
    {
        $c = self::$regex_consonant;

        return preg_match("#$c{2}$#", $str, $matches) AND $matches[0]{0} == $matches[0]{1};
    }

    private static function cvc($str)
    {
        $c = self::$regex_consonant;
        $v = self::$regex_vowel;

        return     preg_match("#($c$v$c)$#", $str, $matches)
               AND strlen($matches[1]) == 3
               AND $matches[1]{2} != 'w'
               AND $matches[1]{2} != 'x'
               AND $matches[1]{2} != 'y';
    }
	   
   
    
    	    
}
