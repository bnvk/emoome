<?php
/** Spectrum class
 * @package default
 * @author Giv Parvaneh giv@givp.org
 **/

class Color_analyze
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
	
	
	private function destroyImage()
	{
		ImageDestroy($this->img);
	}
	
}

?>