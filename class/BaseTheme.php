<?php
class BaseTheme
{
	public $draw;
	public $canvas;
	
    public function __construct()
    {
		
    }
	
    public function render($server)
	{
		
	}
	
	public function formatBytes($bytes, $precision = 2)
	{ 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		$bytes /= pow(1024, $pow);
		
		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 

	public function drawText($x, $y, $text, $color, $centerH = false)
	{
		$metrics = $this->canvas->queryFontMetrics($this->draw, $text);
		
		if ($centerH)
		{
			$x = $x - ($metrics['textWidth'] / 2);
		}
		
		$this->draw->setFillColor($color);
		$this->draw->annotation($x, $metrics['ascender'] + $y, $text);
		
		return $metrics;
	}
}
?>