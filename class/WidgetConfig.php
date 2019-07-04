<?php
class WidgetConfig
{
	public $serverName;
	public $themeClass;
	
	private $json;
	
    public function __construct($fileName)
    {
        $this->json = json_decode(file_get_contents($fileName), true);
		$this->serverName = $this->get("server_name");
		$this->themeClass = $this->get("theme_class");
		
		if (isset($_GET["server"]))
		{
			$this->serverName = $_GET["server"];
		}
		
		if (isset($_GET["theme"]))
		{
			$this->themeClass = $_GET["theme"];
		}

		if ($this->serverName == false || $this->serverName == "")
		{
			$this->serverName = "unknown.server.com";
		}
    }
	
    public function get($key)
	{
		return $this->json[$key];
	}
}
?>