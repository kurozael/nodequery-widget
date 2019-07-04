<?php
namespace NodeQuery;

class Server
{
    private $baseUrl = "https://nodequery.com/api/servers/";
    private $key;
	private $id;

    public function __construct($key, $id)
	{
        $this->key = $key;
        $this->id =$id;
    }

    public function get()
	{
        $url = $this->baseUrl . $this->id . "?api_key=" . $this->key;
		
        return json_decode(Request::get($url), true);
    }
}

class Loads
{
    private $baseUrl = "https://nodequery.com/api/loads/";
    private $key;
	private $id;
	private $interval;

    public function __construct($key, $id, $interval)
	{
        $this->key = $key;
        $this->id = $id;
        $this->interval = $interval;
    }

    public function loadAry()
	{
        $url = $this->baseUrl . $this->interval . "/" . $this->id . "?api_key=" . $this->key;
		
        return json_decode(Request::get($url), true);
    }
}
?>