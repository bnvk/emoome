<?php
/** Spectrum class
 * @package default
 * @author Giv Parvaneh giv@givp.org
 **/

class Spectrum
{
	private $src;
	private $img;
	private $img2;
	private $wid = 50; // default number of colors to return

	public function processImage($img)
	{
		$this->src = $img;
		$this->setSourceFile();		
		
		$finalpalette = $this->getAllColors();
		
		return $finalpalette;
	}
	
	private function setSourceFile()
	{
		$this->img = @ImageCreateFromJpeg($this->src) OR DIE ('Invalid image source');
		
		// Convert from true color to palette + dithering
		imagetruecolortopalette($this->img, true, 50);
	}
	
	private function getAllColors()
	{
		$totalColors = ImageColorsTotal($this->img);
		$palette = array();

		for ($n=0; $n < $totalColors; ++$n)
		{			
			$color = $this->getColor($this->img, $n);
			
			// Omit White
			if ($color["red"] != 255 && $color["green"] != 255 && $color["blue"] != 255)
			{
				$palette[] = $color;
			}
		}

		$this->destroyImage();

		return $palette;
	}
	
	public function getColor($image, $index)
	{    
	    $c = ImageColorsForIndex($image, $index);

		$hex = $this->rgb2hex($c['red'],$c['green'],$c['blue']);

		$color = array("red"=>$c['red'],"green"=>$c['green'],"blue"=>$c['blue'],"hex"=>$hex);
		return $color;
	}
	
	/**
	 * RGB 2 HEX function
	 *
	 * @return hex string
	 **/
	private function rgb2hex($r, $g=-1, $b=-1)
	{
	    if (is_array($r) && sizeof($r) == 3)
	        list($r, $g, $b) = $r;
	
	    $r = intval($r); $g = intval($g);
	    $b = intval($b);
	
	    $r = dechex($r<0?0:($r>255?255:$r));
	    $g = dechex($g<0?0:($g>255?255:$g));
	    $b = dechex($b<0?0:($b>255?255:$b));
	
	    $color = (strlen($r) < 2?'0':'').$r;
	    $color .= (strlen($g) < 2?'0':'').$g;
	    $color .= (strlen($b) < 2?'0':'').$b;
	    return $color;
	}
	
	
	private function destroyImage()
	{
		ImageDestroy($this->img);
	}
	
	
	// HSV Stuff incorporated from - http://www.actionscript.org/forums/showthread.php3?t=50746
	function rgb_to_hsv($R, $G, $B)  // RGB Values:Number 0-255 
	{                                 // HSV Results:Number 0-1 
	   $max = '';
	   $H = '';
	   $HSL = array(); 
	
	   $var_R = ($R / 255); 
	   $var_G = ($G / 255); 
	   $var_B = ($B / 255); 
	
	   $var_Min = min($var_R, $var_G, $var_B); 
	   $var_Max = max($var_R, $var_G, $var_B); 
	   $del_Max = $var_Max - $var_Min; 
	
	   $V = $var_Max; 
	
	   if ($del_Max == 0) 
	   { 
	      $H = 0; 
	      $S = 0; 
	   } 
	   else 
	   { 
	      $S = $del_Max / $var_Max; 
	
	      $del_R = ( ( ( $max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max; 
	      $del_G = ( ( ( $max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max; 
	      $del_B = ( ( ( $max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max; 
	
	      if      ($var_R == $var_Max) $H = $del_B - $del_G; 
	      else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B; 
	      else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R; 
	
	      if ($H < 0) $H++; 
	      if ($H > 1) $H--; 
	   }

	   $HSL['H'] = $H; 
	   $HSL['S'] = $S; 
	   $HSL['V'] = $V; 
	
	   return $HSL; 
	} 
	
	function hsv_to_rgb($H, $S, $V)  // HSV Values:Number 0-1 
	{                                // RGB Results:Number 0-255 
	    $RGB = array(); 
	
	    if($S == 0) 
	    { 
	        $R = $G = $B = $V * 255; 
	    } 
	    else 
	    { 
	        $var_H = $H * 6; 
	        $var_i = floor( $var_H ); 
	        $var_1 = $V * ( 1 - $S ); 
	        $var_2 = $V * ( 1 - $S * ( $var_H - $var_i ) ); 
	        $var_3 = $V * ( 1 - $S * (1 - ( $var_H - $var_i ) ) ); 
	
	        if       ($var_i == 0) { $var_R = $V     ; $var_G = $var_3  ; $var_B = $var_1 ; } 
	        else if  ($var_i == 1) { $var_R = $var_2 ; $var_G = $V      ; $var_B = $var_1 ; } 
	        else if  ($var_i == 2) { $var_R = $var_1 ; $var_G = $V      ; $var_B = $var_3 ; } 
	        else if  ($var_i == 3) { $var_R = $var_1 ; $var_G = $var_2  ; $var_B = $V     ; } 
	        else if  ($var_i == 4) { $var_R = $var_3 ; $var_G = $var_1  ; $var_B = $V     ; } 
	        else                   { $var_R = $V     ; $var_G = $var_1  ; $var_B = $var_2 ; } 
	
	        $R = $var_R * 255; 
	        $G = $var_G * 255; 
	        $B = $var_B * 255; 
	    } 
	
	    $RGB['R'] = $R; 
	    $RGB['G'] = $G; 
	    $RGB['B'] = $B; 
	
	    return $RGB; 
	} 
	
	
}

?>