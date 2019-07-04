<?php
class WidgetDatabase
{
    private $data;
	private $fileName;

    public function __construct($fileName)
    {
		$this->fileName = $fileName;
		
		if (file_exists($fileName))
		{
			$this->data = json_decode(file_get_contents($fileName), true);
		}
		
		if (!$this->data)
		{
			$this->data = array();
		}
    }
	
	public function add($key, $value)
	{
		if (!isset($this->data[$key]))
		{
			$this->data[$key] = $value;
		}
	}
	
    public function decode($key)
	{
		return base64_decode($this->data[$key]);
	}
	
	public function encode($key, $value)
	{
		$this->data[$key] = base64_encode($value);
	}

    public function get($key)
	{
		return $this->data[$key];
	}
	
	public function set($key, $value)
	{
		$this->data[$key] = $value;
	}
	
	public function save()
	{
		file_put_contents($this->fileName, json_encode($this->data));
	}
}
?>