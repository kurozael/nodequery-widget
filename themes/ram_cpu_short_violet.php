<?php
class ram_cpu_short extends BaseTheme
{
    public function render($server, $config, $database)
	{
		// Create a set of colors to use for the widget.
		$redColor = new ImagickPixel('#FF0000');
		$greenColor = new ImagickPixel('#7AC902');
		$whiteColor = new ImagickPixel('#FFFFFF');
		$greyColor = new ImagickPixel('#4A4A4A');
		
		// Create the canvas by loading in our background image.
		$this->canvas = new Imagick();
		
		if (isset($_GET["background"]))
		{
			$this->canvas->readImage("themes/ram_cpu_short/" . escapeshellcmd($_GET["background_violet"]) . ".png");
		}
		else
		{
			$this->canvas->readImage("themes/ram_cpu_short/background.png");
		}
		$this->draw = new ImagickDraw();
		$this->draw->setFont($config->get("main_font"));
		$this->draw->setFontSize(14);
		$this->draw->setStrokeAntialias(true);
		$this->draw->setTextAntialias(true);
		$metrics = $this->drawText(10, 12, $config->serverName, $greyColor);
		$this->draw->setFontSize(12);
		if (isset($server))
		{
			if ($server["status"] == "active")
			{
				$this->drawText(10, 26, "Online (" . $server["availability"] . ")", $greenColor);
			}
			else
			{
				$this->drawText(10, 26, "Offline", $redColor);
			}
			
			$this->draw->setFontSize(12);
			
			$ramUsage = ceil((100 / $server["ram_total"]) * $server["ram_usage"]);
			$ramColor = $greyColor;
			$cpuColor = $greyColor;
			
			if ($server["load_percent"] > 50)
			{
				$cpuColor = $redColor;
			}
			
			if ($ramUsage > 50)
			{
				$ramColor = $redColor;
			}
			
			$this->drawText(175, 12, "RAM: " . $ramUsage . "%", $ramColor);
			$this->drawText(175, 26, "CPU: " . $server["load_percent"] . "%", $cpuColor);
		}
		else
		{
			$this->drawText(10, 26, "ERROR", $redColor, true);
		}
		$this->canvas->drawImage($this->draw);
	}
}
?>