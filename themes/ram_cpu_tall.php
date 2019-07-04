<?php
class ram_cpu_tall extends BaseTheme
{
    public function render($server, $config, $database)
	{
		// Create a set of colors to use for the widget.
		$redColor = new ImagickPixel('#FF0000');
		$greenColor = new ImagickPixel('#00FF00');
		$whiteColor = new ImagickPixel('#FFFFFF');

		// Create the canvas by loading in our background image.
		$this->canvas = new Imagick();
		$this->canvas->readImage("themes/ram_cpu_tall/background.png"); 

		$this->draw = new ImagickDraw();
		$this->draw->setFont($config->get("main_font"));
		$this->draw->setFontSize(16);
		$this->draw->setStrokeAntialias(true);
		$this->draw->setTextAntialias(true);

		$metrics = $this->drawText($this->canvas->getImageWidth() / 2, 10, $config->serverName, $whiteColor, true);

		$this->draw->setFontSize(14);

		if (isset($server))
		{
			if ($server["status"] == "active")
			{
				$this->drawText($this->canvas->getImageWidth() / 2, 32, "Online (" . $server["availability"] . ")", $greenColor, true);
			}
			else
			{
				$this->drawText($this->canvas->getImageWidth() / 2, 32, "Offline", $redColor, true);
			}
			
			$this->draw->setFontSize(12);
			
			$this->drawText(16, 56, "RAM: " . $this->formatBytes($server["ram_usage"], 2) . " / " . $this->formatBytes($server["ram_total"], 2), $whiteColor);
			$this->drawText(16, 74, "CPU: " . $server["load_percent"] . "%", $whiteColor);
		}
		else
		{
			$this->drawText($this->canvas->getImageWidth() / 2, 32, "ERROR", $redColor, true);
		}

		$this->canvas->drawImage($this->draw);
	}
}
?>